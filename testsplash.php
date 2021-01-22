<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(ISSET($_POST['editButton'])){
	if(ISSET($_POST['selectButton'])){
			$_SESSION['edituser'] = $_POST['selectButton'];
			$_SESSION['choose'] = $_POST['choose'];
			header('location:edituser.php');
	} else {
		$error = 'Please select a user to edit';
	}
}
if(ISSET($_POST['hideButton'])){
	if(ISSET($_POST['selectButton'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$userid = $_POST['selectButton'];
		$query2 = "
		UPDATE `users` SET `show` = 'no' WHERE `users`.`user_id` = $userid;
		";
		$result2 = mysqli_query($connect, $query2);
		header('location:splash.php');
	} else {
		$error = 'Please select a user to hide';
	}
}
if(ISSET($_POST['showButton'])){
	if(ISSET($_POST['selectButton'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$userid = $_POST['selectButton'];
		$query2 = "
		UPDATE `users` SET `show` = 'yes' WHERE `users`.`user_id` = $userid;
		";
		$result2 = mysqli_query($connect, $query2);
		header('location:splash.php');
	} else {
		$error = 'Please select a user to show';
	}
}
?>
<head>
<div align = "center">
    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Standard Post Format - Philosophy</title>
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

	<!--<link type="text/css" href="sample/css/sample.css" rel="stylesheet" media="screen" />-->


</head>

<body id="top">

    <!-- pageheader
    ================================================== -->
    <div class="s-pageheader">

        <header class="header">
            <div class="header__content row">

                <div class="header__logo">
                    <a class="logo" href="index.html">
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

<head>
  <title>Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">
<p2>
<?php
if(ISSET($error)){
	echo $error;
}
?>
</p2>
<form name="adminForm" id="adminForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table class="table" style="margin: 0px auto;">
    <thead>
      <tr>
		<th></th>
		<th>User_id</th>
        <th>Firstname</th>
        <th>Lastname</th>
		 <th>Username</th>
        <th>Email</th>
		 <th>Birthdate</th>
		 <th>Privelages</th>
		 <th>Join Date</th>
		 <th>Show</th>
      </tr>
    </thead>
    <tbody>
	<?php
	$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
				$query = "
				SELECT users.user_id, users.fname, users.sname, users.username, users.email, users.dob, users.show, users.joindate, privs.privs
				FROM users
				INNER JOIN privs
				ON privs.privs_id = users.privs
				ORDER BY users.user_id DESC
				";
				$result = mysqli_query($connect, $query);
				while($row = mysqli_fetch_array($result)){
	?>
	<tr>
		<td><input type="radio" name="selectButton" value = "<?php echo $row['user_id'] ?>" ></td>
        <td><?php echo $row['user_id']?></td>
        <td><?php echo $row['fname']?></td>
        <td><?php echo $row['sname']?></td>
		<td><?php echo $row['username']?></td>
		<td><?php echo $row['email']?></td>
		<td><?php echo $row['dob']?></td>
		<td><?php echo $row['privs']?></td>
		<td><?php echo $row['joindate']?></td>
		<td><?php echo $row['show']?></td>
    </tr>
	<?php
				}
	?>
    </tbody>
  </table>
</br>
</br>
<input type="submit" class="submit btn--primary btn--large" value = 'Edit User'name = "editButton" id = 'editButton' width = '30%'>
<input type="submit" class="submit btn--primary btn--large" value = 'Hide User'name = "hideButton" id = 'hideButton' width = '30%'>
<input type="submit" class="submit btn--primary btn--large" value = 'Show User'name = "showButton" id = 'showButton' width = '30%'>
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
