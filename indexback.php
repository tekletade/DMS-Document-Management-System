
<!--
		Developer: Tekletsadik Tadesse
    Mobile : +251967267539
    Address : Addiss Ababa, Ethiopia
		-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Droga Pharma PVT PLC</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="css/sweetalert.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" href="img/iconn.png" type="image/png">
  <link rel="shortcut icon" href="dms/assets/images/favicon2.png" />

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<style>
.card card-primary card-outline{
width: -webkit-fill-available;
}
</style>
<div class="wrapper" >


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background:#fff200">
    <!-- Left navbar links --
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   
    
    </ul>-->
		<ul class="navbar-nav">
				<li class="nav-item">
					<div class="card" style="background:#fff200">
					  <div class="card-header">
						<h3 class="card-titlev"><br>&nbsp;&nbsp;&nbsp;&nbsp;Wellcome to Droga Groups Document Management System <br></h3>
					  </div>
					</div>
				</li>
		</ul>
		<!--
		<ul class="navbar-nav ml-auto">     
			<li>			
        <a href="dms/index" type="button" class="btn btn-block btn-warning btn-lg">Sign In</a>                    
			</li>    
			
		</ul>
   -->
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:#000000">
    
    <div class="sideba">
		<!--<img src="dist/img/telegram.jpg">-->
     
    </div>
    
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div> 
    
    <section class="content" > 
	
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <a href="dms/index" class="small-box-footer" style="background:#fff200">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><br></h3>
                <!-- <b><p>Joined Employees</p></b> -->
                <b><p style="color:black">DMS</p></b>

              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
                <!-- <i class="ion"><img src="withdrawal.png"></i> -->
              </div>
              <a href="dms/index" class="small-box-footer" style="background:black">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </a>

		   
       
      
        
        </div>
      </div><!-- /.container-fluid --
  
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent Notices that you must be Addressed.</h3>
            </div>
         
          </div>
        </div>
      </div>
      <br><br><br>
    /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
            
	<footer class="main-footer" style="background:black">
              <strong style="color:#fff200">Copyright &copy; 2023 <a style="color:white" href="www.drogapharma.com"> Droga Groups.</a></strong>
              <div class="float-right d-none d-sm-inline-block">
                <b><a style="color:#fff200" href=""> Powered by Droga IT.</a></b> 
              </div>
	</footer>
              
        
 
</div>
<!-- ./wrapper -->
<?php //include('footer.php');?>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="js/popup.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#my-example').dataTable({
        "bProcessing": true,
        "sAjaxSource": "pro.php",
        "aoColumns": [
              { mData: 'id' } ,
              { mData: 'name' },
              { mData: 'email' }
            ]
      });  
  });
</script>
<script type="text/javascript">
function showhint(str){
   // str=document.getElementById("inp").value;
    //alert(str);
if(str.length==0){
    //alert("not done");
    return;
    
}
    else{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange= function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("resp").innerHTML=this.responseText.substr(this.responseText.indexOf("#")+1,this.responseText.length);;
            document.getElementById("myb").innerHTML=this.responseText.substr(0,this.responseText.indexOf("#"));
        }
    };
xmlhttp.open("GET","gethint.php?id="+str,true);
xmlhttp.send();

}
window.location.reload();
}

</script>
<script type="text/javascript">
            function showMessage() {
                alert("test.");
            }
        </script>
</body>

</html>
