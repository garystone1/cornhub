<!DOCTYPE html>
<html>
 <head>
 <title>player</title>
 <script src="https://vjs.zencdn.net/7.3.0/video.min.js"></script>

 <link href="https://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
 <link href="video.css" rel="stylesheet">
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
  				<input type="file" name="my_file">
  				<input type="submit" value="Upload">
			</form>
			<form method="POST" action="" id="login">
		 		<a href="login.php">LOGIN</a>
			</form>
			<form method="POST" action="" id="login">
		 		<a href="signup.php">SIGN UP</a>
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

	<div>
	 <div id="video">
   <video id="my-video" class="video-js" width="1000" height="600" data-setup='{ "autoplay": false, "controls": true, "poster": "", "preload": "auto","playbackRates": [0.25, 0.5, 0.75, 1.0, 1.5, 2.0] }'>
   	<source src="corn1.mp4" type='video/mp4'>
   </video>
 	</div>
 	</div>

	<div id="ad1">
		<a href="https://facebook.com">
		<img src="image/corneater.gif" >
		</a>
	</div>

	<div id="ad2">
		<a href="https://facebook.com">
		<img src="image/popcorn.gif" >
		</a>
	</div>
	<div id="ad3">
		<a href="https://facebook.com">
		<img src="image/adv.jpg" >
		</a>
	</div>

	<div id="board">
		<div class="comment">
			<div class="headpic">
				<img src="image/head.png">
			</div>
			<div class="username">
				<h3>geep0604</h3>
			</div>
			<div class="time">
				<h3>20 hours ago</h3>

			</div>
			<div class="message">
				<p>THIS IS TEST.</p>
			</div>
			<div class="likenum">
				<p>14</num>
			</div>
			<div>
			<div class="block">
			</div>
		</div>

		<div class="comment">
			<div class="headpic">
				<img src="image/head.png">
			</div>
			<div class="username">
				<h3>geep0604</h3>
			</div>
			<div class="message">
				<p>THIS IS TEST.</p>
			</div>
			<div class="block">
			</div>
		</div>

	</div>
 </body>
<html>
