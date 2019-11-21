<?php 

function getCateInfo($cateInfo,$parent_id=0,$level=1){
    static $info=[];
    foreach($cateInfo as $k=>$v){
        if($v['parent_id']==$parent_id){
            $v['level']=$level;
            $info[]=$v;// 1 2 3 4 5 6 7 8 9
            getCateInfo($cateInfo,$v['cate_id'],$level+1);
        }
    }
    return $info;
}
  
 ?>