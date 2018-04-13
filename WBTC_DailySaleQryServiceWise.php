<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 
if(!isset($_SESSION['q'])){$_SESSION['q'] = date("d",strtotime(' -1 day'));}
if(isset($_GET['q'])){$_SESSION['q'] = $_GET['q'];}

$day = $_SESSION['q'];
$cur_date = date('Y-m',strtotime("first day of this month")) . '-' . $day;
if(intval($day) >= intval(date('j')) ){
    $cur_date = date('Y-m',strtotime("first day of previous month")) . '-' . $day;
}     
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Daily Service Wise Sale</title>
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
				
				<li class="active">Sevice Wise Performance</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">DAILY SERVICE WISE PERFORMANCE DETAILS <small><?php echo substr($cur_date,8,2) . "-" . substr($cur_date,5,2) . "-" . substr($cur_date,0,4) ; ?></small></h1>
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
                    Click on the Date below
                        </div>
<p></p>
<p align='center'>
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=01';" value="01" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=02';" value="02" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=03';" value="03" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=04';" value="04" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=05';" value="05" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=06';" value="06" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=07';" value="07" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=08';" value="08" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=09';" value="09" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=10';" value="10" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=11';" value="11" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=12';" value="12" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=13';" value="13" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=14';" value="14" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=15';" value="15" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=16';" value="16" />
</p>
<p align='center'>
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=17';" value="17" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=18';" value="18" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=19';" value="19" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=20';" value="20" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=21';" value="21" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=22';" value="22" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=23';" value="23" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=24';" value="24" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=25';" value="25" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=26';" value="26" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=27';" value="27" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=28';" value="28" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=29';" value="29" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=30';" value="30" />
<input type="button" class='btn-mini'onclick="location.href='WBTC_DailySaleQryServiceWise.php?q=31';" value="31" />
</p>
<p></p>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                  <tr>
                                    <th style="text-align:center;">SHIFT </th>
                                    <th style="text-align:center;">CAR </th>
                                    <th style="text-align:center;">DRIVER </th>
                                    <th style="text-align:center;">COND. </th>
                                    
                                    <th style="text-align:center;">ROUTE </th>
                                    <th style="text-align:center;">VEHICLE</th>
                                    <th style="text-align:center;">DEPOT</th>


                                    <th style="text-align:center;">SALE </th>
                                   
                                    <th style="text-align:center;">K.M. RUN</th>
                                    <th style="text-align:center;">K.M. CNCL </th>
                                    <th style="text-align:center;">EPKM </th>
                                    
									
                                </tr>
                </tr>
                                </thead>
                                <tbody>
                                   <?php
								
                                                               
                                                                $query = "select * from cstcmis.cb where  wb_date = '" . $cur_date . "' and tic_amt > 0 order by route1,ser_shift,ser_car_no";

                                                               
                                                                $result=mysqli_query($cstccon,$query);
                                                                $i=1;
                                                                while ($row1= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                               
								?>
                                    <tr style="font-size: 10px">
                                                                
                                                               
                                                                
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row1['ser_shift'] ; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row1['ser_car_no'] ; ?></td>

                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row1['drv_no']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row1['cnd_no'] ; ?></td>
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row1['route']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row1['veh_no']; ?></td>
                                                                <?php
                                                                $query2 = "select macid,depot from cstcmis.veh0214 where vehno = '" . $row1['veh_no'] . "'";
                                                                $result2=mysqli_query($cstccon,$query2);
                                                                $row2= mysqli_fetch_array ($result2);
                                                                $macid = $row2['macid']; 
                                                                $depot  = $row2['depot'];?>
                                                                 <td style="text-align:center; word-break:break-all; "> <?php echo $depot; ?></td>
                                                             
                                                                
                                                               
                                                               
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row1['tic_amt'] ;?></td>
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row1['sch_km'] * ($row1['trp_dn'] / $row1['trp_sch'] ),1) ;?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row1['sch_km'] - ($row1['sch_km'] * ($row1['trp_dn'] / $row1['trp_sch'] )),1);?></td>
                                                                <td style="text-align:center; word-break:break-all; "> 
                                                                    <?php 
                                                                    if($row1['trp_dn'] > 0){
                                                                    echo number_format($row1['tic_amt'] / ($row1['sch_km'] * ($row1['trp_dn'] / $row1['trp_sch'] )),2) ;}
                                                                    else{
                                                                        echo '***';
                                                                    }
                                                                        ?>
                                                                </td>

                                                                
                                                                
                                                                
                                                                                                  
                                                                <!-- Modal -->
								
                                                             
                                                                
								</tr>

								

								<?php $i=$i+1; } ?>
               
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
