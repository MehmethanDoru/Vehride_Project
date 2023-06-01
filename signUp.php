<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="css/signUp.css">
    <link rel="icon" type="image/x-icon" href="images/institutional/favicon.png" />
	<title>Sign Up | VEHRIDE</title>

</head>

<body>

	<div class="container-md form ">
		<div class="row">
			<div class="col-4 left-panel">
				<img src="images/signPage/traffic.jpg" class="leftImg" width="100%" alt="leftPanelImg">
			</div>
			<div class="col-lg-8 col-xs-12 offset-lg-4 right-panel">
				<div class="returnHome"><a style="color: #000" href="
			<?php $vehicle = $_COOKIE['vehicle'];
			if ($vehicle == 'car') {
				echo "car/car.php";
			}
			if ($vehicle == 'motorcycle') {
				echo "moto/moto.php";
			} ?>">Go to Home Page</a></div>
				<form action="signControl.php" method="post">
					<div class="loginForm">
						<div class="labelHead">
							<h4>We are <strong>VEHRIDE</strong></h4>
							<p style="margin-top: 20px; font-size: 14px">Welcome! Create an account to take the road:
							</p>
						</div>
						<div class="form-floating mt-4 formSize">
							<input style="background-color: #c2c2c2;" type="text" class="form-control inputSet"
								id="fname" name="fname" placeholder="First Name" autocomplete="off">
							<label for="fname">First Name</label>
						</div>
						<div class="form-floating formSize">
							<input style="background-color: #c2c2c2;" type="text" class="form-control inputSet"
								id="lname" name="lname" placeholder="Last Name" autocomplete="off">
							<label for="lname">Last Name</label>
						</div>
						<div class="form-floating formSize">
							<input style="background-color: #c2c2c2; " type="email" class="form-control inputSet"
								id="email" name="email" placeholder="name@example.com" autocomplete="off">
							<label for="email">Email address</label>
						</div>
						<div class="form-floating formSize">
							<input style="background-color: #c2c2c2;" type="password" minlength="8"
								class="form-control inputSet" id="password" name="password" placeholder="Password">
							<label for="password">Password</label>
						</div>
						<div class="form-floating formSize">
							<input style="background-color: #c2c2c2;" type="password" minlength="8"
								class="form-control inputSet" id="passwordAgain" name="passwordAgain"
								placeholder="Password Again">
							<label for="passwordAgain">Password Again</label>
						</div>

						<input class="mt-4 loginButton" type="submit" value="Sign Up">
					</div>
				</form>
				<div class="bottom-text">
					<p>If you have an account --> <a style="color: #000" href="login.php">Login</a></p>
				</div>
			</div>
		</div>
	</div>

</body>

</html>