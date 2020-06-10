<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;

class Dishes extends Model
{
    protected $table = 'dishes';

    protected $fillable = ['name','description','price','weight','measure','photo_link','category_id','is_stop_list'];

    public $timestamps = false;

    public function category()
    {
        return $this->hasOne(Categories::class, 'id','category_id');
    }

    public function dish_ingredients()
    {
        return $this->hasMany(DishIngredients::class,'dish_id','id');
    }

}
