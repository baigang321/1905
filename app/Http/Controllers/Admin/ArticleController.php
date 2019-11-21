<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Classification;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $query=request()->all();
        $title=request()->title;
         $c_name=request()->c_name;
        $classification=Classification::get();
        $where=[];
        if($title){
            $where[]=['title','like',"%$title%"];
        }
        if($c_name){
            $where[]=['c_name','=',$c_name];
        }
        $data=Article::join('classification','article.c_id','=','classification.c_id')->where($where)->paginate(3);
        return view("admin.article.index",['data'=>$data,'query'=>$query,'classification'=>$classification]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classification=Classification::get();
        //dd($classification);
       return  view("admin.article.create",['classification'=>$classification]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data=$request->except("_token");
        $validatedData = $request->validate([
            'title' => 'required|unique:article',
            'c_id' => 'required',
            'importance'=>'required'
            ],[
            'title.required'=>'标题必填',
            'title.unique'=>'标题已存在',
            'c_id.required'=>'文章分类标题必填',
            'importance.required'=>'文章重要性必填',
            ]);
        if($request->hasFile('files')){
              $data['files']=$this->upload('files');
        }
        //dd($data);
        $res=Article::create($data);
       // dd($res);
        if($res){
            return redirect("article/index");
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
         
        $classification=Classification::get();
        $data=Article::where("id",$id)->first();
        return view("admin.article/edit",['data'=>$data,'classification'=>$classification]);
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

      echo $id;
         $validatedData = request()->validate([
            'title' => 'required|unique:article',
            'c_id' => 'required',
            'importance'=>'required',
             'title' => [
              'required',
              Rule::unique('article')->ignore(request()->title,'title'),
             ],
            ],[
            'title.required'=>'标题必填',
            'title.unique'=>'标题已存在',
            'c_id.required'=>'文章分类标题必填',
            'importance.required'=>'文章重要性必填',
            ]);

        $data=$request->except("_token");
       
         if($request->hasFile('files')){
              $data['files']=$this->upload('files');
        }
        $res=Article::where("id",$id)->update($data);
         return redirect("article/index");
        // if($res===false){
           
        // }else{
        //     echo 111;
        // }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      $id=request()->id;
       $res= Article::where("id",$id)->delete();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
     public function upload($files)
     {
        if (request()->file($files)->isValid()) {
                $photo =request()->file($files);
                $store_result = $photo->store('photo');
                return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
     }
     public function changValue(){
        $title=request()->title;
        $count=Article::where("title",$title)->count();
        echo $count;
     }
}
