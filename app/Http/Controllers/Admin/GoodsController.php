<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Category;
use Illuminate\Support\Facades\Cache;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Cache::get("data");
       // dd($data);
        if(!$data){
            echo "db====";
            $goods=Goods::get();
            $data=Goods:: join("brand","goods.brand_id","=","brand.brand_id")
                ->join("category","goods.cate_id","=","category.cate_id")
                ->paginate(5);
           Cache::put('data', $data,20);
              //  dd($goodsInfo);
           //exit;
            }
            foreach($data as $k=>$v){
                $data[$k]['goods_imgs']=explode('|',$v['goods_imgs']);
            }
         
        return view("admin.goods.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //查询品牌数据
        $brandInfo=Brand::get();

        // //查询分类数据
        $cateInfo=Category::get();

        $cateInfo=getCateInfo($cateInfo);

        return view("admin.goods.create",['brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo]);
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
        if($request->hasFile('goods_img')){
              $data['goods_img']=$this->upload('goods_img');
        }
         if($request->hasFile('goods_imgs')){
            $file=$data['goods_imgs'];
              $data['goods_imgs']=$this->uploadd($file);
        }
        // dump($data);
        
        $res=Goods::create($data);

        if($res){
            return redirect("goods/index");
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
        $data=Goods:: join("brand","goods.brand_id","=","brand.brand_id")
            ->join("category","goods.cate_id","=","category.cate_id")
            ->paginate(5);
            dd($data);
        return view("admin.brand.edit",['data'=>$data]);
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
     $res=Goods::destroy($id);
      if($res){
         return redirect('/goods/index');
      }

    }
     public function upload($fielname){
       if (request()->file($fielname)->isValid()) {
        $photo = request()->file($fielname);
        $store_result = $photo->store('photo');
        return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
    public function uploadd($filename){
        static $info='';
        foreach($filename as $k=>$v){
            if ($filename[$k]->isValid()) {
            $photo = $filename[$k];
            $info.=$photo->store('photo').'|';

        }else{
            exit('未获取到上传文件或上传过程出错');
        }
        }
        $info=rtrim($info,'|');
        return $info;
    }
}
