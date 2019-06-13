<!DOCTYPE html>
<html>
 <head>
 <title>player</title>
 <script src="https://vjs.zencdn.net/7.3.0/video.min.js"></script>

 <link href="https://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
 <link href="video.css" rel="stylesheet">
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet">
 </head>
 <body onload="conf()">
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
		$con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
		mysqli_select_db($con,"cornhub");
		$id = $_GET['id'];
		$sql = "SELECT categories from video where id = $id";
		$ret = mysqli_query($con,$sql);
		$data = mysqli_fetch_assoc($ret);
		if(!$_SESSION['premium'] && $data['categories']==3)
		{
			header('Location: ../member/member.php?action=premium');
		}
	 ?>
	 <script>
	 function conf(){
		 time = 0.0;
	 if (!confirm("請問您是否已滿18歲?"))
	 {
		 document.location.href = 'https://www.hccfa.org.tw/';
   }
	 else
	 {
	 	 //alert("enjoy your corn videos!");
	 }
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

			<div class="btn btn-primary btn-file" id="up">

	       <form method="post" enctype="multipart/form-data" action="upload.php">
	         Choose<input type="file" name="my_file" >
	         <input type="submit" value="Upload" class="btn btn-primary btn-file">
	       </form>

	    </div>
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

	 <div id="video">
   <video onplay="startCheck()" onpause="pauseCheck()"id="my-video" class="video-js" width="1000" height="600" data-setup='{ "autoplay": false, "controls": true, "poster": "", "preload": "auto","playbackRates": [0.25, 0.5, 0.75, 1.0, 1.5, 2.0] }'>
   	<source src="corn1.mp4" type='video/mp4'>
   </video>
 	 </div>
	 <script>
	   played = false;
		 time = 0.0;
		var len = "<?php
		$con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
		mysqli_select_db($con,"cornhub");
		$id = $_GET['id'];
		$sql = "SELECT length from video where id = $id";
		//$sql ="DELETE FROM corn1";
		$ret = mysqli_query($con,$sql);
		$data = mysqli_fetch_assoc($ret);
		$len = $data['length'];
		echo $len;
		?>";
	  var funct = function timeCounter()
		{
			time += 0.1;
			console.log(time);

			if(time>=len && !played)
			{
				played = true;
				console.log(time);
				this.location = ("viewplus.php?id= <?php echo $id;?> ");
			}
			//alert("hello");
		};
		function pauseCheck()
		{
			clearInterval(Int);
		}
	 	function startCheck()
		{
			Int =setInterval(funct,100);
		}
	 </script>
	<div id="info">
		<h2><?php
		$con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
    mysqli_select_db($con,"cornhub");
		$id = $_GET['id'];
		$sql = "SELECT name from video where id = $id";
		$ret = mysqli_query($con,$sql);
		$data = mysqli_fetch_assoc($ret);
		$name = $data['name'];
		echo $name;
		?>
		</h2>
		<h3 ><?php $con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
    mysqli_select_db($con,"cornhub");
		$id = $_GET['id'];
		$sql = "SELECT view from video where id = $id";
		$ret = mysqli_query($con,$sql);
		$data = mysqli_fetch_assoc($ret);
		$view = $data['view'];
		echo $view;
		?></h3>
		<p>views</p>
		<p id=""> from</p>
		<br>

		<form method="POST" action="like.php?id=<?php echo $_GET['id']; ?>" class="like">
			<button type = "submit">
				<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
			</button>
		</form>
		<form method="POST" action="dislike.php?id=<?php echo $_GET['id']; ?>" class="dislike">
			<button>
				<i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
			</button>
		</form>
		<div id="eval">
			<div class="info_like">
			<p><?php $con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
			mysqli_select_db($con,"cornhub");
			$id = $_GET['id'];
			$sql = "SELECT likenum from video where id = $id";
			//$sql ="DELETE FROM corn1";
			$ret = mysqli_query($con,$sql);
			$data = mysqli_fetch_assoc($ret);
			$liknum = $data['likenum'];
			echo $liknum;
			?></p>
			</div>
			<div class="info_dis">
			<p><?php $con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
			mysqli_select_db($con,"cornhub");
			$id = $_GET['id'];
			$sql = "SELECT disnum from video where id = $id";
			//$sql ="DELETE FROM corn1";
			$ret = mysqli_query($con,$sql);
			$data = mysqli_fetch_assoc($ret);
			$disnum = $data['disnum'];
			echo $disnum;
			?></p>
			</div>
			<?php
			$con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
			mysqli_select_db($con,"cornhub");
			$id = $_GET['id'];
			$sql = "SELECT likenum from video where id = $id";
			//$sql ="DELETE FROM corn1";
			$ret = mysqli_query($con,$sql);
			$data = mysqli_fetch_assoc($ret);
			$liknum = $data['likenum'];

			$sql = "SELECT disnum from video where id = $id";
			//$sql ="DELETE FROM corn1";
			$ret = mysqli_query($con,$sql);
			$data = mysqli_fetch_assoc($ret);
			$disnum = $data['disnum'];


			$total = $liknum + $disnum;
			if($total !=0)
			{
				$likeper = round(($liknum / $total) * 100);
			}
			else
			{
				$likeper = 50;
			}
			echo "<div class='likebar' style='width:";
			echo $likeper;
			echo "px'></div>";

			echo "<div class='disbar' style='margin-left:";
			echo $likeper;
			echo "px; ";
			echo "width:";
		  echo 100-$likeper;
			echo "px'></div>";
			?>
		</div>


		<form method="POST" action="message.php?id=<?php echo $_GET['id'] ?>" id="comment">
			<input type="text" placeholder="leave somethig..." name="mess">
			<input type="submit" >
		</form>
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
		<?php
		$con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
	  mysqli_select_db($con,"cornhub");

		$sql = "SELECT filepath from video where id = $id";
		$ret = mysqli_query($con,$sql);
		$data = mysqli_fetch_assoc($ret);
		$path = $data['filepath'];


		$sql = "SELECT * FROM `".$path."` order by posttime desc";
		$ret = mysqli_query($con,$sql);

		while($row = mysqli_fetch_array($ret))
		{
			echo<<<EOF
			<div class="comment">
				<div class="headpic">
					<img src="image/head.png">
				</div>
				<div class="username">
EOF;
			echo "<h3>".$row['user']."</h3>";
			echo<<<EOF
			</div>
			<div class="time">
EOF;
			echo "<h3>".$row['posttime']."</h3>";
			echo<<<EOF
			</div>
			<div class="message">
EOF;
			echo "<p>".$row['message']."</p>";
			echo<<<EOF
			</div>
			<div>
			<div class="block"></div>
			</div>
		</div>
EOF;
		}
		?>

 </body>
<html>
