<!DOCTYPE html>
	<head>
		<title>Asset Management System - Login</title>
		<meta charset="UTF-8"/>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'/>
	</head>
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/login.css')?>" type="text/css">
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/bootstrap.min.css')?>" type="text/css">
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/font-awesome.min.css')?>" type="text/css">

	<body marginwidth="0" marginheight="0">
		<div class="login-box">
			<div class="login-header">
				<p>ASSET MANAGEMENT SYSTEM</p>
			</div>
			<p class="login-sub">Insert your username and password on the form below to continue.</p>
			<div class="login-body">
				<form method="post" action="<?=base_url('login/do_login')?>">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="usernameAssets" placeholder="Username" required>
					</div>
					<div class="form-group">
						<label for="passw">Password</label>
						<input type="password" class="form-control" id="passw" name="passwordAssets" placeholder="Password" required>
					</div>
					<div class="error-msg">

					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning">Login</button>
						<button class='btn btn-danger'>Forgot Password</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
