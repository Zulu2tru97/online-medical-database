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
	$patid = $_GET['patientid'];
	$docid = $_GET['docid'];
	
	$sql = "SELECT todaysdate, firstname, lastname, middleinitial, streetaddress, city, state, zip, homephone, workphone, email, emailchoice, dob, sex FROM `patient registration` WHERE Patient_ID = '$patid'";
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$tdate = $row["todaysdate"];
			$fname = $row["firstname"];
			$lname = $row["lastname"];
			$mname = $row["middleinitial"];
			$saddress = $row["streetaddress"];
			$city = $row["city"];
			$state = $row["state"];
			$zip = $row["zip"];
			$hphone = $row["homephone"];
			$wphone = $row["workphone"];
			$email = $row["email"];
			$echoice = $row["emailchoice"];
			$dob = $row["dob"];
			$sex = $row["sex"];
		}
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
		<div>Date:<h4><?php echo $tdate;?></h4></div>
		</div><br>
		<label>First name:<?php echo $fname;?></label><br>
		<label>Last name:<?php echo $lname;?></label><br>
		<label>Middle initial:<?php echo $mname;?></label><br><br>
		<label>Street Address:<?php echo $saddress;?></label><br>
		<label> City:<?php echo $city;?></label><br>
		<label> State:<?php echo $state;?></label><br>
		<label>ZIP:<?php echo $zip;?></label><br><br>
		<label>Home Phone:<?php echo $hphone;?></label><br>
		<label>Work Phone:<?php echo $wphone;?></label><br><br>
		<label>Email:<?php echo $email;?></label><br>
		<label>Would you be interested in receiving emails?:<?php echo $echoice;?></label><br><br>
		<label>DOB:<?php echo $dob;?></label><br>
		<label>Sex:<?php echo $sex;?></label><br>
		<input type="hidden" name="ID" value="<?php echo $_GET['patientid'];?>">
		
	</center>
	</div><br>
	<center>
	<div><center><button value="GO BACK" type="submit" onclick="location.href='doctorlandingpage.php?docid=<?php echo $docid; ?>'">GO BACK</button></center></div>
	</center>
	</body>
	
</html>