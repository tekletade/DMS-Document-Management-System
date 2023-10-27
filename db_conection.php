
<!--
		Developer: Tekletsadik Tadesse
        Mobile : +251967267539
        Address : Addiss Ababa, Ethiopia
		-->

<?php



//$dbcon=mysqli_connect("10.10.10.18","root","");

//mysqli_select_db($dbcon,"fms_db");

?>
<?php
$host = '127.0.0.1'; // Replace with the IP address or hostname of the machine running XAMPP
$port = '3306'; // The default MySQL port for XAMPP is 3306
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password
$database = 'fms_dbs'; // Replace with the name of your database

// Create a dbcon to the remote database
$dbcon = new mysqli($host, $username, $password, $database, $port);

// Check if the dbcon was successful
if ($dbcon->connect_error) {
    die('dbcon failed: ' . $dbcon->connect_error);
}
?>