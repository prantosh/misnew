<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 
if(!isset($_SESSION['mth1'])){
    $_SESSION['mth1'] = date('my',strtotime("first day of this month"));
    $_SESSION['mth2'] = date('my',strtotime("first day of previous month"));
}
else {
$_SESSION['mth1'] = $_SESSION['mth2'] ;
$mth = $_GET['q'];    
$_SESSION['mth2'] = date('my',strtotime("first day of $mth"));
}
$mth1 = $_SESSION['mth1'];
$mth2 = $_SESSION['mth2'];

if($mth1 == ''){$mth1 = date('my',strtotime("first day of this month"));}
if($mth2 == ''){$mth2 = date('my',strtotime("first day of previous month"));}

$mth1_yr1 = substr($mth1,2,2); // 18
$mth1_yr_prev = intval($mth1_yr1) - 1 ; // 17
$mth1_mth = substr($mth1,0,2);

$mth2_yr2 = substr($mth2,2,2); // 17
$mth2_yr_prev = intval($mth2_yr2 - 1) ; // 16
$mth2_mth = substr($mth2,0,2);



$mth3 = $mth1_mth . $mth1_yr_prev ;
$mth4 = $mth2_mth . $mth2_yr_prev ;

$d1=cal_days_in_month(CAL_GREGORIAN,$mth1_mth,'20' . $mth1_yr1);
$d2=cal_days_in_month(CAL_GREGORIAN,$mth2_mth,'20' . $mth2_yr2);
$d3=cal_days_in_month(CAL_GREGORIAN,$mth1_mth,'20' . $mth1_yr_prev);
$d4=cal_days_in_month(CAL_GREGORIAN,$mth2_mth,'20' . $mth2_yr_prev);

if(!isset($_SESSION['d'])){$_SESSION['d'] = 'BD';}


if(isset($_GET['d'])){$_SESSION['d'] = $_GET['d'];}



?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Monthly - Performance</title>
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
				
				<li class="active"><?php echo $d1 ; ?> Performance - Month wise</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Month-Wise Performance : <small><?php echo $unit_desc ; ?></small></h1>
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
                    <?php 
if($_SESSION['d'] == 'CSTC'){
echo "MONTH WISE PERFORMANCE FOR CSTC"  ;
}
else{echo "MONTH WISE PERFORMANCE FOR DEPOT =   " . $_SESSION['d']  ;}?>
                        </div>
                        <p></p>
<p align='center'>


<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=january';" value="JANUARY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=february';" value="FEBRUARY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=march';" value="MARCH" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=april';" value="APRIL" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=may';" value="MAY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=june';" value="JUNE" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=july';" value="JULY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=august';" value="AUGUST" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=september';" value="SEPTEMBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=october';" value="OCTOBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=november';" value="NOVEMBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?q=december';" value="DECEMBER" />

</p>
<p align='center'>
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=BD';" value="BD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=ND';" value="ND" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=PD';" value="PD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=MD';" value="MD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=SLD';" value="SLD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=KD';" value="KD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=GD';" value="GD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=LD';" value="LD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=TD';" value="TD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=TPD';" value="TPD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=HD';" value="HD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_SaleQryMonthWise.php?d=CSTC';" value="CSTC" />

</p>

                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr style="font-size: 10px">
                                    
                                    <th style="text-align:center;"></th>
                                    
                                    
                                    <th colspan='2'style="text-align:center;">ATTD DR (AVG.) </th>
                                    <th colspan='2' style="text-align:center;">ATTD COND (AVG.)</th>
                                    <th colspan='2' style="text-align:center;">OUT (AVG.)</th>
                                   
                                    <th style="text-align:center;"><b>% TRIP</b> </th>
                                    <th colspan='3'style="text-align:center;">SALE </th>
                                    
                                    <th style="text-align:center;"> </th>
                                    
                                    <th style="text-align:center;"><b></b> </th>
                                    <th colspan='3'style="text-align:center;"> </th>
									
                                </tr>
                                <tr style="font-size: 10px">
                                    
                                    <th style="text-align:center;">MONTH</th>
                                   
                                    <th style="text-align:center;">I</th>
                                    <th style="text-align:center;">II</th>
                                    <th style="text-align:center;">I</th>
                                    <th style="text-align:center;">II</th>
                                    <th style="text-align:center;">I</th>
                                    <th style="text-align:center;">II</th>
                                   
                                    <th style="text-align:center;"><b>LOSS</b> </th>
                                    <th style="text-align:center;">I</th>
                                    <th style="text-align:center;">II</th>
                                    <th style="text-align:center;">TOTAL</th>
                                    
                                    <th style="text-align:center;">KM </th>
                                    
                                    <th style="text-align:center;">KMPL </th>
                                   <th colspan='3'style="text-align:center;">EPKM (I,II,TOT)</th>
                                   
                                    
									
                                </tr>
                                </thead>
                                <tbody>
                                  <?php
								
                                                                
                                                               if($_SESSION['d'] == 'CSTC'){ 
                                                               $query = "select DATE_FORMAT(op_date,'%m%y') mth,sum(veh_supply_1st) veh_supply_1st_tot,sum(veh_supply_2nd) veh_supply_2nd_tot, sum(att_driver_1st + att_driver_tr_1st) att_driver_1st_tot,sum(att_driver_2nd + att_driver_tr_2nd) att_driver_2nd_tot,sum(att_cond_1st + att_cond_tr_1st) att_cond_1st_tot,sum(att_cond_2nd + att_cond_tr_2nd) att_cond_2nd_tot from cstcmis.daily_record_sum where DATE_FORMAT(op_date,'%m%y')  in('" . $mth1 . "','" . $mth2 . "','" . $mth3 . "','" . $mth4 . "') group by DATE_FORMAT(op_date,'%m%y')  order by unit,op_date desc";
                                                               }
                                                               else{ 
                                                               $query = "select unit,DATE_FORMAT(op_date,'%m%y') mth,sum(veh_supply_1st) veh_supply_1st_tot,sum(veh_supply_2nd) veh_supply_2nd_tot, sum(att_driver_1st + att_driver_tr_1st) att_driver_1st_tot,sum(att_driver_2nd + att_driver_tr_2nd) att_driver_2nd_tot,sum(att_cond_1st + att_cond_tr_1st) att_cond_1st_tot,sum(att_cond_2nd + att_cond_tr_2nd) att_cond_2nd_tot from cstcmis.daily_record_sum where DATE_FORMAT(op_date,'%m%y')  in('" . $mth1 . "','" . $mth2 . "','" . $mth3 . "','" . $mth4 . "') group by unit,DATE_FORMAT(op_date,'%m%y') having unit = '" . $_SESSION['d'] . "' order by unit,op_date desc";
                                                               }
                                                               $result=mysqli_query($cstccon,$query);
                                                               
                                                                while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                               
								?>
								<tr style="font-size: 10px">
                                                                
                                                               
								
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php 
                                                                if(substr($row['mth'],0,2) == '01'){ echo 'JAN, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '02'){ echo 'FEB, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '03'){ echo 'MAR, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '04'){ echo 'APR, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '05'){ echo 'MAY, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '06'){ echo 'JUN, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '07'){ echo 'JUL, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '08'){ echo 'AUG, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '09'){ echo 'SEP, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '10'){ echo 'OCT, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '11'){ echo 'NOV, 20' . substr($row['mth'],2,2) ; }
                                                                if(substr($row['mth'],0,2) == '12'){ echo 'DEC, 20' . substr($row['mth'],2,2) ; }
                                                                
                                                                 if($row['mth'] == $mth1){$days = $d1;}
                                                                if($row['mth'] == $mth2){$days = $d2;}
                                                                if($row['mth'] == $mth3){$days = $d3;}
                                                                if($row['mth'] == $mth4){$days = $d4;}
                                                                
                                                                ?></td>
                                                               
								                                                             
								  
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row['att_driver_1st_tot'] / $days,0); ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row['att_driver_2nd_tot'] / $days,0); ?></td>
                                                                                                                                                                             </td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row['att_cond_1st_tot'] / $days,0); ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row['att_cond_2nd_tot'] / $days,0); ?></td>
                                                             <?php
                                                              if($_SESSION['d'] == 'CSTC'){ 
                                                                $query1 = "select DATE_FORMAT(op_date,'%m%y') op1,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0 group by DATE_FORMAT(op_date,'%m%y') having op1 = '" . $row['mth'] . "'";
                                                              }
                                                              else{
                                                              $query1 = "select unit,DATE_FORMAT(op_date,'%m%y') op1,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0 group by unit,DATE_FORMAT(op_date,'%m%y') having op1 = '" . $row['mth'] . "' and unit = '" . $_SESSION['d'] . "'";
                                                              }
                                                                $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
                                                                $row1 = mysqli_fetch_assoc($result1);?>
                                                                                                              
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row1['veh_out_1st_tot'] / $days ,0); ?></td>
                                                               
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row1['veh_out_2nd_tot'] / $days ,0); ?></td>
                                                               
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php  if($row1['sch_trip_tot'] > 0){
                                                                echo number_format(($row1['sch_trip_tot'] - $row1['act_trip_tot']) * 100 / $row1['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php  echo $row1['sale_1st_tot'];?> </td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php  echo $row1['sale_2nd_tot'];?> </td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php  echo $row1['sale_1st_tot'] + $row1['sale_2nd_tot'];?> </td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php  echo $row1['km_tot'] + $row1['km_2nd_tot'] ;?> </td>
                                                                
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php if($row1['hsd_tot'] > 0){
                                                                echo number_format(($row1['km_tot'] + $row1['km_2nd_tot']) / $row1['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php if($row1['km_tot'] > 0){
                                                                echo number_format($row1['sale_1st_tot'] / $row1['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php if($row1['km_2nd_tot'] > 0){
                                                                echo number_format($row1['sale_2nd_tot'] / $row1['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php if($row1['km_tot'] + $row1['km_2nd_tot'] > 0){
                                                                echo number_format(($row1['sale_1st_tot'] + $row1['sale_2nd_tot']) / ($row1['km_tot'] + $row1['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                                                  
                                                                <!-- Modal -->
								
                                                             
                                                                
								</tr>

								

								<?php  } ?>
                          
               
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
