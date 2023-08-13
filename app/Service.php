<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function Invoice (){
        return $this->belongsTo('App\Invoice');
    }

    public function Waybills ()
    {
        return $this->belongsToMany(Waybill::class)
            ->withPivot('qty')
            ->withTimestamps();
    }
}
