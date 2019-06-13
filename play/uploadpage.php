<!DOCTYPE html>
<html>
 <head>
 <title>player</title>
 <script src="https://vjs.zencdn.net/7.3.0/video.min.js"></script>

 <link href="https://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
 <link href="video.css" rel="stylesheet">
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet">
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
 <body style="background-color:black">
   <?php
   session_start();
   if(isset($_SESSION['authenticated']) && $_SESSION["authenticated"] === true)
   {
   }
   else
   {
     header('Location: ../member/login.php');
     exit;
   }

   ?>
	 <div id="mainmenu">
			<a href="viewvideo.php?<?php echo$_GET['id'];?>">
				<img src="image/cornhub.jpg">
			</a>
			<form method="POST" action="" id="search">
		 		<input type="text" placeholder="Search..." id="searchtext"> </input>
				<div id="sbut">
						<input type="image" id="searchbut" src="image/search.png" value="" alt="Submit feedback"> </input>
				</div>
			</form>
      <form method="post" enctype="multipart/form-data" action="uploadpage.php">
				<span class="headerBtnsWrapper">
  					<input type="submit" value="Upload" class="greyButton">
            <a class="orangeButton" style="background:#ffa31a" href="../member/member.php?action=premium">Upgrade</a>
        </span>
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
  <div style="background-color:black ;height:500%">
  <div class="loginmodal-container">
     <form method="post" enctype="multipart/form-data" action="upload.php" style="color:black">
       Choose video<input type="file" name="my_file" required="required" >
       <br>
       Choose image<input type="file" name="img" required="required">
       <br>
       video name<input type="text" name="name" required="required">
       <br>
       video tag<input type="text" name="tag" required="required">
       <br>
       <select name="categories">
         <option value=0>corn</option>
         <option value=1>popcorn</option>
         <option value=2>cornsoup</option>
         <option value=3>unicorn</option>
       </select>
       <br>
       <br>
       <input type="submit" value="Upload" class="class='btn btn-light'">
     </form>
   </div>
 </div>
 </body>
<html>
