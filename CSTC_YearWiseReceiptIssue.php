<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 
   
$sql_itmG2="SELECT FIN_YR,SUM(OPNG_VAL) OPNG_VAL1,SUM(RCT_VAL) RCT_VAL1,SUM(ISS_VAL) ISS_VAL1 FROM bincrd group by FIN_YR ORDER BY CONVERT(FIN_YR, SIGNED INTEGER) ";
$Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>





<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Inventory Status</title>
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
		<?php  include('CSTC_header.php'); ?>
		<!-- end #header -->
                <!-- begin #sidebar -->
		<?php  include('CSTC_left.php'); ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				
				<li class="active">Year-Wise Inventory Status</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Inventory Status <small>Year Wise</small></h1>
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
                                    <tr rowspan='2'style="color:white;font-weight: bold;background-color: orange;">
                            <th style='text-align:center'>SRL. NO.</th>
                            <th style='text-align:center'>FINANCIAL YEAR</th>
                            <th style='text-align:center'>OPENING STOCK (Rs.)</th>
                            <th style='text-align:center'>RECEIPT (Rs.)</th>
                            <th style='text-align:center'>ISSUE (Rs.)</th>
                            <th style='text-align:center'>INVENTORY (Rs.)</th>
                            
                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $srl = 1;
                                         while ($rowx2 = mysqli_fetch_assoc($Recordsetx22)){
                                           echo "<tr style='color:black;'>";
                                         echo "<td style='text-align:center'>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         if($rowx2['FIN_YR'] == 0){$fin_yr_disp = '1999-2000';}
                                         if($rowx2['FIN_YR'] == 1){$fin_yr_disp = '2000-2001';}
                                         if($rowx2['FIN_YR'] == 2){$fin_yr_disp = '2001-2002';}
                                         if($rowx2['FIN_YR'] == 3){$fin_yr_disp = '2002-2003';}
                                         if($rowx2['FIN_YR'] == 4){$fin_yr_disp = '2003-2004';}
                                         if($rowx2['FIN_YR'] == 5){$fin_yr_disp = '2004-2005';}
                                         if($rowx2['FIN_YR'] == 6){$fin_yr_disp = '2005-2006';}
                                         if($rowx2['FIN_YR'] == 7){$fin_yr_disp = '2006-2007';}
                                         if($rowx2['FIN_YR'] == 8){$fin_yr_disp = '2007-2008';}
                                         if($rowx2['FIN_YR'] == 9){$fin_yr_disp = '2008-2009';}
                                         if($rowx2['FIN_YR'] == 10){$fin_yr_disp = '2009-2010';}
                                         if($rowx2['FIN_YR'] == 11){$fin_yr_disp = '2010-2011';}
                                         if($rowx2['FIN_YR'] == 12){$fin_yr_disp = '2011-2012';}
                                         if($rowx2['FIN_YR'] == 13){$fin_yr_disp = '2012-2013';}
                                         if($rowx2['FIN_YR'] == 14){$fin_yr_disp = '2013-2014';}
                                         if($rowx2['FIN_YR'] == 15){$fin_yr_disp = '2014-2015';}
                                         if($rowx2['FIN_YR'] == 16){$fin_yr_disp = '2015-2016';}
                                         if($rowx2['FIN_YR'] == 17){$fin_yr_disp = '2016-2017';}
                                         if($rowx2['FIN_YR'] == 18){$fin_yr_disp = '2017-2018';}
                                         if($rowx2['FIN_YR'] == 19){$fin_yr_disp = '2018-2019';}
                                         if($rowx2['FIN_YR'] == 20){$fin_yr_disp = '2019-2020';}
                                         if($rowx2['FIN_YR'] == 21){$fin_yr_disp = '2020-2021';}
                                         if($rowx2['FIN_YR'] == 22){$fin_yr_disp = '2021-2022';}
                                         if($rowx2['FIN_YR'] == 23){$fin_yr_disp = '2022-2023';}
                                         if($rowx2['FIN_YR'] == 24){$fin_yr_disp = '2023-2024';}
                                         if($rowx2['FIN_YR'] == 25){$fin_yr_disp = '2024-2025';}
                                         if($rowx2['FIN_YR'] == 26){$fin_yr_disp = '2025-2026';}
                                         if($rowx2['FIN_YR'] == 27){$fin_yr_disp = '2026-2027';}


                                         echo $fin_yr_disp;
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo number_format($rowx2['OPNG_VAL1'],2);
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo number_format($rowx2['RCT_VAL1'],2);
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo number_format($rowx2['ISS_VAL1'],2);
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         $stock = $rowx2['OPNG_VAL1'] + $rowx2['RCT_VAL1'] - $rowx2['ISS_VAL1'];
                                         echo number_format($stock,2);
                                         echo "</td>";
                                        
                                         echo "</tr>";
                                         $srl = $srl + 1;
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
        <?php  include('CSTC_ThemePanel.php'); ?>
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
