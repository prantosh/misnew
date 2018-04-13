<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 

 if(isset($_POST['indent_ref_date'])){
 $maint_date1       = htmlspecialchars($_POST['indent_ref_date'],ENT_QUOTES);
 $maint_date = substr($maint_date1,6,4) . '-' .substr($maint_date1,3,2) . '-' . substr($maint_date1,0,2) ;
 $_SESSION['maint_date'] = $maint_date ;}
 else{
      $maint_date =   $_SESSION['maint_date'];
 }
 
 
 
 
 $maint_type = 4;
 $maint_disp = 'NON-TECHNICAL MAINTENANCE';
 
 
 


$query_Recordsetveh = "SELECT vehno FROM cstcmis.veh0214 where runfleet = 'R' and depot = '" . $_SESSION['UNIT'] . "' order by vehno";
$Recordsetveh = mysqli_query($cstccon,$query_Recordsetveh) or die(mysqli_error());
$row_Recordsetveh = mysqli_fetch_assoc($Recordsetveh);
$totalRows_Recordsetveh = mysqli_num_rows($Recordsetveh);

$query = "select * from cstcmis.maint_master order by maint_desc";
$Recordset2 = mysqli_query($cstccon,$query) or die(mysqli_error());

//session_cache_limiter('must-revalidate');


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
				
				<li class="active">Non-Technical Maintenance  </li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Non-Technical Maintenance <small>Detail List</small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			   
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            
                            
                            <input type="button" id="btnShow"class="btn btn-info" value="ADD NEW RECORD" />
                            <div class="modal modal-warning fade" id="modal-warning171" data-backdrop="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                            <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">VEHICLE MAINTENANCE DATA </span></h4>
                                        </div>
                                        <form method="post" action="WBTC_VehicleMaintenanceWashingAdd.php"  enctype="multipart/form-data">
                                            <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                                <table style="color:black" >
				                    <tr>
							<td width="5%"></td>
                                                        <td>SELECT VEHICLE NUMBER :</td>
                                                        <td><div class="col-md-14">
                                                                <select class="form-control"name="vehno" id="vehno">
                                                                <?php do { ?>
                                                                    <option value="<?php echo $row_Recordsetveh['vehno']?>"><?php echo $row_Recordsetveh['vehno']?></option>
                                                                <?php
                                                                          } while ($row_Recordsetveh = mysqli_fetch_assoc($Recordsetveh));
                                                                        $rows = mysqli_num_rows($Recordsetveh);
                                                                        if($rows > 0) {
                                                                            mysqli_data_seek($Recordsetveh, 0);
                                                                            $row_Recordsetveh = mysqli_fetch_assoc($Recordsetveh);
                                                                            }?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <input type="hidden" name ="maint_date" value="<?php echo $maint_date ;?>"> 		
						<input type="hidden" name ="maint_code" value="<?php echo $maint_type ;?>"> 		
                                                </table>
                                                <div class="modal-footer"style="color:white ;background-color:#a8a646;">
                                                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    <button type="submit" name="Submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
              
                    
                   
                        </div>
<div class="panel-body">
        
         
<table id="data-table" class="table table-striped table-bordered"  style="font-size: 10px">                            
                            <thead>
                                <tr style="font-size: 8">
                                    <th style="text-align:center;"><b>VEHICLE</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;"><b>MODEL</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">COMMISSION <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">MAINTENANCE DATE <i class="fa fa-fw fa-sort"></i></th>
                                      <th style="text-align:center;">UPDATE <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">UPDATE BY <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">ACTION</th>				
                                </tr>
                            </thead>
                            <tbody>
								<?php
								///session_start();
                                                                $sql_itm="SELECT * FROM cstcmis.maint_tran WHERE maint_code = 4 and depot ='" . $_SESSION['UNIT'] . "' and maint_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
                                                                $result=mysqli_query($cstccon,$sql_itm);
								//$result= mysqli_query($cstccon,"select * from daily_record_model where unit = '" . $_SESSION['UNIT'] . "' order by op_date ASC" ) or die (mysqli_error());
								
                                                                while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                                $id3 = $row['id'];
                                                                $vehno = $row['vehno'];
                                                                $maint_date = $row['maint_date'];
                                                                $maint_code = $row['maint_code'];
                                                                
								?>
								<tr>
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo $vehno; ?></td>
                                                                <?php
                                                                $sql_itm1="SELECT model,commdate FROM cstcmis.veh0214 WHERE vehno = '" . $row['vehno'] . "'";
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);?>
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row1 ['model']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row1 ['commdate']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $maint_date; ?></td>
								
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo substr($row ['upd_date'],8,2) . '-' . substr($row ['upd_date'],5,2) . '-' .substr($row ['upd_date'],0,4) ; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['op_code']; ?></td>
								                                                                                                                  
								<td style="text-align:center; ">
                                                                    
                                                                    <?php   
                                                                     if($row['maint_date'] == date('Y-m-d',strtotime("-1 days"))){  $id3 = $row['id'];       ?>
                                             
                                                                     <a href="#delete<?php echo $id3;?>"  data-toggle="modal"  ><b>DELETE</b> </a> <?php }?>
                                                                </td>
                                                                    <div class="modal modal-warning fade" id="delete<?php  echo $id3;?>" data-backdrop="false">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:black;"><?php echo "Are you Sure you want Delete? VEHICLE = " . $vehno ; ?></span></h4>
                                                                           </div>
                						<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
                                                                <a href="WBTC_VehicleMaintenanceWashingDel.php<?php echo '?maint_id='.$id3; ?>" class="btn btn-danger">Yes</a>
								</div>
								</div>
								</div>
                                                                    </div>
              
									
                                                                
                                                               
                                                                
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
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
	<script>
		$(document).ready(function() {
			App.init();
			TableManageCombine.init();
                            $("#btnShow").click(function () {
                            $("#modal-warning171").modal('show');
                                                     
                            $('#ref_date').datepicker({
                               dateFormat: "dd-mm-yy",
                                maxDate: new Date()
                                });

                       });
                       $("#btnShow1").click(function () {
                            
                            $("#modal-warning172").modal('show');                            
                            

                       });
                          
		});
                
	</script>
        <style>
.ui-datepicker { position: relative; z-index: 10000 !important; }
</style>
</body>
</html>
