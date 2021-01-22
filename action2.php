<?php
session_start();
$connect=mysqli_connect("localhost","u212525129_TimSquire","1164Life!","u212525129_blog");
if(!preg_match("/^[a-zA-Z]*$/",$_POST['fname'])){
echo'invalidfname';
}else{
if(!preg_match("/^[a-zA-Z]*$/",$_POST['lname'])){
echo'invalidlname';
}else{
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
echo'invalidemail';
}else{
if($_POST['cpassword']!=$_POST['ccpassword']){
echo'wrongpwds';
}else{
$hashed=PASSWORD_HASH($_POST['cpassword'],PASSWORD_DEFAULT);
$query="INSERT INTO `users` (`user_id`,`fname`,`sname`,`username`,`password`,`dob`,`email`,`privs`,`show`) VALUES (NULL,'".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["username2"]."','$hashed','".$_POST["dob"]."','".$_POST["email"]."',1,'yes')";
$compare="SELECT * FROM users WHERE username = '".$_POST["username2"]."'";
$get=mysqli_query($connect,$compare)or die('No connecto');
if(mysqli_num_rows($get)<=0){
echo'Yes';
$result=mysqli_query($connect,$query)or die('No connecto');
$_SESSION['username']=$_POST['username2'];
$_SESSION["privs"]=1;
header('location:index.php');
}else{
echo'taken';}
}
}
}
}
if(isset($_POST["action2"])){
unset($_SESSION["username"]);}
?>
