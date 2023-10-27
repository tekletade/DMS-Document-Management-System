<!-- Developer 
---------Tekletsadik Tadesse--------
 -->
<?php
session_start();

if(!$_SESSION['id'])
{

    header("Location: ../index");
}

?>

<?php
include("connection/db_conection.php");

include("connection/config.php");

//sharepublic
if(isset($_POST['sharepublic']))
{
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $department = $_POST['department'];
    $folder_name = $_POST['folder_name'];
    $parent_id = $_POST['parent_id'];

    $publicity = "Public";
	
	
    $check_item="SELECT * from folders WHERE folder_name='$folder_name' and publicity='$publicity' ";
    $run_query=mysqli_query($dbcon,$check_item);
	$fetched_row=mysqli_fetch_array($run_query);


    if(mysqli_num_rows($run_query)>0)
    {
		echo "<script>alert('Folder already Shared Before')</script>";
		echo"<script>window.open('folder_detail','_self')</script>";
		exit();
	}				//Insert copy of the folder
					$saveitem="INSERT into folders (user_id,user_name,folder_name,department,publicity,shared_id) VALUE ('$user_id','$user_name','$folder_name','$department','$publicity','".$_SESSION['id']."')";
					mysqli_query($dbcon,$saveitem);
					echo "<script>alert('Successfully Shared!')</script>";				
					echo"<script>window.open('folder_detail','_self')</script>";
					//to get the current folder id	
					$sql_query = "SELECT * from folders WHERE folder_name='$folder_name' and publicity='$publicity'";
					$referralCount = mysqli_query($dbcon,$sql_query);
					$referral = mysqli_fetch_array($referralCount);
					$id = $referral['id'];
		
					// Update the nested folders state to public
					$sql = "UPDATE folders set publicity='$publicity',shared_id='$id' WHERE parent_id='$parent_id'";
					mysqli_query($dbcon,$sql);
					// echo "UPDATE folders set publicity='$publicity',shared_id='$id' WHERE parent_id='$parent_id'";
					
					// Update the state of files that is with in this folder
					$sqlupdate = "UPDATE files set publicity='$publicity',shared_id='$id' WHERE folder_id='$parent_id'";
					mysqli_query($dbcon,$sqlupdate);
					// echo "UPDATE files set publicity='$publicity',shared_id='$id' WHERE folder_id='$parent_id'";
				
}
//shareindividual
if(isset($_POST['shareindividual']))
{
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $department = $_POST['department'];
    $folder_name = $_POST['folder_name'];
    $parent_id = $_POST['parent_id'];

    $publicity = $_POST['sharename'];
	
	
    $check_item="SELECT * from folders WHERE folder_name='$folder_name' and publicity='$publicity' ";
    $run_query=mysqli_query($dbcon,$check_item);
	$fetched_row=mysqli_fetch_array($run_query);

    if(mysqli_num_rows($run_query)>0)
    {
		echo "<script>alert('Folder already Shared Before')</script>";
		echo"<script>window.open('folder_detail','_self')</script>";
		exit();
	}				
					 // insert folders for the specific user_id
					 $saveitem="INSERT into folders (user_id,user_name,folder_name,department,publicity,shared_id) VALUE ('$user_id','$user_name','$folder_name','$department','$publicity','".$_SESSION['id']."')";
					 mysqli_query($dbcon,$saveitem);
					 echo "<script>alert('Successfully Shared!')</script>";	
					 echo"<script>window.open('folder_detail','_self')</script>";
					 // to get the id of the current folder that i was insert above	
					 $sql_query = "SELECT * from folders WHERE folder_name='$folder_name' and publicity='$publicity'";
					 $referralCount = mysqli_query($dbcon,$sql_query);
					 $referral = mysqli_fetch_array($referralCount);
					 $id = $referral['id'];

					// copy and paste the child folders for the specified user_id
					$query=mysqli_query($dbcon,"SELECT * from folders WHERE parent_id = $parent_id");
					while($row=mysqli_fetch_array($query))
					{
						$user_id = $row['user_id'];
						$user_name = $row['user_name'];
						$department = $row['department'];
						$folder_name = $row['folder_name'];
						$publicity = $_POST['sharename'];
						$shared_id = $_SESSION['id'];
						
					$copyitem="INSERT into folders (user_id,user_name,folder_name,department,parent_id,publicity,shared_id) VALUE ('$user_id','$user_name','$folder_name','$department','$id','$publicity','$shared_id')";
					mysqli_query($dbcon,$copyitem);
					echo "INSERT into folders (user_id,user_name,folder_name,department,parent_id,publicity,shared_id) VALUE ('$user_id','$user_name','$folder_name','$department','$id','$publicity','$shared_id')";
					
				} 

				// copy and paste the child files for the specified user_id
				$query=mysqli_query($dbcon,"SELECT * from files WHERE folder_id = $parent_id");
				while($row=mysqli_fetch_array($query))
				{
					$name = $row['name'];
					$user_id = $row['user_id'];
					$user_name = $row['user_name'];
					$department = $row['department'];
					$size = $row['size'];					
					$file_type = $row['file_type'];

					$publicity = $_POST['sharename'];
					
				$copyfile="INSERT into files (name,user_id,user_name,folder_id,department,file_type,size,publicity,shared_id) VALUE ('$name','$user_id','$user_name','$id','$department','$file_type','$size','$publicity','$shared_id')";
				mysqli_query($dbcon,$copyfile);
				echo "INSERT into files (name,user_id,user_name,folder_id,department,file_type,size,publicity,shared_id) VALUE ('$name','$user_id','$user_name','$id','$department','$file_type','$size','$publicity','$shared_id')";
			} 
}

//sharegroup
if(isset($_POST['sharegroup']))
{
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $department = $_POST['department'];
    $folder_name = $_POST['folder_name'];
    $parent_id = $_POST['parent_id'];

    $publicity = $_POST['access_name'];
	$shared_id = $_SESSION['id'];
	
    $check_item="SELECT * from folders WHERE folder_name='$folder_name' and publicity='$publicity' ";
    $run_query=mysqli_query($dbcon,$check_item);
	$fetched_row=mysqli_fetch_array($run_query);


    if(mysqli_num_rows($run_query)>0)
    {
		echo "<script>alert('Folder already Shared Before')</script>";
		echo"<script>window.open('folder_detail.php','_self')</script>";
		exit();
	}
					//Insert the copy of the targeted folder to the targeted group "Publicity"
					$saveitem="INSERT into folders (user_id,user_name,folder_name,department,publicity,shared_id) VALUE ('$user_id','$user_name','$folder_name','$department','$publicity','$shared_id')";
					mysqli_query($dbcon,$saveitem);
					// echo "INSERT into folders (user_id,user_name,folder_name,department,publicity,shared_id) VALUE ('$user_id','$user_name','$folder_name','$department','$publicity','".$_SESSION['id']."')";
					echo "<script>alert('Successfully Shared!')</script>";					
					echo"<script>window.open('folder_detail','_self')</script>";
					//to get the current inserted folder id
					$sql_query = "SELECT * from folders WHERE folder_name='$folder_name' and publicity='$publicity'";
					$referralCount = mysqli_query($dbcon,$sql_query);
					$referral = mysqli_fetch_array($referralCount);
					$id = $referral['id'];
					
					//FOLDERS
					//Copy and paste the child folders for the specified user "publicity"
					$query=mysqli_query($dbcon,"SELECT * from folders WHERE parent_id = $parent_id");
					while($row=mysqli_fetch_array($query))
					{
						$user_id = $row['user_id'];
						$user_name = $row['user_name'];
						$department = $row['department'];
						$folder_name = $row['folder_name'];
						$publicity = $_POST['access_name'];

					$copyitem="INSERT into folders (user_id,user_name,folder_name,department,parent_id,publicity,shared_id) VALUE ('$user_id','$user_name','$folder_name','$department','$id','$publicity','$shared_id')";
					mysqli_query($dbcon,$copyitem);
					///echo "INSERT into folders (user_id,user_name,folder_name,department,parent_id,publicity,shared_id) VALUE ('$user_id','$user_name','$folder_name','$department','$id','$publicity','$shared_id')";
				} 
				
				//FILES
				//Copy and paste the child files for the specified user "publicity"
				$query=mysqli_query($dbcon,"SELECT * from files WHERE folder_id = $parent_id");

				while($row=mysqli_fetch_array($query))
				{
					$name = $row['name'];
					$user_id = $row['user_id'];
					$user_name = $row['user_name'];
					$department = $row['department'];
					$size = $row['size'];					
					$file_type = $row['file_type'];
					$publicity = $_POST['access_name'];
					
				$copyfile="INSERT into files (name,user_id,user_name,folder_id,department,file_type,size,publicity,shared_id) VALUE ('$name','$user_id','$user_name','$id','$department','$file_type','$size','$publicity','$shared_id')";
				mysqli_query($dbcon,$copyfile);
				//echo "INSERT into files (name,user_id,user_name,folder_id,department,file_type,size,publicity,shared_id) VALUE ('$name','$user_id','$user_name','$id','$department','$file_type','$size','$publicity','$shared_id')";
			} 
	
}

// filetopublic
if(isset($_POST['filetopublic']))
{
    $name = $_POST['name'];
	$user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $department = $_POST['department'];
    $file_type = $_POST['file_type'];
    $parent_id = $_POST['parent_id'];
    $size = $_POST['size'];

    $publicity = 'Public';

	$shared_id = $_SESSION['id'];
	
    $check_item="SELECT * from files WHERE name='$name' and publicity='$publicity' ";
    $run_query=mysqli_query($dbcon,$check_item);
	$fetched_row=mysqli_fetch_array($run_query);


    if(mysqli_num_rows($run_query)>0)
    {
		echo "<script>alert('File already Shared Before')</script>";
		echo"<script>window.open('folder_detail','_self')</script>";
		exit();
	}
					//Insert the copy of the targeted file to the "Publicity"
					$saveitem="INSERT into files (name,user_id,user_name,department,file_type,size,publicity,shared_id) VALUE ('$name','$user_id','$user_name','$department','$file_type','$size','$publicity','$shared_id')";
					mysqli_query($dbcon,$saveitem);
					echo "<script>alert('Successfully Shared!')</script>";
					echo"<script>window.open('folder_detail','_self')</script>";

					
	
}

// filetoindividual
if(isset($_POST['filetoindividual']))
{
    $name = $_POST['name'];
	$user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $department = $_POST['department'];
    $file_type = $_POST['file_type'];
    $parent_id = $_POST['parent_id'];
    $size = $_POST['size'];

    $publicity = $_POST['sharename'];

	$shared_id = $_SESSION['id'];
	
    $check_item="SELECT * from files WHERE name='$name' and publicity='$publicity' ";
    $run_query=mysqli_query($dbcon,$check_item);
	$fetched_row=mysqli_fetch_array($run_query);


    if(mysqli_num_rows($run_query)>0)
    {
		echo "<script>alert('File already Shared Before')</script>";
		echo"<script>window.open('folder_detail','_self')</script>";
		exit();
	}
					//Insert the copy of the targeted file to the targeted "Employee/Id"
					$saveitem="INSERT into files (name,user_id,user_name,department,file_type,size,publicity,shared_id) VALUE ('$name','$user_id','$user_name','$department','$file_type','$size','$publicity','$shared_id')";
					mysqli_query($dbcon,$saveitem);
					echo "<script>alert('Successfully Shared!')</script>";
					echo"<script>window.open('folder_detail','_self')</script>";
				
	
}
// filetogroup
if(isset($_POST['filetogroup']))
{
    $name = $_POST['name'];
	$user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $department = $_POST['department'];
    $file_type = $_POST['file_type'];
    $parent_id = $_POST['parent_id'];
    $size = $_POST['size'];

    $publicity = $_POST['access_name'];

	$shared_id = $_SESSION['id'];
	
    $check_item="SELECT * from files WHERE name='$name' and publicity='$publicity' ";
    $run_query=mysqli_query($dbcon,$check_item);
	$fetched_row=mysqli_fetch_array($run_query);


    if(mysqli_num_rows($run_query)>0)
    {
		echo "<script>alert('File already Shared Before')</script>";
		echo"<script>window.open('folder_detail','_self')</script>";
		exit();
	}
					//Insert the copy of the targeted file to the targeted group "Publicity"
					$saveitem="INSERT into files (name,user_id,user_name,department,file_type,size,publicity,shared_id) VALUE ('$name','$user_id','$user_name','$department','$file_type','$size','$publicity','$shared_id')";
					mysqli_query($dbcon,$saveitem);
					echo "<script>alert('Successfully Shared!')</script>";
					echo"<script>window.open('folder_detail.php','_self')</script>";
				
	
}
?>









