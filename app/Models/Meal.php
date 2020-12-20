<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'calories',
        'date_of_consumption',
        'time_of_consumption'
    ];


    /**
     * The user that own the meals
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'meal_user');
    }
}
