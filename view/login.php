<?php 
        /*** start the session ***/
        session_start();

        /*** include the header file ***/
        include 'includes/header.php';

        /*** set a form token ***/
        $_SESSION['form_token'] = md5(rand(time(), true));
?>
<form action="login_submit.php" method="post">
	<input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token'] ?>" />
	
	<div class="page-header">
		<h1 style="text-align:center">Login</h1>
	</div>
	
	<TABLE style="margin:auto; width:300px; text-align:left;">
		<TR>
			<TD colspan="2" style="width:300px; text-align:center;">
				<p>Please supply your username and password.</p>
			</TD>
		</TR>
		<TR>
			<TD colspan="2" style="text-align:center; color:red;">
				<?php echo($_GET['error'])?>
			</TD>
		</TR>
		<TR>
			<TD style="width:150px; height:40px;">
				Username:
			</TD>
			<TD style="width:150px; height:40px;">
				<input type="text" name="user_name" style="color:black;"/>
			</TD>
		</TR>
		<TR>
			<TD style="width:150px; height:40px;">
				Password:
			</TD>
			<TD style="width:150px; height:40px;">
				<input type="password" name="user_password" style="color:black;"/>
			</TD>
		</TR>
		<TR>
			<TD colspan="2" style="width:300px; text-align:center; height:40px;">
				<input type="submit" value="Login" style="color:black;"/>
			</TD>
		</TR>
		<TR>
			<TD colspan="2" style="text-align:center; height:75px; vertical-align:bottom; font-size:11px;">
				If You Do Not Already Have an Account
				<a href="adduser.php">Create An Account</a>
			</TD>
		</TR>
	</TABLE>
</form>