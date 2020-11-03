<?php 
	require_once "serverconfig.php"; //connect to mysqldatabase
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$username = "";
	$password = "";
	$confirmpass = "";
	$doctorID = "";
	$doctorIDerr = "";
	$usernameerr = "";
	$passworderr = "";
	$confirmpasserr = "";
	$nameID = "";
	$nameerr = "";//set all variables to empty
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){ //this form processor runs when user hits submit
		if (empty(trim($_POST["username"]))){ 
			$usernameerr = "Please enter a username"; //check if username field is empty
		}
		else { //if its not, prepare a select statment to see if the username is already taken
			$username = $_POST['username'];
			$sqlu = "SELECT * FROM logins WHERE username ='$username'";
			$ressql = mysqli_query($link, $sqlu);
			if(mysqli_num_rows($ressql) > 0){
				$usernameerr = "username already taken";
			}
			else{
				$username = trim($_POST["username"]);
			}
		}
		if(empty(trim($_POST["password"]))){
			$passworderr = "Please enter a password"; //check if password is empty
		}
		elseif(strlen(trim($_POST["password"]))< 8){ //check if password is at least 8 characters
			$passworderr = "Your password must be at least 8 characters long.";
		}
		else { //if it satisfies the requirements were good
			$password = trim($_POST["password"]);
		}
		
		if(empty(trim($_POST["confirmpass"]))){ //make sure they confirmed their password
			$confirmpasserr = "Please confirm your password";
		}
		else{
			$confirmpass = trim($_POST["confirmpass"]); //make sure they match and we have no errors
			if(empty($passworderr) && ($password != $confirmpass)){
				$confirmpasserr = "Passwords don't match, try again";
			}
		}
		if(empty(trim($_POST["doctorID"]))){ //make sure they entered their ID
			$doctorIDerr = "Please enter an ID";
		}
		else { //prepare a select statment to see if the ID exists in the database
			$doctorID = $_POST['doctorID'];
			$sqlD = "SELECT * FROM logins WHERE IDnumber ='$doctorID'";
			$ressql = mysqli_query($link, $sqlD);
			if(mysqli_num_rows($ressql) > 0){
				$doctorID = trim($_POST["doctorID"]);
			}
			else{
				$doctorIDerr = "ID doesn't exist.";
			}
		}
		if(empty($_POST["nameID"])){
			$nameerr = "Please enter a name"; //check if password is empty
		}
		else{
			$nameID = $_POST["nameID"];
		}
		if(empty($usernameerr) && empty($passworderr) && empty($confirmpasserr) && empty($doctorIDerr) && empty($nameerr)){ //if all the errorfields are empty, meaning nothing went wrong...
			
			$sql = "INSERT INTO logins (Username, Password, Doctor) VALUES (?, ?, ?)";			//then go ahead and insert the new data into the table
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, 'ssi', $param_username, $param_password, $param_doctor);
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT);				//hash the password so that its not stored in plaintext and they are unique
				$param_doctor = 1;
				
				if(mysqli_stmt_execute($stmt)){
					echo "I think it went right inserting";
				}
				else {
					echo "Oopsie poopsie, something went really wrong, try later, insertion statement failed";
				}
				mysqli_stmt_close($stmt);
			}
			$sql1 = "SELECT LoginIDNumber FROM logins WHERE username='$username'";
			$sql2 = "INSERT INTO `doctors table` (`Doctor Name`, LoginIDNumber) VALUES (?,?)";
			if($stmt2= mysqli_prepare($link, $sql2)){
				mysqli_stmt_bind_param($stmt2, 'si', $param_name, $paramID);
				$param_name = $nameID;
				$rslt = mysqli_query($link, $sql1);
				while($row = mysqli_fetch_assoc($rslt)){
					$paramID = $row["LoginIDNumber"];
				}
				echo $paramID;
				echo $param_name;
				if(mysqli_stmt_execute($stmt2)){
					header("location: Loginpage.php");
				}
				else {
					echo "something went wrong inserting name into the doctors table";
				}
				mysqli_stmt_close($stmt2);
			}
		}
		mysqli_close($link);
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8";>
		<title>Register</title>
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
	<div id="question"><center><h3>Please register a new account</h3></center></div>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<div class="form-group <?php echo (!empty($usernameerr)) ? 'has error' : ''; ?>">
		<center><label>Username:</label>
		<input type="text" name="username" class="form-control" value = "<?php echo $username; ?>"></center>
		<span class="help-block"><?php echo $usernameerr; ?></span>
	</div>
	<div class="form-group <?php echo (!empty($passworderr)) ? 'has-error' : ''; ?>">
		<center><label>Password:</label>
		<input type="password" name="password" class="form-control" value = "<?php echo $password; ?>"><?php echo $password; echo $passworderr; ?></center>
		<span class="help-block"><?php echo $passworderr;?></span>
	</div>
	<div class="form-group <?php echo (!empty($confirmpasserr)) ? 'has error' : ''; ?>">
		<center><label>Confirm Password:</label>
		<input type="password" name="confirmpass" class="form-control" value = "<?php echo $confirmpass; ?>"><?php echo $confirmpass; ?></center>
		<span class="help-block"><?php echo $confirmpasserr;?></span>
	</div>
	<div class="form-group <?php echo (!empty($doctorIDerr)) ? 'has error' : ''; ?>">
		<center><label>National Provider Identifier:</label>
		<input type="text" name="doctorID" class="form-control" value = "<?php echo $doctorID; ?>"><?php echo $doctorID; ?></center>
		<span class="help-block"><?php echo $doctorIDerr;?></span>
	</div>
	<div class="form-group <?php echo (!empty($nameerr)) ? 'has error' : ''; ?>">
		<center><label>Name(Dr. first last):</label>
		<input type="text" name="nameID" class="form-control" value = "<?php echo $nameID; ?>"></center>
		<span class="help-block"><?php echo $nameerr;?></span>
	</div>
				<center><div class="form-group"><input type="submit" class="btn btn-primary" value="Submit 	"></div></center>
	</form>
	</body>
</html>