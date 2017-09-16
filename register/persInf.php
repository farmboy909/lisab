<?php
/*error_reporting(E_ALL);
ini_set('display_errors','On');*/

 session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
	header("Location: register/persInfLogin.php");
}
$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<title>Welcome - <?php echo $userRow['user_email']; ?></title>

<script
	src="https://code.jquery.com/jquery-3.1.0.min.js"
	integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
	crossorigin="anonymous"></script>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="/uploadify/jquery.uploadify-3.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
</head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
<style>
#persInf {
	width:150px;
	margin-left:auto;
	margin-right:auto;
	margin-top:20px;
}
#LisaBOriginals {
	color:#0091FE;
}
h2 {
	color:#0091FE;
}
label {
	color:#0091fe;
}
</style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top noprint">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only noprint">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id="LisaBOriginals" style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif" class="navbar-brand noprint" href="http://www.lisaboriginals.ca">Lisa B Originals</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a id="LisaBOriginals" class="noprint" href="http://www.lisaboriginals.ca/training.php">Training</a></li>
			<li><a id="LisaBOriginals" class="noprint" href="http://www.lisaboriginals.ca/order.php">Dealer Order</a></li>
            <li><a id="LisaBOriginals" class="noprint" href="http://www.lisaboriginals.ca/wrnt.php">Warranty Claim</a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a id="LisaBOriginals" href="#"><span class="glyphicon glyphicon-user noprint"></span>&nbsp; <?php  echo $userRow['user_name']; ?></a></li>
            <li><a id="LisaBOriginals" href="../register/logout.php?logout"><span class="glyphicon glyphicon-log-out noprint"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <center><img class="noprint" src="images/logo.png" style="margin-top:70px" alt="logo"><br>
<h2>Registration Information</h2></center>
    
    <div id="persInf">
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="persinfo">
 <label for="dealer">Dealer No.</label>
  <p><input name="dealer" id="dealer" type="text" value="<?php echo $userRow['dealer']; ?>" readonly></p>
  <label for="name">Name:</label>
  <p><input name="name" id="name" type="text" value="<?php echo $userRow['user_name']; ?>" readonly></p>
  <label for="email">Email:</label>
  <p><input name="email" type="email" value="<?php echo $userRow['user_email']; ?>" readonly></p>
  <label for="billBusname">Billing name:</label>
  <p><input name="billBusname" id="billBusname" type="text" value="<?php echo $userRow['billBusname']; ?>"></p>
  <label for="billad1">Billing address:</label>
  <p><input name="billad1" type="billad1" value="<?php echo $userRow['billad1']; ?>"></p>
  <label for="billad2">Billing address 2:</label>
  <p><input name="billad2" id="billad2" type="text" value="<?php echo $userRow['billad2']; ?>"></p>
  <label for="billcity">Billing city:</label>
  <p><input name="billcity" id="billcity" type="text" value="<?php echo $userRow['billcity']; ?>"></p>
  <label for="billprov">Billing prov:</label>
  <p><input name="billprov" id="billprov" type="text" value="<?php echo $userRow['billprov']; ?>"></p>
  <label for="billcountry">Billing country:</label>
  <p><input name="billcountry" id="'billcountry" type="text" value="<?php echo $userRow['billcountry']; ?>"></p>
  <label for="billPostalC">Billing postal code:</label>
  <p><input name="billPostalC" id="billPostalC" type="text" value="<?php echo $userRow['billPostalC']; ?>"></p>
  <label for="shipBusname">Shipping name:</label>
  <p><input name="shipBusname" id="shipBusname" type="text" value="<?php echo $userRow['shipBusname']; ?>"></p>
  <label for="shipad1">Shipping address:</label>
  <p><input name="shipad1" id="shipad1" type="text" value="<?php echo $userRow['shipad1']; ?>"></p>
  <label for="shipad2">Shipping address 2:</label>
  <p><input name="shipad2" id="shipad2" type="text" value="<?php echo $userRow['shipad2']; ?>"></p>
  <label for="shipcity">Shipping city:</label>
  <p><input name="shipcity" id="shipcity" type="text" value="<?php echo $userRow['shipcity']; ?>"></p>
  <label for="shipprov">Shipping prov:</label>
  <p><input name="shipprov" id="shipprov" type="text" value="<?php echo $userRow['shipprov']; ?>"></p>
  <label for="shipcountry">Shipping country:</label>
  <p><input name="shipcountry" id="shipcountry" type="text" value="<?php echo $userRow['shipcountry']; ?>"></p>
  <label for="shipPostal">Shipping postal code:</label>
  <p><input name="shipPostal" id="shipPostal" type="text" value="<?php echo $userRow['shipPostal']; ?>"></p>
  
  <p><input name="submit" id="submit" type="submit" value="Update Information"></p>
  </form>
</div>
<div class="tooltipContent" id="sprytooltip1">Reload page after update to see new data. (F5).</div>
<!--end persInf-->
<?php
if(isset($_POST['submit']))
{
	$user = $userRow['user_id'];
	$billBusname =$MySQLi_CON->real_escape_string(trim($_POST['billBusname']));
	$billad1 = $MySQLi_CON->real_escape_string(trim($_POST['billad1']));
	$billad2 = $MySQLi_CON->real_escape_string(trim($_POST['billad2']));
	$billcity = $MySQLi_CON->real_escape_string(trim($_POST['billcity']));
	$billprov = $MySQLi_CON->real_escape_string(trim($_POST['billprov']));
	$billcountry = $MySQLi_CON->real_escape_string(trim($_POST['billcountry']));
	$billPostalC = $MySQLi_CON->real_escape_string(trim($_POST['billPostalC']));
	$shipBusname = $MySQLi_CON->real_escape_string(trim($_POST['shipBusname']));
	$shipad1 = $MySQLi_CON->real_escape_string(trim($_POST['shipad1']));
	$shipad2 = $MySQLi_CON->real_escape_string(trim($_POST['shipad2']));
	$shipcity = $MySQLi_CON->real_escape_string(trim($_POST['shipcity']));
	$shipprov = $MySQLi_CON->real_escape_string(trim($_POST['shipprov']));
	$shipcountry = $MySQLi_CON->real_escape_string(trim($_POST['shipcountry']));
	$shipPostal = $MySQLi_CON->real_escape_string(trim($_POST['shipPostal']));
	
};
	    $sql = "UPDATE users SET
		billBusname = '$billBusname',
		billad1 = '$billad1',
		billad2 = '$billad2',
		billcity = '$billcity',
		billprov = '$billprov',
		billcountry = '$billcountry',
		billPostalC = '$billPostalC',
		shipBusname = '$shipBusname',
		shipad1 = '$shipad1',
		shipad2 = '$shipad2',
		shipcity = '$shipcity',
		shipprov = '$shipprov',
		shipcountry = '$shipcountry',
		shipPostal = '$shipPostal'
		WHERE user_id='$user'";
if ($MySQLi_CON->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $MySQLi_CON->error;
}
$MySQLi_CON->close();
	
?>
<script>
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#submit");
</script>


</body>

</html>

