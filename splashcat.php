<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(!ISSET($_SESSION['privs'])){
	header('location: index.php');
} else {
	if($_SESSION['privs'] < 4){
		header('location: index.php');
	} else {
if(ISSET($_POST['editButton'])){
	if(ISSET($_POST['selectButton'])){
		$_SESSION['editcat'] = $_POST['selectButton'];
		header('location:editcat.php');
	} else {
		$error = 'Please select a category to edit';
	}
}
if(ISSET($_POST['addButton'])){
	header('location:addcat.php');
}
if(ISSET($_POST['removeButton'])){
	if(ISSET($_POST['selectButton'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$catid = $_POST['selectButton'];
		$delq = "
		DELETE FROM `category` WHERE `category`.`category_id` = '$catid'
		";
		$delr = mysqli_query($connect, $delq);
		$delq2 = "
		DELETE FROM `relations` WHERE `relations`.`category` = '$catid'
		";
		$delr2 = mysqli_query($connect, $delq2);
		header('location:splashcat.php');
	} else {
		$error = 'Please select a category to remove';
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

	<!--<link type="text/css" href="sample/css/sample.css" rel="stylesheet" media="screen" />-->


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


                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">
					<p3> <?php echo 'Welcome ' . $_SESSION['username'] . ' (Admin)'; ?></p3>
                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <ul class="header__nav">
                        <li><a href="splash.php" title="">Users</a></li>
						<li><a href="splashart.php" title="">Articles</a></li>
						<li><a href="splashcat.php" title="">Categories</a></li>
						<li><a href="splashcom.php" title="">Comments</a></li>
						<li class="has-children">
                            <a href="#0" title="">My Account</a>
                            <ul class="sub-menu">
                            <li><a class ="editpass-button" data-toggle="modal" data-target="#editpassModal" href="http://www.google.ca">Change Password</a></li>
                            <li><a class ="edituser-button" data-toggle="modal" data-target="#edituserModal" href="http://www.google.ca">Change Username</a></li>
                            <li><a class ="del-button" data-toggle="modal" data-target="#delModal" href="http://www.google.ca">Delete Account</a></li>
                            </ul>
                        </li>
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
<p2>
<?php
if(ISSET($error)){
	echo $error;
}
?>
</p2>
<form name="adminForm" id="adminForm" method="post" action="">
<?php
if(!ISSET($_GET['sort']) && !ISSET($_GET["col"])){
	$orderby = " ORDER BY category_id DESC";
} elseif($_GET['sort'] == 1){
		$orderby = " ORDER BY ".$_GET["col"]." DESC";
} else {
	$orderby = " ORDER BY ".$_GET["col"]." ASC";
}
$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
$query = "
SELECT category.category_id, category.categoryName, categoryDescription
FROM category
". $orderby;
$result = mysqli_query($connect, $query);
?>
<div class="table-responsive text-nowrap">
  <table class="table" style="margin: 0px auto; width:1250px">
    <thead>
      <tr>
		<th></th>
		<?php
		if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=category_id">Category ID</a></th>';
		} else {
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=category_id">Category ID</a></th>';
		}
		if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=categoryName">Category Name</a></th>';
		} else {
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=categoryName">Category Name</a></th>';
		}
		if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=categoryDescription">Category Description</a></th>';
		} else {
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=categoryDescription">Category Description</a></th>';
		}
		?>
        <th>Affiliated Posts</th>
      </tr>
    </thead>
    <tbody>
	<?php

				while($row = mysqli_fetch_array($result)){
	?>
	<tr>
		<td><input type="radio" name="selectButton" value = <?php echo $row['category_id'] ?> /></td>
        <td><?php echo $row['category_id']?></td>
        <td><?php echo $row['categoryName']?></td>
		<td><?php echo $row['categoryDescription']?></td>
		<td>
		<?php
		$query2 = "
				SELECT relations.category, relations.article
				FROM relations
				";
				$result2 = mysqli_query($connect, $query2);
				while($row2 = mysqli_fetch_array($result2)){
		?>
		<?php
		if($row['category_id'] == $row2['category']){
		?>
        <?php echo $row2['article'];
				}
				}
				?>
	</td>
    </tr>
	<?php
				}
	?>
    </tbody>
  </table>
  </div>
</br>
</br>
<input type="submit" class="submit btn--primary btn--large" value = 'Edit Category'name = "editButton" id = 'editButton'>
<input type="submit" class="submit btn--primary btn--large" value = 'Add Category'name = "addButton" id = 'addButton'>
<input type="submit" class="submit btn--primary btn--large" value = 'Remove Category'name = "removeButton" id = 'removeButton'>
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
		<?php
require_once('modals.php');
?>
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
th {
	color: #337AB7;
}
</style>
<?php
	}
}
?>
</html>
