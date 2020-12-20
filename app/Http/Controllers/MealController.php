<?php

namespace App\Http\Controllers;

use App\Repositories\MealRepository\MealRespositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $meals = $this->repository->getAllMeals();
        return view('meals/meals')->with(['meals' => $meals]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator->fails())
        {
            $error = $validator->messages();
            return Redirect::back()->with('validator', $error);
        }
        $data = $request->all();
        $this->repository->createNewMeal($data);
        return Redirect::back()->with('success', 'Meal is create succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function validator(Request $request) {
        return Validator::make($request->all(), [
            'name'=>['required', 'max:25'],
            'calories'=>['required', 'numeric'],
            'date_of_consumption'=>['required'],
            'time_of_consumption'=>['required'],
        ]);
    }
}
