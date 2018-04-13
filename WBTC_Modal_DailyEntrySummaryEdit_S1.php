<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();

$id1 = $_GET['id'];


$query_Recordset2 = "select *  from cstcmis.daily_record_sum where id = " . $id1 ;
$Recordset2 = mysqli_query($cstccon,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);

$op_date = $row_Recordset2['op_date'];
$unit = $row_Recordset2['unit'];

	$att_driver_1st=$row_Recordset2['att_driver_1st'];
        $att_driver_tr_1st=$row_Recordset2['att_driver_tr_1st'];
        $att_cond_1st=$row_Recordset2['att_cond_1st'];
        $att_cond_tr_1st=$row_Recordset2['att_cond_tr_1st'];
        //$att_driver_2nd=htmlspecialchars($_POST['att_driver_2nd'],ENT_QUOTES);
       // $att_driver_tr_2nd=htmlspecialchars($_POST['att_driver_tr_2nd'],ENT_QUOTES);
       // $att_cond_2nd=htmlspecialchars($_POST['att_cond_2nd'],ENT_QUOTES);
       // $att_cond_tr_2nd=htmlspecialchars($_POST['att_cond_tr_2nd'],ENT_QUOTES);
	
        $ab_driver_1st=$row_Recordset2['ab_driver_1st'];
        $ab_driver_tr_1st=$row_Recordset2['ab_driver_tr_1st'];
        $ab_cond_1st=$row_Recordset2['ab_cond_1st'];
        $ab_cond_tr_1st=$row_Recordset2['ab_cond_tr_1st'];
        //$ab_driver_2nd=htmlspecialchars($_POST['ab_driver_2nd'],ENT_QUOTES);
        //$ab_driver_tr_2nd=htmlspecialchars($_POST['ab_driver_tr_2nd'],ENT_QUOTES);
       // $ab_cond_2nd=htmlspecialchars($_POST['ab_cond_2nd'],ENT_QUOTES);
       // $ab_cond_tr_2nd=htmlspecialchars($_POST['ab_cond_tr_2nd'],ENT_QUOTES);

?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Daily Attendance Edit</title>
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
		<?php  include('WBTC_DailyEntrySummary_S1.php'); ?>
		<!-- begin #content -->
		<div class="modal modal-warning fade" id="modal-warning171" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">MODEL WISE RECORD MODIFICATION</span></h4>
                            </div>
                            <form method="post" action="WBTC_DailyEntrySummaryEdit_S1.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
					<table style="color:black" >
						<tr>
                                                    <td width="20%"></td>
							<td >DATE OF OPERATION</td>
							
							<td >
                                                <div class="form-group">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                    <div class="col-md-14">
                                                <?php echo $op_date ; ?>
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
						</tr>
                                                 
                                               
						<tr>
                                                    <td width="20%"></td>
							<td>DRIVER PRESENT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" value="<?php echo $att_driver_1st ; ?>" id="att_driver_1st" name="att_driver_1st"  onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>DRIVER(CONTRACTUAL) PRESENT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" value="<?php echo $att_driver_tr_1st ; ?>" id="att_driver_tr_1st" name="att_driver_tr_1st"  onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>CONDUCTOR PRESENT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" value="<?php echo $att_cond_1st ; ?>" id="att_cond_1st" name="att_cond_1st"  onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>CONDUCTOR(CONTRACTUAL) PRESENT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" value="<?php echo $att_cond_tr_1st ; ?>" id="att_cond_tr_1st" name="att_cond_tr_1st"  onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>DRIVER ABSENT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" value="<?php echo $ab_driver_1st ; ?>" id="ab_driver_1st" name="ab_driver_1st"  onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>DRIVER(CONTRACTUAL) ABSENT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" value="<?php echo $ab_driver_tr_1st ; ?>" id="ab_driver_tr_1st" name="ab_driver_tr_1st"  onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>CONDUCTOR ABSENT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" value="<?php echo $ab_cond_1st ; ?>" id="ab_cond_1st" name="ab_cond_1st"  onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                <tr>
                                                    <td width="20%"></td>
							<td>CONDUCTOR(CONTRACTUAL) ABSENT : </td>
							
                                                        <td><div class="col-md-14"><input class="form-control" type="number" value="<?php echo $ab_cond_tr_1st ; ?>" id="ab_cond_tr_1st" name="ab_cond_tr_1st"  onkeypress="return isNumber(event)" required /></div></td>
						</tr>
                                                
						<input type ="hidden" name = "id"value="<?php echo $id1 ; ?>">
						
					</table>
					
	
    
     <div class="modal-footer"style="color:white ;background-color:#a8a646;">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-success">Update</button>
    </div>
	

					
                            
                        </div>
                                </form>
                    </div>
                </div>
		<!-- end #content -->
		<?php  include('CSTC_ThemePanel.php'); ?>
        
		
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
