<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    protected $table = "warehouse_stock";
  
    public $timestamps = false;
}
