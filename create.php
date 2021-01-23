<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(!ISSET($_SESSION['privs'])){
	header('location: index.php');
} else {
	if($_SESSION['privs'] != 2){
		header('location: index.php');
	} else {
		if(ISSET($_GET['searchSubmit'])){
			$search = $_GET['search'];
			$trimmed = trim($search);
			$_SESSION['search'] = $trimmed;
			header('location: search.php');
		}
		if(ISSET($_POST['postButton'])){
			if(!empty($_POST['title'])){
				if(!empty($_FILES['picture']['name'])){
					if(!empty($_POST['category'])){
						$editor_data = $_POST[ 'editor1' ];
						$title = $_POST['title'];
						$pic = $_POST['picture'];
						$user = $_SESSION['username'];
						if(!empty($editor_data) && !empty($title)){
							$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
							// SDK initialization

							use ImageKit\ImageKit;

							$imageKit = new ImageKit(
								"public_qZVn/JImHpBKHdt9c0TubPs17So=",
								"private_CBY1gdrOjM73drra3OjBoP//Als=",
								"https://ik.imagekit.io/5y8e1hvsx6a"
							);
							$title = $_POST['title'];
							$cat = $_POST['category'];
							$picture = $_FILES['picture']['name'];
							imagejpeg($picture, NULL, 50);
							$uploaddir = 'images-folder/';
							$uploadfile = $uploaddir . basename($_FILES['picture']['name']);
							$new_link = $imageKit->url(array(
								"path" => "/" . basename($_FILES['picture']['name']),
								"transformation" => array(
									array(
										"width" => "320",
									)
								)
							));
							move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);
							$query3 = "INSERT INTO `articles` (`article_id`, `title`, `content`,`date`, `likes`, `picture`, `author`, `show`) VALUES (NULL, '$title', '$editor_data', CURRENT_TIMESTAMP, '0', '$new_link', '$user', 'yes')";
							$result3 = mysqli_query($connect, $query3) or die('No connecto bro');
							$articlenum = "SELECT `article_id` FROM `articles`
										   ORDER BY `article_id` DESC";
							$result2 = mysqli_query($connect, $articlenum) or die('No connecto');
							$num = mysqli_fetch_array($result2);
							$zero = $num[0];
							foreach($_POST['category'] as $cat){
							$query2 = "INSERT INTO `relations` (`article`, `category`) VALUES ('$zero','$cat')";
							$result3 = mysqli_query($connect, $query2) or die('No connecto');
							}
							header('location: index.php');
						} else {
							echo "<script> alert('Please answer all the fields!');window.location='create.php' </script>";
						}
					} else {
						echo "<script> alert('Please select at least one category');window.location='create.php' </script>";
					}
				} else {
					echo "<script> alert('Please upload a photo');window.location='create.php' </script>";
				}
			} else {
				echo "<script> alert('Please enter a title for your post');window.location='create.php' </script>";
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

                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <ul class="header__nav">
					<?php
					if(ISSET($_SESSION['username'])){
						?>
						 <div align = 'middle'><p2><?php echo 'Welcome ' . $_SESSION['username'] ?></p2></div>
						 <?php
					}
					?>
                        <li><a href="index.php" title="">Home</a></li>
                        <li class="has-children">
                            <a href="#0" title="">Categories</a>
                            <ul class="sub-menu">
                            <li><a href="category.php?category=1">Sports</a></li>
                            <li><a href="category.php?category=2">Business</a></li>
                            <li><a href="category.php?category=3">Finance</a></li>
                            <li><a href="category.php?category=4">Entertainment</a></li>
                            <li><a href="category.php?category=6">Food</a></li>
                            <li><a href="category.php?category=9">Fashion</a></li>
							<li><a href="category.php?category=8">Politics</a></li>
							<li><a href="category.php?category=10">Humor</a></li>
                            </ul>
                        </li>
						<?php
						if(ISSET($_SESSION['privs']) && $_SESSION['privs'] == 2){
						?>
						 <li><a href="create.php">Create Post</a></li>
						 <li><a href="myposts.php">My Posts</a></li>
						<?php
						}
						?>
						<?php
						if(ISSET($_SESSION['username'])){
							?>
							<li class="has-children">
                            <a href="#0" title="">My Account</a>
                            <ul class="sub-menu">
                            <li><a class ="editpass-button" data-toggle="modal" data-target="#editpassModal" href="http://www.google.ca">Change Password</a></li>
                            <li><a class ="edituser-button" data-toggle="modal" data-target="#edituserModal" href="http://www.google.ca">Change Username</a></li>
                            <li><a class ="del-button" data-toggle="modal" data-target="#delModal" href="http://www.google.ca">Delete Account</a></li>
							<?php
						if(ISSET($_SESSION['privs']) && $_SESSION['privs'] == 1){
						?>
						<li><a class ="auth-button" data-toggle="modal" data-target="#authModal" href="http://www.google.ca">Become an Author</a></li>
						<?php
						}
						?>
						</ul>
						</li>
							<li><a href="bloglogout.php" title="">Logout</a></li>
							<?php
						} else {
							?>
						<li><a class ="login-button" data-toggle="modal" data-target="#loginModal" href="http://www.google.ca">Login</a></li>
						<?php
						}
						?>
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
							<h3 class="h2">Create a Post</h3>
							<form name="adminForm" id="adminForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
							<div class="form-field">
                                        <input name="title" type="text" id="tile" class="full-width" placeholder="Enter the title of your post here..." value="" autocomplete = 'off'>
                                </div>
								<div class="drop-zone">
									<span class="drop-zone__prompt">Drop image here or click to upload</span>
									<input type="file" class="drop-zone__input" display="none" name="picture" id="picture">
								</div>
								<script src="main.js"></script>
								<script src="./src/main.js"></script>
								</br>
								<textarea cols="80" id="editor1" name="editor1" rows="10" data-sample-short></textarea>
								  <script>
									CKEDITOR.replace('editor1', {
									  height: 260,
									  width: 700,
									  enterMode : CKEDITOR.ENTER_BR
									});
								  </script>
							  </br>
							  <h4>Select One or More Categories</h4>
							  </br>
							  <?php
							  $conn = mysqli_connect('localhost', 'u212525129_TimSquire', '1164Life!', 'u212525129_blog') or die('Bruh?');
							  $query2 = "
							SELECT category.category_id, category.categoryName
							FROM category
							";
							$result2 = mysqli_query($conn, $query2);
							while($row2 = mysqli_fetch_array($result2)){
							?>
							  <label><?php echo $row2['categoryName'] ?></label>
							  <input type='checkbox' name = 'category[]' value = ' <?php echo $row2['category_id'] ?>' >
							  <?php
							}
							?>
							  </br>
							  </br>
							  <button type="submit" class="submit btn--primary btn--large full-width" name = "postButton">Submit Post</button>
							</form> <!-- end form -->
						</div>
                    </div> <!-- end respond -->

                </div> <!-- end col-full -->

            </div> <!-- end row comments -->
        </div> <!-- end comments-wrap -->

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
p2{
	color:#FFFFFF;
}
</style>
    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
	<script src="likejs.js"></script>
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
.drop-zone {
max-width: 200px;
height: 200px;
padding: 25px;
display: flex;
align-items: center;
justify-content: center;
text-align: center;
font-family: "Quicksand", sans-serif;
font-weight: 500;
font-size: 20px;
cursor: pointer;
color: #1c3b91;
border: 4px dashed #1c3b91;
border-radius: 10px;
}

.drop-zone--over {
border-style: solid;
}

.drop-zone__input {
display: none !important;
}

.drop-zone__thumb {
width: 100%;
height: 100%;
border-radius: 10px;
overflow: hidden;
background-color: #cccccc;
background-size: cover;
position: relative;
}

.drop-zone__thumb::after {
content: attr(data-label);
position: absolute;
bottom: 0;
left: 0;
width: 100%;
padding: 5px 0;
color: #ffffff;
background: rgba(0, 0, 0, 0.75);
font-size: 14px;
text-align: center;
}
p3{
	color: #FFFFFF;
}
</style>
</html>
<?php
	}
}
?>
