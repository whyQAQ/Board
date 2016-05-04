<?php
	//把收到的 json 数据解析成数组
	if(isset($_POST['data'])){
		$json = $_POST['data'];
		$data = json_decode($json,true);
		$msg = $data['msg'];
	}
	
	$arr = [];

	$con = mysql_connect("localhost:3306","root","");
	if (!$con){
  		die('Could not connect: ' . mysql_error());
  	}
  	
  	//	mysql_query("CREATE DATABASE PhpBoard",$con);
  	
  	mysql_select_db("PhpBoard",$con);
  	
  	// 	mysql_query("CREATE TABLE my_board(
  	// 		BoardID int NOT NULL AUTO_INCREMENT,
  	// 		ID varchar(15),
	//		content text(200),
  	// 		PRIMARY KEY(BoardID))",$con);
  	
  	//把接收到的 msg 插入数据库
  	if(isset($msg)){
		mysql_query("INSERT INTO my_board (content)
		VALUES('{$msg}')",$con);
	}

	$result = mysql_query("SELECT * FROM my_board");

	//把数据库的数据储存到 arr 数组中
	while($row = mysql_fetch_array($result)){
        $content = $row['content'];
        $id = $row['BoardID'];
        $arr[$id] =  htmlspecialchars($content); 
        //"<li>"."<div>".htmlspecialchars($content)."<a href=\"delete.php?id=$id\">删除</a>"."</div>"."</li>"."<br/>";
    } 

    //把 arr 数组解析成 json 格式
   	$json_arr =  json_encode($arr);
   	//输出 json 
   	echo $json_arr;
	mysql_close($con);
	//Header("Location: index.php");

