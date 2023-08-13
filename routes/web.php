<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/search', 'HomeController@search')->name('search');

Route::resource ('admin', 'AdminController');

Route::resource ('client', 'ClientsController');

Route::resource ('invoice', 'InvoicesController');

Route::resource ('receipt', 'ReceiptsController');

Route::resource ('product', 'ProductsController');

Route::resource ('service', 'ServicesController');

Route::resource ('waybill', 'WaybillController');

Route::get('pdfview',array('as'=>'pdfview','uses'=>'InvoicesController@pdfview'));

Route::get('pdfview2',array('as'=>'pdfview2','uses'=>'ReceiptsController@pdfview'));

Route::get('pdfview3',array('as'=>'pdfview3','uses'=>'WaybillController@pdfview'));

Route::get('receipt/create/{invoice_id}', array('as' => 'create', 'uses' => 'ReceiptsController@create'));

Route::get('waybill/create/{invoice_id}', array('as' => 'create', 'uses' => 'WaybillController@create'));

//Route::get('/getchild/{id}/{csrfVar}','ProductsController@getChild');

Route::get('/getchild/','ProductsController@getChild');

Route::get('/product/create/{id}','ProductsController@create');

Route::post('editproduct', 'ProductsController@editProduct');

Route::post('updateproduct', 'ProductsController@updateProduct');

Route::get('cart','ProductsController@getCart');

Route::get('showcart/{newvalue?}','ProductsController@showCart');

Route::post('getinvoice', 'InvoicesController@getinvoice');

Route::get ('deletewaybill/{waybill}', 'WaybillController@destroy');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('post_serial_no', 'UniqueItemController@postSerialNo');