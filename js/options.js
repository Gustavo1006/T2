$(document).ready(function(){ 
   $("#VOLVER").click(function(){
	  l = $(this).attr("name");	
	  $('#cont_der').load("content/" + l);
   });
   $("#ADD").click(function(){
	  l = $(this).attr("name");	
	  $('#cont_der').load("content/" + l);
   });
   $(".EDIT").click(function(){ 
	  d = $(this).attr("name");
	  id = $(this).attr("id");
	  $('#cont_der').load("content/" + d + "?id=" + id);
   });
   $(".DEL").click(function(){
	  /*if($("#DIR").html()=="") {
	     d = "content/" + $(this).attr("name") + "_adm.php";	
	  } else {
		 d = "content/" + $("#DIR").html();
	  }*/
	  var d = $(this).attr("name");	
	  var cat = $("#DIR").html();
	  var id = $(this).attr("id");
	  var enl = $(this).attr("rel");
	  if(confirm("Esta seguro que desea ELIMINARLO?")) {
		  //$('#cont_der').load("content/" + d + "_adm.php" + enl);
		  $.ajax({
			 type: "POST",
			 url: "functions/delete.php",
			 data: 'OP=' + d + '&ID=' + id
		  });
		  //document.location=enl;
		  //$('#cont_der').load("layouts/load.php");
		  /*if(enl=="" | enl=="undefined" | enl==undefined){
		  	$('#cont_der').load("content/" + d + "_adm.php");
		  } else {
			$('#cont_der').load("content/" + enl);
		  }*/
	  }
   });
   $("#MOD").click(function(){
       var id = $("#ID").val();
	   var mar = $("#MAR").val();
	   var cat = $("#CAT").val();
	   var subc = $("#SUB").val(); 
	   var op = $(this).attr("name");
	   $('#cont_der').load("content/fotos_edit.php?id=" + id + "&op=" + op + "&MAR=" + mar + "&CAT=" + cat + "&SUB=" + subc);
   });
   $(".LIST").click(function(){
	   dir = $(this).attr("id");
	   $('#cont_der').load("content/" + dir);
   });
});