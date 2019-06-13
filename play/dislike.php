<?php
$con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
mysqli_select_db($con,"cornhub");
$id = $_GET['id'];
$sql = "SELECT disnum from video where id = $id";
//$sql ="DELETE FROM corn1";
$ret = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($ret);
$disnum = $data['disnum']+1;
$sql = "UPDATE video SET disnum = $disnum where id = $id";
mysqli_query($con,$sql);
header("Location: viewvideo.php?id=$id")
?>
