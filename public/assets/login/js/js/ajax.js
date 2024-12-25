$(document).ready(function() {
	var xmlhttp=null;
	$('.ajax_help').mouseover(function(){
			str = $(this).attr('id');
		
		
		if (str.length==0)
	  	{
			document.getElementById(str).setAttribute('title','');
			return;
		}
		
		if (window.XMLHttpRequest)
		{
		  // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest(); 
		}
		else
		{
		  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		var currentLocation = String(window.location);
		var containstring = currentLocation.search("summary");
		if(containstring!=-1)
		{
			var url="ajaxrequestforhelp.php?q=" + str;
		}
		else
		{
			var url="../ajaxrequestforhelp.php?q=" + str;
		}
		
		
	//url=url+"&sid="+Math.random();
		xmlhttp.open("GET",url,false);
		xmlhttp.send(null);
		
		document.getElementById(str).setAttribute('title',xmlhttp.responseText);
	});});

function popitup(url) {
 newwindow=window.open(url,'name','width=650,height=640,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=800,top=20');
 if (window.focus) {newwindow.focus()}
 return false;}

function removeParam(parameter){
  	var url=document.location.href;
  	var urlparts= url.split('?');

	if (urlparts.length>=2)
	{
		var urlBase=urlparts.shift(); 
		var queryString=urlparts.join("?"); 
		
		var prefix = encodeURIComponent(parameter)+'=';
		var pars = queryString.split(/[&;]/g);
		for (var i= pars.length; i-->0;)               
		  if (pars[i].lastIndexOf(prefix, 0)!==-1)   
			  pars.splice(i, 1);
		url = urlBase+'?'+pars.join('&');
	}
	return url;}

$(document).ready(function() {
	var xmlhttp=null;
	$('#kpi_subcategory_id').change(function(){
		
		str = $(this).val();
		relationship_id = $("#relationship_id").val();
		type = $("#type").val();
		
		if (str.length==0)
	  	{
			document.getElementById(str).setAttribute('title','');
			return;
		}
		
		if (window.XMLHttpRequest)
		{
		  // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest(); 
		}
		else
		{
		  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		var url="../pms/ajax.php?q=" + str + "&relationship_id=" + relationship_id + "&type=" + type;
		
		xmlhttp.open("GET",url,false);
		xmlhttp.send(null);
		
		$("#show_kpi").html(xmlhttp.responseText); 
		
		
	});});

$(document).ready(function() { 
	// $('input[type=submit]').click(function(){
	$('.ajax_submit').click(function(){
		
		var url1 = document.URL;
		
		var url2 = url1.split('?');
		
		var url = url2[0];
		
		if(typeof url2[1] != 'undefined')
		{
			var url3 = url2[1].split('&');
			
			var url3Val = url3[0].search("chap_id");
			
			if(url3Val!=-1)
			{
				var url = url+'?'+url3[0];
			}
			
				
			if(typeof url3[1] != 'undefined')
			{
				var url3ValPP = url3[1].search("pp");
				if(url3ValPP!=-1)
				{
					var url = url+'&'+url3[1];
				}
			}
		}
		
		var id = $(this).closest('form').attr('id');
		
		if(typeof CKEDITOR != 'undefined')
		{
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
		}
		
		var currentLocation = String(window.location);
		
		var containstringforindworksheet = currentLocation.search("pmindworksheet.php");
		if(containstringforindworksheet!=-1)
		{
			url = window.location;
		}
		
		var image='<img src="../images/loading.gif" />';
		var ajaxfile = 'ajax.php';
			
		var containstring = currentLocation.search("summary");
		if(containstring!=-1)
		{
			var image='<img src="images/loading.gif" />';
			
			var containstringrm = currentLocation.search("rmpriority_id");
			if(containstringrm!=-1)
			{
				var ajaxfile='rm/ajax.php';
			}
		}
		
		
		$.ajax({
		type: "POST",
		url: ajaxfile,
		data: $("#"+id).serialize(),
		beforeSend: function(){
			$('#result_'+id).html(image);
		},
		success: function(data){
			
			var n = data.search("Error"); 
			if(n==0)
			{
				$('#result_'+id).html(data).css('color','red');
			}
			else
			{
				/*$('#result_'+id).html(data).css('color','green');
				window.setTimeout(function(){location.reload()},2000);*/
				
				window.location.href = url;
				
			}
			 
		}
	});
	});});

$(document).ready(function() {
	var xmlhttp=null;
	$('.change_vis_id').change(function(){
		
		var str = $('.change_vis_id').val();
		
		if (str.length==0)
	  	{
			return false;
		}
		
		if (window.XMLHttpRequest)
		{
		  // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest(); 
		}
		else
		{
		  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		var currentLocation = String(window.location);
		var containstring = currentLocation.search("summary");
		if(containstring!=-1)
		{
			var url="ajax.php?visitor_id=" + str;
		}
		else
		{
			var url="../ajax.php?visitor_id=" + str;
		}
		
		xmlhttp.open("GET",url,false);
		xmlhttp.send(null);
		visitor_type = xmlhttp.responseText;
		if(visitor_type==2)
		{
			$('#access_yes').attr('disabled','disabled');
		}
		else
		{
			$('#access_yes').removeAttr('disabled');
		}
		
		
		
	});});


$(document).ready(function() {
	$('.group_by').click(function() {
		$("#default_form").submit();
    });
});