<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishIngredients extends Model
{
    protected $table = 'dish_ingredients';

    protected $fillable = ['dish_id', 'ingredient_id'];

    public $timestamps = false;

    public function dish()
    {
        return $this->hasOne(Dishes::class,'id','dish_id');
    }

    public function ingredient()
    {
        return $this->hasOne(Ingredients::class,'id','ingredient_id');
    }
}
