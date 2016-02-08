<?php

    /*** include the header ***/
    include '../includes/header.php';
?>

<div class="page-header">
  <h1 style="text-align:center">
  	<?php 
  		if ($_GET['page'] == 'REPAIR')
  			echo('Get A Repair Quote');
  		else if ($_GET['page'] == 'BUY')
  			echo('Get A Quote For your Old Phone');
  	?>
  </h1>
</div>

<form action="../quotes/doQuote.php" enctype="multipart/form-data" method="post">
	<INPUT type="hidden" name="page" value="<?php echo($_GET['page']); ?>"/>
	<TABLE style="text-align:left; width:800px; margin:auto;">
		<TR>
			<TD style="font-weight: bold; width:300px;">Name:</TD>
			<TD style="width:500px;">
				<INPUT type="text" name="name" id="name" style="color:black;" size="50"/>
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold; width:300px;">Email:</TD>
			<TD style="width:500px;">
				<INPUT type="text" name="email" id="email" style="color:black;" size="60"/>
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold; width:300px;">Phone Number:</TD>
			<TD style="width:500px;">
				<INPUT type="text" name="phoneNumber" id="phoneNumber" style="color:black;" size="9"/>
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold; width:300px;">How do you prefer to be contacted:</TD>
			<TD style="width:500px;">
				<SELECT name="contactBy" id="contactBy" style="color:black;">
					<OPTION value="select one">Select One</OPTION>
					<OPTION value="email">Email</OPTION>
					<OPTION value="text">Text Message</OPTION>
					<OPTION value="call">Phone Call</OPTION>
				</SELECT>
			</TD>
		</TR>
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
				<INPUT type="text" name="storageCap" id="storageCap" style="color:black;" size="3"/>GB
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold">Color:</TD>
			<TD style="width:500px;">
				<INPUT type="text" name="color" id="color" style="color:black;" size="15"/>
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold; vertical-align: text-top;">Check All That Apply:</TD>
			<TD>
				<input type="checkbox" name="waterDamage" value="Y">Water Damage<br>
				<input type="checkbox" name="brokenScreen" value="Y">Broken Screen<br>
				<input type="checkbox" name="brokenBack" value="Y">Broken Back<br>
				<input type="checkbox" name="mic" value="Y">Microphone<br>
				<input type="checkbox" name="speaker" value="Y">Speaker<br>
				<input type="checkbox" name="chargePort" value="Y">Charging Port<br>
				<input type="checkbox" name="colorChange" value="Y">Change Screen/Back Color
			</TD>
		</TR>
		<TR>
			<TD style="font-weight: bold; vertical-align: text-top;">Other Information/Questions:</TD>
			<TD>
				<textarea name="comments" maxlength="500" rows="4" cols="50" style="color:black;">Enter text here...</textarea>
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
				<INPUT type="submit" value="Request Quote" style="color:black"/>
			</TD>
		</TR>
	</TABLE>
</form>
