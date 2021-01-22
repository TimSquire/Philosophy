<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
if(!ISSET($_SESSION['username'])) {
	echo "<script> alert('Login to view full posts!');window.location='index.php' </script>";
}
if(ISSET($_GET['searchSubmit'])){
	$search = $_GET['search'];
	$trimmed = trim($search);
	$_SESSION['search'] = $trimmed;
	header('location: search.php');
}
if(ISSET($_GET['article_id'])){
	$article_id = $_GET['article_id'];
	$_SESSION['article_id'] = $article_id;
} else {
	$article_id = $_SESSION['article_id'];
}
if(ISSET($_POST['cSubmit'])) {
	if(ISSET($_POST['cMessage'])){
		$author = $_SESSION['username'];
		$content = $_POST["cMessage"];
		$ac = "INSERT INTO comments (`author`,`content`,`show`) VALUES ('$author', '".mysqli_real_escape_string($connect,$content)."','yes')";
		$add = mysqli_query($connect, $ac);
		$comnum = "SELECT `comments_id` FROM `comments`
				   ORDER BY `comments_id` DESC";
		$grab = mysqli_query($connect, $comnum) or die('No connecto');
		$arr = mysqli_fetch_array($grab);
		$latest = $arr[0];
		$link = "INSERT INTO relations2 (`article`, `comment`) VALUES ('$article_id', '$latest')";
		$createlink =  mysqli_query($connect, $link) or die('No connecto');
		$url = 'viewpost.php?article_id=' . $article_id;
		header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
        exit();
	}
} else{
	$query = "SELECT * FROM articles WHERE articles.article_id = $article_id";
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
	$artid = $row['article_id'];
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

        <article class="row format-standard">

            <div class="s-content__header col-full">
			</br>
                <h1 class="s-content__header-title">
                    <?php echo $row['title']; ?>
                </h1>
				By: <a href="userposts.php?user=<?php echo $row['author']; ?>"><?php echo $row['author'];?></a>
                <ul class="s-content__header-meta">
                    
                    <?php
							$db = $row['date'];
							$timestamp = strtotime($db);
							?>
                                <?php echo date("F j, Y @ g A", $timestamp); ?>
                    
                    <li class="cat">
                        In
						<?php
						$catquery = "SELECT relations.article, relations.category, category.category_id, category.categoryName
						FROM relations
						INNER JOIN category
						ON relations.category = category.category_id
						";
						$catresult = mysqli_query($connect, $catquery);
						while($catrow = mysqli_fetch_array($catresult)){
							if($catrow['article'] == $article_id){
					?>
                        <a href="category.php?category=<?php echo $catrow['category']?>" > <?php echo $catrow['categoryName']; ?> </a>
						<?php
				}
						}
				?>
                    </li>
                </ul>
            </div> <!-- end s-content__header -->

            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <img src="<?php echo $row['picture'] ?>"
                         width = "400" height = 'auto' style = "float:left" alt="">
					<p> <?php echo $row['content']; ?> </p>
                </div>
            </div> <!-- end s-content__media -->

        </article>


        <!-- comments
        ================================================== -->
        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="col-full">

                    <!-- commentlist -->
                    <ol class="commentlist">
					<h3>Comments</h3>
					<?php
$query2 = "SELECT relations2.article, relations2.comment, comments.author, comments.content, comments.date, comments.show
		FROM relations2
		INNER JOIN comments
		ON relations2.comment = comments.comments_id
";
$result2 = mysqli_query($connect, $query2);
$exists = false;
while($row2 = mysqli_fetch_array($result2)){
	if($row2['article'] == $article_id && $row2['show'] == 'yes'){
	$exists = true;
?>
                        <li class="depth-1 comment">

                            <div class="comment__content">

                                <div class="comment__info">
                                    <cite><a href="userposts.php?user=<?php echo $row2['author']; ?>"><?php echo $row2['author'];?></a></cite>

                                    <div class="comment__meta">
                                        <time class="comment__time"> <?php
										$db = $row2['date'];
										$timestamp = strtotime($db);
										?>
										<?php echo date("F j, Y @ g A", $timestamp); ?></time>
                                    </div>
                                </div>

                                <div class="comment__text">
                                <?php echo $row2['content']; ?>
                                </div>

                            </div>

                        </li> <!-- end comment level 1 -->
<?php
	}
}
if($exists == false){
	?>
	<p>No comments exist. Be the first to comment below!</p>
	<?php
}
?>

                                        </li>

                                    </ul>

                                </li>

                            </ul>

                        </li> <!-- end comment level 1 -->

                    </ol> <!-- end commentlist -->


                    <!-- respond
                    ================================================== -->
                    <div class="respond" accept-charset="UTF-8">

                        <h3 class="h2">Add Comment</h3>

                        <form name="contactForm" id="contactForm" method="post" accept-charset="UTF-8" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <fieldset>

                                <div class="message form-field" accept-charset="UTF-8">
                                    <textarea name="cMessage" id="cMessage" class="full-width" accept-charset="UTF-8" placeholder="Your Message"></textarea>
                                </div>
                                <button type="submit" name = "cSubmit" class="submit btn--primary btn--large full-width">Add Comment</button>

                            </fieldset>
                        </form> <!-- end form -->

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
 $(document).ready(function(){
      $('#login_button').click(function(){
           var username = $('#username').val();
           var password = $('#password').val();
           if(username != '' && password != '')
           {
                $.ajax({
                     url:"action.php",
                     method:"POST",
                     data: {username:username, password:password},
                     success:function(data)
                     {
                          //alert(data);
                          if(data == 'No')
                          {
                               alert("Wrong Data");

                          }
                          else
                          {
                               $('#loginModal').hide();
                               location.reload();
                          }
                     }
                });
           }
           else
           {
                alert("Both Fields are required");
           }
      });
      $('#logout').click(function(){
           var action = "logout";
           $.ajax({
                url:"action.php",
                method:"POST",
                data:{action:action},
                success:function()
                {
                     location.reload();
                }
           });
      });
 });
 </script>
</body>
<style>
div{text-align: center;}
<?php
require_once('like.php');
?>
img{
	padding-right: 20px;
}
.s-content__media {
	margin-top: 0.8rem;
}
p2{
	color: #FFFFFF;
}
p4{
	color: #ff1a1a;
}
</style>
</html>
<?php
}
}
?>
