<?php

	require '../includes/PHPMailer/PHPMailerAutoload.php';
	include '../includes/header.php'; ?>
	
	<div class="page-header">
		<h1 style="text-align:center">
		<?php
		if ($_POST['page'] == 'REPAIR')
			echo('Get A Repair Quote');
		else if ($_POST['page'] == 'BUY')
			echo('Get A Quote For your Old Phone');
		?>
		  </h1>
	</div>
	<div style="text-align:center">
<?php
	/*** begin output buffering ***/
	ob_start();
	
	/*** begin session ***/
	session_start();

	//upload file
	$target_dir = "../images/uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
	&& $imageFileType != "gif" ) {
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
	
	//send email
	$body = '<p>The following request was sent from: </p>';
	$body .= '<p>Name: '.$_POST['name'].'</p><br/>';
	$body .= '<p>Email: '.$_POST['email'].'</p><br/>';
	$body .= '<p>Phone Number: '.$_POST['phoneNumber'].'</p><br/>';
	$body .= '<p>Prefered Contact Method: '.$_POST['contactBy'].'</p><br/>';
	$body .= '<p>Quote For: '.$_POST['page'].'</p><br/>';
	$body .= '<p>Brand: '.$_POST['brand'].'</p><br/>';
	$body .= '<p>Model: '.$_POST['model'].'</p><br/>';
	$body .= '<p>Storage Cap: '.$_POST['storageCap'].' GB</p><br/>';
	$body .= '<p>Color: '.$_POST['color'].'</p><br/>';
	$body .= '<p>Issues/Requests: ';
	if (isset($_POST['waterDamage']) && $_POST['waterDamage'] == 'Y')
		$body .= '<BR/>'.'     Water Damage';
	if (isset($_POST['brokenScreen']) && $_POST['brokenScreen'] == 'Y')
		$body .= '<BR/>'.'     Broken Screen';
	if (isset($_POST['brokenBack']) && $_POST['brokenBack'] == 'Y')
		$body .= '<BR/>'.'     Broken Back';
	if (isset($_POST['mic']) && $_POST['mic'] == 'Y')
		$body .= '<BR/>'.'     Microphone';
	if (isset($_POST['speaker']) && $_POST['speaker'] == 'Y')
		$body .= '<BR/>'.'     Speaker';
	if (isset($_POST['chargePort']) && $_POST['chargePort'] == 'Y')
		$body .= '<BR/>'.'     Charge Port';
	if (isset($_POST['colorChange']) && $_POST['colorChange'] == 'Y')
		$body .= '<BR/>'.'     Color Change';
	$body .= '</p><br/>';
	$body .= '<p>Comments: '.$_POST['comments'].'</p><br/>';


	$m = new PHPMailer;
	
	$m->isSMTP();
	$m->SMTPAuth = true;
	
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$m->SMTPDebug = 0;
	$m->Debugoutput = 'html';
	
	$m->Host = 'smtp.gmail.com';
	$m->Username = 'jsmall318@gmail.com';
	$m->Password = 'J5730505o';
	
	$m->SMTPSecure = 'tls';
	$m->Port = 587;
	
	$m->setFrom('jsmall318@gmail.com', 'Jenni Small');
	$m->addReplyTo('reply@gmail.com','Reply Address');
	
	$m->addAddress('jsmall318@gmail.com', 'Jenni Small');
	$m->addAddress('jenni.small@shawinc.com', 'Jenni Small');
	$m->addCC('jenni.small@shawinc.com', 'Jenni Small');
	$m->addBCC('jenni.small@shawinc.com', 'Jenni Small');
	
	$m->isHTML(true);
	
	$m->Subject = 'Test Email';
	$m->Body = $body;
	$m->AltBody = 'This is the body of the email';
	
 	$m->addAttachment('../images/uploads/'.basename( $_FILES["fileToUpload"]["name"]));
	
	//send the message, check for errors
	if (!$m->send()) {
	    echo "Mailer Error: " . $m->ErrorInfo;
	} else {
	    echo "Message sent!";
	}

	/*** flush the buffer ***/
	ob_end_flush();
?>
</div>