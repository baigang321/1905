<?php

namespace App\Http\Controllers\exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsaController extends Controller
{
    public function create(){
    	return view("goodsa.create");
    }
    public function index(){
    	return view("goodsa.index");
    }
}
