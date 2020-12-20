<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Settings;
use App\Repositories\MealRepository\MealRespositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{


    /**
     * @var $repository
     */
    private $repository;

    /**
     * MealRespositoryInterface constructor.
     * @param MealRespositoryInterface $repository
     */
    public function __construct(MealRespositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $countPerDay = Settings::firstOrFail();
        $dates = Auth::user()->meals()->take(100)->paginate(10)
            ->groupBy(function ($date) {
                return Carbon::parse($date->date_of_consumption)->format('yy-m-d'); // grouping by years
            });

        $meals = $this->repository->getAllMeals();
        $sum = 0;
        foreach ($dates as $key => $value) {
            foreach ($value as $item) {
                $sum += $item->calories;
            }
            foreach ($meals as $meal) {
                if ($meal->date_of_consumption == $key) {
                    $meal->total = $sum;
                }
            }
            $sum = 0;
        }

        return view('meals/meals')->with(['meals' => $meals, 'countPerDay' => $countPerDay]);
    }


    /**
     * Display a listing of the resource from search
     *
     * @param Request $request
     * @return Application|Factory|View|Response
     */
    public function search(Request $request)
    {
        $data = $request->all();
        $countPerDay = Settings::firstOrFail();
        $dates = Auth::user()->meals()
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date_of_consumption)
                    ->format('yy-m-d'); // grouping by years
            });

        $meals = $this->repository->filterMeals($data);
        $sum = 0;
        foreach ($dates as $key => $value) {
            foreach ($value as $item) {
                $sum += $item->calories;
            }
            foreach ($meals as $meal) {
                if ($meal->date_of_consumption == $key) {
                    $meal->total = $sum;
                }
            }
            $sum = 0;
        }

        $from = $data['date_from'];
        $to = $data['date_to'];
        return view('meals/filter')->with(['meals' => $meals, 'from' => $from, 'to' => $to, 'countPerDay' => $countPerDay]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('meals/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            $error = $validator->messages();
            return Redirect::back()->with('validator', $error);
        }
        $data = $request->all();
        $this->repository->createNewMeal($data);
        return Redirect::back()->with('success', 'Meal is create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Meal $meal
     * @return Application|Factory|View|Response
     */
    public function edit(Meal $meal)
    {
        return view('meals/edit')->with(['meal' => $meal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Meal $meal
     * @return RedirectResponse
     */
    public function update(Request $request, Meal $meal): RedirectResponse
    {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            $error = $validator->messages();
            return Redirect::back()->with('validator', $error);
        }
        $meal->update($request->all());
        return Redirect::back()->with('success', 'Meal is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Meal $meal
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|RedirectResponse|Response
     * @throws \Exception
     */
    public function destroy(Meal $meal)
    {
        $meal->delete();
        return response(['msg' => 'Meal deleted', 'status' => 'success']);
    }


    public function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'max:25'],
            'calories' => ['required', 'numeric'],
            'date_of_consumption' => ['required'],
            'time_of_consumption' => ['required'],
        ]);
    }
}
