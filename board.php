<?php
	session_start();
	if(!isset($_SESSION['usr']) || !isset($_SESSION['pswd'])){
		header('Location: index.php');
	}
?>

<!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head>
	<!-- BEGIN Meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Kanban</title>
	<link rel="stylesheet" href="css/board.css">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/jquery-ui-1.9.2.custom.min.css">
	<script src="scripts/jquery-1.9.1.min.js"></script>
	<script src="scripts/jquery-ui.js"></script>
	<script src="scripts/board.js"></script>
	<meta name="description" content="Hotwire Kanban Board" />
	<meta name="author" content="Brandon Wilson, bwilson@hotwire.com" />
	<!-- END Meta tags -->
</head>

<body class="body-board">

	<!-- Header Bar Content -->
	<?php include 'header.php'; ?>
	
	<!-- Main Board Columns -->
	<div id="column-wrapper">
		<?php include 'tables.php'; ?>
    </div>
    
    <!-- Footer Bar Content -->
    <?php include 'footer.php'; ?>
    
    
    <!-- PHP SOAP Client Functions -->
    <?php include 'soapcalls.php'; ?>

    <!--
	    Initialize the board by:
	    Creating a new PHP SOAP Client
	    Getting the user's account details
	    Populating the board with the user's tickets
	-->
	<?php
		NewSoapClient();
		GetUser();
		GetMyActiveTickets();
	?>

</body>
</html>

