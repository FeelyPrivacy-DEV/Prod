<?php

    error_reporting(0);
    // session_start();
    require './vendor/autoload.php';
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;

    $auth_msg = ''; 
    
    if($_GET['auth'] == 'failed') {
        $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                        <strong>Wrong Credentials !</strong> Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    else if($_GET['login'] == 'wait') {
        $auth_msg = '<div class="alert alert-success alert-dismissible fade show " role="alert">
                        <strong>Your account created </strong> and under review ! Please check email.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }

    

?>



<!doctype html>
<html lang="en">

<head>
    <?php include './assest/top_links.php'; ?>
    <title>Feely | Reset</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class='navbar-brand text-light mx-4' href='https://test.feelyprivacy.com/s/'>
                <img src="https://test.feelyprivacy.com/s/public/image/logo.png" height="60" alt="" srcset="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://test.feelyprivacy.com/s/index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://test.feelyprivacy.com/s/index">Doctor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://test.feelyprivacy.com/s/p">Patient</a>
                    </li>
                </ul>
                <a href="https://test.feelyprivacy.com/s/index" class='btn btn-outline-primary text-primary px-3 py-2 mx-5'>LOGIN
                    /
                    SIGNUP</a> -->
            </div>
        </div>
    </nav>

    <?php echo $auth_msg; ?>


    <?php
        $token = $_GET['token'];
        $t = $_GET['t'];
        $collection = $db->employee;
        $record = $collection->findOne(['gen_info.reset_token.token'=> $token]);
        $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        $time = $date->format('H:i');

        $start = strtotime($t);
        $end = strtotime($time);
        $minutes = ($end - $start) / 60;

        if($minutes > 6) {
            $collection->updateOne(
                ['_id'=> $record['_id']],
                ['$set'=>['gen_info.reset_token'=>['token'=>'null', 'time'=>'null']]]
            );
            echo '<div class="container my-5">
                    <div class="d-flex justify-content-center">
                        <div class="reset_form border boder-dark rounded p-5">
                            <h4 class="text-center text-primary my-5">Your token has expired.</h4>
                        </div>
                    </div>
                </div>';
            
        }
        else {
            echo '<div class="container my-5">
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-center text-nowrap" id="for_warn_pat"></h6>
                            <h6 class="text-center text-nowrap my-5" id="load_pat"></h6>
                        </div>
                        <div class="reset_form border boder-dark rounded p-5">
                            <h5 class="">Change Password</h5>
                            <div class="form-group my-4 ">
                                <input type="text" id="pat_token" hidden value="'.$token.'">
                                <input type="password" class="form-control p-2" name="" placeholder="New Password" id="newpass">
                            </div>
                            <div class="form-group my-4 ">
            
                                <input type="password" class="form-control p-2" name="" placeholder="Confirm New Password"
                                    id="confpass">
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-bg py-2 my-3" id="change_pass_pat">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>';
        }


    
    ?>
    



    <?php include './assest/bottom_links.php'; ?>
    <script src='https://test.feelyprivacy.com/s/controller/js/index.js?ver=1.7'></script>

</body>

</html>