<!DOCTYPE html>
<html>
<head>
	<title>OTP</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1 class="text-center">Sending OTP SMS in PHP from Localhost using textlocal</h1>
		<hr>
		<div class="row">
			<div class="col-md-9 col-md-offset-2">
				<?php
				if(isset($_POST['sendotp'])){
					require('textlocal.class.php');
					require('credential.php');

					$textlocal = new Textlocal(false,false,API_KEY);

					$numbers = array($_POST['mobile']);
					$sender = 'TXTLCL';
					$otp = mt_rand(10000, 99999);
					$message = "Hello " . $_POST['uname'] . " This is Your OTP " . $otp;

					try {
					    $result = $textlocal->sendSms($numbers, $message, $sender);
					    setcookie('otp', $otp);
					    echo "OTP Successfully send..";
					    // print_r($result);
					} catch (Exception $e) {
					    die('Error: ' . $e->getMessage());
					}
				}

					if(isset($_POST['verifyotp'])){
						$otp = $_POST['otp'];
						if($_COOKIE['otp'] == $otp){
							echo "Congratulation";
						}
						else{
							echo "Please Enter the correct OTP";
						}

					}
				?>
			</div>
			<div class="col-md-9 col-md-offset-2">
				<form role="form" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-9 form-group">
							<label for="uname">Name</label>
							<input type="text" class="form-control" id="uname" name="uname" value="" maxlength="10" placeholder="Enter Your Name" required="">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-9 form-group">
							<label for="mobile">Mobile</label>
							<input type="text" class="form-control" id="mobile" name="mobile" value="" maxlength="10" placeholder="Enter Valid Mobile Number" required="">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-9 form-group">
							<button type="submit" name="sendotp" class="btn btn-lg btn-success btn-block">Send OTP</button>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-9 form-group">
							<label for="mobile">OTP</label>
							<input type="text" class="form-control" id="otp" name="otp" value="" maxlength="5" placeholder="Enter OTP">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-9 form-group">
							<button type="submit" name="verifyotp" class="btn btn-lg btn-info btn-block">Verify</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>