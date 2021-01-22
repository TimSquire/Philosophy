<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "unity";
	
	//Make Connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	//Check Connection
	if(!$conn){
		die("Connection Failed. ". mysqli_connect_error());
	} 
	$sql = "SELECT * FROM scores
			ORDER BY score DESC";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) > 0){
		//show data for each row
		while($row = mysqli_fetch_assoc($result)){
			echo  "TimeSurvived:" . $row['score'] . "|Date:" . $row['date'] . ";";
		}
	}
?>