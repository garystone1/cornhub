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

// Functions to filter user inputs
function filterName($field){
    // Sanitize user name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate user name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $field;
    } else{
        return FALSE;
    }
}    
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    } else{
        return FALSE;
    }
}
function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    } else{
        return FALSE;
    }
}
 
// Define variables and initialize with empty values
$emailErr = "";
$email = $subject = $message = $reset_success = "";
$exist = False;

// Define Webmaster Variable
$admin_username = "s106062323";
$admin_password = "s106062323";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate email address
    if(empty($_POST["email"])){
        $emailErr = "Please enter your email address.";     
    } else{
        $email = filterEmail($_POST["email"]);
        if($email == FALSE){
            $emailErr = "Please enter a valid email address.";
        }
    }

    // Search E-mail in MySQL
    $myemail = mysqli_real_escape_string($link, $_POST['email']);

    $sql = "SELECT id FROM tbl2 WHERE email = '$myemail'";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$active = $row['active'];
      
    $count = mysqli_num_rows($result);

    // If result matched $myemail, table row must be 1 row
    if($count == 1) {
        $exist = True;
        // Record Login User ID
        $login_id = $row['id'];
        $_SESSION['login_id'] = $login_id;
        //echo "CORRECT!";
    } else {
        $exist = False;
        $emailErr = "The E-mail has not been registered yet.";
        $email = "";
        //echo $error;
    }
    
    // Check input errors before sending email
    if(empty($emailErr) && $exist == True){
        // Recipient email address
        $to = $_POST["email"];
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Create email headers
        $headers .= 'From: '. $email . "\r\n" .
        'Reply-To: '. $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        // Mail subject
        $subject = "New Password - Cornhub";

        // Mail message HTML
        $message = '<html><body>';
        $message .= '<h1 style="color:#f40;">Hi!<br></h1>';
        $message .= '<p style="color:#000; font-size:18px;">Your new password is<br></p>';

        // Generate random password
        $password_len = 8;
        $password = '';
        $word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
        $len = strlen($word);
        for ($i = 0; $i < $password_len; $i++) {
            $password .= $word[rand() % $len];
        }

        // Mail message HTML
        $message .= '<p style="color:#f40; font-size:18px;">';
        $message .= $password;
        $message .= '</p></body></html>';

        // Sending email
        if(mail($to, $subject, $message, $headers)){
            //echo '<p class="success">New password mail has been sent successfully!</p>';
            
            // New password sent from mail
            $new_password = $password;
            $hash = password_hash($new_password, PASSWORD_DEFAULT);

            // Prepare an update statement
            $sql = "UPDATE tbl2 SET hash = '$hash' WHERE id = '$login_id'";
        
            if ($link->query($sql) === TRUE) {
                //echo "New password set successfully";
                $reset_success = "New Password Mail Sent Successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
        } else{
            echo '<p class="error">Unable to send email. Please try again!</p>';
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
			<a href="viewvideo.php">
				<img src="image/cornhub.jpg">
			</a>
			<form method="POST" action="" id="search">
		 		<input type="text" placeholder="Search..." id="searchtext"> </input>
				<div id="sbut">
					<input type="image" id="searchbut" src="image/search.png" value="" alt="Submit feedback"> </input>
				</div>
			</form>
			<form method="post" enctype="multipart/form-data" action="upload.php">
				<span class="headerBtnsWrapper">
  					<input type="file" name="my_file">
  					<input type="submit" value="Upload" class="greyButton">
                    <a class="orangeButton" style="background:#ffa31a">Upgrade</a>
                </span>
			</form>
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
        <h2>Lost Username or Password?</h2>
		<span class="subtitle">Please enter your email which you first registered with.</span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($emailErr)) ? 'has-error' : ''; ?>">
                <input type="text" name="email" id="inputEmail" placeholder="E-mail" class="js-signinUsername" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($reset_success)) ? 'has-error' : ''; ?>">
                <span class="help-block"><?php echo $reset_success; ?></span>
        	</div>
            <div class="form-group">
                <input type="submit" name="submit_email" class="buttonBase create_account_button_disabled big orangeButton light js-loginSubmit" value="Submit">
                <span class="loginLink">Or <a href="login.php">Log In</a></span>
            </div>
            <p>Already receive your new password? <a href="login.php">Login here</a>.</p>
        </form>
    </div> 
    </div>
    </section>
    </div> 
</body>
</html>