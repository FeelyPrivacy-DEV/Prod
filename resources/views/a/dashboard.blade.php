<?php
    session_start();
    error_reporting(0);
    if($_SESSION['aid'] == '') {
        header('location: https://test.feelyprivacy.com/s/admin/index');
    }
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;
    $collection = $db->admin;

    $record = $collection->findOne( [ '_id' =>$_SESSION['aid']] );



?>

<!doctype html>
<html lang='en'>

<head>
    @include('/assest/top_links')
    <link rel="stylesheet" href="/css/admin/dashboard.css?ver=3.1">
    <title>Admin | Dashboard</title>
</head>

<body>

    <div class="main">

        <!-- sidebar -->
        <div class="Sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" id="sidebar">
            <a href="/a/dashboard"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="/image/logo.png" height="40" class="mx-auto " alt="">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/a/dashboard" class="nav-link active-sn" aria-current="page">
                        <i class="bi bi-speedometer bi me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/a/appoinment" class="nav-link link-dark">
                        <i class="bi bi-calendar-check-fill bi me-2"></i>
                        Appointments
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        <i class="bi bi-megaphone-fill bi me-2"></i>
                        Specialities
                    </a>
                </li>
                <li>
                    <a href="/a/doctor" class="nav-link link-dark">
                        <i class="bi bi-person-lines-fill bi me-2"></i>
                        Doctor
                    </a>
                </li>
                <li>
                    <a href="/a/pending-doctor" class="nav-link link-dark">
                        <i class="bi bi-person-dash-fill  bi me-2"></i>
                        Pending Doc <span
                            class="text-end text-danger"><?php echo count($record['pendingDoc_ids']); ?></span>
                    </a>
                </li>
                <li>
                    <a href="/a/patient" class="nav-link link-dark">
                        <i class="bi bi-file-person bi me-2"></i>
                        Patients
                    </a>
                </li>
            </ul>
            <hr>

        </div>

        <!-- navbar -->
        <nav class="navbar navbar-light bg-light fixed-top d-flex justify-content-between">
            <div class="container-fluid">
                <button class="btn" id="btn_side"><i class="bi bi-grip-horizontal"></i></button>
                <div class="">
                    <input type="text" class="border rounded-pill px-4 py-2 mx-4 my-0" placeholder="Search Here">
                    <i class="bi bi-search"></i>
                </div>
                <div class="dropdown mx-5">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['fname'] ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <form action='/logout' method='POST'>
                                @csrf
                                <button type='submit' name='logout'
                                    class='btn    text-nowrap text-danger px-4 mx-1'>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="my-5 body-main">
            <div class="my-5 mx-4">
                <h3 class="h3">Welcome Admin!</h3>
                <p>Dashboard</p>
            </div>

            <!-- cards -->
            <div class="row px-4">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-primary rounded-circle border border-primary">
                                    <i class="bi bi-person-lines-fill"></i>
                                </span>
                                <div class="dash-count text-end">
                                    <h3 class="mx-4"><?php echo count($record['doc_ids']); ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Doctors</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar d w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-success">
                                    <i class="bi bi-file-person"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 class="text-end mx-4"><?php echo count($record['pat_ids']); ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Patients</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-danger border-danger">
                                    <i class="bi bi-calendar-check-fill"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 class="text-end mx-4">485</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Appointment</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-warning border-warning">
                                    <i class="bi bi-layout-text-window-reverse"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 class="text-end mx-4">$62523</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Revenue</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- graphs -->
            <!-- <div class="row mx-2">
                <div class="col-md-6">
                    <h3>Revenue</h3>
                </div>
                <div class="col-md-6">
                    <h3>Status</h3>
                </div>
            </div> -->

            <!-- doc and patient list -->
            <div class="row my-5">
                <div class="col-md-6">
                    <div class="card-header">
                        <h4 class="card-title">Doctors List</h4>
                    </div>
                    <div class="doc-table">
                        <table class="table table-hover table-responsive table-center mb-0" id="doc_table">
                            <thead>
                                <tr class="text-center">
                                    <th>Doctor Name</th>
                                    <th>Speciality</th>
                                    <th>Earned</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $collection = $db->manager;
                                    $record_doc = $collection->find();

                                    foreach($record_doc as $key) {
                                        if($key['approved'] == true) {
                                            if($key['login_able'] == false) {
                                                echo '<tr style="background-color: rgb(255, 217, 217);">';
                                            }
                                            else {
                                                echo '<tr>';
                                            }
                                                echo '<td>
                                                        <h2 class="table-avatar d-flex justify-content-start">';
                                                        if($key['profile_image'] != '') {
                                                            echo '<a href="#" class="avatar avatar-sm mr-2"><img
                                                                        class="avatar-img rounded-circle mx-2"
                                                                        src="/image/doc-img/doc-img/'.$key['profile_image'].'"
                                                                        height="40" alt="User Image"></a>
                                                                <a href="#" class="my-auto mx-1 text-nowrap">Dr. '.$key['fname'].' '.$key['sname'].'</a>';
                                                        }
                                                        else {
                                                            echo '<a href="#" class="avatar avatar-sm mr-2"><img
                                                                        class="avatar-img rounded-circle mx-2"
                                                                        src="/image/doc-img/doc-img/default-doc.jpg"
                                                                        height="40" alt="User Image"></a>
                                                                <a href="#" class="my-auto mx-1 text-nowrap">Dr. '.$key['fname'].' '.$key['sname'].'</a>';
                                                        }
                                                echo '</h2>
                                                    </td>
                                                    <td>Dental</td>
                                                    <td>$'.$key['total_earn'].'</td>
                                                    <td class="text-warning">
                                                        <button class="btn btn sm btn-danger" id="d_btn" onclick="del(\''.$key['d_unid'].'\')">D</button>
                                                    </td>
                                                </tr>';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-header">
                        <h4 class="card-title">Patients List</h4>
                    </div>
                    <div class="pat-table">
                        <table class="table table-hover table-responsive table-center mb-0" id="pat_table">
                            <thead>
                                <tr class="text-center">
                                    <th>Patient Name</th>
                                    <th>Phone</th>
                                    <th>Last Visit</th>
                                    <th>Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $collection = $db->employee;
                            $record_pat = $collection->find();

                            foreach($record_pat as $key) {
                                echo '<tr>
                                        <td>
                                            <h2 class="table-avatar d-flex justify-content-start">
                                                <a href="#" class="avatar avatar-sm mr-2"><img
                                                        class="avatar-img rounded-circle"
                                                        src="/image/pat-img/default_user.png"
                                                        height="40" alt="User Image"></a>
                                                <a href="#" class="text-nowrap mx-1 text-nowrap">'.$key['fname'].' '.$key['sname'].'</a>
                                            </h2>
                                        </td>
                                        <td>8286329170</td>
                                        <td>20 Oct 2019</td>
                                        <td class="text-right">$100.00</td>
                                    </tr>';
                            }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- APPOINMENTS -->
            <div class="row apps-list">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title">Appointment List</h4>
                    </div>
                    <div class="app-table">
                        <table class="table table-hover table-responsive table-center mb-0" id="app_table">
                            <thead class="px-auto">
                                <tr class="text-center">
                                    <th class="">Doctor Name</th>
                                    <th class="mx-5">Speciality</th>
                                    <th>Patient Name</th>
                                    <th>Apointment Time</th>
                                    <th>Status</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="px-auto">
                                <?php
                                    $collection = $db->employee;
                                    $record_pat_app = $collection->find();
                                    $c = 0;
                                    foreach($record_pat_app as $keyOfPat) {
                                        foreach($keyOfPat['datetime'] as $docId=>$date_obj) {
                                            foreach($date_obj as $date=>$dateValues) {
                                                foreach($dateValues as $key=>$val) {
                                                        $collection = $db->manager;
                                                        $record_doc_app = $collection->findOne(['d_unid' => strval($docId)]);

                                                        echo '<tr class="px-auto">
                                                                <td>
                                                                    <h2 class="table-avatar d-flex justify-content-start">
                                                                        <a href="profile.html" class="avatar avatar-sm mr-2"><img
                                                                                class="avatar-img rounded-circle"';
                                                                                if($record_doc_app['profile_image'] != '') {
                                                                                    echo 'src="/image/doc-img/doc-img/'.$record_doc_app['profile_image'].'"';
                                                                                }
                                                                                else {
                                                                                    echo 'src="/image/doc-img/doc-img/default-doc.jpg"';
                                                                                }
                                                                        echo 'height="40"
                                                                                alt="User Image"></a>
                                                                        <a href="profile.html" class="text-nowrap mx-2">Dr. '.$record_doc_app['fname'].' '.$record_doc_app['sname'].'</a>
                                                                    </h2>
                                                                </td>
                                                                <td class="px-auto">Dental</td>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="profile.html" class="avatar avatar-sm mr-2">
                                                                            <img
                                                                                class="avatar-img rounded-circle"';
                                                                                if($record_doc_app['profile_image'] != '') {
                                                                                    echo 'src="/image/pat-img/'.$keyOfPat['profile_image'].'"';
                                                                                }
                                                                                else {
                                                                                    echo 'src="/image/pat-img/default_user.png"';
                                                                                }
                                                                    echo 'height="40"
                                                                            alt="User Image"></a>
                                                                        <a href="profile.html">'.$keyOfPat['fname'].' '.$keyOfPat['sname'].'</a>
                                                                    </h2>
                                                                </td>';
                                                                if($val['book_t'][0] <= 12) {
                                                                    echo '<td>'.$date.' <span class="text-primary d-block">'.date('h:i', strtotime($val['book_t'][0])).' AM - '.date('h:i', strtotime($val['book_t'][1])).' AM</span></td>';
                                                                }
                                                                else {
                                                                    echo '<td>'.$date.' <span class="text-primary d-block">'.date('h:i', strtotime($val['book_t'][0])).' PM - '.date('h:i', strtotime($val['book_t'][1])).' PM</span></td>';
                                                                }
                                                                echo '<td>
                                                                        <div class="switch_box box_1">
                                                                            <input type="checkbox" class="switch_1" checked>
                                                                        </div>
                                                                </td>
                                                                <td class="text-right">
                                                                    '.$val['amt'].'
                                                                </td>
                                                            </tr>';
                                                        $c++;
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





    @include('/assest/bottom_links')
    <script src="{{ URL::asset('/js/admin/dashboard.js?ver=1.9') }}"></script>
</body>

</html>
