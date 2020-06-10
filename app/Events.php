<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';

    protected $fillable = ['user_id', 'event_type_id', 'hall_id', 'count_peoples','date_time_event'];

    public $timestamps = false;

    public function event_type()
    {
        return $this->hasOne(EventTypes::class,'id','event_type_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function hall()
    {
        return $this->hasOne(Halls::class,'id','hall_id');
    }

    public function dishes_event()
    {
        return $this->hasMany(DishesEvent::class,'event_id','id');
    }
}
