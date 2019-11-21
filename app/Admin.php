<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $primaryKey='admin_id';
    public $table='admin';
    public $timestamps=false;
    public $guarded = [];
}
