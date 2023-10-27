<?php 

require_once("connection/db_conection.php");

if (isset($_GET['file_id'])) {
  

$qry = $dbcon->query("SELECT * FROM files where id=".$_GET['file_id'])->fetch_array();

extract($_POST);
			/**$check_userr="SELECT * from users WHERE id = '".$_SESSION['id']."'";			
            $result1r = mysqli_query($dbcon, $check_userr);
            $userfilterr = mysqli_fetch_assoc($result1r);
            $userdept = $userfilterr['department'];
			if($qry['publicity'] == 'public' || $qry['publicity'] == $userdept || $qry['publicity'] == $_SESSION['id']){
				 $userdeptr = $qry['department'];
			}*/
		$fname=$qry['name']; 
        $ftype=$qry['file_type'];
		$dept=$qry['department'];
		
        $file = ('../Grouped_All_Files/'.$dept.'/'.$fname.'.'.$ftype);
       
       header ("Content-Type: ".filetype($file));
       header ("Content-Length: ".filesize($file));
       header ("Content-Disposition: attachment; filename=".$qry['name'].'.'.$qry['file_type']);

       readfile($file);        
        
		// Now update downloads count
         $newCount = $qry['download'] + 1;
         $updateQuery = "UPDATE files SET download=$newCount WHERE id=".$_GET['file_id'];
         mysqli_query($dbcon, $updateQuery);
}
?>