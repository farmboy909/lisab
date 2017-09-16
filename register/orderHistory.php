<?php require_once('Connections/dbconnectHistory.php'); ?>
<?php require_once('webassist/mysqli/rsobj.php'); ?>
<?php
session_start();
include_once 'dbconnect.php';

if( !isset($_SESSION['userSession']) ) {
		header("Location: register/index.php");
		exit;
	}else{
$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
//$MySQLi_CON->close();
	}?>
<?php
$Recordset1 = new WA_MySQLi_RS("Recordset1",$dbconnectHistory,20);
$Recordset1->setQuery("SELECT * FROM orders WHERE orders.email = '{$_SESSION[user_email]}' ORDER BY orders.`date` DESC, orders.line ASC");
$Recordset1->bindParam("s","".(isset($_SESSION['user_email']) ."", "-1"); //WAQB_Param1
$Recordset1->execute();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Order History</title>
</head>

<style type="text/css">
#persInf {
	font-size: 16px;
}
#left {
	text-align:left;
	width:200px;
	height:50px;
}
#center {
	width:300px;
	margin:-47px auto 0 auto;
	text-align:left;
	height:50px;
}
caption {
	clear:both;
	margin:10px 0 10px 0;
}
	</style>
    
<body>
<div id="persInf">
<div id="left"> Store ID: <?php echo($Recordset1->getColumnVal("storeid")); ?><br><br>
PO Num: <?php echo($Recordset1->getColumnVal("po")); ?></div>
<div id="center"> Name: <?php echo($Recordset1->getColumnVal("realName")); ?><br><br>
Email:<?php echo($Recordset1->getColumnVal("email")); ?>
<p id="center"></div>
</div>
<table width="1000" border="1" cellpadding="5px">
  <caption>
    Order
  </caption>
  <tr>
    <th scope="col">line</th>
    <th scope="col">client</th>
    <th scope="col">size</th>
    <th scope="col">side</th>
    <th scope="col">style</th>
    <th scope="col">colour</th>
    <th scope="col">#</th>
    <th scope="col">cost</th>
  </tr>
  <?php
while(!$Recordset1->atEnd()) {
?>
    <tr>
      <td><?php echo($Recordset1->getColumnVal("line")); ?></td>
      <td><?php echo($Recordset1->getColumnVal("client")); ?></td>
      <td><?php echo($Recordset1->getColumnVal("size")); ?></td>
      <td><?php echo($Recordset1->getColumnVal("side")); ?></td>
      <td><?php echo($Recordset1->getColumnVal("style")); ?></td>
      <td><?php echo($Recordset1->getColumnVal("colour")); ?></td>
      <td><?php echo($Recordset1->getColumnVal("quant")); ?></td>
      <td><?php echo($Recordset1->getColumnVal("price")); ?></td>
    </tr>
    <?php
  $Recordset1->moveNext();
}
$Recordset1->moveFirst(); //return RS to first record
?>
</table>
<p>Total Price: <?php echo($Recordset1->getColumnVal("totalPrice")); ?></p>
<p>Comment: <?php echo($Recordset1->getColumnVal("comment")); ?></p>
</body>
</html>