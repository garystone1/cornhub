<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: member.php");
    exit;
}*/


if(isset($_SESSION['authenticated']) && $_SESSION["authenticated"] === true){
    header('Location: member.php');
    exit;
} else{
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $error = "";
$username_err = $password_err = "";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

// Define Webmaster Variable
$admin_username = "s106062323";
$admin_password = "s106062323";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(isset($_POST["login"]))
    {
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            
            // username and password sent from form 
            $myusername = mysqli_real_escape_string($link, $_POST['username']);
            $mypassword = mysqli_real_escape_string($link, $_POST['password']); 
          
            $sql = "SELECT id FROM tbl2 WHERE username = '$myusername'";
            $result = mysqli_query($link, $sql);
    
            if (!$result) {
                printf("Error: %s\n", mysqli_error($link));
                exit();
            }
    
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            //$active = $row['active'];
          
            $count = mysqli_num_rows($result);
    
            // If result matched $myusername and $mypassword, table row must be 1 row
            if($count == 1) {
                
                // Record User ID in order to get the hash
                $verify_id = $row['id'];
                // Select Hash Data From tbl2
                $sql_v = "SELECT hash FROM tbl2 WHERE id = $verify_id";
                $result_v = mysqli_query($link, $sql_v);
                
                if (!$result_v) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }
                
                $row_v = $result_v->fetch_assoc();
                $hash = $row_v['hash'];
                //echo '<br>';
                //echo $mypassword;
                //$hash = '$2y$10$k.1eJLN.LgX0MDXZRb1VdOerRdnArpNomo2Sxc3vD6VBRyydiAdmu';
                //$hash = password_hash('$mypassword', PASSWORD_DEFAULT);
                //echo $hash;
                //$verified = password_verify('$mypassword', $hash); // Verifies password against hash
                //var_export($verified); // Would echo boolean true
                
                if (password_verify($mypassword, $hash)) {
                    echo 'Password is valid!';
                    // Record Login Username
                    $_SESSION['login_user'] = $myusername;
    
                    // Record Login User ID
                    $login_id = $row['id'];
                    $_SESSION['login_id'] = $login_id;
    
                    // Select Other Data From tbl2
                    $sql_2 = "SELECT gender, nickname, birth, photo, premium FROM tbl2 WHERE id = $login_id";
                    $result_2 = mysqli_query($link, $sql_2);
    
                    if (!$result_2) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
    
                    $row_2 = $result_2->fetch_assoc();
    
                    // Record Login User Gender
                    $login_gender = $row_2['gender'];
                    $_SESSION['login_gender'] = $login_gender;
                
                    // Record Login User Gender
                    $login_nickname = $row_2['nickname'];
                    $_SESSION['login_nickname'] = $login_nickname;
    
                    // Record Login User Birth
                    $login_birth = $row_2['birth'];
                    $_SESSION['login_birth'] = $login_birth;
                    
                    // Record Login User Photo
                    $login_photo = $row_2['photo'];
                    $_SESSION['login_photo'] = $login_photo;
                   
                    // Record Login User Photo
                    $premium = $row_2['premium'];
                    $_SESSION['premium'] = $premium;
					
                
                    // Record Authenticated
                    $_SESSION['authenticated'] = true;
    
                    header("location: member.php");
                    /*if(($myusername == $admin_username) && ($mypassword == $admin_password)){
                        header("location: admin.php");
                    }
                    else{
                        header("location: welcome.php");
                    }*/
                } else {
                    //echo 'Invalid password.';
                    $error = "Your Login Username or Password is invalid";
                } 	
                
            } else {
                $error = "Your Login Username or Password is invalid";
            }
        }
    }
    if(isset($_POST["signup"]))
    {
        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            // Check if the username has already been registered
            $username = mysqli_real_escape_string($link, $_POST['username']);
            $sql_username = "SELECT id FROM tbl2 WHERE username = '$username'";
            $result_username = mysqli_query($link, $sql_username);

            if (!$result_username) {
                printf("Error: %s\n", mysqli_error($link));
                exit();
            }

            $count_username = mysqli_num_rows($result_username);

            if($count_username == 1){
                $username_err = "The username has already been registered.";
            }
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        }
        else if(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have at least 6 characters.";
        }
        else{
            $password = trim($_POST["password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        }
        else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

        // Validate email
        if(empty(trim($_POST["email"]))){
            $email_err = "Please enter an email.";
        } else{
            // Check if the email has already been registered
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $sql_email = "SELECT id FROM tbl2 WHERE email = '$email'";
            $result_email = mysqli_query($link, $sql_email);

            if (!$result_email) {
                printf("Error: %s\n", mysqli_error($link));
                exit();
            }

            $count_email = mysqli_num_rows($result_email);

            if($count_email == 1){
                $email_err = "The E-mail has already been registered.";
            }
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){

            // user data sent from form 
            $new_username = mysqli_real_escape_string($link, $_POST['username']);
            $new_password = mysqli_real_escape_string($link, $_POST['password']); 
            $new_email = mysqli_real_escape_string($link, $_POST['email']); 
            
            // hash password
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            //echo $hash;
            //echo '<br>';
            
            // Find the max id inserted
            $id = mysqli_query($link, "SELECT id FROM tbl2 ORDER BY id DESC LIMIT 1");
            if(!$id) {
                die('Could not query:' . mysqli_error($link));
            }
            while($row = mysqli_fetch_assoc($id)) {
                $new_id = $row['id'] + 1;
            }

            // Insert User Data
            $sql = "INSERT INTO tbl2 (id, username, email, hash) VALUES ('$new_id', '$new_username', '$new_email', '$hash')";

            if ($link->query($sql) === TRUE) {
                $_SESSION['login_user'] = $new_username;
                $_SESSION['login_id'] = $new_id;
                //echo "New record created successfully";
                header("location: login.php");
            } else {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
        }
    }  
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://vjs.zencdn.net/7.3.0/video.min.js"></script>
 	<link href="https://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
 	<link href="video.css" rel="stylesheet">
 	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/generated-header.css?cache=2019060701" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/./front-login-pc.css?cache=2019060701" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/large.css?cache=2019060701" type="text/css" media="only screen and (min-width:1350px)" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/premium/premium-modals.css?cache=2019060701" type="text/css" />


    <style type="text/css">
        body{ font: 14px sans-serif; }
        body{
            margin:0px;
            padding:0px;
            background-size: cover;
        }
        .wrapper{ width: 350px; padding: 20px; }
        .createAccount #registerWrapper {
    		padding: 30px 0;
    		background: url(image/login_bg.jpg) center center no-repeat;
    		background-size: cover
		}
    </style>
</head>
<body>
	
	 <div id="mainmenu">
			<a href="../index/index.php">
				<img src="image/cornhub.jpg">
			</a>
			<form method="POST" action="" id="search">
		 		<input type="text" placeholder="Search..." id="searchtext"> </input>
				<div id="sbut">
					<input type="image" id="searchbut" src="image/search.png" value="" alt="Submit feedback"> </input>
				</div>
			</form>
			<div style="width:25px"></div>
			<form method="post">
				<span class="headerBtnsWrapper">
  					<a class="orangeButton" style="background:#ffa31a" href="../play/uploadpage.php"><i></i>Upload</a>
                    <a class="orangeButton" style="background:#ffa31a" href="member.php?action=premium"><i></i>Upgrade</a>
                </span>
			</form>
			<div style="width:50px"></div>
			<form method="POST" action="" id="login">
		 		<a href="login.php">LOGIN</a>
			</form>
			<div style="width:1%; height:1%;">
    		</div>
			<form method="POST" action="" id="signup">
		 		<a href="login.php?action=signup">SIGN UP</a>
			</form>
			
	 </div>
	 <div id = "table">
	 <table width=80%>
      	<tr height="40">
    	<br>
		<td width=16%>
    		<button id="home" onclick="" class="button">
      			HOME
    		</button>
    	</td>
    	<td width=16%>
    		<button id="videos" onclick="" class="button">
      			VIDEOS
    		</button>
  		</td>
  		<td width=16%>
    		<select class="select-css">
      			<option value="0">CATEGORIES</option>
      			<option value="address of category_1">category_1</option>
      			<option value="address of category_2">category_2</option>
      			<option value="address of category_3">category_3</option>
      			<option value="address of category_4">category_4</option>
    		</select>
  		</td>
  		<td width=16%>
    		<button id="livecorn" onclick="" class="button">
      			LIVE CORN
    		</button>
  		</td>
  		<td width=16%>
    		<button id="premium" onclick="location.href='member.php?action=premium'" class="button">
      			PREMIUM
    		</button>
  		</td>
  		<td width=16%>
    		<button id="phptos&gifs" onclick="" class="button">
      			PHOTOS & GIFS
    		</button>
   		</td>
    	</tr>
    </table>
    <br>
    <br>
  </div>
    <div class="createAccount">
	    <section id="registerWrapper">
	        <div class="container">
	    	    <div class="registerInfo">
                    <a href="viewvideo.php">
                        <img src="image/cornhub.jpg">
                    </a>
                    <h1>There's a lot more to Cornhub than you think!</h1>
                    <ul class="registerFeatures">
                        <li><i class="registerSprite uploads"></i><span>Upload Videos</span></li>
                        <li><i class="registerSprite addFriends"></i><span>Add Friends</span></li>
                        <li><i class="registerSprite subscribes"></i><span>Subscribe to Channels</span></li>
                        <li><i class="registerSprite comments"></i><span>Post Comments</span></li>
                        <li><i class="registerSprite downloads"></i><span>Download Videos</span></li>
                        <li><i class="registerSprite playlists"></i><span>Create Playlists</span></li>
                    </ul>
                </div>
    
    <div class="formWrapper">
        <?php  
        if(isset($_GET["action"]) == "signup")  
        {  
        ?>
        <h2>Sign up for free</h2>
		<span class="subtitle">and enhance your experience</span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder="Username" class="usernameField" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" placeholder="Password" class="passwordField">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" placeholder="Confirm password" class="passwordField">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="email" placeholder="E-mail" class="usernameField" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="signup" class="buttonBase create_account_button_disabled big greyButton light" value="Sign Up!">
                <span class="loginLink">Or <a href="login.php">Log In</a></span>
            </div>
            <p>Forget your password? <a href="forget.php">Get new password</a>.</p>
        </form>
        <?php       
        }  
        else  
        {  
        ?>
        <h2>Member login</h2>
		<span class="subtitle">Access your Cornhub or Cornhub Premium account</span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder="Username" class="js-signinUsername" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" placeholder="Password" class="js-signinPassword">
                <span class="help-block"><?php echo $password_err; ?></span>
                <span class="help-block" style="color:red;"><?php echo $error; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="login" class="buttonBase create_account_button_disabled big orangeButton light js-loginSubmit" value="Log In">
                <span class="loginLink">Or <a href="login.php?action=signup">Sign Up</a></span>
            </div>
            <p>Forget your password? <a href="forget.php">Get new password</a>.</p>
        </form>
        <?php  
        }  
        ?>
    </div> 
    </div>
    </section>
    </div> 
</body>
</html>