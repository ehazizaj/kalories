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
        $user = Auth::user();
        return $user->meals()->paginate(10);
    }


    /**
     * Create a new meal
     *
     * @param $data
     * @return mixed
     */
    public function createNewMeal($data)
    {
        $user = Auth::user();
        $meal = Meal::create($data);
        $user->meals()->attach([$meal->id]);
        return $data;
    }



    /**
     * Find Meal by id
     *
     * @param $data
     * @return mixed
     */
    public function findMeal($id)
    {
        return $this->model->findOrFail($id);
    }




    /**
     * Update Meal
     *
     * @param $data
     * @return mixed
     */
    public function updateMeal($data)
    {
        $meal = $this->model->find($data['id']);
        $meal->name = $data['name'];
        $meal->calories = $data['calories'];
        $meal->date_of_consumption = $data['date_of_consumption'];
        $meal->time_of_consumption = $data['time_of_consumption'];
        $meal->save();
        return $meal;
    }


    /**
     * Delete Meal
     *
     * @param $id
     * @return bool
     */
    public function deleteMeal($id): bool
    {
        $meal = $this->model->find($id);
        $meal->delete();
        return true;
    }


    /**
     * @return mixed
     */
    public function filterMeals($data)
    {
        return $this->model->get();

    }
}
