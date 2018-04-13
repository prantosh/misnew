<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 
if(!isset($_SESSION['mth'])){
    
    $_SESSION['mth'] = date('my',strtotime("first day of previous month"));
}
else {
//$_SESSION['mth1'] = $_SESSION['mth2'] ;
$mth1 = $_GET['q'];    
$_SESSION['mth'] = date('my',strtotime("first day of $mth1"));
}

$mth = $_SESSION['mth'];
//$mth2 = $_SESSION['mth2'];
$mth1 = $_GET['q'];
 if($mth1 == ''){$mth1 = date('my',strtotime("first day of this month"));}
 //$mth1 = $_GET['q'];
  $query1 = "select * from cstcmis.month_year where month = '" . $mth1 . "'";
    $result1=mysqli_query($cstccon,$query1);
    $row1= mysqli_fetch_array ($result1);
    $year = $row1['year'];
								
 
 if($mth1 == 'december'){$mth = '12' . $year ;}
 if($mth1 == 'november'){$mth = '11' . $year ;}
 if($mth1 == 'october'){$mth =  '10' . $year ;}
 if($mth1 == 'september'){$mth = '09' . $year ;}
 if($mth1 == 'august'){$mth = '08' . $year ;}
 if($mth1 == 'july'){$mth = '07' . $year ;}
 if($mth1 == 'june'){$mth = '06' . $year ;}
 if($mth1 == 'may'){$mth = '05' . $year ;}
 if($mth1 == 'april'){$mth = '04' . $year ;}
 if($mth1 == 'march'){$mth = '03' . $year ;}
 if($mth1 == 'february'){$mth = '02' . $year ;}
 if($mth1 == 'january'){$mth = '01' . $year ;}
 

$file = 'cstcmis.cb' . $mth;
//echo $file;

if($mth == ''){$mth = date('my',strtotime("first day of previous month"));}
if($mth == date('my',strtotime("first day of this month"))){$file = 'cstcmis.cb';}
//if($mth2 == ''){$mth2 = date('my',strtotime("first day of previous month"));}
$query11 = "select * from cstcmis.unit where UNIT  = '" . $_SESSION['UNIT'] . "'";
    $result11=mysqli_query($cstccon,$query11);
    $row11= mysqli_fetch_array ($result11);
    $unit_desc = $row11['UNIT_DESC'];
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Date-Wise Daily Maintenance</title>
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
	<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/ColReorder/css/colReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/KeyTable/css/keyTable.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
        <script>
function goBack() {
    window.history.back();
}
</script>
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
		<!-- begin #header -->
		<?php  include('WBTC_header.php'); ?>
		<!-- end #header -->
                <!-- begin #sidebar -->
		<?php  include('WBTC_left.php'); ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				
				<li class="active">Maintenance - Date-Wise</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Date-Wise Maintenance : <small><?php echo $unit_desc ; ?></small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			   
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                    Select Month 
                        </div>
                        <p></p>
<p align='center'>


<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=january';" value="JANUARY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=february';" value="FEBRUARY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=march';" value="MARCH" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=april';" value="APRIL" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=may';" value="MAY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=june';" value="JUNE" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=july';" value="JULY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=august';" value="AUGUST" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=september';" value="SEPTEMBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=october';" value="OCTOBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=november';" value="NOVEMBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyMaintenanceDepot.php?q=december';" value="DECEMBER" />

</p>


                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                  
                                <tr style="font-size: 10px">
                                    <th style="text-align:center;"><b>SRL.</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;"><b>DEPOT</b> <i class="fa fa-fw fa-sort"></i></th>
                                    
                                    <th style="text-align:center;">VEHICLE NO. <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">MODEL <i class="fa fa-fw fa-sort"></i></th>
                                    
                                    <th style="text-align:center;">DATE OF MAINTENANCE <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">DESCRIPTION <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">AT VEHICLE K.M. <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">UPDATE BY <i class="fa fa-fw fa-sort"></i></th>
                                            </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $x = 1;
								session_start();
                                                                $query = "select * from cstcmis.maint_tran a,cstcmis.veh0214 b,cstcmis.maint_master c where a.depot = '" . $_SESSION['UNIT'] . "' AND DATE_FORMAT(a.maint_date,'%m%y') = '" . $mth . "' and a.maint_code = c.maint_code and a.vehno = b.vehno order by a.maint_date desc,a.depot";
                                                                $result=mysqli_query($cstccon,$query);
                                                                    //$result= mysqli_query($cstccon,"select * from daily_record_model where unit = '" . $_SESSION['UNIT'] . "' order by op_date ASC" ) or die (mysqli_error());
								while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                               
								?>
								<tr style="font-size: 10px">
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $x; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['depot']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row['vehno']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row['model']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo substr($row['maint_date'],8,2) . '-' . substr($row['maint_date'],5,2) . '-' . substr($row['maint_date'],0,4) ; ?></td>

								<td style="text-align:center; word-break:break-all; "> <?php echo $row['maint_desc']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row['maint_at_km'] + $row['att_driver_tr_1st'] ; ?></td>
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row['op_code'] + $row['att_driver_tr_2nd']; ?></td>
                                                                                             
								</tr>

								

								<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
			    </div>
			    <!-- end col-10 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
        <!-- begin theme-panel -->
        <?php  include('WBTC_ThemePanel.php'); ?>
        <!-- end theme-panel -->
		
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
	<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/RowReorder/js/dataTables.rowReorder.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>
	<script src="assets/js/table-manage-combine.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageCombine.init();
		});
	</script>
</body>
</html>
