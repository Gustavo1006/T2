$(document).ready(function(){
   $(".B").click(function(){ 
	  dir = $(this).attr("name");
	  id = $(this).attr("id");
      $('#cont_der').load("content/" + dir);
   });				   
});