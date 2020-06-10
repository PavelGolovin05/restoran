<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishesReservation extends Model
{
    protected $table = 'dishes_reservation';

    protected $fillable = ['reservation_id', 'dish_id', 'count'];

    public $timestamps = false;

    public function reservation()
    {
        return $this->hasOne(Reservations::class,'id','reservation_id');
    }

    public function dish()
    {
        return $this->hasOne(Dishes::class,'id','dish_id');
    }
}
