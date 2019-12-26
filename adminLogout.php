<?php include("./functions/init.php");

$email=$_SESSION['email'];
$access_token=$_SESSION['admin_access_token'];
$sql="UPDATE admins set access_token='' WHERE email='$email' and access_token='$access_token'";
$result=query($sql);
confirm($result);
session_destroy();
redirect("admin.php");
?>