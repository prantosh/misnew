<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
require_once('Connections/cstccon.php'); 

 
$from_date1 = htmlspecialchars($_POST['stock_date'],ENT_QUOTES);
$to_date1 = htmlspecialchars($_POST['stock_date1'],ENT_QUOTES);

$from_date = substr($from_date1,6,4) . '-' . substr($from_date1,3,2) . '-' . substr($from_date1,0,2);
$to_date = substr($to_date1,6,4) . '-' . substr($to_date1,3,2) . '-' . substr($to_date1,0,2);
header('Cache-Control: no cache'); //no cache

session_cache_limiter('must-revalidate');

?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Day-Wise Performance Status</title>
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
				
				<li class="active">Day-Wise performance Status</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Day-Wise performance Status <small>Detail List</small></h1>
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
                                    <tr style="font-size: 10px;">
                                    <th></th>
                                    <th ></th>
                                    <th  ></th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th ></th>
                                    <th ></th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10px;">
                                    <th> DATE</th>
                                    <th>SUPPLY</th>
                                    <th>OUT</th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>K.M.(Lakh) </th>
                                    <th>KMPL</th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
                                </thead>
                                <tbody>
                           <?php
                           $sql1 = "select op_date,sum(veh_supply_old) veh_supply_old1,sum(veh_supply_1623) veh_supply_16231,sum(veh_supply_al_nac) veh_supply_al_nac1,sum(veh_supply_al_ac) veh_supply_al_ac1,sum(veh_supply_volvo) veh_supply_volvo1,sum(veh_supply_1st) veh_supply_1st_tot,sum(veh_supply_2nd) veh_supply_2nd_tot, sum(att_driver_1st + att_driver_tr_1st) att_driver_1st_tot,sum(att_driver_2nd + att_driver_tr_2nd) att_driver_2nd_tot,sum(att_cond_1st + att_cond_tr_1st) att_cond_1st_tot,sum(att_cond_2nd + att_cond_tr_2nd) att_cond_2nd_tot from cstcmis.daily_record_sum where op_date <= '" . $to_date . "' and op_date >= '" . $from_date . "' group by op_date order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10px;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) . '-' . substr($row1['op_date'],5,2) . '-' .substr($row1['op_date'],0,4)  ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
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
                
                $('#data-table1').dataTable( {
                order: [],
                columnDefs: [ { orderable: false, targets: [1,2] } ]
                });
	</script>
</body>
</html>
