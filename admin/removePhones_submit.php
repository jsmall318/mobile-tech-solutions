<?php
	/*** set a form token ***/
	$_SESSION['form_token'] = md5(rand(time(), true));
	
	/*** if we are here, include the db connection ***/
	include '../includes/conn.php';
	
	/*** connect to the database ***/
	$con = mysqli_connect($hostname, $username, $password, $db);

	$productId = $_POST["phoneToRemove"];
	
	$sql = "INSERT INTO db1.sold_products (product_id,brand,model,capacity,color,price,comment) SELECT * FROM db1.products WHERE product_id=$productId;";
	
	$result = mysqli_query($con, $sql);

	if($con->affected_rows > 0)
	{
		$sql = "DELETE FROM db1.products WHERE product_id=$productId;";
		$result = mysqli_query($con, $sql);
		if($con->affected_rows > 0)
		{
			$message = $con->affected_rows." Phone Successfully Removed.";
		}
		else{
			$message = "Error the Phone was not Remmoved.";
		}
	} else {
		$message = "Error the Phone was not Remmoved.";
	}
	
	/*** redirect ***/
	header("Location: removePhones.php?submitMessage=$message");
	
	
	mysqli_close($con);
	
	/*** flush the buffer ***/
	ob_end_flush();
	
?>
