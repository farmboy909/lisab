<?php
session_start();
if(isset($_SESSION['userSession'])!="")
{
	header("Location: alreadyRegistered.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$uname = $MySQLi_CON->real_escape_string(trim($_POST['user_name']));
	$email = $MySQLi_CON->real_escape_string(trim($_POST['user_email']));
	$upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));
	$dealer = $MySQLi_CON->real_escape_string(trim($_POST['dealer']));
	if(!preg_match("[A-T]{2}[0]{2}[0-9]{2}")) {
		$dealerErr = Not the right format.	}:
	$billBusname = $MySQLi_CON->real_escape_string(trim($_POST['billBusname']));
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
	
	
	$new_password = md5($upass);
	
	$check_email = $MySQLi_CON->query("SELECT user_email FROM users WHERE user_email='$email'");
	$count=$check_email->num_rows;
	

	if($count==0){
		
		$query = "INSERT INTO users(
		user_name,
		user_email,
		user_pass,
		dealer,
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
		'$email',
		'$new_password',
		'$dealer',
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
	
	$MySQLi_CON->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lisa B Registration</title>
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
     
        
       <form class="form-signin" method="post" id="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      
        <h2 class="form-signin-heading">Dealer Registration</h2><hr />
        
        <?php
		if(isset($msg)){
			echo $msg;
		}
		else{
			?>
            <div class='alert alert-info'>
				<span class='glyphicon glyphicon-asterisk'></span> &nbsp; fields marked are <span style="color:#F00;">not</span> mandatory !
		 </div>
            <?php
		}
		?>
          
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" name="user_name" required  />
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="user_email" id="email"required  />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Dealer Number" name="dealer" id="dealer" required  />
        <!--<span id="check-e"></span>-->
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" id="pass" placeholder="Password" name="password" required onkeyup="validatePass();" />
        </div>
        
     	<hr />
        
        
       
        
        
        
        <div class="form-group">
        <input type="password" name="pass" id="cnfpass" class="form-control" placeholder="Confirm Password" required onkeyup="validatePass();" />
        </div>
        
        <div id="confirmMessage"></div>
        
        
        <hr />
        
        <div class="form-group">        
        <center>Billing Information
          <input type="text" class="form-control" placeholder="Business Name" name="billBusname" id="billBusname" required  />
        </center>
        </div>
        
        
		<div class="form-group">
       <input type="text" name="billad1" class="form-control" placeholder="Address 1" id="billad1" required />
        </div>
        
        
        <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
       <input type="text" name="billad2" class="form-control" id="billad2" placeholder="Address 2 optional" />
        </div>
        </div>
        
        <div class="form-group">
       <input type="text" name="billcity" class="form-control" id="billcity" placeholder="City" required />
        </div>
        
        <div class="form-group">
       <input type="text" name="billprov" class="form-control" id="billprov" placeholder="Prov/State/Region" required />
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" id="billcountry"  placeholder="Country" name="billcountry" required  />
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" id="billPostalC" placeholder="Postal Code/Zip" name="billPostalC" required  />
        </div>
        
        <hr />
        
         <div class="form-group">
         Shipping Information
         
         
         <input name="copy" type="button" class="btn btn-default" id="copy" value="Same as Billing" />
         </div>	
        
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Business Name" name="shipBusname" id="shipBusname" required  />
        </div>
        
        <div class="form-group">
       <input type="text" name="shipad1" id="shipad1" class="form-control" placeholder="Address 1" required />
        </div>
        
        <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
       <input type="text" name="shipad2" id="shipad2" class="form-control" placeholder="Address 2 optional" />
        </div>
        </div>
        
          <div class="form-group">
       <input type="text" name="shipcity" id="shipcity" class="form-control" placeholder="City" require />
        </div>
        
        <div class="form-group">
       <input type="text" name="shipprov" class="form-control" id="shipprov" placeholder="Prov/State/Region" required />
        </div
        
        ><div class="form-group">
       <input type="text" name="shipcountry" id="shipcountry" class="form-control" placeholder="Country" require />
        </div>
        
         <div class="form-group">
       <input type="text" name="shipPostal" id="shipPostal" class="form-control" placeholder="Postal/Zip Code" require />
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
		 
		  
		$(document).ready(function(){						//accept only dealer numbers that contain 2 caps and 2 "0's" and 2 nums
			$('#dealer').blur(function () { 
   			 if(this.value = this.value.match(/([A-T]{2}[0]{2}[0-9]{2})/g)){
				}else{
				alert("Valid Dealer Number please!");
				}
});
	});
	
	$(document).ready(function(){						
			$('#email').change(function () { 
   			if(this.value.match(/^([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}$/igm)) {					//accept only email addresses that contain @ and .
			}else{
				alert("Valid email address please!");
				}
});
	});
	
	
		</script>
</body>
</html>