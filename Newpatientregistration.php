<?php
	require_once "serverconfig.php";
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$tdate = "";
	$fname = "";
	$lname = "";
	$mname = "";
	$saddress = "";
	$city = "";
	$state ="";
	$zip = 0;
	$hphone = "";
	$wphone = "";
	$email = "";
	$echoice = "";
	$dob = "";
	$sex = "";
	
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$tdate = trim($_POST["date"]);
		$fname = trim($_POST["patientfname"]);
		$lname = trim($_POST["patientlname"]);
		$mname = trim($_POST["patientinitial"]);
		$saddress = trim($_POST["streetaddress"]);
		$city = trim($_POST["city"]);
		$state = trim($_POST["state"]);
		$zip = trim($_POST["ZIP"]);
		$hphone = trim($_POST["phonenum1"]);
		$wphone = trim($_POST["phonenum2"]);
		$email = trim($_POST["email"]);
		$echoice = trim($_POST["choice"]);
		$dob = trim($_POST["DOB"]);
		$sex = trim($_POST["sex"]);
		$patid = $_REQUEST["ID"];
		
		$sql = "INSERT INTO `patient registration` (todaysdate, firstname, lastname, middleinitial, streetaddress, city, state, zip, homephone, workphone, email, emailchoice, dob, sex, Patient_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, $patid)"; //then go ahead and insert the new data into the table
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "sssssssissssss", $param_tdate, $param_fname, $param_lname, $param_mname, $param_saddress, $param_city, $param_state, $param_zip, $param_hphone, $param_wphone, $param_email, $param_echoice, $param_dob, $param_sex);
				$param_tdate = $tdate;
				$param_fname = $fname;
				$param_lname = $lname;
				$param_mname = $mname;
				$param_saddress = $saddress;
				$param_city = $city;
				$param_state = $state;
				$param_zip = $zip;
				$param_hphone = $hphone;
				$param_wphone = $wphone;
				$param_email = $email;
				$param_echoice = $echoice;
				$param_dob = $dob;
				$param_sex = $sex;
				if(mysqli_stmt_execute($stmt)){
					header("location: Patientlandingpage.php?patientid=$patid");
				}
				else {
					echo "something went wrong inserting name into the patients table";
				}
				mysqli_stmt_close($stmt);
			}
		mysqli_close($link);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8";>
		<title>New Patient Registration</title>
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
		.flex_container {
			display: flex;
			height: 50px;
			border: none;
			border-bottom: 3px solid black;
			flex-flow: row nowrap;
			justify-content: space-between;
			align-content: center;
			align-items:center;
		}
		label {
			font-family: Helvetica;
		}
		#Form {
			width: 900px;
			height: 400px;
			border: 2px solid black;
			padding: 15px 15px;
		}
		.leftall {
			float:left;
		}
		.rightall {
			float:right;
		}
		#patientfname {
			width: 150px;
			border: none;
			border-bottom: 1px solid black;
		}
		#patientlname {
			width: 150px;
			border: none;
			border-bottom: 1px solid black;
		}
		#patientinitial {
			width: 50px;
			border: none;
			border-bottom: 1px solid black;
		}
		#streetaddress {
			width: 250px;
			border: none;
			border-bottom: 1px solid black;
		}
		#city {
			width: 200px;
			border: none;
			border-bottom: 1px solid black;
		}
		#ZIP {
			width: 75px;
			border: none;
			border-bottom: 1px solid black;
		}
		</style>
		
	</head>
	<body>
	<center>
		<label><b><h1>New Patient Registration</b></h1>
	</center>
	<center>
	<div id="Form" align="left">
		<div class="flex_container">
		<div><h3><u>Patient Info</u></h3></div>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div>Date:<input id="date" name="date" class="form-control" type="date"></input></div>
		</div><br>
		<label>First name:</label>
		<input id="patientfname" name="patientfname" type="text" class="form-control" placeholder="John">
		<label>Last name:
		<input id="patientlname"  name="patientlname" class="form-control" type="text" placeholder="Doe">
		<label>Middle initial:
		<input id="patientinitial" name="patientinitial" class="form-control" type="text" placeholder="R"><br><br>
		<label>Street Address:
		<input id="streetaddress" name="streetaddress" class="form-control" type="text" placeholder="123 Main St.">
		<label> City:
		<input id="city" name="city" class="form-control" type="text" placeholder="Townsville">
		<label> State:
		<select name="state" class="form-control">
			<option value="AL">AL</option>
			<option value="AK">AK</option>
			<option value="AR">AR</option>	
			<option value="AZ">AZ</option>
			<option value="CA">CA</option>
			<option value="CO">CO</option>
			<option value="CT">CT</option>
			<option value="DC">DC</option>
			<option value="DE">DE</option>
			<option value="FL">FL</option>
			<option value="GA">GA</option>
			<option value="HI">HI</option>
			<option value="IA">IA</option>	
			<option value="ID">ID</option>
			<option value="IL">IL</option>
			<option value="IN">IN</option>
			<option value="KS">KS</option>
			<option value="KY">KY</option>
			<option value="LA">LA</option>
			<option value="MA">MA</option>
			<option value="MD">MD</option>
			<option value="ME">ME</option>
			<option value="MI">MI</option>
			<option value="MN">MN</option>
			<option value="MO">MO</option>	
			<option value="MS">MS</option>
			<option value="MT">MT</option>
			<option value="NC">NC</option>	
			<option value="NE">NE</option>
			<option value="NH">NH</option>
			<option value="NJ">NJ</option>
			<option value="NM">NM</option>			
			<option value="NV">NV</option>
			<option value="NY">NY</option>
			<option value="ND">ND</option>
			<option value="OH">OH</option>
			<option value="OK">OK</option>
			<option value="OR">OR</option>
			<option value="PA">PA</option>
			<option value="RI">RI</option>
			<option value="SC">SC</option>
			<option value="SD">SD</option>
			<option value="TN">TN</option>
			<option value="TX">TX</option>
			<option value="UT">UT</option>
			<option value="VT">VT</option>
			<option value="VA">VA</option>
			<option value="WA">WA</option>
			<option value="WI">WI</option>	
			<option value="WV">WV</option>
			<option value="WY">WY</option>
		</select>
		<label>ZIP:</label><input id="ZIP" name="ZIP" class="form-control" type="number" placeholder="12345"><br><br>
		<label>Home Phone:</label><input id="phonenum1" name="phonenum1" class="form-control" type="tel" placeholder="123-456-7890">
		<label>Work Phone:</label><input id="phonenum2" name="phonenum2" class="form-control" type="tel" placeholder="123-456-7890"><br><br>
		<label>Email:<input id="email" name="email" class="form-control" type="email" placeholder="Johndoe42@email.com">
		<label>Would you be interested in receiving emails?:</label>
		<input id="choiceyes" class="form-control" type="radio" value="yes" name="choice"><label>yes</label>
		<input id="choiceno" class="form-control" type="radio" value="no" name="choice"><label>no</label><br><br>
		<label>DOB:</label><input id="DOB" name="DOB" class="form-control" type="date">
		<label>Sex:<input id="choicem" class="form-control" type="radio" value="M" name="sex"><label>M</label>
		<input id="choicef" type="radio" class="form-control" value="F" name="sex"><label>F</label>
		<input id="choiceo" type="radio" class="form-control" value="Other" name="sex"><label>Other</label>
		<input type="hidden" name="ID" value="<?php echo $_GET['patientid'];?>">
		
	</center>
	</div><br>
	<center>
	<input type="submit" class="btn btn-primary" onclick="location.href='PatientLandingpage.php?patientid=<?php echo $_REQUEST['patientid']; ?> value="Submit"> 
	</center>
	</body>
	
</html>
