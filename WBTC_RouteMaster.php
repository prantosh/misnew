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
	<title>Route Master List</title>
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
				
				<li class="active">Route Master</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Route Master <small>Detail List</small></h1>
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
                            <a href="WBTC_Modal_RouteMasterAdd.php" class="btn btn-info" role="button">Add New Route</a>
                           
               <a href="WBTC_Modal_RouteMasterMod.php" class="btn btn-info" role="button">Modify Existing Route</a>
                    
                   
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered"  style="font-size: 10">
                                <thead>
                                    <tr>
                    <tr>
                                    <th style="text-align:center;"><b>SRL</b> </th>
                                    <th style="text-align:'left';"><b>ROUTE</b></th>
                                    <th width="15%"style="text-align:center;">FROM</th>
                                    <th width="15%"style="text-align:center;">TO </th>
                                    <th style="text-align:center;">VIA </th>
                                    <th style="text-align:center;">RUN BY DEPOT </th>
                                    <th style="text-align:center;">LENGTH (KM) </th>
                                   
									
                                </tr>
                                    
                                  
                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                                $i=1;
								//session_start();
                                                                $sql_itm="SELECT * FROM cstcmis.route_master";
                                                                $result=mysqli_query($cstccon,$sql_itm);
								//$result= mysqli_query($cstccon,"select * from daily_record_model where unit = '" . $_SESSION['UNIT'] . "' order by op_date ASC" ) or die (mysqli_error());
								while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                                $id = $row['RT_NO'];
                                                                
								?>
								<tr>
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo $i; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['RT_NO']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php
                                                                $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['FROM_ST'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                echo $row1 ['STOP_DESC']; 
                                                                ?></td>
								
								<td style="text-align:center; word-break:break-all; "> <?php 
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['TO_ST'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                echo $row1 ['STOP_DESC'];?>
                                                                </td>
                                                                <?php 
                                                               
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA1'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via1 =  $row1 ['STOP_DESC'];
                                                                
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA2'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via2 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA3'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via3 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA4'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via4 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA5'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via5 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA6'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via6 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA7'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via7 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA8'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via8 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA9'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via9 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA10'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via10 =  ', ' . $row1 ['STOP_DESC'];
                                                               
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA11'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via11 =  ', ' . $row1 ['STOP_DESC'];
                                                                 $sql_itm1="SELECT STOP_DESC FROM cstcmis.stop_master where STOP_CODE = " . $row ['VIA12'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                $via12 =  ', ' . $row1 ['STOP_DESC'];
                                                                
                                                                if($via1 == ', -SELECT-'){$via1 = '';}
                                                                if($via2 == ', -SELECT-'){$via2 = '';}
                                                                if($via3 == ', -SELECT-'){$via3 = '';}
                                                                if($via4 == ', -SELECT-'){$via4 = '';}
                                                                if($via5 == ', -SELECT-'){$via5 = '';}
                                                                if($via6 == ', -SELECT-'){$via6 = '';}
                                                                if($via7 == ', -SELECT-'){$via7 = '';}
                                                                if($via8 == ', -SELECT-'){$via8 = '';}
                                                                if($via9 == ', -SELECT-'){$via9 = '';}
                                                                if($via10 == ', -SELECT-'){$via10 = '';}
                                                                if($via11 == ', -SELECT-'){$via11 = '';}
                                                                if($via12 == ', -SELECT-'){$via12 = '';} 
                                                                
                                                                if($row ['DEPOT1'] == 'XX'){$depot1 = '';}
                                                                else{$depot1 = $row ['DEPOT1'];}
                                                                if($row ['DEPOT2'] == 'XX'){$depot2 = '';}
                                                                else{$depot2 = ', ' . $row ['DEPOT2'];}
                                                                if($row ['DEPOT3'] == 'XX'){$depot3 = '';}
                                                                else{$depot3 = ', ' . $row ['DEPOT3'];}
                                                                if($row ['DEPOT4'] == 'XX'){$depot4 = '';}
                                                                else{$depot4 = ', ' . $row ['DEPOT4'];}
                                                                
                                                                ?>
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $via1 .  $via2 .  $via3 .  $via4 .  $via5 .  $via6 .  $via7 .  $via8 .  $via9 .  $via10 .  $via11 .  $via12  ; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $depot1 . $depot2 . $depot3 . $depot4  ; ?></td>
								
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['LENGTH']; ?></td>
                                                               
                                                                
                                                                
                                                                
                                                                
                                                                
								
								                                                 
                                                                <!-- Modal -->
								
                                                                
                                                                
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

								<?php $i=$i+1;} ?>
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
