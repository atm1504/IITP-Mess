<?php include("./functions/functions.php");

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
