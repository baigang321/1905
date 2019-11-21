<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
       public $table="message";
    public $guarded = [];
    public $timestamps=false;
     public  $primaryKey='id';
}
