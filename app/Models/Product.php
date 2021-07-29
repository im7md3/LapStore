<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cart(){
        return $this->belongsToMany(User::class,'cart');
    }

    

    public function scopeAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4)->get();
    }
}
