<?php

namespace App\Models;
use App\Model\User;
use App\Model\Meal;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'meal_id', 'date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function meal () {
        return $this->belongsTo(Meal::class);
    }
}
