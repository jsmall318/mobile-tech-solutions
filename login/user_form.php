<h2><?php echo isset($heading) ? $heading : ''; ?></h2>
<form action="<?php echo isset($form_action) ? $form_action : ''; ?>" method="post">
	<div class="page-header">
		<h1 style="text-align:center">Register</h1>
	</div>
	
	<TABLE style="margin:auto; width:300px;">
		<TR>
			<TD style="width:150px; height:40px;">
				<label for="user_name">Username:</label>
			</TD>
			<TD style="width:150px; height:40px;">
				<input type="text" id="user_name" style="color:black;" name="user_name" value="<?php echo isset($user_name) ? $user_name : ''; ?>" maxlength="20" />
			</TD>
		</TR>
	
		<TR>
			<TD style="width:150px; height:40px;">
				<label for="blog_password">Password:</label>
			</TD>
			<TD style="width:150px; height:40px;">
				<input type="password" style="color:black;" id="user_password" name="user_password" maxlength="20" />
			</TD>
		</TR>
	
		<TR>
			<TD style="width:150px; height:40px;">
				<label for="blog_password2">Confirm Password:</label>
			</TD>
			<TD style="width:150px; height:40px;">
				<input type="password" style="color:black;" id="user_password2" name="user_password2" maxlength="20" />
			</TD>
		</TR>
		
		<TR>
			<TD style="width:150px; height:40px;">
				<label for="blog_user_email">Email Address:</label>
			</TD>
			<TD style="width:150px; height:40px;">
				<input type="text" id="user_email" style="color:black;" name="user_email" value="<?php echo isset($user_email) ? $user_email : ''; ?>" maxlength="254" />
			</TD>
		</TR>
		
		<TR style="width:150px; height:40px;">
			<TD  colspan="2" style="width:300px; text-align:center;">
				<input type="hidden" name="form_token" value="<?php echo isset($form_token) ? $form_token : ''; ?>" />
				<input type="submit" style="color:black;" value="<?php echo isset($submit_value) ? $submit_value : 'Submit'; ?>" />
			</TD>
		</TR>
	</TABLE>
</form>
