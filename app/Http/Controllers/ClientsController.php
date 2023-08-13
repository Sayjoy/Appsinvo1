<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests\ClientRequest;

use App\Http\Requests;

use App\Client;

use App\Admin;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = Client::latest()->get();
        return view ('client.clients_list', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create_client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $input = Request::all();
        $addr = trim ($input['address']);
        $input['address'] = nl2br ($addr);
        Client::create($input);
        return redirect('/client');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        $invoices = Client::find($id)->invoice;
        $created_by = [];
        foreach ($invoices as $invoice)
        {
            //get created_by
            $created_by[] = Admin::find ($invoice->created_by);
        }

        return view ('client.show', compact('client','invoices', 'created_by'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view ('client.edit')->with('client',$client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $input = $request->all();
        $addr = trim ($input['address']);
        $input['address'] = nl2br ($addr);
        $client->update($input);
        return redirect('client');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail ($id);
        $client->invoice()->each(
            function ($invoice){
                $invoice->receipts()->delete();
                $invoice->services()->delete();
                $invoice->products()->detach();
                $invoice->waybills()->each(
                    function ($waybill){
                        $waybill->products()->detach();
                        $waybill->services()->detach();
                        $waybill->delete();
                    }
                );

                $invoice->delete();

            }
        );

        Client::destroy ($id);
        return redirect('client');
    }
}
