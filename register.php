<?php
require_once('recaptchalib.php');
require_once('user-register-class.php');


$register = new register();

$error = null;
$success = null;

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(isset($_POST['username'])){

	//Validate Form
	$dat = $register->validate($username,$email,$password);

		if($dat['success']){
			//if success add user to database
			$register->add_user($username,$email,$password);
			$success = "Success Register your account";
			$_POST = array();
		}else{
			//if error return error reason from array
			foreach($dat['err'] as $reason){
				$error .= '<p>'.$reason.'</p>';
			}
		}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<title>RF Priesta Pre-Register</title>
		<style>
		body {
			background: #000;
		}
		.register-outer {
			background: #fff;
			padding: 25px;
			width: 400px;
			margin: 100px auto 50px;
		}
		.form-control {
			border-radius: 0px;
		}
		h1.title {
			margin-top: 0;
		}
		#main-header {
			background: url(banner.png) no-repeat;
			background-position: center;
			height: 410px;
			margin-bottom: -255px;
		}
		</style>
	</head>
	<body>

		<div class="container">
			<header id="main-header"></header>
			<div class="register-outer">
				<h1 class="title">Register <small>RF Priesta</small></h1>
				<hr>
				<?php if($error) { ?>
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>
				<?php } ?>

				<?php if($success) { ?>
				<div class="alert alert-success">
					<?php echo $success; ?>
				</div>
				<?php } ?>
				<form action="/register.php" method="post">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo htmlEntities($_POST['username']) ?>" required>
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo htmlEntities($_POST['email']) ?>" required>
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" class="form-control" placeholder="Password" name="password" required>
					</div>
					<hr>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-lg" name="button">Register</button>
					</div>
				</form>
			</div>
		</div>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>
