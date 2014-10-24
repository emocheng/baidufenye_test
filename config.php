<?php
$config = array(
	"host"=>"localhost",
	"db_name"=>"root",
	"db_paswd"=>"root",
	"page_row"=>10
	);

$con = mysql_connect($config['host'],$config['db_name'],$config['db_paswd']);
if(!$con){
	error("对不起，无法连接数据库");
}
mysql_query("set names utf8");
mysql_select_db('fenye');

function dump($array){
	echo"<pre>";
	print_r($array);
	echo"</pre>";
}

//循环读出数据库所有数据
function fetch_all($sql){
    $result = mysql_query($sql);
    $array = array();
    while($row = mysql_fetch_array($result)){
        $array[] = $row;
    }

    return $array;
}

//查询数据库所有内容条目
function num($sql){
	$result = mysql_query($sql);
	$row = mysql_num_rows($result);

	return $row;
}



//分页算法
function math($p){
    //总共要分多少页
    $page_num = 10;

//一共多少篇文章
    $page_sum = num("select * from text");

//每页显示的数目
    $page_one_num = ceil($page_sum/$page_num);

//定义一个空字符串，用于接收页面信息
    $page = "";
    //当当前页不在第一页时，出现上一页标签
    if($p!=1){
        $page.="<a href=index.php?p=".($p-1)."><上一页</a>&nbsp;";
    }


    //当前页前面的部分。
    if($p>5){
        for($i=$p-5;$i<$p;$i++){
            $page.="<a href=index.php?p=".$i.">".$i."</a>&nbsp;";
        }
    }else{
        for($i=1;$i<$p;$i++){
            $page.="<a href=index.php?p=".$i.">".$i."</a>&nbsp;";
        }
    }
    //当前页，不能点击
    $page.="<a href='javascript:void 0;' style=color:red;>".$p."</a>&nbsp;";

    //当前页后面的部分
    if($p<5){
        for($i=$p+1;$i<=$page_num;$i++){
            $page.="<a href=index.php?p=".$i.">".$i."</a>&nbsp;";
        }
    }else{

        if($p<=$page_one_num-4){
            for($i=$p+1;$i<=$p+4;$i++){
                $page.="<a href=index.php?p=".$i.">".$i."</a>&nbsp;";
            }
        }else{
            for($i=$p+1;$i<=$page_one_num;$i++){
                $page.="<a href=index.php?p=".$i.">".$i."</a>&nbsp;";
            }
        }
    }
    if($p!=$page_one_num){
        $page.="<a href=index.php?p=".($p+1).">下一页</a>&nbsp;";
    }
    return $page;

}


