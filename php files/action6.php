<?php
session_start();
$connect=mysqli_connect("localhost","root","","blog");
if(isset($_POST["ausername"]))
{
$query="
SELECT * FROM users
WHERE username = '".$_POST["ausername"]."'
";
$result=mysqli_query($connect,$query);
if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_array($result)){
if($row['show']=='yes'){
if(password_verify($_POST["apassword"],$row['password'])){
$user=$_SESSION['username'];
$auth="UPDATE `users` SET `privs` = '2' WHERE `users`.`username` = '$user'";
$author=mysqli_query($connect,$auth);
$_SESSION['privs']=2;
$_SESSION['error']='';
header('location:index.php');					
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