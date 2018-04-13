<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 
$queryxx1 = "SELECT * from cstcmis.online_users A,cstcmis.cstc_user B where A.user_id = B.USER_ID";
$resultxx1 = mysqli_query($cstccon,$queryxx1) or die(mysqli_error());
//$row = mysqli_fetch_assoc($resultxx);
//$unit_desc = $row['UNIT_DESC'];



session_cache_limiter('must-revalidate');


?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Online Users</title>
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
				
				<li class="active">Users Online</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Users Online <small>Detail List</small></h1>
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
                      <a href="WBTC_Modal_DailyEntryTrafficDisp.php" class="btn btn-info" role="button">Add Model Wise Performance</a>
                           
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr style="font-size: 8">
                                    <th style="text-align:center;"><b>DATE</b> </th>
                                    <th style="text-align:center;font-size: 10px"><b>MODEL</b> </th>
                                    <th style="text-align:center;">OUT I </th>
                                    <th style="text-align:center;">OUT II </th>
                                    <th style="text-align:center;">SCH TRIP </th>
                                    <th style="text-align:center;">ACT TRIP </th>
                                    <th style="text-align:center;">KM I </th>
                                    <th style="text-align:center;">KM II </th>
                                    <th style="text-align:center;">HSD </th>
                                    <th style="text-align:center;">SALE I </th>
                                    <th style="text-align:center;">SALE II </th>
                                    <th style="text-align:center;">USER </th>
                                    <th style="text-align:center;">ACTION</th>
                                    <th style="text-align:center;">ACTION</th>
									
                                </tr>
                            </thead>
                                 <tbody>
								<?php
								//session_start();
                                                                $sql_itm="SELECT * FROM cstcmis.daily_record_model WHERE unit ='" . $_SESSION['UNIT'] . "' and op_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() and (sale_1st + sale_2nd) > 0 order by op_date desc, model";
                                                                $result=mysqli_query($cstccon,$sql_itm);
								//$result= mysqli_query($cstccon,"select * from daily_record_model where unit = '" . $_SESSION['UNIT'] . "' order by op_date ASC" ) or die (mysqli_error());
								while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                                $id = $row['id'];
                                                                $op_date = $row['op_date'];
                                                                $model = $row['model'];
								?>
								<tr style="font-size: 8">
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['op_date']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['model']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['veh_out_1st']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['veh_out_2nd']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['sch_trip']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['act_trip']; ?></td>
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['km']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['km_2nd']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['hsd']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['sale_1st']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['sale_2nd']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['op_code']; ?></td>
								
                                                                
                                                                <td style="text-align:center; ">
                                                                <?php    $sql_itm1="SELECT datediff(now(),'" . $row ['op_date'] . "') days FROM cstcmis.daily_record_model WHERE id =" . $id ;
                                                                        $result1=mysqli_query($cstccon,$sql_itm1);
                                                                        $row1 =  mysqli_fetch_array ($result1);
                                                                   //     if($_SESSION['ROLE'] == '2' and $row1['days'] <= $no_of_days){
                                                                   if($row['op_date'] == date('Y-m-d',strtotime("-1 days"))){         ?>
                                                                    <a href="WBTC_Modal_DailyEntryTrafficDispEdit.php<?php echo '?id='.$id; ?>" class=" btn-info">EDIT</a>
                                                                   <?php } ?>	
								</td>
                                                                <td style="text-align:center; ">
                                                                <?php    $sql_itm1="SELECT datediff(now(),'" . $row ['op_date'] . "') days FROM cstcmis.daily_record_model WHERE id =" . $id ;
                                                                        $result1=mysqli_query($cstccon,$sql_itm1);
                                                                        $row1 =  mysqli_fetch_array ($result1);
                                                                   //     if($_SESSION['ROLE'] == '2' and $row1['days'] <= $no_of_days){
                                                                     if($row['op_date'] == date('Y-m-d',strtotime("-1 days"))){         ?>
                                                                    <a href="WBTC_Modal_DailyEntryTrafficDispDelete.php<?php echo '?id='.$id; ?>" class=" btn-danger">DELETE</a>
									 <?php } ?>	
								</td>
                                                                
                                                                
                                                                
                                                                
                                                                
								
								                                                 
                                                              
                                                                
								</tr>

								<!-- Modal Bigger Image -->
								<div id="<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">

								<h3 id="myModalLabel"><b><?php echo $row['out_1st']." ".$row['out_2nd']; ?></b></h3>
								</div>
								<div class="modal-body">
								<?php if($row['location'] != ""): ?>
								<img src="upload/<?php echo $row['location']; ?>" style="width:390px; border-radius:9px; border:5px solid #d0d0d0; margin-left: 63px; height:387px;">
								<?php else: ?>
								<img src="images/default.png" style="width:390px; border-radius:9px; border:5px solid #d0d0d0; margin-left: 63px; height:387px;">
								<?php endif; ?>
								</div>
								<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
								</div>
								</div>

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
