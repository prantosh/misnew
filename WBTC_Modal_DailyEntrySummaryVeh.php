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
                            <div class="modal-body"style="color:white ;background-color: #dbda97;">
                           
					<form method="post" action="MIS_DailyEntrySummaryAdd.php"  enctype="multipart/form-data">
					<table class="table1">
						<tr>
							<td style="color:red; font-size:18px;">DATE</td>
							<td width="30"></td>
							<td><div class="form-group">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                    <div class="col-md-16">
                                                            <select class="form-control"name="datepicker_from" id="datepicker_from">
                                         <?php $i = $_SESSION['no_of_days'];
                                                $j = 0;
                                           while ($j <= $i){?>
					   <option value=" <?php echo date('d-m-Y',strtotime('-' . $j . ' days')); ?>"> <?php echo date('d-m-Y',strtotime('-' . $j . ' days')); ?></option>
                                         <?php $j = $j +1;
                                          }?>
                                                    </select>
                                                    </div></div></td>
						</tr>
                                                
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td> 
                                                    <div class="col-md-16">
                                                            <input class="form-control"type="text" id="att_driver_1st" name="att_driver_1st" placeholder="Driver Present I" onkeypress="return isNumber(event)" required />
                                                    </div>
                                                    </td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
                                                        <td> <div class="col-md-16"><input class="form-control" type="text" id="att_driver_tr_1st" name="att_driver_tr_1st" placeholder="Cont. Driver Present I" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="att_cond_1st" name="att_cond_1st" placeholder="Conductor Present I" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="att_cond_tr_1st" name="att_cond_tr_1st" placeholder="Cont. Conductor Present I" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="att_driver_2nd" name="att_driver_2nd" placeholder="Driver Present II" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="att_driver_tr_2nd" name="att_driver_tr_2nd" placeholder="Cont. Driver Present II" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="att_cond_2nd" name="att_cond_2nd" placeholder="Conductor Present II" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="att_cond_tr_2nd" name="att_cond_tr_2nd" placeholder="Cont. Conductor Present II" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="ab_driver_1st" name="ab_driver_1st" placeholder="Driver Absent I" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="ab_driver_tr_1st" name="ab_driver_tr_1st" placeholder="Cont. Driver Absent I" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="ab_cond_1st" name="ab_cond_1st" placeholder="Conductor Absent I" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="ab_cond_tr_1st" name="ab_cond_tr_1st" placeholder="Cont. Conductor Absent I" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="ab_driver_2nd" name="ab_driver_2nd" placeholder="Driver Absent II" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="ab_driver_tr_2nd" name="ab_driver_tr_2nd" placeholder="Cont. Driver Absent II" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                            <input class="form-control" type="text" id="ab_cond_2nd" name="ab_cond_2nd" placeholder="Conductor Absent II" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
							<td><label style="color:#3a87ad; font-size:18px;"></label></td>
							<td width="30"></td>
							<td>  <div class="col-md-16">
                                                                <input class="form-control" type="text" id="ab_cond_tr_2nd" name="ab_cond_tr_2nd" placeholder="Cont. Conductor Absent II" onkeypress="return isNumber(event)" required /></div></td>
						</tr>
						
					</table>
					
	
    
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-primary">Add</button>
    </div>
	

					</form></div>
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
