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
        <h1>Update Mess Rebate Sheet</h1>
        <?php display_message();?>

    </div>

    <div class="row components">
        <form method="post" class="form-data" enctype="multipart/form-data">
        <?php updateMessRebate(); ?>
            <br>
            Select file to upload:
            <input type="file" class="input-file" required name="fileToUpload" id="fileToUpload" accept=".xls,.xlsx">
            <input type="submit" class="submit-button" value="Upload Image" name="submit">
        </form>
    </div>

</div>

</body>
</html>