<?php


namespace App\Repositories\MealRepository;
use App\Models\Meal;
use Illuminate\Support\Facades\Auth;

class MealRespository implements MealRespositoryInterface
{

    /**
     * @var Meal
     */
    private $model;



    /**
     * MealRepository constructor.
     * @param Meal $meal
     */
    public function __construct(Meal $meal)
    {
        $this->model = $meal;
    }


    /**
     * @return mixed
     */
    public function getAllMeals()
    {
        return Auth::user()->meals()->take(100)->paginate(10);
    }


    /**
     * Create a new meal
     *
     * @param $data
     * @return mixed
     */
    public function createNewMeal($data)
    {
        $meal = $this->model::create($data);
        Auth::user()->meals()->attach([$meal->id]);
        return $data;
    }

    /**

    /**
     * @return mixed
     */
    public function filterMeals($data)
    {

        $from =$data['date_from'];
        $to = $data['date_to'];
        return Auth::user()->meals()->whereBetween('date_of_consumption', [$from, $to])->paginate(10);
    }
}
