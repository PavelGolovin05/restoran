<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishesEvent extends Model
{
    protected $table = 'dishes_event';

    protected $fillable = ['event_id','reservation_id' ,'dish_id', 'count'];

    public $timestamps = false;

    public function event()
    {
        return $this->hasOne(Events::class,'id','event_id');
    }
    public function reservation()
    {
        return $this->hasOne(Reservations::class,'id','reservation_id');
    }


    public function dish()
    {
        return $this->hasOne(Dishes::class,'id','dish_id');
    }
}
