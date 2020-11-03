<?php
	session_start(); //initialize the session
	require_once "serverconfig.php";
	 if ($link -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $link -> connect_error;
	  exit();
	}
	else {
			echo "Connected to MySQL.";
	}//this just checks if its actually connecting to mysql
	$username = "";
	$hashedpassword = "";
	$password = "";
	$usernameerr = "";
	$passworderr = "";
	$doctorbool = 0;
	$adminbool = 0;//initializing all variables to zero
	//processing form data when submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//check if fields are empty
		if(empty(trim($_POST["username"]))){
			$usernameerr = "Please enter a username.";
		}
		else {
			$username = trim($_POST["username"]);//trim just removes whitespace from left and right
		}
		if(empty(trim($_POST["password"]))){
			$passworderr = "Please enter a password.";
		}
		else {
			$password = trim($_POST["password"]);
		}
		//if both fields are not empty...
		if(empty($usernameerr) && empty($passworderr)){
			//prepare a select statement
			$sql = "SELECT Username, Password, Doctor, Admin, LoginIDNumber FROM logins WHERE Username = ?";
			if($stmt = mysqli_prepare($link, $sql)){
				//bind values to prepared statement as parameters.
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				//set parameters
				$param_username = $username;
				//attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					//if it works store the result
					mysqli_stmt_store_result($stmt);
					//check if username exists
					if(mysqli_stmt_num_rows($stmt)>=1){
						//bind result variables
						mysqli_stmt_bind_result($stmt, $username, $hashedpassword, $doctorbool, $adminbool, $loginid);
						if(mysqli_stmt_fetch($stmt)){
							if(password_verify($password, $hashedpassword)){
								//password is correct so start new session
								session_start();
								//store data in session variables
								$_SESSION["loggedin"]=true;
								$_SESSION["username"]=$username;
								if($doctorbool == 1){//checks if they are a doctor or not
									header("location: Doctorlandingpage.php?docid=$loginid");
								}
								elseif($adminbool == 1){//check if they are administrator
									header("location: adminpage.php");
								}
								else {
									header("location: patientlandingpage.php?patientid=$loginid");
								}
								
							}
							else {
								//display an error message if password isn't correct
								$passworderr = "The password you entered is not correct.";
							}
						}
					} else {
						//display an error message is username doesn't exist.
						$usernameerr = "Username does not exist.";
					}
				} else {
					//if shit really hits the fan
					echo "oops, we fucked up, try later";
				}
				//close statement
				mysqli_stmt_close($stmt);
			}
		}
		//close connection
		mysqli_close($link);
	}
?>
					
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8";>
		<title>Landing Page</title>
		<style>
		html{
		height: 100%;
		}
		body{
		height: 100%;
		margin: 0;
		background-color: rgb(19,237,245);
		background-image: linear-gradient(rgb(19,237, 245), white);
		background-attachment: fixed;
		}
		#header{
			border: none;
			border-bottom: 2px solid black;
		}
		</style>
	</head>
	<body>
	<div id="header"><center><h1>WELCOME TO ATTAWAY GENERAL MEDICAL DATABASE</h1></center></div>
	<div id="question"><center><h3>Please login to your account</h3></center></div>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<div class="form-group <?php echo (!empty($usernameerr)) ? 'has error' : ''; ?>" id="loginbox">
		<center><label>Username:</label>
		<input type="text" name="username" class="form-control"></center>
		<center><span class="help-block"><?php echo $usernameerr; ?></span></center>
		</div>
	<div class="form-group <?php echo (!empty($passworderr)) ? 'has-error' : ''; ?>">
	<center><label>Password:</label>
	<input type="password" name="password" class="form-control"></center>
	<center><span class="help-block"><?php echo $passworderr;?></center></span>
	</div>
	<div id="choice">
				<center><div><input type="submit" class="btn btn-primary" value="Login"></div></center>
	</form>
	<div>
		<center> New User? <form action="registrationpage.php"><input type="submit" value="Register as patient"></form>
		<form action="Doctorregistrationpage.php"><input type="submit" value="Register as doctor"></form>
	</body>
</html>