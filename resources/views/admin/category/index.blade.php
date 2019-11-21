
    <div class="btn btn-primary">
        <div class="row">


            <div class="col-xs-12">

                <div class  ="btn btn-primary">
        {{session('msg')}}
                    <table id="sample-table-1" border="2">
                        <thead>
                            <tr>
                                <th>分类id</th>
                                <th>分类名称</th>
                                <th>是否展示</th>
                                <th>是否在导航栏展示</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        	@foreach ($data as $v)
                            <tr style="display: none;" parent_id="{{$v['parent_id']}}" cate_id="{{$v['cate_id']}}">
                                <td>
                                    {{str_repeat('——',$v['level'])}}
                                    <a href="javascript:;" class="flag">+</a>
                                    {{$v['cate_id']}}
                                </td>
                                <td field="cate_name">
                                    {{str_repeat('——',$v['level'])}}
                                    <span class="span_test">{{$v['cate_name']}}</span>
                                    <input type="text" value="{{$v['cate_name']}}" class="changeValue" style="display: none;">

                                </td>
                                <td>
                                	@php $i=1 @endphp 
                                	<!-- @if($i%2==0)  class="success" @else class="danger" @endif -->
                                   @if($v['cate_show']==1) √ @else × @endif
                                </td>
                                <td>@if($v['cate_nav_show']==1) √ @else × @endif
                                </td>
                                <td>
                                   <a href="{{url('category/edit/'.$v['cate_id'])}}" class="btn btn-danger">修改</a> 
                                   <a href="{{url('category/delete/'.$v['cate_id'])}}" class="btn btn-danger">删除</a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


<script src="/static/admin/js/jquery.js"></script>
<script>
 //页面一加载
   $("tr[parent_id='0']").show();
   // aa=$("#parent_id");
   // console.log(aa);
    //点击符号
    $(".flag").click(function(){
        var _this=$(this);//当前点击的超链接
        var cate_id=_this.parents("tr").attr('cate_id');//获取当前点击的分类id

        var flag=_this.text();//获取当前符号
        var _child=$("tr[parent_id='"+cate_id+"']");
        if(flag=='+'){
            if( _child.length>0){
                _child.show();//给当前分类下子类做显示
                _this.text('-');
            }
        }else{
            _child.hide();//给当前分类下子类做隐藏
            _this.text('+');
        }
    });


   
</script>