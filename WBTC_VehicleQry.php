<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(!isset($_SESSION['vehno'])){
$vehno       = htmlspecialchars($_POST['vehno'],ENT_QUOTES);}
else{
    $vehno = $_SESSION['vehno'];
}
$_SESSION['vehno'] = $vehno ;
require_once('Connections/cstccon.php'); 
$mth1 = $_GET['q'];   
if(!isset($mth1)){
    
    $mth1_mmyy = date('my',strtotime("first day of previous month"));
    if(substr($mth1_mmyy,0,2) == '01'){$mth1 = 'january';}
    if(substr($mth1_mmyy,0,2) == '02'){$mth1 = 'february';}
    if(substr($mth1_mmyy,0,2) == '03'){$mth1 = 'march';}
    if(substr($mth1_mmyy,0,2) == '04'){$mth1 = 'april';}
    if(substr($mth1_mmyy,0,2) == '05'){$mth1 = 'may';}
    if(substr($mth1_mmyy,0,2) == '06'){$mth1 = 'june';}
    if(substr($mth1_mmyy,0,2) == '07'){$mth1 = 'july';}
    if(substr($mth1_mmyy,0,2) == '08'){$mth1 = 'august';}
    if(substr($mth1_mmyy,0,2) == '09'){$mth1 = 'september';}
    if(substr($mth1_mmyy,0,2) == '10'){$mth1 = 'october';}
    if(substr($mth1_mmyy,0,2) == '11'){$mth1 = 'november';}
    if(substr($mth1_mmyy,0,2) == '12'){$mth1 = 'december';}
    
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
 
    
    
}
else {

 
 
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
 
    

}
//if($mth2 == ''){$mth2 = date('my',strtotime("first day of previous month"));}
$query13 = "select * from cstcmis.veh0214 where vehno = '" . $vehno . "'";
    $result13=mysqli_query($cstccon,$query13);
    $row13= mysqli_fetch_array ($result13);
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Vehicle - Performance</title>
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
				
				<li class="active">Performance - Vehicle</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Performance Details : <b><?php echo $vehno ; ?></b></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
               <?php echo '<h6>MODEL : ' . $row13['model'] . ' ; DATE OF COMMISSION : ' . $row13['commdate'] . ' ; TOTAL K.M. : ' . $row13['tot_km'] . '</h6>' ;?> 
              <p align='center'>


<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=january';" value="JANUARY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=february';" value="FEBRUARY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=march';" value="MARCH" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=april';" value="APRIL" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=may';" value="MAY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=june';" value="JUNE" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=july';" value="JULY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=august';" value="AUGUST" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=september';" value="SEPTEMBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=october';" value="OCTOBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=november';" value="NOVEMBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_VehicleQry.php?q=december';" value="DECEMBER" />

</p>

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
                    Daily Operation Details
                        </div>
                       


                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                  
                                    <tr style='font-size: 10px;'>
                 
                                   <th style="text-align:center;padding: 10px;">SRL.</th>
                                    <th style="text-align:center;padding: 10px;">DATE</th>
                                
                                    <th style="text-align:center;padding: 10px;">SHIFT</th>
                                    <th style="text-align:center;padding: 10px;">ROUTE NO.</th>
                                    <th style="text-align:center;padding: 10px;">SCHEDULE KM</th>
                                   
                                    <th style="text-align:center;padding: 10px;"><b>K.M. CANCELLED</b> </th>
                                    <th style="text-align:center;padding: 10px;"><b>HSD CONSUMED</b> </th>
                                    <th style="text-align:center;padding: 10px;"><b>KMPL</b> </th>
                                    <th style="text-align:center;padding: 10px;"><b>REVENUE</b> </th>
                                    
                                    
									
                               
                </tr>
                                </thead>
                                <tbody>
                                  <?php    
                                  $number = cal_days_in_month(CAL_GREGORIAN, substr($mth,0,2),'20' . substr($mth,2,2)); // 31
                                                     $dt = 1 ;           
                                                              $srl = 1;
                                                              for($x = 1;$x <= $number;$x++){
                                                             // echo $x ;
                                                               if($x < 10){$x_disp = '0' . $x ;}
                                                               else{$x_disp = $x;}
                                                               $wb_date = $x_disp . '-' . substr($mth,0,2) . '-' . '20' . substr($mth,2,2)  ; 
                                                               $wb_date_xx = '20' . substr($mth,2,2)  . '-' . substr($mth,0,2) . '-' . $x_disp;
                                                               $filename = 'cstcmis.cb' . $mth ;
                                                               $query = "select * from " . $filename . " where veh_no = '" . $vehno . "'  and wb_date  = '" . $wb_date_xx .  "' order by ser_shift";
                                                              
                                                               $result=mysqli_query($cstccon,$query);
                                                                   
								?>
								
                                                                <?php if(mysqli_num_rows($result) > 0){
                                                                    while ($row = mysqli_fetch_assoc($result)){
                                                                   // $row = mysqli_fetch_assoc($result);
                                                                    ?>
                                                                <tr style='font-size: 10px;'>
                                                               <td style="text-align:center; word-break:break-all; "> <?php echo $srl; ?></td>
                                                                                                             
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $wb_date; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['ser_shift']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['route']; ?></td>
								<?php
                                                               // $commdate = substr($row['commdate'],8,2) . '-' . substr($row['commdate'],5,2) . '-' . substr($row['commdate'],0,4) ; 
                                                                ?>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['sch_km']; ?></td>
                                                                <?php 
                                                                if($row ['trp_sch'] > 0){
                                                                $act_km = $row ['sch_km'] * $row ['trp_dn'] / $row ['trp_sch'];}
                                                                else{
                                                                    $act_km = 0;
                                                                }
                                                                $cancel_km = $row ['sch_km'] - $act_km ?>
                                                                <td style="text-align:center; word-break:break-all; "> <?php 
                                                                if($cancel_km > 0){
                                                                echo number_format($cancel_km,1);} ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['hsd']; ?></td>
                                                                <?php
                                                                if($row ['hsd'] > 0){
                                                                $kmpl = number_format($act_km / $row ['hsd'],2 );}
                                                                else{
                                                                    $kmpl = '';
                                                                }
                                                                ?>                                            
                                                               
                                                               
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $kmpl; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['tic_amt']; ?></td>
                                                                </tr>
                                                                    <?php
                                                                }$srl = $srl + 1;}
                                                               else{?>
                                                                <tr style='font-size: 10px;'>
                                                                  <td style="text-align:center; word-break:break-all; "> <?php echo $srl; ?></td>
                                                                                                             
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $wb_date; ?></td>
                                                                <td colspan='7' style="text-align:center; word-break:break-all;color:red ">NOT OUTSHEDDED </td>
                                                                </tr>
                                                      <?php         
                                                              }
                                                              $srl = $srl + 1;
                                                              }
                                                              
                                                          
                                         ?>                                                         
                                                                <!-- Modal -->
								
                                                             
                                                                
								</tr>

							
               
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
        
<style>
        table.data-table td {
    padding: 10px;
        
        }
    </style>

</body>
</html>
