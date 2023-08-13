<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Invoice extends Model implements Searchable
{
    protected $fillable =[
        'invoice_id', 'title', 'amount', 'paid', 'client_id', 'created_by', 'approved_by', 'discount', 'd_type', 'vat'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function services ()
    {
        return $this->hasMany('App\Service');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'created_by');
    }

    public function receipts ()
    {
        return $this->hasMany('App\Receipt');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('invoice.show', $this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    public function products ()
    {
        return $this->belongsToMany('App\Product')
            ->withPivot('qty','discount','vat','price', 'useas')
            ->withTimestamps();
    }

    public function waybills ()
    {
        return $this->hasMany('App\Waybill');
    }
}
