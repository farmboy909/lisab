<?php

//Set no caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//error_reporting(E_ALL);
//ini_set('display_errors','On');

session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
	header("Location: register/index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$MySQLi_CON->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['user_email']; ?></title>

<script
	src="https://code.jquery.com/jquery-3.1.0.min.js"
	integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
	crossorigin="anonymous"></script>

<script src="shim/js-webshim/minified/polyfiller.js"></script>
<script src="js/confirmBox.js"></script>
<script src="js/order.js"></script>


<script>


$(document).ready(function(){											//show next line
    $("#show").click(function(){
     $("tr:hidden:first").addClass("unhide");
    });
});
$(document).ready(function(){
$('form input').on('keypress', function(e) {							//disable "enter"
    return e.which !== 13;
});	
});
	function calculate(boxa, boxb, ltotal) {							//product of price multiplied by quantity
		var myBox1 = document.getElementById(boxa).value;
		var myBox2 = document.getElementById(boxb).value;		
		var prod = document.getElementById(ltotal);	
		var myResult = myBox1 * myBox2;									//Line total
		prod.value = myResult.toFixed(2);	
		//scaling - round to 2 decimals	and show in Line Total input						
	}

function calculateSum() {
    // initialize the sum (total line price) to zero
    var sum = 0;
    //use jQuery each() to loop through all the textbox with 'tot' class
    // and compute the sum for each loop
    $('.tot').each(function() {
        sum += Number($(this).val());									//page total
    // set the computed value to 'totalPrice' textbox
	total = sum.toFixed(2);
	//scaling - round to 2 decimals	and show in Page Total input
    $('#totalPrice').val(total);
     
});
}

function calculateItems() {								//sum all quantities
	var sum = 0;
	$('.items').each(function() {
		sum += Number($(this).val());
		 $('#numItems').val(sum);						//show sum in "Items" input
		 });
}
$(document).ready(function(){							//hidden inputs not required otherwise partial order will not submit
    $("#sub").click(function(){
    $(":input:hidden").removeAttr('required');
		});
    });
$(document).ready(function(){							//delete row
 $(':input[name=del]').click(function(){
 $(this).closest('tr').remove();
		});
    });
	
	$(document).ready(function(){
$('.items').keyup(function () { 						//0nly integers in items
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
	});
</script>


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<!--<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> -->

<link rel="stylesheet" href="css/style.css" type="text/css" />

<link href="css/print.css" rel="stylesheet" type="text/css" media="print">
<link href="css/screen.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/confirmBox.css" rel="stylesheet" type="text/css" media="screen">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
#LisaBOriginals {
	color:#0091FE;
}
.price {
	width:50px;
}
#totalPrice {
	width:90px;
}
#numItems {
	width:40px;
}
.pg {
	width:50px;
}
#colourLegend {
	border-style:solid;
	border-color:#0091FE;
	text-align:center;
	width:825px;
	margin: 0px auto 25px auto;
}
alert {
	color:00bb88;
	background-color:#FFC;
	text-decoration:underline;
	font-weight:bold;
}
.stock {
	width:20px;
}
.items {
	width:40px;
}
.tot {
	width:70px;
}
#space {
	style="min-height:50px;
}
#storeid {
	width:60px;
}
/*start confirmBox.css*/
@charset "utf-8";
/* CSS Document */

#popa2{
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fefefe;
            opacity: 0.7;
            z-index: 9999;
        }
#warning {
	color:#0091FE;
}

        #popb2{
            /*initially dialog box is hidden*/
            display: none;
            position: fixed;
            width: 480px;
            z-index: 9999;
            border-radius: 10px;
            background-color: #0091FE;
        }

        #pop2-header{
            background-color: #0091FE;
            color: white;
            font-size: 20px;
            padding: 10px;
            margin: 10px 10px 0 10px;
			text-align:center;
        }

        #pop2-body{
            background-color: white;
            color:#0091FE;
            font-size: 24px;
            padding: 10px;
            margin: 0 10px 0 10px;
        }

        #pop2-footer{
            background-color: #f2f2f2;
            text-align: right;
            padding: 10px;
            margin: 0 10px 10px 10px;
        }

        #pop2-footer button{
            background-color: #0091FE;
            color: white;
            padding: 5px;
            border: 0;
		}
		.line {
			width:30px;
			font-weight:bold;
		}
		.lncomment {
			size:30px;
		}

</style>
</head>
<body><!--onload="showDialog();" to show splash -->

<div id="hiddenTble" style="margin-left:-4000px; float:left">
   <td><table width="900" border="1" cellpadding="5px" >
     <tr style="display:block">
       <th scope="col">size</th>
       <th scope="col">side</th>
       <th scope="col">style</th>
       <th scope="col">quant</th>
       <th scope="col">whl_price</th>
       <th scope="col">msrp</th>
     </tr>
      <tr style="display:block">
       <td>2</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant1" id="quant1" type="number" value="1"></td>
       <td><input name="price1" id="price1" type="number" value="210.44"></td>
       <td>350.00</td>
     </tr>
      <tr style="display:block">
       <td>2</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant2" id="quant2" type="number" value="2"></td>
       <td>210.44</td>
       <td>350.00</td>
     </tr>
      <tr style="display:block">
       <td>2</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant3" id="quant3" type="number" value="3"></td>
       <td>210.44</td>
       <td>350.00</td>
     </tr>
      <tr style="display:block">
       <td>2</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant4" id="quant4" type="number" value="4"></td>
       <td>210.44</td>
       <td>350.00</td>
     </tr>
     <tr style="display:block">
       <td>3</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant5" id="quant5" type="number" value="5"></td>
       <td><input name="price5" id="price5" type="number" value="210.44"></td>
       <td>350.00</td>
     </tr>
     <tr style="display:block">
       <td>3</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant6" id="quant6" type="number" value="6"></td>
       <td>210.44</td>
       <td>350.00</td>
     </tr>
     <tr style="display:block">
       <td>3</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant7" id="quant7" type="number" value="7"></td>
       <td>210.44</td>
       <td>350.00</td>
     </tr>
     <tr style="display:block">
       <td>3</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant8" id="quant8" type="number" value="8"></td>
       <td>210.44</td>
       <td>350.00</td>
     </tr>
     <tr style="display:block">
       <td>4</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant9" id="quant9" type="number" value="9"></td>
       <td><input name="price9" id="price9" type="number" value="240.50"></td>
       <td>400.00</td>
     </tr>
     <tr style="display:block">
       <td>4</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant10" id="quant10" type="number" value="10"></td>
       <td>240.50</td>
       <td>400.00</td>
     </tr>
     <tr style="display:block">
       <td>4</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant11" id="quant11" type="number" value="11"></td>
       <td>240.50</td>
       <td>400.00</td>
     </tr>
     <tr style="display:block">
       <td>4</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant12" id="quant12" type="number" value="12"></td>
       <td>240.50</td>
       <td>400.00</td>
     </tr>
     <tr style="display:block">
       <td>5</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant13" id="quant13" type="number" value="13"></td>
       <td><input name="price13" id="price13" type="number" value="270.56"></td>
       <td>400.00</td>
     </tr>
     <tr style="display:block">
       <td>5</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant14" id="quant14" type="number" value="14"></td>
       <td>270.56</td>
       <td>400.00</td>
     </tr>
     <tr style="display:block">
       <td>5</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant15" id="quant15" type="number" value="15"></td>
       <td>270.56</td>
       <td>400.00</td>
     </tr>
     <tr style="display:block">
       <td>5</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant16" id="quant16" type="number" value="16"></td>
       <td>270.56</td>
       <td>400.00</td>
     </tr>
     <tr style="display:block">
       <td>6</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant17" id="quant17" type="number" value="17"></td>
       <td>270.56</td>
       <td>495.00</td>
     </tr>
     <tr style="display:block">
       <td>6</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant18" id="quant18" type="number" value="18"></td>
       <td><input name="price18" id="price18" type="number" value="297.62"></td>
       <td>495.00</td>
     </tr>
     <tr style="display:block">
       <td>6</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant19" id="quant19" type="number" value="19"></td>
       <td>297.62</td>
       <td>495.00</td>
     </tr>
     <tr style="display:block">
       <td>6</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant20" id="quant20" type="number" value="20"></td>
       <td>297.62</td>
       <td>495.00</td>
     </tr>
     <tr style="display:block">
       <td>7</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant21" id="quant21" type="number" value="21"></td>
       <td><input name="price21" id="price21" type="number" value="315.66"></td>
       <td>525.00</td>
     </tr>
     <tr style="display:block">
       <td>7</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant22" id="quant22" type="number" value="22"></td>
       <td>315.66</td>
       <td>525.00</td>
     </tr>
     <tr style="display:block">
       <td>7</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant23" id="quant23" type="number" value="23"></td>
       <td>315.66</td>
       <td>525.00</td>
     </tr>
     <tr style="display:block">
       <td>7</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant24" id="quant24" type="number" value="24"></td>
       <td>315.66</td>
       <td>525.00</td>
     </tr>
     <tr style="display:block">
       <td>8</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant25" id="quant25" type="number" value="25"></td>
       <td>315.66</td>
       <td>525.00</td>
     </tr>
     <tr style="display:block">
       <td>8</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant26" id="quant26" type="number" value="26"></td>
       <td>315.66</td>
       <td>525.00</td>
     </tr>
     <tr style="display:block">
       <td>8</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant27" id="quant27" type="number" value="27"></td>
       <td>315.66</td>
       <td>525.00</td>
     </tr>
     <tr style="display:block">
       <td>8</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant28" id="quant28" type="number" value="28"></td>
       <td>315.66</td>
       <td>525.00</td>
     </tr>
     <tr style="display:block">
       <td>9</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant29" id="quant29" type="number" value="29"></td>
       <td><input name="price29" id="price29" type="number" value="330.96"></td>
       <td>550.00</td>
     </tr>
     <tr style="display:block">
       <td>9</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant30" id="quant30" type="number" value="30"></td>
       <td>330.96</td>
       <td>550.00</td>
     </tr>
     <tr style="display:block">
       <td>9</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant31" id="quant31" type="number" value="31"></td>
       <td>330.96</td>
       <td>550.00</td>
     </tr>
     <tr style="display:block">
       <td>9</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant32" id="quant32" type="number" value="32"></td>
       <td>330.96</td>
       <td>550.00</td>
     </tr>
     <tr style="display:block">
       <td>10</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant33" id="quant33" type="number" value="33"></td>
       <td><input name="price33" id="price33" type="number" value="345.72"></td>
       <td>575.00</td>
     </tr>
     <tr style="display:block">
       <td>10</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant34" id="quant34" type="number" value="34"></td>
       <td>345.72</td>
       <td>575.00</td>
     </tr>
     <tr style="display:block">
       <td>10</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant35" id="quant35" type="number" value="35"></td>
       <td>345.72</td>
       <td>575.00</td>
     </tr>
     <tr style="display:block">
       <td>10</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant36" id="quant36" type="number" value="36"></td>
       <td>345.72</td>
       <td>575.00</td>
     </tr>
     <tr style="display:block">
       <td>11</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant37" id="quant37" type="number" value="37"></td>
       <td><input name="price37" id="price37" type="number" value="345.72"></td>
       <td>575.00</td>
     </tr>
     <tr style="display:block">
       <td>11</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant38" id="quant38" type="number" value="38"></td>
       <td>345.72</td>
       <td>575.00</td>
     </tr>
     <tr style="display:block">
       <td>11</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant39" id="quant39" type="number" value="39"></td>
       <td>345.72</td>
       <td>575.00</td>
     </tr>
     <tr style="display:block">
       <td>11</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant40" id="quant40" type="number" value="40"></td>
       <td>345.72</td>
       <td>575.00</td>
     </tr>
     <tr style="display:block">
       <td>12</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant41" id="quant41" type="number" value="41"></td>
       <td><input name="price41" id="price41" type="number" value="360.50"></td>
       <td>600.00</td>
     </tr>
     <tr style="display:block">
       <td>12</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant42" id="quant42" type="number" value="42"></td>
       <td>360.50</td>
       <td>600.00</td>
     </tr>
     <tr style="display:block">
       <td>12</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant43" id="quant43" type="number" value="43"></td>
       <td>360.50</td>
       <td>600.00</td>
     </tr>
     <tr style="display:block">
       <td>12</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant44" id="quant44" type="number" value="44"></td>
       <td>360.50</td>
       <td>600.00</td>
     </tr>
     <tr style="display:block">
       <td>13</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant45" id="quant45" type="number" value="45"></td>
       <td><input name="price45" id="price45" type="number" value="385.25"></td>
       <td>625.00</td>
     </tr>
     <tr style="display:block">
       <td>13</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant46" id="quant46" type="number" value="46"></td>
       <td>385.25</td>
       <td>625.00</td>
     </tr>
     <tr style="display:block">
       <td>13</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant47" id="quant47" type="number" value="47"></td>
       <td>385.25</td>
       <td>625.00</td>
     </tr>
     <tr style="display:block">
       <td>13</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant48" id="quant48" type="number" value="48"></td>
       <td>385.25</td>
       <td>625.00</td>
     </tr>
     <tr style="display:block">
       <td>14</td>
       <td>left</td>
       <td>slight</td>
       <td><input name="quant49" id="quant49" type="number" value="49"></td>
       <td><input name="price49" id="price49" type="number" value="390.00"></td>
       <td>640.00</td>
     </tr>
     <tr style="display:block">
       <td>14</td>
       <td>left</td>
       <td>full</td>
       <td><input name="quant50" id="quant50" type="number" value="50"></td>
       <td>390.00</td>
       <td>640.00</td>
     </tr>
     <tr style="display:block">
       <td>14</td>
       <td>right</td>
       <td>slight</td>
       <td><input name="quant51" id="quant51" type="number" value="51"></td>
       <td>390.00</td>
       <td>640.00</td>
     </tr>
     <tr style="display:block">
       <td>14</td>
       <td>right</td>
       <td>full</td>
       <td><input name="quant52" id="quant52" type="number" value="52"></td>
       <td>390.00</td>
       <td>640.00</td>
     </tr>
     </table>
     </div><!--end hidden table-->
<!-- dialog box1 -->
<!--<div id="popa1">
</div>
<div id="popb1">
    <div id="pop1-header">Please Read and Confirm</div>
    <div id="pop1-body">If you need to order special colours, please put them on a seperate order, with a seperate PO number.</div>
    <div id="pop1-footer">
        <button name="ok1" id="ok1" onclick="dlgOK()">OK</button>
    </div>
</div>-->

<!-- dialog box2 -->
<div id="popa2"></div>
<div id="popb2">
    <div id="pop2-header">Please Notice</div>
    <div id="pop2-body" style="text-align:center">Your order for this item has been reduced to the quantity in stock.</div>
    <div id="pop2-footer">
        <button name="ok2" id="ok2" onclick="dlgHide()">OK</button>
    </div><!--end pop2-footer-->
</div><!--end popb2-->

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
			<li class="active"><a id="LisaBOriginals" class="noprint" href="http://www.lisaboriginals.ca/order.php">Dealer Order</a></li>
            <li><a id="LisaBOriginals" class="noprint" href="http://www.lisaboriginals.ca/wrnt.php">Warranty Claim</a></li>


          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="LisaBOriginals" href="#"><span class="glyphicon glyphicon-user noprint"></span>&nbsp; <?php echo $userRow['user_name']; ?></a></li>
            <li><a id="LisaBOriginals" href="../register/logout.php?logout"><span class="glyphicon glyphicon-log-out noprint"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<center><img class="noprint" src="images/logo.png" style="margin-top:70px" alt="logo"></center>

<div id="ordrdiv">
  
  <form id="order" action="formmail.php" method="post" name="order">

<br><br><table id="ordrtbl">
<div id="colourLegend" class="noprint">
	Colours: &nbsp;01--Heidi--(lightest),&nbsp;&nbsp;02--Carol--(yellow glow),&nbsp;&nbsp;03--Pam--(beige),&nbsp;&nbsp;04--Molly--(rosy tan),&nbsp;&nbsp;05--Sasha--(darkest)
</div><!--end color-->
<p class="noprint"> The stock colour is <span style="color:#F00">Pam</span>, any other colours available will be considered Special Order, and will be subject to a $25 charge.</p>
 <caption>
    <h2 style="text-align:center;">Order</h2>
  </caption>
  <tr style="display:table-row">
  <td colspan="7" class="noprint">
  <span style="color:#F60; font-size:18px;" >The "enter" key has been disabled.</span> (Problems with this?  Call 1-877-695-3664.)
  </td>
  </tr>
  
  <tr style="display:table-row"><!--FIRST row-->
  <td><input name="line1" id="line1" class="line" type="text" value="1:" readonly><td>
  
    <td><label>Size</label>
  <select name="size1" class="size" id="size1" required onChange="price('size1', 'boxa1'); stockCnt(('size1'), ('side1'), ('style1'), ('stock1')); customStock(('pam1'), ('stock1'), ('boxb1')); 
    priceAddtn('pam1', 'boxa1', 'stock1'); calculate(('boxa1'), ('boxb1'), ('ltotal1')); setTimeout(calculateSum, 30);">
     <option ></option>										
    <option value="2">2</option>							
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    
    </select></td>
    <td><label>Side</label>
             <select name="side1" id="side1" required onChange="customStock(('pam1'), ('stock1'), ('boxb1')); stockCnt(('size1'), ('side1'), ('style1'), ('stock1'));
             priceAddtn('pam1', 'boxa1', 'stock1');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
                         
            </select></td>
    <td><label>Style</label>
             <select name="style1" id="style1" required onChange="customStock(('pam1'), ('stock1'), ('boxb1')); stockCnt(('size1'), ('side1'), ('style1'), ('stock1'));
             priceAddtn('pam1', 'boxa1', 'stock1');">
              <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
            
    <td><label>Colour</label>
             <select name="colour1" id="colour1" onChange="stockCnt(('size1'), ('side1'), ('style1'), ('stock1')); price('size1', 'boxa1'); priceAddtn('pam1', 'boxa1', 'stock1');
             calculate(('boxa1'), ('boxb1'), ('ltotal1')); setTimeout(calculateSum, 60);" required>
               <option></option>
               <option id="heidi1" value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
		       <option id="pam1" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
        </select></td>    																		
    <td><label>Price: $</label><input name="box1" id="boxa1" type="text" class="price" readonly></td>
    <td><label>In Stock: </label><input name="stock1" type="text" id="stock1" readonly class="stock"></td>    
    <td><label>Quantity:  </label><input name="quant1" type="text" required class="items" id="boxb1" onBlur="customStock(('pam1'), ('stock1'), ('boxb1')); calculate(('boxa1'), ('boxb1'), ('ltotal1')); calculateSum(); 
     calculateItems()"></td>													
    <td ><label>Line Total: $</label><input name="ltotal1" id="ltotal1" class="tot" type="text" readonly></td>
    <!--<td><input id="del" style="display:none" name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
  <tr>
  <td><input name="line2" id="line2" class="line" type="text" value="2:" readonly><td>
     <td><label>Size</label><!--2 row-->
  <select name="size2" class="size" id="size2" required onChange="price('size2', 'boxa2'); stockCnt(('size2'), ('side2'), ('style2'), ('stock2')); customStock(('pam2'), ('stock2'), ('boxb2')); 
    priceAddtn('pam1', 'boxa2', 'stock2'); calculate(('boxa2'), ('boxb2'), ('ltotal2')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side2" id="side2" required onChange="customStock(('pam2'), ('stock2'), ('boxb2')); stockCnt(('size2'), ('side2'), ('style2'), ('stock2'));
             priceAddtn('pam2', 'boxa2', 'stock2');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select>
             </td>
    <td><label>Style</label>
             <select name="style2" id="style2" required onChange="customStock(('pam2'), ('stock2'), ('boxb2')); stockCnt(('size2'), ('side2'), ('style2'), ('stock2'));
             priceAddtn('pam2', 'boxa2', 'stock2');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour2" onChange="stockCnt(('size2'), ('side2'), ('style2'), ('stock2')); price('size2', 'boxa2'); priceAddtn('pam2', 'boxa2', 'stock2');
             calculate(('boxa2'), ('boxb2'), ('ltotal2')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
     		   <option id="pam2" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box2" id="boxa2" class="price" type="text" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock2" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant2" id="boxb2" class="items" type="text" onBlur="customStock(('pam2'), ('stock2'), ('boxb2')); 
    calculate(('boxa2'), ('boxb2'), ('ltotal2')); calculateSum(); calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal2" id="ltotal2" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
    
     <tr>
     <td><input name="line3" id="line3" class="line" type="text" value="3:" readonly><td>
     <td><label>Size</label><!--3 row-->
  <select name="size3" class="size" id="size3" required onChange="price('size3', 'boxa3'); stockCnt(('size3'), ('side3'), ('style3'), ('stock3')); customStock(('pam3'), ('stock3'), ('boxb3')); 
    priceAddtn('pam3', 'boxa3', 'stock3'); calculate(('boxa3'), ('boxb3'), ('ltotal3')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side3" id="side3" required onChange="customStock(('pam3'), ('stock3'), ('boxb3')); stockCnt(('size3'), ('side3'), ('style3'), ('stock3'));
             priceAddtn('pam3', 'boxa3', 'stock3');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style3" id="style3" required onChange="customStock(('pam3'), ('stock3'), ('boxb3')); stockCnt(('size3'), ('side3'), ('style3'), ('stock3'));
             priceAddtn('pam3', 'boxa3', 'stock3');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour3" onChange="stockCnt(('size3'), ('side3'), ('style3'), ('stock3')); price('size3', 'boxa3'); priceAddtn('pam3', 'boxa3', 'stock3');
             calculate(('boxa3'), ('boxb3'), ('ltotal3')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
   		       <option id="pam3" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box3" id="boxa3" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock3" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input name="quant3" type="text" required class="items" id="boxb3" onBlur="customStock(('pam3'), ('stock3'), ('boxb3')); calculate(('boxa3'), ('boxb3'), ('ltotal3')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal3" id="ltotal3" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  <tr>
  <td><input name="line4" id="line4" class="line" type="text" value="4:" readonly><td>
     <td><label>Size</label><!--4 row-->
  <select name="size4" class="size" id="size4" required onChange="price('size4', 'boxa4'); stockCnt(('size4'), ('side4'), ('style4'), ('stock4')); customStock(('pam4'), ('stock4'), ('boxb4')); 
    priceAddtn('pam4', 'boxa4', 'stock4'); calculate(('boxa4'), ('boxb4'), ('ltotal4')); setTimeout(calculateSum, 30);">
     <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side4" id="side4" required onChange="customStock(('pam4'), ('stock4'), ('boxb4')); stockCnt(('size4'), ('side4'), ('style4'), ('stock4'));
             priceAddtn('pam4', 'boxa4', 'stock4');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style4" id="style4" required onChange="customStock(('pam4'), ('stock4'), ('boxb4')); stockCnt(('size4'), ('side4'), ('style4'), ('stock4'));
             priceAddtn('pam4', 'boxa4', 'stock4');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour4" onChange="stockCnt(('size4'), ('side4'), ('style4'), ('stock4')); price('size4', 'boxa4'); priceAddtn('pam4', 'boxa4', 'stock4');
             calculate(('boxa4'), ('boxb4'), ('ltotal4')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
 		       <option id="pam4" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box4" id="boxa4" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock4" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input name="quant4" type="text" required class="items" id="boxb4" onBlur="customStock(('pam4'), ('stock4'), ('boxb4')); calculate(('boxa4'), ('boxb4'), ('ltotal4')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal4" id="ltotal4" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
    </tr>
    
    <tr>
    <td><input name="line5" id="line5" class="line" type="text" value="5:" readonly><td>
     <td><label>Size</label><!--row 5-->
  <select name="size5" class="size" id="size5" required onChange="price('size5', 'boxa5'); stockCnt(('size5'), ('side5'), ('style5'), ('stock5')); customStock(('pam5'), ('stock5'), ('boxb5')); 
    priceAddtn('pam5', 'boxa5', 'stock5'); calculate(('boxa5'), ('boxb5'), ('ltotal5')); setTimeout(calculateSum, 30);">
     <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side5" id="side5" required onChange="customStock(('pam5'), ('stock5'), ('boxb5')); stockCnt(('size5'), ('side5'), ('style5'), ('stock5'));
             priceAddtn('pam5', 'boxa5', 'stock5');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style5" id="style5" required onChange="customStock(('pam5'), ('stock5'), ('boxb5')); stockCnt(('size5'), ('side5'), ('style5'), ('stock5'));
             priceAddtn('pam5', 'boxa5', 'stock5');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour5" onChange="stockCnt(('size5'), ('side5'), ('style5'), ('stock5')); price('size5', 'boxa5'); priceAddtn('pam5', 'boxa5', 'stock5');
             calculate(('boxa5'), ('boxb5'), ('ltotal5')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
   		       <option id="pam5" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box5" id="boxa5" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock5" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input name="quant5" type="text" required class="items" id="boxb5" onBlur="customStock(('pam5'), ('stock5'), ('boxb5')); calculate(('boxa5'), ('boxb5'), ('ltotal5')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal5" id="ltotal5" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
    </tr>
    
    <tr>
    <td><input name="line6" id="line6" class="line" type="text" value="6:" readonly><td>
     <td><label>Size</label><!--row 6-->
  <select name="size6" class="size" id="size6" required onChange="price('size6', 'boxa6'); stockCnt(('size6'), ('side6'), ('style6'), ('stock6')); customStock(('pam6'), ('stock6'), ('boxb6')); 
    priceAddtn('pam6', 'boxa6', 'stock6'); calculate(('boxa6'), ('boxb6'), ('ltotal6')); setTimeout(calculateSum, 30);">
     <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side6" id="side6" required onChange="customStock(('pam6'), ('stock6'), ('boxb6')); stockCnt(('size6'), ('side6'), ('style6'), ('stock6'));
             priceAddtn('pam6', 'boxa6', 'stock6');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style6" id="style6" required onChange="customStock(('pam6'), ('stock6'), ('boxb6')); stockCnt(('size6'), ('side6'), ('style6'), ('stock6'));
             priceAddtn('pam6', 'boxa6', 'stock6');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
      <select name="colour6" onChange="stockCnt(('size6'), ('side6'), ('style6'), ('stock6')); price('size6', 'boxa6'); priceAddtn('pam6', 'boxa6', 'stock6');
             calculate(('boxa6'), ('boxb6'), ('ltotal6')); setTimeout(calculateSum, 60);" required>
        <option ></option>
        <option value="heidi">01-Heidi</option>
        <option value="carol">02-Carol</option>
        <option id="pam6" value="pam">03-Pam</option>
        <option value="molly">04-Molly</option>
        <option value="sasha">05-Sasha</option>
      </select></td>
    <td><label>Price: $</label><input name="box6" id="boxa6" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock6" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input name="quant6" type="text" required class="items" id="boxb6" onBlur="customStock(('pam6'), ('stock6'), ('boxb6')); calculate(('boxa6'), ('boxb6'), ('ltotal6')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal6" id="ltotal6" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
    </tr>
    
    <tr>
    <td><input name="line7" id="line7" class="line" type="text" value="7:" readonly><td>
     <td><label>Size</label><!--7 row-->
  <select name="size7" class="size" id="size7" required onChange="price('size7', 'boxa7'); stockCnt(('size7'), ('side7'), ('style7'), ('stock7')); customStock(('pam7'), ('stock7'), ('boxb7')); 
    priceAddtn('pam7', 'boxa7', 'stock7'); calculate(('boxa7'), ('boxb7'), ('ltotal7')); setTimeout(calculateSum, 30);">
     <option></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side7" id="side7" required onChange="customStock(('pam7'), ('stock7'), ('boxb7')); stockCnt(('size7'), ('side7'), ('style7'), ('stock7'));
             priceAddtn('pam7', 'boxa7', 'stock7');">
             <option></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style7" id="style7" required onChange="customStock(('pam7'), ('stock7'), ('boxb7')); stockCnt(('size7'), ('side7'), ('style7'), ('stock7'));
             priceAddtn('pam7', 'boxa7', 'stock7');">
             <option></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour7" onChange="stockCnt(('size7'), ('side7'), ('style7'), ('stock7')); price('size7', 'boxa7'); priceAddtn('pam7', 'boxa7', 'stock7');
             calculate(('boxa7'), ('boxb7'), ('ltotal7')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam7" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box7" id="boxa7" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock7" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input name="quant7" type="text" required class="items" id="boxb7" onBlur="customStock(('pam7'), ('stock7'), ('boxb7')); calculate(('boxa7'), ('boxb7'), ('ltotal7')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal7" id="ltotal7" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
    </tr>
    
    <tr>
    <td><input name="line8" id="line8" class="line" type="text" value="8:" readonly><td>
     <td><label>Size</label><!--row 8-->
  <select name="size8" class="size" id="size8" required onChange="price('size8', 'boxa8'); stockCnt(('size8'), ('side8'), ('style8'), ('stock8')); customStock(('pam8'), ('stock8'), ('boxb8')); 
    priceAddtn('pam8', 'boxa8', 'stock8'); calculate(('boxa8'), ('boxb8'), ('ltotal8')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side8" id="side8" required onChange="customStock(('pam8'), ('stock8'), ('boxb8')); stockCnt(('size8'), ('side8'), ('style8'), ('stock8'));
             priceAddtn('pam8', 'boxa8', 'stock8');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style8" id="style8" required onChange="customStock(('pam8'), ('stock8'), ('boxb8')); stockCnt(('size8'), ('side8'), ('style8'), ('stock8'));
             priceAddtn('pam8', 'boxa8', 'stock8');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
     <select name="colour8" onChange="stockCnt(('size8'), ('side8'), ('style8'), ('stock8')); price('size8', 'boxa8'); priceAddtn('pam8', 'boxa8', 'stock8');
             calculate(('boxa8'), ('boxb8'), ('ltotal8')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam8" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box8" id="boxa8" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock8" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant8" id="boxb8" class="items" type="text" onBlur="customStock(('pam8'), ('stock8'), ('boxb8')); calculate(('boxa8'), ('boxb8'), ('ltotal8')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal8" id="ltotal8" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line9" id="line9" class="line" type="text" value="9:" readonly><td>
     <td><label>Size</label><!--row 9-->
  <select name="size9" class="size" id="size9" required onChange="price('size9', 'boxa9'); stockCnt(('size9'), ('side9'), ('style9'), ('stock9')); customStock(('pam9'), ('stock9'), ('boxb9')); 
    priceAddtn('pam9', 'boxa9', 'stock9'); calculate(('boxa9'), ('boxb9'), ('ltotal9')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side9" id="side9" required onChange="customStock(('pam9'), ('stock9'), ('boxb9')); stockCnt(('size9'), ('side9'), ('style9'), ('stock9'));
             priceAddtn('pam9', 'boxa9', 'stock9');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style9" id="style9" required onChange="customStock(('pam9'), ('stock9'), ('boxb9')); stockCnt(('size9'), ('side9'), ('style9'), ('stock9'));
             priceAddtn('pam9', 'boxa9', 'stock9');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour9" onChange="stockCnt(('size9'), ('side9'), ('style9'), ('stock9')); price('size9', 'boxa9'); priceAddtn('pam9', 'boxa9', 'stock9');
             calculate(('boxa9'), ('boxb9'), ('ltotal9')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam9" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box9" id="boxa9" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock9" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant9" id="boxb9" class="items" type="text" onBlur="customStock(('pam9'), ('stock9'), ('boxb9')); calculate(('boxa9'), ('boxb9'), ('ltotal9')); calculateSum(); 
     calculateItems()"></td>    								
    <td><label> Line Total: $</label><input name="ltotal9" id="ltotal9" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line10" id="line10" class="line" type="text" value="10:" readonly><td>
     <td><label>Size</label><!--row 10-->
  <select name="size10" id="size10" class="size" required onChange="price('size10', 'boxa10'); stockCnt(('size10'), ('side10'), ('style10'), ('stock10')); customStock(('pam10'), ('stock10'), ('boxb10')); 
    priceAddtn('pam10', 'boxa10', 'stock10'); calculate(('boxa10'), ('boxb10'), ('ltotal10')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side10" id="side10" required onChange="customStock(('pam10'), ('stock10'), ('boxb10')); stockCnt(('size10'), ('side10'), ('style10'), ('stock10'));
             priceAddtn('pam10', 'boxa10', 'stock10');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style10" id="style10" required onChange="customStock(('pam10'), ('stock10'), ('boxb10')); stockCnt(('size10'), ('side10'), ('style10'), ('stock10'));
             priceAddtn('pam10', 'boxa10', 'stock10');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour10" onChange="stockCnt(('size10'), ('side10'), ('style10'), ('stock10')); price('size10', 'boxa10'); priceAddtn('pam10', 'boxa10', 'stock10');
             calculate(('boxa10'), ('boxb10'), ('ltotal10')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam10" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box10" id="boxa10" type="text" class="price"readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock10" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant10" id="boxb10" class="items" type="text" onBlur="customStock(('pam10'), ('stock10'), ('boxb10')); calculate(('boxa10'), ('boxb10'), ('ltotal10')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal10" id="ltotal10" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line11" id="line11" class="line" type="text" value="11:" readonly><td>
     <td><label>Size</label><!--row 11-->
  <select name="size11" class="size" id="size11" required onChange="price('size11', 'boxa11'); stockCnt(('size11'), ('side11'), ('style11'), ('stock11')); customStock(('pam11'), ('stock11'), ('boxb11')); 
    priceAddtn('pam11', 'boxa11', 'stock11'); calculate(('boxa11'), ('boxb11'), ('ltotal11')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side11" id="side11" required onChange="customStock(('pam11'), ('stock11'), ('boxb11')); stockCnt(('size11'), ('side11'), ('style11'), ('stock11'));
             priceAddtn('pam11', 'boxa11', 'stock11');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style11" id="style11" required onChange="customStock(('pam11'), ('stock11'), ('boxb11')); stockCnt(('size11'), ('side11'), ('style11'), ('stock11'));
             priceAddtn('pam11', 'boxa11', 'stock11');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour11" onChange="stockCnt(('size11'), ('side11'), ('style11'), ('stock11')); price('size11', 'boxa11'); priceAddtn('pam11', 'boxa11', 'stock11');
             calculate(('boxa11'), ('boxb11'), ('ltotal11')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam11" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box11" id="boxa11" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock11" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant11" id="boxb11" class="items" type="text" onBlur="customStock(('pam11'), ('stock11'), ('boxb11')); calculate(('boxa11'), ('boxb11'), ('ltotal11')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal11" id="ltotal11" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line12" id="line12" class="line" type="text" value="12:" readonly><td>
     <td><label>Size</label><!--row 12-->
  <select name="size12" class="size" id="size12" required onChange="price('size12', 'boxa12'); stockCnt(('size12'), ('side12'), ('style12'), ('stock12')); customStock(('pam12'), ('stock12'), ('boxb12')); 
    priceAddtn('pam12', 'boxa12', 'stock12'); calculate(('boxa12'), ('boxb12'), ('ltotal12')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side12" id="side12" required onChange="customStock(('pam12'), ('stock12'), ('boxb12')); stockCnt(('size12'), ('side12'), ('style12'), ('stock12'));
             priceAddtn('pam12', 'boxa12', 'stock12');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style12" id="style12" required onChange="customStock(('pam12'), ('stock12'), ('boxb12')); stockCnt(('size12'), ('side12'), ('style12'), ('stock12'));
             priceAddtn('pam12', 'boxa12', 'stock12');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour12" onChange="stockCnt(('size12'), ('side12'), ('style12'), ('stock12')); price('size12', 'boxa12'); priceAddtn('pam12', 'boxa12', 'stock12');
             calculate(('boxa12'), ('boxb12'), ('ltotal12')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam12" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box12" id="boxa12" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock12" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant12" id="boxb12" class="items" type="text" onBlur="customStock(('pam12'), ('stock12'), ('boxb12')); calculate(('boxa12'), ('boxb12'), ('ltotal12')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal12" id="ltotal12" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line13" id="line13" class="line" type="text" value="13:" readonly><td>
     <td><label>Size</label><!--row 13-->
  <select name="size13" class="size" id="size13" required onChange="price('size13', 'boxa13'); stockCnt(('size13'), ('side13'), ('style13'), ('stock13')); customStock(('pam13'), ('stock13'), ('boxb13')); 
    priceAddtn('pam13', 'boxa13', 'stock13'); calculate(('boxa13'), ('boxb13'), ('ltotal13')); setTimeout(calculateSum, 30);">
  <option></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side13" id="side13" required onChange="customStock(('pam13'), ('stock13'), ('boxb13')); stockCnt(('size13'), ('side13'), ('style13'), ('stock13'));
             priceAddtn('pam13', 'boxa13', 'stock13');">
             <option></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style13" id="style13" required onChange="customStock(('pam13'), ('stock13'), ('boxb13')); stockCnt(('size13'), ('side13'), ('style13'), ('stock13'));
             priceAddtn('pam13', 'boxa13', 'stock13');">
             <option></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour13" onChange="stockCnt(('size13'), ('side13'), ('style13'), ('stock13')); price('size13', 'boxa13'); priceAddtn('pam13', 'boxa13', 'stock13');
             calculate(('boxa13'), ('boxb13'), ('ltotal13')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
     		   <option id="pam13" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box13" id="boxa13" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock13" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant13" id="boxb13" class="items" type="text" onBlur="customStock(('pam13'), ('stock13'), ('boxb13')); calculate(('boxa13'), ('boxb13'), ('ltotal13')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal13" id="ltotal13" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line14" id="line14" class="line" type="text" value="14:" readonly><td>
     <td><label>Size</label><!--row 14-->
  <select name="size14" class="size" id="size14" required onChange="price('size14', 'boxa14'); stockCnt(('size14'), ('side14'), ('style14'), ('stock14')); customStock(('pam14'), ('stock14'), ('boxb14')); 
    priceAddtn('pam14', 'boxa14', 'stock14'); calculate(('boxa14'), ('boxb14'), ('ltotal14')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side14" id="side14" required onChange="customStock(('pam14'), ('stock14'), ('boxb14')); stockCnt(('size14'), ('side14'), ('style14'), ('stock14'));
             priceAddtn('pam14', 'boxa14', 'stock14');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style14" id="style14" required onChange="customStock(('pam14'), ('stock14'), ('boxb14')); stockCnt(('size14'), ('side14'), ('style14'), ('stock14'));
             priceAddtn('pam14', 'boxa14', 'stock14');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour14" onChange="stockCnt(('size14'), ('side14'), ('style14'), ('stock14')); price('size14', 'boxa14'); priceAddtn('pam14', 'boxa14', 'stock14');
             calculate(('boxa14'), ('boxb14'), ('ltotal14')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
		       <option id="pam14" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box14" id="boxa14" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock14" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant14" id="boxb14" class="items" type="text" onBlur="customStock(('pam14'), ('stock14'), ('boxb14')); calculate(('boxa14'), ('boxb14'), ('ltotal14')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal14" id="ltotal14" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line15" id="line15" class="line" type="text" value="15:" readonly><td>
     <td><label>Size</label><!--row 15-->
  <select name="size15" class="size" id="size15" required onChange="price('size15', 'boxa15'); stockCnt(('size15'), ('side15'), ('style15'), ('stock15')); customStock(('pam15'), ('stock15'), ('boxb15')); 
    priceAddtn('pam15', 'boxa15', 'stock15'); calculate(('boxa15'), ('boxb15'), ('ltotal15')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side15" id="side15" required onChange="customStock(('pam15'), ('stock15'), ('boxb15')); stockCnt(('size15'), ('side15'), ('style15'), ('stock15'));
             priceAddtn('pam15', 'boxa15', 'stock15');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style15" id="style15" required onChange="customStock(('pam15'), ('stock15'), ('boxb15')); stockCnt(('size15'), ('side15'), ('style15'), ('stock15'));
             priceAddtn('pam15', 'boxa15', 'stock15');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour15" onChange="stockCnt(('size15'), ('side15'), ('style15'), ('stock15')); price('size15', 'boxa15'); priceAddtn('pam15', 'boxa15', 'stock15');
             calculate(('boxa15'), ('boxb15'), ('ltotal15')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam15" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box15" id="boxa15" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock15" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant15" id="boxb15" class="items" type="text" onBlur="customStock(('pam15'), ('stock15'), ('boxb15')); calculate(('boxa15'), ('boxb15'), ('ltotal15')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal15" id="ltotal15" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line16" id="line16" class="line" type="text" value="16:" readonly><td>
     <td><label>Size</label><!--row 16-->
  <select name="size16" class="size" id="size16" required onChange="price('size16', 'boxa16'); stockCnt(('size16'), ('side16'), ('style16'), ('stock16')); customStock(('pam16'), ('stock16'), ('boxb16')); 
    priceAddtn('pam16', 'boxa16', 'stock16'); calculate(('boxa16'), ('boxb16'), ('ltotal16')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side16" id="side16" required onChange="customStock(('pam16'), ('stock16'), ('boxb16')); stockCnt(('size16'), ('side16'), ('style16'), ('stock16'));
             priceAddtn('pam16', 'boxa16', 'stock16');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style16" id="style16" required onChange="customStock(('pam16'), ('stock16'), ('boxb16')); stockCnt(('size16'), ('side16'), ('style16'), ('stock16'));
             priceAddtn('pam16', 'boxa16', 'stock16');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour16" onChange="stockCnt(('size16'), ('side16'), ('style16'), ('stock16')); price('size16', 'boxa16'); priceAddtn('pam16', 'boxa16', 'stock16');
             calculate(('boxa16'), ('boxb16'), ('ltotal16')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
   			   <option id="pam16" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box16" id="boxa16" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock16" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant16" id="boxb16" class="items" type="text" onBlur="customStock(('pam16'), ('stock16'), ('boxb16')); calculate(('boxa16'), ('boxb16'), ('ltotal16')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal16" id="ltotal16" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line17" id="line17" class="line" type="text" value="17:" readonly><td>
     <td><label>Size</label><!--row 17-->
  <select name="size17" class="size" id="size17" required onChange="price('size17', 'boxa17'); stockCnt(('size17'), ('side17'), ('style17'), ('stock17')); customStock(('pam17'), ('stock17'), ('boxb17')); 
    priceAddtn('pam17', 'boxa17', 'stock17'); calculate(('boxa17'), ('boxb17'), ('ltotal17')); setTimeout(calculateSum, 30);">
 <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side17" id="side17" required onChange="customStock(('pam17'), ('stock17'), ('boxb17')); stockCnt(('size17'), ('side17'), ('style17'), ('stock17'));
             priceAddtn('pam17', 'boxa17', 'stock17');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style17" id="style17" required onChange="customStock(('pam17'), ('stock17'), ('boxb17')); stockCnt(('size17'), ('side17'), ('style17'), ('stock17'));
             priceAddtn('pam17', 'boxa17', 'stock17');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour17" onChange="stockCnt(('size17'), ('side17'), ('style17'), ('stock17')); price('size17', 'boxa17'); priceAddtn('pam17', 'boxa17', 'stock17');
             calculate(('boxa17'), ('boxb17'), ('ltotal17')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam17" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box17" id="boxa17" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock17" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant17" id="boxb17" class="items" type="text" onBlur="customStock(('pam17'), ('stock17'), ('boxb17')); calculate(('boxa17'), ('boxb17'), ('ltotal17')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal17" id="ltotal17" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line18" id="line18" class="line" type="text" value="18:" readonly><td>
     <td><label>Size</label><!--row 18-->
  <select name="size18" class="size" id="size18" required onChange="price('size18', 'boxa18'); stockCnt(('size18'), ('side18'), ('style18'), ('stock18')); customStock(('pam18'), ('stock18'), ('boxb18')); 
    priceAddtn('pam18', 'boxa18', 'stock18'); calculate(('boxa18'), ('boxb18'), ('ltotal18')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side18" id="side18" required onChange="customStock(('pam18'), ('stock18'), ('boxb18')); stockCnt(('size18'), ('side18'), ('style18'), ('stock18'));
             priceAddtn('pam18', 'boxa18', 'stock18');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style18" id="style18" required onChange="customStock(('pam18'), ('stock18'), ('boxb18')); stockCnt(('size18'), ('side18'), ('style18'), ('stock18'));
             priceAddtn('pam18', 'boxa18', 'stock18');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour18" onChange="stockCnt(('size18'), ('side18'), ('style18'), ('stock18')); price('size18', 'boxa18'); priceAddtn('pam18', 'boxa18', 'stock18');
             calculate(('boxa18'), ('boxb18'), ('ltotal18')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
		       <option id="pam18" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box18" id="boxa18" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock18" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant18" id="boxb18" class="items" type="text" onBlur="customStock(('pam18'), ('stock18'), ('boxb18')); calculate(('boxa18'), ('boxb18'), ('ltotal18')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal18" id="ltotal18" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line19" id="line19" class="line" type="text" value="19:" readonly><td>
     <td><label>Size</label><!--row 19-->
  <select name="size19" class="size" id="size19" required onChange="price('size19', 'boxa19'); stockCnt(('size19'), ('side19'), ('style19'), ('stock19')); customStock(('pam19'), ('stock19'), ('boxb19')); 
    priceAddtn('pam19', 'boxa19', 'stock19'); calculate(('boxa19'), ('boxb19'), ('ltotal19')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side19" id="side19" required onChange="customStock(('pam19'), ('stock19'), ('boxb19')); stockCnt(('size19'), ('side19'), ('style19'), ('stock19'));
             priceAddtn('pam19', 'boxa19', 'stock19');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style19" id="style19" required onChange="customStock(('pam19'), ('stock19'), ('boxb19')); stockCnt(('size19'), ('side19'), ('style19'), ('stock19'));
             priceAddtn('pam19', 'boxa19', 'stock19');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour19" onChange="stockCnt(('size19'), ('side19'), ('style19'), ('stock19')); price('size19', 'boxa19'); priceAddtn('pam19', 'boxa19', 'stock19');
             calculate(('boxa19'), ('boxb19'), ('ltotal19')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
   			   <option id="pam19" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box19" id="boxa19" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock19" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant19" id="boxb19" class="items" type="text" onBlur="customStock(('pam19'), ('stock19'), ('boxb19')); calculate(('boxa19'), ('boxb19'), ('ltotal19')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal19" id="ltotal19" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line20" id="line20" class="line" type="text" value="20:" readonly><td>
     <td><label>Size</label><!--row 20-->
  <select name="size20" class="size" id="size20" required onChange="price('size20', 'boxa20'); stockCnt(('size20'), ('side20'), ('style20'), ('stock20')); customStock(('pam20'), ('stock20'), ('boxb20')); 
    priceAddtn('pam20', 'boxa20', 'stock20'); calculate(('boxa20'), ('boxb20'), ('ltotal20')); setTimeout(calculateSum, 30);">
  <option ></option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    </select></td>
    <td><label>Side</label>
             <select name="side20" id="side20" required onChange="customStock(('pam20'), ('stock20'), ('boxb20')); stockCnt(('size20'), ('side20'), ('style20'), ('stock20'));
             priceAddtn('pam20', 'boxa20', 'stock20');">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style20" id="style20" required onChange="customStock(('pam20'), ('stock20'), ('boxb20')); stockCnt(('size20'), ('side20'), ('style20'), ('stock20'));
             priceAddtn('pam20', 'boxa20', 'stock20');">
             <option ></option>
              <option value="full">Full</option>
              <option value="slight">Slight</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour20" onChange="stockCnt(('size20'), ('side20'), ('style20'), ('stock20')); price('size20', 'boxa20'); priceAddtn('pam20', 'boxa20', 'stock20');
             calculate(('boxa20'), ('boxb20'), ('ltotal20')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option value="heidi">01-Heidi</option>
               <option value="carol">02-Carol</option>
    		   <option id="pam20" value="pam">03-Pam</option>
               <option value="molly">04-Molly</option>
               <option value="sasha">05-Sasha</option>
             </select></td>
    <td><label>Price: $</label><input name="box20" id="boxa20" type="text" class="price" readonly onChange="calculateSum();"></td>
    <td><label>In Stock: </label><input name="stock" id="stock20" type="text" readonly class="stock"></td>
    <td><label>Quantity:  </label><input required name="quant20" id="boxb20" class="items" type="text" onBlur="customStock(('pam20'), ('stock20'), ('boxb20')); calculate(('boxa20'), ('boxb20'), ('ltotal20')); calculateSum(); 
     calculateItems()"></td>
    <td><label> Line Total: $</label><input name="ltotal20" id="ltotal20" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
    <tr>
    <td colspan="11">You have reached the maximum number of rows for this order.  If you need to order more items, please send this order and start a new order with the remaining items.<br>  You can use the same PO number.</td>
    </tr>
    
     <tr style="display:table-row">
     <td>&nbsp;<td>
  <td height="38">Comments: </td>
  <td colspan="3"><textarea style="margin-top:30px;" name="instr" col cols="30" rows="3" maxlength="200"></textarea></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><label style="padding-left:22px">Items: </label><input name="rufus" id="numItems" type="text" readonly></td>
  <td><label>Order Total $</label><input name="totalPrice" id="totalPrice" type="text" readonly></td>
     </tr>
  
 
  <input type="hidden" name="good_template" value="../template/thanks.htm" />
  <input type="hidden" name="template" value="tmplt.htm" />
  <input type="hidden" name="recipients" value="gmitchell909@gmail.com, salesorder@lisaboriginals.ca">
  <input type="hidden" name="mail_options"value="HTMLTemplate=tmplt.htm" />
  <input type="hidden" name="subject" value="Order Form Submission" />
  <input type="hidden" name="derive_fields" value="imgverify=g-recaptcha-response,arverify=imgverify" />		<!--, arverify=g-recaptcha-response-->
  <input type="hidden" name="autorespond" value="HTMLTemplate=arthanks.html,Subject=Your 0rder confirmation" />
  <!--<input type="hidden" name="autorespond" value="PlainFile=plarthanks.html,Subject=Your confirmation" />
  -->
  <h2 id="warning" class="noprint">The following 5 information fields are required:</h2>
  <label for="realName">Name: </label><input id="realName" name="realName" type="text" value="<?php echo $userRow[user_name];?>" required>&nbsp;&nbsp;
  <label for="email">Email: </label><input name="email" type="email" value="<?php echo $userRow[user_email];?>" required>&nbsp;&nbsp;
  <label for="storeIDe">Store ID: </label><input name="storeID" id="storeid" type="text" value='<?php echo $userRow[dealer];?>' readonly required>&nbsp;&nbsp;
  <label for="po">Purchase Order Number: </label><input name="po" id="po" type="text" placeholder="Required*" required>&nbsp;&nbsp;&nbsp;&nbsp;
  <label for="page">Page: </label><input class="pg" name="page" id="page" type="text" placeholder="Req. *"  required> of <input name="pageof" id="pageof" class="pg" type="text"><br>
      
  
</table>
<input id="show" class="noprint" type="button" value="Add Row" onClick="showDelete();">
<br>
 
<center>
<div class="g-recaptcha" data-sitekey="6LfPJA8UAAAAADS63o8oMVRhVViZGFdx40kSvNlD"></div>
      <br/>
  <input name="sub" class="noprint" id="sub" type="submit" value="Submit to Lisa B"></center>
</form>

	</div><!--end ordrdiv-->
    <!--end hidennTble-->
     <!--end inventory table-->

<div id="space" class="noprint">
</div><!--end space-->
<script>

function showDelete() {
var delBtn = document.getElementById("del")
	delBtn.style.display = "inline";
}
function price(size, cost) {
var e = document.getElementById(size);
var price = e.options[e.selectedIndex].value;
switch (parseInt(price)) {
    case 2:
        val = document.getElementById("price1").value;
		break;							//set the price for the size
    case 3:
        val = document.getElementById("price5").value;
        break;
    case 4:
        val = document.getElementById("price9").value;
        break;
    case 5:
        val = document.getElementById("price13").value;
        break;
    case 6:
        val = document.getElementById("price18").value;
        break;
    case 7:
        val = document.getElementById("price21").value;
        break;
    case 8:
        val = document.getElementById("price21").value;
        break;
    case 9:
        val = document.getElementById("price29").value;
        break;
    case 10:
        val = document.getElementById("price33").value;
        break;
    case 11:
        val = document.getElementById("price37").value;
        break;
    case 12:
        val = document.getElementById("price41").value;
        break;
    case 13:
        val = document.getElementById("price45").value;
        break;
    case 14:
        val = document.getElementById("price49").value;        
}
var nonCustomPrice = document.getElementById(cost);
nonCustomPrice.value = val
}


function stockCnt(size, side, style, stock) {												//size, side, style are self explanitory. Stock is the box to change.  All are dependant on order line number.
var e = document.getElementById(size);
var sel_size = e.options[e.selectedIndex].value;											//selected size 
switch (parseInt(sel_size)) {
    case 2:
			var e = document.getElementById(side);											//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full, count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant1").value;
				current.value = number;
			}//end if format
				if(format == "slight") {													//if left slight, - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant2").value;
				current.value = number;
			};//end if format
		};//end if lateral
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant3").value;
				current.value = number;
			}//end if format
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant4").value;
				current.value = number;
			};//end if format
		};//end if lateral

		break;
    case 3:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant6").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant5").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant8").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant7").value;
				current.value = number;
			};
		};

        break;
    case 4:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant10").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant9").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant12").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant11").value;
				current.value = number;
			};
		};

        break;
    case 5:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant14").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant13").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant16").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant15").value;
				current.value = number;
			};
		};

        break;
    case 6:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant18").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant17").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant20").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant19").value;
				current.value = number;
			};
		};

        break;
    case 7:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant22").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant21").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant24").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant23").value;
				current.value = number;
			};
		};

        break;
    case 8:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant26").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant25").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant28").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant27").value;
				current.value = number;
			};
		};

        break;
    case 9:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant30").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant29").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant32").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant31").value;
				current.value = number;
			};
		};

        break;
    case 10:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant34").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant33").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant36").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant35").value;
				current.value = number;
			};
		};

        break;
    case 11:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant38").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant37").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant40").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant39").value;
				current.value = number;
			};
		};

        break;
    case 12:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant42").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant41").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant44").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant43").value;
				current.value = number;
			};
		};

        break;
    case 13:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant46").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant45").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant48").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant47").value;
				current.value = number;
			};
		};

        break;
    case 14:
        var e = document.getElementById(side);												//get id for side
			var lateral = e.options[e.selectedIndex].value;									//get selected side value
			var e = document.getElementById(style);											//get id for style
			var format = e.options[e.selectedIndex].value;									//get selected style value
			
		if(lateral == "left") {																//if "left" full count is this
			if(format == "full") {
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant50").value;
				current.value = number;
			}
				if(format == "slight") {													//if left slight - count is this
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant49").value;
				current.value = number;
			};
		};
		if(lateral == "right") {			
			if(format =="full") {															//if right full
				var current = document.getElementById(stock);
				var number =  document.getElementById("quant52").value;
				current.value = number;
			}
			if(format == "slight") {
				var current = document.getElementById(stock);								//if right slight
				var number =  document.getElementById("quant51").value;
				current.value = number;
			};//end if lateral
			};//end if format
			};//end switch
		};//end stockCnt()


function priceAddtn(a, b, c) {
	var selMenu  = document.getElementById(a).selected;				
	if(selMenu == false) {
	var oldPrice = val
	var cstmCost = 25.00 											//price is based on size, flat $25 charged for custom colours.  if this amount changes remmember to change HTML message too.
	var newPrice = Math.round(oldPrice * 1000)/1000+ cstmCost;
	document.getElementById(b).value = newPrice.toFixed(2);
	stock = document.getElementById(c);								//custom colour stock is zero  
 	stock.value = 0;
 };
  
  };
  
function customStock(x, y, z) {								
	var pick = document.getElementById(x).selected;			 
	if(pick == true) {
		var stkbox = document.getElementById(y);
		var stkV = stkbox.value;													//get quantity in stock
		var stockV = parseInt(stkV);												//make it an integer
		var orderbox = document.getElementById(z);
		var boxV = orderbox.value;													//get quantity ordered
		var order = parseInt(boxV);													//make it an integer
		if(order > stockV) {														// if ordered is more than stock, reduce ordered to stock
			document.getElementById(z).value = document.getElementById(y).value;	//and display popup	
			
			showDialog();
			//alert("Your order for this item has been reduced to the quantity in stock.");
			calculateItems();
		}
	};
};
//start confirmBox.js

    function dlgHide(){
        var whitebg = document.getElementById("popb2");
        var dlg = document.getElementById("popa2");
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }

    function showDialog(){
        var whitebg = document.getElementById("popb2");
        var dlg = document.getElementById("popa2");
        whitebg.style.display = "block";
        dlg.style.display = "block";

        var winWidth = window.innerWidth;
        whitebg.style.left = (winWidth/2) - (480/2) + "px";
		
		var winHeight = window.innerHeight;
		var vertical = (winHeight/2) - 200/2 + "px";
        whitebg.style.top = vertical;
    }
	
	
    </script>

</body>
</html>

 
