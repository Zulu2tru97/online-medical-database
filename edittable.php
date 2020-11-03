<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$doctordb = mysqli_connect('localhost', 'root', '', 'medicaldatabase');
if (!$doctordb) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}
else {
	echo "Connected to MySQL.";
}
?>
<?php
	$tableID = $_GET["doctableid"];
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['patid'])) {
		$pid = $_POST["patid"];
		$sql3 = "UPDATE `patients table` SET Doctor_ID = '$tableID' WHERE Patient_ID = '$pid'";
		mysqli_query($doctordb, $sql3);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8";>
		<title>Administrator landing page</title>
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
	<div id="welcome"><center><h3>Welcome Administrator</h3></center></div>
	<div id="Doctortable"><h4></h4>
	<?php
	$tableid = $_GET['doctableid'];
	$sql1 = "SELECT `Doctor Name` FROM `doctors table` WHERE Doctor_ID = '$tableid'";
	$result1 = mysqli_query($doctordb, $sql1);
	?>
	<div><h4><?php while($docname=mysqli_fetch_assoc($result1)){echo $docname["Doctor Name"];}?>'s Patients</h4></div>
	<?php //so basically what I want to do here is say, these are doctor x's patients, using their doctor ID I loop through patients 
	$tableid = $_GET['doctableid'];
	$sql = "SELECT `Patient Name` FROM `patients table` WHERE Doctor_ID = '$tableid'";
	$result = mysqli_query($doctordb, $sql);
	if(mysqli_num_rows($result) > 0){
		echo "<table><tr><th>NAME</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>" . $row["Patient Name"]. "</td></tr>";
		}
	echo "</table>";
	}
	else {
		echo "no results";
	}
	?>
	<div><h4>All Patients</h4></div>
	<?php
	$sql2 = "SELECT `Patient Name`, Patient_ID FROM `patients table`";
	$result2 = mysqli_query($doctordb, $sql2);
	if(mysqli_num_rows($result2) > 0){
		echo "<table><tr><th>ID</th><th>NAME</th></tr>";
		while($row2 = mysqli_fetch_assoc($result2)) {
			echo "<tr><td>" . $row2["Patient_ID"]. "</td><td>". $row2["Patient Name"]. "</td><td><form action='edittable.php?doctableid=" .$tableID. "' method='post'><input type='submit' class='btn btn-primary' value='add'><input type='hidden' name='patid' value='".$row2["Patient_ID"] ."'></form></td></tr>";
		}
	echo "</table>";
	}
	else {
		echo "no results";
	}
	//I want to have a button, that says add, and when you press it, php alters the doctor id for the patient to the current doctors page. Maybe I could have a hidden field, in a form, when you hit submit it passes patient id using get, then executes the alter?
	?>
	</div>
	<div><center><button value="GO BACK" type="submit" onclick="location.href='adminpage.php'">GO BACK</button></center></div>
	</body>
</html>