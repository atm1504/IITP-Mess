<?php
include("utility.php");
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/*******************Useful Functions*****************/
//Cleans the string from unwanted html symbols
function clean($string){
	return htmlentities($string);
}
//Redirect to a particular page after task is done
function redirect($location){
	return header("Location: {$location}");
}
//Function to store message
function set_message($message){
	if(!empty($message)){
		$_SESSION['message']=$message;
	}
	else{
		$message="";
	}
}
//DISPLAY MESSAGE
function display_message(){
	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}
//Function to display validation error
function validation_errors($error_message){
$error = <<<DELIMITER
  <div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> $error_message
  </div>
DELIMITER;
return $error;
}

//Function to display success message
function success_message($error_message){
$error = <<<DELIMITER
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> $error_message
  </div>
DELIMITER;
return $error;
}

// Validates users login
function validate_login(){
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$errors=[];
		$rollno=clean($_POST['rollno']);
		$password=clean($_POST['password']);
		$password=sha1($password);
		$hash=microtime().$password;
		$access_token=sha1($hash);
		$sql ="SELECT id FROM users WHERE rollno='$rollno' AND password='$password'";
		$result=query($sql);
		if(row_count($result)){
            $row = fetch_array($result1);
            $mess = $row['mess'];
            $_SESSION['logged_in']=true;
			$_SESSION['mess']=$mess;
			$_SESSION['access_token']=$access_token;
			$_SESSION['rollno']=$rollno;
			$sql1="UPDATE users SET access_token='$access_token' WHERE rollno='$rollno'";
			$result1=query($sql1);
			confirm($result1);
            redirect("profile.php");
		}else{
			echo validation_errors("Please enter correct credentials.");
		}
	}
}

// Validate admins login
function validate_admin_login(){
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$errors=[];
		$email=clean($_POST['email']);
		$password=clean($_POST['password']);
		$password=sha1($password);
		$hash=microtime().$password;
		$access_token=sha1($hash);
		$sql ="SELECT id FROM admins WHERE email='$email' AND password='$password'";
		$result=query($sql);
		if(row_count($result)==1){
            $_SESSION['admin_logged_in']=true;
			$_SESSION['admin_access_token']=$access_token;
			$_SESSION['email']=$email;
			$sql1="UPDATE admins SET access_token='$access_token' WHERE email='$email'";
			$result1=query($sql1);
			confirm($result1);
            redirect("showComp.php");
		}else{
			echo validation_errors("Please enter correct credentials.");
		}
	}
}

// Fetch user details to be shown in the profile page
function getDetails(){
	// $mess = $_SESSION['mess'];
	$mess="Mess1";
	$rollno=$_SESSION['rollno'];
	$access_token=$_SESSION['access_token'];
	$sql="SELECT id from users where rollno='$rollno' and access_token='$access_token'";
	$result=query($sql);
	if(row_count($result)==1){
		$sql1="SELECT * from data where rollno='$rollno'";
		$result1=query($sql1);
		if(row_count($result1)==1){
			$row=fetch_array($result1);
			$response = array();
			$response['rollno']=$row["rollno"];
			$response['mess']=$mess;
			$response['stream']=$row["stream"];
			$response['name']=$row["name"];
			$response['email']=$row["email"];
			$response['phone']=$row["phone"];
			$response['bank_name']=$row["bank_name"];
			$response['bank_account_no']=$row["account_no"];
			$response['ifsc']=$row["ifsc_code"];
			$response['amount_to_be_refunded']=$row["amount"];
			$response["verified"]=$row["verified"];
			return $response;
		}else{
			return false;
		}
	}else{
		redirect("logout.php");
	}
}

// Sends the complains filed by an user
function getComplains(){
	$rollno=$_SESSION['rollno'];
	$access_token=$_SESSION['access_token'];
	$sql="SELECT id, complain_ids from users where rollno='$rollno' and access_token='$access_token'";
	$result=query($sql);
	if(row_count($result)==1){
		$row=fetch_array($result);
		$comp_id=json_decode($row['complain_ids']);
		if(empty($comp_id)){
			return false;
		}else{
			return $comp_id;
		}
	}
}

// Function to get the all unresolved complains by the admin
function getAllComplains(){
	$sql= "SELECT * FROM complains where is_resolved=0";
	$result=query($sql);
	$data=array();
	while ($row = $result->fetch_assoc()) {
		$data[]=$row;
	}
	return $data;
}

// Function to get the all resolved complains by the admin
function getAllResolvedComplains(){
	$sql= "SELECT * FROM complains where is_resolved=1";
	$result=query($sql);
	$data=array();
	while ($row = $result->fetch_assoc()) {
		$data[]=$row;
	}
	return $data;
}

// Update verification
function updateVerification(){

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$rollno=clean($_POST["rollno"]);
		$access_token=clean($_POST["access_token"]);
		$mess="Mess1";

		$sql="SELECT id from users where rollno='$rollno' and access_token='$access_token'";
		$result=query($sql);
		if(row_count($result)==1){


		}else{
			redirect("logout.php");
		}
	}
}

// Check the status of users login
function logged_in(){
	if(isset($_SESSION['rollno']) || isset($_COOKIE['rollno'])){
		$rollno=$_SESSION['rollno'];
		$access_token=$_SESSION['access_token'];
		$sql="SELECT id from users WHERE rollno='$rollno' and access_token='$access_token'";
		$result=query($sql);
		if(row_count($result)==1){
			return true;
		}else{
			return false;
		}
	}
	else{
		return false;
	}
}

// Check the authenticity of an admin login
function admin_logged_in(){
	if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
		$email=$_SESSION['email'];
		$access_token=$_SESSION['admin_access_token'];
		$sql="SELECT id from admins WHERE email='$email' and access_token='$access_token'";
		$result=query($sql);
		if(row_count($result)==1){
			return true;
		}else{
			return false;
		}
	}
	else{
		return false;
	}
}

// Function to file a  complain
function hostel_complain(){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$name=clean($_POST["name"]);
		$email=clean($_POST["email"]);
		$phone=clean($_POST["phone"]);
		$complain=clean($_POST["complain"]);
		$access_token=clean($_POST['access_token']);
		$rollno=clean($_POST['rollno']);
		$unique_id=uniqid();
		$sql1="SELECT id, complain_ids from users WHERE rollno='$rollno' and access_token='$access_token'";
		$result1=query($sql1);
		if(row_count($result1)==1){

			$subject="IIT Patna Hostel Issue";
			$msg="
				<p>$name thank your for filing complaint. The hostel team would look after it soon. You can always check the progress of the action taken in your profile. </p>
				<p>Details: </p>
				<h5>Name : $name</h5>
				<h5>Email : $email</h5>
				<h5>Phone : $phone</h5>
				<h5>Complain : $complain</h5>
			";
			$header="From: hostel_affairs@iitp.ac.in";
			$send_to ="hayyoulistentome@gmail.com";
			if (send_email($send_to,$subject,$msg,$header)){
				$sql="INSERT INTO complains (name,email,phone,complain,unique_id,rollno) VALUES ('$name','$email','$phone','$complain','$unique_id','$rollno')";
				$result=query($sql);
				confirm($result);
				update_user_complain($unique_id,$rollno,$result1);
				success_message("Added successfully");
				set_message("<p class='bg-success text-center' style='color:#fff'>Successfully filed your complain. </p>");
				return true;
			}else{
				set_message("<p class='bg-danger text-center'>There was some error filing your complain. Please try again.</p>");
				return false;
			}
		}else{
			set_message("<p class='bg-danger text-center'>TUnauthorized attempt. Please login and try again.</p>");
		}
	}
}

// Update the complain id in the users table
function update_user_complain($unique_id,$rollno,$result1){
	$row=fetch_array($result1);
	$comp_id=json_decode($row['complain_ids']);
	$to_add=array();
	$comp_id[]=$unique_id;
	$ids=json_encode($comp_id);
	$sql="UPDATE users set complain_ids='$ids' where rollno='$rollno'";
	$result=query($sql);
	confirm($result);
}

// Update the data table
function addDataTableData(){
	$sql="TRUNCATE TABLE data";
	$result=query($sql);
	$mess="Mess1";

	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	$spreadsheet = $reader->load("./mess_rebate.xlsx");
	$sheetData = $spreadsheet->getSheetByName($mess)->toArray();
	$arrayName=$sheetData;
	$rowSize = count( $arrayName );
	$columnSize = max( array_map('count', $arrayName) );
	for($x=1; $x<=$rowSize; $x++){
		echo "Test-4";
		$name=$sheetData[$x][3];
		$email=$sheetData[$x][4];
		$rollno=$sheetData[$x][2];
		$stream=$sheetData[$x][1];
		$phone=$sheetData[$x][5];
		$bank_name=$sheetData[$x][6];
		$account_no=$sheetData[$x][7];
		$ifsc=$sheetData[$x][8];
		$amount=$sheetData[$x][9];;
		$verified=$sheetData[$x][10];
		$sql="INSERT INTO data (name,email,rollno,stream,phone,bank_name,account_no,ifsc_code,amount,verified)";
		$sql .=" VALUES('$name','$email','$rollno','$stream','$phone', ";
		$sql .="'$bank_name','$account_no','$ifsc',$amount,$verified)";
		$result=query($sql);
	}
	echo "Test-3";
}

// Update the mess rebate sheet
function updateMessRebate(){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$email=clean($_POST["email"]);
		$access_token=clean($_POST["access_token"]);
		// if(is_admin_valid($email,$access_token)==true){
			if(isset($_FILES['fileToUpload'])){
				$target="./";
				$target_file="./mess_rebate.xlsx";
				$uploadOk = 1;
				// If file exists, remove the file
				if (file_exists($target_file)) {
					if(!unlink($target_file)){
						$uploadOk = 0;
					}
				}
				if($uploadOk==1){
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						// Update the data table
						addDataTableData();

						echo"<p class='bg-success text-center' style='color:#fff'>Successfully update the file. </p>";
						return true;
					} else {
						echo"<p class='bg-danger text-center'>There was some error updating the file. Please try again.</p>";
						return false;
					}
				}else{
					echo"<p class='bg-danger text-center'>There was some error updating the file. Please try again.</p>";
					return false;
				}
			}
		// }else{
		// 	redirect("adminLogout.php");
		// }

	}
}

// Change password of admins
function adminPassChange(){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$old_password=clean($_POST["old_password"]);
		$new_password=clean($_POST["password"]);
		$confirm_password=clean($_POST["confirm_password"]);
		$email=clean($_POST["admin_email"]);
		$access_token=clean($_POST["admin_access_token"]);
		$sql="SELECT id, password, position from admins where email='$email' and access_token='$access_token'";
		$result=query($sql);
		
		confirm($result);
		if(row_count($result)==1){
			$row=fetch_array($result);
			$password=$row['password'];
			$old_password=sha1($old_password);

			if($password!=$old_password){
				echo "<p class='bg-danger text-center'>Passwords didn't match. Please try again.</p>";
				set_message("<p class='bg-danger text-center'>Passwords didn't match. Please try again.</p>");
			}else{
				if($new_password!=$confirm_password){
					echo "<p class='bg-danger text-center'>Both the entered new passwords didn't match. Please type correctly.</p>";
					set_message("<p class='bg-danger text-center'>Both the entered new passwords didn't match. Please type correctly.</p>");
				}else{
					$new_password=sha1($new_password);

					$sql1="UPDATE admins set password='$new_password' where email='$email'";
					$result1=query($sql1);
					confirm($result1);
					echo"<p class='bg-success text-center' style='color:#fff'>Password successfully updated. </p>";
					set_message("<p class='bg-success text-center' style='color:#fff'>Password successfully updated. </p>");
					logoutAdmin();
				}
			}

		}else{
			echo "<p class='bg-danger text-center'>Unauthorized access.</p>";
			set_message("<p class='bg-danger text-center'>Unauthorized access.</p>");
		}
	}
}

// Change password of the users
function userPassChange(){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$old_password=clean($_POST["old_password"]);
		$new_password=clean($_POST["password"]);
		$confirm_password=clean($_POST["confirm_password"]);
		$rollno=clean($_POST["rollno"]);
		$access_token=clean($_POST["access_token"]);
		$sql="SELECT id, password from users where rollno='$rollno' and access_token='$access_token'";
		$result=query($sql);
		
		confirm($result);
		if(row_count($result)==1){
			$row=fetch_array($result);
			$password=$row['password'];
			$old_password=sha1($old_password);

			if($password!=$old_password){
				echo "<p class='bg-danger text-center'>Passwords didn't match. Please try again.</p>";
				set_message("<p class='bg-danger text-center'>Passwords didn't match. Please try again.</p>");
			}else{
				if($new_password!=$confirm_password){
					echo "<p class='bg-danger text-center'>Both the entered new passwords didn't match. Please type correctly.</p>";
					set_message("<p class='bg-danger text-center'>Both the entered new passwords didn't match. Please type correctly.</p>");
				}else{
					$new_password=sha1($new_password);

					$sql1="UPDATE users set password='$new_password' where rollno='$rollno'";
					$result1=query($sql1);
					confirm($result1);
					echo"<p class='bg-success text-center' style='color:#fff'>Password successfully updated. </p>";
					set_message("<p class='bg-success text-center' style='color:#fff'>Password successfully updated. </p>");
					logoutUser();
				}
			}

		}else{
			echo "<p class='bg-danger text-center'>Unauthorized access.</p>";
			set_message("<p class='bg-danger text-center'>Unauthorized access.</p>");
		}
	}
}


// Logout user
function logoutUser(){
	$rollno=$_SESSION['rollno'];
	$access_token=$_SESSION['access_token'];
	$sql="UPDATE users set access_token='' WHERE rollno='$rollno' and access_token='$access_token'";
	$result=query($sql);

	if(isset($_COOKIE['rollno'])){
		unset($_COOKIE['rollno']);
		setcookie('rollno','',time()-86400);
	}
	if(isset($_COOKIE['access_token'])){
		unset($_COOKIE['access_token']);
		setcookie('access_token','',time()-86400);
	}
	redirect("login.php");
}

// Logout admins
function logoutAdmin(){
	$email=$_SESSION['email'];
	$access_token=$_SESSION['admin_access_token'];
	$sql="UPDATE admins set access_token='' WHERE email='$email' and access_token='$access_token'";
	$result=query($sql);
	confirm($result);
	redirect("admin.php");
}

// Get the details of a complain
function getComplain($unique_id){
	$sql="SELECT * from complains where unique_id='$unique_id'";
	$result=query($sql);
	confirm($result);
	if(row_count($result)==1){
		$row=fetch_array($result);
		return $row;
	}else{
		return false;
	}
}

// Validated admin
function is_admin_valid($email,$access_token){
	$sql="SELECT id from admins where email='$email' and access_token='$access_token'";
	$result=query($sql);
	confirm($result);
	if(row_count($result)==1){
		return true;
	}else{
		return false;
	}
}

// Update complain status calls
function updateComplainStatusCalls(){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$email=clean($_POST["admin_email"]);
		$access_token=clean($_POST["admin_access_token"]);
		if(is_admin_valid($email,$access_token)==true){
			if(isset($_POST["update_status"])){
				updateStatus();
				echo"<p class='bg-success text-center' style='color:#fff'>Successfully updated the status. </p>";
				set_message("<p class='bg-success text-center' style='color:#fff'>Successfully updated the status. </p>");
				redirect("showComp.php");
			}elseif(isset($_POST["mark_resolved"])){
				markResolved();
				set_message("<p class='bg-success text-center' style='color:#fff'>Successfully marked as resolved. </p>");
				echo"<p class='bg-success text-center' style='color:#fff'>Successfully marked as resolved. </p>";
				redirect("showComp.php");
			}elseif(isset($_POST["update_mark_resolved"])){
				updateStatus();
				markResolved();
				echo"<p class='bg-success text-center' style='color:#fff'>Successfully completed the task. </p>";
				set_message("<p class='bg-success text-center' style='color:#fff'>Successfully completed the task. </p>");
				redirect("showComp.php");
			}
		}else{
			echo "<p class='bg-danger text-center'>Unauthorized access.</p>";
		}
	}
}

// Update status
function updateStatus(){
	$status=clean($_POST["status"]);
	$unique_id=clean($_POST["unique_id"]);
	$sql="UPDATE complains set status='$status' where unique_id='$unique_id'";
	$result=query($sql);
	confirm($result);
	return true;
}

// Function mark resolved
function markResolved(){
	$unique_id=clean($_POST["unique_id"]);
	$sql="UPDATE complains set is_resolved=1 where unique_id='$unique_id'";
	$result=query($sql);
	confirm($result);
	return true;
}