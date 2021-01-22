<html>
<body>
<?php
if(!ISSET($_GET['sort']) && !ISSET($_GET["col"])){
	$orderby = " ORDER BY user_id DESC";
} elseif($_GET['sort'] == 1){
		$orderby = " ORDER BY ".$_GET["col"]." DESC";
} else {
	$orderby = " ORDER BY ".$_GET["col"]." ASC";
}
$dbc = mysqli_connect('localhost','root','','blog') or die('bruh');
$query = "SELECT users.user_id, users.fname, users.sname, users.username, users.email, users.dob, users.show, users.privs, users.joindate, privs.privs
		FROM users
		INNER JOIN privs
		ON privs.privs_id = users.privs" . $orderby;
echo $query;
$result = mysqli_query($dbc, $query);
?>
<table class="table" style="margin: 0px auto;">
<tr>
<?php
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=user_id">User ID</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=user_id">User ID</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=fname">Fname</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=fname">Fname</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=sname">Sname</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=sname">Sname</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=username">Username</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=username">Username</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=dob">Birthdate</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=dob">Birthdate</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=users.privs">Privs</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=users.privs">Privs</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=joindate">Join Date</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=joindate">Join Date</a></th>';
}
?>
</tr>
<?php
while($row = mysqli_fetch_array($result)){

	echo '<tr><td>' . $row['user_id'] . '</td>';
	echo '<td>' . $row['fname'] . '</td>';
	echo '<td>' . $row['sname'] . '</td>';
	echo '<td>' . $row['username'] . '</td>';
	echo '<td>' . $row['dob'] . '</td>';
	echo '<td>' . $row['privs'] . '</td>';
	echo '<td>' . $row['joindate'] . '</td></tr>';
}
?>
</body>
<style>
a:link{
  color:black;
}
a:visited{
  color:black;
}
a:hover{
  color:black;
}
a:focus{
  color:black;
}
a:active{
  color:black;
}
</style>
</html>