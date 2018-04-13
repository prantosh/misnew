<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
require_once('Connections/cstccon.php'); 
$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
  $sql_itmG2="SELECT A.SBGRP_ID SBGRP_ID1,SUM(B.OPNG_VAL) OPNG_VAL1,SUM(B.RCT_VAL) RCT_VAL1,SUM(B.ISS_VAL) ISS_VAL1,B.FIN_YR FINYR1 FROM itm A, bincrd B where A.PART_NO = B.PART_NO AND B.FIN_YR = '" . $CUR_FIN_YR . "' GROUP BY A.SBGRP_ID,B.FIN_YR ORDER BY A.SBGRP_ID";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);


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
	<title>Category-Wise Inventory Status</title>
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
				
				<li class="active">Category-Wise Inventory Status</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Category-Wise Inventory Status <small>Detail List</small></h1>
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
                                    <tr rowspan='1'>
                            <th style='text-align:center'>SRL. NO.</th>
                            <th style='text-align:center'>CATEGORY</th>
                            <th width='15%'style='text-align:center'>GROUP</th>
                            <th style='text-align:center'>OPENING VALUE</th>
                            <th style='text-align:center'>RECEIVED VALUEE</th>
                            <th style='text-align:center'>ISSUED VALUE</th>
                            <th style='text-align:center'>STOCK VALUE</th>
                            
                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $srl = 1;
                                        $opng_val_tot = 0;
                                        $rct_val_tot = 0;
                                        $iss_val_tot = 0;
                                         while ($rowx2 = mysqli_fetch_assoc($Recordsetx22)){
                                             
                                        $opng_val_tot = $opng_val_tot +  $rowx2['OPNG_VAL1'];    
                                        $rct_val_tot  = $rct_val_tot  +  $rowx2['RCT_VAL1'];  
                                        $iss_val_tot  = $iss_val_tot  +  $rowx2['ISS_VAL1']; 
                                             
                                           echo "<tr style='color:black;'>";
                                         echo "<td style='text-align:center'>";
                                         echo $srl;
                                         echo "</td>";
                                        
                         $sql="SELECT * from itmsbgrp where SBGRP_ID = '" . $rowx2['SBGRP_ID1'] . "'";
                         $Recordset=mysqli_query($cstccon,$sql);
                         $row = mysqli_fetch_assoc($Recordset);
                         $sbgrp_nm = $row['SBGRP_NM'];
                         $grp_id = $row['GRP_ID'];
                         
                         $sql1="SELECT * from itmgrp where GRP_ID = '" . $grp_id . "'";
                         $Recordset1=mysqli_query($cstccon,$sql1);
                         $row1 = mysqli_fetch_assoc($Recordset1);
                         $grp_nm = $row1['GRP_NM'];
                         
                                         echo "<td align='right'>";
                                         echo $grp_nm;
                                         echo "</td>";
                                       
                                         echo "<td align='right'>";
                                         echo $sbgrp_nm;
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
                                         
                                         $stock = $rowx2['OPNG_VAL1'] + $rowx2['RCT_VAL1'] - $rowx2['ISS_VAL1'];
                                         echo "<td style='text-align:right'>";
                                         echo number_format($stock,2);
                                         echo "</td>";
                                        
                                         
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }
                                       
                                        
                                        
                                        
                                        ?>
               
               
                                </tbody>
                                <?php                                 echo "<tr style='color:black;font-weight:bold'>";
                                        echo "<td>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "TOTAL : ";
                                        echo "</td>";
                                        echo "<td style='text-align:right'>";
                                        echo number_format($opng_val_tot,2);
                                        echo "</td>";
                                        echo "<td style='text-align:right'>";
                                        echo number_format($rct_val_tot,2);
                                        echo "</td>";
                                        echo "<td style='text-align:right'>";
                                        echo number_format($iss_val_tot,2);
                                        echo "</td>";
                                        $stock_tot = $opng_val_tot + $rct_val_tot - $iss_val_tot;
                                      
                                         echo "<td style='text-align:right'>";
                                        echo number_format($stock_tot,2);
                                        echo "</td>";
                                        
                                        
                                        echo "</tr>"; ?>
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
