<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class Halls extends Model
{
    protected $table = 'halls';

    protected $fillable = ['hall_type_id', 'photo_link'];

    public $timestamps = false;

    public function hall_type()
    {
        return $this->hasOne(HallTypes::class, 'id','hall_type_id');
    }
    public function event()
    {
        return $this->hasMany(Events::class,'hall_id','id');
    }
}
