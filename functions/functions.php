<?php
include("utility.php");
// include("attendance.php");
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

function validate_login(){
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$errors=[];
		$rollno=clean($_POST['rollno']);
		$password=clean($_POST['password']);
		$password=sha1($password);
		$sql ="SELECT id FROM users WHERE rollno='$rollno' AND password='$password'";
		$result=query($sql);
		if(row_count($result)){
            $row = fetch_array($result1);
            $mess = $row['mess'];
            $_SESSION['logged_in']=true;
            $_SESSION['mess']=$mess;
            $_SESSION['rollno']=$rollno;
            redirect("profile.php");
		}else{
			echo validation_errors("Please enter correct credentials.");
		}
	}
}
function getHours(){
	$mess = $_SESSION['mess'];
	$rollno=$_SESSION['rollno'];
	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load("../attendance.xlsx");
	$sheetData = $spreadsheet->getSheetByName($mess)->toArray();
	$arrayName=$sheetData;
	$rowSize = count( $arrayName );
	$columnSize = max( array_map('count', $arrayName) );
	for($x=3; $x<=$rowSize; $x++){
		if(strtolower($sheetData[$x][1])==strtolower($rollno)){
			$rowNo = $x;
			break;
		}
	}
	// echo $rowNo;
	$total_hour = $sheetData[$rowNo][2];
	$attendance = array();
	for($y=$columnSize; $y>=4; $y--){
		if(!empty($sheetData[$rowNo][$y])){
			$subAttendance=array();
			$subAttendance['hour']=$sheetData[$rowNo][$y];
			$subAttendance['date'] = $sheetData[0][$y];
			$subAttendance['activity'] = $sheetData[1][$y];
			$attendance[]=$subAttendance;
		}
	}
	$response = array();
	$response['attendance']=$attendance;
	$_SESSION['rollno']=$rollno;
	$_SESSION['name']=$sheetData[$rowNo][0];
	$_SESSION['unit']=$unit;
	$_SESSION['phone']=$sheetData[$rowNo][2];
	$_SESSION['total_hour']=$total_hour;
	$_SESSION['attendance']=json_encode($response);
}
function logged_in(){
	if(isset($_SESSION['rollno']) || isset($_COOKIE['rollno'])){
		return true;
	}
	else{
		return false;
	}
}
function blood_request(){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$name=clean($_POST["BName"]);
		$roll=clean($_POST["BRoll"]);
		$email=clean($_POST["BEmail"]);
		$phone=clean($_POST["BPhone"]);
		$for_whom=clean($_POST["BForWhom"]);
		$address=clean($_POST["BAddress"]);
		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/google-service-account.json');
		$subject="Blood Request from NSS";
		$msg="
			<p>$name has requested for blood. </p>
			<p>Details: </p>
			<h5>Name : $name</h5>
			<h5>Roll/Employee ID : $roll</h5>
			<h5>Email : $email</h5>
			<h5>Phone : $phone</h5>
			<h5>For Whom : $for_whom</h5>
			<h5>Address : $address</h5>
		";
		$header="From: nss@iitp.ac.in";
		$send_to ="nss@iitp.ac.in";
		if (send_email($send_to,$subject,$msg,$header)){

		}
	}
}