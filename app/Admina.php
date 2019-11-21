<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admina extends Model
{
    public $table="admina";
 	public $guarded = [];
    public $primaryKey='admin_id';
    public $timestamps=false;
}
