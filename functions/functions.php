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

function validate_login(){
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$errors=[];
		$rollno=clean($_POST['rollno']);
		$password=clean($_POST['password']);
		$password=sha1($password);
		$sql ="SELECT id FROM mess WHERE rollno='$rollno' AND password='$password'";
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
function getDetails(){
	// $mess = $_SESSION['mess'];
	$mess="Mess1";
	$rollno=$_SESSION['rollno'];
	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	$spreadsheet = $reader->load("./mess_rebate.xlsx");
	$sheetData = $spreadsheet->getSheetByName($mess)->toArray();
	$arrayName=$sheetData;
	$rowSize = count( $arrayName );
	$columnSize = max( array_map('count', $arrayName) );
	for($x=3; $x<=$rowSize; $x++){
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
        $response['name']=$sheetData[$rowNo][3];
        $response['phone']=$sheetData[$rowNo][4];
        $response['bank_name']=$sheetData[$rowNo][5];
        $response['bank_to_be_refunded']=$sheetData[$rowNo][6];
        return json_encode($response);
    }else{
        return false;
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
		$roll=clean($_POST["roll"]);
		$email=clean($_POST["email"]);
		$phone=clean($_POST["phone"]);
		$complain=clean($_POST["complain"]);
		$subject="IIT Patna Hostel Issue";
		$msg="
			<p>$name has some complain regarding IIT Patna Hostel Facility. </p>
			<p>Details: </p>
			<h5>Name : $name</h5>
			<h5>Roll/Employee ID : $roll</h5>
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
            return true;
		}else{
            return false;
        }
	}
}