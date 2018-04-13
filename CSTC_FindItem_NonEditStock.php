<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
require_once('Connections/cstccon.php'); 
$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
$query = "SELECT * from itm a,bincrd b WHERE a.CREDT > '2010-01-01' and a.PART_NO = b.PART_NO AND (b.OPNG_QTY + b.RCT_QTY - b.ISS_QTY) > 0 and b.FIN_YR = '" . $CUR_FIN_YR . "' order by a.PART_NO ";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());



header('Cache-Control: no cache'); //no cache

session_cache_limiter('must-revalidate');
$query1 = "SELECT * FROM uom";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());


$query_Recordsetunit_cat = "SELECT * FROM itmsbgrp";
$Recordsetunit_cat = mysqli_query($cstccon,$query_Recordsetunit_cat) or die(mysqli_error());
$row_Recordsetunit_cat = mysqli_fetch_assoc($Recordsetunit_cat);
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Item List Having Inventory</title>
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
				
				<li class="active">Item Master Having Inventory</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Item Master <small>Items Having Inventory</small></h1>
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
                    DEPOT-WISE ISSUE AND PRESENT STOCK AT CENTRAL STORE
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    
                                <tr>
                                    <th style="text-align:center;">FOLIO </th>
                                   <th style="text-align:center;">DESCRIPTION </th>
                                    <th style="text-align:center;">BD</th>
                                    <th style="text-align:center;">ND</th>
                                    <th style="text-align:center;">PD</th>
                                    <th style="text-align:center;">MD</th>
                                    <th style="text-align:center;">SLD</th>
                                    <th style="text-align:center;">KD</th>
                                    <th style="text-align:center;">GD</th>
                                    <th style="text-align:center;">LD</th>
                                    <th style="text-align:center;">TD</th>
                                    <th style="text-align:center;">TPD</th>
                                    <th style="text-align:center;">HD</th>
                                    <th style="text-align:center;">CW</th>
                                    <th style="text-align:center;">STOCK </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                                $x = 1;
							        $sql_itm="SELECT A.PART_NO,B.ITM_NM,C.ALT_NO_3,(A.OPNG_QTY + A.RCT_QTY - A.ISS_QTY) STOCK FROM bincrd A,itm B,current_part_no C where A.PART_NO = B.PART_NO AND A.PART_NO = C.PART_NO AND (A.OPNG_QTY + A.RCT_QTY - A.ISS_QTY) > 0 and A.FIN_YR = '" . $CUR_FIN_YR . "' order by A.PART_NO ";   
                                                                $result=mysqli_query($cstccon,$sql_itm);
								while ($row= mysqli_fetch_array ($result) ){
								//$id = $row['RCT_DT1'];
                                                              
								?>
								<tr>
								<td > <?php echo $row ['PART_NO']; ?></td>
								<td > <?php echo $row ['ITM_NM']; ?></td>
<?php $sql_itm1="SELECT B.PART_NO,A.PRTY_CD PRTY_CD1,SUM(B.ITM_QTY) ITM_QTY_TOT FROM `bintxn` A,bintxnitm B where DATEDIFF(NOW(),A.DOC_DT) < 365 AND  A.BNTXN_ID = B.BNTXN_ID AND B.ITM_QTY < 0 GROUP BY B.PART_NO,A.PRTY_CD HAVING PART_NO = '" . $row ['PART_NO'] . "'";
$result1=mysqli_query($cstccon,$sql_itm1);
$bd_issue = '';
$nd_issue = '';
$pd_issue = '';
$md_issue = '';
$sld_issue = '';
$kd_issue = '';
$gd_issue = '';
$ld_issue = '';
$td_issue = '';
$tpd_issue = '';
$hd_issue = '';
$cw_issue = '';

while ($row1= mysqli_fetch_array ($result1) ){
    if($row1['PRTY_CD1'] == 'BD'){$bd_issue = -$row1['ITM_QTY_TOT'] ;}
    
    if($row1['PRTY_CD1'] == 'ND'){$nd_issue = -$row1['ITM_QTY_TOT'] ;}
   
    if($row1['PRTY_CD1'] == 'PD'){$pd_issue = -$row1['ITM_QTY_TOT'] ;}
    
    if($row1['PRTY_CD1'] == 'MD'){$md_issue = -$row1['ITM_QTY_TOT'] ;}
    
    if($row1['PRTY_CD1'] == 'SLD'){$sld_issue = -$row1['ITM_QTY_TOT'] ;}
    
    if($row1['PRTY_CD1'] == 'KD'){$kd_issue = -$row1['ITM_QTY_TOT'] ;}
    
    if($row1['PRTY_CD1'] == 'GD'){$gd_issue = -$row1['ITM_QTY_TOT'] ;}
    
    if($row1['PRTY_CD1'] == 'LD'){$ld_issue = -$row1['ITM_QTY_TOT'] ;}
    
    if($row1['PRTY_CD1'] == 'TD'){$td_issue = -$row1['ITM_QTY_TOT'] ;}
   
    if($row1['PRTY_CD1'] == 'TPD'){$tpd_issue = -$row1['ITM_QTY_TOT'] ;}
  
    if($row1['PRTY_CD1'] == 'HD'){$hd_issue = -$row1['ITM_QTY_TOT'] ;}
   
    if($row1['PRTY_CD1'] == 'CW'){$cw_issue = -$row1['ITM_QTY_TOT'] ;}
   
}
?>
								<td align="right"> <?php echo $bd_issue; ?></td>
								<td  align="right"> <?php echo $nd_issue; ?></td>
								<td  align="right"> <?php echo $pd_issue; ?></td>
								<td  align="right"> <?php echo $md_issue; ?></td>
								<td  align="right"> <?php echo $sld_issue; ?></td>
								<td  align="right"> <?php echo $kd_issue; ?></td>
								<td  align="right"> <?php echo $gd_issue; ?></td>
								<td  align="right"> <?php echo $ld_issue; ?></td>
								<td  align="right"> <?php echo $td_issue; ?></td>
								<td  align="right"> <?php echo $tpd_issue; ?></td>
								<td  align="right"> <?php echo $hd_issue; ?></td>
								<td  align="right"> <?php echo $cw_issue; ?></td>

                                                               <td  align="right"> <?php echo $row ['STOCK']; ?></td>
														
								
                                                                
								</tr>

								<!-- Modal Bigger Image -->
								

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
