
"use strict";

var HOST = "Board.php";
var HOST_DEL = "delete.php";

function click(){
	$("#submit").click(function(event){
		event.preventDefault();

		var msg = $("#messages").val();
		// console.log(msg);
		var json = JSON.stringify({msg:msg});

		$.post(HOST,{data : json}, function(){
			render();
		});
	});
}

function render(){
	$.get(HOST,function(json_arr){
		var obj = JSON.parse(json_arr);

		var list=[];

		var j = 0;

   	 	for (var i in obj) {
   	 		list[j] = "<li class='content col-md-3 panel panel-info'><div  class='panel-body'>" + obj[i] + "</div><a id=" + i + " class='glyphicon glyphicon-remove right' href = '#' onclick='del(" + i + ");'></a></div></li>";
      		j++;
      	}
		$("#list").html(list);
	});
}

function del(id){
	var json = JSON.stringify({id:id});
	
	$.post(HOST_DEL,{data:json},function(){
		render();
	});
}

$(document).ready(function(){
	render();
	click();
});