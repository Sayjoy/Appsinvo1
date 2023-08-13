<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Invoice;

use App\Client;

use App\Service;

use App\Admin;

use App\Receipt;

use Auth;

use PDF;

use Cart;

use Illuminate\Routing\Controller as BaseController;

class InvoicesController extends Controller
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
        $invoices = Invoice::latest()->paginate(10);
        $clients = [];
        $created_by =[];
        $approved_by = [];

        foreach ($invoices as $invoice)
        {
            //get clients
            $clients[] = Client::find($invoice->client_id);
            //get created_by
            $created_by[] = Admin::find ($invoice->created_by);
            //get approved_by
            $approved_by[] = Admin::find ($invoice->approved_by);

        }
        return view ('invoice.invoice_list', compact('invoices','clients','created_by','approved_by'));


        //return view ('invoice.invoice_list', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('invoice.create_invoice2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has ('create')){
            $input = $request->all();
            $i =0; $k=0;
            foreach ($input["service"] as $service){
                if ($service!="") {
                    $input["price"][$i]=str_replace(",","",$input["price"][$i]);
                    $services[] = ["service" => $service, "price" => $input["price"][$i],"qty" => $input["qty"][$i]];
                    $amount [] = $input['price'][$i]*$input['qty'][$i];
                    $k++;
                }
                $i++;
            }

            if ($k>0){
                $invoice = new Invoice();
                $invoice->title = $input["title"];
                $invoice->amount = array_sum($amount);
                $invoice->discount = str_replace(",","",$input["discount"]);

                if (isset ($input['vat'])){
                    $invoice->amount +=  0.05*$invoice->amount;
                    $invoice->vat = $input['vat'];
                }

                if ($invoice->discount>0){
                    if ($input['d_type']==0){
                        $invoice->amount -= ($invoice->discount/100)*$invoice->amount;
                    }
                    else {
                        $invoice->amount -=$invoice->discount;
                    }
                }

                $invoice->created_by = Auth::user()->id;
                $invoice->client_id = $input['client'];
                $invoice->due_date = $input['due_date'];
                $invoice->d_type = $input['d_type'];
                $invoice->save();
                $invoice->invoice_id = "#".$invoice->id."0".$input['client']."0".date('ymj');
                $invoice->save();

                foreach ($services as $serve){
                    $service = new Service();
                    $service->service = $serve['service'];
                    $service->price = $serve['price'];
                    $service->qty = $serve['qty'];
                    $service->invoice_id = $invoice->id;
                    $service->save();
                }

            }
            else {
                $request->session()->flash('alert-warning', 'No Item entered, Empty Invoice Request');
                return redirect ('invoice');
            }
            $request->session()->forget('cartdata');
            return redirect ('invoice');
        }

        if ($request->has ('clear')){
            Cart::destroy();
            return redirect('invoice/create');
        }

        if ($request->has ('addmore')){
            $cartdata = array(
                "title" => $request->title,
                "duedate" => $request->duedate,
                "client" => $request->client
            );
            $request->session()->put('cartdata', $cartdata);

            return redirect('service/create');
        }

        if ($request->has ('generate')){
            $request->validate ([
                'title' => 'required',
            ]);

            $invoice = new Invoice();
            $invoice->title = $request->title;
            $invoice->amount = floatval(preg_replace('/[^\d.]/', '', Cart::subtotal()));
            $invoice->created_by = Auth::user()->id;
            $invoice->client_id = $request->client;
            $invoice->due_date = $request->due_date;

            $invoice->vat = floatval ((str_replace (",","",Cart::tax())));
            $invoice->save();
            //$invoice->invoice_id = "#".$invoice->id."-".$request->client."-".date('ymj');
            $invoice->invoice_id = 5000 + $invoice->id;
            $invoice->save();

            foreach (Cart::Content() as $item)
            {
                if ($item->options->service == 1){
                    $service = new Service();
                    $service->invoice_id = $invoice->id;
                    $service->service = $item->name;
                    $service->price = $item->price;
                    $service->discount = $item->discount;
                    $service->qty = $item->qty;
                    $service->vat = $item->tax;
                    $service->unit = $item->options['unit'];
                    $service->save();
                } else {
                    if (isset ($item->options['useas'])){
                        $useas = $item->options['useas'];
                    } else {
                        $useas = "";
                    }
                    $invoice->products()->attach($item->id,["qty"=>$item->qty, "price"=>$item->price,
                        "discount"=>$item->discount, "vat"=>$item->tax, "useas"=>$useas]);
                }

            }

            Cart::destroy();
            $request->session()->forget('cartdata');
            return redirect("invoice/".$invoice->id);

        }

        if ($request->has('update')){

            $invoice = Invoice::findOrFail($request->id);
            $request->validate ([
                'title' => 'required',
            ]);

            $invoice->title = $request->title;
            $invoice->amount = floatval(preg_replace('/[^\d.]/', '', Cart::subtotal()));
            $invoice->created_by = Auth::user()->id;
            $invoice->client_id = $request->client;
            $invoice->due_date = $request->due_date;
            $invoice->vat = floatval ((str_replace (",","",Cart::tax())));
            $invoice->save();
            $invoice->services()->delete();
            $invoice->products()->detach();
            foreach (Cart::Content() as $item)
            {
                if ($item->options->service == 1){
                    $service = new Service();
                    $service->invoice_id = $invoice->id;
                    $service->service = $item->name;
                    $service->price = $item->price;
                    $service->discount = $item->discount;
                    $service->qty = $item->qty;
                    $service->vat = $item->tax;
                    $service->unit = $item->options['unit'];
                    $service->save();
                } else {
                    if (isset ($item->options['useas'])){
                        $useas = $item->options['useas'];
                    } else {
                        $useas = "";
                    }
                    $invoice->products()->attach($item->id,["qty"=>$item->qty, "price"=>$item->price, "discount"=>$item->discount, "vat"=>$item->tax, "useas"=>$useas]);
                }

            }

            Cart::destroy();
            $request->session()->forget('invoice');
            $request->session()->forget('cartdata');
            return redirect("invoice/".$invoice->id);
        }

        if ($request->has('delete')){
            foreach ($request->invoice as $id){
                $invoice = Invoice::findOrFail($id);
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
            return redirect('invoice');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view ('invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        //if ($invoice->paid==0) {
            $services = $invoice->services;
            $products = $invoice->products;
            Cart::destroy();

            foreach ($products as $product)
            {
                $item = Cart::add ($product->id, $product->name,$product->pivot->qty, (int)$product->pivot->price, 0, ['description'=>$product->description, 'useas'=>$product->pivot->useas]);
                $product->pivot->vat>0 ? Cart::setTax($item->rowId, 5)
                    :Cart::setTax($item->rowId, 0);
                $product->pivot->price > 0?$discount= number_format ($product->pivot->discount*100/$product->pivot->price,2)
                    :$discount = 0;
                Cart::setDiscount($item->rowId, $discount, 'percentage');
            }

            foreach ($services as $service)
            {
                $item = Cart::add ($service->id, $service->service,$service->qty, $service->price, 0, 
                    ['description'=>"", 'service'=>1, 'unit'=>$service->unit]);
                    
                $service->vat>0 ? Cart::setTax($item->rowId, 7.5)
                    :Cart::setTax($item->rowId, 0);
                ;
                $service->price > 0?$discount= number_format ($service->discount*100/$service->price,2)
                    :$discount = 0;
                Cart::setDiscount($item->rowId, $discount, 'percentage');
            }

            $cart = Cart::content();
            $clients = Client::all();
            $request->session()->put('invoice', $id);
            return view('products.cart', compact('invoice', 'cart', 'clients'));
       /* }
        else {
            $request->session()->flash('alert-warning', 'Invoices with payment receipt cannot be Editted');
            return redirect ('invoice');
        }*/

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($invoice->paid==0){
            $input = $request->all();
            $i =0; $k=0;

            foreach ($input["service"] as $service){
                if ($service!="") {
                    $services[] = ["service" => $service, "price" => $input["price"][$i],"qty" => $input["qty"][$i],
                     "service_id" =>$input["service_id"][$i], "unit" => $input["unit"]];
                    $amount [] = $input['price'][$i]*$input['qty'][$i];
                    $k++;
                }
                else{
                    Service::destroy($input["service_id"][$i]);
                }
                $i++;
            }

            if ($k>0){
                $invoice->title = $input["title"];
                $invoice->amount = array_sum($amount);
                //$invoice->created_at = date();
                $invoice->discount = str_replace(",","",$input["discount"]);
                if (isset ($input['vat'])){
                    $invoice->amount +=  0.05*$invoice->amount;
                    $invoice->vat = $input['vat'];
                }
                else {
                    $invoice->vat = 0;
                }

                if ($invoice->discount>0){
                    if ($input['d_type']==0){
                        $invoice->amount -= ($invoice->discount/100)*$invoice->amount;
                    }
                    else {
                        $invoice->amount -=$invoice->discount;
                    }
                }

                $invoice->created_by = Auth::user()->id;
                $invoice->client_id = $input['client'];
                $invoice->due_date = $input['due_date'];
                $invoice->d_type = $input['d_type'];

                $invoice->save();

                foreach ($services as $serve){
                    if ($serve['service_id']>0) {
                        $service = Service::findOrFail($serve['service_id']);
                    }
                    else{
                        $service = new Service();
                    }
                    $service->service = $serve['service'];
                    $service->price = $serve['price'];
                    $service->qty = $serve['qty'];
                    $service->invoice_id = $invoice->id;
                    $service->save();
                }


            }
            else {
                $request->session()->flash('alert-warning', 'No Service Item entered');
                return redirect()->action('invoice');
            }

        }

        else {
            $request->session()->flash('alert-warning', 'Invoices with payment receipt cannot be Editted');
            return redirect ('invoice');
        }
        return redirect ('invoice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //destroy related services
        $invoice = Invoice::findOrFail($id);
        if ($invoice->paid==0)
        {
            $services = Service::where('invoice_id','=',$id)->get();
             foreach ($services as $service)
             {
                 Service::destroy($service->id);
             }
            foreach ($invoice->products as $product)
            {
                Product::destroy($product->id);
            }
             //destroy invoice
             Invoice::destroy($id);
             return redirect ('invoice');

        }
        else {
            //$request = new Request();
            $request->session()->flash('alert-warning', 'Invoices with payment receipt cannot be deleted');
            return redirect('invoice');
        }
    }

    public function pdfview (Request $request)
    {
        $invoice = Invoice::findOrFail($request->id);
        if($request->has('download')){
            $format = $request->type;
            //return view ('invoice.pdfview', compact('invoice', 'format'));
            $pdf = PDF::loadView('invoice.pdfview', compact('invoice', 'format'));
            return view ('invoice.pdfview', compact('invoice', 'format'));
            return $pdf->download($invoice->invoice_id.'.pdf');
        }
        //return view ('invoice.pdfview');

        //return ($request);
    }

    public function getinvoice (Request $request)
    {
        $invoice = Invoice::findOrFail($request->id);
        if ($request->has('set')){
            $invoice->po = $request->po;
            $invoice->save();

            return redirect()->action('InvoicesController@show',['id'=>$request->id]);
        }

        if ($request->has('download')){

            $services = $invoice->services;
            $products = $invoice->products;
            $client = $invoice->client;
            $admin = $invoice->admin;
            $receipts = $invoice->receipts;
            $format = "invoice";

            if ($request->checkpo>0 && !empty ($invoice->po)){
                $invoice->usepo = 1;
                $invoice->save();
               $invoice->title = $invoice->po;
            }

            elseif (!empty ($invoice->po)) {
                $invoice->title = $invoice->title." (".$invoice->po.")";
                $invoice->usepo = 0;
                $invoice->save();
            }
            $pdf = PDF::loadView('invoice.pdfview', compact('invoice','format'));
            return $pdf->download($invoice->invoice_id.'.pdf');
            
        }
    }

}
