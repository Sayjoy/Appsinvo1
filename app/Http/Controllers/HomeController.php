<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

use App\Invoice;
use App\Client;
use App\Admin;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }


    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Invoice::class,  'invoice_id', 'title', 'amount', 'created_by', 'created_at')
            ->registerModel(Client::class, 'name', 'email', 'phone', 'address')
            ->registerModel(Admin::class, 'name', 'email')
            ->perform($request->input('query'));

        return view('search', compact('searchResults'));
    }
}
