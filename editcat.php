<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
	if(!ISSET($_SESSION['privs'])){
	header('location: index.php');
} else {
if($_SESSION['privs'] != 4){
	header('location: index.php');
} else {
	if(!ISSET($_SESSION['editcat'])){
		header('location: splashcat.php');
	} else {
$editcat = $_SESSION['editcat'];
if(ISSET($_POST['submitButton'])){
	if(!empty($_POST['catname']) && !empty($_POST['editor1'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$catname = $_POST['catname'];
		$editor = $_POST['editor1'];
		$query3 = "
					UPDATE `category` SET `categoryName` = '$catname', `categoryDescription` = '$editor' WHERE `category`.`category_id` = $editcat;
					";
		$result3 = mysqli_query($connect, $query3) or die('No connecto');
		header('location: splashcat.php');
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
<?php
if(ISSET($error)){
	echo $error;
}
$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
				$query2 = "
				SELECT category.category_id, category.categoryName, categoryDescription
				FROM category WHERE category.category_id = $editcat
				";
				$result2 = mysqli_query($connect, $query2);
				while($row2 = mysqli_fetch_array($result2)){
				?>
<label>Category Name:</label>
<input type = 'text' name = 'catname' value = '<?php echo $row2['categoryName'] ?>'>
</br>
<label>Category Description:</label>
<textarea cols="80" id="editor1" name="editor1" rows="10" data-sample-short> <?php echo $row2['categoryDescription'] ?> </textarea>
<script>
CKEDITOR.replace('editor1', {
  height: 160,
  width: 700,
  enterMode : CKEDITOR.ENTER_BR
});
</script>
<?php
}
?>
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
<?php
	}
}
}
?>
</html>
