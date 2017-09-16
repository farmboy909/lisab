<?php
session_start();
include_once 'dbconnect.php';

if( !isset($_SESSION['userSession']) ) {
		header("Location: register/index.php");
		exit;
	}else{
$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$MySQLi_CON->close();
	}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script>
    $.webshims.polyfill('forms');
  </script>
<script src="js/confirmBox.js"></script>
<script src="js/order.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous">
</script>

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
#sub {
	margin-bottom:100px;
}
.invalid input:required:invalid {
    background: #BE4C54;
}

.invalid input:required:valid {
    background: #17D654 ;
}

.price1 {	width:50px;
}
</style>
</head>
<body class="active" style="background-color:#FFF">

<?php include("inventoryLookUp.php"); ?>
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
            <li><a id="LisaBOriginals" class="noprint" href="training.php">Training</a></li>
			<li class="active"><a id="LisaBOriginals" class="noprint" href="order.php">Dealer Order</a></li>
            <li><a id="LisaBOriginals" class="noprint" href="extendedWrnt.php">Extended Warranty</a></li>
            <li><a id="LisaBOriginals" class="noprint" href="wrnt.php">Warranty Claim</a></li>
            <li><a id="LisaBOriginals" class="noprint" href="msrp.php">MSRP</a></li>


          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="LisaBOriginals" href="persInf.php"><span class="glyphicon glyphicon-user noprint"></span>&nbsp; <?php echo $userRow['user_name']; ?></a></li>
            <li><a id="LisaBOriginals" href="../register/logout.php?logout"><span class="glyphicon glyphicon-log-out noprint"></span>&nbsp; Logout</a></li>
            <li><a id="LisaBOriginals" href="orderHistory.php?"><span class="glyphicon glyphicon-circle-arrow-left noprint"></span>&nbsp; Previous Order</a></li>
          </ul>
        </div><!--/.nav-collapse-->
      </div>
    </nav> 
<center><img class="noprint" src="images/logo.png" style="margin-top:70px" alt="logo"></center>

<div id="ordrdiv">
  
  <form id="order" class="validate-form" action="formmail.php" method="post" name="order">

<br><br><table id="ordrtbl">
<div id="colourLegend" class="noprint">
	Colours: &nbsp;LBO-1&nbsp;(lightest),&nbsp;&nbsp;LBO-2&nbsp;(pink glow),&nbsp;&nbsp;LBO-3&nbsp;(beige),&nbsp;&nbsp;LBO-4&nbsp;(rosy tan),&nbsp;&nbsp;LBO-5&nbsp;(darkest)
</div><!--end color-->
<p class="noprint" style="text-align:center"> The stock colour is <span style="color:#F00">LBO-3</span>, any other colours available will be considered Special Order, and will be subject to a $25 charge.</p>
 <caption>
    <h2 style="text-align:center;">Order</h2>
  </caption>
  <tr style="display:table-row">
  <td colspan="7" class="noprint">
  <span style="color:#F60; font-size:18px;" >The "enter" key has been disabled.</span> (Problems with this?  Call 1-877-695-3664.)
  </td>
  </tr>
  
  <tr style="display:table-row"><!--FIRST row-->
  <td><input name="line1" id="line1" class="line" type="text" value="1:" readonly>&nbsp;&nbsp;</td>
  <td>
   <label for="lcomment1">Client:</label>
   <textarea name="lcomment1" id="lcomment1" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
    <td><label>Size</label>
  <select name="size1" class="size" id="size1" title="Please select a size." required onChange="price(('size1'), ('boxa1')); stockCnt(('size1'), ('side1'), ('style1'), ('stock1')); customStock(('pam1'), ('stock1'), ('boxb1'));
    priceAddtn(('colour1'), ('boxa1')); calculate(('boxa1'), ('boxb1'), ('ltotal1')); setTimeout(calculateSum, 30);"><!-- customStock(('pam1'), ('stock1'), ('boxb1'));-->
     <option value=" "></option>
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
    
    </select>&nbsp;</td>
    <td><label>Side</label>
             <select name="side1" id="side1" required onChange="customStock(('pam1'), ('stock1'), ('boxb1')); stockCnt(('size1'), ('side1'), ('style1'), ('stock1'));"><!--customStock(('pam1'), ('stock1'), ('boxb1')); -->
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
                         
            </select>&nbsp;</td>
    <td><label>Style</label>
             <select name="style1" id="style1" required onChange="customStock(('pam1'), ('stock1'), ('boxb1')); stockCnt(('size1'), ('side1'), ('style1'), ('stock1'));"><!--customStock(('pam1'), ('stock1'), ('boxb1')); -->
              <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select>&nbsp;</td>
            
    <td><label>Colour</label>
             <select name="colour1" id="colour1" onChange="stockCnt(('size1'), ('side1'), ('style1'), ('stock1')); price(('size1'), ('boxa1')); priceAddtn(('colour1'), ('boxa1'));
             calculate(('boxa1'), ('boxb1'), ('ltotal1')); setTimeout(calculateSum, 60);" required>
               <option></option>
               <option id="heidi1" value="heidi">LBO-1 </option>
               <option id="carol1" value="carol">LBO-2</option>
		       <option id="pam1" value="pam">LBO-3</option>
               <option id="molly1" value="molly">LBO-4</option>
               <option id="sasha1" value="sasha">LBO-5</option>
        </select>&nbsp;</td>    																		
    <td><label>Price $</label><input name="boxa1" id="boxa1" type="text" class="price" readonly>&nbsp;</td>
    <!--<td><label>In Stock: </label>--><input name="stock1" type="hidden" id="stock1" readonly class="stock"></td>    	
    <td><label>Quantity</label>&nbsp;<input name="quant1" type="text" required class="items" id="boxb1" onBlur="customStock(('pam1'), ('stock1'), ('boxb1')); calculate(('boxa1'), ('boxb1'), ('ltotal1')); calculateSum(); 
     calculateItems()">&nbsp;&nbsp;</td><!--customStock(('pam1'), ('stock1'), ('boxb1')); -->											
    <td ><label>Line Total $</label><input name="ltotal1" id="ltotal1" class="tot" type="text" readonly></td>
    <!--<td><input id="del" style="display:none" name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
  <tr>
  <td><input name="line2" id="line2" class="line" type="text" value="2:" readonly></td>
  <td>
   <label for="lcomment2">Client:</label>
   <textarea name="lcomment2" id="lcomment2" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--2 row-->
  <select name="size2" class="size" id="size2" title="Please select a size." required onChange="price(('size2'), ('boxa2')); stockCnt(('size2'), ('side2'), ('style2'), ('stock2'));  customStock(('pam2'), ('stock2'), ('boxb2'));
    priceAddtn(('colour2'), ('boxa2')); calculate(('boxa2'), ('boxb2'), ('ltotal2')); setTimeout(calculateSum, 30);"><!-- customStock(('pam2'), ('stock2'), ('boxb2'));-->
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
             <select name="side2" id="side2" required onChange="customStock(('pam2'), ('stock2'), ('boxb2')); stockCnt(('size2'), ('side2'), ('style2'), ('stock2'));"><!--customStock(('pam2'), ('stock2'), ('boxb2')); -->
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select>
             </td>
    <td><label>Style</label>
             <select name="style2" id="style2" required onChange="customStock(('pam2'), ('stock2'), ('boxb2')); stockCnt(('size2'), ('side2'), ('style2'), ('stock2'));"><!--customStock(('pam2'), ('stock2'), ('boxb2'));-->
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour2" id="colour2" onChange="stockCnt(('size2'), ('side2'), ('style2'), ('stock2')); price(('size2'), ('boxa2')); priceAddtn(('colour2'), ('boxa2'));
             calculate(('boxa2'), ('boxb2'), ('ltotal2')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi2" value="heidi">LBO-1 </option>
               <option id="carol2" value="carol">LBO-2</option>
     		   <option id="pam2" value="pam">LBO-3</option>
               <option id="molly2" value="molly">LBO-4</option>
               <option id="sasha2" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa2" id="boxa2" class="price" type="text" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock2" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant2" id="boxb2" class="items" type="text" onBlur="calculate(('boxa2'), ('boxb2'), ('ltotal2')); calculateSum(); calculateItems()"></td><!--customStock(('pam2'), ('stock2'), ('boxb2'));-->
    <td ><label>Line Total $</label><input name="ltotal2" id="ltotal2" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
    
     <tr>
     <td><input name="line3" id="line3" class="line" type="text" value="3:" readonly></td>
     <td>
   <label for="lcomment3">Client:</label>
   <textarea name="lcomment3" id="lcomment3" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--3 row-->
  <select name="size3" class="size" id="size3" title="Please select a size." required onChange="price(('size3'), ('boxa3')); stockCnt(('size3'), ('side3'), ('style3'), ('stock3')); customStock(('pam3'), ('stock3'), ('boxb3'));
   priceAddtn(('colour3'), ('boxa3')); calculate(('boxa3'), ('boxb3'), ('ltotal3')); setTimeout(calculateSum, 30);"><!--; customStock(('pam3'), ('stock3'), ('boxb3'));-->
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
             <select name="side3" id="side3" required onChange="customStock(('pam3'), ('stock3'), ('boxb3')); stockCnt(('size3'), ('side3'), ('style3'), ('stock3'));"><!--customStock(('pam3'), ('stock3'), ('boxb3'));-->
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style3" id="style3" required onChange="customStock(('pam3'), ('stock3'), ('boxb3')); stockCnt(('size3'), ('side3'), ('style3'), ('stock3'));"><!--customStock(('pam3'), ('stock3'), ('boxb3'));-->
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour3" id="colour3" onChange="stockCnt(('size3'), ('side3'), ('style3'), ('stock3')); price('size3'), ('boxa3')); priceAddtn(('colour3'), ('boxa3'));
             calculate(('boxa3'), ('boxb3'), ('ltotal3')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi3" value="heidi">LBO-1 </option>
               <option id="carol3" value="carol">LBO-2</option>
   		       <option id="pam3" value="pam">LBO-3</option>
               <option id="molly3" value="molly">LBO-4</option>
               <option id="sasha3" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa3" id="boxa3" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock3" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input name="quant3" type="text" required class="items" id="boxb3" onBlur=" calculate(('boxa3'), ('boxb3'), ('ltotal3')); calculateSum(); 
     calculateItems()"></td><!--customStock(('pam3'), ('stock3'), ('boxb3'));-->
    <td ><label>Line Total $</label><input name="ltotal3" id="ltotal3" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  <tr>
  <td><input name="line4" id="line4" class="line" type="text" value="4:" readonly></td>
  <td>
   <label for="lcomment4">Client:</label>
   <textarea name="lcomment4" id="lcomment4" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--4 row-->
  <select name="size4" class="size" id="size4" title="Please select a size." required onChange="price(('size4'), ('boxa4')); stockCnt(('size4'), ('side4'), ('style4'), ('stock4')); customStock(('pam4'), ('stock4'), ('boxb4'));
   priceAddtn(('colour4'), ('boxa4')); calculate(('boxa4'), ('boxb4'), ('ltotal4')); setTimeout(calculateSum, 30);"><!-- customStock(('pam4'), ('stock4'), ('boxb4'));-->
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
             <select name="side4" id="side4" required onChange="customStock(('pam4'), ('stock4'), ('boxb4')); stockCnt(('size4'), ('side4'), ('style4'), ('stock4'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style4" id="style4" required onChange="customStock(('pam4'), ('stock4'), ('boxb4')); stockCnt(('size4'), ('side4'), ('style4'), ('stock4'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour4" id="colour4" onChange="stockCnt(('size4'), ('side4'), ('style4'), ('stock4')); price(('size4'), ('boxa4')); priceAddtn(('colour4'), ('boxa4'));
             calculate(('boxa4'), ('boxb4'), ('ltotal4')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi4" value="heidi">LBO-1 </option>
               <option id="carol4" value="carol">LBO-2</option>
 		       <option id="pam4" value="pam">LBO-3</option>
               <option id="molly4" value="molly">LBO-4</option>
               <option id="sasha4" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa4" id="boxa4" type="text" class="price" readonly onChange="calculateSum();"></td>
   <!-- <td><label>In Stock: </label>--><input name="stock" id="stock4" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input name="quant4" type="text" required class="items" id="boxb4" onBlur="calculate(('boxa4'), ('boxb4'), ('ltotal4')); calculateSum(); 
     calculateItems()"></td><!--customStock(('pam4'), ('stock4'), ('boxb4'));--> 
    <td ><label>Line Total $</label><input name="ltotal4" id="ltotal4" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
    </tr>
    
    <tr>
    <td><input name="line5" id="line5" class="line" type="text" value="5:" readonly></td>
    <td>
   <label for="lcomment5">Client:</label>
   <textarea name="lcomment5" id="lcomment5" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 5-->
  <select name="size5" class="size" id="size5" required onChange="price(('size5'), ('boxa5')); stockCnt(('size5'), ('side5'), ('style5'), ('stock5')); customStock(('pam5'), ('stock5'), ('boxb5')); 
   priceAddtn(('colour5'), ('boxa5')); calculate(('boxa5'), ('boxb5'), ('ltotal5')); setTimeout(calculateSum, 30);">
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
             <select name="side5" id="side5" required onChange="customStock(('pam5'), ('stock5'), ('boxb5')); stockCnt(('size5'), ('side5'), ('style5'), ('stock5'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style5" id="style5" required onChange="customStock(('pam5'), ('stock5'), ('boxb5')); stockCnt(('size5'), ('side5'), ('style5'), ('stock5'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select>
            </td>
    <td><label>Colour</label>
             <select name="colour5" id="colour5" onChange="stockCnt(('size5'), ('side5'), ('style5'), ('stock5')); price(('size5'), ('boxa5)); priceAddtn(('colour5'), ('boxa5'));
             calculate(('boxa5'), ('boxb5'), ('ltotal5')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi5" value="heidi">LBO-1 </option>
               <option id="carol5" value="carol">LBO-2</option>
   		       <option id="pam5" value="pam">LBO-3</option>
               <option id="molly5" value="molly">LBO-4</option>
               <option id="sasha5" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa5" id="boxa5" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock5" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input name="quant5" type="text" required class="items" id="boxb5" onBlur="calculate(('boxa5'), ('boxb5'), ('ltotal5')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal5" id="ltotal5" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
    </tr>
    
    <tr>
    <td><input name="line6" id="line6" class="line" type="text" value="6:" readonly></td>
    <td>
   <label for="lcomment6">Client:</label>
   <textarea name="lcomment6" id="lcomment6" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 6-->
  <select name="size6" class="size" id="size6" required onChange="price(('size6'), ('boxa6')); stockCnt(('size6'), ('side6'), ('style6'), ('stock6')); customStock(('pam6'), ('stock6'), ('boxb6')); 
   priceAddtn(('colour6'), ('boxa6')); calculate(('boxa6'), ('boxb6'), ('ltotal6')); setTimeout(calculateSum, 30);">
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
             <select name="side6" id="side6" required onChange="customStock(('pam6'), ('stock6'), ('boxb6')); stockCnt(('size6'), ('side6'), ('style6'), ('stock6'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style6" id="style6" required onChange="customStock(('pam6'), ('stock6'), ('boxb6')); stockCnt(('size6'), ('side6'), ('style6'), ('stock6'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
      <select name="colour6" id="colour6" onChange="stockCnt(('size6'), ('side6'), ('style6'), ('stock6')); price(('size6'), ('boxa6')); priceAddtn(('colour6'), ('boxa6'));
             calculate(('boxa6'), ('boxb6'), ('ltotal6')); setTimeout(calculateSum, 60);" required>
        <option ></option>
        <option id="heidi6" value="heidi">LBO-1 </option>
        <option id="carol6" value="carol">LBO-2</option>
        <option id="pam6" value="pam">LBO-3</option>
        <option id="molly6" value="molly">LBO-4</option>
        <option id="sasha6" value="sasha">LBO-5</option>
      </select></td>
    <td><label>Price $</label><input name="boxa6" id="boxa6" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock6" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input name="quant6" type="text" required class="items" id="boxb6" onBlur="calculate(('boxa6'), ('boxb6'), ('ltotal6')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal6" id="ltotal6" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
    </tr>
    
    <tr>
    <td><input name="line7" id="line7" class="line" type="text" value="7:" readonly></td>
    <td>
   <label for="lcomment7">Client:</label>
   <textarea name="lcomment7" id="lcomment7" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--7 row-->
  <select name="size7" class="size" id="size7" required onChange="price(('size7'), ('boxa7')); stockCnt(('size7'), ('side7'), ('style7'), ('stock7')); customStock(('pam7'), ('stock7'), ('boxb7')); 
  priceAddtn(('colour7'), ('boxa7')); calculate(('boxa7'), ('boxb7'), ('ltotal7')); setTimeout(calculateSum, 30);">
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
             <select name="side7" id="side7" required onChange="customStock(('pam7'), ('stock7'), ('boxb7')); stockCnt(('size7'), ('side7'), ('style7'), ('stock7'));">
             <option></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style7" id="style7" required onChange="customStock(('pam7'), ('stock7'), ('boxb7')); stockCnt(('size7'), ('side7'), ('style7'), ('stock7'));">
             <option></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour7" id="colour7" onChange="stockCnt(('size7'), ('side7'), ('style7'), ('stock7')); price(('size7'), ('boxa7')); priceAddtn(('colour7'), ('boxa7'));
             calculate(('boxa7'), ('boxb7'), ('ltotal7')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi7" value="heidi">LBO-1 </option>
               <option id="carol7" value="carol">LBO-2</option>
    		   <option id="pam7" value="pam">LBO-3</option>
               <option id="molly7" value="molly">LBO-4</option>
               <option id="sasha7" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa7" id="boxa7" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock7" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input name="quant7" type="text" required class="items" id="boxb7" onBlur="calculate(('boxa7'), ('boxb7'), ('ltotal7')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal7" id="ltotal7" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
    </tr>
    
    <tr>
    <td><input name="line8" id="line8" class="line" type="text" value="8:" readonly></td>
    <td>
   <label for="lcomment8">Client:</label>
   <textarea name="lcomment8" id="lcomment8" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 8-->
  <select name="size8" class="size" id="size8" required onChange="price(('size8'), ('boxa8')); stockCnt(('size8'), ('side8'), ('style8'), ('stock8')); customStock(('pam8'), ('stock8'), ('boxb8')); 
    priceAddtn(('colour7'), ('boxa7')); calculate(('boxa8'), ('boxb8'), ('ltotal8')); setTimeout(calculateSum, 30);">
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
             <select name="side8" id="side8" required onChange="customStock(('pam8'), ('stock8'), ('boxb8')); stockCnt(('size8'), ('side8'), ('style8'), ('stock8'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style8" id="style8" required onChange="customStock(('pam8'), ('stock8'), ('boxb8')); stockCnt(('size8'), ('side8'), ('style8'), ('stock8'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
     <select name="colour8" id="colour8" onChange="stockCnt(('size8'), ('side8'), ('style8'), ('stock8')); price(('size8'), ('boxa8')); priceAddtn(('colour8'), ('boxa8'));
             calculate(('boxa8'), ('boxb8'), ('ltotal8')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi8" value="heidi">LBO-1 </option>
               <option id="carol8" value="carol">LBO-2</option>
    		   <option id="pam8" value="pam">LBO-3</option>
               <option id="molly8" value="molly">LBO-4</option>
               <option id="sasha8" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa8" id="boxa8" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock8" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant8" id="boxb8" class="items" type="text" onBlur="calculate(('boxa8'), ('boxb8'), ('ltotal8')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal8" id="ltotal8" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line9" id="line9" class="line" type="text" value="9:" readonly></td>
   <td>
   <label for="lcomment9">Client:</label>
   <textarea name="lcomment9" id="lcomment9" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 9-->
  <select name="size9" class="size" id="size9" required onChange="price(('size9'), ('boxa9')); stockCnt(('size9'), ('side9'), ('style9'), ('stock9')); customStock(('pam9'), ('stock9'), ('boxb9')); 
    priceAddtn(('colour8'), ('boxa8')); calculate(('boxa9'), ('boxb9'), ('ltotal9')); setTimeout(calculateSum, 30);">
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
             <select name="side9" id="side9" required onChange="customStock(('pam9'), ('stock9'), ('boxb9')); stockCnt(('size9'), ('side9'), ('style9'), ('stock9'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style9" id="style9" required onChange="customStock(('pam9'), ('stock9'), ('boxb9')); stockCnt(('size9'), ('side9'), ('style9'), ('stock9'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour9" id="colour9" onChange="stockCnt(('size9'), ('side9'), ('style9'), ('stock9')); price(('size9'), ('boxa9'));priceAddtn(('colour9'), ('boxa9'));
             calculate(('boxa9'), ('boxb9'), ('ltotal9')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi9" value="heidi">LBO-1 </option>
               <option id="carol9" value="carol">LBO-2</option>
    		   <option id="pam9" value="pam">LBO-3</option>
               <option id="molly9" value="molly">LBO-4</option>
               <option id="sasha9" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa9" id="boxa9" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock9" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant9" id="boxb9" class="items" type="text" onBlur="calculate(('boxa9'), ('boxb9'), ('ltotal9')); calculateSum(); 
     calculateItems()"></td>    								
    <td ><label>Line Total $</label><input name="ltotal9" id="ltotal9" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line10" id="line10" class="line" type="text" value="10:" readonly></td>
   <td>
   <label for="lcomment10">Client:</label>
   <textarea name="lcomment10" id="lcomment10" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 10-->
  <select name="size10" id="size10" class="size" required onChange="price(('size10'), ('boxa10')); stockCnt(('size10'), ('side10'), ('style10'), ('stock10')); customStock(('pam10'), ('stock10'), ('boxb10')); 
   priceAddtn(('colour10'), ('boxa10')); calculate(('boxa10'), ('boxb10'), ('ltotal10')); setTimeout(calculateSum, 30);">
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
             <select name="side10" id="side10" required onChange="customStock(('pam10'), ('stock10'), ('boxb10')); stockCnt(('size10'), ('side10'), ('style10'), ('stock10'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style10" id="style10" required onChange="customStock(('pam10'), ('stock10'), ('boxb10')); stockCnt(('size10'), ('side10'), ('style10'), ('stock10'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour10" id="colour10" onChange="stockCnt(('size10'), ('side10'), ('style10'), ('stock10')); price('size10'), ('boxa10')); priceAddtn(('colour10'), ('boxa10'));
             calculate(('boxa10'), ('boxb10'), ('ltotal10')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi10" value="heidi">LBO-1 </option>
               <option id="carol10" value="carol">LBO-2</option>
    		   <option id="pam10" value="pam">LBO-3</option>
               <option id="molly10" value="molly">LBO-4</option>
               <option id="sasha10" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa10" id="boxa10" type="text" class="price"readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock10" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant10" id="boxb10" class="items" type="text" onBlur="calculate(('boxa10'), ('boxb10'), ('ltotal10')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal10" id="ltotal10" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line11" id="line11" class="line" type="text" value="11:" readonly></td>
   <td>
   <label for="lcomment11">Client:</label>
   <textarea name="lcomment11" id="lcomment11" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 11-->
  <select name="size11" class="size" id="size11" required onChange="price(('size11'), ('boxa11')); stockCnt(('size11'), ('side11'), ('style11'), ('stock11')); customStock(('pam11'), ('stock11'), ('boxb11')); 
   priceAddtn(('colour11'), ('boxa11')); calculate(('boxa11'), ('boxb11'), ('ltotal11')); setTimeout(calculateSum, 30);">
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
             <select name="side11" id="side11" required onChange="customStock(('pam11'), ('stock11'), ('boxb11')); stockCnt(('size11'), ('side11'), ('style11'), ('stock11'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style11" id="style11" required onChange="customStock(('pam11'), ('stock11'), ('boxb11')); stockCnt(('size11'), ('side11'), ('style11'), ('stock11'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour11" id="colour11" onChange="stockCnt(('size11'), ('side11'), ('style11'), ('stock11')); price(('size11'), ('boxa11')); priceAddtn(('colour11'), ('boxa11'));
             calculate(('boxa11'), ('boxb11'), ('ltotal11')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi11" value="heidi">LBO-1 </option>
               <option id="carol11" value="carol">LBO-2</option>
    		   <option id="pam11" value="pam">LBO-3</option>
               <option id="molly11" value="molly">LBO-4</option>
               <option id="sasha11" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa11" id="boxa11" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock11" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant11" id="boxb11" class="items" type="text" onBlur="calculate(('boxa11'), ('boxb11'), ('ltotal11')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal11" id="ltotal11" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line12" id="line12" class="line" type="text" value="12:" readonly></td>
   <td>
   <label for="lcomment12">Client:</label>
   <textarea name="lcomment12" id="lcomment12" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 12-->
  <select name="size12" class="size" id="size12" required onChange="price(('size12'), ('boxa12')); stockCnt(('size12'), ('side12'), ('style12'), ('stock12')); customStock(('pam12'), ('stock12'), ('boxb12')); 
    priceAddtn(('colour12'), ('boxa12')); calculate(('boxa12'), ('boxb12'), ('ltotal12')); setTimeout(calculateSum, 30);">
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
             <select name="side12" id="side12" required onChange="customStock(('pam12'), ('stock12'), ('boxb12')); stockCnt(('size12'), ('side12'), ('style12'), ('stock12'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style12" id="style12" required onChange="customStock(('pam12'), ('stock12'), ('boxb12')); stockCnt(('size12'), ('side12'), ('style12'), ('stock12'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour12" id="colour12" onChange="stockCnt(('size12'), ('side12'), ('style12'), ('stock12')); price(('size12'), ('boxa12')); priceAddtn(('colour12'), ('boxa12'));
             calculate(('boxa12'), ('boxb12'), ('ltotal12')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi12" value="heidi">LBO-1 </option>
               <option id="carol12" value="carol">LBO-2</option>
    		   <option id="pam12" value="pam">LBO-3</option>
               <option id="molly12" value="molly">LBO-4</option>
               <option id="sasha12" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa12" id="boxa12" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock12" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant12" id="boxb12" class="items" type="text" onBlur="calculate(('boxa12'), ('boxb12'), ('ltotal12')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal12" id="ltotal12" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line13" id="line13" class="line" type="text" value="13:" readonly></td>
   <td>
   <label for="lcomment13">Client:</label>
   <textarea name="lcomment13" id="lcomment13" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 13-->
  <select name="size13" class="size" id="size13" required onChange="price(('size13'), ('boxa13')); stockCnt(('size13'), ('side13'), ('style13'), ('stock13')); customStock(('pam13'), ('stock13'), ('boxb13')); 
  priceAddtn(('colour13'), ('boxa13')); calculate(('boxa13'), ('boxb13'), ('ltotal13')); setTimeout(calculateSum, 30);">
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
             <select name="side13" id="side13" required onChange="customStock(('pam13'), ('stock13'), ('boxb13')); stockCnt(('size13'), ('side13'), ('style13'), ('stock13'));">
             <option></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style13" id="style13" required onChange="customStock(('pam13'), ('stock13'), ('boxb13')); stockCnt(('size13'), ('side13'), ('style13'), ('stock13'));">
             <option></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour13" id="colour13" onChange="stockCnt(('size13'), ('side13'), ('style13'), ('stock13')); price(('size13'), ('boxa13')); priceAddtn(('colour13'), ('boxa13'));
             calculate(('boxa13'), ('boxb13'), ('ltotal13')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi13" value="heidi">LBO-1 </option>
               <option id="carol13" value="carol">LBO-2</option>
     		   <option id="pam13" value="pam">LBO-3</option>
               <option id="molly13" value="molly">LBO-4</option>
               <option id="sasha13" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa13" id="boxa13" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock13" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant13" id="boxb13" class="items" type="text" onBlur="calculate(('boxa13'), ('boxb13'), ('ltotal13')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal13" id="ltotal13" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line14" id="line14" class="line" type="text" value="14:" readonly></td>
   <td>
   <label for="lcomment14">Client:</label>
   <textarea name="lcomment14" id="lcomment14" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 14-->
  <select name="size14" class="size" id="size14" required onChange="price(('size14'), ('boxa14')); stockCnt(('size14'), ('side14'), ('style14'), ('stock14')); customStock(('pam14'), ('stock14'), ('boxb14')); 
   priceAddtn(('colour14'), ('boxa14')); calculate(('boxa14'), ('boxb14'), ('ltotal14')); setTimeout(calculateSum, 30);">
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
             <select name="side14" id="side14" required onChange="customStock(('pam14'), ('stock14'), ('boxb14')); stockCnt(('size14'), ('side14'), ('style14'), ('stock14'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style14" id="style14" required onChange="customStock(('pam14'), ('stock14'), ('boxb14')); stockCnt(('size14'), ('side14'), ('style14'), ('stock14'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour14" id="colour14" onChange="stockCnt(('size14'), ('side14'), ('style14'), ('stock14')); price(('size14'), ('boxa14')); priceAddtn(('colour14'), ('boxa14'));
             calculate(('boxa14'), ('boxb14'), ('ltotal14')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi14" value="heidi">LBO-1 </option>
               <option id="carol14" value="carol">LBO-2</option>
		       <option id="pam14" value="pam">LBO-3</option>
               <option id="molly14" value="molly">LBO-4</option>
               <option id="sasha14" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa14" id="boxa14" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock14" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant14" id="boxb14" class="items" type="text" onBlur="calculate(('boxa14'), ('boxb14'), ('ltotal14')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal14" id="ltotal14" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line15" id="line15" class="line" type="text" value="15:" readonly></td>
   <td>
   <label for="lcomment15">Client:</label>
   <textarea name="lcomment15" id="lcomment15" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 15-->
  <select name="size15" class="size" id="size15" required onChange="price(('size15'), ('boxa15')); stockCnt(('size15'), ('side15'), ('style15'), ('stock15')); customStock(('pam15'), ('stock15'), ('boxb15')); 
    priceAddtn(('colour15'), ('boxa15')); calculate(('boxa15'), ('boxb15'), ('ltotal15')); setTimeout(calculateSum, 30);">
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
             <select name="side15" id="side15" required onChange="customStock(('pam15'), ('stock15'), ('boxb15')); stockCnt(('size15'), ('side15'), ('style15'), ('stock15'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style15" id="style15" required onChange="customStock(('pam15'), ('stock15'), ('boxb15')); stockCnt(('size15'), ('side15'), ('style15'), ('stock15'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour15" id="colour15" onChange="stockCnt(('size15'), ('side15'), ('style15'), ('stock15')); price(('size15'), ('boxa15')); priceAddtn(('colour15'), ('boxa15'));
             calculate(('boxa15'), ('boxb15'), ('ltotal15')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi15" value="heidi">LBO-1 </option>
               <option id="carol15" value="carol">LBO-2</option>
    		   <option id="pam15" value="pam">LBO-3</option>
               <option id="molly15" value="molly">LBO-4</option>
               <option id="sasha15" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa15" id="boxa15" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock15" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant15" id="boxb15" class="items" type="text" onBlur="calculate(('boxa15'), ('boxb15'), ('ltotal15')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal15" id="ltotal15" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line16" id="line16" class="line" type="text" value="16:" readonly></td>
   <td>
   <label for="lcomment16">Client:</label>
   <textarea name="lcomment16" id="lcomment16" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 16-->
  <select name="size16" class="size" id="size16" required onChange="price(('size16'), ('boxa16')); stockCnt(('size16'), ('side16'), ('style16'), ('stock16')); customStock(('pam16'), ('stock16'), ('boxb16')); 
    priceAddtn(('colour16'), ('boxa16')); calculate(('boxa16'), ('boxb16'), ('ltotal16')); setTimeout(calculateSum, 30);">
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
             <select name="side16" id="side16" required onChange="customStock(('pam16'), ('stock16'), ('boxb16')); stockCnt(('size16'), ('side16'), ('style16'), ('stock16'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style16" id="style16" required onChange="customStock(('pam16'), ('stock16'), ('boxb16')); stockCnt(('size16'), ('side16'), ('style16'), ('stock16'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour16" id="colour16" onChange="stockCnt(('size16'), ('side16'), ('style16'), ('stock16')); price(('size16'), ('boxa16')); priceAddtn(('colour16'), ('boxa16'));
             calculate(('boxa16'), ('boxb16'), ('ltotal16')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi16" value="heidi">LBO-1 </option>
               <option id="carol16" value="carol">LBO-2</option>
   			   <option id="pam16" value="pam">LBO-3</option>
               <option id="molly16" value="molly">LBO-4</option>
               <option id="sasha16" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa16" id="boxa16" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock16" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant16" id="boxb16" class="items" type="text" onBlur="calculate(('boxa16'), ('boxb16'), ('ltotal16')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal16" id="ltotal16" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line17" id="line17" class="line" type="text" value="17:" readonly></td>
   <td>
   <label for="lcomment17">Client:</label>
   <textarea name="lcomment17" id="lcomment17" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 17-->
  <select name="size17" class="size" id="size17" required onChange="price(('size17'), ('boxa17')); stockCnt(('size17'), ('side17'), ('style17'), ('stock17')); customStock(('pam17'), ('stock17'), ('boxb17')); 
    priceAddtn(('colour17'), ('boxa17')); calculate(('boxa17'), ('boxb17'), ('ltotal17')); setTimeout(calculateSum, 30);">
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
             <select name="side17" id="side17" required onChange="customStock(('pam17'), ('stock17'), ('boxb17')); stockCnt(('size17'), ('side17'), ('style17'), ('stock17'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style17" id="style17" required onChange="customStock(('pam17'), ('stock17'), ('boxb17')); stockCnt(('size17'), ('side17'), ('style17'), ('stock17'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour17" id="colour17" onChange="stockCnt(('size17'), ('side17'), ('style17'), ('stock17')); price(('size17'), ('boxa17')); priceAddtn(('colour17'), ('boxa17'));
             calculate(('boxa17'), ('boxb17'), ('ltotal17')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi17" value="heidi">LBO-1 </option>
               <option id="carol17" value="carol">LBO-2</option>
    		   <option id="pam17" value="pam">LBO-3</option>
               <option id="molly17" value="molly">LBO-4</option>
               <option id="sasha17" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa17" id="boxa17" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock17" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant17" id="boxb17" class="items" type="text" onBlur="calculate(('boxa17'), ('boxb17'), ('ltotal17')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal17" id="ltotal17" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line18" id="line18" class="line" type="text" value="18:" readonly></td>
   <td>
   <label for="lcomment18">Client:</label>
   <textarea name="lcomment18" id="lcomment18" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 18-->
  <select name="size18" class="size" id="size18" required onChange="price(('size18'), ('boxa18')); stockCnt(('size18'), ('side18'), ('style18'), ('stock18')); customStock(('pam18'), ('stock18'), ('boxb18')); 
    priceAddtn(('colour18'), ('boxa18')); calculate(('boxa18'), ('boxb18'), ('ltotal18')); setTimeout(calculateSum, 30);">
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
             <select name="side18" id="side18" required onChange="customStock(('pam18'), ('stock18'), ('boxb18')); stockCnt(('size18'), ('side18'), ('style18'), ('stock18'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style18" id="style18" required onChange="customStock(('pam18'), ('stock18'), ('boxb18')); stockCnt(('size18'), ('side18'), ('style18'), ('stock18'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour18" id="colour18" onChange="stockCnt(('size18'), ('side18'), ('style18'), ('stock18')); price(('size18'), ('boxa18')); priceAddtn(('colour18'), ('boxa18'));
             calculate(('boxa18'), ('boxb18'), ('ltotal18')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi18" value="heidi">LBO-1 </option>
               <option id="carol18" value="carol">LBO-2</option>
		       <option id="pam18" value="pam">LBO-3</option>
               <option id="molly18" value="molly">LBO-4</option>
               <option id="sasha18" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa18" id="boxa18" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock18" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant18" id="boxb18" class="items" type="text" onBlur="calculate(('boxa18'), ('boxb18'), ('ltotal18')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal18" id="ltotal18" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line19" id="line19" class="line" type="text" value="19:" readonly></td>
   <td>
   <label for="lcomment19">Client:</label>
   <textarea name="lcomment19" id="lcomment19" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 19-->
  <select name="size19" class="size" id="size19" required onChange="price(('size19'), ('boxa19')); stockCnt(('size19'), ('side19'), ('style19'), ('stock19')); customStock(('pam19'), ('stock19'), ('boxb19')); 
    priceAddtn(('colour19'), ('boxa19')); calculate(('boxa19'), ('boxb19'), ('ltotal19')); setTimeout(calculateSum, 30);">
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
             <select name="side19" id="side19" required onChange="customStock(('pam19'), ('stock19'), ('boxb19')); stockCnt(('size19'), ('side19'), ('style19'), ('stock19'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style19" id="style19" required onChange="customStock(('pam19'), ('stock19'), ('boxb19')); stockCnt(('size19'), ('side19'), ('style19'), ('stock19'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour19" id="colour19" onChange="stockCnt(('size19'), ('side19'), ('style19'), ('stock19')); price(('size19'), ('boxa19')); priceAddtn(('colour19'), ('boxa19'));
             calculate(('boxa19'), ('boxb19'), ('ltotal19')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi19" value="heidi">LBO-1 </option>
               <option id="carol19" value="carol">LBO-2</option>
   			   <option id="pam19" value="pam">LBO-3</option>
               <option id="molly19" value="molly">LBO-4</option>
               <option id="sasha19" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa19" id="boxa19" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock19" type="hidden" readonly class="stock"></td>
    <td><label>Quantity</label>&nbsp;<input required name="quant19" id="boxb19" class="items" type="text" onBlur="calculate(('boxa19'), ('boxb19'), ('ltotal19')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal19" id="ltotal19" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
  
   <tr>
   <td><input name="line20" id="line20" class="line" type="text" value="20:" readonly></td>
   <td>
   <label for="lcomment20">Client:</label>
   <textarea name="lcomment20" id="lcomment20" maxlength="100" rows="1" cols="25"></textarea>
  	</td>
     <td><label>Size</label><!--row 20-->
  <select name="size20" class="size" id="size20" required onChange="price(('size20'), ('boxa20')); stockCnt(('size20'), ('side20'), ('style20'), ('stock20')); customStock(('pam20'), ('stock20'), ('boxb20')); 
   priceAddtn(('colour20'), ('boxa20')); calculate(('boxa20'), ('boxb20'), ('ltotal20')); setTimeout(calculateSum, 30);">
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
             <select name="side20" id="side20" required onChange="customStock(('pam20'), ('stock20'), ('boxb20')); stockCnt(('size20'), ('side20'), ('style20'), ('stock20'));">
             <option ></option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select></td>
    <td><label>Style</label>
             <select name="style20" id="style20" required onChange="customStock(('pam20'), ('stock20'), ('boxb20')); stockCnt(('size20'), ('side20'), ('style20'), ('stock20'));">
             <option ></option>
              <option value="full">Regular</option>
              <option value="slight">Slight</option>
              <option value="enh">Enhancer</option>
            </select></td>
    <td><label>Colour</label>
             <select name="colour20" id="colour20" onChange="stockCnt(('size20'), ('side20'), ('style20'), ('stock20')); price(('size20'), ('boxa20')); priceAddtn(('colour20'), ('boxa20'));
             calculate(('boxa20'), ('boxb20'), ('ltotal20')); setTimeout(calculateSum, 60);" required>
             <option ></option>
              <option id="heidi20" value="heidi">LBO-1 </option>
               <option id="carol20" value="carol">LBO-2</option>
    		   <option id="pam20" value="pam">LBO-3</option>
               <option id="molly20" value="molly">LBO-4</option>
               <option id="sasha20" value="sasha">LBO-5</option>
             </select></td>
    <td><label>Price $</label><input name="boxa20" id="boxa20" type="text" class="price" readonly onChange="calculateSum();"></td>
    <!--<td><label>In Stock: </label>--><input name="stock" id="stock20" type="hidden" readonly class="stock">
    <td><label>Quantity</label>&nbsp;<input required name="quant20" id="boxb20" class="items" type="text" onBlur="calculate(('boxa20'), ('boxb20'), ('ltotal20')); calculateSum(); 
     calculateItems()"></td>
    <td ><label>Line Total $</label><input name="ltotal20" id="ltotal20" class="tot" type="text" readonly></td>
    <!--<td><input name="del" type="button" value="Delete Row" class="noprint" onClick="setTimeout(calculateSum, 30); setTimeout(calculateItems, 30);"></td>-->
  </tr>
    <tr>
    <td colspan="11">You have reached the maximum number of rows for this order.  If you need to order more items, please send this order and start a new order with the remaining items.<br>  You can use the same PO number.</td>
    </tr>
    
     <tr style="display:table-row">
     
  <td height="38">Comments: </td>
  <td colspan="3"><textarea style="margin-top:30px;" name="instr" id="instr" col cols="30" rows="3" maxlength="200"></textarea></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><label style="padding-left:22px">Items: </label><input name="numItems" id="numItems" type="text" readonly></td>
  <td><label>Order Total $</label><input name="totalPrice" id="totalPrice" type="text" readonly></td>
     </tr>
  
 
  <input type="hidden" name="good_template" value="../template/thanks.htm" />
  <input type="hidden" name="template" value="tmplt.htm" />
  <input type="hidden" name="recipients" value="gmitchell909@gmail.com, salesorder@lisaboriginals.ca">
  <input type="hidden" name="mail_options"value="HTMLTemplate=tmplt.htm" />
  <input type="hidden" name="subject" value="Order Form Submission" />
  <input type="hidden" name="derive_fields" value="imgverify=g-recaptcha-response,arverify=imgverify" />		
  <input type="hidden" name="autorespond" value="HTMLTemplate=arthanks.html,Subject=Your 0rder confirmation" />
  <center> Prices Subject To Change<br>Without Notice<br><h2 id="warning" class="noprint">The following 6 information fields are required:</h2><br>
 
  <label for="realName">Name: </label><input id="realName" name="realName" type="text" value="<?php echo $userRow['user_name'];?>" readonly required>&nbsp;&nbsp;
  <label for="email">Email: </label><input name="email" type="email" value="<?php echo $userRow['user_email'];?>" readonly required>&nbsp;&nbsp;
  <label for="storeid">Store ID: </label><input name="storeid" id="storeid" type="text" value="<?php echo $userRow['dealer'];?>" readonly required>&nbsp;&nbsp;
  <input name="paidup" id="paidup" type="hidden" value="<?php echo $userRow['paid'];?>">
  <label>&nbsp;Date:</label><input name="date" id="date" type="text" size="8" required value="<?php echo(date("Y-m-d"))?>" readonly></p><br>&nbsp;&nbsp;
  <input name="paidup" id="paidup" type="hidden" value="<?php echo $userRow['paid'];?>">
  
  <label for="po">Purchase Order Number: </label><input name="po" id="po" type="text" placeholder="Required*" required>&nbsp;&nbsp;&nbsp;&nbsp;
  <label for="page">Page: </label><input class="pg" name="page" id="page" type="text" placeholder="Req. *"  required> of <input name="pageof" id="pageof" class="pg" type="text"><br></center>
      
  
</table>
<input id="show" class="noprint" type="button" value="Add Row">
<br>
 
<center>
<div class="g-recaptcha" data-sitekey="6LfPJA8UAAAAADS63o8oMVRhVViZGFdx40kSvNlD"></div>
      <br/>
  <input name="sub" class="noprint" id="sub" type="submit" value="Submit to Lisa B" onClick="checkValidity()"></center>
</form>

	</div>

<script>
function showDelete() {
	var delBtn = document.getElementById("del")
	delBtn.style.display = "inline";
}


function price(size, cost) {
	var paidup = document.getElementById("paidup").value;
	var sel = document.getElementById(size);
	var price = sel.options[sel.selectedIndex].value;

switch (price*1) {
	
    case 2:
			if(paidup == "paid") {
        val = document.getElementById("price1").value;
		}else{
			val = (document.getElementById("price1").value * 1.05).toFixed(2);
		}
		break;														//set the price for the size 
																	//if paid up or if not paid up add 5%
    case 3:
        if(paidup == "paid") {
        val = document.getElementById("price5").value;
		}else{
			val = (document.getElementById("price5").value * 1.05).toFixed(2);
		}
        break;
    case 4:
        if(paidup == "paid") {
        val = document.getElementById("price9").value;
		}else{
			val = (document.getElementById("price9").value * 1.05).toFixed(2);
		}
        break;
    case 5:
        if(paidup == "paid") {
        val = document.getElementById("price13").value;
		}else{
			val = (document.getElementById("price13").value * 1.05).toFixed(2);
		}
        break;
    case 6:
        if(paidup == "paid") {
        val = document.getElementById("price18").value;
		}else{
			val = (document.getElementById("price18").value * 1.05).toFixed(2);
		}
        break;
    case 7:
        if(paidup == "paid") {
        val = document.getElementById("price21").value;
		}else{
			val = (document.getElementById("price21").value * 1.05).toFixed(2);
		}
        break;
    case 8:
        if(paidup == "paid") {
        val = document.getElementById("pricex").value;
		}else{
			val = (document.getElementById("pricex").value * 1.05.toFixed(2));
		}
        break;
    case 9:
        if(paidup == "paid") {
        val = document.getElementById("price29").value;
		}else{
			val = (document.getElementById("price29").value * 1.05).toFixed(2);
		}
        break;
    case 10:
        if(paidup == "paid") {
        val = document.getElementById("price33").value;
		}else{
			val = (document.getElementById("price33").value * 1.05).toFixed(2);
		}
        break;
    case 11:
        if(paidup == "paid") {
        val = document.getElementById("price37").value;
		}else{
			val = (document.getElementById("price37").value * 1.05).toFixed(2);
		}
        break;
    case 12:
        if(paidup == "paid") {
        val = document.getElementById("price41").value;
		}else{
			val = (document.getElementById("price41").value * 1.05).toFixed(2);
		}
        break;
    case 13:
        if(paidup == "paid") {
        val = document.getElementById("price45").value;
		}else{
			val = (document.getElementById("price45").value * 1.05).toFixed(2);
		}
        break;
    case 14:
        if(paidup == "paid") {
        val = document.getElementById("price49").value;
		
		}else{
			val = (document.getElementById("price49").value * 1.05).toFixed(2);
		 }
		}
		
		 var nonCustomPrice = document.getElementById(cost);
		nonCustomPrice.value = val;
		return val
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


function priceAddtn(color, boxa) {	
	var e = document.getElementById(color);
	var choice = e.options[e.selectedIndex].value;
	if(choice != "pam") {
		var colourPrice = 25									//flat $25 added for custom colours.  If this amount changes, rememmber to change text too
		var adjustedPrice =  (val*1) + colourPrice;
		document.getElementById(boxa).value = adjustedPrice;
	} else {
	document.getElementById(boxa).value = val;
}
}
  
function customStock(x, y, z) {								
	var pick = document.getElementById(x).selected;			 
	if(pick == true) {
		var stkbox = document.getElementById(y);
		var stkV = stkbox.value;													//get quantity in stock
		var stockV = parseInt(stkV);												//make it an integer
		var orderbox = document.getElementById(z);
		var boxV = orderbox.value;													//get quantity ordered
		var order = parseInt(boxV);													//make it an integer
		if(order == 1000) {														// if ordered is more than stock, reduce ordered to stock
			document.getElementById(z).value = document.getElementById(y).value;	//and display popup	
			
			//showDialog();		//don't show popup if we are not using quantities
			//alert("Your order for this item has been reduced to the quantity in stock.");
		}
			calculateItems();
		
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
function hasHtml5Validation () {
  return typeof document.createElement('input').checkValidity === 'function';
}

if (hasHtml5Validation()) {
  $('.validate-form').submit(function (e) {
    if (!this.checkValidity()) {
      e.preventDefault();
      $(this).addClass('invalid');
      $('#status').html('invalid');
    } else {
      $(this).removeClass('invalid');
      $('#status').html('submitted');
    }
  });
}	
	
    </script>

</body>
</html>

 
