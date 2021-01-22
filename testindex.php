<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
	if(ISSET($_SESSION["privs"]) && $_SESSION["privs"] == 4){
		header('location: splash.php');
	} else {
		if(ISSET($_GET['searchSubmit'])){
			$search = $_GET['search'];
			$trimmed = trim($search);
			$_SESSION['search'] = $trimmed;
			header('location: search.php');
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
    <section class="s-pageheader s-pageheader--home">

        <header class="header">
            <div class="header__content row">

                <div class="header__logo">
                    <a class="logo" href="index.html">
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
                        <li class="current"><a href="index.html" title="">Home</a></li>
                        <li class="has-children">
                            <a href="#0" title="">Categories</a>
                            <ul class="sub-menu">
                            <li><a href="category.php">Sports</a></li>
                            <li><a href="category.php">Entertainment</a></li>
                            <li><a href="category.php">Business</a></li>
                            <li><a href="category.php">Finance</a></li>
                            <li><a href="category.php">Food</a></li>
                            <li><a href="category.php">Politics</a></li>
							<li><a href="category.php">Fashion</a></li>
                            </ul>
                        </li>
						<?php
						if(ISSET($_SESSION['privs']) && $_SESSION['privs'] == 2){
						?>
						<li><a href="create.php">My Posts</a></li>
						 <li><a href="create.php">Create Post</a></li>
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
                            <li><a href="single-video.html">Change Password</a></li>
                            <li><a href="single-audio.html">Change Username</a></li>
                            <li><a href="single-gallery.html">Delete Account</a></li>
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

    </section> <!-- end s-pageheader -->
    <!-- s-content
    ================================================== -->
	</br>
    <section class="s-content">
        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>
				<?php
				$connect = mysqli_connect("localhost", "u212525129_TimSquire", "1164Life!", "u212525129_blog");
				$query = "
				SELECT * FROM articles
				ORDER BY likes DESC
				";
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
                <article class="masonry__brick entry format-standard" data-aos="fade-up">

                    <div class="entry__thumb">
                        <a href="viewpost.php?article_id=<?php echo $row['article_id']; ?>" class="entry__thumb-link">
                            <img src="<?php echo $row['picture']?>"alt="">
                        </a>
                    </div>

                    <div class="entry__text">
                        <div class="entry__header">
                            <a href="single-standard.html"><?php echo $row['author'];?></a>
                            <div class="entry__date">
                                <a href="single-standard.html"><?php echo $row['date'] ?></a>
                            </div>
                            <h1 class="entry__title"><a href="single-standard.html"><?php echo $row['title'] ?></a></h1>

                        </div>
                        <div class="entry__excerpt">
                            <p>
                                <?php echo $row['content'] ?>
                            </p>
                        </div>
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                                <?php
								while($row2 = mysqli_fetch_array($categoryq)){
									if($row['article_id'] == $row2['article']){
									?><a href="single-standard.html"><?php echo $row2['categoryName'];?></a>
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
				?>
            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <ul>
                        <li><a class="pgn__prev" href="#0">Prev</a></li>
                        <li><a class="pgn__num" href="#0">1</a></li>
                        <li><span class="pgn__num current">2</span></li>
                        <li><a class="pgn__num" href="#0">3</a></li>
                        <li><a class="pgn__num" href="#0">4</a></li>
                        <li><a class="pgn__num" href="#0">5</a></li>
                        <li><span class="pgn__num dots">…</span></li>
                        <li><a class="pgn__num" href="#0">8</a></li>
                        <li><a class="pgn__next" href="#0">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->


    <!-- s-extra
    ================================================== -->
    <section class="s-extra">

        <div class="row top">

            <div class="col-eight md-six tab-full popular">
                <h3>Popular Posts</h3>

                <div class="block-1-2 block-m-full popular__posts">
                    <article class="col-block popular__post">
                        <a href="#0" class="popular__thumb">
                            <img src="images/thumbs/small/wheel-150.jpg" alt="">
                        </a>
                        <h5><a href="#0">Visiting Theme Parks Improves Your Health.</a></h5>
                        <section class="popular__meta">
                                <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2017-12-19">Dec 19, 2017</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="#0" class="popular__thumb">
                            <img src="images/thumbs/small/shutterbug-150.jpg" alt="">
                        </a>
                        <h5><a href="#0">Key Benefits Of Family Photography.</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2017-12-18">Dec 18, 2017</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="#0" class="popular__thumb">
                            <img src="images/thumbs/small/cookies-150.jpg" alt="">
                        </a>
                        <h5><a href="#0">Absolutely No Sugar Oatmeal Cookies.</a></h5>
                        <section class="popular__meta">
                                <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2017-12-16">Dec 16, 2017</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="#0" class="popular__thumb">
                            <img src="images/thumbs/small/beetle-150.jpg" alt="">
                        </a>
                        <h5><a href="#0">Throwback To The Good Old Days.</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2017-12-16">Dec 16, 2017</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="#0" class="popular__thumb">
                            <img src="images/thumbs/small/tulips-150.jpg" alt="">
                        </a>
                        <h5><a href="#0">10 Interesting Facts About Caffeine.</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2017-12-14">Dec 14, 2017</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="#0" class="popular__thumb">
                            <img src="images/thumbs/small/salad-150.jpg" alt="">
                        </a>
                        <h5><a href="#0">Healthy Mediterranean Salad Recipes</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="#0"> John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2017-12-12">Dec 12, 2017</time></span>
                        </section>
                    </article>
                </div> <!-- end popular_posts -->
            </div> <!-- end popular -->

            <div class="col-four md-six tab-full about">
                <h3>About Philosophy</h3>

                <p>
                Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada.
                </p>

                <ul class="about__social">
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
            </div> <!-- end about -->

        </div> <!-- end row -->

        <div class="row bottom tags-wrap">
            <div class="col-full tags">
                <h3>Tags</h3>

                <div class="tagcloud">
                    <a href="#0">Salad</a>
                    <a href="#0">Recipe</a>
                    <a href="#0">Places</a>
                    <a href="#0">Tips</a>
                    <a href="#0">Friends</a>
                    <a href="#0">Travel</a>
                    <a href="#0">Exercise</a>
                    <a href="#0">Reading</a>
                    <a href="#0">Running</a>
                    <a href="#0">Self-Help</a>
                    <a href="#0">Vacation</a>
                </div> <!-- end tagcloud -->
            </div> <!-- end tags -->
        </div> <!-- end tags-wrap -->

    </section> <!-- end s-extra -->


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


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

<div id="loginModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
   <!-- Modal content-->
           <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                     <label>Username</label>
                     <input type="text" name="username" id="username" class="form-control" />
                     <br />
                     <label>Password</label>
                     <input type="password" name="password" id="password" class="form-control" />
                     <br />
                     <button type="button" name="login_button" id="login_button" class="btn btn-primary btn-block">Login</button>
					 </br>
                </div>
           </div>
      </div>
 </div>
 <div id="signupModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
   <!-- Modal content-->
           <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Create Account</h4>
                </div>
                <div class="modal-body">
                     <label>First Name</label>
                     <input type="text" name="fname" id="fname" class="form-control" />
                     <label>Last Name</label>
                     <input type="text" name="lname" id="lname" class="form-control" />
                     <br />
					 <label>Username</label>
                     <input type="text" name="username" id="username" class="form-control" />
					 <label>Pasword</label>
                     <input type="password" name="password" id="password" class="form-control" />
                     <br />
					 <label>Confirm Password</label>
                     <input type="password" name="cpassword" id="cpassword" class="form-control" />
					 <label>Email</label>
                     <input type="email" name="email" id="email" class="form-control" />
                     <br />
					 <label>Birthdate</label>
                     <input type="date" name="dob" id="dob" class="form-control" />
                     <br />
                     <button type="button" name="signup_button" id="signup_button" class="btn btn-primary btn-block">Create Account</button>
					 </br>
                </div>
           </div>
      </div>
 </div>
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
p2{
	color: #FFFFFF;
}
</style>
</html>
<?php
	}
?>
