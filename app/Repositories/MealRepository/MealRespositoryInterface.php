<?php
namespace App\Repositories\MealRepository;

interface MealRespositoryInterface {
    public function getAllMeals();
    public function createNewMeal($data);
    public function filterMeals($data);
}
