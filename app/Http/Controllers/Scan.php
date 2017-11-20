<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Scan extends Controller
{
    public function selectScan($id){
      return view('scan')->withscanid($id);
    }
}
