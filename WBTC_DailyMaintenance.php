<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
require_once('Connections/cstccon.php'); 


 
 if(isset($_POST['maint_tp'])){
 $maint_type       = htmlspecialchars($_POST['maint_tp'],ENT_QUOTES);
 $_SESSION['maint_type'] = $maint_type ;}
 else{
      $maint_type =   $_SESSION['maint_type'];
 }
 if(isset($_POST['indent_ref_date'])){
 $maint_date1       = htmlspecialchars($_POST['indent_ref_date'],ENT_QUOTES);
 $_SESSION['maint_date'] = $maint_date ;}
 else{
      $maint_date =   $_SESSION['maint_date'];
 }
 
 
 
 if($maint_type == '3'){$maint_disp = 'TECHNICAL MAINTENANCE';}
 if($maint_type == '4'){$maint_disp = 'NON-TECHNICAL MAINTENANCE';}
 
 $maint_date = substr($maint_date1,6,4) . '-' .substr($maint_date1,3,2) . '-' . substr($maint_date1,0,2) ;
 
 $sql_itmaa = "insert into cstcmis.maint_tran(vehno) select vehno from cstcmis.veh0214 where depot = '" . $_SESSION['UNIT'] . "' and vehno not in(select vehno from cstcmis.maint_tran where depot = '" . $_SESSION['UNIT'] . "' and maint_date = ' ')";
 $resultaa=mysqli_query($cstccon,$sql_itmaa);

  $sql_itmaa1 = "update cstcmis.maint_tran set depot = '" . $_SESSION['UNIT'] . "' where depot = ' '";
 $resultaa1=mysqli_query($cstccon,$sql_itmaa1);
  ?>
<p></p>




<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Daily Maintenance Details</title>
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
				
				<li class="active">Daily Maintenance</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Daily Maintenance <small></small></h1>
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
                        <?php echo "MAINTENANCE TYPE  - " . $maint_disp ;?>    
                    
                        </div>
                        <div class="panel-body">
                           
    
                            
 <table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                            
    <thead>
        <tr>
            
            <th style="text-align:center;"><b>MAINTENANCE STATUS</b> <i class="fa fa-fw fa-sort"></i></th>
           
            <th style="text-align:center;"><b>VEHICLE NO.</b> <i class="fa fa-fw fa-sort"></i></th>
           
            <th style="text-align:center;"><b>MODEL</b> <i class="fa fa-fw fa-sort"></i></th>

            <th style="text-align:center;">DATE OF MAINTENANCE<i class="fa fa-fw fa-sort"></i></th>
            <th style="text-align:center;">MAINTENANCE TYPE<i class="fa fa-fw fa-sort"></i></th>
            <th style="text-align:center;">UPDATE ON <i class="fa fa-fw fa-sort"></i></th>
            <th style="text-align:center;">UPDATE BY <i class="fa fa-fw fa-sort"></i></th>
        </tr>
    </thead>
    <tbody>
	<?php
								//session_start();
                                                               //             SELECT veh0214.vehno vehno1,veh0214.model model1 FROM veh0214 LEFT JOIN maint_tran ON veh0214.vehno = maint_tran.vehno where veh0214.cur_stat = 'S' and veh0214.depot = 'HD' and maint_tran.maint_code = 4 and maint_date = '2018-03-26' ORDER BY veh0214.vehno

$sql_itm = "SELECT * from cstcmis.maint_tran where depot = '" . $_SESSION['UNIT'] . "' and maint_date = '" . $maint_date . "' ORDER BY vehno";
                                                           //     $sql_itm="SELECT a.vehno vehno1,a.model model1 from veh0214 a where  a.cur_stat = 'S' and a.depot = '" . $_SESSION['UNIT'] . "' order by a.vehno";
                                                                $result=mysqli_query($cstccon,$sql_itm);
								while ($row= mysqli_fetch_array ($result) ){
                                                                
                                                                
								//$id=$row['student_id'];
                                                                $id = $row['vehno'];
                                                               
                                                                
								?>
								<tr>
                                                                <?php
                                                                if($row ['maint_date'] == ''){
                                                                echo "<td style='text-align:center; word-break:break-all; '> <input type='checkbox' name='checkbox' ></input>";
                                                                echo "</td>";}
                                                                else {
                                                                echo "<td style='text-align:center; word-break:break-all; '> <input type='checkbox' name='checkbox' checked></input>";
                                                                echo "</td>";    
                                                                }
                                                                ?>
                                                                <td width='12%'style="text-align:center; word-break:break-all; "> <?php echo $row ['vehno']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['model']; ?></td>
                                                            
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['maint_date']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php 
                                                                if($maint_type == 3){echo 'TECHNICAL';}
                                                                if($maint_type == 4){echo 'NON-TECHNICAL';}
                                                                ?></td>
								
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo substr($row ['upd_date'],8,2) . '-' . substr($row ['upd_date'],5,2) . '-' .substr($row ['upd_date'],0,4) ; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['op_code']; ?></td>
								
                                                                
                                                                                                
                                                              
                                                                
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
                        
                        
                        
                        $("#tbl_id tbody").delegate("tr", "click", function() {
                        var fourthCellText = $("td:eq(1)", this).text();
  
                        window.location.href="WBTC_DailyMaintUpdate.php?q="+fourthCellText; 
    
    
                        });
		});
	</script>
</body>
</html>
