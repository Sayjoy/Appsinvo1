<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

use App\Product;

use Cart;

use App\Client;

use Auth;

class productsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($roots = Product::whereIsRoot()->get()){

            //Div children in div of parents.
            $div ="";
            foreach ($roots as $root){

                $div .= $this->wrapChildren($root->id);
            }

            $tree = $div;

            return view ('products.index',compact('tree'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = 0)
    {
        if ($id ==0){
            $root = Product::whereIsRoot()->get();
            $node = (object)array("name"=>"Root", "id"=>0);
        }
        else {
            $node = Product::findOrFail($id);
            $root = Product::where("parent_id","=",$id)->get();
        }
        return view('products.create_product', compact('root','node'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has("add_one"))
        {
            if ($request->name!="") {
                //Insert one product.
                $product = new Product();
                $product->part_no = $request->part_no;
                $product->name = $request->name;
                $product->price = $request->price;
                $product->unit = $request->unit;
                $product->description = $request->description;
                $product->parent = $request->parent;

                $product->save();

                //$ancestors = Product::ancestorsAndSelf($product->id);
                return redirect('/product/create/'.$request->parent);
            } else {
                $request->session()->flash('alert-warning', 'No Name entered');
                return redirect('/product/create/'.$request->parent);
            }
        }

        if ($request->has("add_many"))
        {
            $qty = $request->qty;
            if ($qty!=0)
            {
                if ($request->parent==0){
                    $parent = (object)array("name"=>"Root", "id"=>0);
                }
                else {
                    $parent = Product::findOrFail ($request->parent);
                }

                return view ('products.create_many', compact('qty','parent'));
            }
            else {
                $request->session()->flash('alert-warning', 'No quantity entered');
                return redirect('/product/create/'.$request->parent);
            }
        }

        if ($request->has("many_data"))
        {
            for ($i=0; $i<sizeof ($request->name); $i++)
            {
                if ($request->name[$i]!="")
                {
                    $product = new Product();
                    $product->part_no = $request->part_no[$i];
                    $product->name = $request->name[$i];
                    $product->price = $request->price[$i];
                    $product->unit = $request->unit[$i];
                    $product->description = $request->description[$i];
                    $product->parent = $request->parent;

                    $product->save();
                }
            }

            return redirect('/product/create/'.$request->parent);
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
        //
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

    //public function getChild($id, $csrfVar)

    public function getChild(Request $request)
    {
        $node = Product::findOrFail($request->id);
        if ($node->isLeaf())
        {
            $html = '<div class="col-md-12 well" id="parent0' . $request->id . '">
                        <hr/>
                        <h4>Add 1 item to ' .$node->name.'</h4>
                        <div>
                            <form action="'.asset("/product/").'" method="post">
                                <input type="hidden" name="_token" value="'.$request->csrfVar.'">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Part No</label>
                                        <input type="text" name="part_no" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" name="name" class="form-control">
                                        <input type="hidden" name="parent" value="'.$node->id.'">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <label>Unit</label>
                                   <input type="text" name="unit" class="form-control">
                                    <div>
                                        <div class="form-group col-md-8">
                                            <label>Price</label>
                                            <input type="text" name="price" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4"> 
                                            <br/>
                                            <input type="submit" name="add_one" class="btn btn-primary">
                                        </div>
                                     </div>                            
                                </div>
                                    
                                <div class="col-md-4">
                                     <h4>Add Many items to '.$node->name.' </h4>
                                        <div class="form-group col-md-8">
                                                <label>How Many?</label>
                                                <input type="text" name="qty" class="form-control">
                                                
                                        </div>
                                        <div class="form-group col-md-4">
                                                <br/>
                                                <input type="submit" name="add_many" class="btn btn-primary">
                                        </div>
                                </div>
                            </form>

                        </div>
                    </div>';
            return response()->json(['html' => $html]);
        }
        else {
            $children = Product::where("parent_id","=",$request->id)->get();
            $option = "<option selected>Select a Product</option>";

            foreach ($children as $child)
            {
                $option .= '<option value="'.$child->id.'">'.$child->name.'</option>';
            }
            $html = '<div class="col-md-12" id="parent'.$request->id.'">
                        <hr/>
                        <div>
                            <form action="'.asset("/product/").'" method="post">
                            <input type="hidden" name="_token" value="'.$request->csrfVar.'">
                                <div class="col-md-4 form-group"> 
                                    <h4>Continue Here</h4>
                                    <label>Select existing Subcategory/Product</label>
                                    <select class="form-control" onchange="populateChild(this)">'
                                        .$option.
                                    '</select>
                                </div>
                                <div class="col-md-8 form-group well">
                                <h4>Add 1 item to '.$node->name.'</h4>
                                    <div class="row">
                                         <div class="form-group col-md-4">
                                   <label>Part No</label>
                                   <input type="text" name="part_no" class="form-control">
                                   <label>Name</label>
                                   <input type="text" name="name" class="form-control">
                                   <input type="hidden" name="parent" value="'.$node->id.'">
                               </div>

                               <div class="form-group col-md-2">
                                   <label>Price</label>
                                   <input type="text" name="price" class="form-control">
                                   <label>Unit</label>
                                   <input type="text" name="unit" class="form-control">
                               </div>

                               <div class="form-group col-md-4">
                                   <label>Description</label>
                                   <textarea name="description" class="form-control"></textarea>
                               </div>

                                        <div class="form-group col-md-2"> 
                                            <br/>
                                            <input type="submit" name="add_one" class="btn btn-primary">
                                        </div>
                                         
                                    </div>
                                        
                                    <div class="row"><hr/>
                                         <div class="col-md-4"><h4>Add Many items</h4></div>
                                         <div class="form-group col-md-2">
                                              <label>How Many?</label>
                                              <input type="text" name="qty" class="form-control">
                                              <input type="hidden" name="parent" value="'.$node->id.'">
                                         </div>
                                         <div class="form-group col-md-2">
                                              <br/>
                                              <input type="submit" name="add_many" class="btn btn-primary">
                                         </div>
                                    </div>
                                    
                                </div>
                            </form>

                        </div>
                    </div>';
            return response()->json(['html' => $html]);
        }

        //json_encode($children);


    }


    function wrapChildren ($node_id, $div = "")
    {
        //$cart = (array)(Cart::content());
        if ($node = Product::findOrFail($node_id)) {

            $item = Cart::search(function ($key, $value) use ($node_id) {
                return $key->id == $node_id;
            });

            $shop = "";
            if (sizeof($item)>0)
            {
                $shop = '&nbsp;&nbsp;<span class="mif-cart pos-left-center"></span>';
            }
            $inline = "";
            $withparent = "";
            //
            if (!$node->isLeaf()){
                //$inline = '<div><div>';
                $inline = '';
                $withparent = ' <li>
                                <input type="checkbox" name="id[]" id="'.$node->id.'" value="'.$node->id.'" data-role="switch" data-caption="This parent item - '.$node->name.' will">
                                <select name="withparent['.$node->id.']" data-role="select" class="bg-amber" onchange="checkParent (this, '.$node->id.')">
                                        <option value="0">Not appear in the invoice (Default)</option>
                                      
                                        <option value="2">Be used as an invoice item</option>
                                </select>
                                        
                                        </li>
                                        ';
            }

            $div .='<li data-collapsed="true">'.$inline.'
                    <input type="checkbox" name="id[]" value="'.$node->id.'" data-role="checkbox" data-caption="'.$node->name.' 
                        (N'.number_format($node->price).')" title="">
                    <a class="button outline cycle mini pos-left-center" role="button" href="'.action ('ProductsController@create',[$node->id]).'">
                        <span class="mif-plus"></span></a>'
                        .$shop;

            $children = Product::where("parent_id","=",$node->id)->get();
            if (sizeof($children)!=0){

                $div .='<ul>'.$withparent;
                foreach ($children as $child){
                    $div .='<li data-collapsed="true">';
                    $div.= $this->wrapChildren($child->id);
                    $div .='</li>';
                }
                $div .='</ul>';
            }

            $div .='</li>';

            return $div;
        }
    }

    function withParent ($option, $node){
        switch ($option){
            case (0):
                //Don't use in Invoice
                break;
            /*case (1):
                //Make title (Set Price to Zero)
                Cart::add ($node->id, $node->name,1, 0, 0, ['description'=>$node->description, 'useas'=>'title']);
                break;*/
            case (2):
                //Use as normal item
                Cart::add ($node->id, $node->name,1, (int)$node->price, 0, ['description'=>$node->description, 'useas'=>'item']);
                break;
        }
    }

    public function editProduct(Request $request)
    {
        if ($request->has('edit'))
        {
            $nodes = [];
            $ancestors = [];
            foreach ($request->id as $id)
            {
                $nodes[] = Product::findOrFail ($id);
                $ancestors[] = Product::ancestorsOf($id)->pluck ('name');
            }

            return view('products.update', compact('nodes', 'ancestors'));
        }

        if ($request->has('addcart'))

        {

            $request->validate ([
                'id' => 'required',
            ]);

            $ids = array_unique($request->id);
            foreach ($ids as $id)
            {
                $node = Product::findOrFail ($id);
                if (array_key_exists ($id, $request->withparent)){
                    $this->withParent($request->withparent[$id], $node);
                }
                else {
                    Cart::add($node->id, $node->name, 1, (int)$node->price, 0, ['description' => $node->description]);
                }


            }

            foreach (Cart::content() as $item){
                Cart::setTax($item->rowId, 7.5);
            }
            return redirect('cart');
        }

        if ($request->has('delete'))
        {
            //check if product is in any invoice
            //If yes, ask user to delete products first
            //Change all children to siblings
            //delete product
            $flash = '';
            foreach ($request->id as $id)
            {
                if ($product = Product::find ($id)) {
                    if ($product->invoices()->exists()) {
                        foreach ($product->invoices as $invoice) {
                            $flash .= '<li>'.$product->name.' is used in '.$invoice->title . ' (' . $invoice->invoice_id . ')</li>';
                        }

                    } else {
                        $product->delete();

                }
                }
            }

            if ($flash!=""){
                $flash = 'Products have been used in the following invoice(s)<ul> '.$flash.'</ul> 
                    Products used in invoices cannot be deleted. Please delete the invoice(s) first';
                return redirect('product')->with('warning',$flash);
            }
            else
                return redirect('product');
        }
    }

    public function updateProduct (Request $request)
    {
        if ($request->has ('edit_data'))
        {
            for ($i=0; $i<sizeof($request->id); $i++)
            {
                $node = Product::findOrFail ($request->id[$i]);
                $node->name = $request->name[$i];
                $node->description = $request->description[$i];
                $node->price = $request->price [$i];
                $node->unit = $request->unit[$i];
                $node->save();
            }

            return redirect('product');
        }
    }

    public function getCart (Request $request)
    {   $clients = Client::all();
        if ($clients->isEmpty()){
            $request->session()->flash('alert-warning', 'Clients are needed to create an invoice');
            return redirect ('client/create');
        }
        else {
            $cart = Cart::content();
            if ($request->session()->has('invoice'))
            {
                $invoice = Invoice::findOrFail ($request->session()->get('invoice'));
                return view ('products.cart', compact('cart', 'clients', 'invoice'));
            }
            return view ('products.cart', compact('cart', 'clients'));

        }

    }

    public function showCart ($newvalue = [], Request $request){

        $obj = json_decode($request->cartval);
        if (!empty ($obj)){
            if (isset ($obj->qty) || isset ($obj->price) 
            || isset ($obj->name)){
                $itemUpdate = array();
                if (isset ($obj->qty)){
                    $itemUpdate["qty"] = $obj->qty;
                }
                if (isset ($obj->price)){
                    $itemUpdate["price"] = $obj->price;
                }
                if (isset ($obj->name)){
                    $itemUpdate["name"] = $obj->name;
                }
                Cart::update($obj->rowId, $itemUpdate);
                unset($itemUpdate);
            }

            if (isset ($obj->rem)){
                Cart::remove($obj->rowId);
            }

            if (isset ($obj->tax)){
                if ($obj->tax==1){
                    foreach (Cart::content() as $item){
                        Cart::setTax($item->rowId, 0);
                    }
                }
                elseif ($obj->tax==2) {
                    foreach (Cart::content() as $item){
                        Cart::setTax($item->rowId, 7.5);
                    }
                }

                //$html = "New Tax ".Cart::tax();
                //return response()->json(['html' => $html]);
            }
            if (isset ($obj->discount)){
                Cart::setDiscount($obj->rowId, $obj->discount, 'currency');
                //return response()->json(['html' => $obj->discount]);
            }

        }



        $cart = Cart::content();

        $html = "";
        if ($request->session()->has('invoice'))
        {
            $html = '<div class="row"><h4>Editing Invoice</h4></div>';

            $control = '<div class="row">
                <div class="col-md-2">
                    <input type="hidden" name="id" value="'.$request->session()->get('invoice').'" class="btn btn-primary">
                    <input type="submit" name="update" value="Update Invoice" class="btn btn-primary">
                </div>
                <div class="col-md-2">
                    <input type="submit" name="clear" value="Clear Cart" class="btn btn-danger">
                </div>
                <div class="col-md-2">
                    <input type="submit" name="addmore" value="Add More" class="btn btn-info">
                </div>
                <div class="col-md-2">
                    <input type="submit" name="generate" value="Generate New Invoice" class="btn btn-primary">
                </div>
            </div>';
        }
        else {
            $control = '<div class="row">
                <div class="col-md-2">
                    <input type="submit" name="generate" value="Generate Invoice" class="btn btn-primary">
                </div>
                <div class="col-md-2">
                    <input type="submit" name="clear" value="Clear Cart" class="btn btn-danger">
                </div>
                <div class="col-md-2">
                    <input type="submit" name="addmore" value="Add More" class="btn btn-info">
                </div>
            </div>';
        }

        $html .= '
        <table class="table">
           <tr>
                <th>Item</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Total</th>
                <th></th>
           </tr>';

            foreach($cart as $item){
                $item->price > 0?$discount= $item->discount*100/$item->price
                    :$discount = 0;
                if (isset ($item->options["useas"])&& $item->options["useas"]=="title"){
                    $html.='<tr id="'.$item->rowId.'">
                                <td colspan="6"><strong>'. $item->name .'</strong></td>
                                <td><a href="#" onclick="removeItem(this)"><i class="fa fa-times"></i></a></td>
                            </tr>';
                }
                else {
                    $html .= '<tr id="'.$item->rowId.'">
                    <td><input type="text" name="name" value= "'.$item->name.'" onchange="changeName(this)" class="form-control">
                        <p>'.$item->options["description"].'</p>
                    </td>
                    <td><input type="text" name="unit" value="'. $item->options["unit"] .'" onchange="changeUnit(this)" class="form-control"></td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">N</span>
                            </div>
                            <input type="text" id="price'.$item->rowId.'" value="'.$item->price.'" onchange="changePrice(this)" class="form-control">
                        </div>
                    </td>
                    <td><input type="text" name="qty" value="'.$item->qty.'" autocomplete="off" size="2" onchange="changeQty(this)" class="form-control"></td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">N</span>
                            </div>
                            <input type="text" name="discount1" value="'.$item->discount.'" autocomplete="off" size="4" onchange="changeDiscount(this)" class="form-control">
                            <input type="text" name="discount2" value="'.$discount.'" autocomplete="off" size="4" onchange="changeDiscount(this)" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        </td>
                    <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                            N '.number_format($item->subtotal).'
                            </span>
                        </div>
                        
                    </div>
                    </td>
                    <td><a href="#" onclick="removeItem(this)"><i class="fa fa-times"></i></a></td>
                  </tr>';
                }

            }
        
            $html .='<tr>
                    <td colspan="5" align="right"><b>Sub-total</b></td>
                    <th>N'.Cart::subtotal().'</th>
                    <td></td>
                </tr>
        
                <tr>
                    <td colspan="5" align="right"><b>VAT (7.5%)</b></td>
                    <th>';
                   if (Cart::tax()>0){
                       $taxvalue = "N ".Cart::tax();
                       $taxaction = '<a href="#" onclick="removeTax(this)"><i class="fa fa-times"></i></a>';
                   }
                   else {
                       $taxvalue = "Add Tax";
                       $taxaction = '<a href="#" onclick="addTax(this)"><i class="fa fa-plus"></i></a>';
                   }
            $html .= $taxvalue.'</th>
                    <td>'.$taxaction.'</td>
                </tr>
        
                <tr>
                    <td colspan="5" align="right"><b>Total</b></td>
                    <th>N '.Cart::total().'</th>
                    <td></td>
                </tr>

        </table>'
        .$control;

        return response()->json(['html' => $html]);

    }
}
