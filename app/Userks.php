<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userks extends Model
{
    
    public $primaryKey='user_id';
    public $table='userks';
    public $timestamps=false;
    public $guarded = [];
}
