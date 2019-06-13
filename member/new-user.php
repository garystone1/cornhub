<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: member.php");
    exit;
}*/

if(isset($_SESSION['authenticated']) && $_SESSION["authenticated"] === true){
} else{
    header('Location: login.php');
    exit;
}

 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $error = "";
$username_err = $password_err = "";

// Define Webmaster Variable
$admin_username = "s106062323";
$admin_password = "s106062323";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
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
      
        $sql = "SELECT id FROM tbl2 WHERE username = '$myusername' and passcode = '$mypassword'";
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
            // Record Login Username
            $_SESSION['login_user'] = $myusername;

            // Record Login User ID
            $login_id = $row['id'];
            $_SESSION['login_id'] = $login_id;

            // Select Other Data From tbl2
            $sql_2 = "SELECT gender, nickname, birth FROM tbl2 WHERE id = $login_id";
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

            header("location: member.php");
            /*if(($myusername == $admin_username) && ($mypassword == $admin_password)){
                header("location: admin.php");
            }
            else{
                header("location: welcome.php");
            }*/
        } else {
            $error = "Your Login Username or Password is invalid";
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
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/generated-header.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/playlist-logged.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/pc/sceditor/sceditor.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/grid-styles/user-profile-grid.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/feeds.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/profile.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/achievements.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/tag-friends.css?cache=2019053101" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/user-share-item.css?cache=2019053101" type="text/css" />	
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/large.css?cache=2019053101" type="text/css" media="only screen and (min-width:1350px)" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/premium/premium-modals.css?cache=2019053101" type="text/css" />


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
		#img_cover{
    		opacity: 0.7; 
    		filter: alpha(opacity=70); 
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
                    <a class="orangeButton" style="background:#ffa31a" href="premium.php">Upgrade</a>
                </span>
			</form>
			<form method="POST" action="" id="login">
		 		<a href="signout.php">SIGN OUT</a>
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
    		<button id="premium" onclick="" class="button">
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
<div class="profileClass js-scriptUrl">
  <section id="topProfileHeader">
  	<div id="coverPicture">
		<button class="editBtn coverImageModalTrigger tooltipTrig" data-title="Edit Image"><span class="profileEditBigIcon"></span></button>
		<img id="img_cover" src="https://upload.cc/i1/2019/06/08/952ICv.png" width="100%">
	</div>
	<div id="avatarPicture">
		<div class="previewAvatarPicture">
			<button class="editBtn avatarModalTrigger"><span class="profileEditBigIcon"></span></button>
			<a class="editImageText avatarModalTrigger">Edit image</a>
			<img id="getAvatar" src="https://ci.phncdn.com/pics/users/default/pornhub/(m=eidYG0y)(mh=mBmY1kFJ2yqVFlx6)male.png" class="jcrop-preview" />
		</div>
	</div>
	<div class="bottomInfo">
		<div class="bottomInfoContainer">
			<div class="profileUserName">
				<a rel="nofollow" href="member.php" title="darygg" class="float-left"><?php echo htmlspecialchars($_SESSION["login_user"]); ?></a>				
				<div class="badge-username"></div>
				<div class="location"></div>
			</div>
		</div>
	</div>
	</section>

</div>
</body>
</html>