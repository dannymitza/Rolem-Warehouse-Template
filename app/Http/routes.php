<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use \App\Scan;
use \App\Parts;

Route::post('/scanthis', function(Request $request){
  
 //$number = Request::input('inputSAPCodeN');
 $location = explode("-", Request::input('inputSAPLocN'));
 print_r($location);
 $scan = new Scan;
  
 $scan->SAP = Request::input('inputSAPCodeN');
 $scan->quantity = Request::input('inputSAPQuantityN');
 //$scan->rack = $location[0];
 //$scan->location = $location[1];
 //$scan->slot = $location[2];
 $scan->rack = "A";
 $scan->location = "01";
 $scan->slot = "01";
 $scan->stockID = Request::input('_stockID');
 
 $scan->save();
  
  $options = array(
    'cluster' => 'eu',
    'encrypted' => true
  );
  $pusher = new Pusher(
    '874b90015b50b115b1fb',
    '664c4128745ae1ef3708',
    '423900',
    $options
  );
  
  $message = array(
                    "message" => "Am mai gasit <b>" . Request::input('inputSAPQuantityN') . "</b>x[" . Request::input('inputSAPCodeN') . "]",
                    "type" => "info",
                  );
    
 $pusher->trigger('my-channel', 'my_event', $message);
  
 return redirect('/scan/' . Request::input('_stockID'));
});

Route::get('/stock/{id}', 'Stock@DisplayStock');
Route::get('/stock/', 'Stock@CreateStockScreen');
Route::get('/stock/maketotal/{id}', 'Stock@makeTotalStock');
Route::get('/stock/export/{take}', 'Stock@exportStockTakingResultsToExcel');
Route::get('/stock/view/pdf/{id}', 'Stock@exportStockTakingResultsToPDF');

Route::group(['middleware' => ['web']], function () {
  Route::get('/',  'Stock@DisplayStock');
  Route::get('/scan/{id}', 'Scan@selectScan');
 });
Route::post('/stock/create', 'Stock@addStockTaking');

Route::get('/timeline', function(){
  return view('timelime');
});

Route::get("/delivery", function(){
  return view('deliveries');
});
