<?php
session_start();
/*if(isset($_SESSION['userSession'])!="")
{
	header("Location: order.php");
}*/
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$uname = $MySQLi_CON->real_escape_string(trim($_POST['user_name']));			
	$dealer = $MySQLi_CON->real_escape_string(trim($_POST['dealer']));				
	$email = $MySQLi_CON->real_escape_string(trim($_POST['user_email']));
	$phone = $MySQLi_CON->real_escape_string(trim($_POST['phone']));
	$web = 	$MySQLi_CON->real_escape_string(trim($_POST['web']));		 
	$upass = $MySQLi_CON->real_escape_string(trim($_POST['pass']));
	$cnfpass = $MySQLi_CON->real_escape_string(trim($_POST['cnfpass']));			
	$billBusname = $MySQLi_CON->real_escape_string(trim($_POST['billBusname']));	
	$pass = $MySQLi_CON->real_escape_string(trim($_POST['pass']));
	$cnfpass = $MySQLi_CON->real_escape_string(trim($_POST['cnfpass']));
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
	
//	start validation

if(isset($_POST["btn-signup"])) {
	
if(empty($uname)) {
  $nameError = "Please enter your name!";
 }
 if(empty($dealer)) {
	 $dealerError = "Please enter store number!";
 }

 if(empty($email)) {
	$emailError = 'Please enter your email address!';
	 }
 if(empty($phone) ){
 $phoneError = "Please enter your phone number!";
 }
 if(empty($upass)) {
	 $upassError = 'Please enter a password!';
 }
 if(empty($billBusname)) {
  $billBusnameError = "Please enter a Business name!";
 }
 if(empty($billad1))
 {
  $billad1Error = "Please enter a valid Address!";
 }
 if(empty($billcity))
 {
  $billcityError = "Please enter a City!";
 }
 if(empty($billprov)) {
  $billprovError = "Please enter a Province!";
 }
 if(empty($billcountry))
 {
  $billcountryError = "Please enter a Country!";
 }
 if(empty($billPostalC)) {
	$billPostalCError = "Please enter a Postal Code!";
 }
 if(empty($shipBusname)) {
  $shipBusnameError = "Please enter a Shipping Business Name!";
 }
 if(empty($shipad1)) {
  $shipad1Error = "Please enter a Shipping Business Address!";
 }
 if(empty($shipcity)) {
  $shipcityError = "Please enter a City!";
 }
 if(empty($shipprov)) {
  $shipprovError = "Please enter a Shipping Province!";
 }
 if(empty($shipcountry)) {
  $shipcountryError = "Please enter a Shipping Country!";
 }
 if(empty($shipPostal)) 
 {
	 $shipPostalError = "Please enter a Postal Code!";
 }
}
//	end validation	
	
	$new_password = md5($upass);
	
	$check_email = $MySQLi_CON->query("SELECT user_email FROM users WHERE user_email='$email'");
	$count=$check_email->num_rows;
	
	if($count==0){
		
		$query = "INSERT INTO users(
		user_name,
		dealer,
		user_email,
		phone,
		website,
		user_pass,
		billBusname,
		billad1,
		billad2,
		billcity,
		billprov,
		billcountry,
		billPostalC,
		shipBusname,
		shipad1,
		shipad2,
		shipcity,
		shipprov,
		shipcountry,
		shipPostal
		) VALUES(
		'$uname',
		'$dealer',
		'$email',
		'$phone',
		'$web',
		'$new_password',
		'$billBusname',
		'$billad1',
		'$billad2',
		'$billcity',
		'$billprov',
		'$billcountry',
		'$billPostalC',
		'$shipBusname',
		'$shipad1',
		'$shipad2',
		'$shipcity',
		'$shipprov',
		'$shipcountry',
		'$shipPostal'
		)";
		
		if($MySQLi_CON->query($query))
		{
			$msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
					</div>";
		}
		else
		{
			$msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
					</div>";
		}
	}
	else{
		
		
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
				</div>";
			
	}
	}
	
	$MySQLi_CON->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/publicCommon.css" rel="stylesheet" type="text/css">
<title>Login & Registration</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script> 
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
#copy {
	float:right;
}

</style>

</head>
<body>

<div class="signin-form">

	<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top noprint">
      <div class="container"><!--added-->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only noprint">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif" class="navbar-brand" href="http://www.lisaboriginals.ca"><span style="color:#0091fe;">Lisa B Originals</span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
          <ul style="font-size:16px;" class="nav navbar-nav">
          	<li><a href="../index.php" style="color:#0091fe;">Home</a></li>
            <li><a href="../publicFacingPages/about.php" style="color:#0091fe;">About Us</a></li>
            <li><a href="../publicFacingPages/overview.php" style="color:#0091fe;">Product Overview</a></li>
            <li><a href="../publicFacingPages/guide.php" style="color:#0091fe;">Bra Fitting Guide</a></li>
			<li><a href="../publicFacingPages/dealer.html" style="color:#0091fe;">Become a Dealer</a></li>
            <li class="active"><a href="../register/register.php" style="color:#0091fe;">Register</a></li>
			<li><a href="../publicFacingPages/contact.html" style="color:#0091fe;">Contact Us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../order.php">Dealer Order</a></li>
          </ul>
        </div><!--/.nav-collapse-->
      </div>
    </nav> 
        
       <form class="form-signin" method="post" id="register-form">
      
        <h2 class="form-signin-heading" style="color:#0091fe;; display:inline">Dealer Registration<img style="float:right; display:inline" src="../images/lboLogoNoHug.gif" width="70" height="45" alt="blue oval with lisa b originals inside"/></h2>
        <hr />
        <?php
		if(isset($msg)){
			echo $msg;
		}
		else{
			?>
            <!--<div class='alert alert-info'>
				<span class='glyphicon glyphicon-asterisk'></span> &nbsp; fields marked are <span style="color:#F00;">not</span> mandatory !
		 </div>-->
            <?php
		}
		?>
          
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Username" name="user_name" required="required" value="<?php if(isset($uname)){echo $uname;} ?>"  
		  <?php if(isset($unameError)){ echo "autofocus"; }  ?> />			<!--required="required"-->
        <span class="text-danger"><?php echo $nameError; ?></span>
        </div>
        
        <div class="form-group">
        <label for="dealer">Store Number</label>
        <input type="text" class="form-control" placeholder="Store Number" name="dealer" id="dealer" required="required" value="<?php if(isset($dealer)){echo $dealer;} ?>"  
        pattern="[A-Z]{2}[0]{2}[1-9]{2}"
		<?php if(isset($dealerError)){ echo "autofocus"; }  ?> />		
        <span class="text-danger"><?php echo $dealerError; ?></span>
        </div><!---->
        
        <div class="form-group">
        <input type="text" class="form-control" 
        placeholder="Email address" name="user_email" id="user_email" required="required" value="<?php if(isset($email)){echo $email;} ?>" 
		<?php if(isset($emailError)){ echo "autofocus"; }  ?> />
        <span class="text-danger"><?php echo $emailError; ?></span>
        </div>
        
        
        <div class="form-group">
        <input type="text" class="form-control" 
        placeholder="Phone number" name="phone" id="phone" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);" required="required"
        value="<?php if(isset($phone)){echo $phone;} ?>"  <?php if(isset($phoneError)){ echo "autofocus"; } ?> />
        <span class="text-danger"><?php echo $phoneError; ?></span>
        </div>
        
       <!-- pattern="/(?:1-?)?(?:\(\d{3}\)|\d{3})[-\s.]?\d{3}[-\s.]?\d{4}/"-->
        
        <div class="form-group">
        <input type="text" class="form-control" 
        placeholder="Website  Optional" name="web" id="web" value="<?php if(isset($web)){echo $web;} ?>" />	
        </div>
        
         <!--pattern='^(https?:\/\/)?([\da-z\.-]+\.[a-z\.]{2,6}|[\d\.]+)([\/:?=&#]{1}[\da-z\.-]+)*[\/\?]?$'....onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);"-->
        
        <div class="form-group">
        <input type="password" class="form-control" id="pass" placeholder="Password" name="pass"  required="required" value="<?php if(isset($upass)){echo $upass;} ?>" 
		<?php if(isset($upassError)){ echo "autofocus"; } ?> />
        <span class="text-danger"><?php echo $upassError; ?></span>
        </div>
        
        <div class="form-group">
        <input type="password" name="cnfpass" id="cnfpass" class="form-control" placeholder="Confirm Password"  required="required" value="<?php if(isset($cnfpass)){echo $cnfpass;} ?>" />
        </div>
        
        <div id="confirmMessage"></div>
        
        <hr />
        
        <div class="form-group">        
        <center>Billing Information</center>
          <input type="text" class="form-control" placeholder="Business Name" name="billBusname" id="billBusname" required="required" 
          value="<?php if(isset($billBusname)){echo $billBusname;} ?>"
          <?php if(isset($billBusnameError)){ echo "autofocus"; }  ?> />
          <span class="text-danger"><?php echo $billBusnameError ; ?></span>
        </div>
        
		<div class="form-group"></div>
        
		 <div class="form-group">
       <input type="text" name="billad1" class="form-control" placeholder="Address 1" id="billad1" required="required" 
       value="<?php if(isset($billad1)){echo $billad1;} ?>"  <?php if(isset($billad1Error)){ echo "autofocus"; }  ?>  />
       <span class="text-danger"><?php echo $billad1Error ; ?></span>
        </div>
        
        <div class="form-group">
       <input type="text" name="billad2" class="form-control" id="billad2" placeholder="Address 2  Optional" value="<?php if(isset($billad2)){echo $billad2;} ?>" />
        </div>
        
        <div class="form-group">
       <input type="text" name="billcity" class="form-control" id="billcity" placeholder="City" required="required" value="<?php if(isset($billcity)){echo $billcity;} ?>"  
	   <?php if(isset($billcityError)){ echo "autofocus"; }  ?>  />
       <span class="text-danger"><?php echo $billcityError ; ?></span>
        </div>
        
        <div class="form-group">
       <input type="text" name="billprov" class="form-control" id="billprov" placeholder="Prov/State/Region" required="required" value="<?php if(isset($billprov)){echo $billprov;} ?>" 
	   <?php if(isset($billprovError)){ echo "autofocus"; }  ?>  />
       <span class="text-danger"><?php echo $billprovError ; ?></span>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" id="billcountry"  placeholder="Country" name="billcountry" required="required"value="<?php if(isset($billcountry)){echo $billcountry;} ?>"  
		<?php if(isset($billcountryError) ){ echo "autofocus"; }  ?>  />
        <span class="text-danger"><?php echo $billcountryError; ?></span>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" id="billPostalC" placeholder="Postal Code/Zip" name="billPostalC" required="required" 
        value="<?php if(isset($billPostalC)){echo $billPostalC;} ?>"  
		<?php if(isset($billPostalCError)){ echo "autofocus"; }  ?>  />
        <span class="text-danger"><?php echo $billPostalCError; ?></span>
        </div>
        
        <hr />
        
         <div class="form-group">
         Shipping Information
         
         
         <input name="copy" type="button" class="btn btn-default" id="copy" value="Same as Billing" />
         </div>	
        
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Business Name" name="shipBusname" id="shipBusname" required="required" 
        value="<?php if(isset($shipBusname)){echo $shipBusname;} ?>"  
		<?php if(isset($shipBusnameError)){ echo "autofocus"; }  ?>  />
        <span class="text-danger"><?php echo $shipBusnameError; ?></span>
        </div>
        
        <div class="form-group">
       <input type="text" name="shipad1" id="shipad1" class="form-control" placeholder="Address 1" required="required" value="<?php if(isset($shipad1)){echo $shipad1;} ?>"  
	   <?php if(isset($shipad1Error)){ echo "autofocus"; }  ?>  />
       <span class="text-danger"><?php echo $shipad1Error; ?></span>
        </div>
        
        <div class="form-group">
       <input type="text" name="shipad2" id="shipad2" class="form-control" placeholder="Address 2  Optional" value="<?php if(isset($shipad2)){echo $shipad2;} ?>" />
        </div>
        
          <div class="form-group">
       <input type="text" name="shipcity" id="shipcity" class="form-control" placeholder="City" required="required" value="<?php if(isset($shipcity)){echo $shipcity;} ?>" 
       <?php if(isset($shipcityError)){ echo "autofocus"; }  ?>  />
       <span class="text-danger"><?php echo $shipcityError; ?></span>
        </div>
        
        <div class="form-group">
       <input type="text" name="shipprov" class="form-control" id="shipprov" placeholder="Prov/State/Region" required="required" value="<?php if(isset($shipprov)){echo $shipprov;} ?>"  
	   <?php if(isset($shipprovError)){ echo "autofocus"; }  ?>  />
       <span class="text-danger"><?php echo $shipprovError; ?></span>
        </div>
        
        <div class="form-group">
       <input type="text" name="shipcountry" id="shipcountry" class="form-control" placeholder="Country" required="required" value="<?php if(isset($shipcountry)){echo $shipcountry;} ?>"  
	   <?php if(isset($shipcountryError)){ echo "autofocus"; }  ?>  />
       <span class="text-danger"><?php echo $shipcountryError ; ?></span>
        </div>
        
         <div class="form-group">
       <input type="text" name="shipPostal" id="shipPostal" class="form-control" placeholder="Postal/Zip Code"  required="required"value="<?php if(isset($shipPostal)){echo $shipPostal;} ?>"  
	   <?php if(isset($shipPostalError)){ echo "autofocus"; }  ?>  />
       <span class="text-danger"><?php echo $shipPostalError; ?></span>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-signup">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
			</button> 
            
            <a href="index.php" class="btn btn-default" style="float:right;">Log In Here</a>
            
        </div> 
      
      </form>

    </div>
    
</div>

<script>
        function validatePass(){
		 //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass');
    var pass2 = document.getElementById('cnfpass');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors 
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }

		}
		
		document.getElementById("copy").onclick = function () {
			  document.getElementById("shipBusname").value = document.getElementById("billBusname").value;
			  document.getElementById("shipad1").value = document.getElementById("billad1").value;
			  document.getElementById("shipad2").value = document.getElementById("billad2").value;
			  document.getElementById("shipcity").value = document.getElementById("billcity").value;
			  document.getElementById("shipprov").value = document.getElementById("billprov").value;
			  document.getElementById("shipcountry").value = document.getElementById("billcountry").value;
			  document.getElementById("shipPostal").value = document.getElementById("billPostalC").value;
			  };
		 
		  
		

	
	$(document).ready(function(){						
			$('#email').blur(function () { 
   			if(this.value.match(/([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/igm)) {					//accept only email addresses that contain @ and .
			}else{
				alert("Valid email address please!");
				}
				
			
			
			
	
			});
	});
	
	
		</script>
        <script>
		$(document).ready(function(){						
			$('#dealer').blur(function () { 
   			if(this.value.match(/^[A-Z]{2}[0]{2}[1-9]{2}$/)) {					//accept only store numbers that have 2 caps, 2 zeros, and 2 numbers 
			}else{
				alert("Valid Store Number Please!");
			}
		});
		});
		</script>
</body>
</html>