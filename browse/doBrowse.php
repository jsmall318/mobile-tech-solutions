
<?php
/*** set a form token ***/
$_SESSION['form_token'] = md5(rand(time(), true));

/*** if we are here, include the db connection ***/
include '../includes/conn.php';
	
	/*** connect to the database ***/
	$con = mysqli_connect($hostname, $username, $password, $db);

	$sql = "SELECT  P.PRODUCT_ID,
					P.BRAND,
					P.MODEL,
					P.CAPACITY,
					P.COLOR,
					P.PRICE,
					P.COMMENT,
					I.IMAGE_ID
			FROM db1.products P
			JOIN db1.images I
				ON P.PRODUCT_ID = I.PRODUCT_ID;";

	$result = mysqli_query($con, $sql);
	if($result->num_rows > 0)
	{
		$myfile = fopen("../json/browse.txt", "w") or die("Unable to open file!");
		$encode = array();
		$products = array();
		

		
		while($row = mysqli_fetch_assoc($result)) 
		{			
			$encode[$row['PRODUCT_ID']]['brand'] = $row['BRAND'];
			$encode[$row['PRODUCT_ID']]['model'] = $row['MODEL'];
			$encode[$row['PRODUCT_ID']]['capacity'] = $row['CAPACITY'];
			$encode[$row['PRODUCT_ID']]['color'] = $row['COLOR'];
			$encode[$row['PRODUCT_ID']]['price'] = $row['PRICE'];
			$encode[$row['PRODUCT_ID']]['comment'] = $row['COMMENT'];
			$encode[$row['PRODUCT_ID']]['images'][] = $row['IMAGE_ID'].'.jpg';
		}
		
		foreach($encode as $x => $info) 
		{
			$products[count($products)] = $info;
		}
 		
		echo json_encode($products);
		
		fwrite($myfile, json_encode($products));
		fclose($myfile);
		
		$location = '../view/browse.php';
		
		/*** redirect ***/
		header("Location: $location");
	}
	else
	{
		echo "No Results";
	}
	mysqli_close($con);

	/*** flush the buffer ***/
	ob_end_flush();

?>