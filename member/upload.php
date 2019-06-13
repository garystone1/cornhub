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

//檢查檔案是否上傳成功
if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK)
{
    echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
    echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
    echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
    echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';

    //檢查檔案是否已經存在
    if (file_exists('upload/' . date("YmdHis") . $_FILES['my_file']['name']))
    {
        echo '檔案已存在。<br/>';
    } 
    else 
    {
        $file = $_FILES['my_file']['tmp_name'];
        $dest = 'upload/' . date("YmdHis") . $_FILES['my_file']['name'];

        //將檔案移至指定位置
        if(move_uploaded_file($file, $dest) == true)
        {
            // user data sent from session 
            $login_id = htmlspecialchars($_SESSION["login_id"]);
            
            // Prepare an update statement
            $sql = "UPDATE tbl2 SET photo = '$dest' WHERE id = '$login_id'";

            if ($link->query($sql) === TRUE) {
                $_SESSION['login_photo'] = $dest;
                header("location: member.php");
            } else {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
        }
        else{
        }
  	}
}
else 
{
	echo '錯誤代碼：' . $_FILES['my_file']['error'] . '<br/>';
}


?>


