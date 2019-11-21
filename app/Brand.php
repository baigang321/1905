<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public  $primaryKey='brand_id';
    //黑
   public  $guarded = [];
   // 白
   // public  $fillable = ['brand_logo','brand_desc'];
    public $table="brand";
    public $timestamps=false;

}
