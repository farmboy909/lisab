<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
	header("Location: register/train_index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$MySQLi_CON->close();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
 
<title>You are registered- <?php echo $userRow['user_name']; ?></title>

<link href="css/site.css" rel="stylesheet" type="text/css" media="print" />
<script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">


</head>
<style>
#heading {
	padding-top:200px;
}
h1 {
	font-size:40px;
	font-weight:bold;
	color:#0091F5;
	text-align:center;
	padding:20px,0,0,20px;
}
h2 {
	font-size:26px;
	text-align:center;
	font-weight:bold;
	color:red;
}
.LisaBOriginals {
	color:#0091F5;
}
#logout {
	color:#F63;
}
@media print {
  html, body {
    display: none;  /* hide whole page */
  }
</style>


<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand LisaBOriginals" href="http://www.lisaboriginals.ca">Lisa B Originals</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a class="LisaBOriginals" href="http://www.lisaboriginals.ca/order.php">Dealer Order</a></li>
           	<li ><a class="LisaBOriginals" href="http://www.lisaboriginals.ca/training.php">Training</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a class="LisaBOriginals" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['user_name']; ?></a></li>
            <li><a class="LisaBOriginals" href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<h1 id="heading">You are already logged in <?php echo $userRow['user_name']; ?>.<br>
You are registered.</h1>
<h2><p>If you would still like to register someone else, please logout first.</p>
</h2>

</body>
</html>
