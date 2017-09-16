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

 
 
<title>Welcome to Training- <?php echo $userRow['user_email']; ?></title>


<link href="css/site.css" rel="stylesheet" type="text/css" media="print" />
<script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">


</head>
<style>


iframe {
	border:none;
}
#smaller {
	padding-bottom:50px;
}
h1 {
	font-weight:bold;
	color:#0091F5;
	text-decoration:underline;
	text-align:center;
	padding:20px,0,0,20px;
}
#toTest {
	background-color:#0091F5;
	width:150px;
	height:40px;
	display:block;
    margin:0px auto;
}

#cen {
	width:1000px;
	margin-left:auto;
	margin-right:auto;
	z-index:1;
}
#trans {
	opacity:0;
    filter: alpha(opacity = 0);
    position:absolute;
	margin-top:50px;
	margin-right:50px;
	margin-bottom:50px;
    display:block;
    z-index:2;
    background:transparent;
}
#heading {
	margin-top:100px;
	margin-bottom:30px;
}
#LisaBOriginals {
	color:#0091F5;
}
@media print {
  html, body {
    display: none;  /* hide whole page */
  }
#space {
	min-height:200px;
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
          <a class="navbar-brand" id="LisaBOriginals" href="http://www.lisaboriginals.ca">Lisa B Originals</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a id="LisaBOriginals" href="http://www.lisaboriginals.ca/order.php">Dealer Order</a></li>
            <!--<li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
            <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="LisaBOriginals" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['user_name']; ?></a></li>
            <li><a id="LisaBOriginals" href="register/logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<h1 id="heading">Lisa B Originals Fitter Training</h1>


  <div id="cen">
    <iframe id="smaller" class="nonselectable" src = "/ViewerJS/#../images/Lisa B Training Study Guide.pdf" width="100%" height="900"allowfullscreen webkitallowfullscreen></iframe><br><br>
  <input name="toTest" id="toTest" type="button" value="Begin Test" onclick="location.href='training2.php';" >
    	<div id="trans"></div><!--end trans-->
        
</div><!--end cen-->
<div id="space">&nbsp;</div>
  
  

</body>
</html>
