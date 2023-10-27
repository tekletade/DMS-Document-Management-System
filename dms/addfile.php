<!--
		Developer: Tekletsadik Tadesse
        Mobile : +251967267539
        Droga Pharma pvt PLC.
        Address : Addiss Ababa, Ethiopia
		-->

<?php
session_start();
include('session.php');
// if(!$_SESSION['id'])
// {

//    header("Location: ../index.php");
// }
require_once("connection/db_conection.php");

// Uploads files
if (isset($_POST['file_save'])) { 
    // name of the uploaded file
	$user_id=$_POST['user_id'];
	$folder_id=$_POST['parent_id'];
	$user_name = $_POST['user_name'];
    $department = $_POST['department'];
	$access_name = "private";

	$sql_query3 = "SELECT SUM(size) FROM files where department = '$department'";
	$sizesum = mysqli_query($dbcon,$sql_query3);
	$sumsize = mysqli_fetch_array($sizesum);
	$totalusedsize = $sumsize[0];

	$size = "SELECT * FROM department where dept_name='$department'";
	$sizetotal = mysqli_query($dbcon,$size);
	$sizetotals = mysqli_fetch_array($sizetotal);

	$totalgiven = $sizetotals['disksize_given'];
	$disk_used = $sizetotals['disk_used'];


    $r = mysqli_query($dbcon,"SELECT * FROM users where id='".$_POST['user_id']."'");
    $row = mysqli_fetch_array($r);
    $filename = $_FILES['myfile']['name'];
	
	// echo $department;

	$fileNameNoExtension= pathinfo($filename)['filename'];
	$extension = pathinfo($filename, PATHINFO_EXTENSION);

	//add file on drive with in the specific department and folder
							  $check_user="SELECT * from users WHERE id = '".$_SESSION['id']."'";			
                              $result1 = mysqli_query($dbcon, $check_user);
                              $userfilter = mysqli_fetch_assoc($result1);
                              $userdept = $userfilter['department'];
	//SELECT the folder of that we clicked
							  //$check_folder="SELECT * from folders WHERE id = '$folder_id'";
							  //$res=$dbcon->query($check_folder);
							  
                              //$result2 = mysqli_query($dbcon, $check_folder);
                              //$folderfilter = mysqli_fetch_assoc($result2);
                              //$currentfolder = $folderfilter['folder_name'];
						
    // destination of the file on the server
    //$destination = '../../Grouped_All_Files/'.$userdept .'/' .$currentfolder .'/' .$filename;
    $destination = '../Grouped_All_Files/'.$userdept .'/' .$filename;
    //$destination = '\\\\10.10.10.18\\B$\\test\\' . $userdept . '\\' .$filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if(!in_array($extension, ['pdf','php','jpg','png','PNG','JPG','PDF','DOCX','XLSX','PPTX','zip','rar','sql','docx','doc','ppt','pptx','xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr','jpeg','gif','psd','tif','ps','eps','prn'])) 
	{
				
				$uip=$_SERVER['REMOTE_ADDR'];
				$created_time = date("Y-m-d H:i:s");
				$action = "File extension Out of Scope";
				$status=0;
				$logs="INSERT INTO user_activity(user_id,file_name,user_name,user_ip,created_time,action,status) values('$user_id','$filename','$user_name','$uip','$created_time','$action','$status')";
				mysqli_query($dbcon,$logs);
				
			echo "<script>alert('You file extension is Out of Our Scope') </script>";

					if($folder_id>=1)	{		
						echo "<script>window.open('folder_detail.php?id=$folder_id','_self')</script>";
						}
						else{
						   echo "<script>window.open('folder_detail.php','_self')</script>";
								
						}
						exit();

			} else if ($_FILES['myfile']['size'] > 200000000) { // file shouldn't be larger than 200 Megabyte

				$uip=$_SERVER['REMOTE_ADDR'];
				$created_time = date("Y-m-d H:i:s");
				$action = "File to Large";
				$status=0;
				$logs="INSERT INTO user_activity(user_id,file_name,user_name,user_ip,created_time,action,status) values('$user_id','$filename','$user_name','$uip','$created_time','$action','$status')";
				mysqli_query($dbcon,$logs);
				
				echo "File too large!";

			} else {

			$check_file="SELECT name from files WHERE name='$fileNameNoExtension' and user_id ='$user_id'";
			$rows=mysqli_query($dbcon,$check_file);
						
            if (mysqli_num_rows($rows)>0) 
              { 
				echo "<script>alert('File already Exist!')</script>";
				if($folder_id>=1)	{		
					echo "<script>window.open('folder_detail.php?id=$folder_id','_self')</script>";
					}
					else{
					   echo "<script>window.open('folder_detail.php','_self')</script>";		
					}
					exit();
              } 
      
				if (move_uploaded_file($file, $destination)) {
					if($totalusedsize > $totalgiven)
					{
						echo "<script>alert('Your Storage is full Please Extend!')</script>";
						echo "<script>window.open('folder_detail.php','_self')</script>";
						// exit();

					}
					$sumdiskupdate = $disk_used + $size;
					$sqlupdate = "UPDATE department set disk_used='$sumdiskupdate' WHERE dept_name='$department'";
					
					mysqli_query($dbcon,$sqlupdate);

					$sql = "INSERT INTO files (name,user_id,user_name,department,folder_id,file_type,size,publicity) VALUES ('$fileNameNoExtension','$user_id','$user_name','$department','$folder_id', '$extension','$size','$access_name')";
					
					if (mysqli_query($dbcon, $sql)) {
						//for log
						$uip=$_SERVER['REMOTE_ADDR'];
						$created_time = date("Y-m-d H:i:s");
						$action = "File Created";
						$status=1;
						$log="INSERT INTO user_activity(user_id,file_name,user_name,user_ip,created_time,action,status) VALUES ('$user_id','$filename','$user_name','$uip','$created_time','$action','$status')";
					    mysqli_query($dbcon,$log);
//
						echo "<script> alert('File was Uploaded')</script>";
						if($folder_id>=1)	{		
							echo "<script>window.open('folder_detail.php?id=$folder_id','_self')</script>";
							}
							else{
							   echo "<script>window.open('folder_detail.php','_self')</script>";
							   exit();				
							}
							}
					
				} else {
					echo "Failed to Upload files!";
					$uip=$_SERVER['REMOTE_ADDR'];
					$created_time = date("Y-m-d H:i:s");
					$action = "Failed to Upload files";
					$status=0;
					$logs="INSERT INTO user_activity(user_id,file_name,user_name,user_ip,created_time,action,status) values('$user_id','$filename','$user_name','$uip','$created_time','$action','$status')";
					mysqli_query($dbcon,$logs);
					
					echo "<script>window.open('folder_detail.php','_self')</script>";
					exit();
				}
			
  }
}
