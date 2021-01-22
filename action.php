<?php
session_start();
$connect = mysqli_connect("localhost","u212525129_TimSquire","1164Life!","u212525129_blog");
if(isset($_POST["username"])){
$query="SELECT * FROM users WHERE username = '".$_POST["username"]."'";
$result=mysqli_query($connect,$query);
if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_array($result)){
if($row['show']=='yes'){
if(password_verify($_POST["password"],$row['password'])){
$_SESSION['username']=$_POST['username'];
$_SESSION["privs"]=$row["privs"];
header('location: index.php');
}else{
echo'No';}
}else{
echo'IU';}
}
}else{
echo'IU';}
}
if(isset($_POST["action"])){
unset($_SESSION["username"]);}
?>
