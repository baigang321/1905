<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/helloo', function () {
//     $data=request()->all();
//     dd($data);
// });
// Route::get('/hello', function () {
//     return view('bg');
// });
// Route::get('user/{name}/{pwd}',function($name,$pwd){
// 	 echo $name;
// 	echo $pwd;
// });
// Route::get('/','');
Route::domain("1905.cn")->group(function(){
//品牌
	Route::prefix('/brand/')->middleware('auth')->group(function(){
		//添加
		Route::get('create','Admin\BrandController@create');
		//执行添加
		Route::post('store','Admin\BrandController@store');
		//列表展示
		Route::get('index','Admin\BrandController@index');
		//删除
		Route::get('delete/{id}','Admin\BrandController@destroy');
		//修改
		Route::get('edit/{id}','Admin\BrandController@edit');
		//修改执行
		Route::post('update/{id}','Admin\BrandController@update');
		Route::post('checkedOnly','Admin\BrandController@checkedOnly');
	});
	//管理员
	Route::prefix("/admin/")->middleware('checkedlogin')->group(function(){
		Route::get('create','Admin\AdminController@create');
		Route::post('store','Admin\AdminController@store');
		Route::get('index','Admin\AdminController@index');
		Route::get('delete/{id}','Admin\AdminController@destroy');
		Route::get('edit/{id}','Admin\AdminController@edit');
		Route::post('update/{id}','Admin\AdminController@update');
	});
	//分类

	Route::prefix("/category/")->group(function(){
	    Route::get('create','Admin\CategoryController@create');
	    Route::post('store','Admin\CategoryController@store');
	    Route::get('index','Admin\CategoryController@index');
	    Route::get('delete/{id}','Admin\CategoryController@destroy');
	    Route::get('edit/{id}','Admin\CategoryController@edit');
	    Route::post('update/{id}','Admin\CategoryController@update');
	});
	//商品信息
	Route::prefix("/goods/")->group(function(){
		Route::get('create','Admin\GoodsController@create');
		Route::post('store','Admin\GoodsController@store');
		Route::get('index','Admin\GoodsController@index');
		Route::get('delete/{id}','Admin\GoodsController@destroy');
		Route::get('edit/{id}','Admin\GoodsController@edit');
	});

//登陆
Route::prefix("/login/")->group(function(){
   Route::get('login','Admin\LoginController@login')->name("login");
   Route::post('logindo','Admin\LoginController@logindo');
   Route::post('regdo','Admin\LoginController@regdo');



});
});

Route::view("/reg/","reg");
//cookie --添加到响应
Route::get("/setcookie",function(){
	//队列设置
	// Cookie::queue(Cookie::make('name', '度国伟',2));
	Cookie::queue('num','asd', 1);
	//获取 
	// $name=request()->cookie('name');
	// $name=  Illuminate\Support\Facades\Cookie::get('username');
	// echo $name;
	
	//设置
	// return response("欢迎")->cookie("name","度国伟",2);
});

//cookie --添加到响应
Route::get("/cookie",function(){
	// //队列设置
	// // Cookie::queue(Cookie::make('name', '度国伟',2));
	// Cookie::queue('num','100', 1);
	//获取 
	// $name=request()->cookie('name');
	$name=  Illuminate\Support\Facades\Cookie::get('num');
	echo $name;
	
	//设置
	// return response("欢迎")->cookie("name","度国伟",2);
});
//登陆
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// 文件
Route::prefix("/article/")->middleware('auth')->group(function(){
	Route::get("create","Admin\ArticleController@create");
	Route::post("store","Admin\ArticleController@store");
	Route::get("index","Admin\ArticleController@index");
	Route::post("destroy","Admin\ArticleController@destroy");
    Route::get("edit/{id}","Admin\ArticleController@edit");
    Route::post("update/{id}","Admin\ArticleController@update");
     Route::post("changValue","Admin\ArticleController@changValue");
});


// 前台
Route::get("/","Index\IndexController@index");
Route::view("/login",'index\login\login');
Route::view("/reg",'index\login\reg');
Route::post("/login/send","Index\LoginController@send");
Route::post("/login/LoginControllerdo","Index\LoginController@LoginControllerdo");
Route::post("/index/login/logindo","Index\LoginController@logindo");
Route::get("/proinfo/{id}","Index\IndexController@proinfo");
Route::get("cart/cart","Index\CartController@cart");
Route::get("cart/cartdo","Index\CartController@cartdo");
Route::get("cart/changNum","Index\CartController@changNum");
Route::get("cart/getCount","Index\CartController@getCount");
Route::get("cart/getTotal","Index\CartController@getTotal");
Route::get("cart/pay","Index\CartController@pay");
Route::get("cart/del","Index\CartController@del");

//////
Route::get("/exam/login","exam\IndexController@login");
Route::post("/exam/logindo","exam\IndexController@logindo");
Route::get("/exam","exam\IndexController@index")->middleware("checkedexam");
Route::get("/exam/admin/create","exam\IndexController@create")->middleware("checkedexam");
Route::post("/exam/admin/store","exam\IndexController@store")->middleware("checkedexam");
Route::get("/exam/admin","exam\IndexController@lists")->middleware("checkedexam");


Route::get("/exam/goodsa","exam\GoodsaController@index");
Route::get("/exam/goodsa/create","exam\GoodsaController@create")->middleware("checkedexam");
Route::post("/exam/goods/store","exam\GoodsaController@store")->middleware("checkedexam");


Route::get("/message/create","message\MessageController@create");
Route::post("/message/store","message\MessageController@store");
Route::get("/message/index","message\MessageController@index");
Route::post("/message/index","message\MessageController@index");
Route::post("/message/add","message\MessageController@add");