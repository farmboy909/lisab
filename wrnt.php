<?php

//Set no caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
	header("Location: register/warrantyLogin.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$MySQLi_CON->close();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Warranty Claim</title>
<script
	src="https://code.jquery.com/jquery-3.1.0.min.js"
	integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
	crossorigin="anonymous"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify-3.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">

<style>
/*from order*/
#LisaBOriginals {
	color:#0091F5;
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
	border-color:#0091F5;
	text-align:center;
	width:825px;
	margin: 0px auto 25px auto;
}
alert {
	color:0091F5;
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

		.line {
			width:30px;
			font-weight:bold;
		}
		.lncomment {
			size:30px;
		}
/*from order end*/
#upload {
	width:400px;
	margin-left:auto;
	margin-right:auto;
	margin-top:30px;
	text-align:center;
}
#form {
	text-align:center;
	width:1100px;
	margin-left:auto;
	margin-right:auto;
}

textarea { 
	margin: 1em; 
	outline: none; 
	text-align: justify; 
}
#sub {
	margin-top:30px;
	margin-bottom:50px;
}
h1 {
	text-decoration:underline;
	padding-bottom:0px;
}
.invNum {
	width:70px;
}
.po {
	width:70px;
}
tr {
	display:none;
}
.unhide {
	display:inline;
}
.print:last-child {
     page-break-after: auto;
}
	
#wrntText {
	font-size: 16px;
	line-height:1.5;
}
.justify {
	text-align:justify;
}
.bigBox {
	width:400px;
	height:200px;
	transition:all 0.5s ease;
	z-index:100;
}
@media print {
	.noprint {
		display:none;
}
}
</style>

<body>
<?php include_once 'stock_price.php'; ?>
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
            <li ><a id="LisaBOriginals" class="noprint" href="http://www.lisaboriginals.ca/training.php">Training</a></li>
            <li><a id="LisaBOriginals" class="noprint" href="http://www.lisaboriginals.ca/order.php">Dealer Order</a></li>
            <li class="active"><a id="LisaBOriginals" class="noprint" href="http://www.lisaboriginals.ca/warranty.php">Warranty Claim</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="LisaBOriginals" href="#"><span class="glyphicon glyphicon-user noprint"></span>&nbsp; <?php echo $userRow['user_name']; ?></a></li>
            <li><a id="LisaBOriginals" href="../register/logout.php?logout"><span class="glyphicon glyphicon-log-out noprint"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<center><img src="images/logo.png" style="margin-top:70px" alt="logo"></center>
<div id="form">

    Images of the sales invoice and the product can be sent by email to <a href="mailto:warranty@lisaboriginals.ca">warranty@lisaboriginals.ca</a>
    
    <br>
    <h1>Warranty Claim</h1>
    <div id="wrntText">
      <p class="justify"><span style="text-decoration:underline; font-weight:bold;" >Warranty</span>.  Quality is our highest priority at Lisa B Originals.  Lisa B Originals breast prosthetics are hand made by skilled artisans.  Small irregularities in skin 
      colorations and textures are hallmarks of such craftsmanship and should not be considered defects but as a sign of unique authenticity, such as those found on our own natural bodies. 
      If you feel damage to your Lisa B Originals product is due to a manufacturer’s defect, please contact the outlet where you purchased the product.  Returned products are inspected by 
      our Quality Team and replaced if the damage is the result of a manufacturing defect and not caused by misuse or activities other than for the intended purpose. Your Lisa B Originals 
      breast prostheseses are warranted to be free of defects in materials and workmanship for two (2) years from the original date of sale to the original consumer purchaser.  Lisa B products
      that have been modified or altered are excluded from this warranty; specifically, but without limitation, attaching or applying to our product any material, object or product that 
      was not manufactured by Lisa B Originals will void the warranty.  Lisa B Originals prostheses are not recommended to be worn <span style="text-decoration:underline; font-style:italic;">inside</span> pockets of specialty bras as this may void your warranty.  Twisting or excessive 
      squeezing of your prosthesis may cause damage to the inside of your prosthesis.  Prosthesis must be stored in its original container when not in use to retain its shape.</p> 
	  <!--extra . removed after "intended purpose."??-->
      <p class="justify">Lisa B Originals will provide a free breast prosthesis to replace the defective one during the warranty period.  You must notify your Lisa B Originals retailer promptly and to allow 
      them to inspect the product and order a replacement. The defective product must be returned freight prepaid to Lisa B Originals once the replacement product is received. 
      Transportation, postage and insurance charges are consumer’s responsibility.  This warranty is limited to the replacement of the defective item.  Lisa B Originals will not be liable 
      for any damages, including consequential, incidental, direct, indirect, or special damages, caused by any defect in this product beyond the amount of the replacement product.  The 
      foregoing is your sole and exclusive remedy against Lisa B Originals for any damages suffered by you.  Any warranties implied by law, including the warranties of merchantability and 
      fitness for a particular purpose, are limited in duration to the term of this limited warranty.  This limited warranty is in lieu of any and all other express warranties, which are 
      hereby disclaimed.  Some provinces and/or states do not allow limitations on how long an implied warranty lasts or the exclusion of or limitation on incidental, special, indirect 
      or consequential damages, so the above limitations or exclusions may not apply to you.  This limited warranty gives you specific legal rights and you may also have other rights 
      which vary from province/state to province/state.
</p>
    </div>
    <hr>
    <form id="wrnt" action="formmail.php" method="post" name="wrnt">
    
  <label for="realName">Name: </label>
  <input name="realName" id="realName" type="text" value="<?php echo $userRow[user_name];?>" required>&nbsp;&nbsp;		
         
  <label for="email">email: </label>
  <input name="email" id="email" type="email" value="<?php echo $userRow[user_email];?>" required>&nbsp;&nbsp;		
         
  <label for="storeid">Store ID: </label>
  <input name="storeid" id="storeid" type="text" value='<?php echo $userRow[dealer];?>' readonly required><br>		
    <!--row 1-->
   <table width="1200" border="0">
  <tr style="display:inline;">
  
   <td>
   <label for="lcomment1">Client:</label>
   <textarea name="lcomment1" id="lcomment1" maxlength="50" rows="1" cols="25" onClick="function();"></textarea>
      <label for="size1">Size:</label>
      <select name="size1" size="1" class="size" id="size1" required>		
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
      </select>
      
      <label>Side:</label>
      <select name="side1" id="side1" required>		
        <option ></option>
        <option value="left">Left</option>
        <option value="right">Right</option>
    </select>
      
      <label>Style:</label>
      <select name="style1" id="style1" required>		
        <option ></option>
        <option value="full">Full</option>
        <option value="slight">Slight</option>
    </select>
      
      <label>Colour:</label>
      <select name="colour1" id="colour1" required>		
        <option></option>
        <option id="heidi1" value="heidi">01-Heidi</option>
        <option value="carol">02-Carol</option>
        <option id="pam1" value="pam">03-Pam</option>
        <option value="molly">04-Molly</option>
        <option value="sasha">05-Sasha</option>
    </select>
    
    <label>In Stock: </label><input name="stock1" type="text" id="stock1" readonly class="stock">
    
        <label>Sales Invoice:</label>
    <input name="invNum1" id="invNum1" class="invNum" type="text" maxlength="20"required>		
    
    <label for="po1">PO: </label>
    <input name="po1" id="po1" class="po" type="text" maxlength="20" placeholder="Required*" required>		
    
    </td> 
   </tr><br>
        
    <!--row 2-->
    
    <tr>
    <td>
   <label for="lcomment2">Client:</label>
   <textarea name="lcomment2" id="lcomment2" maxlength="50" rows="1" cols="25" onClick="function();"></textarea>
    <label for="size2">Size:</label>
    <select name="size2" size="1" class="size" id="size2" required>
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
      </select>
      
      <label>Side:</label>
    <select name="side2" id="side2" required>
        <option ></option>
        <option value="left">Left</option>
        <option value="right">Right</option>
        </select>
      
      <label>Style:</label>
    <select name="style2" id="style2" required>
        <option ></option>
        <option value="full">Full</option>
        <option value="slight">Slight</option>
        </select>
      
      <label>Colour:</label>
    <select name="colour2" id="colour2" required>
        <option></option>
        <option id="heidi1" value="heidi">01-Heidi</option>
        <option value="carol">02-Carol</option>
        <option id="pam1" value="pam">03-Pam</option>
        <option value="molly">04-Molly</option>
        <option value="sasha">05-Sasha</option>
        </select>
        
        <label>In Stock: </label><input name="stock2" type="text" id="stock2" readonly class="stock">
        
    
        <label>Sales Invoice:</label>
    <input name="invNum2" id="invNum2" class="invNum" type="text" maxlength="20" required>
    
    <label for="po2">PO: </label><input name="po2" id="po2" class="po" type="text" maxlength="20" placeholder="Required*" required>
    </td></tr><br>
    <!--row 3-->
    <tr>
    <td>
    <label for="lcomment3">Client:</label>
    <textarea name="lcomment3" id="lcomment3" maxlength="50" rows="1" cols="25" onClick="function();"></textarea>
      <label for="size3">Size:</label>
    <select name="size3" size="1" class="size" id="size3" required>
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
      </select>
      
      <label>Side:</label>
    <select name="side3" id="side3" required>
        <option ></option>
        <option value="left">Left</option>
        <option value="right">Right</option>
        </select>
      
      <label>Style:</label>
    <select name="style3" id="style3" required>
        <option ></option>
        <option value="full">Full</option>
        <option value="slight">Slight</option>
        </select>
      
      <label>Colour:</label>
    <select name="colour3" id="colour3" required>
        <option></option>
        <option id="heidi1" value="heidi">01-Heidi</option>
        <option value="carol">02-Carol</option>
        <option id="pam1" value="pam">03-Pam</option>
        <option value="molly">04-Molly</option>
        <option value="sasha">05-Sasha</option>
        </select>
        
        <label>In Stock: </label><input name="stock3" type="text" id="stock3" readonly class="stock">
        
    
        <label>Sales Invoice:</label>
    <input name="invNum3" id="invNum3" class="invNum" type="text" maxlength="20" required>
    
    <label for="po3">PO: </label><input name="po3" id="po3" class="po" type="text" maxlength="20" placeholder="Required*" required>
    
    </td></tr><br> 
    
    <!--row 4-->
    <tr>
    <td>
    <label for="lcomment4">Client:</label>
    <textarea name="lcomment4" id="lcomment4" maxlength="50" rows="1" cols="25" onClick="function();"></textarea>
      <label for="size4">Size:</label>
    <select name="size4" size="1" class="size" id="size4" required>
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
    </select>
      
      <label>Side:</label>
    <select name="side4" id="side4" required>
        <option ></option>
        <option value="left">Left</option>
        <option value="right">Right</option>
    </select>
      
      <label>Style:</label>
    <select name="style4" id="style4" required>
        <option ></option>
        <option value="full">Full</option>
        <option value="slight">Slight</option>
    </select>
      
      <label>Colour:</label>
    <select name="colour4" id="colour4" required>
        <option></option>
        <option id="heidi1" value="heidi">01-Heidi</option>
        <option value="carol">02-Carol</option>
        <option id="pam1" value="pam">03-Pam</option>
        <option value="molly">04-Molly</option>
        <option value="sasha">05-Sasha</option>
    </select>
    
    <label>In Stock: </label><input name="stock4" type="text" id="stock4" readonly class="stock">
    
    
        <label>Sales Invoice:</label>
    <input name="invNum4" id="invNum4" class="invNum" type="text" maxlength="20" required>
    
    <label for="po4">PO: </label><input name="po4" id="po4" class="po" type="text" maxlength="20" placeholder="Required*" required>
    
    </td></tr><br> 
    
     <!--row 5-->
     <tr>
     <td>
     <label for="lcomment5">Client:</label>
    <textarea name="lcomment5" id="lcomment5" maxlength="50" rows="1" cols="25" onClick="function();"></textarea>
      <label for="size5">Size:</label>
    <select name="size5" size="1" class="size" id="size5" required>
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
    </select>
      
      <label>Side:</label>
    <select name="side5" id="side5" required>
        <option ></option>
        <option value="left">Left</option>
        <option value="right">Right</option>
    </select>
      
      <label>Style:</label>
    <select name="style5" id="style5" required>
        <option ></option>
        <option value="full">Full</option>
        <option value="slight">Slight</option>
    </select>
      
      <label>Colour:</label>
    <select name="colour5" id="colour5" required>
        <option></option>
        <option id="heidi1" value="heidi">01-Heidi</option>
        <option value="carol">02-Carol</option>
        <option id="pam1" value="pam">03-Pam</option>
        <option value="molly">04-Molly</option>
        <option value="sasha">05-Sasha</option>
    </select>
    
    <label>In Stock: </label><input name="stock5" type="text" id="stock5" readonly class="stock">
    
    
        <label>Sales Invoice:</label>
    <input name="invNum5" id="invNum5" class="invNum" type="text" maxlength="20" required>
    
    <label for="po5">PO: </label><input name="po5" id="po5" class="po" type="text" maxlength="20" placeholder="Required*" required>
    </td></tr>
    <tr class="noprint">
    <td>You have reached the maximum number of rows for this warranty claim.  If you need to claim more items, please send this claim and start a new claim with the remaining items.</td>
    </tr>
    <br>  
      <tr style="display:block;">
      <td>
      <input id="show" class="noprint" type="button" value="Add Row" style="text-align:left">  
     </td></tr>
      <tr style="display:inline;">
      <td>
        <input type="hidden" name="recipients" value="warranty@lisaboriginals.ca, gmitchell909@gmail.com">		<!--gmitchell909@gmail.com, , warranty@lisaboriginals.ca-->
        <input type="hidden" name="template" value="warTmpl.htm" />
  		<input type="hidden" name="mail_options"value="HTMLTemplate=warTmpl.htm" />
  		<input type="hidden" name="subject" value="Warranty Form Submission" />
        <input type="hidden" name="autorespond" value="HTMLTemplate=arwar.html,Subject=Your Warranty Claim confirmation" />
        <div class="g-recaptcha" data-sitekey="6LfPJA8UAAAAADS63o8oMVRhVViZGFdx40kSvNlD"></div>
      <br/>
		<input type="hidden" name="derive_fields" value="imgverify=g-recaptcha-response,arverify=imgverify" />			<!--,arverify=imgverify-->
    <input name="sub" id="sub" class="noprint" type="submit" value="Submit to Lisa B">
  </form>
  </td></tr>
   </table>
   
</div><!--end form-->
   
      
<script>
function prn() {
	 window.print();
}
//function bigBox () {
	//var d = document.getElementById("lcomment1");
//d.className += " bigBox";

$(document).ready(function(){							//hidden inputs not required otherwise partial claim will not submit
    $("#sub").click(function(){
    $(":input:hidden").removeAttr('required');
		});
    });
	
$(function() {
    //  changes mouse cursor when highlighting lower right of box
    $(document).on('mousemove', 'textarea', function(e) {
		var a = $(this).offset().top + $(this).outerHeight() - 16,	//	top border of bottom-right-corner-box area
			b = $(this).offset().left + $(this).outerWidth() - 16;	//	left border of bottom-right-corner-box area
		$(this).css({
			cursor: e.pageY > a && e.pageX > b ? 'nw-resize' : ''
		});
	})
    //  the following makes the textbox "Auto-Expand" as it is typed in
    .on('keyup', 'textarea', function(e) {
        //  the following will help the text expand as typing takes place
        while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
            $(this).height($(this).height()+1);
        };
    });
});

function smallBox() {
	document.getElementById("lcomment1").className = "lcomment";
}
$(document).ready(function(){											//show next line
    $("#show").click(function(){
     $("tr:hidden:first").addClass("unhide");
    });
});

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
		
		function customStock(x, y, z) {												//x = pam?  y = lookuptable quantity  z = where value should appear
	var pick = document.getElementById(x).selected;			 
	if(pick == true) {
		var stkbox = document.getElementById(y);									//get quantity in stock
		z.value = stkbox.value;													
	}else{
		z.value = 0;																//if colour is not pam? stock will be zero
	}
};

</script>

</body>
</html>
