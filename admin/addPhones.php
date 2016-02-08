<?php

    /*** include the header ***/
    include 'header.php';
?>

<div class="page-header">
  <h1 style="text-align:center">Add Phones</h1>
</div>

<form action="addPhones_submit.php" enctype="multipart/form-data" method="post">
	<TABLE style="text-align:left; width:800px; margin:auto;">
		<TR>
			<TD style="font-weight: bold; width:300px;">Brand:</TD>
			<TD style="width:500px;">
				<SELECT name="brand" id="brand" style="color:black;">
					<OPTION value="select one">Select One</OPTION>
					<OPTION value="apple">Apple</OPTION>
					<OPTION value="samsung">Samsung</OPTION>
					<OPTION value="lg">LG</OPTION>
				</SELECT>
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold">Model:</TD>
			<TD style="width:500px;">
				<INPUT type="text" name="model" id="model" style="color:black;" size="20"/>
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold">Storage Capacity:</TD>
			<TD style="width:500px;">
				<INPUT type="text" name="capacity" id="capacity" style="color:black;" size="3"/>GB
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold">Color:</TD>
			<TD style="width:500px;">
				<INPUT type="text" name="color" id="color" style="color:black;" size="15"/>
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold">Price: (Full Dollar Amount)</TD>
			<TD style="width:500px;">
				<INPUT type="text" name="price" id="price" style="color:black;" size="3"/>
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold; vertical-align: text-top;">Other Information/Comments:</TD>
			<TD>
				<textarea name="comment" maxlength="500" rows="4" cols="50" style="color:black;">Enter text here...</textarea>
			</TD>
		</TR>
		<TR>
			<TD colspan="2">
				Select image to upload:
			    <input type="file" name="fileToUpload" id="fileToUpload">
			</TD>
		</TR>
		<TR>
			<TD colspan="2" style="text-align:center;  height:40px; vertical-align: bottom;">
				<INPUT type="submit" value="Add Phone" style="color:black"/>
			</TD>
		</TR>
	</TABLE>
</form>





