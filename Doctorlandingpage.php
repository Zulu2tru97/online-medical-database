<?php
require_once "serverconfig.php"; //connect to mysqldatabase
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8";>
		<title>Doctor landing page</title>
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
	$docid=$_GET["docid"]; //gets login id from URL
	$sql1 = "Select Doctor_ID, `Doctor Name` FROM `doctors table` WHERE loginIDnumber = '$docid'"; //use login ID to find their name and docid
	$result1 = mysqli_query($link, $sql1);
	if(mysqli_num_rows($result1) > 0){
		while($row1 = mysqli_fetch_assoc($result1)){
			$doctorID = $row1["Doctor_ID"];
			$doctorname = $row1["Doctor Name"];
		}
	}
	else {
		echo "no results, something went wrong getting the doctor ID";
	}
	?>
	<div><center><h3>Welcome <?php echo $doctorname;?></h3></center></div>
	<div>Your Patients:</div>
	<?php
	$sql = "SELECT `Patient Name`, Patient_ID FROM `patients table` WHERE Doctor_ID = '$doctorID'"; //find docs patients using doc id
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0){
		echo "<table><tr><th>ID</th><th>NAME</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>" . $row["Patient_ID"]. "</td><td>". $row["Patient Name"].  "</td><td><button value='View Registration Form' type='submit' onclick='location.href=`prfdoctorview.php?docid=" .$docid. "&patientid=" .$row["Patient_ID"]. "`'>View registration form</button></td></tr>";
		}
	echo "</table>";
	}
	else {
		echo "no results";
	}
	?>
	<div><center><button value="Log Out" type="submit" onclick="location.href='loginpage.php'">Log Out</button></center></div>
	</body>
	</html>