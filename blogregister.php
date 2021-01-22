<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
session_start();
if(ISSET($_POST['submitButton'])){
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
	$user = $_POST['user'];
	$pwd = $_POST['pwd'];
	$cpwd = $_POST['cpwd'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$msg = array();
	if(!empty($fname) && !empty($sname) && !empty($user) && !empty($pwd) && !empty($email) && !empty($dob)){
		if(!preg_match("/^[a-zA-Z ]*$/",$fname)){
			array_push($msg,'Invalid first name. Please try again');
		} 
		if(!preg_match("/^[a-zA-Z ]*$/",$sname)){
			array_push($msg,'Invalid last name. Please try again');
		}
		if(preg_match("[^\da-zA-Z]",$user)){
			array_push($msg,'Invalid username. Please try again');
		} 
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			array_push($msg,'Invalid email. Please try again');
		} 
		if($cpwd != $pwd){
			array_push($msg, 'Passwords do not match. Please try again');
		}
		if(empty($msg)){
			$same = false;
			$conn = mysqli_connect('localhost','root','','blog') or die('Bruh');
			$hashed = PASSWORD_HASH($pwd, PASSWORD_DEFAULT);
			$query = "INSERT INTO `users` (`user_id`, `fname`, `sname`, `username`, `password`, `dob`, `email`,`privs`) VALUES (NULL, '$fname', '$sname', '$user', '$hashed', '$dob', '$email',1)";
			$result = mysqli_query($conn, $query) or die('No connecto');
			while($row = mysqli_fetch_array($result)){
				$find = array_search($user, $row);
				if(!empty($find)){
					$same = true;
					$msg2 = 'That username has already been taken. Please try again';
				} else {
					$privs = $row["privs"];
				}
			}
			if($same == false){
				$result = mysqli_query($conn, $query) or die('No connecto');
				$_SESSION['username'] = $user;  
				$_SESSION["privs"] = $privs;
				header('location: index.php'); 
			} 
		} else {
			$error = true;
		}
	} else {
		$msg2 = 'Data missing! Please try again';
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
<p5>
              <?php
								if(ISSET($msg2)){
									echo $msg2;
								}
								if(ISSET($msg3)){
									echo $msg3;
								}
								if(ISSET($error)){
									             
								}
								}									?> 
</p5>								

                    <!-- respond
                    ================================================== -->
                    <div class="respond">

                        <h3 class="h2">Let's Get Started!</h3>

                        <form name="contactForm" id="contactForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <fieldset>

                                <div class="form-field">
                                        <input name="fname" type="text" id="fname" class="full-width" placeholder="First Name" value="" autocomplete = 'off'>
                                </div>

                                <div class="form-field">
                                        <input name="sname" type="text" id="sname" class="full-width" placeholder="Last Name" value="" autocomplete = 'off'>
                                </div>
								<div class="form-field">
                                        <input name="user" type="text" id="user" class="full-width" placeholder="Username" value="" autocomplete = 'off'>
                                </div>

                                <div class="form-field">
                                        <input name="pwd" type="password" id="pwd" class="full-width" placeholder="Password" value="" autocomplete = 'off'>
                                </div>
								<div class="form-field">
                                        <input name="cpwd" type="password" id="cpwd" class="full-width" placeholder="Confirm Password" value="" autocomplete = 'off'>
                                </div>
								<div class="form-field">
                                        <input name="email" type="text" id="email" class="full-width" placeholder="Email" value="" autocomplete = 'off'>
                                </div>

                                <d
								+
								v class="form-field">
                                        <input type = 'text' name = 'dob' placeholder = 'Birthdate' class="full-width"' onfocus = "(this.type='date')" onblur = "(this.type='text')" autocomplete = 'off'>
                                </div>
                                <button type="submit" class="submit btn--primary btn--large full-width" name = "submitButton">Submit</button>
									</br>
									</br>
									<a href='bloglogin.php'><input type = 'button' name = 'register' value = 'Login'></a>
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

+
    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
<style>
p5{
	color: red;
}
</style>
</body>
</html>