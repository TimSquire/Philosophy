<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(!ISSET($_SESSION['privs'])){
	header('location: index.php');
} else {
	if($_SESSION['privs'] < 3){
		header('location: index.php');
	} else {
if(!ISSET($_GET['sort']) && !ISSET($_GET["col"])){
$orderby = " ORDER BY article_id DESC";
} elseif($_GET['sort'] == 1){
$orderby = " ORDER BY ".$_GET["col"]." DESC";
} else {
$orderby = " ORDER BY ".$_GET["col"]." ASC";
}
$searched = $_SESSION['search'];
$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
$query = "SELECT * FROM articles WHERE title LIKE '%$searched%' OR article_id LIKE '%$searched%' OR content LIKE '%$searched%' OR author LIKE '%$searched%' OR date LIKE '%$searched%'" . $orderby;
$result = mysqli_query($connect, $query);
if(ISSET($_GET['searchSubmit'])){
	$search = $_GET['search'];
	$trimmed = trim($search);
	$_SESSION['search'] = $trimmed;
	header('location: searchadminart.php');
}
if(ISSET($_POST['editButton'])){
	if(ISSET($_POST['selectButton'])){
		$_SESSION['editpost'] = $_POST['selectButton'];
		header('location:editpost.php');
	} else {
		$error = 'Please select a post to edit';
	}
}
if(ISSET($_POST['hideButton'])){
	if(ISSET($_POST['selectButton'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$postid = $_POST['selectButton'];
		$query2 = "
		UPDATE `articles` SET `show` = 'no' WHERE `articles`.`article_id` = $postid;
		";
		$result2 = mysqli_query($connect, $query2);
		header('location:splashart.php');
	} else {
		$error = 'Please select a user to hide';
	}
}
if(ISSET($_POST['showButton'])){
	if(ISSET($_POST['selectButton'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$postid = $_POST['selectButton'];
		$query2 = "
		UPDATE `articles` SET `show` = 'yes' WHERE `articles`.`article_id` = $postid;
		";
		$result2 = mysqli_query($connect, $query2);
		header('location:splashart.php');
	} else {
		$error = 'Please select a user to show';
	}
}
?>
<head>

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
                            <input type="search" class="search-field" placeholder="Search for Articles" value="" name="search" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" name = "searchSubmit" class="search-submit" value="Search">
                    </form>

                    <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

                </div>  <!-- end header__search -->


                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">
					<?php
				if($_SESSION['privs'] == 4){
					?>
					<p3> <?php echo 'Welcome ' . $_SESSION['username'] . ' (Admin)'; ?></p3>
					<?php
				} else {
					?>
					<p3> <?php echo 'Welcome ' . $_SESSION['username'] . ' (Manager)'; ?></p3>
					<?php
				}
				?>
                    <h2 class="header__nav-heading h6">Site Navigation</h2>
					<ul class="header__nav">
				<?php
				if($_SESSION['privs'] == 4){
					?>
                        <li><a href="splash.php" title="">Users</a></li>
						<li><a href="splashart.php" title="">Articles</a></li>
						<li><a href="splashcat.php" title="">Categories</a></li>
						<li><a href="splashcom.php" title="">Comments</a></li>
						<?php
				}
				if($_SESSION['privs'] == 3){
					?>
					<li><a href="splashart.php" title="">Articles</a></li>
					<?php
				}
				?>
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


    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">




        <!-- comments
        ================================================== -->
        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="col-full">


                    <!-- respond
                    ================================================== -->
					<div class="respond">
						<div align="center">
						<?php
						if(ISSET($error)){
							echo $error;
						}
						?>
							<h3 class="h2">Showing Results in Articles for<?php echo " '" . $searched . "'"; ?> </h3>
<div class="table-responsive text-nowrap">
<table class="table" style="margin: 0px auto;">
    <thead>
      <tr>
	  <th></th>
	  <?php
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=article_id">Article ID</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=article_id">Article ID</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=title">Title</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=title">Title</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=content">Content</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=content">Content</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=date">Publish Date</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=date">Publish Date</a></th>';
}
if(!ISSET($_GET['sort']) or $_GET['sort'] == 1){
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=2&col=author">Author</a></th>';
} else {
echo '<th><a href = "' . $_SERVER['PHP_SELF'] . ' ?sort=1&col=author">Author</a></th>';
}
?>
<th>Picture</th>
<th>Comments</th>
<th>Category</th>
<th>Show</th>
	  </tr>
    </thead>
	<tbody>
	<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
				<?php
				while($row = mysqli_fetch_array($result)){
					?>
                <tr>
		<td><input type="radio" name="selectButton" value = <?php echo $row['article_id'] ?> /></td>
        <td><?php echo $row['article_id']?></td>
        <td><?php echo $row['title']?></td>
        <td><?php
		if(strlen($row['content'])  > 90){
			$con = substr($row['content'],0,90);
			echo $con . ' ...';
		} else {
			echo $row['content'];
		}
		?></td>
		<td><?php echo $row['date']?></td>
		<td><?php echo $row['author']?></td>
		<td><img src="<?php echo $row['picture']?>" width = '70' height = '70' alt=""></td>
		<td><?php
		$art_id = $row['article_id'];
		$query9 = "
				SELECT relations2.comment, relations2.article
				FROM relations2 WHERE article = $art_id
				";
				$result9 = mysqli_query($connect, $query9);
				while($row9 = mysqli_fetch_array($result9)){
					echo $row9['comment'] . ' ';
				}
				?>
		</td>
		<td><?php
		$art_id = $row['article_id'];
		$query10 = "
				SELECT relations.category, relations.article, category.categoryName
				FROM relations
				INNER JOIN category
				ON category.category_id = relations.category
				";
				$result10 = mysqli_query($connect, $query10);
				while($row10 = mysqli_fetch_array($result10)){
					if($row10['article'] == $art_id){
					echo $row10['categoryName'] . ' ';
				}
				}
				?>
		</td>
		<td><?php echo $row['show']?></td>
    </tr>
				<?php
				}
				?>
				</tbody>
				</table>
				</div>

</br>
</br>
<input type="submit" class="submit btn--primary btn--large" value = 'Edit Article'name = "editButton" id = 'editButton'>
<input type="submit" class="submit btn--primary btn--large" value = 'Hide Article'name = "hideButton" id = 'hideButton'>
<input type="submit" class="submit btn--primary btn--large" value = 'Show Article'name = "showButton" id = 'showButton'>
</form>
<style>
.comments-wrap {
   background-color: #e5e5e5;
}
p3{
	color:#FFFFFF;
}
th {
	color: #337AB7;
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
						</div>
                    </div> <!-- end respond -->

                </div> <!-- end col-full -->

            </div> <!-- end row comments -->
        </div> <!-- end comments-wrap -->

    </section> <!-- s-content -->
	<?php
	}
}
?>
</html>
