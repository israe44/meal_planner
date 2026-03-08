<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Goal extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type'];

    public function user() {
        return $this->belongsToMany(User::class);
    }
}
