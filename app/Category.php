<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table="category";
    public $guarded = [];
    public $timestamps=false;
     public  $primaryKey='cate_id';
}
