<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    protected $table = 'tables';

    protected $fillable = ['table_num','hall_id'];

    public $timestamps = false;

    public function hall()
    {
        return $this->hasOne(Halls::class,'id','hall_id');
    }

    public function reservation()
    {
        return $this->hasMany(Reservations::class,'table_id','id');
    }
}
