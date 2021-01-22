<?php
session_start();
$connect=mysqli_connect("localhost","u212525129_TimSquire","1164Life!","u212525129_blog");
if(isset($_POST["eusername"])){
if($_POST['eusername']==$_SESSION['username']){
if($_POST['nusername']==$_POST['cnusername']){
$compare="SELECT * FROM users WHERE username = '".$_POST["nusername"]."'";
$get=mysqli_query($connect,$compare)or die('No connecto');
if(mysqli_num_rows($get)<=0){
$query="UPDATE `users` SET`username` = '".$_POST["nusername"]."' WHERE `users`.`username` = '".$_SESSION["username"]."'";
$result=mysqli_query($connect,$query);
$_SESSION['username']=$_POST["nusername"];
}else{
echo't';
}
}else{
echo'nudm';
}
}else{
echo'icu';
}
}
if(isset($_POST["action"]))
{
unset($_SESSION["username"]);
}
?>
