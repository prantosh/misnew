<?php
require_once('Connections/cstccon.php');
//session_start();
$role = $_SESSION['ROLE'];
?>
<head>
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
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
    <link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
    <link href="IMS_Web.cssc" rel="stylesheet" />
<link href="assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" />	
    <!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
        <script src="assets/js/form-plugins.demo.js"></script>
	<!-- ================== END BASE JS ================== -->



<?php
error_reporting(E_ERROR|E_WARNING);
session_start();
$unit = $_SESSION['UNIT'];
$user_name = $_SESSION['USER_NAME'];
$role = $_SESSION['ROLE'];

error_reporting(E_ERROR|E_WARNING);
$query_Recordsetunit1 = "SELECT * FROM cstcmis.unit order by UNIT_CODE";
$Recordsetunit1 = mysqli_query($cstccon,$query_Recordsetunit1) or die(mysqli_error());
$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit1);

$query_Recordsetunit_without_current_depot = "SELECT * FROM cstcmis.unit where UNIT != '" . $unit . "'";
$Recordsetunit_without_current_depot = mysqli_query($cstccon,$query_Recordsetunit_without_current_depot) or die(mysqli_error());
$row_Recordsetunit_without_current_depot = mysqli_fetch_assoc($Recordsetunit_without_current_depot);

$query = "SELECT * FROM cstcmis.role where ROLE = '" . $role . "'";
$Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($Recordset);
$role_desc = $row['ROLE_DESC'];

?>

<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
					    <a href="#" data-toggle="nav-profile">
                            <div class="image">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42">
                            </div>
                            <div class="info">
                                <b class="caret pull-right"></b>
                                <?php echo $user_name ; ?>
                                <small><?php echo $role_desc ; ?></small>
                            </div>
						</a>
					</li>
                    <li>
                        <ul class="nav nav-profile">
                            <li><a href="WBTC_Modal_PasswordChange.php"><i class="material-icons fa fa-address-book-o"></i> Change Password</a></li>
                            <li><a href="WBTC_Modal_EmailChange.php"><i class="material-icons fa fa-address-card-o"></i> Change Email Address</a></li>
                            <li><a href="index.php"><i class="material-icons fa fa-power-off"></i> Logout</a></li>
                            <li><a href="#"><i class="material-icons">mode_edit</i> Send Feedback</a></li>
                           
                        </ul>
                    </li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">
                                        <?php  include('WBTC_OnlineUsers.php'); ?>
                                        
                                        </li>
					<li class="has-sub">
						<a href="WBTC_MainMenu.php">
						    
						    <i class="material-icons">home</i>
						    <span>Dashboard</span>
					    </a>
						
					</li>
                                        <li class="has-sub">
						<a href="javascript:;">
						    
                                                    <b class="caret pull-right"></b>
						    <i class="material-icons fa fa-adn"></i>
						    <span>Admin</span>
						</a>
						<ul class="sub-menu">
							
                                                        <li class="has-sub">
								<a href="javascript:;">
						            <b class="caret pull-right"></b>
						            Master File Operation
						        </a>
								<ul class="sub-menu">
								<?php if($role == '1' || $role == '2'){?>
                                                    <li class='last'><a href='WBTC_VehicleMaster.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Vehicle Master" ; ?></a></li>
                                                    <?php } ?>
                                                   
                                                    <?php if($role == '1' || $role == '2'){?>
                                                        <li class='last'><a href='WBTC_UserMaster.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "User Master" ; ?></a></li>
                                                    <?php } ?>
                                                    <?php if($role == '1' || $role == '2'){?>
                                                        <li class='last'><a href='WBTC_RouteMaster.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Route Master" ; ?></a></li>
                                                    <?php } ?>
                                                        <?php if($role == '1' || $role == '2'){?>
                                                        <li class='last'><a href='WBTC_EmployeeMaster.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Employee Master" ; ?></a></li>
                                                    <?php } ?>
                                                   <?php if($role == '1' || $role == '2'){?>
                                                        <li class='last'><a href='WBTC_Modal_MasterTimeTable.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Time Table Master" ; ?></a></li>
                                                    <?php } ?>
                                                   
						    
								</ul>
							</li>
                                                        <li class="has-sub">
								<a href="javascript:;">
						            <b class="caret pull-right"></b>
						            Miscellaneous
						        </a>
								<ul class="sub-menu">
								  
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4'){?>
                                                    <li class='last'><a href='CSTC_Modal_Backup.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Backup Data" ; ?></a></li>
                                                    <?php } ?>
                                                    <?php if($role == '1'){?>
                                                    <li class='last'><a href='CSTC_Modal_Restore.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Restore Data" ; ?></a></li>
                                                    <?php } ?>
                                                    <?php if($role == '1' || $role == '2'){?>
                                                    <li class='last'><a href='WBTC_Modal_ChangeDefaultDepot.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Change Default Depot" ; ?></a></li>
                                                    <?php } ?>
                                                    <?php if($role == '1'){?>
                                                    <li class='last'><a href='WBTC_Modal_MonthProcess.php'><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Monthly Process" ; ?></a></li>
                                                    <?php } ?>
                                                   
						    
								</ul>
							</li>
							
						</ul>
					</li>
                          
                                       
                                     <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Operation Data Capture</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4' || $role == '5'){?>
                                                    <li><a href="WBTC_DailyEntryTrafficDisp1.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Model Wise Performance" ; ?></a></li>
						    <li><a href="WBTC_DailyEntrySummary_S1.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Attandance (Shift-I)" ; ?></a></li>
						    <li><a href="WBTC_DailyEntrySummary_S2.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Attandance (Shift-II)" ; ?></a></li>
                                                    <li><a href="WBTC_DailyEntrySummaryVeh1.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Outshed Data entry" ; ?></a></li>
                                                    <li><a href="WBTC_DepotRouteMISRoute.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Depot-MIS Route Matching" ; ?></a></li>

                                                      <?php } ?>
						</ul>
					</li>
                                         <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Maintenance Data Capture</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4' || $role == '5'){?>
                                                    <li><a href="WBTC_VehicleStatus.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Vehicle Status Modification" ; ?></a></li>

                                                    <li><a href="WBTC_DailyVehicleDetention.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Vehicle Detention Reason" ; ?></a></li>
						    <li><a href="WBTC_Modal_DailyMaintenanceTech.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Daily Tech. Maintenance" ; ?></a></li>
                                                    <li><a href="WBTC_Modal_DailyMaintenance.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Daily Washing/Cleaning" ; ?></a></li>

                                                    <li><a href="WBTC_VehicleMaintenance.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Periodic vehicle Maintenance" ; ?></a></li>
                                                    <li><a href="WBTC_DailyHSD.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "HSD Transaction Detail" ; ?></a></li>
                                                    <li><a href="WBTC_DailyHSDOtherUnit.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "HSD Issue to Other Unit" ; ?></a></li>
                                                    <li><a href="WBTC_Modal_HSDIssueOtherVeh.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "HSD Issue to Other Vehicle" ; ?></a></li>
                                                    <li><a href="WBTC_Modal_VTUMobile.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "VTU / Mobile Allotment" ; ?></a></li>
                                                    <li><a href="crudnew/index.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "TEST" ; ?></a></li>

                                                      <?php } ?>
						</ul>
					</li>
                                       <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Upload File</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4' || $role == '5'){?>
                                                    <li><a href="WBTC_Modal_cbUpload.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Daily Traffic Performance" ; ?></a></li>
                                                    <li><a href="WBTC_Modal_vehUpload.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Daily Vehicle Performance" ; ?></a></li>
						          <?php } ?>
						</ul>
					</li>
                                        <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Crew Performance</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4'  || $role == '5'){?>
                                                      <li><a href="WBTC_PerformanceDriver.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Driver - Monthly" ; ?></a></li>
                                                    <li><a href="WBTC_PerformanceCond.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Conductor - Monthly" ; ?></a></li>
                                                  <li><a href="WBTC_Modal_PerformanceDriverSingle.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Any Driver" ; ?></a></li>
                                                    <li><a href="WBTC_Modal_PerformanceCondSingle.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Any Conductor " ; ?></a></li>
                                               
                                                      <?php } ?>
						</ul>
					</li>
                                        <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Engineering</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4'  || $role == '5'){?>
                                                      <li><a href="WBTC_PerformanceVehicle.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Vehicle Performance" ; ?></a></li>
                                                      <li><a href="WBTC_MaintenanceVehicle.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Heavy Maintenance" ; ?></a></li>
                                                      <li><a href="WBTC_MaintenanceVehicleDaily.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Daily Maintenance" ; ?></a></li>

                                                      <?php } ?>
						</ul>
					</li>
                                       <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Daily Performance</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4'  || $role == '5'){?>
                                                     <li><a href="WBTC_TrackingReport.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Tracking Device Alloted - Depot" ; ?></a></li>
                                                    <li><a href="WBTC_TrackingReportCSTC.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Tracking Device Alloted - WBTC" ; ?></a></li>
                                                
                                                      <?php } ?>
						</ul>
					</li>
                                        <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Day-Wise Performance</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4'  || $role == '5'){?>
                                                    <li><a href="WBTC_Modal_DailyPerformanceCSTC.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "CSTC Daily Performance" ; ?></a></li>
						    <li><a href="WBTC_DailySaleQryServiceWise.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Service-Wise Daily Performance" ; ?></a></li>
                                                    <li><a href="WBTC_DailyQueryModel.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Model Wise Performance" ; ?></a></li>
                                                    <li><a href="WBTC_DailyQueryRoute.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Route Wise Performance" ; ?></a></li>
                                                    <li><a href="WBTC_DailyQueryDepot.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Depot Wise Performance" ; ?></a></li>
                                                    <li><a href="WBTC_DailyMaintenanceDepot.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Vehicle Wise Maintenance" ; ?></a></li>

                                                      <?php } ?>
						</ul>
					</li>
                                        <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Monthly Performance</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4'  || $role == '5'){?>
						    <li><a href="WBTC_CSTCMonthWisePer.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "CSTC Performance" ; ?></a></li>
                                                    <li><a href="WBTC_SaleQryMonthWise.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "Compare Performance" ; ?></a></li>

                                                      <?php } ?>
						</ul>
					</li>
                                        <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-info-circle"></i>
							<span>Query for Any</span>
						</a>
						<ul class="sub-menu">
                                                    <?php if($role == '1' || $role == '2' || $role == '3' || $role == '4'  || $role == '5'){?>
						    <li><a href="WBTC_Modal_VehicleQry.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "VEHICLE" ; ?></a></li>
                                                    <li><a href="WBTC_SaleQryMonthWise.php"><i class="fa fa-arrow-circle-right"></i><?php echo " " . "CONDUCTOR" ; ?></a></li>

                                                      <?php } ?>
						</ul>
					</li>
                                         <li class="has-sub">
						<a href="javascript:;">
						   <b class="caret pull-right"></b>
                                                        <i class="material-icons fa fa-cog"></i>
							<span>Settings</span>
						</a>
						<ul class="sub-menu">
                                                   
                                                  <li><a href="CSTC_Modal_PasswordChange.php"><i class="material-icons fa fa-address-book-o"></i> Change Password</a></li>
                            <li><a href="CSTC_Modal_EmailChange.php"><i class="material-icons fa fa-address-card-o"></i> Change Email Address</a></li>
                            <li><a href="index.php"><i class="material-icons fa fa-power-off"></i> Logout</a></li>
                              
						</ul>
					</li>
					
					
					
					
					
					
                                        
					
					
					
					
					
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
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
	<script src="assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
	<script>
		$(document).ready(function() {
			App.init();
			TableManageCombine.init();
                        FormPlugins.init();
                        Notification.init();
		});
	</script>