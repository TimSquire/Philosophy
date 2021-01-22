<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(ISSET($_POST['register'])){
	header('location: blogregister.php');
}
if(ISSET($_POST['submitButton'])){
	$pwd = $_POST['pwd'];
	$user = $_POST['user'];
	$match = false;
	if(!empty($pwd) && !empty($user)){
		$conn = mysqli_connect('localhost', 'u212525129_TimSquire', '1164Life!', 'u212525129_blog') or die('Bruh?');
		$query = "SELECT * FROM `users` WHERE `username` = '$user'";
		$result = mysqli_query($conn, $query) or die('No connecto');
			while($row = mysqli_fetch_array($result)){
				$match = true;
				if(password_verify($pwd, $row['password'])){
					$_SESSION['user_id'] = $user;
					header('location: index.php');
				} else {
					$msg = 'Incorrect Password. Please try again';
				}
			}
if($match!= true){
	$msg = "We don't recognize that username. Please try again";
}
	} else {
		$msg = 'Please answer all the fields';
	}
}
?>
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Blog Login</title>
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

</head>

<body id="top">

    <!-- pageheader
    ================================================== -->

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



                </nav> <!-- end header__nav-wrap -->

            </div> <!-- header-content -->
        </header> <!-- header -->

        <!-- comments
        ================================================== -->
        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="col-full">



                    <!-- respond
                    ================================================== -->
                    <div class="respond">

                        <h3 class="h2">Login!</h3>

                        <form name="contactForm" id="contactForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <fieldset>

                                <div class="form-field">
                                        <input name="user" type="text" id="user" class="full-width" placeholder="Username" value="" autocomplete = 'off'>
                                </div>

                                <div class="form-field">
                                        <input name="pwd" type="password" id="pwd" class="full-width" placeholder="Password" value="" autocomplete = 'off'>
                                </div>

                                <button type="submit" class="submit btn--primary btn--large full-width" name = "submitButton">Submit</button>
							<?php
							if(ISSET($msg)){
								echo $msg;
							}
							?>
							</br>
							</br>
							<a href='blogregister.php'><input type = 'button' name = 'register' value = 'Sign Up'></a>
                            </fieldset>
                        </form> <!-- end form -->

                    </div> <!-- end respond -->

                </div> <!-- end col-full -->

            </div> <!-- end row comments -->
        </div> <!-- end comments-wrap -->

    </section> <!-- s-content -->
</body>

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

</body>
</html>
