<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//model is the base class 
class Meal extends Model
{
    use HasFactory; //gives the model the factory() method for generating test data 
    protected $fillable = ['user_id', 'name', 'description', 'category']; //$fillable is an array of attributes, protection feature in Laravel Eloquent
}
