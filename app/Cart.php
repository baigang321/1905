<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   
    public $table="cart";
    public $guarded = [];
    public $timestamps=false;
    public  $primaryKey='c_id';

}