<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();

$query_Recordset1 = "select *  from cstcmis.model_master";
$Recordset1 = mysqli_query($cstccon,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Traffic Performance Entry</title>
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
		<?php // include('WBTC_DailyEntryTrafficDisp1.php'); ?>
		<!-- begin #content -->
		<div class="modal modal-warning fade" id="modal-warning171" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">MODEL WISE DATA CAPTURE</span></h4>
                            </div>
                            <form method="post" action="WBTC_DailyEntryTrafficDispAdd.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
					<table style="color:black" >
						<tr>
                                                    <td width="20%"></td>
							<td >SELECT DATE</td>
							
							<td >
                                                <div class="form-group">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                    <div class="col-md-14">
                                                <input class="form-control"value="<?php echo date('d-m-Y',strtotime("-1 days")) ; ?>"type="text" class="form-control" id="indent_ref_date" name="indent_ref_date"placeholder="Select Date To" readonly="yes" />
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
						</tr>
                                                 
                                                <tr>
							<td width="20%"></td>
                                                    <td>SELECT MODEL :</td>
							
							<td><div class="col-md-14"><select class="form-control"name="model" id="model">
                            <?php
do {  
?><option value="<?php echo $row_Recordset1['model']?>"><?php echo $row_Recordset1['model']?></option>
                            <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?></select></div></td>
						</tr>
						<tr>
                                                    <td width="20%"></td>
							<td>OUT IN 1ST SHIFT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="veh_out_1st" name="veh_out_1st" placeholder="Out 1st Sift" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>OUT IN 2ND SHIFT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="veh_out_2nd" name="veh_out_2nd" placeholder="Out 1st Sift" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
						<tr>
                                                    <td width="20%"></td>
							<td>SCHEDULED TRIP : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="sch_trip" name="sch_trip" placeholder="Schedule Trip" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
						<tr>
                                                    <td width="20%"></td>
							<td>TRIP COMPLETED : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="act_trip" name="act_trip" placeholder="Actual Trip" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
						<tr>
                                                    <td width="20%"></td>
							<td>IST SHIFT K.M. : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="km" name="km" placeholder="KM 1st Shift" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
						<tr>
                                                    <td width="20%"></td>
							<td>2ND SHIFT K.M. : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="km_2nd" name="km_2nd" placeholder="KM 2nd Shift" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>HSD CONSUMED : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="hsd" name="hsd" placeholder="HSD" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                
                                               <tr>
                                                    <td width="20%"></td>
							<td>IST SHIFT REVENUE : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="sale_1st" name="sale_1st" placeholder="SALE IST SHIFT" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>2ND SHIFT REVENUE : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" id="sale_2nd" name="sale_2nd" placeholder="SALE 2ND SHIFT" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
						
						
					</table>
					
	
    
     <div class="modal-footer"style="color:white ;background-color:#a8a646;">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-success">Submit</button>
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
