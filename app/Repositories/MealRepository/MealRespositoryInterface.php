<?php
namespace App\Repositories\MealRepository;

interface MealRespositoryInterface {
    public function getAllMeals();
    public function createNewMeal($data);
    public function findMeal($id);
    public function updateMeal($data);
    public function deleteMeal($id);
    public function filterMeals($data);
}
