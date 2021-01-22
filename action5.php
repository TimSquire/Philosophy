<?php
session_start();
$connect=mysqli_connect("localhost","u212525129_TimSquire","1164Life!","u212525129_blog");
if(isset($_POST["dusername"]))
{
$query="
SELECT * FROM users
WHERE username = '".$_POST["dusername"]."'
";
$result=mysqli_query($connect,$query);
if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_array($result)){
if($row['show']=='yes'){
if(password_verify($_POST["dpassword"],$row['password'])){
$user=$_SESSION['username'];
$delu="UPDATE `users` SET `show` = 'no' WHERE `users`.`username` = '$user'";
$delete=mysqli_query($connect,$delu);
header('location:bloglogout.php');
}else{
echo'ip';
}
}else{
echo'iu';
}
}
}else{
echo'iu';
}
}
if(isset($_POST["action"]))
{
unset($_SESSION["username"]);
}
?>
