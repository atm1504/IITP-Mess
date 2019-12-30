<?php include("./functions/init.php"); 
if(admin_logged_in() == false){
    redirect("admin.php");
}else{
    $id=clean($_GET["unique_id"]);
    $complain = getComplain($id);
    if($complain==false){
        redirect("showComp.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>IITP Hostel Team</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="76x76" href="images/icons/logo.png">
	<link rel="icon" type="image/png" href="images/icons/logo.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container">
    <?php include("./includes/admin_nav.php");?>
	<div class="jumbotron">
        <?php 
        display_message();
        updateComplainStatusCalls();
        ?>
		<h1 class="text-center"> Update Complain Status</h1>
	</div>

<form method="POST" enctype="multipart/form-data">

    <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $id; ?>" />
    <input type="hidden" name="admin_email" id="admin_email" value="<?php echo $_SESSION["email"]; ?>" />
    <input type="hidden" name="admin_access_token" id="admin_access_token" value="<?php echo $_SESSION["admin_access_token"]; ?>" />

    <div class="form-group">
        <label for="event_organizer">Complain filed by: </label>
        <input type="text" class="form-control" id="name" name="name"  value="<?php echo $complain['name']?>" readonly>
    </div>

    <div class="form-group">
        <label for="event_organizer">Phone Number: </label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $complain['phone']?>" readonly>
    </div>

    <div class="form-group">
        <label for="event_organizer">Email: </label>
        <input type="text" class="form-control" id="email" name="email"  value="<?php echo $complain['email']?>" readonly>
    </div>
    <div class="form-group">
        <label for="event_organizer">Rollno: </label>
        <input type="text" class="form-control" id="rollno" name="rollno"  value="<?php echo $complain['rollno']?>" readonly>
    </div>
    <div class="form-group">
        <label for="event_organizer">Complain: </label>
        <textarea type="text" class="form-control" id="complain" name="complain"  readonly><?php echo $complain['complain']?></textarea>
    </div>

    <div class="form-group">
        <label for="event_organizer">Current Status: </label>
        <textarea type="text" class="form-control" id="status" name="status"><?php echo $complain['status']?></textarea>
    </div>

   <button type="submit" name="update_status" id="update_status" class="btn btn-primary">Update Status</button>
   <button type="submit" name="mark_resolved" id="mark_resolved" class="btn btn-primary">Mark as Resolved</button>
   <button type="submit" name="update_mark_resolved" id="update_mark_resolved" class="btn btn-primary pull-right">Update status and Mark resolved</button>
</form>
</div>

</body>
</html>