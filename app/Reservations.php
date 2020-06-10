<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = 'reservations';

    protected $fillable = ['user_id', 'table_id', 'date_time_reservation'];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function table()
    {
        return $this->hasOne(Halls::class,'id','table_id');
    }

    public function dishes_reservation()
    {
        return $this->hasMany(DishesEvents::class,'event_id','id');
    }
}
