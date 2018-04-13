<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();

$unit = $_SESSION['UNIT'];
$user_id = $_SESSION['USER_ID'];





$query_Recordset1 = "SELECT * FROM cstcmis.stop_master ORDER BY STOP_DESC";
$Recordset1 = mysqli_query($cstccon,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


$query_Recordset2 = "SELECT * FROM cstcmis.unit ORDER BY UNIT_DESC";
$Recordset2 = mysqli_query($cstccon,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Add New Route</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader">
	    <div class="material-loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
            <div class="message">Loading...</div>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
		<?php  include('WBTC_header.php'); ?>
		
		<?php  include('WBTC_left.php'); ?>
		<?php  include('WBTC_middle.php'); ?>
		<!-- begin #content -->
		<div class="modal modal-warning fade" id="modal-warning171" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Add New Route</span></h4>
                            </div>
                            <form method="post" action="WBTC_RouteMasterAdd.php"  enctype="multipart/form-data">
					<table class="table1">
						
						<tr>
							
							<td width="10"></td>
                                                        <td>ROUTE NUMBER :</td>
							<td>
                                                            <div class="col-md-8">
                                                                <input class="form-control"type="text" id="route" name="route" placeholder="Route Number"  required /></td>
                                                            </div>
                                              	</tr>
						<tr>
							
							<td width="10"></td>
                                                        <td>FROM :</td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="from_st"id="from_st"> 
                                                                <?php
                                                                
do {  
?>  
                                                                <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                                <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select></div></td>
						</tr>
                                                <tr>
							
							<td width="20"></td>
                                                        <td>TO :</td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="to_st"id="to_st"> 
                                                                <?php
do {  
?>
                                                                <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                                <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select></div></td>
						</tr>
						<tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select3"id="select3">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select4"id="select4">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select5"id="select5">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select6"id="select6">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select7"id="select7">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select8"id="select8">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select9"id="select9">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select10"id="select10">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                               
                                                
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select11"id="select11">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select12"id="select12">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select13"id="select13">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10">
                                                            <select class="form-control" name="select14"id="select14">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                              <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                            </select>  </div>           </td>
						</tr>
                                               
						<tr>
							
							<td width="10"></td>
                                                        <td>ROUTE LENGTH</td>
							<td><div class="col-md-8">
                                                                <input class="form-control"type="number" id="length" name="length" placeholder="Length" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td>OPERATED BY</td>
							<td><div class="col-md-10"><select class="form-control"name="depot1"id="depot1">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset2['UNIT']?>"><?php echo $row_Recordset2['UNIT_DESC']?></option>
                                                              <?php
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
  $rows = mysqli_num_rows($Recordset2);
  if($rows > 0) {
      mysqli_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysqli_fetch_assoc($Recordset2);
  }
?>
                                                                </select> </div>  </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10"><select class="form-control"name="depot2"id="depot2">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset2['UNIT']?>"><?php echo $row_Recordset2['UNIT_DESC']?></option>
                                                              <?php
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
  $rows = mysqli_num_rows($Recordset2);
  if($rows > 0) {
      mysqli_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysqli_fetch_assoc($Recordset2);
  }
?>
                                                                </select> </div>  </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10"><select class="form-control"name="depot3"id="depot3">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset2['UNIT']?>"><?php echo $row_Recordset2['UNIT_DESC']?></option>
                                                              <?php
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
  $rows = mysqli_num_rows($Recordset2);
  if($rows > 0) {
      mysqli_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysqli_fetch_assoc($Recordset2);
  }
?>
                                                                </select> </div>  </td>
						</tr>
                                                <tr>
							
							<td width="10"></td>
                                                        <td></td>
							<td><div class="col-md-10"><select class="form-control"name="depot4"id="depot4">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset2['UNIT']?>"><?php echo $row_Recordset2['UNIT_DESC']?></option>
                                                              <?php
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
  $rows = mysqli_num_rows($Recordset2);
  if($rows > 0) {
      mysqli_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysqli_fetch_assoc($Recordset2);
  }
?>
                                                                </select> </div>  </td>
						</tr>
                                                
						
						
					</table>
					
	
    
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-primary">Add</button>
    </div>
	

					</form>
                            
                        </div>
                    </div>
                </div>
		<!-- end #content -->
		<?php  include('WBTC_ThemePanel.php'); ?>
        
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/dashboard.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
        <script src="assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Dashboard.init();
                        $("#modal-warning171").modal('show');
                        FormPlugins.init();
		});
	</script>
</body>
</html>
