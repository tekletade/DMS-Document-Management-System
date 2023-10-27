<!--
		Developer: Tekletsadik Tadesse
        Mobile : +251967267539
        Droga Pharma pvt PLC.
        Address : Addiss Ababa, Ethiopia
		-->
<?php

//session_start();
//session_destroy();
//header("Location: ../index");
?>

<?php
session_start();
include("connection/db_conection.php");

$_SESSION['id']=="";
//date_default_timezone_set('Asia/Kolkata');
//$ldate=date( 'd-m-Y h:i:s A', time () );
$ldate = date("Y-m-d H:i:s");
$action = "User logged Out";
mysqli_query($dbcon,"UPDATE user_log SET logout_time = '$ldate',action = '$action' WHERE user_id = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
session_unset();
unset($_SESSION['id']);
$_SESSION['errmsg']="You have successfully logout";
session_destroy();

include('cookie.php');
?>

<script language="javascript">
document.location="../index";
</script>
