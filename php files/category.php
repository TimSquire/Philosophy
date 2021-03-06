<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(ISSET($_GET['searchSubmit'])){
			$search = $_GET['search'];
			$trimmed = trim($search);
			$_SESSION['search'] = $trimmed;
			header('location: search.php');
		}
if(!ISSET($_GET['category'])){
	header('location: index.php');
} else {
$cat = $_GET['category'];
$connect = mysqli_connect("localhost", "root", "", "blog");  
$query = "SELECT * FROM relations WHERE category LIKE '%$cat%'
					ORDER BY relations_id DESC
";
$result = mysqli_query($connect, $query); 
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
                        </li>
						
						<?php
						if(ISSET($_SESSION['username'])){
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
							<?php
						} else {
							?>
						<li><a class ="login-button" data-toggle="modal" data-target="#loginModal" href="http://www.google.ca">Login</a></li>
						<li><a class ="signup-button" data-toggle="modal" data-target="#signupModal" href="http://www.google.ca">Create Account</a></li>
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
						<h3 class="h2">
						<?php 
						$echo = "SELECT * FROM category WHERE category_id LIKE '%$cat%'";
						$gett = mysqli_query($connect, $echo);
						$yeet = mysqli_fetch_array($gett);
						echo $yeet['categoryName'];
						?> 
						</h3> 
						<p><?php echo $yeet['categoryDescription']; ?></p>
							<div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>
				<?php
				if(mysqli_num_rows($result) <= 0){
				?> <h4>No Results</h4>
				<?php
				} else {
				while($catshow = mysqli_fetch_array($result)){
					$art = $catshow['article'];
					$query = "SELECT * FROM articles WHERE article_id = $art
					";
					$artresult = mysqli_query($connect, $query); 
					while($row = mysqli_fetch_array($artresult)){
						if($row['show'] == 'yes'){
						$catq = "  
				SELECT relations.article, relations.category, articles.article_id, category.categoryName
				FROM articles
				INNER JOIN relations
				ON articles.article_id = relations.article   
				INNER JOIN category
				ON relations.category = category.category_id				
				";
				$categoryq = mysqli_query($connect, $catq);
					?>
                <article class="masonry__brick entry format-standard" data-aos="fade-up">
                      <form method = "GET" action = "$_SERVER['PHP_SELF']">  
                    <div class="entry__thumb">
                        <a href="viewpost.php?article_id=<?php echo $row['article_id']; ?>" class="entry__thumb-link">
                            <img src="<?php echo $row['picture']?>"alt="">
                        </a>
                    </div>
    
                    <div class="entry__text">
                        <div class="entry__header">
                            <a href="userposts.php?user=<?php echo $row['author']; ?>"><?php echo $row['author'];?></a>
                            <div class="entry__date">
							<?php
							$db = $row['date'];
							$timestamp = strtotime($db);
							?>
                            <?php echo date("F j, Y @ g A", $timestamp); ?>
                            </div>
                            <h1 class="entry__title"><a href="viewpost.php?article_id=<?php echo $row['article_id']; ?>"><?php echo $row['title'] ?></a></h1>
                            
                        </div>
                        <div class="entry__excerpt">
                            <p>
                                <?php 
								if(strlen($row['content'])  > 90){
								$con = substr($row['content'],0,90);
								echo $con . '...'?> <a href="viewpost.php?article_id=<?php echo $row['article_id']; ?>">Read More</a><?php ; 
								} else {
									echo $row['content'];
								}
								?>
                            </p>
                        </div>
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                                <?php
								while($row2 = mysqli_fetch_array($categoryq)){
									if($row['article_id'] == $row2['article']){
									?><a href="category.php?category=<?php echo $row2['category'] ?>"><?php echo $row2['categoryName'];?></a>
									<?php
									}
								}
								?>
                            </span>
                        </div>
                    </div>
                </article> <!-- end article -->
				<?php
							}
						}
					}
				}
				?>
            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->
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
p2 {
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
</body>
<?php
}
?>
</html>