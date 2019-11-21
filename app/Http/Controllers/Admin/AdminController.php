<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $admin_account=request()->admin_account;
        $where=[];
        if($admin_account){
            $where[]=['admin_account','like',"%$admin_account%"];
        }
       $query=request()->all();
       $data=Admin::where($where)->paginate(3);
        return view("admin.admin.index",['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'admin_account' => 'required|unique:admin',
                'admin_pwd' => 'required',
            ],[
                'admin_account.required'=>'管理员必填',
                 'admin_account.unique'=>'管理员已存在',
                'admin_pwd.required'=>'密码必填'
            ]);
            $data=$request->except('_token');
            $admin=Admin::create($data);
            //dd($admin);
            if($admin){
                return redirect("admin/index");
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
        $data=Admin::where('admin_id',$id)->first();
        return view("admin.admin.edit",['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(\App\Http\Requests\StoreAdminPost $request, $id)
    {
        if(!$id){
            abort($id);
        }
        $data=$request->except('_token');
        $res=Admin::where("admin_id",$id)->update($data);
        return redirect("admin/index");
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
       $res=Admin::destroy($id);
       //dd($res);
       if($res){
            return redirect("admin/index");
       }

    }
}
