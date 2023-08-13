<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    public function Admin()
    {
        return $this->belongsTo('App\Admin', 'approved_by');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
