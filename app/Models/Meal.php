<?php

namespace App\Models;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\MealPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meal extends Model
{
    use HasFactory; //gives the model the factory() method for generating test data 
    protected $fillable = ['user_id', 'name', 'description', 'category']; //$fillable is an array of attributes, protection feature in Laravel Eloquent

    public function user () {
        return $this->belongsTo(User::class); 
    } 
    public function ingredients () {
        return $this->belongsToMany(Ingredient::class, 'meal_ingredient');
    }
    public function mealPlans () {
        return $this->hasMany(MealPlan::class);
    }
}



#$this->hasMany()      // One to Many - "I have many"
#$this->belongsTo()    // One to Many - "I belong to one"
#$this->belongsToMany() // Many to Many - "I belong to many"