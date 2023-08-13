<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Client extends Model implements Searchable
{
    protected $fillable = [
        'name', 'email', 'phone', 'address'
    ];

    public function Invoice (){
        return $this->hasMany('App\Invoice');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('client.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
