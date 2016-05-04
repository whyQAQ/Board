<?php 
	if(isset($_POST['data'])){
		$json = $_POST['data'];
		$id_data = json_decode($json,true);
		$id = $id_data['id'];
	}
	
	$con = mysql_connect("localhost","root","");
	if (!$con)
  	{
  	die('Could not connect: ' . mysql_error());
  	}

	mysql_select_db("PhpBoard", $con);

	mysql_query("DELETE FROM my_board WHERE BoardID = {$id}");

	mysql_close($con);

    