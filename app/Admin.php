<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Admin extends Model implements Searchable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $table = 'users';

    public function Invoice ()
    {
        return $this->hasMany('App\Admin', 'created_by');
    }

    public function Receipt()
    {
        return $this->hasMany('App\Receipt', 'approved_by');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
