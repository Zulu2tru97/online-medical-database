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
		<script>
		/*function clearcontent(cellrow) {  
			var x=cellrow.parentNode.parentNode.rowIndex;
			var doctable=document.getElementById("newtable");
			document.getElementById("Doctortable").innerHTML = "";
			//document.getElementById("Doctortable").innerHTML += x;
			var docid=doctable.rows[x].cells[0].innerHTML;
			document.getElementById("Doctortable").innerHTML += docid;

			/*alert(docid);
			document.getElementById("Doctortable").innerHTML = "";
			document.getElementById("Doctortable").innerHTML += x;
			$(document).ready(function () {
			createCookie("docid", docid, "10");
			});
			function createCookie(name, value, days) {
				var expires;
				if (days){
					var date = new Date(); //36
					date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
					expires = "; expires=" + date.toGMTstring();
				}
				else {
					expires = "";
				}
				document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
			}
			function runphp(){
			console.log(<?php echo $_COOKIE["docid"];?>);
			}
			runphp();*/
		}
		</script>
	</head>
	<body>
	<div id="header"><center><h1>WELCOME TO ATTAWAY GENERAL MEDICAL DATABASE</h1></center></div>
	<div id="welcome"><center><h3>Welcome Administrator</h3></center></div>
	<div id="Doctortable"><h4>List of Doctors</h4>
	<?php
	$sql = "SELECT `Doctor Name`, Doctor_ID FROM `doctors table`";
	$result = mysqli_query($doctordb, $sql);
	session_start();
	if(mysqli_num_rows($result) > 0){
		echo "<table id='newtable'><tr><th>ID</th><th>NAME</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
		$edittableid = $row["Doctor_ID"];
		echo "<tr><td>" . $row["Doctor_ID"]."</td><td>". $row["Doctor Name"] ."</td><td><button value='edit' type='submit' onclick ='location.href = `edittable.php?doctableid=" . $row["Doctor_ID"] ."`'>edit</button></td></tr>";
		$_SESSION['doctableid'] = $row["Doctor_ID"];
		}
	echo "</table>";
	}
	else {
		echo "no results";
	}
	?>
	<!--<div><h4>Doctor John Does Patients</h4></div>
	<?php //so basically what I want to do here is say, these are doctor x's patients, using their doctor ID I loop through patients table
	$sql = "SELECT `Patient Name` FROM `patients table` WHERE Doctor_ID = 1";
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
	?>-->
	</div>
	<div><center><button value="Log Out" type="submit" onclick="location.href='loginpage.php'">Log Out</button></center></div>
	</body>
</html>