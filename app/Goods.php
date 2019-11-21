<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
     public $table="goods";
    public $guarded = [];
    public $timestamps=false;
     public  $primaryKey='goods_id';
     
}
