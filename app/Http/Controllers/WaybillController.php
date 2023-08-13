<?php

namespace App\Http\Controllers;

use App\Product;
use App\Waybill;
use Illuminate\Http\Request;

use App\Invoice;

use Auth;

use PDF;

class WaybillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $services = $invoice->services;
        $products = $invoice->products;
        $delivered = $this->delivered_items($invoice_id);
        return view('waybill.create_waybill', compact('invoice', 'services', 'products','delivered'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check1 = false;
        $check2 = false;

        if ($request->has('qty')) {
            $check1 = array_filter ($request->qty,
                function ($value){
                    if ($value>0){
                        return true;
                    }
                });
        }

        if ($request->has('qty2')) {
            $check2 = array_filter ($request->qty2,
                function ($value){
                    if ($value>0){
                        return true;
                    }
                });
        }

        if ($check1 or $check2){
            $invoice = Invoice::findOrFail($request->invoice_id);

            $waybill = new Waybill();
            $waybill->invoice_id = $request->invoice_id;
            $waybill->issued_by = Auth::user()->id;
            $waybill->save();
            $count = $invoice->waybills()->count();
            //waybill->waybill_no = "#W".$waybill->id."-".$waybill->invoice_id."-".date('ymj')."0".$count;
            $waybill->waybill_no = "W".$count."-".$invoice->invoice_id;
            $waybill->save();

            if ($request->has('qty')) {
                $size = sizeof($request->qty);
                for ($i = 0; $i < $size; $i++) {
                    if ($request->qty[$i] > 0)
                        $waybill->products()->attach($request->product_id[$i], ["qty" => $request->qty[$i], "invoice_id" => $request->invoice_id]);
                }
            }

            if ($request->has('qty2')) {
                $size = sizeof($request->qty2);
                for ($i = 0; $i < $size; $i++) {
                    if ($request->qty2[$i] > 0)
                        $waybill->services()->attach($request->service_id[$i], ["qty" => $request->qty2[$i], "invoice_id" => $request->invoice_id]);
                }
            }
            return redirect("waybill/".$waybill->id);
        }
        else {
            $request->session()->flash('alert-warning', 'Waybill quantity is zero');
            return redirect ()->action('WaybillController@create',['id'=>$request->invoice_id] );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function show(Waybill $waybill)
    {
        $delivered = $this->delivered_items($waybill->invoice_id);
        return view('waybill.show', compact('waybill','delivered'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function edit(Waybill $waybill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waybill $waybill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waybill $waybill)
    {
        $invoice = $waybill->invoice;
        $waybill->products()->detach();
        $waybill->services()->detach();
        $waybill->delete();
        return view ('invoice.show', compact('invoice'));
    }

    public function delivered_items ($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $services = $invoice->services;
        $products = $invoice->products;
        $delivered_products = array ();

        foreach ($products as $product){
            $delivered_products [$product->id] = $product->waybills()->wherePivot('invoice_id', $invoice_id)->sum('qty');
        }

        $delivered_services = array ();
        foreach ($services as $service){
            $delivered_services [$service->id] = $service->waybills()->wherePivot('invoice_id', $invoice_id)->sum('qty');
        }

        $items = array();
        //--How many products delivered
        $items["products"] = $delivered_products;
        //-- How many services delivered
        $items["services"] = $delivered_services;
        //-- How many waybills generated
        $items["waybill"]= $invoice->waybills()->count();

        return $items;
    }

    public function pdfview (Request $request)
    {
        $waybill = Waybill::findOrFail($request->id);
        $delivered = $this->delivered_items($waybill->invoice_id);

        if($request->has('download')){
            //return view ('waybill.pdfview', compact('waybill','delivered'));
            $pdf = PDF::loadView('waybill.pdfview', compact('waybill', 'delivered'));
            return $pdf->download($waybill->waybill_no.'.pdf');
        }

    }

}
