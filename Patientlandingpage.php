<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8";>
		<title>Patient Landing page</title>
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
	<?php 
	require_once "serverconfig.php";
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$patid=$_GET["patientid"];
	$sql = "SELECT Patient_ID, `Patient Name` FROM `patients table` WHERE loginIDnumber = '$patid'";
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$patientID = $row["Patient_ID"];
			$patientname = $row["Patient Name"];
		}
	}
	else {
		$sql1 = "SELECT Patient_ID, `Patient Name` FROM `patients table` WHERE Patient_ID = '$patid'";
		$result1 = mysqli_query($link, $sql1);
		if(mysqli_num_rows($result1) > 0){
			while($row1 = mysqli_fetch_assoc($result1)){
				$patientID = $row1["Patient_ID"];
				$patientname = $row1["Patient Name"];
			}
		}
	}
	?>
	<div><center><h3>Welcome <?php echo $patientname;?></h3></center></div>
	<center><h4>What would you like to do today?</h4></center>
	<center><button type="submit" value="Patient Registration form" onclick="location.href = 'newpatientregistration.php?patientid=<?php echo $patientID;?>'">Patient Registration Form</button></center>
	<center><button type="submit" value="PRFview" onclick="location.href = 'prfview.php?patientid=<?php echo $patientID;?>'">View Old Registration Form</button></center><br>
	<div><center><button value="Log Out" type="submit" onclick="location.href='loginpage.php'">Log Out</button></center></div>
	</body>
</html>