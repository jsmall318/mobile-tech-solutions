<?php
	/*** set a form token ***/
	$_SESSION['form_token'] = md5(rand(time(), true));
	
	/*** if we are here, include the db connection ***/
	include '../includes/conn.php';
	
	/*** connect to the database ***/
	$con = mysqli_connect($hostname, $username, $password, $db);
	
	$brand = $_POST["brand"];
	$model = $_POST["model"];
	$capacity = $_POST["capacity"];
	$color = $_POST["color"];
	$price = $_POST["price"];
	$comment = $_POST["comment"];

	$sql = "INSERT INTO db1.products (BRAND,MODEL,CAPACITY,COLOR,PRICE,COMMENT) values ('$brand','$model','$capacity','$color','$price','$comment');";
	
	$result = mysqli_query($con, $sql);

	if($con->affected_rows > 0)
		echo $con->affected_rows." phone[s] successfully added.";
	else
		echo "Error the phone was not added.";
	
	$sql = "SELECT max(PRODUCT_ID) AS product_id FROM db1.products;";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$productId = $row['product_id'];
	
	$sql = "INSERT INTO db1.images (PRODUCT_ID) values ($productId);";
	$result = mysqli_query($con, $sql);
	
	$sql = "SELECT max(image_id) AS image_id FROM db1.images;";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$imageId = $row['image_id'];
	
	mysqli_close($con);
	
	//upload file
	$target_dir = "../images/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$target_file = $target_dir.$imageId.'.'.$imageFileType;
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".<BR/>";
			$uploadOk = 1;
		} else {
			echo "File is not an image.<BR/>";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.<BR/>";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.<BR/>";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) 
	{
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<BR/>";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.<BR/>";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<BR/>";
		} else {
			echo "Sorry, there was an error uploading your file.<BR/>";
		}
	}
	
	/*** flush the buffer ***/
	ob_end_flush();

?>