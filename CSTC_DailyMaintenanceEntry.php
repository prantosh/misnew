<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
require_once('Connections/cstccon.php'); 


 
 if(isset($_POST['route'])){
 $route       = htmlspecialchars($_POST['route'],ENT_QUOTES);
 $_SESSION['route'] = $route ;}
 else{
      $route =   $_SESSION['route'];
 }
 
 
 if(isset($_POST['shift'])){
 $shift       = htmlspecialchars($_POST['shift'],ENT_QUOTES);
 $_SESSION['shift'] = $shift ;}
 else{
      $shift =   $_SESSION['shift'];
 }
 if(isset($_POST['maint_tp'])){
 $maint_tp       = htmlspecialchars($_POST['maint_tp'],ENT_QUOTES);
 $_SESSION['maint_tp'] = $maint_tp ;}
 else{
      $maint_tp =   $_SESSION['maint_tp'];
 }
 if($maint_tp == 'M'){$maint_disp = 'MOBILE ALLOTTED';}
 if($maint_tp == 'V'){$maint_disp = 'VTU FITTED';}
 

  ?>
<p></p>




<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Device Allotment List</title>
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
				
				<li class="active">Device Allotment</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Device Allotment (Today) <small></small></h1>
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
                        <?php echo "SHIFT - " . $shift  . " ROUTE - " . $route . " DEVICE : " . $maint_disp ;?>    
                    
                        </div>
                        <div class="panel-body">
                           
    
                            
 <table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                            
    <thead>
        <tr>
            <?php
            if($maint_tp == 'M'){?>
            <th style="text-align:center;"><b>MOBILE-ALLOTTED</b> <i class="fa fa-fw fa-sort"></i></th>
            <?php } ?>
            <?php
            if($maint_tp == 'V'){?>
            <th style="text-align:center;"><b>VTU FITTED</b> <i class="fa fa-fw fa-sort"></i></th>
            <?php } ?>
            <th style="text-align:center;"><b>VEHICLE NO.</b> <i class="fa fa-fw fa-sort"></i></th>

            <th style="text-align:center;">OPERATION DATE <i class="fa fa-fw fa-sort"></i></th>
            <th style="text-align:center;">UPDATE BY <i class="fa fa-fw fa-sort"></i></th>
        </tr>
    </thead>
    <tbody>
	<?php
	    $sql_itm="SELECT a.vehno vehno1,a.model model1 from cstcmis.veh0214 a where  a.cur_stat = 'S' and a.depot = '" . $_SESSION['UNIT'] . "' order by a.vehno";
            $result=mysqli_query($cstccon,$sql_itm);
            while ($row= mysqli_fetch_array ($result) ){
                $id = $row['vehno1'];?>
                <tr>
                <?php if($maint_tp == 'M' and $shift == '1'){
                $sql_itm1="SELECT * from cstcmis.maint_tran_mobile where device = 'M' and shift = '1' and  maint_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and vehno = '" . $row['vehno1'] . "'";
                $result1=mysqli_query($cstccon,$sql_itm1); 
                if(mysqli_num_rows($result1) > 0){
                    echo "<td  '> <input type='checkbox' name='checkbox' checked>Uncheck to Remove</input>";
                    echo "</td>";
                }
                else {
                    echo "<td  '> <input type='checkbox' name='checkbox' >Check to Include</input>";
                    echo "</td>";
                }
                }?>
                    <?php if($maint_tp == 'M' and $shift == '2'){
                $sql_itm1="SELECT * from cstcmis.maint_tran_mobile where device = 'M' and shift = '2' and  maint_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and vehno = '" . $row['vehno1'] . "'";
                $result1=mysqli_query($cstccon,$sql_itm1); 
                if(mysqli_num_rows($result1) > 0){
                    echo "<td  '> <input type='checkbox' name='checkbox' checked>Uncheck to Remove</input>";
                    echo "</td>";
                }
                else {
                    echo "<td  '> <input type='checkbox' name='checkbox' >Check to Include</input>";
                    echo "</td>";
                }
                }?>
                    <?php if($maint_tp == 'V' and $shift == '1'){
                $sql_itm1="SELECT * from cstcmis.maint_tran_mobile where device = 'V' and shift = '1' and  maint_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and vehno = '" . $row['vehno1'] . "'";
                $result1=mysqli_query($cstccon,$sql_itm1); 
                if(mysqli_num_rows($result1) > 0){
                    echo "<td  '> <input type='checkbox' name='checkbox' checked>Uncheck to Remove</input>";
                    echo "</td>";
                }
                else {
                    echo "<td  '> <input type='checkbox' name='checkbox' >Check to Include</input>";
                    echo "</td>";
                }
                }?>
                    <?php if($maint_tp == 'V' and $shift == '2'){
                $sql_itm1="SELECT * from cstcmis.maint_tran_mobile where device = 'V' and shift = '2' and  maint_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and vehno = '" . $row['vehno1'] . "'";
                $result1=mysqli_query($cstccon,$sql_itm1); 
                if(mysqli_num_rows($result1) > 0){
                    echo "<td  '> <input type='checkbox' name='checkbox' checked>Uncheck to Remove</input>";
                    echo "</td>";
                }
                else {
                    echo "<td  '> <input type='checkbox' name='checkbox' >Check to Include</input>";
                    echo "</td>";
                }
                }?>
                
                <?php $row1= mysqli_fetch_array ($result1);?>
		 <td style="text-align:center; word-break:break-all; "> <?php echo $row ['vehno1']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row1 ['maint_date']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row1 ['op_code']; ?></td>
	
        		</tr>
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
                        
                        
                        
                        $("#tbl_id tbody").delegate("tr", "click", function() {
                        var fourthCellText = $("td:eq(1)", this).text();
  
                        window.location.href="CSTC_MaintUpdate.php?q="+fourthCellText; 
    
    
                        });
		});
	</script>
</body>
</html>
