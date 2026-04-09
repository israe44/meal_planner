<?php

namespace App\Models;
use App\Models\User;
use App\Models\Meal;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'meal_id', 'date', 'meal_type'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function meal () {
        return $this->belongsTo(Meal::class);
    }
}
