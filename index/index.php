<!DOCTYPE html>
<?php
  session_start();
  $con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid","cornhub");
  $item;
  if(!empty ($_POST['search'])){
	if($_POST["selection"] == "Tags"){
        $query = str_replace(" ", "+", $_POST['search']);
        header("location:index.php?tags=". $query);
    }
    else{
        $query = str_replace(" ", "+", $_POST['search']);
        header("location:index.php?name=". $query);
    }
  }
  if (!empty($_GET['category']) ) {
		$item = 0;
		$cate=$_GET['category'];
	}
	else if(!empty($_GET['tags'])){
    $cate=$_GET['tags'];
		$item = 1;
	}
	else if(!empty($_GET['name'])){
    $cate=$_GET['name'];
		$item = 2;
	}
	else {
		$item = 3;
		$cate="all";
	}

	if($item == 3 || $item == 0){
		if($cate=="all"){
		$sql = "SELECT * FROM video order by view desc";
		}
		else{
			$sql = "SELECT * FROM video WHERE categories='$cate' order by view desc";
		}
		$con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid","cornhub");
		$result = mysqli_query($con,$sql);
		$i=1;
		while($row = mysqli_fetch_array($result))
		{
			$link[$i]=$row["filepath"];
			$title[$i]=$row["name"];
			$id[$i]=$row["id"];
			$length[$i]=$row["length"];
      $imgpath[$i]=$row["imgpath"];
      $view[$i]=$row["view"];
			$i+=1;
		}
		if (empty($_GET['page']) ) {
			$page=1;
		}
		else {
		  $page=$_GET['page'];
		}
	}
	else if($item == 1 || $item == 2){
    if(isset($_GET['tags'])){
      $condition = ' ';
      $query = explode(" ", $_GET['tags']);
      foreach($query as $text){
      $shortest = -1;
      $sql2 = "SELECT name FROM tags";
      $result2 = mysqli_query($con,$sql2);
      $tags = array();
      $i = 0;
      while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
        $tags[$i] = $row2['name'];
          $i ++;
                }
                $sss = mysqli_real_escape_string($con, $text);
                foreach ($tags as $tags) {
                        // calculate the distance between the input word and the current word
                        $lev = levenshtein($sss, $tags);
                        // check for an exact match
                        if ($lev == 0) {
                            // closest word is this one (exact match) break out of the loop if we've found an exact match
                            $closest = $tags;
                            $shortest = 0;
                            break;
                        }
                        // if this distance is less than the next found shortest distance, OR if a next shortest word has not yet been found
                        if ($lev <= $shortest || $shortest < 0) {
                            // set the closest match, and shortest distance
                            $closest  = $tags;
                            $shortest = $lev;
                        }
                    }
                    $condition .= "tag LIKE '%".$closest."%' OR ";
                }
                $condition = substr($condition, 0, -4);
                $sql_query = "SELECT * FROM video WHERE" . $condition."order by view desc";
                $result = mysqli_query($con, $sql_query);
                $i=1;
				while($row = mysqli_fetch_array($result))
				{
					$link[$i]=$row["filepath"];
					$title[$i]=$row["name"];
					$id[$i]=$row["id"];
          $length[$i]=$row["length"];
          $imgpath[$i]=$row["imgpath"];
          $view[$i]=$row["view"];
					$i+=1;
				}
				if (empty($_GET['page']) ) {
					$page=1;
				}
				else {
				  $page=$_GET['page'];
				}
            }
            else if(isset($_GET['name'])){
                $condition = ' ';
                $query = explode(" ", $_GET['name']);
                foreach($query as $text){
                    $condition .= "name LIKE '%".mysqli_real_escape_string($con, $text)."%' OR ";
                }
                $condition = substr($condition, 0, -4);
                $sql_query = "SELECT * FROM video WHERE" . $condition."order by view desc";
                $result = mysqli_query($con, $sql_query);
                $i=1;
				while($row = mysqli_fetch_array($result))
				{
					$link[$i]=$row["filepath"];
					$title[$i]=$row["name"];
					$id[$i]=$row["id"];
          $length[$i]=$row["length"];
          $imgpath[$i]=$row["imgpath"];
          $view[$i]=$row["view"];
					$i+=1;
				}
				if (empty($_GET['page']) ) {
					$page=1;
				}
				else {
				  $page=$_GET['page'];
				}
    }
	}
 ?>
<html>
  <head>
    <!--(todo)add meta in-->
    <title>CornHub.com</title>
    <!--STYLE CSS-->
    <script src="https://vjs.zencdn.net/7.3.0/video.min.js"></script>
    <script language='javascript'>
      var page="<?php echo $page;?>";
      var view_0="<?php
        if (empty($view[($page-1)*10+1]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+1];
        }
      ?>";
      var view_1="<?php
        if (empty($view[($page-1)*10+2]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+2];
        }
      ?>";
      var view_2="<?php
        if (empty($view[($page-1)*10+3]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+3];
        }
      ?>";
      var view_3="<?php
        if (empty($view[($page-1)*10+4]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+4];
        }
      ?>";
      var view_4="<?php
        if (empty($view[($page-1)*10+5]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+5];
        }
      ?>";
      var view_5="<?php
        if (empty($view[($page-1)*10+6]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+6];
        }
      ?>";
      var view_6="<?php
        if (empty($view[($page-1)*10+7]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+7];
        }
      ?>";
      var view_7="<?php
        if (empty($view[($page-1)*10+8]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+8];
        }
      ?>";
      var view_8="<?php
        if (empty($view[($page-1)*10+9]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+9];
        }
      ?>";
      var view_9="<?php
        if (empty($view[($page-1)*10+10]) ) {
          echo "0";
        }
        else {
          echo $view[($page-1)*10+10];
        }
      ?>";
      var link_0="<?php
        if (empty($link[($page-1)*10+1]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+1];
        }
      ?>";
      var link_1="<?php
        if (empty($link[($page-1)*10+2]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+2];
        }
      ?>";
      var link_2="<?php
        if (empty($link[($page-1)*10+3]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+3];
        }
      ?>";
      var link_3="<?php
        if (empty($link[($page-1)*10+4]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+4];
        }
      ?>";
      var link_4="<?php
        if (empty($link[($page-1)*10+5]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+5];
        }
      ?>";
      var link_5="<?php
        if (empty($link[($page-1)*10+6]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+6];
        }
      ?>";
      var link_6="<?php
        if (empty($link[($page-1)*10+7]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+7];
        }
      ?>";
      var link_7="<?php
        if (empty($link[($page-1)*10+8]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+8];
        }
      ?>";
      var link_8="<?php
        if (empty($link[($page-1)*10+9]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+9];
        }
      ?>";
      var link_9="<?php
        if (empty($link[($page-1)*10+10]) ) {
          echo "no such video";
        }
        else {
          echo $link[($page-1)*10+10];
        }
      ?>";
      var title_0="<?php
        if (empty($title[($page-1)*10+1]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+1];
        }
      ?>";
      var title_1="<?php
        if (empty($title[($page-1)*10+2]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+2];
        }
      ?>";
      var title_2="<?php
        if (empty($title[($page-1)*10+3]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+3];
        }
      ?>";
      var title_3="<?php
        if (empty($title[($page-1)*10+4]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+4];
        }
      ?>";
      var title_4="<?php
        if (empty($title[($page-1)*10+5]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+5];
        }
      ?>";
      var title_5="<?php
        if (empty($title[($page-1)*10+6]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+6];
        }
      ?>";
      var title_6="<?php
        if (empty($title[($page-1)*10+7]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+7];
        }
      ?>";
      var title_7="<?php
        if (empty($title[($page-1)*10+8]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+8];
        }
      ?>";
      var title_8="<?php
        if (empty($title[($page-1)*10+9]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+9];
        }
      ?>";
      var title_9="<?php
        if (empty($title[($page-1)*10+10]) ) {
          echo "no such video";
        }
        else {
          echo $title[($page-1)*10+10];
        }
      ?>";
      var id_0="<?php
        if (empty($id[($page-1)*10+1]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+1];
        }
      ?>";
      var id_1="<?php
        if (empty($id[($page-1)*10+2]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+2];
        }
      ?>";
      var id_2="<?php
        if (empty($id[($page-1)*10+3]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+3];
        }
      ?>";
      var id_3="<?php
        if (empty($id[($page-1)*10+4]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+4];
        }
      ?>";
      var id_4="<?php
        if (empty($id[($page-1)*10+5]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+5];
        }
      ?>";
      var id_5="<?php
        if (empty($id[($page-1)*10+6]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+6];
        }
      ?>";
      var id_6="<?php
        if (empty($id[($page-1)*10+7]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+7];
        }
      ?>";
      var id_7="<?php
        if (empty($id[($page-1)*10+8]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+8];
        }
      ?>";
      var id_8="<?php
        if (empty($id[($page-1)*10+9]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+9];
        }
      ?>";
      var id_9="<?php
        if (empty($id[($page-1)*10+10]) ) {
          echo "no such video";
        }
        else {
          echo $id[($page-1)*10+10];
        }
      ?>";
      var length_0="<?php
        if (empty($length[($page-1)*10+1]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+1];
        }
      ?>";
      var length_1="<?php
        if (empty($length[($page-1)*10+2]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+2];
        }
      ?>";
      var length_2="<?php
        if (empty($length[($page-1)*10+3]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+3];
        }
      ?>";
      var length_3="<?php
        if (empty($length[($page-1)*10+4]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+4];
        }
      ?>";
      var length_4="<?php
        if (empty($length[($page-1)*10+5]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+5];
        }
      ?>";
      var length_5="<?php
        if (empty($length[($page-1)*10+6]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+6];
        }
      ?>";
      var length_6="<?php
        if (empty($length[($page-1)*10+7]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+7];
        }
      ?>";
      var length_7="<?php
        if (empty($length[($page-1)*10+8]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+8];
        }
      ?>";
      var length_8="<?php
        if (empty($length[($page-1)*10+9]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+9];
        }
      ?>";
      var length_9="<?php
        if (empty($length[($page-1)*10+10]) ) {
          echo "no such video";
        }
        else {
          echo $length[($page-1)*10+10];
        }
      ?>";
      var imgpath_0="<?php
        if (empty($imgpath[($page-1)*10+1]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+1];
        }
      ?>";
      var imgpath_1="<?php
        if (empty($imgpath[($page-1)*10+2]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+2];
        }
      ?>";
      var imgpath_2="<?php
        if (empty($imgpath[($page-1)*10+3]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+3];
        }
      ?>";
      var imgpath_3="<?php
        if (empty($imgpath[($page-1)*10+4]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+4];
        }
      ?>";
      var imgpath_4="<?php
        if (empty($imgpath[($page-1)*10+5]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+5];
        }
      ?>";
      var imgpath_5="<?php
        if (empty($imgpath[($page-1)*10+6]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+6];
        }
      ?>";
      var imgpath_6="<?php
        if (empty($imgpath[($page-1)*10+7]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+7];
        }
      ?>";
      var imgpath_7="<?php
        if (empty($imgpath[($page-1)*10+8]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+8];
        }
      ?>";
      var imgpath_8="<?php
        if (empty($imgpath[($page-1)*10+9]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+9];
        }
      ?>";
      var imgpath_9="<?php
        if (empty($imgpath[($page-1)*10+10]) ) {
          echo "vidpic.png";
        }
        else {
          echo $imgpath[($page-1)*10+10];
        }
      ?>";
    </script>
    <link href="https://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/generated-header.css?cache=2019060701" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/./front-login-pc.css?cache=2019060701" type="text/css" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/large.css?cache=2019060701" type="text/css" media="only screen and (min-width:1350px)" />
	<link rel="stylesheet" href="https://ci.phncdn.com/www-static/css/premium/premium-modals.css?cache=2019060701" type="text/css" />
    <style>
      .select-css {
        display: block;
        font-size: 20px;
        font-family: sans-serif;
        font-weight: bold;
        color: white;
        line-height: 1.3;
        padding: .6em 1.4em .5em .8em;
        width: 200px;
        max-width: 100%;
        box-sizing: border-box;
        margin: 0;
        border: 0px;
        box-shadow: 0 0px 0 0px rgba(0,0,0,.04);
        border-radius: .5em;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        background-color: black;
        linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
        background-repeat: no-repeat, repeat;
        background-position: right .7em top 50%, 0 0;
        background-size: .65em auto, 100%;
      }
      .select-css::-ms-expand {
        display: none;
      }
      .select-css:hover {
        border-color: orange;
      }
      .select-css:focus {
        border-color: orange;
        box-shadow: 0 0 1px 3px orange;
        box-shadow: 0 0 0 3px -moz-mac-focusring;
        color: orange;
        outline: none;
      }
      .select-css option {
        font-weight:bold;
        font-size: 20px;
        color: white;
      }
      .select-css1 {
        display: block;
        font-size: 14px;
        font-family: sans-serif;
        font-weight: bold;
        color: black;
        line-height: 1.3;
        text-align-last: center;
        width: 120px;
        height: 28px;
        max-width: 100%;
        box-sizing: border-box;
        margin-left: -1% ;
        border: 0px;
        box-shadow: 0 0px 0 0px rgba(0,0,0,.04);
        border-radius: .5em;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        background-color: white;
        linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
        background-repeat: no-repeat, repeat;
        background-position: right .7em top 50%, 0 0;
        background-size: .65em auto, 100%;
      }
      .select-css1::-ms-expand {
        display: none;
      }
      .select-css1:hover {
        border-color: orange;
      }
      .select-css1:focus {
        border-color: orange;
        box-shadow: 0 0 1px 3px orange;
        box-shadow: 0 0 0 3px -moz-mac-focusring;
        color: orange;
        outline: none;
      }
      .select-css1 option {
        font-weight:bold;
        font-size: 14px;
        color: black;
      }
      .button{
        background-color: black;
        color: white;
        border: none;
        font-weight: bold;
        font-size: 18px;
      }
      .search{
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
        height: 28px;
        width: 720px;
        margin-left: 5%;
      }
    </style>
    <link href="../play/video.css" rel="stylesheet">
    
  </head>
  <body bgcolor=black>
    <div id="upper" z-index=999></div>
    <div id="mainmenu">
 			<a href="index.php">
 				<img src="../play/image/cornhub.jpg">
 			</a>
 			<form method="POST" action="" id="search">
 		 		<input type="text" name="search" placeholder="Search..." id="searchtext"> </input>
 				<div id="sbut">
 						<input type="image" id="searchbut" src="../play/image/search.png" value="" alt="Submit feedback"> </input>
 				</div>
        		<select name ="selection" class="select-css1">
              		<option value ="video Name">Video Name</option>
              		<option value ="Tags">Tags</option>
        		</select>
 			</form>
 			<form method="post">
				<span class="headerBtnsWrapper">
  					<a class="orangeButton" style="background:#ffa31a" href="../play/uploadpage.php"><i></i>Upload</a>
                    <a class="orangeButton" style="background:#ffa31a" href="../member/member.php?action=premium"><i></i>Upgrade</a>
                </span>
			</form>
			<div style="width:20px"></div>
 			<form method="POST" action="" id="login">
		 		<a href="../member/login.php">LOGIN</a>
			</form>
			<div style="width:1%; height:1%;">
    		</div>
			<form method="POST" action="" id="signup">
		 		<a href="../member/login.php?action=signup">SIGN UP</a>
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
    <button id="premium" onclick="location.href='../member/member.php?action=premium'" class="button">
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
    Hot Corn Videos
    <br>
    <table id="hotvideos" border=0>
      <!--
      <tr height="160">
        <td  width="200"></td>
        <td  width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
        <td  width="200"></td>
        <td  width="500" rowspan="4" align="center"><font color="white" size=40px>AD</font></td>
      </tr>
      <tr height="160">
        <td  width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
        <td  width="200"></td>
      </tr>
      <tr height="160">
        <td  width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
        <td  width="200"></td>
      </tr>
      <tr height="160">
        <td  width="200"></td>
        <td  width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
      </tr>
      -->
    </table>
  </div>
  <div id="pages" align="center">
  </div>
  <script src="preview.js"></script>
  <!--(todo) show account status-->
  </body>
</html>
