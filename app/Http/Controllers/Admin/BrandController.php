<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user =Auth::user();  
        // $id =Auth::id();
        // dd($id);
         // session的使用
       // 设置session
        //session(['user'=>'zhangsan']);
       // request()->session()->put('username', 'lisi');
        
       //获取
      // echo session('user');
        // echo session('username');
       // echo request()->session()->get('username');
        //删除
        // dd(session(['user'=>null]));
        // echo request()->session()->pull('username');//先获取再删除
         
       // request()->session()->forget('user');//删除单个
          // request()->session()->flush();//删除所有
          // dump(session('user'));
          // dd(session('username'));
// --------------------------------------------------------
             //DB ----!!!
             //$data=Db::table('brand')->get();
          //   exit;
       //ORM ----!!!!
       //全局分页
       
        // $page=request()->page;
        //dd($page);
        //取值
        $query=request()->all();
        $page=request()->page??1;
        $brand_name=request()->brand_name??'';
     
        // dd($query)  ;
      //  echo "data_".$page.'_'.$brand_name;
        // $data=Cache::get("data_".$page.'_'.$brand_name);
       // dd($data);
        $data=Redis::get("data_".$page."_".$brand_name);
       // dump($data);
        if(!$data){
          echo "dd---==";
          $pageSize=config("app.pageSize");
          $brand_name=request()->brand_name;
          $where = [];
          if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
          }
        // DB::connection()->enableQueryLog();
        //分页数据
        // if(!$data){
        //       echo "db";
             $data=Brand::where($where)->paginate($pageSize);
             // Cache::put('data_'.$page.'_'.$brand_name, $data,20);
             // cache(['data'.$page=>$data],60*1);
             $data=serialize($data);
             Redis::setex("data_".$page."_".$brand_name,2,$data);
        }
      // }
          $data=unserialize($data);
         
        //  $logs = DB::getQueryLog();
        // dump($logs);
        // dd($data);
        return view('admin.brand.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *显示添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view("admin.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      //第二种 创建 验证器 php artisan make:request StoreBlogPost ！——！——！  //第二种 创建 验证器 php artisan make:request StoreBlogPost Request换验证器
       //第二种 
    // public function store(\App\Http\Requests\StoreBrandPost $request)
     public function store(Request $request)
    {
      //第一种 验证 ！——————！——！——！——！——！
       // $validatedData = $request->validate([
       //  //brand 表名 验证必填
       //  'brand_name' => 'required|unique:brand',
       //  'brand_url' => 'required',
       //  ],[
       //    'brand_name.required'=>'品牌名称必填',
       //    'brand_name.unique'=>'品牌名称已存在',
       //    'brand_url.required'=>'品牌名称必填',
       //  ]);
    
        //Db类 ------  ！！！！！
        //接收排除字段
       $data=$request->except('_token');
       //第三种 接收值下面 手动创建验证器
       //$request->all() 表示值 替换自己接的 
       //找不到类'App \ Http \ Controllers \ Admin \ Validator'报错找不到 加一个\
       $validator = \Validator::make($data,[
             'brand_name' => 'required|alpha_dash|unique:brand',
             'brand_url' => 'required',
          ],[
             'brand_name.required'=>'品牌名称必填',
             'brand_name.unique'=>'品牌名称已存在',
             'brand_url.required'=>'品牌名称必填',
             'brand_name.alpha_dash'=>'品牌名称必须是字母或数字、下划线',
          ]);
       //有错误就跳转
          if ($validator->fails()) {
          return redirect('brand/create')
            ->withErrors($validator)
            ->withInput();
         }



      // dd($data);
       // 只接受这个字段
        if($request->hasFile('brand_logo')){
              $data['brand_logo']=$this->upload('brand_logo');
        }
       // dd($data);

       //  $data=$request->only('brand_name');
       // // unset($data['_token']);
       //  $res=DB::table('brand')->insert($data);
       //  dd($data);
       
       //ORM ------添加 @！！！！
       $brand=Brand::create($data);
       // echo $brand->brand_id;
      // dd($res);
        
      // $brand=new Brand;
      // $brand->brand_name=$post['brand_name'];
      // $brand->brand_logo=$post['brand_logo'];
      // $brand->brand_url=$post['brand_url'];
      // $brand->brand_desc=$post['brand_desc'];
      // $res=$brand->save();
      //  var_dump($res);
      
      if($brand->brand_id){
        return redirect('/brand/index');
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
        $data=Brand::where("brand_id",$id)->first();
        return view("admin.brand.edit",['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\StoreBrandPost $request,$id)
    {
       if(!$id){
         abort($id);
       }
       $data=$request->except('_token');
       if($request->hasFile('brand_logo')){
              $data['brand_logo']=$this->upload('brand_logo');
        }
        $data=Brand::where('brand_id',$id)->update($data);
        return redirect("/brand/index");
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
      //DB 删除
      //$res=DB::table('brand')->where('brand_id',$id)->delete();
      //ORM 删除
      $res=Brand::destroy($id);
      if($res){
         return redirect('/brand/index');
      }
      //dd($res);
    }

    public function upload($fielname){
       if (request()->file($fielname)->isValid()) {
        $photo = request()->file($fielname);
        $store_result = $photo->store('photo');
        return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
    public function checkedOnly(){
      $brand_name=request()->brand_name;
      $count=Brand::where("brand_name",$brand_name)->count();
      echo $count;
    }
}
