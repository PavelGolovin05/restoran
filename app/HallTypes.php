<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HallTypes extends Model
{
    protected $table = 'hall_types';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function halls()
    {
        return $this->hasMany(Halls::class, 'hall_type_id','id');
    }
}
