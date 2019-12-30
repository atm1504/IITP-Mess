<?php 
	include("./functions/init.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>IITP Hostel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/logo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main_complain.css">
<!--===============================================================================================-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
</head>

<style>
	@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);
body {
  
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  padding-top: 100px;
}

form {
  margin-left: auto;
  margin-right: auto;
  width: 343px;
  height: 333px;
  padding-right: 30px;
  padding-left: 30px;
  padding-top: 30px;
  padding-bottom: 30px;
  width: 500px;
  height: 400px;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  background: rgba(0, 0, 0, 0.5);
  -moz-box-shadow: 0 0 13px 3px rgba(0, 0, 0, 0.5);
  -webkit-box-shadow: 0 0 13px 3px rgba(0, 0, 0, 0.5);
  box-shadow: 0 0 13px 3px rgba(0, 0, 0, 0.5);
  overflow: hidden;
}

textarea {
  background: #e9ecef;
  width: 437px;
  height: 150px;
  border: 1px solid rgba(255, 255, 255, 0.6);
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  display: block;
  font-family: "Source Sans Pro",'FontAwesome', sans-serif;
  font-size: 18px;
  color: #fff;
  padding-left: 45px;
  padding-right: 20px;
  padding-top: 12px;
  margin-bottom: 20px;
  overflow: hidden;
}

input {
  width: 437px;
  height: 48px;
  border: 1px solid rgba(255, 255, 255, 0.4);
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  display: block;
  font-family: "Source Sans Pro", sans-serif;
  font-size: 18px;
  color: #fff;
  padding-left: 20px;
  padding-right: 20px;
  margin-bottom: 20px;
}

input[type="submit"] {
  cursor: pointer;
}

input.name {
  font-family: "Source Sans Pro",'FontAwesome', sans-serif;
  background:#e9ecef;
  padding-left: 45px;
}

input.email {
	font-family: "Source Sans Pro",'FontAwesome', sans-serif;
  background:#e9ecef;
  padding-left: 45px;
}

input.message {
  background: rgba(255, 255, 255, 0.4)
    url(http://luismruiz.com/img/gemicon_message.png) no-repeat scroll 16px 16px;
	font-family: "Source Sans Pro",'FontAwesome', sans-serif;
  padding-left: 45px;
}

::-webkit-input-placeholder {
  color: #fff;
}

:-moz-placeholder {
  color: #fff;
}

::-moz-placeholder {
  color: #fff;
}

:-ms-input-placeholder {
  color: #fff;
}

input:focus,
textarea:focus {
  background-color: rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);
  -webkit-box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);
  box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);
  overflow: hidden;
}

.btn {
  width: 138px;
  height: 44px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  float: right;
  border: 1px solid #253737;
  background: #416b68;
  background: -webkit-gradient(
    linear,
    left top,
    left bottom,
    from(#6da5a3),
    to(#416b68)
  );
  background: #d41872;
  background: -webkit-linear-gradient(left, #a445b2, #d41872, #fa4299);
  background: -o-linear-gradient(left, #a445b2, #d41872, #fa4299);
  background: -moz-linear-gradient(left, #a445b2, #d41872, #fa4299);
  background: linear-gradient(left, #a445b2, #d41872, #fa4299);
  padding: 10.5px 21px;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;
  -webkit-box-shadow: rgba(255, 255, 255, 0.1) 0 1px 0,
    inset rgba(255, 255, 255, 0.7) 0 1px 0;
  -moz-box-shadow: rgba(255, 255, 255, 0.1) 0 1px 0,
    inset rgba(255, 255, 255, 0.7) 0 1px 0;
  box-shadow: rgba(255, 255, 255, 0.1) 0 1px 0,
    inset rgba(255, 255, 255, 0.7) 0 1px 0;
  text-shadow: #333333 0 1px 0;
  color: #e1e1e1;
}


.btn:hover {
  border: 1px solid #253737;
  text-shadow: #333333 0 1px 0;
  background: #416b68;
  background: -webkit-gradient(
    linear,
    left top,
    left bottom,
    from(#77b2b0),
    to(#416b68)
  );
  background-color: #555555;
  color: #fff;
}

.btn:active {
  margin-top: 1px;
  text-shadow: #333333 0 -1px 0;
  border: 1px solid #253737;
  background: #6da5a3;
  background: -webkit-gradient(
    linear,
    left top,
    left bottom,
    from(#416b68),
    to(#416b68)
  );
  background: -webkit-linear-gradient(top, #416b68, #609391);
  background: -moz-linear-gradient(top, #416b68, #6da5a3);
  background: -ms-linear-gradient(top, #416b68, #6da5a3);
  background: -o-linear-gradient(top, #416b68, #6da5a3);
  background-image: -ms-linear-gradient(top, #416b68 0%, #6da5a3 100%);
  color: #fff;
  -webkit-box-shadow: rgba(255, 255, 255, 0) 0 1px 0,
    inset rgba(255, 255, 255, 0.7) 0 1px 0;
  -moz-box-shadow: rgba(255, 255, 255, 0) 0 1px 0,
    inset rgba(255, 255, 255, 0.7) 0 1px 0;
  box-shadow: rgba(255, 255, 255, 0) 0 1px 0,
    inset rgba(255, 255, 255, 0.7) 0 1px 0;
}
</style>
<body>


	<div class="container-contact100">
		

				<span class="contact100-form-title" style="color:white;padding-bottom:0px;">
					<?php 
					hostel_complain();
					display_message();
					?>
					File Mess Complain
				</span>

				<form>
					<input name="name" placeholder="&#xf007; NAME" class="name" required />
  					<input name="emailaddress" placeholder="&#xf0e0; EMAIL" class="email" type="email" required />
  					<textarea rows="4" cols="50" name="subject" placeholder="&#xf119; COMLPAIN" class="message" required></textarea>
  					<input name="submit" class="btn" type="submit" value="Send" />
				</form>

				
			
	</div>



<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});


			$(".js-select2").each(function(){
				$(this).on('select2:close', function (e){
					if($(this).val() == "Please chooses") {
						$('.js-show-service').slideUp();
					}
					else {
						$('.js-show-service').slideUp();
						$('.js-show-service').slideDown();
					}
				});
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="vendor/noui/nouislider.min.js"></script>
	<script>
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 1500, 3900 ],
	        connect: true,
	        range: {
	            'min': 1500,
	            'max': 7500
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]);
	        $('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
	        $('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
	    });
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
