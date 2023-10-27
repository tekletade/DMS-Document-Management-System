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
if(isset($_POST['department_save']))
{
    $dept_name = $_POST['deptname'];
    $dept_manager = $_POST['deptmanager'];
	$disksize_given = $_POST['givendisk'];


    // Check if the department already exists
	$check_dept = "SELECT * FROM department WHERE dept_name = ?";
	$checkStmt = $dbcon->prepare($check_dept);
	$checkStmt->bind_param("s", $dept_name);
	$checkStmt->execute();
	$checkResult = $checkStmt->get_result();
	
	// Check if the department already exists
	$check_dept2 = "SELECT * FROM access WHERE access_name = ?";
	$checkStmt2 = $dbcon->prepare($check_dept2);
	$checkStmt2->bind_param("s", $dept_name);
	$checkStmt2->execute();
	$checkResult2 = $checkStmt2->get_result();

	if ($checkResult->num_rows > 0) {
		// Department already exists
		echo "<script>alert('Department already exist, Please try another one!')</script>";
		echo"<script>window.open('department-add.php','_self')</script>";
		exit();
	}
	else{
		// Prepare the SQL statement
		$saveitem="INSERT into department (dept_name,dept_manager,disksize_given) VALUE (?, ?, ?)";
		$insertStmt = $dbcon->prepare($saveitem);

		// Bind the parameter values
		$insertStmt->bind_param("sss", $dept_name,$dept_manager,$disksize_given);		

		// Execute the statement
		if ($insertStmt->execute()) {
			// Registration successful
			echo "<script>alert('Department successfully saved')</script>";
			echo "<script>window.open('department.php','_self')</script>";

				// TO CREATE THE DEPARTMENT FOLDER WITH IN THE PHYSICAL DRIVE
				$path= '../../Grouped_All_Files/' . $dept_name; 
					if(!file_exists($path))
					{
						mkdir($path,0777,true);
					}
					
		} else {
			// Registration failed
			echo "Error: " . $insertStmt->error;
			echo "<script>window.open('department-add.php','_self')</script>";

		}
	}
	if ($checkResult2->num_rows > 0) {
		// Department already exists
		echo"<script>window.open('department-add.php','_self')</script>";
		exit();
	}
	else{
		// Prepare the SQL statement
		$saveitem2="INSERT into access (access_name) VALUE (?)";
		$insertStmt2 = $dbcon->prepare($saveitem2);

		// Bind the parameter values
		$insertStmt2->bind_param("s", $dept_name);		

		// Execute the statement
		if ($insertStmt2->execute()) {
			// Registration successful
			echo "<script>window.open('department.php','_self')</script>";

		} else {
			// Registration failed
			echo "Error: " . $insertStmt->error;
			echo "<script>window.open('department-add.php','_self')</script>";

		}
	}
	
	// Close the statements and connection
	$checkStmt->close();
	$checkStmt2->close();
	$insertStmt->close();
	$insertStmt2->close();
	$dbcon->close();
		
}

?>









