<!--
		Developer: Tekletsadik Tadesse
		Mobile : +251967267539
		Address : Addiss Ababa, Ethiopia
		-->
<?php
session_start();

if(!$_SESSION['id'])
{
    header("Location: ../index.php");
}
?>

<?php
include("connection/db_conection.php");

include("connection/db_conection.php");
if(isset($_POST['employee_save']))
{
	//Getting POST Values
    $name = $_POST['fullname'];
    $department = $_POST['department'];
    $type = $_POST['role_type'];
    $email = $_POST['email'];
    $id = $_POST['drogaid'];
    $password = md5($_POST['password']);
	$registered_by = $_SESSION['name'];

	//$salt = bin2hex(random_bytes(16)); // Generate a 16-byte salt (32 characters in hexadecimal)
    // Combine the password and salt, then hash the result
    //$hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT); // Use bcrypt as the default hashing algorithm

	// Check if the employee already exists
	$checkSql = "SELECT * FROM users WHERE id = ?";
	$checkStmt = $dbcon->prepare($checkSql);
	$checkStmt->bind_param("s", $id);
	$checkStmt->execute();
	$checkResult = $checkStmt->get_result();

		if ($checkResult->num_rows > 0) {
			// Employee already exists
			echo "<script>alert('Employee already exist, Please try another one!')</script>";
			echo"<script>window.open('employee-add.php','_self')</script>";
			exit();
		} else {
			// Prepare the SQL statement
			$insertSql = "INSERT INTO users (name,department,type,email,registered_by,id,password) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$insertStmt = $dbcon->prepare($insertSql);

			// Bind the parameter values
			$insertStmt->bind_param("sssssss", $name,$department,$type,$email,$registered_by,$id,$password);

			// Execute the statement
			if ($insertStmt->execute()) {
				// Registration successful
				echo "<script>alert('Employee successfully saved')</script>";
				echo "<script>window.open('employee-list.php','_self')</script>";

			} else {
				// Registration failed
				echo "Error: " . $insertStmt->error;
				echo"<script>window.open('employee-add.php','_self')</script>";

			}
		}

	// Close the statements and connection
	$checkStmt->close();
	$insertStmt->close();
	$dbcon->close();
	
			
}

?>









