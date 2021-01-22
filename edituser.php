<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(!ISSET($_SESSION['username']) or !ISSET($_SESSION['edituser'])){
	header('location: index.php');
} else {
	if(!ISSET($_SESSION['privs'])){
	header('location: index.php');
} else {
if($_SESSION['privs'] != 4){
	header('location: index.php');
} else {
$edituser = $_SESSION['edituser'];
if(ISSET($_POST['submitButton'])){
	if(!empty($_POST['fname']) && !empty($_POST['sname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['privs']) && !empty($_POST['joindate'])){
		$fname = $_POST['fname'];
		$sname = $_POST['sname'];
		$username = $_POST['username'];
		$dob = $_POST['dob'];
		$email = $_POST['email'];
		$privs = $_POST['privs'];
		$joindate = $_POST['joindate'];
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$query3 = "
					UPDATE `users` SET `fname` = '$fname', `sname` = '$sname', `username` = '$username', `dob` = '$dob', `email` = '$email', `privs` = '$privs', `joindate` = '$joindate' WHERE `users`.`user_id` = $edituser;
					";
		$result3 = mysqli_query($connect, $query3) or die('No connecto');
		header('location: splash.php');
	} else {
		$error = 'Please enter changes';
	}
}
?>
<head>
<div align = "center">
    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Philosophy</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.11.3/standard-all/ckeditor.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

	 <!-- Files to make modal work
    ================================================== -->
	<script src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
	<script src = 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
	<link rel = 'stylesheet' href = 'css/bootstrap.min.css'>




</head>

<body id="top">

    <!-- pageheader
    ================================================== -->
    <div class="s-pageheader">

        <header class="header">
            <div class="header__content row">

                <div class="header__logo">
                    <a class="logo" href="index.php">
                        <img src="images/logo.svg" alt="Homepage">
                    </a>
                </div> <!-- end header__logo -->

                <ul class="header__social">
                    <li>
                        <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    </li>
                </ul> <!-- end header__social -->

                <a class="header__search-trigger" href="#0"></a>

                <div class="header__search">

                    <form role="search" method="get" class="header__search-form" action="#">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>

                    <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

                </div>  <!-- end header__search -->


                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">
					<p3> <?php echo 'Welcome ' . $_SESSION['username'] . ' (Admin)'; ?></p3>
                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <ul class="header__nav">
                        <li><a href="splash.php" title="">Users</a></li>
						<li><a href="splashart.php" title="">Articles</a></li>
						<li><a href="splashcat.php" title="">Categories</a></li>
						<li><a href="splashcom.php" title="">Comments</a></li>
						<li><a href="bloglogout.php" title="">Logout</a></li>
                    </ul> <!-- end header__nav -->
                    <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

                </nav> <!-- end header__nav-wrap -->

            </div> <!-- header-content -->
        </header> <!-- header -->

    </div> <!-- end s-pageheader -->
</div>

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">
	<link rel = 'stylesheet' href = 'css/bootstrap.min.css'>

<body>
<div align="center">
<form name="adminForm" id="adminForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<p2>
<?php
if(ISSET($error)){
	echo $error;
}
?>
</p2>
</br>
<?php
$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
				$query2 = "
				SELECT users.user_id, users.fname, users.sname, users.username, users.password, users.email, users.dob, users.privs, users.joindate
				FROM users WHERE users.user_id = $edituser
				";
				$result2 = mysqli_query($connect, $query2);
				while($row2 = mysqli_fetch_array($result2)){
				?>
<label>First Name</label>
<input type = 'text' name = 'fname' value = '<?php echo $row2['fname']; ?>'>
</br>
<label>Last Name</label>
<input type = 'text' name = 'sname' value = '<?php echo $row2['sname']; ?>'>
</br>
<label>Username</label>
<input type = 'text' name = 'username' value = '<?php echo $row2['username']; ?>'>
</br>
<label>Birthdate</label>
</br>
<input type = 'date' name = 'dob' value = "<?php echo $row2['dob'] ?>" >
</br>
<label>Email</label>
<input type = 'text' name = 'email' value = '<?php echo $row2['email']; ?>'>
</br>
<label>Privelages</label>
<select name = 'privs'>
<?php
$firstquery = "
SELECT users.privs, users.user_id, privs.privs_id, privs.privs
FROM users
INNER JOIN privs
ON privs.privs_id = users.privs
";
$firstresult = mysqli_query($connect, $firstquery);
while($first = mysqli_fetch_array($firstresult)){
if($first['user_id'] == $edituser){
?>
<option value = '<?php echo $first['privs'] ?>' > <?php echo $first['privs'] ?> </option>
<?php
}
}
$query = "
SELECT privs.privs_id, privs.privs
FROM privs
";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){
?>
<option value = '<?php echo $row['privs_id'] ?>' > <?php echo $row['privs']; ?> </option>
<?php
}
?>
</select>
</br>
<label>Join Date</label>
</br>
<input type = 'datetime-local' name = 'joindate' value="<?php echo date("Y-m-d\TH:i:s",  strtotime(str_replace('-','/', $row2['joindate']))); ?>" >
</br>
<?php
				}
?>
</br>
<input type = 'submit' class="submit btn--primary btn--large" name = 'submitButton' value = 'Submit Changes'>
</div>
</form>
</body>

    </section> <!-- s-content -->


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

<style>
.comments-wrap {
   background-color: #e5e5e5;
}
</style>
    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
 <script>
 ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
 </script>
</body>
<style>
p2{
	color: red;
}
p3{
	color: #FFFFFF;
}
</style>
</html>
</html>
<?php
}
}
}
?>
