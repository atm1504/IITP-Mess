<?php include("./functions/functions.php");

session_destroy();
if(isset($_COOKIE['rollno'])){
	unset($_COOKIE['rollno']);
	setcookie('rollno','',time()-86400);
}
redirect("login.php");
