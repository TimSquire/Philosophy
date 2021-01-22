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
if(ISSET($_GET['searchSubmit'])){
	$search = $_GET['search'];
	$trimmed = trim($search);
	$_SESSION['search'] = $trimmed;
	header('location: searchadmincom.php');
}
if(ISSET($_POST['editButton'])){
	if(ISSET($_POST['selectButton'])){
			$_SESSION['editcom'] = $_POST['selectButton'];
			header('location:editcom.php');
	} else {
		$error = 'Please select a comment to edit';
	}
}
if(ISSET($_POST['hideButton'])){
	if(ISSET($_POST['selectButton'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$comid = $_POST['selectButton'];
		$query2 = "
		UPDATE `comments` SET `show` = 'no' WHERE `comments`.`comments_id` = $comid;
		";
		$result2 = mysqli_query($connect, $query2);
		header('location:splashcom.php');
	} else {
		$error = 'Please select a comment to hide';
	}
}
if(ISSET($_POST['showButton'])){
	if(ISSET($_POST['selectButton'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$comid = $_POST['selectButton'];
		$query2 = "
		UPDATE `comments` SET `show` = 'yes' WHERE `comments`.`comments_id` = $comid;
		";
		$result2 = mysqli_query($connect, $query2);
		header('location:splashcom.php');
	} else {
		$error = 'Please select a comment to show';
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

               <a class="header__search-trigger" href="#0"></a>

                <div class="header__search">

                    <form role="search" method="get" class="header__search-form" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="search" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" name = "searchSubmit" class="search-submit" value="Search">
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

<head>
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
	$orderby = " ORDER BY comments_id DESC";
} elseif($_GET['sort'] == 1){
		$orderby = " ORDER BY ".$_GET["col"]." DESC";
} else {
	$orderby = " ORDER BY ".$_GET["col"]." ASC";
}
	$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
				$query = "
				SELECT comments.comments_id, comments.content, comments.author, comments.date, comments.show, relations2.comment, relations2.article
				FROM comments
				INNER JOIN relations2
				ON relations2.comment = comments.comments_id
				" . $orderby;
				$result = mysqli_query($connect, $query);
	?>
<div class="table-responsive text-nowrap">
  <table class="table" style="margin: 0px auto; width: 1250px">
    <thead>
      <tr>
		<th></th>
		<?php
		if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=comments_id">Comment ID</a></th>';
		} else {
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=comments_id">Comment ID</a></th>';
		}
		if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=content">Content</a></th>';
		} else {
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=content">Content</a></th>';
		}
		if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=author">Author</a></th>';
		} else {
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=author">Author</a></th>';
		}
		if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=date">Publication Date</a></th>';
		} else {
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=date">Publication Date</a></th>';
		}
		if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=article">Affiliated Post</a></th>';
		} else {
		echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=article">Affiliated Post</a></th>';
		}
		?>
		<th>Show</th>
      </tr>
    </thead>
    <tbody>
	<?php
	while($row = mysqli_fetch_array($result)){
					if($row['comments_id'] != 1){
						?>
	<tr>
		<td><input type="radio" name="selectButton" value = <?php echo $row['comments_id'] ?> /></td>
        <td><?php echo $row['comments_id']?></td>
        <td><?php
		if(strlen($row['content'])  > 90){
			$con = substr($row['content'],0,90);
			echo $con . ' ...';
		} else {
			echo $row['content'];
		}
		?></td>
		<td><?php echo $row['author']?></td>
        <td><?php echo $row['date']?></td>
		<td><?php echo $row['article']?></td>
		<td><?php echo $row['show']?></td>
    </tr>
	<?php
					}
				}
	?>
    </tbody>
  </table>
  </div>
</br>
</br>
<input type="submit" class="submit btn--primary btn--large" value = 'Edit Comment'name = "editButton" id = 'editButton'>
<input type="submit" class="submit btn--primary btn--large" value = 'Hide Comment'name = "hideButton" id = 'hideButton'>
<input type="submit" class="submit btn--primary btn--large" value = 'Show Comment'name = "showButton" id = 'showButton'>
</div>
</form>
</body>
<!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
	<?php
require_once('modals.php');
?>
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
