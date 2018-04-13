<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 



session_cache_limiter('must-revalidate');
$query_Recordset2 = "select *  from cstcmis.unit";
$Recordset2 = mysqli_query($cstccon,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);

$query_Recordset21 = "select *  from cstcmis.veh_cur_stat order by cur_stat desc";
$Recordset21 = mysqli_query($cstccon,$query_Recordset21) or die(mysqli_error());
$row_Recordset21 = mysqli_fetch_assoc($Recordset21);
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Employee Master List</title>
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
				
				<li class="active">Employee Master</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Employee Master <small>Detail List</small></h1>
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
                            <a href="WBTC_Modal_EmployeeMasterAdd.php" class="btn btn-info" role="button">Add New Employee</a>
                           
               
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered"  style="font-size: 10px">
                                <thead>
                                    <tr>
                                    <th style="text-align:center;">SRL </th>
                                    <th style="text-align:center;">BADGE NO. </th>
                                    <th style="text-align:center;">PF A/C NO </th>
                                    <th style="text-align:center;">COMP. NO. </th>
                                    
                                    <th style="text-align:center;">NAME </th>
                                    <th style="text-align:center;">GENDER </th>
                                    <th style="text-align:center;">DESIGNATION </th>
                                    <th style="text-align:center;">EMAIL </th>
                                    <th style="text-align:center;">MOBILE NO.</th>
                                    <th style="text-align:center;">DOB </th>
                                    <th style="text-align:center;">DOJ </th>
                                    <th style="text-align:center;">UNIT </th>
                                    <th width='8%'style="text-align:center;">UPDATE </th>
                                    
                                  
                </tr>
                                </thead>
                                <tbody>
                                    <?php
							        $sql_itm="SELECT * FROM cstcmis.cstc_master_new";                                                                $result=mysqli_query($cstccon,$sql_itm);
								$result=mysqli_query($cstccon,$sql_itm);
                                                                $srl = 1;
								while ($row= mysqli_fetch_array ($result) ){
								$id = $row['vehno'];
                                                              
								?>
								<tr>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $srl; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['card']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['empno']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['comp_id']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['name']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['gender']; ?></td>

                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['desig']; ?></td>
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['email']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['mobile']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['dob']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['doj']; ?></td>

                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['depot']; ?></td>
                                                                 <td style="text-align:center; word-break:break-all; "> <?php echo substr($row ['upd_date'],8,2) . '-' . substr($row ['upd_date'],5,2) . '-' .substr($row ['upd_date'],0,4) ; ?></td>
								<td style="text-align:center; ">
                                                                    <?php   
                                                                     if($row['maint_date'] == date('Y-m-d',strtotime("-1 days"))){         ?>
                                                                     <a href="WBTC_Modal_EmployeeMasterEdit.php<?php echo '?id_maint='.$id; ?>" class=" btn-danger">EDIT</a>
									 <?php } ?>	
									
								</td>
								
                                                                
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
