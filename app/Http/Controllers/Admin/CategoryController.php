<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data=Category::get()->toArray();

         $data=getCateInfo($data);
        // dd($data);
         return view("admin.category.index",["data"=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       $data=Category::get();
       $cateInfo=getCateInfo($data);

       //dd($data);
       return view("admin.category.create",['cateInfo'=>$cateInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        $res=Category::create($data);
        if ($res) {
           return redirect("category/index");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$id){
            abort($id);
        }
        $category=Category::get();
        
        $info=$category->where("cate_id",$id)->first();
        $cateInfo=Category::get();
        $cateInfo=getCateInfo($cateInfo);
        return view("admin.category.edit",['info'=>$info,'cateInfo'=>$cateInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$id){
            abort($id);
        }
        $data=$request->except("_token");
        $res=Category::where("cate_id",$id)->update($data);
        return redirect("category/index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$id){
            abort($id);
        }
       $category=Category::get();
       $count=$category->where("parent_id",$id)->count();
        if($count>0){
            return redirect("category/index")->with('msg',"此分类下有子类或商品，不能删除");
        }
        $res=Category::destroy($id);
        if($res){
            return redirect("category/index")->with("msg","删除成功");
        }
    }
}
