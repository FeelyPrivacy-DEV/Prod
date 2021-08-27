<?php
    use MongoDB\Operation\Find;
    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['eid'] == '') {
        header('location: http://test.feelyprivacy.com/s/index');
    }

    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;

 
    $msg = '';

    if($_GET['e'] == 'sametm') {
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Not available !</strong> Because this scheduled is already booked by <strong> manager.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['e'] == 'samete') {
        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Not available !</strong> Because this scheduled is already booked by other <strong> emplpoyee.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['time'] == 'equal') {
        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>You already booked this time schedueld !</strong> Please select another one.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['time'] == 'add' || $_GET['date'] == 'add') {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Your meeting scheduled has been saved !</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['time'] == 'addm' || $_GET['date'] == 'addm') {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Your meeting has been scheduled with Manager !</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }


    $d = date( 'Y-m-d' );
    $ass = $_GET['id'];
    $collection = $db->manager;
    $record = $collection->findOne( ["d_unid" => $ass] );
?>




<!doctype html>
<html lang="en">

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://test.feelyprivacy.com/s/public/stylesheet/p-booking.css?ver=1.4">
    <title>Patient | Booking</title>
</head>

<body>
    <?php include_once '../../assest/navbar.php'; ?>

    <!-- breadcrumb -->
    <nav class='breadc navbar-expand-lg'>
        <div class='container-fluid'>
            <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                <p class=" my-auto py-1">Home / Booking</p>
                <h5 class="my-auto py-1">Booking</h5>
            </div>
        </div>
    </nav>


    <!-- main content -->
    <div class="m-2 row my-5">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 ">
            <div class="">
                <?php 
                    $collection = $db->employee;
                    $erecord = $collection->findOne( ['_id' =>$_SESSION['eid']] );
                ?>
                <div class="d-flex justify-content-center mb-4">
                    <img src="http://test.feelyprivacy.com/s/public/image/pat-img/default_user.png" height="150"
                        class="rounded-circle" alt="">
                </div>
                <h4 class="text-center"><a href="#"><?php echo $erecord['fname'].' '.$erecord['sname']; ?></a></h4>
                <p class="text-center">24 Jul 1983, 38 years</p>
                <p class="text-center"> Newyork, USA</p>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-outline-primary sidebtn fw-bold px-4 my-3"><i class="bi bi-list"></i></button>
            </div>
            <div class="side-nav my-4">
                <ul class="px-0">
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/p/index" class="s-active"><i
                                class="bi bi-person-bounding-box"></i>Select Doctor</a></li>
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/p/dashboard"><i
                                class="bi bi-speedometer"></i>Dashboard</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-bookmark-fill"></i></i>Favouriate</a></li> -->
                    <!-- <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/p/booking" class="s-active"><i
                                class="bi bi-chat-left-dots-fill"></i>Booking</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/p/profile-settings"><i
                                class="bi bi-gear-fill"></i>Profile Setting</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
            </div>
        </div>


        <!-- body content -->
        <div class="col-md-9 d-book-content my-4">
            <div class="left d-flex mb-4">
                <img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg" class="rounded" height="90"
                    alt="User Image">
                <div class="mx-3">
                    <h5>Dr. <?php echo $record['fname'].' '.$record['sname'] ?></h5>
                    <div class="d-flex my-1">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <p class="my-0 mx-1">(35)</p>
                    </div>
                    <p class=""><i class="bi bi-geo-alt-fill"></i>
                        <?php echo $record['contact_detail']['city'].' '.$record['contact_detail']['state'] ?>
                        <a href="#"></a>
                    </p>
                </div>
            </div>
            <!-- select doctor -->
            <div class="row">
                <!-- day and date strip -->
                <div class="container dd-strip d-flex justify-content-between">
                    <div class="" id="today-date">
                        <h4 class="mb-1"><?php echo date('d F Y'); ?></h4>
                        <p class="text-muted"><?php echo date('l'); ?></p>
                    </div>
                    <div class="">
                        <div class="bookingrange btn btn-white btn-sm mb-3">
                            <input type="date" name="" class="form-control" id="">
                        </div>
                    </div>
                </div>

                <p id="warn"></p>

                <div class='container slider-main my-5'>
                    <?php echo $msg; ?>
                    <!-- <button type="button" class="btn slider-btn" id=""><i class='bi bi-chevron-left text-primary text-center my-auto rounder-circle'></i></button> -->
                    <div class="slider my-5 " id="seven-days-slot">
                        <div class="pl-5 d-flex justify-content-around select_active" id="select_active">
                            <?php
                                
                                $flag2 = false;
                                
                                $datetime = iterator_to_array( $record['datetime'] );
                        
                                $date_arr = [];
                                $time_arr = [];
                        
                                foreach($datetime as $date_key=>$val) {
                                    $date_arr[] = $date_key;
                                    foreach($val as $index=>$v) {
                                        $time_arr[$date_key][] = $v;
                                    }    
                                }
                        
                                $k = count( $date_arr );
                        
                                $collection = $db->check;
                                $record = $collection->findOne( ['c_unid' =>'429570412'] );
                                $datetime = iterator_to_array( $record['datetime'] );
                        
                                for($i = 0; $i < 7; $i++) {
                                    $date = strtotime("+$i day", strtotime("this week"));
                                    $premon = date("Y-m-d", $date);
                                    $a = strval($premon);
                                    echo '<div class="time-slots">
                                            <div class="mx-auto">
                                                <h5 class="text-dark px-4">'.date("D", $date).'</h5>
                                                <p class="text-muted text-nowrap">'.date("d M Y", $date).'</p>
                                            </div>';
                        
                                    // $w = count($time_arr[$premon]); 
                                    if($time_arr[$premon] == 0) {
                                        echo '<button type="button" class="btn btn-sm px-5 m-1 text-nowrap" disabled>---</button>';
                                    }
                                    else {
                                        $x = 1;
                                        foreach($time_arr as $index=>$value) {
                                            if($index == $premon) {
                                                echo '<div class="d-flex flex-column time-btn">';
                                                foreach ( $value as $key=>$val ) {
                        
                                                    foreach($datetime as $did=>$dval) {
                                                        if($did == $ass) {
                                                            foreach($dval as $date_key=>$val2) {
                                                                if($date_key == $premon) {
                                                                    foreach($val2 as $index=>$v) {
                                                                        $flag2 = false;
                                                                        if($v[0] == $val[0] && $v[1] == $val[1]){
                                                                            $flag2 = true;
                                                                            if($val[0] <= 12 && $val[1]) {
                                                                                echo '<button type="button" disabled
                                                                                class="btn btn-sm btn-primary text-light text-nowrap px-2 m-1 ">'.date('h:i', strtotime($val[0])).'AM - '.date('h:i', strtotime($val[1])).'
                                                                                AM<i class="bi bi-check2"></i></button>';
                                                                            }
                                                                            else {
                                                                                echo '<button type="button" disabled
                                                                                class="btn btn-sm btn-primary text-light text-nowrap px-2 m-1 ">'.date('h:i', strtotime($val[0])).'PM - '.date('h:i', strtotime($val[1])).'
                                                                                PM<i class="bi bi-check2"></i></button>';
                                                                            }
                                                                            goto ZSA;
                                                                        }
                                                                    }  
                                                                }
                                                            }
                                                        }
                                                    }
                        
                                                    ZSA: if($flag2 == false) {
                                                            if($val[0] <= 12 && $val[1]) {
                                                                echo '<button type="button"
                                                                        onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\', \''.$ass .'\')"
                                                                        class="btn btn-sm  text-nowrap px-4 m-1 btn-a"
                                                                        id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' AM - '.date('h:i', strtotime($val[1])).'
                                                                        AM</button>';
                                                                    $x++;
                                                            }
                                                            else {
                                                                echo '<button type="button"
                                                                        onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\', \''.$ass .'\')"
                                                                        class="btn btn-sm  text-nowrap px-4 m-1 btn-a"
                                                                        id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' PM - '.date('h:i', strtotime($val[1])).'
                                                                        PM</button>';
                                                                    $x++;
                                                            }
                                                        }
                                                }
                                                echo '</div>';            
                                            }
                                        }
                                    }
                                    echo '</div>';
                                }
                            
                            ?>
                        </div>
                    </div>
                </div>
 
                <!-- procced to pay -->
                <div class="container protopay d-flex justify-content-end">
                    <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_HpPd6WQ6mPUBwA" async> </script> </form>
                    <!-- <button class="btn btn-primary px-5 py-3" onclick="proccedtopay()" id="proccedtopay">Proceed to Pay
                        <i class="bi bi-arrow-right my-auto mx-3 "></i></button> -->
                </div>
            </div>
        </div>






        <?php include '../../assest/bottom_links.php'; ?>
        <script src="http://test.feelyprivacy.com/s/controller/js/p-booking.js?ver=2.8"></script>
        <script src="http://test.feelyprivacy.com/s/controller/js/success.js?ver=2.0"></script>
</body>

</html>