<?php
/*** start the session ***/
session_start();

/*** include the header file ***/
include 'includes/header.php';

/*** set a form token ***/
$_SESSION['form_token'] = md5(rand(time(), true));

?>

<div class="page-header">
  	BRAND:<SELECT name="searchBrand" id="searchBrand" style="color:black;" onchange="getOptions(searchModel);"></SELECT>
  	<BR>
  	MODEL:<SELECT name="searchModel" id="searchModel" style="color:black;" onchange="getCapAndColor();"></SELECT>
  	<BR>
  	STORAGE CAPACITY:<SELECT name="searchCapacity" id="searchCapacity" style="color:black;"></SELECT>
  	<BR>
  	COLOR:<SELECT name="searchColor" id="searchColor" style="color:black;"></SELECT>
</div>

<SCRIPT>

getOptions(searchBrand);

function getCapAndColor()
{
	getOptions(searchCapacity);
	getOptions(searchColor);
}

function getOptions(id) 
{
	var a = $(id).attr('id');
	var searchBrand = $('#searchBrand').val()==null?"":$('#searchBrand').val();
	var searchModel = $('#searchModel').val()==null?"":$('#searchModel').val();
	
	$.ajax({
    	url:'ajax.php',
    	data: { id: a, searchBrand: searchBrand, searchModel: searchModel},
      	dataType: 'json',
      	success: function (json ) {
      		$(id).empty();
      		$(id).append($('<option>').text('Please Select').attr('value', ''));
    		$.each(json , function(i, value) {
            	$(id).append($('<option>').text(value).attr('value', value));
        	});
      	},
      	error: function () {
      		$(id).empty();
      		$(id).append($('<option>').text('Please Select').attr('value', ''));
      	}
	});

	if('searchBrand' == a)
	{
		$('#searchModel').empty();
  		$('#searchModel').append($('<option>').text('Please Select').attr('value', ''));
  		$('#searchCapacity').empty();
  		$('#searchCapacity').append($('<option>').text('Please Select').attr('value', ''));
  		$('#searchColor').empty();
  		$('#searchColor').append($('<option>').text('Please Select').attr('value', ''));
	}
	else if('searchModel' == a)
	{
		$('#searchCapacity').empty();
  		$('#searchCapacity').append($('<option>').text('Please Select').attr('value', ''));
  		$('#searchColor').empty();
  		$('#searchColor').append($('<option>').text('Please Select').attr('value', ''));
	}
}

</SCRIPT>