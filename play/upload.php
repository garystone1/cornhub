<?php
# 檢查檔案是否上傳成功
if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK && $_FILES['img']['error'] === UPLOAD_ERR_OK){
  // echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
  // echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
  // echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
  // echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';

  # 檢查檔案是否已經存在
  if (file_exists('upload/' . $_FILES['my_file']['name'])){
    echo '檔案已存在。<br/>';
  } else {
    $file = $_FILES['my_file']['tmp_name'];
    $dest = 'upload/' . $_FILES['my_file']['name'];

    # 將檔案移至指定位置
    move_uploaded_file($file, $dest);

    $file = $_FILES['img']['tmp_name'];
    $dest = 'video_img/' . $_FILES['img']['name'];

    # 將檔案移至指定位置
    move_uploaded_file($file, $dest);

    $videofile= $_FILES['my_file']['name'];
    $imgpath = "../play/video_img/".$_FILES['img']['name'];
    // //echo $imgpath;
    require_once("getid3/getid3.php");
    $getID3 = new getID3;
    $fileData = $getID3->analyze($videofile);

    header("Location: ../index/index.php?id=");

    $name = $_POST["name"];
    $path = "../play/upload/".$_FILES['my_file']['name'];
    $length = $fileData['playtime_seconds'];
    $view = 0;
    $tag = $_POST["tag"];
    $cate = $_POST["categories"];
    $liknum = 0 ;
    $disnum = 0;


    $con = mysqli_connect("140.114.87.219","cornhub","JOfKLtsid");
    mysqli_select_db($con,"cornhub");

    $sq = "INSERT INTO video(name,filepath,likenum,disnum,view,tag,categories,length,imgpath) VALUE('trcy', 'fuck', 0, 0, 0 , 'iiii' , $cate, $length,'dddd')";
    //$sq ="DELETE FROM video";
    mysqli_query($con,$sq);

    $tablename =$path;
    $sql = "CREATE TABLE `".$tablename."` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,user VARCHAR(45),message VARCHAR(45), posttime VARCHAR(45))";
    mysqli_query($con,$sql);

    $sql = "INSERT IGNORE INTO tags(name) VALUE('$tag')";
    mysqli_query($con,$sql);

    sleep(1.0);
    header("Location: ../index/index.php");
    //header("Location: ../index/index.php");
  }
} else {
  echo '錯誤代碼：' . $_FILES['my_file']['error'] . '<br/>';
}
?>
