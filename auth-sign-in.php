

<!--
		Developer: Tekletsadik Tadesse
        Mobile : +251967267539
        Address : Addiss Ababa, Ethiopia
		-->

    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Authentication</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="dms/assets/images/favicon.ico" />

            <link rel="stylesheet" href="dms/assets/css/bootstrap/bootstrap.min.css">

      
      <link rel="stylesheet" href="dms/assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="dms/assets/css/backend.css?v=1.0.0">
      
      <link rel="stylesheet" href="dms/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="dms/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="dms/assets/vendor/remixicon/fonts/remixicon.css">
      
      <!-- Viewer Plugin -->
        <!--PDF-->
        <link rel="stylesheet" href="dms/assets/vendor/doc-viewer/include/pdf/pdf.viewer.css">
        <!--Docs-->
        <!--PPTX-->
        <link rel="stylesheet" href="dms/assets/vendor/doc-viewer/include/PPTXjs/css/pptxjs.css">
        <link rel="stylesheet" href="dms/assets/vendor/doc-viewer/include/PPTXjs/css/nv.d3.min.css">
        <!--All Spreadsheet -->
        <link rel="stylesheet" href="dms/assets/vendor/doc-viewer/include/SheetJS/handsontable.full.min.css">
        <!--Image viewer-->
        <link rel="stylesheet" href="dms/assets/vendor/doc-viewer/include/verySimpleImageViewer/css/jquery.verySimpleImageViewer.css">
        <!--officeToHtml-->
        <link rel="stylesheet" href="dms/assets/vendor/doc-viewer/include/officeToHtml/officeToHtml.css">  
        <style>
.form-groups {
  border: 1px solid #ced4da;
  padding: 5px;
  border-radius: 6px;
  width: auto;
}
.form-groups:focus {
  color: #212529;
    background-color: #fff;
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
}
.form-groups input {
  display: inline-block;
  width: auto;
  border: none;
}
.form-groups input:focus {
  box-shadow: none;
}
</style>
    </head>
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    
      <div class="wrapper">
  
      <section class="login-content" style="background:#fff200">
	  
         <div class="container h-200" >
            <div class="row justify-content-center align-items-center height-self-center" >
			
			<div class="col-md-5 col-sm-12 col-12 align-self-center"> 
				<img src="dms/assets/images/Header.jpg" class="img-fluid rounded-normal light-logo logo" alt="logo">
				<a href ="https://drogapharma.com"><img src="dms/assets/images/test.png" class="img-fluid rounded-normal light-logo logo" alt="logo">	</a>		
				
				<!--<h3 class="card-titlev" style="color:black"><b>Welcome to Droga Groups Document Management System</b> <br></h3>-->
			</div>
               <div class="col-md-5 col-sm-12 col-12 align-self-center" style="color:#ffffff">
			   
                  <div class="sign-user_card" style="background:#000000">
                     <!--   <img src="dms/assets/images/Header.jpg	" class="img-fluid rounded-normal light-logo logo" alt="logo">
                     <!-- <h3 class="mb-3">Sign In</h3> -->
                     <br><br>
					 <p>Sign in to stay connected.</p>
			<br><br>
                   <form role="form" method="post" action="employee_signin.php">      
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="drogaid" placeholder="ID Number" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-envelope" style="color:black"></span>
						</div>
					  </div>
					</div>

					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock" style="color:black"></span>
						</div>
					  </div>
					</div>
					<div class="row">
					  <div class="col-8">
						<div class="icheck-" style="color:#fff200">
						  
						</div>
					  </div>
					  <!-- /.col -->
					  <br>
					  <div class="col-4">
						<button type="submit" class="btn btn- btn-block" style="background:#fff200;color:black;" name="emp_signin">SignIn</button>
					  </div>
					  <!-- /.col -->

					</div>
				  </form>
				   <p class="float-left">
					<a style="color:white" href="#">Forgot my password</a>
				  </p>
				  <br><br><br><br>
               </div>
            </div>
         </div>
		  <footer class="main-footer;float-center" style="background:black">
		                
              <div style="text-align:center">
               <a style="color:white" href="www.drogapharma.com"> Copyright &copy; 2023 Droga Groups </a>
			   <a style="color:#fff200;" href="">| Powered by Droga IT. &nbsp; &nbsp; &nbsp; </a>
              </div>
	</footer>
      </section>
      </div>
    
    <!-- Backend Bundle JavaScript -->
    <script src="dms/assets/js/backend-bundle.min.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="dms/assets/js/customizer.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="dms/assets/js/chart-custom.js"></script>
    
    <!--PDF-->
    <script src="dms/assets/vendor/doc-viewer/include/pdf/pdf.js"></script>
    <!--Docs-->
    <script src="dms/assets/vendor/doc-viewer/include/docx/jszip-utils.js"></script>
    <script src="dms/assets/vendor/doc-viewer/include/docx/mammoth.browser.min.js"></script>
    <!--PPTX-->
    <script src="dms/assets/vendor/doc-viewer/include/PPTXjs/js/filereader.js"></script>
    <script src="dms/assets/vendor/doc-viewer/include/PPTXjs/js/d3.min.js"></script>
    <script src="dms/assets/vendor/doc-viewer/include/PPTXjs/js/nv.d3.min.js"></script>
    <script src="dms/assets/vendor/doc-viewer/include/PPTXjs/js/pptxjs.js"></script>
    <script src="dms/assets/vendor/doc-viewer/include/PPTXjs/js/divs2slides.js"></script>
    <!--All Spreadsheet -->
    <script src="dms/assets/vendor/doc-viewer/include/SheetJS/handsontable.full.min.js"></script>
    <script src="dms/assets/vendor/doc-viewer/include/SheetJS/xlsx.full.min.js"></script>
    <!--Image viewer-->
    <script src="dms/assets/vendor/doc-viewer/include/verySimpleImageViewer/js/jquery.verySimpleImageViewer.js"></script>
    <!--officeToHtml-->
    <script src="dms/assets/vendor/doc-viewer/include/officeToHtml/officeToHtml.js"></script>
    <script src="dms/assets/js/doc-viewer.js"></script>
    <!-- app JavaScript -->
    <script src="dms/assets/js/app.js"></script>
  </body>
</html>