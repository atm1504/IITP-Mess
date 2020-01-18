<!DOCTYPE html>
<?php include("./functions/init.php");
if(admin_logged_in() == false){
    redirect("admin.php");
}
?>
<html lang="en">
<head>
	<title>IIT-P Mess Update</title>
	<meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="icon" type="image/png" href="images/icons/logo.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/file-upload.css">
</head>
<body>

<div class="container">  
    <div class=" text-center">
        <?php include("./includes/admin_nav.php");?>
        <h1>Download Mess Rebate Sheet</h1>
        <?php display_message();?>

    </div>

    <div class="row components">
        <form method="post" class="form-data" enctype="multipart/form-data">
        <?php downloadSheet(); ?>
            <br>
            Click here to download the file:
            <input type="hidden" class="submit-button" value="<?php echo $_SESSION['admin_access_token']; ?>" name="access_token">
            <input type="hidden" class="submit-button" value="<?php echo $_SESSION['email']; ?>" name="email">
            <input type="submit" class="submit-button" value="Download" name="download">
        </form>
    </div>

</div>

</body>
</html>