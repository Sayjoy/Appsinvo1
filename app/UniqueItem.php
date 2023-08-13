<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniqueItem extends Model
{
    public function Waybill(){
        $this->belongsToMany(Waybill::class);
    }
}
