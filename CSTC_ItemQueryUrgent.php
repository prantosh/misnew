<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
require_once('Connections/cstccon.php'); 
$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
$sql_itmG2="SELECT * from bincrd where PART_NO IN (SELECT PART_NO FROM urgent_item_list) and FIN_YR = '" . $CUR_FIN_YR . "' order by PART_NO desc";
$Recordsetx22=mysqli_query($cstccon,$sql_itmG2);


?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Essential Items List</title>
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
				
				<li class="active">Essential Items</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Essential Items <small>Detail List</small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			   
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                           
                            ESSENTIAL ITEMS FOR MONITORING
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                  <tr rowspan='2'>
                            <th style='text-align:center'>SRL. NO.</th>
                            <th style='text-align:center'>PART_NO</th>
                            <th width='15%'style='text-align:center'>DESCRIPTION</th>
                            <th style='text-align:center'>UNIT</th>
                            <th style='text-align:center'>RATE</th>
                            <th style='text-align:center'>OPENING QTY.</th>
                            <th style='text-align:center'>RECEIVED QTY.</th>
                            <th style='text-align:center'>ISSUED QTY.</th>
                            <th style='text-align:center'>PENDING ORDER</th>
                            <th style='text-align:center'>PENDING DELIVERY</th>
                            <th style='text-align:center'>STOCK</th>
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
                                         echo "<td style='text-align:center'>";
                                         echo $rowx2['PART_NO'];
                                         echo "</td>";
                         $sql="SELECT ITM_NM,UOM_ID from itm where PART_NO = '" . $rowx2['PART_NO'] . "'";
                         $Recordset=mysqli_query($cstccon,$sql);
                         $row = mysqli_fetch_assoc($Recordset);
                         $itm_nm = $row['ITM_NM'];
                         $uom = $row['UOM_ID'];
                                         echo "<td align='right'>";
                                         echo $itm_nm;
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $uom;
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo number_format($rowx2['LISS_RT'],2);
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['OPNG_QTY'];
                                         echo "</td>";
                                        
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['RCT_QTY'];
                                         echo "</td>";
                                        
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['ISS_QTY'];
                                         echo "</td>";
                         $sql1="SELECT sum(TC_QTY - PO_QTY) qty1 from purreqitm where PART_NO  = '" . $rowx2['PART_NO'] . "'";
                         $Recordset1=mysqli_query($cstccon,$sql1);
                         $row1 = mysqli_fetch_assoc($Recordset1);       
                         $pending_po = $row1['qty1'];              
                                         echo "<td style='text-align:right'>";
                                         echo $pending_po;
                                         echo "</td>";
                         $sql2="SELECT sum(PO_QTY - RCT_QTY) qty2 from poitm where PART_NO  = '" . $rowx2['PART_NO'] . "'";
                         $Recordset2=mysqli_query($cstccon,$sql2);
                         $row2 = mysqli_fetch_assoc($Recordset2); 
                         $pending_delivery = $row2['qty2'];
                                         echo "<td style='text-align:right'>";
                                         echo $pending_delivery;
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo number_format($rowx2['OPNG_QTY'] + $rowx2['RCT_QTY'] - $rowx2['ISS_QTY'],2);
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
