<?php

namespace App\Http\Controllers;

use App\UniqueItem;
use Illuminate\Http\Request;

class UniqueItemController extends Controller
{
    public function postSerialNo (Request $request)
    {
        $data = json_decode($request->serial_data);
        UniqueItem::where('item_id', $data->service_id)->delete();
        for ($i = 0; $i< sizeof($data->serial_nos); $i++){
            $uniqitem = new UniqueItem();
            $uniqitem->serial_no = $data->serial_nos[$i];
            $uniqitem->item_id = $data->service_id;
            $uniqitem->save();
        }
        
        return response()->json(['html' => "Added the following serial numbers: ". implode(",", $data->serial_nos)]);
    }
}
