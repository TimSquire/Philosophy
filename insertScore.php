<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "unity";
	
	$score = $_POST['score']; //120;
	$date = $_POST['date']; //"12/30/19";
	
	//Make Connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	//Check Connection
	if(!$conn){
		die("Connection Failed. ". mysqli_connect_error());
	} 
	$sql = "INSERT INTO scores (score_id, score, date) VALUES (NULL, '".$score."', '".$date."')";
	$result = mysqli_query($conn, $sql);
?>