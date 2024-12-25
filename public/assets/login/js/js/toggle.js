/*** Document Ready Functions ***/
jQuery(document).ready(function(){

/*** Side Panel Functions ***/
$(".panel-icon").click(function(){
	$(".side-panel").toggleClass("show");
});	


$(".boxed-style").click( function(){
	$(".theme-layout").addClass("boxed");
	$("body").addClass('bg-body1');
});

});		