<?php
session_start();
include('session.php');
// if(!$_SESSION['id'])
// {

//     header("Location: ../index.php");
// }

?>

<?php
include("connection/db_conection.php");

if(isset($_POST['folder_save']))
{
	
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$department = $_POST['department'];
$parent_id = $_POST['parent_id'];
$folder_name = $_POST['folder_name'];
// $publicity = $_POST['access_name'];
$publicity = "private";


	$check_item="SELECT folder_name from folders WHERE folder_name='$folder_name' and user_id ='$user_id'";
    $run_query=mysqli_query($dbcon,$check_item);
			// echo "SELECT folder_name from folders WHERE folder_name='$folder_name' and user_id ='$user_id'";

    if(mysqli_num_rows($run_query)>0)
    {
		echo "<script>alert('Folder is already exist, Please try another one!')</script>";
		
		if($parent_id>=1)	{		
			echo "<script>window.open('folder_detail.php?id=$parent_id','_self')</script>";
			}
			else{
			   echo "<script>window.open('folder_detail.php','_self')</script>";

			}
			
				exit();
			}
			//Create folder on drive with in the specific department
							$check_user="SELECT * from users WHERE id = '".$_SESSION['id']."'";			
                              $result1 = mysqli_query($dbcon, $check_user);
                              $userfilter = mysqli_fetch_assoc($result1);
                              $userdept = $userfilter['department'];
							  
			
				$path= '../Grouped_All_Files/'.$userdept .'/' . $folder_name; 
					if(!file_exists($path))
					{
						mkdir($path,0777,true);
					}
			//Insert folder to Database
					$createfolder="insert into folders (user_id,parent_id,folder_name,user_name,publicity,department) VALUE ('$user_id','$parent_id','$folder_name','$user_name','$publicity','$department')";
					mysqli_query($dbcon,$createfolder);
					
					//for log
					$uip=$_SERVER['REMOTE_ADDR'];
					$created_time = date("Y-m-d H:i:s");
					$action = "Folder Created";
					$status=1;
					$log="INSERT INTO user_activity(user_id,file_name,user_name,user_ip,created_time,action,status) VALUES ('$user_id','$folder_name','$user_name','$uip','$created_time','$action','$status')";
					mysqli_query($dbcon,$log);

					// echo "insert into folders (user_id,parent_id,folder_name) VALUE ('$user_id','$parent_id','$folder_name')";
					//  echo "<script>alert('Folder successfully Created!')</script>";	
					 if($parent_id>=1)	{		
					 echo "<script>window.open('folder_detail.php?id=$parent_id','_self')</script>";
					 }
					 else{
						echo "<script>window.open('folder_detail.php','_self')</script>";

					 }
	}

	else{
		//for failed log
		$uip=$_SERVER['REMOTE_ADDR'];
		$created_time = date("Y-m-d H:i:s");
		$action = "Failed to folder Creation";
		$status=0;
		$log="INSERT INTO user_activity(user_id,file_name,user_name,user_ip,created_time,action,status) VALUES ('$user_id','$folder_name','$user_name','$uip','$created_time','$action','$status')";
		mysqli_query($dbcon,$log);
	}
	
	
?>









