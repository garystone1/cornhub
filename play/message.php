<?php
  session_start();
  $user = $_SESSION['login_user'];
  date_default_timezone_set('Asia/Taipei');

  $mess = $_POST['mess'];
  $like = 0;
  $dis = 0;
  $time = date ("Y- m - d / H : i : s");
  $con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
  mysqli_select_db($con,"cornhub");
  $id = $_GET['id'];
  $sql = "SELECT filepath from video where id = $id";
  $ret = mysqli_query($con,$sql);
  $data = mysqli_fetch_assoc($ret);
  $path  = $data['filepath'];

  $sql = "INSERT INTO `".$path."` (user,message,posttime) VALUE('$user', '$mess', '$time')";
  //$sql ="DELETE FROM corn1";
  mysqli_query($con,$sql);

  header("Location: viewvideo.php?id=$id")
?>
