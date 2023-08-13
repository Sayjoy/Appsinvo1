<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waybill extends Model
{
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function products ()
    {
        return $this->belongsToMany('App\Product')
            ->withPivot('qty')
            ->withTimestamps();
    }

    public function services ()
    {
        return $this->belongsToMany('App\Service')
            ->withPivot('qty')
            ->withTimestamps();
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'issued_by');
    }



}
