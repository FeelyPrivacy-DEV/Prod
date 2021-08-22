<?php

require '../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://143.244.135.9:27017' );
$db = $con->php_mongo;

if(isset($_POST['manager_login'])) {
    $collection = $db->manager;

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $record = $collection->findOne( [ 'email' =>$email ]);  

    if($record) {
        if(password_verify( $pass, $record['password'])) {
            if($record['approved'] == true) {
                if($record['login_able'] == true) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['docid'] = $record['_id'];
                    $_SESSION['email'] = $record['email'];
                    $_SESSION['d_unid'] = $record['d_unid'];
                    $_SESSION['fname'] = $record['fname'];
                    $_SESSION['sname'] = $record['sname'];
                    header('location: http://143.244.135.9/s/view/d/index');
                    exit();
                }
                else {
                    header('location: http://143.244.135.9/s/d?login=disable');
                }
            }
            else {
                header('location: http://143.244.135.9/s/d?auth=disable');
            }
        }
        else {
            header('location: http://143.244.135.9/s/d?auth=failed');
        }
    }
    else {
        header('location: http://143.244.135.9/s/d?auth=failed');
    }
 
}
else if(isset($_POST['employee_login'])) {
    $collection = $db->employee;

    $empid = $_POST['empid'];
    $pass = $_POST['pass'];

    $record = $collection->findOne( [ 'empid' =>$empid ]);  

    if($record) {
        if(password_verify( $pass, $record['password'])) {
            session_start();
            $_SESSION['eid'] = $record['_id'];
            $_SESSION['email'] = $record['email'];
            $_SESSION['fname'] = $record['fname'];
            $_SESSION['sname'] = $record['sname'];
            $_SESSION['p_unid'] = $record['p_unid'];
            header('location: http://143.244.135.9/s/view/p/index');
            exit();
        }
        else {
            header('location: http://143.244.135.9/s/p?auth=failed');
        }
    }
    else {
        header('location: http://143.244.135.9/s/p?auth=failed');
    }


}






?>