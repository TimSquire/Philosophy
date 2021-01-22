<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(!ISSET($_SESSION['privs'])){
	header('location: index.php');
} else {
if($_SESSION['privs'] == 1){
	header('location: index.php');
} else {
if(!ISSET($_SESSION['editpost'])){
	header('location: splashart.php');
} else {
$editpost = $_SESSION['editpost'];
if(ISSET($_POST['editor1'])){
	$editor_data = $_POST[ 'editor1' ];
}
if(ISSET($_POST['submitButton'])){
	if(!empty($editor_data) && !empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['pubdate']) && !empty($_FILES['picture']['name'])){
		$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
		$author = $_POST['author'];
		$title = $_POST['title'];
		$pubdate = $_POST['pubdate'];
		$cat = $_POST['category'];
		$picture = $_FILES['picture']['name'];
		$uploaddir = 'images-folder/';
        $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);
		$query3 = "
					UPDATE `articles` SET `title` = '$title', `content` = '$editor_data', `author` = '$author', `picture` = '$uploadfile', `date` = '$pubdate' WHERE `articles`.`article_id` = '$editpost';
					";
		$result3 = mysqli_query($connect, $query3) or die('No connecto bro');
		$delquery = "DELETE FROM `relations` WHERE `relations`.`article` = $editpost";
		$delresult = mysqli_query($connect, $delquery) or die('No connecto dawg');
		foreach($_POST['category'] as $cat){
			$catquery = "INSERT INTO `relations` (`article`, `category`) VALUES ('$editpost','$cat')";
			$catresult = mysqli_query($connect, $catquery) or die('No connecto');
		}
		if($_SESSION['privs'] != 2){
		header('location: splashart.php');
		} else {
		header('location: myposts.php');
		}
	}    else {
			$error = 'Please fill out all fields!';
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
				<?php
				if($_SESSION['privs'] == 4 or $_SESSION['privs'] == 3){
				?>
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
				<?php
				}
				?>

                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">
				<?php
				if($_SESSION['privs'] == 4){
					?>
					<p3> <?php echo 'Welcome ' . $_SESSION['username'] . ' (Admin)'; ?></p3>
					<?php
				}  if($_SESSION['privs'] == 3){
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
				if($_SESSION['privs'] == 4 or $_SESSION['privs'] == 3){
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
				}
				?>
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
<form name="adminForm" id="adminForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
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
if($_SESSION['privs'] > 2){
?>
<label>Author:</label>
<select name = 'author' value = 'choose'>
<?php
$firstquery = "
SELECT articles.author
FROM articles WHERE articles.article_id = $editpost
";
$firstresult = mysqli_query($connect, $firstquery);
$first = mysqli_fetch_array($firstresult);
?>
<option value = '<?php echo $first['author'] ?>' > <?php echo $first['author'] ?> </option>
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
<?php
} else {
?>
<label>Author:</label>
<select name = 'author' value = 'choose'>
<option value = '<?php echo $_SESSION['username'];?>'><?php echo $_SESSION['username'];?></option>
</select>
<?php
}
?>
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
<label>Publish Date:</label>
<?php
$query7 = "
SELECT articles.date, articles.article_id
FROM articles WHERE articles.article_id = $editpost
";
$result7 = mysqli_query($connect, $query7);
while($row7 = mysqli_fetch_array($result7)){
?>
<input type = 'datetime-local' name = 'pubdate' value="<?php echo date("Y-m-d\TH:i:s",  strtotime(str_replace('-','/', $row7['date']))); ?>">
<?php
}
?>
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
<div class="drop-zone">
    <span class="drop-zone__prompt">Drop image here or click to upload</span>
    <input type="file" class="drop-zone__input" display="none" name="picture" id="picture" value = '<?php echo $row8['picture']; ?>'>
</div>

<script src="main.js"></script>
</br>

<script src="./src/main.js"></script>
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
