<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review_detail', 'user_id', 'recipe_id',
                          'ratings'];

    public function user(){
      return $this->hasOne(User::class);
    }
}
