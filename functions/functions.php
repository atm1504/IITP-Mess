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
function getDetails(){
	// $mess = $_SESSION['mess'];
	$mess="Mess1";
	$rollno=$_SESSION['rollno'];
	$access_token=$_SESSION['access_token'];
	$sql="SELECT id from users where rollno='$rollno' and access_token='$access_token'";
	$result=query($sql);
	if(row_count($result)==1){
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load("./mess_rebate.xlsx");
		$sheetData = $spreadsheet->getSheetByName($mess)->toArray();
		$arrayName=$sheetData;
		$rowSize = count( $arrayName );
		$columnSize = max( array_map('count', $arrayName) );
		for($x=0; $x<=$rowSize; $x++){
			if(strtolower($sheetData[$x][2])==strtolower($rollno)){
				$rowNo = $x;
				break;
			}
		}

		if(!empty($rowNo)){
			$response = array();
			$response['stream']=$sheetData[$rowNo][0];
			$response['rollno']=$rollno;
			$response['mess']=$mess;
			$response['stream']=$sheetData[$rowNo][1];
			$response['name']=$sheetData[$rowNo][3];
			$response['email']=$sheetData[$rowNo][4];
			$response['phone']=$sheetData[$rowNo][5];
			$response['bank_name']=$sheetData[$rowNo][6];
			$response['bank_account_no']=$sheetData[$rowNo][7];
			$response['ifsc']=$sheetData[$rowNo][8];
			$response['amount_to_be_refunded']=$sheetData[$rowNo][9];
			return $response;
		}else{
			return false;
		}
	}else{
		redirect("logout.php");
	}
}
function logged_in(){
	if(isset($_SESSION['rollno']) || isset($_COOKIE['rollno'])){
		return true;
	}
	else{
		return false;
	}
}

function hostel_complain(){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$name=clean($_POST["name"]);
		$email=clean($_POST["email"]);
		$phone=clean($_POST["phone"]);
		$complain=clean($_POST["complain"]);
		$access_token=clean($_POST['access_token']);
		$subject="IIT Patna Hostel Issue";
		$msg="
			<p>$name has some complain regarding IIT Patna Hostel Facility. </p>
			<p>Details: </p>
			<h5>Name : $name</h5>
			<h5>Email : $email</h5>
			<h5>Phone : $phone</h5>
			<h5>Complain : $complain</h5>
		";
		$header="From: hostel_affairs@iitp.ac.in";
		$send_to ="hayyoulistentome@gmail.com";
		if (send_email($send_to,$subject,$msg,$header)){
            $sql="INSERT INTO complains (name,email,phone,complain) VALUES ('$name','$email','$phone','$complain')";
            $result=query($sql);
			confirm($result);
			success_message("Added successfully");
			set_message("<p class='bg-success text-center' style='color:#fff'>Successfully filed your complain. </p>");
            return true;
		}else{
			set_message("<p class='bg-danger text-center'>There was some error filing your complain. Please try again.</p>");
            return false;
        }
	}
}