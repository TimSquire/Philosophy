<?php
session_start();
$connect=mysqli_connect("localhost","u212525129_TimSquire","1164Life!","u212525129_blog");
$user=$_SESSION["username"];
$query="SELECT * FROM `users` WHERE `username` = '$user'";
$result=mysqli_query($connect,$query);
while($row=mysqli_fetch_array($result)){
if(password_verify($_POST["epassword"],$row['password'])){
if($_POST['npassword']==$_POST['cnpassword']){
$hashed=PASSWORD_HASH($_POST['npassword'],PASSWORD_DEFAULT);
$query2="UPDATE `users` SET `password` = '$hashed' WHERE `users`.`username` = '$user'";
$result2=mysqli_query($connect,$query2);
}else{
echo'npdm';
}
}else{
echo'icp';
}
}
if(isset($_POST["action"]))
{
unset($_SESSION["username"]);
}
?>
