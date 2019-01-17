<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username_user = $password_user = $confirm_password = $email = $mobile = $firstname = $lastname = $hkid = "";
$username_err = $password_err = $confirm_password_err = $email_err = $mobile_err = $name_err = $hkid_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM database_users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username_user = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password_user = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password_user != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = 'Please enter an email.';     
    } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $email_err = "Invalid email format.";
    } else{
        $email = trim($_POST['email']);
    }
	
    // Validate mobile
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = 'Please enter mobile phone numbers.';     
    } elseif(!ctype_digit($_POST['mobile']) || strlen($_POST['mobile']) != 8){
        $mobile_err = "Wrong Mobile phone number.";
    } else{
        $mobile = trim($_POST['mobile']);
    }
	
    // Validate first_name and last_name
    if(empty(trim($_POST["firstname"]))||empty(trim($_POST["lastname"]))){
        $name_err = 'Please enter the name.';     
    } elseif(!ctype_alpha(preg_replace('/\s+/', '', $_POST['firstname']))||!ctype_alpha(preg_replace('/\s+/', '', $_POST['lastname']))){
        $name_err = "Your name nust only consist of letters.";
    } else{
        $firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
    }
	
	
    // Validate hkid
    if(empty(trim($_POST["hkid"]))){
        $hkid_err = 'Please enter HKID.';     
    } elseif(substr($_POST['hkid'], -1) != ")" || substr($_POST['hkid'], -3, 1) != "(" 
		|| !ctype_upper(substr($_POST['hkid'], -10, 1)) || !((ctype_upper(substr($_POST['hkid'], -2, 1))&&strlen(preg_replace("/[^0-9]/","",$_POST['hkid'])) == 6)||strlen(preg_replace("/[^0-9]/","",$_POST['hkid'])) == 7)){
        $hkid_err = "Wrong HKID.";
    } else{
        $hkid = trim($_POST['hkid']);
    }

	

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($mobile_err) && empty($name_err) && empty($hkid_err)){
			$skip_next = 0;

			//sql start
				include 'config_database_value.php';
				$con=mysqli_connect($servername, $username, $password, $dbname);
				mysqli_set_charset($con, "utf8"); //view the chinese word in sql with Nvarchar
				// Check connection
				if (mysqli_connect_errno())
				{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}

				$result = mysqli_query($con,"SELECT * FROM database_users");

				while($row = mysqli_fetch_array($result))
				{
					if ($row['username'] == $_POST['username']){
						$message = "Your username existed.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$skip_next = 1;
						break;
					}
					if ($row['hkid'] == $_POST['hkid']){
						$message = "HKID existed.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$skip_next = 1;
						break;
					}
					if ($row['email'] == $_POST['email']){
						$message = "Your email address existed.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$skip_next = 1;
						break;
					}
					if ($row['mobile'] == $_POST['mobile']){
						$message = "Your mobile phone number existed.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						$skip_next = 1;
						break;
					}
				}
				mysqli_close($con);
			//sql end

			if($skip_next == 0){
				$message = "Register successful.";
				echo "<script type='text/javascript'>alert('$message');</script>";

				$user_ip = getUserIP();
				date_default_timezone_set('Asia/Hong_Kong');
				$date = date("Y-m-d H:i:s");
 

				$sql = "INSERT INTO database_users (username, password, firstname, lastname, mobile, hkid, email, property, apply_item, last_activity, ip_address_used) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$resolved = '0';
				$reward = '100';
				$last_activity = $date;
				$ip_address_used = $user_ip;
				if($stmt = mysqli_prepare($link, $sql)){
					// Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($stmt, "sssssssssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_mobile, $param_hkid, $param_email, $param_reward, $param_resolved, $param_last_activity, $param_ip_address_used);
					
					// Set parameters
					$param_username = $username_user;
					$param_password = $password_user;
					$param_password = password_hash($param_password, PASSWORD_DEFAULT); // Creates a password hash
					$param_email = $email;
					$param_mobile = $mobile;
					$param_firstname = $firstname;
					$param_lastname = $lastname;
					$param_hkid = $hkid;
					$param_reward = $reward;
					$param_resolved = $resolved;
					$param_last_activity = $last_activity;
					$param_ip_address_used = $ip_address_used;
					// Attempt to execute the prepared statement
					if(mysqli_stmt_execute($stmt)){
						// Redirect to login page
						header("location: login.php");
					} else{
						echo "Something went wrong. Please try again later.";
					}
				}
				 
				// Close statement
				mysqli_stmt_close($stmt);
			}
		
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/register_style.css" />
	<link id="stylecall" rel="stylesheet" href="/logo_dadiu.css" />
	<link id="stylecall" rel="stylesheet" href="/for_login_register_style.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
	<title>Dadiu | Register</title>
</head>
<body>
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" style="width:300px;height:240px;">
		</div>
	</a>
	</div>
	<div class="first_words">Here you can order anything!</div>

    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username"maxlength="20"class="form-control" value="<?php echo $username_user; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" maxlength="30"class="form-control" value="<?php echo $password_user; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="confirm_password" maxlength="30"class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			
			<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Firstname:<sup>*</sup></label>
                <input type="text" name="firstname" maxlength="20"class="form-control" value="<?php echo $name_err; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
			
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Lastname:<sup>*</sup></label>
                <input type="text" name="lastname" maxlength="20"class="form-control" value="<?php echo $name_err; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>		
			
            <div class="form-group <?php echo (!empty($hkid_err)) ? 'has-error' : ''; ?>">
                <label>HKID:<sup>*</sup> e.g. A123456(7)</label>
                <input type="text" name="hkid" maxlength="10"class="form-control" value="<?php echo $hkid_err; ?>">
                <span class="help-block"><?php echo $hkid_err; ?></span>
            </div>		
			
			<div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                <label>Mobile Phone Number:<sup>*</sup></label>
                <input type="text" name="mobile" maxlength="8"class="form-control" value="<?php echo $mobile_err; ?>">
                <span class="help-block"><?php echo $mobile_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email:<sup>*</sup></label>
                <input type="text" name="email" maxlength="50" class="form-control" value="<?php echo $email_err; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>