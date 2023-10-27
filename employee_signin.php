<!--
		Developer: Tekletsadik Tadesse
        Mobile : +251967267539
        Droga Pharma pvt PLC.
        Address : Addiss Ababa, Ethiopia
		-->

<?php
session_start();
error_reporting(0);
include_once('db_conection.php');

// Code for User login
    if(isset($_POST['emp_signin']))
    {
    $user_id=$_POST['drogaid'];
    $password=md5($_POST['password']);

        $query=mysqli_query($dbcon,"SELECT * FROM users WHERE id='$user_id' and password='$password'");
        $num=mysqli_fetch_array($query);
        $name=$num['name'];

        if($num>0)
        {
        $extra="dms/index.php";
        $_SESSION['emp_signin']=$_POST['user_id'];
        //$_SESSION['id']=$_POST['user_id'];
        $_SESSION['id']=$num['id'];
        $_SESSION['name']=$num['name'];
        $uip=$_SERVER['REMOTE_ADDR'];
        //$uip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

        $login_time = date("Y-m-d H:i:s");
        $action = "User logged in";
        $status=1;
        $log=mysqli_query($dbcon,"insert into user_log(user_id,user_name,user_ip,login_time,action,status) values('$user_id','$name','$uip','$login_time','$action','$status')");
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
        }
        else
        {
        $extra="index.php";
        $user_id=$_POST['drogaid'];
        $uip=$_SERVER['REMOTE_ADDR'];
        $login_time = date("Y-m-d H:i:s");
        $action = "Invalid ID or Password";
        $status=0;
        $log=mysqli_query($dbcon,"insert into user_log(user_id,user_name,user_ip,login_time,action,status) values('$user_id','$user_id','$uip','$login_time','$action','$status')");
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        $_SESSION['errmsg']="Invalid ID id or Password";
        exit();
        }
        }
        ?>
