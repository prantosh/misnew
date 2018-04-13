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
$mth = $_GET['q'];    
$_SESSION['mth'] = date('my',strtotime("first day of $mth"));
}

$mth = $_SESSION['mth'];
//$mth2 = $_SESSION['mth2'];

 if($mth == ''){$mth = date('my',strtotime("first day of this month"));}
 //$mth1 = $_GET['q'];
  $query1 = "select * from cstcmis.month_year where month = '" . $mth . "'";
    $result1=mysqli_query($cstccon,$query1);
    $row1= mysqli_fetch_array ($result1);
    $year = $row1['year'];
								
 
 if($mth == 'december'){$mth = '12' . $year ;}
 if($mth == 'november'){$mth = '11' . $year ;}
 if($mth == 'october'){$mth =  '10' . $year ;}
 if($mth == 'september'){$mth = '09' . $year ;}
 if($mth == 'august'){$mth = '08' . $year ;}
 if($mth == 'july'){$mth = '07' . $year ;}
 if($mth == 'june'){$mth = '06' . $year ;}
 if($mth == 'may'){$mth = '05' . $year ;}
 if($mth == 'april'){$mth = '04' . $year ;}
 if($mth == 'march'){$mth = '03' . $year ;}
 if($mth == 'february'){$mth = '02' . $year ;}
 if($mth == 'january'){$mth = '01' . $year ;}
 

if(!isset($_SESSION['d'])){$_SESSION['d'] = 'BD';}


if(isset($_GET['d'])){$_SESSION['d'] = $_GET['d'];}


if($_SESSION['d'] != 'CSTC'){
 $query14 = "select * from cstcmis.unit where UNIT = '" . $_SESSION['d'] . "'";
    $result14=mysqli_query($cstccon,$query14);
    $row14= mysqli_fetch_array ($result14);
    $unit_desc = $row14['UNIT_DESC'];
}
else{
    $unit_desc = "CSTC";
}
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Model-Wise Daily Performance</title>
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
				
				<li class="active">Performance - Model-Wise</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Day and Model Wise Performance : <small><?php echo $unit_desc ; ?></small></h1>
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
                    Select Month and Depot 
                        </div>
                        <p></p>
<p align='center'>


<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=january';" value="JANUARY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=february';" value="FEBRUARY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=march';" value="MARCH" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=april';" value="APRIL" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=may';" value="MAY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=june';" value="JUNE" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=july';" value="JULY" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=august';" value="AUGUST" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=september';" value="SEPTEMBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=october';" value="OCTOBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=november';" value="NOVEMBER" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?q=december';" value="DECEMBER" />

</p>
<p align='center'>
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=BD';" value="BD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=ND';" value="ND" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=PD';" value="PD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=MD';" value="MD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=SLD';" value="SLD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=KD';" value="KD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=GD';" value="GD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=LD';" value="LD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=TD';" value="TD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=TPD';" value="TPD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=HD';" value="HD" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailyQueryModel.php?d=CSTC';" value="CSTC" />

</p>

                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr style='font-size: 10px'>
                                    <th style="text-align:center;"><b></b> </th>
                                    <th style="text-align:center;"></th>
                                    
                                    <th colspan='2'style="text-align:center;">OUTSHED </th>
                                   
                                    <th style="text-align:center;">% TRIP </th>
                                    <th  style="text-align:center;">KM </th>
                                    
                                    
                                    <th style="text-align:center;"><b></b> </th>
                                    <th colspan='3'style="text-align:center;">SALE </th>
                                    
                                    <th colspan='3'style="text-align:center;">EPKM </th>
                                    
									
                                </tr>
                                    <tr style='font-size: 10px'>
                  
                                    <th style="text-align:center;">DATE</th>
                                
                                    <th style="text-align:center;">MODEL</th>
                                    <th style="text-align:center;">1ST</th>
                                    <th style="text-align:center;">2ND</th>
                                    <th style="text-align:center;">LOSS</th>
                                    <th style="text-align:center;"></th>
                                    
                                   
                                    <th style="text-align:center;">KMPL</th>
                                    <th style="text-align:center;">1ST</th>
                                    <th style="text-align:center;">2ND</th>
                                    <th style="text-align:center;">TOTAL</th>
                                    <th style="text-align:center;">1ST</th>
                                    <th style="text-align:center;">2ND</th>
                                    <th style="text-align:center;">TOTAL</th>
                                    
                                    
									
                                </tr>
              
                                </thead>
                                <tbody>
                                  <?php
								
                                                                 if($_SESSION['d'] == 'CSTC'){ 
                                                                $query = "select a.op_date op_date1,a.model model1,sum(a.veh_out_1st)veh_out_1st1,sum(a.veh_out_2nd) veh_out_2nd1,sum(a.sch_trip) sch_trip1,sum(a.act_trip) act_trip1,sum(a.km) km1,sum(a.km_2nd) km_2nd1,sum(a.hsd) hsd1,sum(a.sale_1st) sale_1st1,sum(sale_2nd) sale_2nd1 from cstcmis.daily_record_model a where (a.sale_1st + a.sale_2nd) > 0 and DATE_FORMAT(a.op_date,'%m%y') = '" . $mth . "'  group by a.op_date,a.model order by a.op_date desc,a.unit,a.model";

                                                                 }
                                                               else{ 
                                                                $query = "select a.op_date op_date1,a.model model1,a.veh_out_1st veh_out_1st1,a.veh_out_2nd veh_out_2nd1,a.sch_trip sch_trip1,a.act_trip act_trip1,a.km km1,a.km_2nd km_2nd1,a.hsd hsd1,a.sale_1st sale_1st1,sale_2nd sale_2nd1 from cstcmis.daily_record_model a where (a.sale_1st + a.sale_2nd) > 0  and a.unit = '" . $_SESSION['d'] . "' and DATE_FORMAT(a.op_date,'%m%y') = '" . $mth . "' order by a.op_date desc,a.unit,a.model";
                                                               }
                                                                
                                                                $result=mysqli_query($cstccon,$query);
								while ($row= mysqli_fetch_array ($result) ){
								?>
								<tr style='font-size: 10px'>
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo substr($row['op_date1'],8,2) . '-' . substr($row['op_date1'],5,2) . '-' . substr($row['op_date1'],0,4) ; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['model1']; ?></td>
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['veh_out_1st1']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['veh_out_2nd1']; ?></td>
                                                                
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php if($row['sch_trip1'] > 0){
                                                                echo number_format(($row['sch_trip1'] - $row['act_trip1']) * 100 / $row['sch_trip1'],1);}?>
                                                                </td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['km1'] + $row ['km_2nd1']; ?></td>
                                                               
                                                               
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php if($row['hsd1']  > 0){
                                                                echo number_format(($row['km1'] + $row['km_2nd1']) / ($row['hsd1']),2);}?>
                                                                </td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['sale_1st1']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['sale_2nd1']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['sale_1st1'] + $row['sale_2nd1']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                    <?php if($row['km1'] > 0){
                                                                echo number_format(($row['sale_1st1']) / ($row['km1']),2);}?>
                                                                </td>
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php if($row['km_2nd1'] > 0){
                                                                echo number_format(($row['sale_2nd1']) / ($row['km_2nd1']),2);}?>
                                                                </td>
                                                                <td style="text-align:center; word-break:break-all; ">
                                                                <?php if($row['km_2nd1'] + $row['km1'] > 0){
                                                                echo number_format(($row['sale_1st1'] + $row['sale_2nd1']) / ($row['km_2nd1'] + $row['km1']),2);}?>
                                                                </td>
                                                          
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
