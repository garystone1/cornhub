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

//Record user photo image source
$src = htmlspecialchars($_SESSION['login_photo']);



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isset($_POST["premium"]))
	{
		header("location: member.php");
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
			<div style="width:100px"></div>
			<form method="POST" action="" id="login">
		 		<a href="signout.php">SIGN OUT</a>
			</form>
			
	 </div>
	 <!--(todo) a row of button-->
    <div align='center'>
    <table width=80%>
      <tr height="40">
    <br>
    <td width=16%>
    <button id="home" onclick="javascript:location.href='https://softwarestudio.2y.idv.tw/~cornhub/index/index.php'" class="button">
      HOME
    </button>
    </td>
  <td width=16%>
    <select class="select-css" onchange="location = this.value;">
      <option value="https://softwarestudio.2y.idv.tw/~cornhub/index/index.php">CATEGORIES</option>
      <option value="https://softwarestudio.2y.idv.tw/~cornhub/index/index.php?category=1">category_1</option>
      <option value="https://softwarestudio.2y.idv.tw/~cornhub/index/index.php?category=2">category_2</option>
      <option value="https://softwarestudio.2y.idv.tw/~cornhub/index/index.php?category=3">category_3</option>
      <option value="https://softwarestudio.2y.idv.tw/~cornhub/index/index.php?category=4">Unicorn</option>
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
  <!--(todo) a table of video-->
  <div>
    <br>
  </div>
  <div id="pages" align="center">
  </div>

  	<?php  
    if(isset($_GET["action"]) == "premium")  
    {  
	?>
	<div class="createAccount">
	<section id="registerWrapper">
	    <div class="container">
	    	<div class="registerInfo">
				<a href="viewvideo.php">
					<img src="image/cornhub.jpg">
				</a>
				<h1>Cornhub premium brings you more happiness!</h1>
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
        <h2>GET PREMIUM</h2>
		<span class="subtitle">no Ads. more Videos.</span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        	<div style="width:100px; height:30px;"></div>
            <h2 style="background-color:rgba(100%, 100%, 100%, 0.7); color:black; border-radius:5px; font-size:25px; height:110px;"><br>ONLY NT$ 699 <br> For Lifetime Premium!</h2>
            <div style="width:100px; height:30px;"></div>
            <input type="button" onclick="location.href='pay.php'" name="premium" class="buttonBase create_account_button_disabled big orangeButton light js-loginSubmit" style="width:100%; height:80px; font-size:30px;" value="BUY NOW!">
        </form>
    </div> 
    </div>
    </section>
    </div>
    
	<?php       
    }  
    else  
    {  
    ?>
	<div class="profileClass js-scriptUrl">
  <section id="topProfileHeader">
  	<div id="coverPicture">
		<!--<button class="editBtn coverImageModalTrigger tooltipTrig" data-title="Edit Image">
			<span class="profileEditBigIcon"></span>
		</button>-->
		<img id="img_cover" src="https://upload.cc/i1/2019/06/08/952ICv.png" width="100%">
	</div>
	<div id="avatarPicture">
		<div class="previewAvatarPicture">
			<button class="editBtn avatarModalTrigger" onclick="location.href='upload_ready.php'">
				<span class="profileEditBigIcon"></span>
			</button>
			<a class="editImageText avatarModalTrigger">Edit image</a>
			<img id="getAvatar" src="<?=$src?>" class="jcrop-preview" />
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

	<?php  
    }  
    ?>
    
</body>
</html>