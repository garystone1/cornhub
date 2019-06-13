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
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Photo</title>
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
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/generated-header.css?cache=2019061105" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/playlist-logged.css?cache=2019061105" type="text/css" />
    <link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/large.css?cache=2019061105" type="text/css" media="only screen and (min-width:1350px)" />
    <link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/premium/premium-modals.css?cache=2019061105" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://ci.phncdn.com/www-static/css/uploader.css?cache=2019061105" />
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

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
<body class="form-style form-style-light" >
<script language='javascript'>
	function openFile(event){
  var input = event.target; //取得上傳檔案
  var reader = new FileReader(); //建立FileReader物件

  reader.readAsDataURL(input.files[0]); //以.readAsDataURL將上傳檔案轉換為base64字串

  reader.onload = function(){ //FileReader取得上傳檔案後執行以下內容
    var dataURL = reader.result; //設定變數dataURL為上傳圖檔的base64字串
    $('#output').attr('src', dataURL).show(); //將img的src設定為dataURL並顯示
	document.getElementById("cloudIcon").style.display = "none";
	};
}	
</script>
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
    
    <?php  
    if(isset($_GET["action"]) == "upload")  
    {  
	?>
	<div class="container  ">
	<div class="photo-wrapper">
	<div class="uploadWrapperContainer">
	    <div class="uploaderTitleBar">Upload</div>
		<form autocomplete="off" id="fileupload" name="fileupload" method="POST" enctype="multipart/form-data" data-confirm="true" action="upload.php">
			<div id="dragAreaWrapper">
				<div class="draggableArea" id="dragFilesHere">
					<div id="cloudIcon" style="margin-top:50px; margin-bottom:50px;">
					</div>
					<img id="output" width="500px"  style="margin-left:325px; display:none;">
					<div id="selectFilesButton">Select photos to upload						
						<input type="file" id="Filedata" name="my_file" onchange="openFile(event)" class="filemultiple photo" multiple>
					</div>
					<div id="selectFilesButton" style="background:-webkit-gradient(linear,left top,left bottom,from(#888888),to(#DDDDDD));">Upload the photo!		
						<input type="submit" name="Upload" class="filemultiple photo" onclick="location.href='upload.php';">
					</div>
					<div id="selectFilesText">Please upload square image.</div>
				</div>
            </div>
        </form>   
    </div>
    </div>
    </div>
	
	<?php       
    }  
    else  
    {  
    ?>
    <div class="wrapper">
	<div class="container  ">
    <div class="uploadWrapperContainer">
        <div class="uploaderTitleBar">Upload</div>
        <div class="reset"></div>
        <div id="uploadBoxText">Would you like to upload a photo?</div>
        <div id="uploaderMainLeftCol" class="uploadColumn">
            <div id="videoContainer" class="uploadBtnContainer">
                <a id="videoUploadLink" class="uploadToolLink removeAdLink" href = "member.php">
                    <span class="icon"></span>
                    <span class="btnLabel">Cancel</span>
                </a>
            </div>
        </div>
        <div id="uploaderMainRightCol" class="uploadColumn">
            <div id="photoContainer" class="uploadBtnContainer">
                <a id="photoUploadLink" class="uploadToolLink removeAdLink" href="upload_ready.php?action=upload">
                    <span class="icon"></span>
                    <span class="btnLabel">Upload Photos</span>
                </a>
            </div>
        </div>
        <div class="reset"></div>
        <div id="uploaderTextBelow">
            By uploading, you verify that all parties depicted in the content you're uploading consent to it being posted on Pornhub and are aware that you are doing so. You are representing that your files do not violate Pornhub's <a href="/information#terms">Terms of Service</a> and that you are willing to provide any <a href="/information#btn-2257">2257</a> information upon request.		
        </div>
	</div>
	</div>
	</div>
	<?php  
    }  
    ?>
</body>
</html>