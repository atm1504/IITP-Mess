<?php include("./functions/init.php");

$rollno=$_SESSION['rollno'];
$access_token=$_SESSION['access_token'];
$sql="UPDATE users set access_token='' WHERE rollno='$rollno' and access_token='$access_token'";
$result=query($sql);

session_destroy();
if(isset($_COOKIE['rollno'])){
	unset($_COOKIE['rollno']);
	setcookie('rollno','',time()-86400);
}
if(isset($_COOKIE['access_token'])){
	unset($_COOKIE['access_token']);
	setcookie('access_token','',time()-86400);
}
redirect("login.php");
?>