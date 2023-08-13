<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Kalnoy\Nestedset\NodeTrait;


class Product extends Model
{
    use NodeTrait;
// Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public function Invoices ()
    {
        return $this->belongsToMany(Invoice::class)
            ->withPivot('qty','discount','vat','price', 'useas')
            ->withTimestamps();
    }

    public function Waybills ()
    {
        return $this->belongsToMany(Waybill::class)
            ->withPivot('qty')
            ->withTimestamps();
    }

}
