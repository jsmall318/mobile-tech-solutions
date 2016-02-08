<?php

/*** set a form token ***/
$_SESSION['form_token'] = md5(rand(time(), true));

/*** if we are here, include the db connection ***/
include '../includes/conn.php';

	$id = $_GET['id'];
	$searchBrand = $_GET['searchBrand'];
	$searchModel = $_GET['searchModel'];
	
	/*** connect to the database ***/
	$con = mysqli_connect($hostname, $username, $password, $db);
	
	if('searchBrand' == $id)
	{
		$sql = "SELECT distinct brand
				FROM db1.products;";
		
		$result = mysqli_query($con, $sql) or die($con->error());;
		$encode = array();
		
		if($result->num_rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$encode[$row['brand']] = $row['brand'];
			}
			
			echo json_encode($encode);
		}
	}
	else if('searchModel' == $id)
	{
		$sql = "SELECT distinct model
			   FROM db1.products
               WHERE brand ='".$searchBrand."'";
		
		$result = mysqli_query($con, $sql) or die($con->error());
		$encode = array();
		
		if($result->num_rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$encode[$row['model']] = $row['model'];
			}
				
			echo json_encode($encode);
		}
	}
	else if('searchCapacity' == $id)
	{
		$sql = "SELECT distinct capacity
			   FROM db1.products
               WHERE model ='".$searchModel."'";
	
		$result = mysqli_query($con, $sql) or die($con->error());
		$encode = array();
	
		if($result->num_rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$encode[$row['capacity']] = $row['capacity'];
			}
	
			echo json_encode($encode);
		}
	}
	else if('searchColor' == $id)
	{
		$sql = "SELECT distinct color
			   FROM db1.products
               WHERE model ='".$searchModel."'";
	
		$result = mysqli_query($con, $sql) or die($con->error());
		$encode = array();
	
		if($result->num_rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$encode[$row['color']] = $row['color'];
			}
	
			echo json_encode($encode);
		}
	}
	
	mysqli_close($con);

/*** flush the buffer ***/
ob_end_flush();

?>