<!DOCTYPE html>
<?php include("./functions/init.php");
if(logged_in() == false){
    redirect("admin.php");
}
?>
<html lang="en">
<head>
	<title>IIT-P Hostel Password Change</title>
	<meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="icon" type="image/png" href="images/icons/logo.png"/>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/admin-pass-chng.css">
</head>
<body>

<div class="container">

    <div class="login">
    <div class="login-triangle"></div>
    <h2 class="login-header">Change Password</h2>

    <form class="login-container" method="POST">
        <?php
        display_message(); 
        userPassChange();
         ?>

        <p><input type="password" name="old_password" id="old_password" placeholder="Enter your current password" required></p>
        <p><input type="password" placeholder="Enter your new Password" name="password" id="password" required></p>
        <p><input type="password" placeholder="Confirm new Password" name="confirm_password" id="confirm_password" required></p>
        <input type="hidden" name="rollno" id="rollno" value="<?php echo $_SESSION['rollno'] ?>" required>
        <input type="hidden" name="access_token" id="access_token" value="<?php echo $_SESSION['access_token'] ?>" required>
        <p><input type="submit" value="Change Password"></p>
    </form>
    </div>

</div>

</body>
</html>