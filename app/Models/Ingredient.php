<?php

namespace App\Models;
use App\Model\Meal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'calories', 'unit'];
    
    public function meals () {
        return $this->belongsToMany(Meal::class);
    }
}
