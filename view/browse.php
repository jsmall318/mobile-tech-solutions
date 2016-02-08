<?php
    /*** include the header ***/
    include '../includes/header.php';
?>

<div class="page-header">
  <h1 style="text-align:center">Phones For Sale</h1>
</div>
<DIV data-ng-app="" data-ng-controller="SearchController">
	<TABLE style="margin:auto; color:black;">
		<TR>
			<TD style="vertical-align: top; ">
				<TABLE class="list-group-item" style="background-color:white; width:300px;">
					<TR>
						<TH colspan="2" style="text-align:center; font-size:large; height:40px;">Search Criteria</TH>
					</TR>
					<TR>
						<TD style="font-weight:bold; height:30px;">Brand:</TD>
						<TD style="width:150px; text-align:center;">
							<SELECT data-ng-model="search.brand" name="searchBrand" id="searchBrand" style="color:black;" onchange="getOptions(searchModel);"></SELECT>
						</TD>
					</TR>
					<TR>
						<TD style="font-weight:bold; height:30px;">Model:</TD>
						<TD style="text-align:center;">
							<SELECT data-ng-model="search.model" name="searchModel" id="searchModel" style="color:black;" onchange="getCapAndColor();"></SELECT>
						</TD>
					</TR>
					<TR>
						<TD style="font-weight:bold; height:30px;">Storage:</TD>
						<TD style="text-align:center;">
							<SELECT data-ng-model="search.capacity" name="searchCapacity" id="searchCapacity" style="color:black;"></SELECT>
						</TD>
					</TR>
					<TR>
						<TD style="font-weight:bold; height:30px;">Color:</TD>
						<TD style="text-align:center;">
							<SELECT data-ng-model="search.color" name="searchColor" id="searchColor" style="color:black;"></SELECT>
						</TD>
					</TR>
<!--  					<TR>
						<TD style="font-weight: bold">Maximum Price (whole dollar amounts only): </TD>
						<TD style="text-align:center;">$<INPUT type="text" data-ng-model="search.price" name="maximumPrice" id="maximumPrice" size="10" maxlength="10"></INPUT>.00</TD>
					</TR>-->	
					<TR>
						<TD colspan="2" style="text-align:center;  height:40px; vertical-align: bottom;">
							<INPUT type="button" value="Reset" onclick="location.href='http://localhost/mobile-tech-solutions/browse/doBrowse.php'"/>
						</TD>
					</TR>
				</TABLE>
			</TD>
			<TD style="padding-left:25px;">
				<DIV class="list-group-item" style="background-color:white; width:650px;" data-ng-repeat="product in products | filter:{brand: search.brand, model:search.model, color:search.color, capacity:search.capacity, price: search.price}">
					<H3>
						{{product.brand + " " + product.model | uppercase}}
						<em class="pull-right">{{product.price | currency}}</em>
					</H3>
					<H3>
						<em class="pull-right">
<!-- 							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> -->
<!-- 								<input type="hidden" name="cmd" value="_s-xclick"> -->
<!-- 								<input type="hidden" name="hosted_button_id" value="BWD5GYUR43S4C"> -->
<!--								<img src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" alt="PayPal - The safer, easier way to pay online!">-->
<!-- 								<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"> -->
<!-- 								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"> -->
<!-- 							</form> -->
						</em>
					</H3>
					<DIV class="gallery" data-ng-show="product.images.length" style="width:100%; text-align:center;">
						<DIV class="img-wrap">
							<img data-ng-src="../images/{{product.images[0]}}" style="width:150px; height:150px;"/>
						</DIV>
						<ul class="img-thumbnails clearfix">
							<li class="small-image pull-left thumbnail" data-ng-repeat="image in product.images">
								<img data-ng-src="../images/{{image}}" style="width:50px; height:50px;"/>
							</li>	
						</ul>
					</DIV>
					<section>
						<ul class="nav nav-pills">
							<li data-ng-class="{active:tab === 1}">
								<a data-ng-click="tab = 1">Description</a>
							</li>
							<li data-ng-class="{active:tab === 2}">
								<a data-ng-click="tab = 2">Specifications</a>
							</li>
							<li data-ng-class="{active:tab === 3}">
								<a data-ng-click="tab = 3">Additional Comments</a>
							</li>
						</ul>
						<DIV class="panel" data-ng-show="tab === 1">
							<p>{{product.brand + " " + product.model | uppercase}}</p>
						</DIV>
						<DIV class="panel" data-ng-show="tab === 2">
							<p>Brand: {{product.brand}}</p>
							<p>Model: {{product.model}}</p>
							<p>Color: {{product.color}}</p>
							<p>Storage Capacity: {{product.capacity}}</p>
						</DIV>
						<DIV class="panel" data-ng-show="tab === 3">
							<p>{{product.comment}}</p>
						</DIV>
					</section>
				</DIV>
				<BR>
			</TD>
		</TR>
	</TABLE>
</DIV>

<SCRIPT>
	getOptions(searchBrand);
	
	function getCapAndColor(changed)
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
	    	url:'../ajax/BrowseDropDowns.php',
	    	data: { id: a, searchBrand: searchBrand, searchModel: searchModel},
	      	dataType: 'json',
	      	success: function (json ) {
	      		$(id).empty();
	      		$(id).append($('<option>').text('Please Select').attr('value', ''));
	    		$.each(json , function(i, value) {
	            	$(id).append($('<option>').text(value).attr('value', value));
	        	});
	      	},
	      	error: function () 
	      	{
		      	alert("There was an error");
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
