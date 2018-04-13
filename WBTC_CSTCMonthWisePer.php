<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 



$querycc = "SELECT mth,year_name,month_name, sum(store) store1,sum(non_tech_maint_ac) non_tech_maint_ac1,sum(non_tech_maint_nac) non_tech_maint_nac1,sum(daily_tech_maint) daily_tech_maint1,sum(heavy_maint) heavy_maint1,sum(out_1st_ac + out_1st_nac_new + out_1st_nac_old) out1,sum(sale_entered_from_depot) sale,sum(opr_cost_ac + opr_cost_nac_new + opr_cost_nac_old) opr_cost,sum(sch_trip_ac + sch_trip_nac_new + sch_trip_nac_old) sch_trip,sum(act_trip_ac + act_trip_nac_new + act_trip_nac_old) act_trip,sum(km_ac + km_nac_new + km_nac_old + km_ac_2nd + km_nac_new_2nd + km_nac_old_2nd) km,sum(hsd_ac + hsd_nac_new + hsd_nac_old) hsd,sum(sal + incen + ot) tot_sal FROM cstcmis.month_data group by year_name,month_name,mth having sch_trip > 0 and out1 > 0 order by mth desc limit 18";
$resultcc = mysqli_query($cstccon,$querycc) or die(mysqli_error());
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Month-Wise Performance</title>
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
				
				<li class="active">Month-Wise Perfomance</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Month-Wise Performance <small>For Last 18 Months</small></h1>
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
                            <a href="#" onClick="goBack()"><b><img src=images/go_back.png class="img-circle" alt="User Image"></b></a>
                    
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr style="font-size: 10px">
                  <th></th>
                  <th style="text-align: center;"></th>
                  <th>DAILY OUT</th>
                  <th>%TRIP</th>
                  <th>REVENUE </th>
                  <th>KM RUN </th>
                  <th></th>
                  <th style="text-align: center;"COLSPAN="2">CPKM</th>
                  <th></th>
                  
                </tr>
                <tr style="font-size: 10px">
                  <th>YEAR</th>
                  <th>MONTH</th>
                  <th>(AVG.)</th>
                  <th> LOSS</th>
                  <th> (Lakh)</th>
                  <th> (lakh)</th>
                  <th>KMPL</th>
                  <th >OPERATIONAL</th>
                  <th >TOTAL</th>
                  <th>EPKM</th>
                  
                </tr>
                                </thead>
                                <tbody>
                                    <?php 
//sum(store) store1,sum(non_tech_maint_ac) non_tech_maint_ac1,sum(non_tech_maint_nac) non_tech_maint_nac1,sum(daily_tech_maint) daily_tech_maint1,sum(heavy_maint) heavy_maint1
while ($rowcc=mysqli_fetch_array($resultcc) ){ 
  // if($rowcc['sch_km'] > 0 && $rowcc['hsd'] > 0){
                echo "<tr style='font-size: 10px'>";
                echo "<td>";
                echo $rowcc['year_name'];
                echo "</td>";
                echo "<td style='text-align: center;'>";
                echo $rowcc['month_name'];
                echo "</td>";
                echo "<td style='text-align: right;'>";
                echo $rowcc['out1'];
                echo "</td>";
                echo "<td style='text-align: right;'>";
                echo number_format(100 * ($rowcc['sch_trip'] - $rowcc['act_trip'])/$rowcc['sch_trip'],1);
                echo "</td>";
                echo "<td style='text-align: right;'>";
                echo number_format($rowcc['sale']/100000,2);
                echo "</td>";
                echo "<td style='text-align: right;'>";
                echo number_format($rowcc['km']/100000,2);
                echo "</td>";
                echo "<td style='text-align: right;'>";
                echo number_format($rowcc['km']/$rowcc['hsd'],2);
                echo "</td>";
                echo "<td style='text-align: right;'>";
                $opr_cost_tot = ($rowcc['opr_cost'] + $rowcc['store1'] + $rowcc['non_tech_maint_ac1'] * 3500 / 30 + $rowcc['non_tech_maint_nac1'] * 24 + $rowcc['daily_tech_maint1'] * 244 + $rowcc['heavy_maint'] * 11000);
                echo number_format($opr_cost_tot/$rowcc['km'],2);
                echo "</td>";
                echo "<td style='text-align: right;'>";
                echo number_format(($opr_cost_tot + $rowcc['tot_sal'] )/$rowcc['km'],2);
                echo "</td>";
                echo "<td style='text-align: right;'>";
                $epkm = $rowcc['sale'] / $rowcc['km'];
                echo number_format($epkm,2);
                echo "</td>";
                echo "</tr>";
}?>
                
               
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
