<?php

    error_reporting(0);
    session_start();
    require './vendor/autoload.php';
    $con = new MongoDB\Client( 'mongodb://test.com:27017' );
    $db = $con->php_mongo;
    $auth_msg = ''; 
    
    if($_GET['auth'] == 'failed') {
        $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                        <strong>Wrong Credentials !</strong> Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    else if($_GET['login'] == 'now') {
        $auth_msg = '<div class="alert alert-success alert-dismissible fade show " role="alert">
                        <strong>Your account created successfully !</strong> Login Now !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    if($_GET['auth'] == 'disable') {
        $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                        <strong>Your Account is not verified yet !</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    else if($_GET['login'] == 'disable') {
        $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                        <strong>Your account has been disbaled by admin !</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    else if($_GET['c'] == 'e') {
        $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                        <strong>Pleace verify captcha f**king bi**h !</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }

?>


<!doctype html>
<html lang="en">

<head>
    <?php include './assest/top_links.php'; ?>
    <title>Feely | Register</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class='navbar-brand text-light mx-4' href='http://143.110.176.130/s/'>
                <img src="http://143.110.176.130/s/public/image/logo.png" height="60" alt="" srcset="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://143.110.176.130/s/index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://143.110.176.130/s/d">Doctor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://143.110.176.130/s/p">Patient</a>
                    </li>
                </ul>
                <a href="http://143.110.176.130/s/d" class='btn btn-outline-primary text-primary px-3 py-2 mx-5'>LOGIN
                    /
                    SIGNUP</a>
            </div>
        </div>
    </nav>

    <?php echo $auth_msg; ?>


    <div class="container  my-5">
        <div class="reg_cont d-flex justify-content-center">
            <div class="img my-auto mx-4">
                <img src="http://143.110.176.130/s/public/image/login-banner.png" height="300" alt="" srcset="">
            </div>
            <div class="forms mx-4">
                <div class="reg" id="docreg">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Doctor Register</h5>
                        <a href="http://143.110.176.130/s/p">Not a Doctor ?</a>
                    </div>
                    <form class="container needs-validation" action="http://143.110.176.130/s/controller/php/signup.php" method="POST">
                        <div class="d-flex justify-content-between">
                            <div class="mb-3 mx-1">
                                <!-- <label for="email" class="form-label">First Name</label> -->
                                <input type="text" class="form-control py-2" name="fname" id="fname" placeholder="First Name" required>
                            </div>
                            <div class="mb-4 mx-1">
                                <!-- <label for="email" class="form-label">Last Name</label> -->
                                <input type="text" class="form-control py-2" name="sname" id="sname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <!-- <label for="email" class="form-label">Email Address</label> -->
                            <input type="email" class="form-control py-2" name="email" id="msemail" aria-describedby="email" placeholder="Email Address" required> 
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-4">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" class="form-control py-2" name="pass" id="mspas" placeholder="Create Password " required
                                aria-describedby="password">
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="h-captcha" data-sitekey="8840d1d7-bfeb-4979-b86b-5223d5ad79f9" required></div>
                        </div>
                        <button class="btn m-0 p-0 fw-bold text-primary al-r" type="button">Login ?</button>
                        <div class="d-grid gap-2 my-3">
                            <button type="submit" class="btn btn-primary py-2" name="manager_signup">Create
                                Account</button>
                        </div>
                    </form>
                    <p class="text-center">or</p>
                    <div class="d-flex justify-content-around">
                        <button class="btn btn-sm px-5 btn-danger" disabled>Google</button>
                        <button class="btn btn-sm px-5 btn-primary" disabled>Facebook</button>
                    </div>
                </div> 
                <div class="log" id="doclog">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Doctor Login</h5>
                        <a href="http://143.110.176.130/s/p">Not a Doctor ?</a>
                    </div>
                    <form class="container e_log_form" action="http://143.110.176.130/s/controller/php/login.php"
                        method="POST">
                        <div class="mb-4">
                            <!-- <label for="email" class="form-label">Email Address</label> -->
                            <input type="email" name="email" class="form-control py-3" id="log_empid" placeholder="Email Address" required
                                aria-describedby="empid">
                        </div>
                        <div class="mb-4">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" name="pass" class="form-control py-3" id="log_pass" placeholder="Enter Password" required
                                aria-describedby="password">
                        </div>
                        <button class="btn m-0 fw-bold p-0 text-primary al-r" type="button" >Create Account ?</button>
                        <div class="d-grid gap-2 my-5">
                            <button type="submit" class="btn btn-primary py-2" name="manager_login">Get Innn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php include './assest/bottom_links.php'; ?>
    <script src='http://143.110.176.130/s/controller/js/index.js?ver=1.3'></script>
</body>

</html>