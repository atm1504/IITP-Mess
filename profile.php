<?php include("./functions/init.php"); 
if(logged_in() == false){
    echo "Inside";
    redirect("login.php");
}else{
    $details = getDetails();
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="images/icons/logo.png">
	<link rel="icon" type="image/png" href="images/icons/logo.png">
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
	<link href="./css/demo.css" rel="stylesheet" />
	<link rel="shortcut icon" href="./images/logo/logo.png">
	<link rel="apple-touch-icon-precomposed" href="./images/icons/logo.png">
</head>

<body>
<div class="image-container" style="background-image: url('./images/profilebg.jpg')">
      <!-- Creative Tim Branding  
    <a href="https://www.facebook.com/gymkhana.iitp/">
         <div class="logo-container">
            <div class="logo">
                <img src="./images/icons/logo.png">
            </div>
            <div class="brand">
                Web Dev Team
            </div>
        </div>
    </a> -->

	<!--  Made With Get Shit Done Kit  -->
		<a href="https://www.facebook.com/gymkhana.iitp/" class="made-with-mk">
			<div class="brand">IITP</div>
			<div class="made-with"><strong>Hostel Team</strong></div>
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
                        	   CHECK YOUR <b> MESS REBATE </b><br>
                        	   <small>This information will help you know the amount of mess refund you would receive.</small>
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
                                              <img src="./images/logo.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                          </div>

                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <h5 id="sname">Name: <?php echo($details['name']);?></h5>
                                      </div>
                                      <div class="form-group">
                                        <h5 id="srollno">Roll No: <?php echo($details['rollno']);?></h5>
                                      </div>
                                      	<div class="form-group">
                                            <h5 id="cell">Email: <b><?php echo($details['email']); ?></b></h5>
                                         </div>
                                        <div class="form-group">
                                            <h5 id="cell">Phone: <b><?php echo($details['phone']); ?></b></h5>
                                         </div>
									    <div class="form-group">
                                            <h5 id="cell">Mess: <b><?php echo($details['mess']); ?></b></h5>
                                         </div>
                                  </div>

                                    <div class="col-sm-6">
                                            <div class="form-group bank">
                                            <h4><b>Bank Name</b></h4>	<h6 id="hours"><?php echo($details['bank_name']); ?></h6>
                                            </div>
                                            <div class="form-group">
                                            <h4><b>Bank Account No</b></h4>	<h6 id="hours"><?php echo($details['bank_account_no']); ?></h6>
                                            </div>
                                            <div class="form-group">
                                            <h4><b>IFSC</b></h4>	<h6 id="hours"><?php echo($details['ifsc']); ?></h6>
                                            </div>
                                            <div class="form-group">
                                                <h4><b>Amounnt to be Refunded</b></h4>	<h5 id="hours"><?php 
                                                        echo($details['amount_to_be_refunded']);
                                                ?></h5>
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
        <!--The table ends here-->
    </div> <!--  big container -->




    <div class="footer">
        <div class="container">
             Made with <a href="https://www.facebook.com/atm1504" target="_blank"><i class="fa fa-heart heart"></i> by Amartya Mondal</a>
        </div>
    </div>

</div>

</body>

	<!--   Core JS Files   -->
	<script src="./js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="./js/bootstrap.min.js" type="text/javascript"></script>
	<script src="./js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="./js/gsdk-bootstrap-wizard.js"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="./js/jquery.validate.min.js"></script>

</html>
