<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Invoice;

use App\Receipt;

use App\Client;

use App\Service;

use App\Admin;

use Auth;

use PDF;


class ReceiptsController extends Controller
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
        //$receipts = Receipt::where('invoice_id','=',$invoice_id)->get();
        $receipts = $invoice->receipts;
        $admin = array();
        foreach ($receipts as $receipt){
            //$admin[] = Admin::find($receipt->approved_by)->name;
            $admin[] = $receipt->admin->name;
        }

        return view('receipt.create')
            ->with('invoice',$invoice)
            ->with('receipts',$receipts)
            ->with('admin',$admin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if ($input['partPayment']>0){
            $invoice = Invoice::findOrFail($input['invoice_id']);
            $receipt = new Receipt();
            $receipt->invoice_id = $input['invoice_id'];

            if ($input['partPayment']==$input['balance']){
                //full payment
                $receipt->paid = $input['balance'];
                $receipt->approved_by = Auth::user()->id;
                $invoice->paid = 1;
            }
            else {
                //part payment
                $receipt->paid = $input['partPayment'];
                $receipt->balance = $input['balance']-$input['partPayment'];
                $receipt->approved_by = Auth::user()->id;
                $invoice->paid = -1;
            }
            $invoice->save();
            $receipt->save();
            $count = Receipt::where('invoice_id','=',$invoice->id)->get()->count();
            //$receipt->receipt_id = "#R".$receipt->id."-".$invoice->id."-".date('ymj').$invoice->paid."0".$count;
            $receipt->receipt_id = "R".$count."-".$invoice->invoice_id;
            $receipt->save();

            return redirect ('receipt/'.$receipt->id);
        }
        else {
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
        $receipt = Receipt::findOrFail($id);
        return view ('receipt.show', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdfview (Request $request)
    {
        $receipt = Receipt::findOrFail($request->id);

        if ($receipt->invoice->usepo>0 && !empty ($receipt->invoice->po)){

            $receipt->invoice->title = $receipt->invoice->po;
        }

        elseif (!empty ($receipt->invoice->po)) {
            $receipt->invoice->title = $receipt->invoice->title." (".$receipt->invoice->po.")";
        }

        //return view ('receipt.pdfview', compact('invoice','client','admin','services','receipt','products'));
        if($request->has('download')){
            $pdf = PDF::loadView('receipt.pdfview', compact('receipt'));
            return $pdf->download($receipt->receipt_id.'.pdf');
        }
        return view ('receipt.pdfview');

        return ($request);
    }
}
