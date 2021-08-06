<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_id', 'user_id'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

}
