	<!--
		Developer: Tekletsadik Tadesse
        Mobile : +251967267539
        Address : Addiss Ababa, Ethiopia
            -->

<?php
session_start();

if(!$_SESSION['id'])
{

   header("Location: ../index");
}

    include("connection/db_conection.php");
    $query1 = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
    $result1 = mysqli_query($dbcon, $query1);
    $row1 = mysqli_fetch_assoc($result1);
    
    //'".$_SESSION['id']."' = $_SESSION['id'];
    $folder_parent = isset($_GET['id'])? $_GET['id'] : 0;
    $folders = $dbcon->query("SELECT * FROM folders where shared_id != '".$_SESSION['id']."' and shared_id = $folder_parent and publicity ='Public'and user_id !='".$_SESSION['id']."' or parent_id = $folder_parent and shared_id != '".$_SESSION['id']."' and user_id = '".$_SESSION['id']."' OR publicity= 'public' and parent_id = $folder_parent and shared_id != '".$_SESSION['id']."' OR publicity= '".$row1['department']."' and parent_id = $folder_parent and shared_id != '".$_SESSION['id']."' or publicity= '".$_SESSION['id']."' and parent_id = $folder_parent and shared_id != '".$_SESSION['id']."' order by id desc");
    $files = $dbcon->query("SELECT * FROM files where shared_id != '".$_SESSION['id']."' and shared_id = $folder_parent and publicity ='Public' and user_id !='".$_SESSION['id']."' or folder_id = $folder_parent and shared_id != '".$_SESSION['id']."' and user_id = '".$_SESSION['id']."' OR publicity= 'public' and folder_id = $folder_parent and shared_id != '".$_SESSION['id']."' OR publicity= '".$row1['department']."' and folder_id = $folder_parent and shared_id != '".$_SESSION['id']."' or publicity= '".$_SESSION['id']."' and folder_id = $folder_parent and shared_id != '".$_SESSION['id']."' order by id desc");
// echo "SELECT * FROM folders where parent_id = $folder_parent and user_id = '".$_SESSION['id']."'  order by folder_name asc";
// $folders = $dbcon->query("SELECT * FROM folders where parent_id = $folder_parent order by id asc");
//             $files = $dbcon->query("SELECT * FROM files where folder_id = $folder_parent   order by id asc");

require_once 'connection/config.php';
	
   //To Delete the folder
	if(isset($_GET['delete_id']))
	{
		
		
		$stmt_select = $DB_con->prepare('SELECT folder_name FROM folders WHERE id =:id');
		$stmt_select->execute(array(':id'=>$_GET['delete_id']));
	
		$check_itemf="SELECT * from folders WHERE id = '".$_GET['delete_id']."'";
        $run_queryf=mysqli_query($dbcon,$check_itemf);
        $delete_f=mysqli_fetch_array($run_queryf);
		$ownerfo = $delete_f['user_id'];
		
		if($ownerfo == $_SESSION['id'])
		{
		$stmt_delete = $DB_con->prepare('DELETE FROM folders WHERE id =:id');
		$stmt_delete->bindParam(':id',$_GET['delete_id']);
		$stmt_delete->execute();

        echo "<script>alert('Deleted Successfully!')</script>";

		if($folder_paren>=0){
		header("Location: folder_detail?id=$folder_parent");
		}
		else{
			header("Location: folder_detail");
		}
		}
		else {
			echo '<script>alert("Sorry. \n This is not your FOLDER." )</script>';

		}
	}
    //To delete the file
    if(isset($_GET['fdelete_id']))
	{
		
		$stmt_select = $DB_con->prepare('SELECT name FROM files WHERE id =:id');
		$stmt_select->execute(array(':id'=>$_GET['fdelete_id']));
		
		$check_item="SELECT * from files WHERE id = '".$_GET['fdelete_id']."'";
        $run_query=mysqli_query($dbcon,$check_item);
        $delete_row=mysqli_fetch_array($run_query);
		$ownerfi = $delete_row['user_id'];
		if($ownerfi == $_SESSION['id'])
		{
		$stmt_delete = $DB_con->prepare('DELETE FROM files WHERE id =:id');
		$stmt_delete->bindParam(':id',$_GET['fdelete_id']);
		$stmt_delete->execute();

        echo "<script>alert('Deleted Successfully!')</script>";

		if($folder_paren>=0){
		header("Location: folder_detail?id=$folder_parent");
		}
		else{
			header("Location: folder_detail");
		}
		}
		else{
			 echo '<script>alert("Sorry. \n This is not your FILE." )</script>';
			
			//header("Location: folder_detail?id=$folder_parent");

		}
	}
    
    // $sql = mysqli_query($dbcon,"SELECT name from users where username = '".$_SESSION['username']."'");
    $query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
    // Execute the query
    $result = mysqli_query($dbcon, $query);
    if ($result) {
        // Fetch the result row
        $row = mysqli_fetch_assoc($result);
    
        // Get the value of the column
        $columnValue = $row['name'];
        $dept = $row['department'];
    
        // Get the first letter from the column value
        $firstLetter = substr($columnValue, 0, 1);
    
        // Output the first letter
        // echo "First letter: " . $firstLetter;
    } else {
        // Handle the query error
        echo "Error executing the query: " . mysqli_error($con);
    }
    
    // Close the database connection
    // mysqli_close($dbcon);    
    $sql_query = "SELECT count(*) FROM files where user_id='".$row['id']."'";
    $referralCount = mysqli_query($dbcon,$sql_query);
    $referral = mysqli_fetch_array($referralCount);
    $total = $referral[0];

    $sql_query2 = "SELECT count(*) FROM files";
    $referralCount2 = mysqli_query($dbcon,$sql_query2);
    $referral2 = mysqli_fetch_array($referralCount2);
    $total2 = $referral2[0];

    $sql_query3 = "SELECT SUM(download) FROM files";
    $referralCount3 = mysqli_query($dbcon,$sql_query3);
    $referral3 = mysqli_fetch_array($referralCount3);
    $totaldownloads = $referral3[0];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Droga's DMS</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="assets/images/favicon2.png" />

          <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

      
      <link rel="stylesheet" href="assets/css/backend-plugin.min.css">
      <!-- <link rel="stylesheet" href="assets/css/backend.css?v=1.0.0"> -->

      <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="assets/vendor/remixicon/fonts/remixicon.css">
      
      <!-- Viewer Plugin -->
        <!--PDF-->
        <link rel="stylesheet" href="assets/vendor/doc-viewer/include/pdf/pdf.viewer.css">
        <!--Docs-->
        <!--PPTX-->
        <link rel="stylesheet" href="assets/vendor/doc-viewer/include/PPTXjs/css/pptxjs.css">
        <link rel="stylesheet" href="assets/vendor/doc-viewer/include/PPTXjs/css/nv.d3.min.css">
        <!--All Spreadsheet -->
        <link rel="stylesheet" href="assets/vendor/doc-viewer/include/SheetJS/handsontable.full.min.css">
        <!--Image viewer-->
        <link rel="stylesheet" href="assets/vendor/doc-viewer/include/verySimpleImageViewer/css/jquery.verySimpleImageViewer.css">
        <!--officeToHtml-->
        <link rel="stylesheet" href="assets/vendor/doc-viewer/include/officeToHtml/officeToHtml.css">  
        <style>
	.folder-item{
		cursor: pointer;
		
		
	}
	.folder-item:hover{
		background: #eaeaea;
	    color: black;
	    box-shadow: 3px 3px #.
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
}
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
.file-item{
	cursor: pointer;
}
a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}
table th,td{
	/*border-left:1px solid gray;*/
}
a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
}

</style>
<style id="compiled-css" type="text/css">

.sub1, .sub2 { display: none; }
:checked ~ .sub1, :checked ~ .sub2 {
   display: block;
   margin-left: 40px;
}


      </style> 
    </head>
  <body class="  ">
   
    <div class="wrapper">
      
    <div class="iq-sidebar  sidebar-default " style="background:black">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between" style="color:#fff200">
              <a href="index" class="header-logo">
                  <img src="assets/images/favicon.png" class="img-fluid rounded-normal light-logo" alt="logo">
               </a>
              <div class="iq-menu-bt-sidebar">
                  <i class="las la-bars wrapper-menu" ></i>
              </div>
          </div>
		  
          <div class="data-scrollbar" data-scroll="1" style="color:#fff200">
                <div class="new-create select-dropdown input-prepend input-append" style="color:#fff200">
                
            </div>
			  
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu" >
                 
                       <li class="active">
                              <a style="color:#fff200" href="index" class="">
                                  <i class="las la-home iq-arrow-left"></i><span>Home</span>
                              </a>
                          <ul id="dashboard" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          </ul>
                       </li>

                       <li class=" ">
                          <a style="color:#fff200" href="#mydrive" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <i class="las la-hdd"></i><span>My Folders</span>
                              <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                              <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                          </a>

                          <ul id="mydrive" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                            <?php 
                                $foldernav = $dbcon->query("SELECT * FROM folders where shared_id != '".$_SESSION['id']."' and shared_id = $folder_parent and publicity ='Public'and user_id !='".$_SESSION['id']."' or parent_id = $folder_parent and shared_id != '".$_SESSION['id']."' and user_id = '".$_SESSION['id']."' OR publicity= 'public' and parent_id = $folder_parent and shared_id != '".$_SESSION['id']."' OR publicity= '".$row1['department']."' and parent_id = $folder_parent and shared_id != '".$_SESSION['id']."' or publicity= '".$_SESSION['id']."' and parent_id = $folder_parent and shared_id != '".$_SESSION['id']."' order by folder_name asc");

                                    while($rownav=$foldernav->fetch_assoc()):
                                    ?> 

                                    <li class=" " data-id="<?php echo $rownav['id'] ?>">
                                          <a style="color:#fff200" href="folder_detail.php?id=<?php echo $rownav['id'] ?>">
                                          <image src ="assets/images/left.png">&nbsp;&nbsp;<span><?php echo $rownav['folder_name'] ?></span></image>
                                          </a>
                                  </li>
                                                                               
                                    <?php endwhile; ?>
                          </ul>

                       </li>
                       <li class=" ">
                              <a style="color:#fff200" href="files" class="">
                                  <i class="lar la-file-alt iq-arrow-left"></i><span>My Files</span>
                              </a>
                          <ul id="page-files" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          </ul>
                       </li>
					   <!--
                       <li class=" ">
                              <a style="color:black" href="recent" class="">
                                  <i class="las la-stopwatch iq-arrow-left"></i><span>Recent </span>
                              </a>
                          <ul id="page-folders" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          </ul>
                       </li>
					   --
                       <li class=" ">
                              <a style="color:#fff200" href="archive" class="">
                                  <i class="las la-archive iq-arrow-left"></i><span>Archive </span>
                              </a>
                          <ul id="page-folders" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          </ul>
                       </li>
                      <!-- <li class=" ">
                              <a style="color:black" href="favourite" class="">
                                  <i class="lar la-star"></i><span>Favourite</span>
                              </a>
                          <ul id="page-fevourite" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          </ul>
                       </li>-->
                    
                       <?php if ($row['type'] == 'Admin' || $row['type'] == 'Team Manager' || $row['department']=='HRM' || $row['type']=='CEO' || $row['type']=='CEO Deputy') 
                       {?>
                       <li class=" ">
                          <a style="color:#fff200" href="#employee" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <i class="lab la-wpforms iq-arrow-left"></i><span>Employee Profile</span>
                              <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                              <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                          </a>
                          <ul id="employee" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          
                            <?php if ($row['type'] == 'Admin' || $row['department']=='HRM') 
                                {?>        
                                <li class=" " >
                                    <a style="color:#fff200" href="employee-add">
                                        <i class="las la-id-card"></i><span>Add Employee</span>
                                    </a>                                     
                                  </li>
                            <?php } ?>
                                  
                                  <li class=" " style="color:#fff200">
                                       <a style="color:#fff200"href="employee-list">
                                            <i class="las la-list-alt"></i><span>Employee List</span>
                                        </a>
                                  </li>

                          </ul>
                       </li>
                       
                       <?php if ($row['type'] == 'Admin' || $row['department'] == 'HRM' || $row['type'] =='CEO' || $row['type'] == 'CEO Deputy') 
                       {?>
                       <li class=" ">
                              <a style="color:#fff200" href="department" class="">
                                  <i class="las la-archive iq-arrow-left"></i><span>Manage Department </span>
                              </a>
                          <ul id="page-folders" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          </ul>
                       </li>

                        <?php } } ?>
                  </ul>
              </nav>

              <?php
                $dept= $row['department'];
                $qqq = "SELECT * from department WHERE dept_name = '$dept'";
                $sizesum = mysqli_query($dbcon,$qqq);
                $sumsize = mysqli_fetch_array($sizesum);
                $totalgiven = $sumsize['disksize_given'];
                $used = $sumsize['disk_used'];

                $freeSpace = $totalgiven - $used;
                $percentageUsed = ($used / $totalgiven) * 100;

                // Convert bytes to GB
                function formatSizeInGB($size)
                {
                    $sizeInGB = $size / 1024 / 1024 / 1024;
                    return round($sizeInGB, 2) . ' GB';
                }
                ?>
              <div class="sidebar-bottom">
                
                  <h4 class="mb-3" style="color:#fff200"><i class="las la-cloud mr-2"></i>Storage</h4>
                  <p><?php echo $dept ?>: Department <br>Free Space:  <?php echo formatSizeInGB($freeSpace) ?></p>
                  <div class="iq-progress-bar mb-3" >
                      <span class="bg-red" data-percent=<?php echo round($percentageUsed, 2)?>>
                      </span>
                  </div>
                  <p> <?php echo formatSizeInGB($used)?> of <?php echo formatSizeInGB($totalgiven)?> Used</p>
                  <!--<a href="#" class="btn btn-outline view-more mt-4" style="background:#fff200;color:black;">Extend Storage</a>-->
              </div>
              <div class="p-3"></div>
          </div>
          </div>       
          <div class="iq-top-navbar" style="background:#000000">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
              <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                  <i class="ri-menu-line wrapper-menu"></i>
                  <a href="index" class="header-logo">
                      <img src="assets/images/logo.png" class="img-fluid rounded-normal light-logo" alt="logo">
                  </a>
              </div>

<!-- /.search-area -->
                 <!-- //Search -->
                <div class="iq-search-bar device-search">   
				<form class="form-inline" method="post" action="search_results.php">                          
					<div class="input-prepend input-append">
                              <div class="btn-group">
                                  <input class="dropdown-toggle search-query text search-input" type="text" name="file" placeholder="Search file..." required><span class="search-replace"></span>
                                 
								 <input type="submit" value="Go">
								 <a class="search-link" href="#"><i class="ri-search-line"></i></a>								  
                              </div>
                          </div>
                      </form>
                </div>
      <!--<form class="form-inline" method="post" action="search_result.php">
							<input type="text" name="name" class="form-control" placeholder="Search file..">
							<input type="submit" value="name">
						  </form>-->
						  
	<!--<form method="post" action="search_result.php">
      <input type="text" name="name" placeholder="Search..." required>
      <input type="submit" value="Search">
    </form>-->
	
                  <div class="d-flex align-items-center" >
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                      <i class="ri-menu-3-line"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav ml-auto navbar-list align-items-center">
                          <li class="nav-item nav-icon search-content">
                              <a style="color:#fff200" href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ri-search-line" style="color:#fff200"></i>
                              </a>
                              <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                  <form action="#" class="searchbox p-2">
                                      <div class="form-group mb-0 position-relative">
                                      <input type="text" class="text search-input font-size-12" placeholder="type here to search...">
                                      <a href="#" class="search-link"><i class="las la-search" style="color:#fff200"></i></a> 
                                      </div>
                                  </form>
                              </div>
                          </li> 
                          <li class="nav-item nav-icon dropdown".>
                              <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="ri-question-line" style="color:#fff200"></i>
                              </a>
                              <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton01">
                                  <div class="card shadow-none m-0">
                                      <div class="card-body p-0 ">
                                          <div class="p-3" style="background:#fff200">
                                              <a style="color:black" href="#" class="iq-sub-card pt-0"><i class="ri-questionnaire-line"></i>Help</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="nav-item nav-icon dropdown"> 
                              <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                              <i class="ri-settings-3-line" style="color:#fff200"></i>
                              </a>
                              <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton02">
                                  <div class="card shadow-none m-0">
                                      <div class="card-body p-0 ">
                                          <div class="p-3" style="background:#fff200">
                                              <a style="color:#000000" href="#" class="iq-sub-card pt-0"><i class="ri-settings-3-line"></i> Settings</a>
											  <div class="profile-details mt-4 pt-4">
                                                  <div class="media align-items-center mb-3">
                                                     <?php if($row['type'] == 'Admin'){?>
                                                      <div class="media-body ml-3">
                                                          <div class="media justify-content-between">
                                                          <h5><a href="employee-edit?edit_id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></h5>
                                                          </div>
                                                      </div>  
                                                        <?php } ?>
                                                      <div class="media-body ml-3">
                                                          <div class="media justify-content-between">
                                                          <h5><a href="change_pwd?change_pwd=<?php echo $_SESSION['id']; ?>">Change Password</a></h5>
                                                          </div>
                                                      </div>                                                
                                                  </div>
                                                  
                                              </div>
                                          </div>                                
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="nav-item nav-icon dropdown caption-content" >
                              <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                  <div class="caption bg- line-height" style="background:#fff200;color"><b><?php echo $firstLetter; ?></b></div>
                              </a>
                              <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton03" >
                                  <div class="card mb-0" style="background:#fff200">
                                      <div class="card-header d-flex justify-content-between align-items-center mb-0">
                                      <div class="header-title">
                                          <h4 class="card-title mb-0">Profile</h4>
                                      </div>
                                      <div class="close-data text-right badge badge- cursor-pointer " style="background:black"><i class="ri-close-fill" style="color:#fff200"></i></div>
                                      </div>
                                      <div class="card-body">
                                          <div class="profile-header">
                                              <div class="cover-container text-center" style="color:#000000">
                                                  <div class="rounded-circle profile-icon bg- mx-auto d-block" style="background:black">
													<b style="color:white"><?php echo $firstLetter; ?>   </b>                                                
                                                   
                                                  </div>
                                                  <div class="profile-detail mt-3">
                                                  <h5><a href="#"><?php echo $row['name']; ?></a></h5>
                                                  <p><?php echo $row['id']; ?></p>
                                                  </div>
                                                  <a href="logout" class="btn btn-" style="background:#000000;color:white;">Sign Out</a>
                                              </div>
                                              <!--<div class="profile-details mt-4 pt-4 border-top">
                                                   <div class="media align-items-center mb-3">
                                                     <?php if($row['type'] == 'Admin'){?>
                                                      <div class="media-body ml-3">
                                                          <div class="media justify-content-between">
                                                          <h5><a href="employee-edit?edit_id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></h5>
                                                          </div>
                                                      </div>  
                                                        <?php } ?>
                                                      <div class="media-body ml-3">
                                                          <div class="media justify-content-between">
                                                          <h5><a href="change_pwd?change_pwd=<?php echo $_SESSION['id']; ?>">Change Password</a></h5>
                                                          </div>
                                                      </div>                                                
                                                  </div>
                                                  
                                              </div>-->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          </ul>                     
                      </div> 
                  </div>
              </nav>
          </div>
      </div>
      
      <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-transparent card-block card-stretch card-height mb-3">
                        <div class="d-flex justify-content-between">                             
                            <div class="select-dropdown input-prepend input-append">
                                <div class="btn-group">
                                <div class="card-body" id="paths">                                   
                                     <?php 
                                        $id=$folder_parent;
                                        while($id > 0){

                                            $path = $dbcon->query("SELECT * FROM folders where id = $id  order by folder_name asc")->fetch_array();
                                            echo '<script>
                                                $("#paths").prepend("<b><a href=\"folder_detail.php?id='.$path['id'].'\">'.$path['folder_name'].'</a>></b>")
                                            </script>';
                                            $id = $path['parent_id'];

                                        }
                                        echo '<script>
                                                $("#paths").prepend("<a href=\"folder_detail.php?page=files\"><b>My Files</b></a><b>></b>")
                                            </script>';
                                        ?>

                                    <span class="caret"><!--icon--></span>
                                    </div>
                                   
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
                

                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-transparent">
                         <div class="new-create select-dropdown input-prepend input-append" style="color:#fff200">
                  <div class="btn-group">
                      <div data-toggle="dropdown">
                      <div style="background-color:#fff200;color:black;cursor:pointer;" class="search-query selet-caption"><i class="las la-plus pr-2"></i>Create New</div><span class="search-repblace"></span>
                      <span class="caret"><!--icon--></span>
                      </div>
                      <ul class="dropdown-menu">
                          <li><div data-toggle="modal" class="item" style="color:#000000;cursor:pointer;" data-target="#newfolder"  ><i class="ri-folder-add-line pr-3" style="color:#fff200"></i>New Folder</div></li>
                          <li><div data-toggle="modal" class="item" style="color:#000000;cursor:pointer;" data-target="#newfile" ><i class="ri-folder-add-line pr-3" style="color:#fff200"></i>Upload Files</div></li>
                      </ul>
                  </div>
            </div>
                    </div>
                </div>

        <!-- //Folders -->
        <?php 
                

                while($row=$folders->fetch_assoc()):
                   
                ?> 		
    
                    <div class="col-md-6 col-sm-6 col-lg-3" data-id="<?php echo $row['id'] ?>">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">                            
                                    <div class="d-flex justify-content-between" >
                                        <a href="folder_detail.php?id=<?php echo $row['id'] ?>" class="folder">
                                            <image src ="assets/images/folder-i.png">&nbsp;&nbsp;<h7 style = "color:black"><?php echo $row['folder_name'] ?></h7></image>
                                        <!-- <li><div data-toggle="modal" class="item" data-target="#newfolder" ><i class="ri-folder-add-line pr-3"></i>New Folder</div></li> -->
                   
                                        </a>
                                        <div class="card-header-toolbar">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown">
                                                    <i class="ri-more-2-fill"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                                                    <a href ="share.php?share_id=<?php echo $row['id']; ?>" class="dropdown-item /btn btn-sucess"><i class="ri-share-fill mr-2"></i> Share </a>

                                                    <!-- <a data-toggle="modal" data-target="#sharing" data-id="<?= $row['id']; ?>"class="dropdown-item"><i class="ri-share-fill mr-2"></i>Share</a> -->
                                                    <!-- <a class="dropdown-item " href="#"><i class="ri-pencil-fill mr-2"></i>Rename</a> -->
                                                    <!--<a class="dropdown-item" href="#modalRename?id=<?php echo $row['id'];?>"><i class="ri-pencil-fill mr-2" data-toggle="modal" data-target="#modalRename"></i> Rename</a>-->
                                                    <a class="dropdown-item" href="?delete_id=<?php echo $row['id']; ?>" title="click for delete" onclick="return confirm('Are you sure to remove this folder?')"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                                   <!-- <a class="dropdown-item" href="#"><i class="lar la-star mr-2"></i>Add to Favorite</a>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="./page-alexa.php" class="folder">
                                        <!-- <h5 class="mb-2"><?php echo $row['folder_name'] ?></h5> -->
                                        <!-- <p class="mb-2"><i class="lar la-clock text-green mr-2 font-size-20"></i> <?php echo $row['created_date']?></p> -->
                                        <!-- <p class="mb-0"><i class="las la-file-alt text-green mr-2 font-size-20"></i> <?php echo $total;?> Files</p> -->
                                    </a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?> 

                    
		<div class="col-lg-12">
      
		<!-- <div class="row">
			<?php 
			while($row=$folders->fetch_assoc()):
			?> 
				<div class="card col-md-3 mt-2 ml-2 mr-2 mb-2 folder-item" data-id="<?php echo $row['id'] ?>">
					<div class="card-body">
							<large><span><img src ="assets/images/folder-i.png"></i></span><b class="to_folder"> <?php echo $row['folder_name'] ?></b></large>
					</div>
				</div>
				
			<?php endwhile; ?>
		</div> -->
		
        <!-- Files -->

            <div class="card-header d-flex justify-content-between" style="background:#fff200;color:black;">
                                <div class="header-title">
                                    <h4 class="card-title">All Files</h4>
                                </div>
                                <div class="card-header-toolbar d-flex align-items-center">
                                    <a href="files.php" class=" view-more" style="color:black">View All</a>
                                </div>
                            </div>
                            
        <div class="row">
			<div class="card col-md-12">
				<div class="card-body">
                <table class="table mb-0 table-borderless tbl-server-info">
						<tr>
                        <th scope="col">File Name</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Last Update</th>
                                        <th scope="col">Size</th>
                                        <th scope="col"></th>
						</tr>
						<?php 
					while($row=$files->fetch_assoc()):
						$name = explode(' ||',$row['name']);
						$name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type'] : $name[0] .".".$row['file_type'];
						$img_arr = array('png','jpg','jpeg','gif','psd','tif');
						$doc_arr =array('doc','docx');
						$pdf_arr =array('pdf','ps','eps','prn');
						$icon ='fa-file';
						if(in_array(strtolower($row['file_type']),$img_arr))
							$icon ='fa-image';
						if(in_array(strtolower($row['file_type']),$doc_arr))
							$icon ='fa-file-word';
						if(in_array(strtolower($row['file_type']),$pdf_arr))
							$icon ='fa-file-pdf';
						if(in_array(strtolower($row['file_type']),['xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr']))
							$icon ='fa-file-excel';
						if(in_array(strtolower($row['file_type']),['zip','rar','tar']))
							$icon ='fa-file-archive';

                            $fileNameNoExtension= pathinfo($name)['filename'];
                            // $fileExtension=pathinfo($name,'extension');
                            // echo $fileNameNoExtension;
                            $extension = pathinfo($name, PATHINFO_EXTENSION);
                            // echo $extension;

                                        $department = $row['department'];
                                        $created_date = $row['date_updated'];
                                        $size = $row['size'];
                                        $user_name = $row['user_name'];
                                        
								
							  $check_user="SELECT * from users WHERE id = '".$_SESSION['id']."'";			
                              $result1 = mysqli_query($dbcon, $check_user);
                              $userfilter = mysqli_fetch_assoc($result1);
                              $userdept = $userfilter['department'];
							  
							  if($row['publicity'] == 'public' || $row['publicity'] == $userdept || $row['publicity'] == $_SESSION['id']){
								  $userdept = $row['department'];
							  }
	
							//SELECT the folder of that we clicked
							  //$check_folder="SELECT * from files WHERE id = '$folder_id'";
							  //$res=$dbcon->query($check_folder);
							  
                              //$result2 = mysqli_query($dbcon, $check_folder);
                              //$folderfilter = mysqli_fetch_assoc($result2);
                              //$currentfolder = $folderfilter['folder_name'];
							  
										//$fileip = "10.10.10.18";
										//$filedrive = "B:\\Ungrouped_all_files$";
										//$destination = '../../Grouped_All_Files/'.$userdept;

					?>
					
						<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
							<td>
                            <div class="d-flex align-items-center">
                                                <div class="icon-small bg- rounded mr-3" style="background:#fff200;color:black;">
												      <div data-load-file="file" data-load-target="#resolte-contaniner" data-url="../Grouped_All_Files/<?php echo $userdept ?>/<?php echo $name; ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $name; ?>" style="cursor: pointer;"><i class="ri-file-pdf-line"></i></div>

                                                </div>
												<!--<div data-load-file="file" data-load-target="#resolte-contaniner" data-url="\\\\$fileip\\$filedrive\\Ungrouped_all_files\\<?php echo $name; ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $name; ?>" style="cursor: pointer;"><?php echo $fileNameNoExtension; ?></div>
-->
                                                <div data-load-file="file" data-load-target="#resolte-contaniner" data-url="../Grouped_All_Files/<?php echo $userdept ?>/<?php echo $name; ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $name; ?>" style="cursor: pointer;"><?php echo $fileNameNoExtension; ?></div>
                                            </div>
                                        </td>
                                        
                                        <td><div class="d-flex align-items-center">
                                                <div data-load-file="file" data-load-target="#resolte-contaniner" data-url="../Grouped_All_Files/<?php echo $userdept ?>/<?php echo $name; ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $name; ?>" style="cursor: pointer;"><?php echo $user_name; ?></div>
                                            </div></td>
                                            <td><div class="d-flex align-items-center">
                                                <div data-load-file="file" data-load-target="#resolte-contaniner" data-url="../Grouped_All_Files/<?php echo $userdept ?>/<?php echo $name; ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $name; ?>" style="cursor: pointer;"><?php echo $department; ?></div>
                                            </div></td>
                                            <td><div class="d-flex align-items-center">
                                                <div data-load-file="file" data-load-target="#resolte-contaniner" data-url="../Grouped_All_Files/<?php echo $userdept ?>/<?php echo $name; ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $name; ?>" style="cursor: pointer;"><?php echo $created_date; ?></div>
                                            </div></td>
                                            <td><div class="d-flex align-items-center">
                                                <div data-load-file="file" data-load-target="#resolte-contaniner" data-url="../Grouped_All_Files/<?php echo $userdept ?>/<?php echo $name; ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $name; ?>" style="cursor: pointer;"><?php echo $size; ?></div>
                                            </div></td>
                                        <td>
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton6" data-toggle="dropdown">
                                                    <i class="ri-more-fill"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                                                     <a href ="sharefile.php?sharef_id=<?php echo $row['id']; ?>" class="dropdown-item /btn btn-success"><i class="ri-share-fill mr-2"></i> Share </a>
                                                     <!-- <a class="dropdown-item" href="#"><i class="ri-share-fill mr-2"></i>Share</a> -->
													 <!-- If file type is word,excel,ppt-->
                                                     <a class="dropdown-item" href="edit.php?id=<?php echo $row['id']; ?>"><i class="ri-pencil-fill mr-2"></i>Edit</a>
													 
                                                     <a class="dropdown-item" href="?fdelete_id=<?php echo $row['id']; ?>" title="click for delete" onclick="return confirm('Are you sure to remove this file?')"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                                     <a class="dropdown-item " href="downloads.php?file_id=<?php echo $row['id']; ?>" title="Download Files"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                                     
													 <!-- <a class="dropdown-item " href='downloads.php?file_id=<?php echo $row['id']; ?>' title="Download Files">Download</a> -->

                                                     <!--<a class="dropdown-item" href="#"><i class="lar la-star mr-2"></i>Add to favorite</a>-->

                                                </div>
                                            </div>
                                        </td>
						</tr>
							
					<?php endwhile; ?>
					</table>
					<br><br>
				</div>
			</div>			
		</div>
       
        </div>
        </div>
            
                </div>

   
            </div>
        </div>
      </div>
    </div>
    
    <!-- Wrapper End-->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a>DROGA Groups</a></li>
                        <li class="list-inline-item"><a >"Serving the people"</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    <span class="mr-1"><script>document.write(new Date().getFullYear())</script> &copy</span> <a style="color: green;" href="#" class="">Droga Groups</a>.
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="assets/js/backend-bundle.min.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="assets/js/customizer.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="assets/js/chart-custom.js"></script>
    
    <!--PDF-->
    <script src="assets/vendor/doc-viewer/include/pdf/pdf.js"></script>
    <!--Docs-->
    <script src="assets/vendor/doc-viewer/include/docx/jszip-utils.js"></script>
    <script src="assets/vendor/doc-viewer/include/docx/mammoth.browser.min.js"></script>
    <!--PPTX-->
    <script src="assets/vendor/doc-viewer/include/PPTXjs/js/filereader.js"></script>
    <script src="assets/vendor/doc-viewer/include/PPTXjs/js/d3.min.js"></script>
    <script src="assets/vendor/doc-viewer/include/PPTXjs/js/nv.d3.min.js"></script>
    <script src="assets/vendor/doc-viewer/include/PPTXjs/js/pptxjs.js"></script>
    <script src="assets/vendor/doc-viewer/include/PPTXjs/js/divs2slides.js"></script>
    <!--All Spreadsheet -->
    <script src="assets/vendor/doc-viewer/include/SheetJS/handsontable.full.min.js"></script>
    <script src="assets/vendor/doc-viewer/include/SheetJS/xlsx.full.min.js"></script>
    <!--Image viewer-->
    <script src="assets/vendor/doc-viewer/include/verySimpleImageViewer/js/jquery.verySimpleImageViewer.js"></script>
    <!--officeToHtml-->
    <script src="assets/vendor/doc-viewer/include/officeToHtml/officeToHtml.js"></script>
    <script src="assets/js/doc-viewer.js"></script>
    <!-- app JavaScript -->
    <script src="assets/js/app.js"></script>
     <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Title</h4>
                    <div>
                        <a class="btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="resolte-contaniner" style="height: 500px;" class="overflow-auto">
                        File not found
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Create new folder at any drive-->
    <div class="modal fade" id="newfolder" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div style="color:black; background-color:#fff200" class="modal-content">
              <div class="modal-header">
                <h2 style="color:black" class="modal-title" id="myModalLabel">New folder</h2>
              </div>
              <div class="modal-body">
			  <form enctype="multipart/form-data" method="post" action="addfolder.php">
                   <fieldset>			
						
				   <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] :'' ?>">
				   <input type="hidden" name="parent_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
                   <input type="hidden" name="user_name" value="<?php echo isset($columnValue) ? $columnValue :'' ?>">
                   <input type="hidden" name="department" value="<?php echo isset($dept) ? $dept :'' ?>">


					<div class="form-group">						
						<label style="color:black" for="name" class="control-label">New Folder</label>
						<input type="text" name="folder_name" id="folder_name" placeholder="Untitled folder" value="<?php echo isset($meta['folder_name']) ? $meta['folder_name'] :'' ?>" class="form-control" required>
					</div>
                    
                        <!-- <label style="color:white"class="control-label" for="basicinput">Accessed by</label>
                            <div class="form-group">
                                <select name="access_name" class="form-control" required>
                                    <option value="">Select access</option> 
                                    <?php
                                     $query=mysqli_query($dbcon,"select * from access");
                                        while($row=mysqli_fetch_array($query))
                                        {?>

                                        <option value="<?php echo $row['access_name'];?>"><?php echo $row['access_name'];?></option>
                                    <?php } ?>
                                </select>
                            </div> -->
					        <div class="form-group" id="msg"></div>
							
					 </fieldset>
              </div>
              <div class="modal-footer"> 

                <button style = "color:white;background-color:black"class="btn btn- btn-md" name="folder_save">Create</button>   
				<button style = "color:white;background-color:red" type="button" class="btn btn- btn-md" data-dismiss="modal">Cancel</button>

			</form>
			
         </div>
    </div>
    </div>
    </div>
    <!-- Share folder/file-->
    <div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div style="color:white; background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <h2 style="color:white" class="modal-title" id="myModalLabel">Share to ""</h2>
              </div>
              <div class="modal-body">
			  <form enctype="multipart/form-data" method="post" action="addfolder.php">
                   <!-- <fieldset>			 -->
						
				   <!-- <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] :'' ?>">
				   <input type="hidden" name="parent_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
                   <input type="hidden" name="user_name" value="<?php echo isset($columnValue) ? $columnValue :'' ?>">
                   <input type="hidden" name="department" value="<?php echo isset($dept) ? $dept :'' ?>"> -->


					<!-- <div class="form-group">						
						<label style="color:white" for="name" class="control-label">New Folder</label>
						<input type="text" name="folder_name" id="folder_name" placeholder="Untitled folder" value="<?php echo isset($meta['folder_name']) ? $meta['folder_name'] :'' ?>" class="form-control" required>
					</div> -->
                    <form> 
                     <input type="hidden" name="share_id" id="share_id">
                            <div> 
                                <input type="radio" name="level0" value="A" id="A"> 
                                <label for="A">Share to public</label> 
                                
                            </div> 
                            <div> 
                                <input type="radio" name="level0" value="B" id="B"> 
                                <label for="B">Share to Individual</label> 
                                <div class="sub1">                                  
                                <!-- <input type="text" name="folder_name" id="folder_name" placeholder="Untitled folder" value="<?php echo isset($meta['folder_name']) ? $meta['folder_name'] :'' ?>" class="form-control" required> -->
                                <div class="form-group">
                                <select name="access_name" class="form-control" required>
                                    <option value="">add Person</option> 
                                    <?php
                                     $query=mysqli_query($dbcon,"select * from users");
                                        while($row=mysqli_fetch_array($query))
                                        {?>

                                        <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                                    <?php } ?>
                                </select>
                            </div>

                                </div> 
                            </div> 
                            <div> 
                                <input type="radio" name="level0" value="C" id="C"> 
                                <label for="C">Share to Department</label> 
                                <div class="sub1"> 
                                 
                                <!-- <label style="color:white"class="control-label" for="basicinput">Accessed by</label> -->
                                <div class="form-group">
                                <select name="access_name" class="form-control" required>
                                    <option value="">add group</option> 
                                    <?php
                                     $query=mysqli_query($dbcon,"select * from access order by id DESC");
                                        while($row=mysqli_fetch_array($query))
                                        {?>

                                        <option value="<?php echo $row['access_name'];?>"><?php echo $row['access_name'];?></option>
                                    <?php } ?>
                                </select>
                                
                                </div> 
                                </div> 
                            </div>                           
                        
					        <div class="form-group" id="msg"></div>
							
					 <!-- </fieldset> -->
              </div>
              <div class="modal-footer"> 

                <button style = "color:white;background-color:green"class="btn btn- btn-md" name="sharing">Share</button>   
				<button style = "color:white;background-color:red" type="button" class="btn btn- btn-md" data-dismiss="modal">Cancel</button>

			</form>
			
         </div>
    </div>
    </div>
    </div>
   <!-- Add new file -->
		<div class="modal fade" id="newfile" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div style="color:black;background-color:#fff200" class="modal-content">
              <div class="modal-header">
                <h2 style="color:black" class="modal-title" id="myModalLabel">Add new file</h2>
              </div>
              <div class="modal-body">
			  <form action="addfile.php" method="post" enctype="multipart/form-data" >
					<div class="col-md-11">
						<div class="md-form mb-0">
                            <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] :'' ?>">
                            <input type="hidden" name="parent_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
                            <input type="hidden" name="user_name" value="<?php echo isset($columnValue) ? $columnValue :'' ?>">
                            <input type="hidden" name="department" value="<?php echo isset($dept) ? $dept :'' ?>">

						</div>
						</div>
					<label style="color:black" for="subject" class="">Select your file</label>
					<input type="file" name="myfile" required="" class="form-control"> <br>
                    <!-- <label style="color:white"class="control-label" for="basicinput">Accessed by</label>
                            <div class="form-group">
                                <select name="access_name" class="form-control" required>
                                    <option value="">Select access</option> 
                                    <?php
                                    // include('db_conection.php');
                                     $query=mysqli_query($dbcon,"select * from access");
                                        while($row=mysqli_fetch_array($query))
                                        {?>

                                        <option value="<?php echo $row['access_name'];?>"><?php echo $row['access_name'];?></option>
                                    <?php } ?>
                                </select>
                            </div> -->
					<button  type="submit" class="btn btn- btn-rounded btn-block my-4 waves-effect z-depth-0" style="background:black;color:white;"  name="file_save" type="submit">UPLOAD</button>
					<footer style="font-size: 12px"><b>Current Supprted File Types:</b><font color="red"><i>.docx .pptx .xlsx .pdf</i></font></footer>
					</form>			
              </div>
            </div>
          </div>
        </div>



<script>
   
    $(document).ready(function() {
        $('#priceinput').keypress(function (event) {
            return isNumber(event, this)
        });
    });
  
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }    
</script>
<script src "js/fire.js"></script>


<script>
	
	$('#new_folder').click(function(){
		uni_modal('','manage_folder.php?id=<?php echo $folder_parent ?>')
	})
	$('#new_file').click(function(){
		uni_modal('','manage_files.php?id=<?php echo $folder_parent ?>')
	})
	$('.folder-item').dblclick(function(){
		location.href = 'folder_detail.php?id='+$(this).attr('data-id')
	})
	$('.folder-item').bind("contextmenu", function(event) { 
    event.preventDefault();
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu'></div>")
        custom.append($('#menu-folder-clone').html())
        custom.find('.edit').attr('data-id',$(this).attr('data-id'))
        custom.find('.delete').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

	$("div.custom-menu .edit").click(function(e){
		e.preventDefault()
		uni_modal('Rename Folder','addfolder.php?id=<?php echo $folder_parent ?>&id='+$(this).attr('data-id') )
	})
	$("div.custom-menu .delete").click(function(e){
		e.preventDefault()
		_conf("Are you sure to delete this Folder?",'delete_folder',[$(this).attr('data-id')])
	})
})

	//FILE
	$('.file-item').bind("contextmenu", function(event) { 
    event.preventDefault();

    $('.file-item').removeClass('active')
    $(this).addClass('active')
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.edit').attr('data-id',$(this).attr('data-id'))
        custom.find('.delete').attr('data-id',$(this).attr('data-id'))
        custom.find('.download').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

	$("div.file.custom-menu .edit").click(function(e){
		e.preventDefault()
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').siblings('large').hide();
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').show();
	})
	$("div.file.custom-menu .delete").click(function(e){
		e.preventDefault()
		_conf("Are you sure to delete this file?",'delete_file',[$(this).attr('data-id')])
	})
	$("div.file.custom-menu .download").click(function(e){
		e.preventDefault()
		window.open('download.php?id='+$(this).attr('data-id'))
	})

	$('.rename_file').keypress(function(e){
		var _this = $(this)
		if(e.which == 13){
			start_load()
			$.ajax({
				url:'ajax.php?action=file_rename',
				method:'POST',
				data:{id:$(this).attr('data-id'),name:$(this).val(),type:$(this).attr('data-type'),folder_id:'<?php echo $folder_parent ?>'},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp);
						if(resp.status== 1){
								_this.siblings('large').find('b').html(resp.new_name);
								end_load();
								_this.hide()
								_this.siblings('large').show()
						}
					}
				}
			})
		}
	})

})
//FILE


	$('.file-item').click(function(){
		if($(this).find('input.rename_file').is(':visible') == true)
    	return false;
		uni_modal($(this).attr('data-name'),'manage_files.php?<?php echo $folder_parent ?>&id='+$(this).attr('data-id'))
	})
	$(document).bind("click", function(event) {
    $("div.custom-menu").hide();
    $('#file-item').removeClass('active')

});
	$(document).keyup(function(e){

    if(e.keyCode === 27){
        $("div.custom-menu").hide();
    $('#file-item').removeClass('active')

    }

});
	$(document).ready(function(){
		$('#search').keyup(function(){
			var _f = $(this).val().toLowerCase()
			$('.to_folder').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('.card').toggle(true);
					else
					$(this).closest('.card').toggle(false);

				
			})
			$('.to_file').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('td').toggle(true);
					else
					$(this).closest('td').toggle(false);

				
			})
		})
	})
	function delete_folder($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_folder',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Folder successfully deleted.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}
	function delete_file($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_file',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Folder successfully deleted.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}

</script>
<script>
   new TomSelect("#select-state",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
  </script>
  <script>
   new TomSelect("#select-state2",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
  </script>
<script>
        $(document).ready(function () {

            $('.sharebtn').on('click', function () {

                $('#sharemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#share_id').val(data[0]);
                $('#folder_name').val(data[1]);
                
            });
        });
    </script>
  </body>
</html>