<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $primaryKey="id";
    public $table="article";
    public $guarded=[];
    public $timestamps=false;
}
