<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
$editpost = $_SESSION['editpost'];
if(ISSET($_POST['editor1'])){
	$editor_data = $_POST[ 'editor1' ];
}
if(ISSET($_POST['submitButton'])){
	if(!empty($editor_data) && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['pubdate']) && !empty($_POST['picture'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$author = $_POST['author'];
		$title = $_POST['title'];
		$pubdate = $_POST['pubdate'];
		$cat = $_POST['category[]'];
		$picture = $_POST['picture'];
		$query3 = "
					UPDATE `articles` SET `title` = '$title', `content` = '$editor_data', `comments` = '1', `author` = '$author', `picture` = '$picture', `date` = '$pubdate' WHERE `articles`.`article_id` = '$editpost';
					";
		$result3 = mysqli_query($connect, $query3) or die('No connecto');

		header('location: splashart.php');
	}    else {
			$error = 'Please enter changes';
		}
}
?>
	<link rel = 'stylesheet' href = 'css/bootstrap.min.css'>
<head>

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


                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">

                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <ul class="header__nav">
                        <li><a href="splash.php" title="">Users</a></li>
						<li><a href="splashart.php" title="">Articles</a></li>
						<li><a href="splashcat.php" title="">Categories</a></li>
						<li><a href="splashcom.php" title="">Comments</a></li>
						<?php
						if(ISSET($_SESSION['username'])){
							?>
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
							<div align="center">
<form name="adminForm" id="adminForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<p2>
<?php
if(ISSET($error)){
	echo $error;
}
?>
</p2>
<?php
$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
$query4 = "
SELECT * FROM articles WHERE articles.article_id = '$editpost'
";
$result4 = mysqli_query($connect, $query4);
while($row4 = mysqli_fetch_array($result4)){
?>
</br>
<label>Title:</label>
<input type = 'text' name = 'title' value = '<?php echo $row4['title']?>'>
</br>
<?php
}
?>
<label>Author:</label>
<select name = 'author'>
<?php
$query = "
SELECT users.username, users.user_id
FROM users WHERE users.privs = 2
";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){
?>
<option value = '<?php echo $row['username'] ?>' > <?php echo $row['username']; ?> </option>
<?php
}
?>
</select>
</br>
<label>Categories:</label>
</br>
<?php
$query5 = "
SELECT * FROM category
";
$result5 = mysqli_query($connect, $query5);
while($row5 = mysqli_fetch_array($result5)){
	$query6 = "
	SELECT * FROM relations WHERE relations.article = $editpost
	";
$result6 = mysqli_query($connect, $query6);
?>
<label><?php echo $row5['categoryName']?> </label>
<input type = 'checkbox' name = 'category[]' value = '<?php echo $row5['category_id']?>' <?php while($row6 = mysqli_fetch_array($result6)){if($row6['category'] == $row5['category_id']){ ?> checked = '' <?php } } ?> >
<?php
}
?>
</br>
</br>
<label>Publish Date:</label>
<?php
$query7 = "
SELECT articles.date, articles.article_id
FROM articles WHERE articles.article_id = $editpost
";
$result7 = mysqli_query($connect, $query7);
while($row7 = mysqli_fetch_array($result7)){
?>
<input type = 'date' name = 'pubdate' value = '<?php echo $row7['date']; ?>'>
<?php
}
?>
</br>
</br>
<label>Picture:</label>
<?php
$query8 = "
SELECT articles.picture, articles.article_id
FROM articles WHERE articles.article_id = $editpost
";
$result8 = mysqli_query($connect, $query8);
while($row8 = mysqli_fetch_array($result8)){
?>
<input type = 'text' name = 'picture' value = '<?php echo $row8['picture']; ?>'>
<?php
}
?>
</br>
<?php
$query2 = "
SELECT articles.article_id, articles.title, articles.content, articles.picture, articles.author, articles.date, articles.show
FROM articles
";
$result2 = mysqli_query($connect, $query2);
while($row2 = mysqli_fetch_array($result2)){
?>
<?php
if($row2['article_id'] == $editpost){
	?>
<textarea cols="80" id="editor1" name="editor1" rows="10" data-sample-short><?php echo $row2['content']; ?></textarea>
								  <script>
									CKEDITOR.replace('editor1', {
									  height: 160,
									  width: 700,
									  enterMode : CKEDITOR.ENTER_BR
									});
								  </script>
<?php
}
				}
?>
</br>
<input type = 'submit' name = 'submitButton' value = 'Submit Changes'>
</div>
</form>
</body>
<style>
p2{
	color: red;
}
</style>
</html>
						</div>
                    </div> <!-- end respond -->

                </div> <!-- end col-full -->

            </div> <!-- end row comments -->
        </div> <!-- end comments-wrap -->

    </section> <!-- s-content -->


    <!-- s-footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">
            <div class="row">

                <div class="col-two md-four mob-full s-footer__sitelinks">

                    <h4>Quick Links</h4>

                    <ul class="s-footer__linklist">
                        <li><a href="#0">Home</a></li>
                        <li><a href="#0">Blog</a></li>
                        <li><a href="#0">Styles</a></li>
                        <li><a href="#0">About</a></li>
                        <li><a href="#0">Contact</a></li>
                        <li><a href="#0">Privacy Policy</a></li>
                    </ul>

                </div> <!-- end s-footer__sitelinks -->

                <div class="col-two md-four mob-full s-footer__archives">

                    <h4>Archives</h4>

                    <ul class="s-footer__linklist">
                        <li><a href="#0">January 2018</a></li>
                        <li><a href="#0">December 2017</a></li>
                        <li><a href="#0">November 2017</a></li>
                        <li><a href="#0">October 2017</a></li>
                        <li><a href="#0">September 2017</a></li>
                        <li><a href="#0">August 2017</a></li>
                    </ul>

                </div> <!-- end s-footer__archives -->

                <div class="col-two md-four mob-full s-footer__social">

                    <h4>Social</h4>

                    <ul class="s-footer__linklist">
                        <li><a href="#0">Facebook</a></li>
                        <li><a href="#0">Instagram</a></li>
                        <li><a href="#0">Twitter</a></li>
                        <li><a href="#0">Pinterest</a></li>
                        <li><a href="#0">Google+</a></li>
                        <li><a href="#0">LinkedIn</a></li>
                    </ul>

                </div> <!-- end s-footer__social -->

                <div class="col-five md-full end s-footer__subscribe">

                    <h4>Our Newsletter</h4>

                    <p>Sit vel delectus amet officiis repudiandae est voluptatem. Tempora maxime provident nisi et fuga et enim exercitationem ipsam. Culpa consequatur occaecati.</p>

                    <div class="subscribe-form">
                        <form id="mc-form" class="group" novalidate="true">

                            <input type="email" value="" name="EMAIL" class="email" id="mc-email" placeholder="Email Address" required="">

                            <input type="submit" name="subscribe" value="Send">

                            <label for="mc-email" class="subscribe-message"></label>

                        </form>
                    </div>

                </div> <!-- end s-footer__subscribe -->

            </div>
        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">
                <div class="col-full">
                    <div class="s-footer__copyright">
                        <span>© Copyright Philosophy 2018</span>
                        <span>Site Template by <a href="https://colorlib.com/">Colorlib</a></span>
                    </div>

                    <div class="go-top">
                        <a class="smoothscroll" title="Back to Top" href="#top"></a>
                    </div>
                </div>
            </div>
        </div> <!-- end s-footer__bottom -->

    </footer> <!-- end s-footer -->


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

</html>
