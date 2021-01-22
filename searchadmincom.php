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
if(!ISSET($_GET['sort']) && !ISSET($_GET["col"])){
$orderby = " ORDER BY comments_id DESC";
} elseif($_GET['sort'] == 1){
$orderby = " ORDER BY ".$_GET["col"]." DESC";
} else {
$orderby = " ORDER BY ".$_GET["col"]." ASC";
}
$searched = $_SESSION['search'];
$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
$query = "SELECT * FROM comments WHERE author LIKE '%$searched%' OR comments_id LIKE '%$searched%' OR content LIKE '%$searched%' OR date LIKE '%$searched%'" . $orderby;
$result = mysqli_query($connect, $query);
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
							<h3 class="h2">Showing Results in Comments for<?php echo " '" . $searched . "'"; ?> </h3>
<div class="table-responsive text-nowrap">
<table class="table" style="margin: 0px auto;">
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
		?>
		<th>Affiliated Post</th>
		<th>Show</th>
      </tr>
    </thead>
	<tbody>
	<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
				<?php
				while($row = mysqli_fetch_array($result)){
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
		<td>
		<?php
		$com = $row['comments_id'];
		$getart = "SELECT article FROM relations2 WHERE comment = $com";
		$artresult = mysqli_query($connect, $getart);
		$art = mysqli_fetch_array($artresult);
		echo $art['article'];
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
<input type="submit" class="submit btn--primary btn--large" value = 'Edit Comment'name = "editButton" id = 'editButton'>
<input type="submit" class="submit btn--primary btn--large" value = 'Hide Comment'name = "hideButton" id = 'hideButton'>
<input type="submit" class="submit btn--primary btn--large" value = 'Show Comment'name = "showButton" id = 'showButton'>
</form>
<style>
.comments-wrap {
   background-color: #e5e5e5;
}
th {
	color: #337AB7;
}
p3{
	color: #FFFFFF;
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
