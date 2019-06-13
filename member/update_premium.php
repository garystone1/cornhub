<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: member.php");
    exit;
}*/

if(isset($_SESSION['authenticated']) && $_SESSION["authenticated"] === true){
}
else if($_SESSION['premium'] == 0){
	header('Location: member.php');
    exit;
}
else{
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

// user data sent from session 
$login_id = htmlspecialchars($_SESSION["login_id"]);
		
// Prepare an update statement
$sql = "UPDATE tbl2 SET premium = 1 WHERE id = '$login_id'";

if ($link->query($sql) === TRUE) {
	$_SESSION['premium'] = 1;
    header("location: member.php");
} else {
	echo "Error: " . $sql . "<br>" . $link->error;
}

?>