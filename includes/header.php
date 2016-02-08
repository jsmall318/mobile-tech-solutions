<?php
	/*** begin session ***/
	//session_start();

	if(isset($_SESSION['access_level']))
	{
		$log_link = 'logout.php';
		$log_link_name = 'Log Out';
	}
	else
	{
		$log_link = 'login.php?error=';
		$log_link_name = 'Log In';
	}
?>

<!DOCTYPE HTML>
<HEAD>
<title>MOBILE-TECH-SOLUTIONS</title>
<link rel='stylesheet' href='../includes/bootstrap.min.css'>
<link rel='stylesheet' href='../includes/bootstrap-theme.min.css'>
<link rel='stylesheet' href='../includes/Master.css'>
<script type='text/javascript' src='../includes/jquery.min.js'></script>
<script type='text/javascript' src='../includes/bootstrap.min.js'></script>
<SCRIPT type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></SCRIPT>
<SCRIPT type='text/javascript' src="../includes/controller.js"></SCRIPT>
</head>
<BODY>

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<ul class="nav navbar-nav">
			<li><a href="../view/home.php">Home</a></li>
			<li><a href="../view/services.php">Services</a></li>
			<li><a href="../browse/doBrowse.php">Browse Phones For Sale</a></li>
			<li><a href="../view/quote.php?page=REPAIR">Get A Repair Quote</a></li>
			<li><a href="../view/quote.php?page=BUY">Get An Offer On Your Old Phone</a></li>
			<li><a href="../view/about.php">About Us!</a></li>
			<!--  <li><a href="<?php echo $log_link; ?>"><?php echo $log_link_name; ?></a></li>-->
		</ul>	
	</div>
</nav>

