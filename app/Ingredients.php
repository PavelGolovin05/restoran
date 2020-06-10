<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    protected $table = 'ingredients';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function dish_ingredients()
    {
        return $this->hasMany(DishIngredients::class,'ingredient_id','id');
    }
}
