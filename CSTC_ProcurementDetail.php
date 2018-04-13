<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
require_once('Connections/cstccon.php'); 
$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$date_from_pro1          = htmlspecialchars($_POST['datepicker-default1'],ENT_QUOTES); 
$date_to_pro1          = htmlspecialchars($_POST['datepicker-default2'],ENT_QUOTES); 

$date_from_pro = substr($date_from_pro1,6,4) . '-' . substr($date_from_pro1,3,2) . '-' . substr($date_from_pro1,0,2);

$date_to_pro = substr($date_to_pro1,6,4) . '-' . substr($date_to_pro1,3,2) . '-' . substr($date_to_pro1,0,2);


$sql_itmG2="select B.DLV_DOC,B.RCT_DT,A.PART_NO,C.DLV_QTY,A.UNT_RT,A.cd,A.cgst,A.sgst,A.igst,B.GSTIN FROM poitm A,matrct B,matrctitm C,vnd D,po E where A.PART_NO = C.PART_NO AND A.PO_NO = B.PO_NO AND B.MAT_RCT_NO = C.MAT_RCT_NO AND E.VND_ID = D.VND_ID AND E.PO_NO = A.PO_NO AND B.RCT_DT >= '" . $date_from_pro . "' and B.RCT_DT <= '" . $date_to_pro . "'";
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
	<title>Procurement Detail </title>
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
				
				<li class="active">Procurement Detail</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Procurement Detail<small><?php echo 'From : ' . $date_from_pro1 . ' To : ' . $date_to_pro1 ; ?></small></h1>
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
                                    <tr >
                            <th style='text-align:center'>NO.</th>
                            <th style='text-align:center'>QTY</th>
                            <th style='text-align:center'>RATE</th>
                            <th style='text-align:center'>DISC%</th>
                            <th style='text-align:center'>CGST%</th>
                            <th style='text-align:center'>SGST%</th>
                            <th style='text-align:center'>IGST%</th>
                            <th style='text-align:center'>CGST</th>
                            <th style='text-align:center'>SGST</th>
                            <th style='text-align:center'>IGST</th>
                            <th style='text-align:center'>GST TOTAL</th>
                            <th style='text-align:center'>GROSS VALUE</th>
                            <th style='text-align:center'>GSTIN</th>
                            
                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $srl = 1;
                                    $cgst_tot = 0;
                                    $sgst_tot = 0;
                                    $igst_tot = 0;

                                         while ($rowx2 = mysqli_fetch_assoc($Recordsetx22)){
                                             
                                       
                                             
                                           echo "<tr style='color:black;'>";
                                         echo "<td style='text-align:center'>";
                                         echo $rowx2['DLV_DOC']; 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                         echo $rowx2['DLV_QTY']; 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                         echo number_format($rowx2['UNT_RT'],2); 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                         echo $rowx2['cd']; 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                         echo $rowx2['cgst']; 
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                         echo $rowx2['sgst']; 
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                         echo $rowx2['igst']; 
                                         echo "</td>";
                                         $value_pro = $rowx2['DLV_QTY'] * $rowx2['UNT_RT'];
                                         $cd = $value_pro * $rowx2['cd'] / 100; 
                                         
                                         $cgst = ($value_pro -$cd) * $rowx2['cgst'] / 100;
                                         $sgst = ($value_pro -$cd) * $rowx2['sgst'] / 100;
                                         $igst = ($value_pro -$cd) * $rowx2['igst'] / 100;
                                          echo "<td style='text-align:center'>";
                                         echo number_format($cgst,0); 
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                         echo number_format($sgst,0); 
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                         echo number_format($igst,0);  
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                         echo number_format(($cgst + $sgst + $igst),0); 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                         echo number_format(($value_pro - $cd + $cgst + $sgst + $igst),0);  
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                         echo $rowx2['GSTIN']; 
                                         echo "</td>";
                                            echo "</tr>";
                                            $cgst_tot = $cgst_tot + $cgst ;
                                             $sgst_tot = $sgst_tot + $sgst ;
                                              $igst_tot = $igst_tot + $igst ;
                                         $srl = $srl + 1;
                                        }
                                       
                                             echo "<tr style='color:black;'>";
                                         echo "<td style='text-align:center'>";
                                        // echo $rowx2['DLV_DOC']; 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                        // echo $rowx2['DLV_QTY']; 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                       //  echo number_format($rowx2['UNT_RT'],2); 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                        // echo $rowx2['cd']; 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                        // echo $rowx2['cgst']; 
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                        // echo $rowx2['sgst']; 
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                       //  echo $rowx2['igst']; 
                                         echo "</td>";
                                         
                                          echo "<td style='text-align:center'>";
                                         echo number_format($cgst_tot,0); 
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                         echo number_format($sgst_tot,0); 
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                         echo number_format($igst_tot,0);  
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                       //  echo number_format(($cgst + $sgst + $igst),0); 
                                         echo "</td>";
                                         echo "<td style='text-align:center'>";
                                       //  echo number_format(($value_pro - $cd + $cgst + $sgst + $igst),0);  
                                         echo "</td>";
                                          echo "<td style='text-align:center'>";
                                        // echo $rowx2['GSTIN']; 
                                         echo "</td>";
                                            echo "</tr>";
                                            

                                        
                                        
                                        ?>
               
               
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
