<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\Recipe;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'image', 'user_id'];

    public function review(){
      return $this->hasMany(Review::class)->orderBy('updated_at', 'desc')->limit(4);
    }

    public function recipe()
    {
        return $this->hasMany(Recipe::class);
    }

}
