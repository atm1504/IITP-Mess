<?php include("./functions/init.php"); 
if(logged_in() == false){
    echo "Inside";
    redirect("login.php");
}else{
    echo "Outside";}
getDetails()?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>IITP-Hostel Mess Rebate</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!--     Fonts and icons     -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

	<!-- CSS Files -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="./css/gsdk-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.css" rel="stylesheet" />
	<link rel="shortcut icon" href="../images/mainNSS/logo.ico">
	<link rel="apple-touch-icon-precomposed" href="../images/mainNSS/logo.jpeg">
</head>

<body>
<div class="image-container set-full-height" style="background-image: url('assets/img/profilebg.jpg')">
    <!--   Creative Tim Branding   -->
    <a href="https://www.facebook.com/nssiitp/?epa=SEARCH_BOX">
         <div class="logo-container">
            <div class="logo">
                <img src="assets/img/logo.jpeg">
            </div>
            <div class="brand">
                Web Dev Team
            </div>
        </div>
    </a>

	<!--  Made With Get Shit Done Kit  -->
		<a href="https://www.facebook.com/atm1504" class="made-with-mk">
			<div class="brand">IIT Patna</div>
			<div class="made-with"><strong>Not Me but You</strong></div>
		</a>

    <!--   Big container   -->
    <div class="container">
        <div class="row">
        <div class="col-sm-10 col-sm-offset-1">

            <!--      Wizard container        -->
            <div class="wizard-container">

                <div class="card wizard-card" data-color="orange" id="wizardProfile">
                    <form action="" method="">
                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                    	<div class="wizard-header">
                        	<h3>
                        	   CHECK YOUR <b> ATTENDANCE </b><br>
                        	   <small>This information will help you know your pending hours.</small>
                        	</h3>
                    	</div>

						<div class="wizard-navigation">
							<ul>
	                            <li><a href="#about" data-toggle="tab">Your Profile</a></li>

	                        </ul>

						</div>

                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                              <div class="row">

                                  <div class="col-sm-4 col-sm-offset-1">
                                     <div class="picture-container">
                                          <div class="picture">
                                              <img src="../images/mainNSS/logo.jpeg" class="picture-src" id="wizardPicturePreview" title=""/>
                                          </div>

                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <h5 id="sname">Name: <?php echo $_SESSION['name'] ?></h5>
                                      </div>
                                      <div class="form-group">
                                        <h5 id="srollno">Roll No: <?php echo $_SESSION['rollno']?></h5>
                                      </div>
																			<div class="form-group">
                                        <h5 id="cell">Unit: <b><?php echo $_SESSION['unit'] ?></b></h5>
                                      </div>
                                  </div>

                                    <div class="col-sm-6">
                                            <div class="form-group">
                                            <h4><b>HOURS COMPLETED</b></h4>	<h6 id="hours"><?php echo $_SESSION['total_hour'] ?></h6>
                                            </div>
                                            <div class="form-group">
                                                <h4><b>HOURS LEFT</b></h4>	<h6 id="hours"><?php 
                                                    $hour_done=(float)$_SESSION['total_hour'];
                                                    $hour_left=80.00-$hour_done;
                                                    $rollno=$_SESSION['rollno'];
                                                    if(strpos($rollno,"1801")!==false){
                                                        $hour_left=60.00-$hour_done;
                                                    }
                                                    if($hour_left>0){
                                                        echo $hour_left;
                                                    }else{
                                                        echo "You have completed your 80 hours quota.";
                                                    }
                                                ?></h6>
                                            </div>
                                    </div>


                              </div>
                            </div>

                        </div>
                        <div class="wizard-footer height-wizard">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
                              <a href="logout.php">  <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Log Out' /></a>

                            </div>

                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </form> 
                </div>
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->
        
        <!--The table starts here-->
        <div style="overflow: auto">
            <div class="tables" style="max-width:946px;background-color: white;margin:20px auto;">
            
                <table class="table table-striped table-bordered table-hover table-responsive">
                    <thead>
                        <tr style="font-size:25px;background-color: orange;">
                            <th >S.No</th>
                            <th >Activity</th>
                            <th >Date</th>
                            <th >Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $attendance=(array)json_decode($_SESSION["attendance"]);
                    $attendance_array=$attendance["attendance"];
                    $id=1;

                    foreach($attendance_array as $obj){
                        $item=(array)$obj;
                        echo "<tr style='font-size:20px;'>
                                <td>".$id."</td>
                                <td>".$item["activity"]."</td>
                                <td>".$item["date"]."</td>
                                <td>".$item["hour"]."</td>
                            </tr>";
                            $id+=1;
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>


        <!--The table ends here-->
    </div> <!--  big container -->




    <div class="footer">
        <div class="container">
             Made with <a href="https://www.facebook.com/atm1504/" target="_blank"><i class="fa fa-heart heart"></i> by Web Dev Team</a>
        </div>
    </div>

</div>

</body>

	<!--   Core JS Files   -->
	<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="assets/js/gsdk-bootstrap-wizard.js"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="assets/js/jquery.validate.min.js"></script>

</html>
