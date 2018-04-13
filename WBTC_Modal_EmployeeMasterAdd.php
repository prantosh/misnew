<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();

$query_Recordset1 = "select *  from cstcmis.model_master";
$Recordset1 = mysqli_query($cstccon,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

$query_Recordset2 = "select *  from unit";
$Recordset2 = mysqli_query($cstccon,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);

$query_Recordset21 = "select distinct desig from cstcmis.cstc_master";
$Recordset21 = mysqli_query($cstccon,$query_Recordset21) or die(mysqli_error());
$row_Recordset21 = mysqli_fetch_assoc($Recordset21);

$query_Recordset211 = "select distinct department from cstcmis.cstc_master";
$Recordset211 = mysqli_query($cstccon,$query_Recordset211) or die(mysqli_error());
$row_Recordset211 = mysqli_fetch_assoc($Recordset211);
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Add New Employee</title>
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
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
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
		<?php  include('WBTC_header.php'); ?>
		
		<?php  include('WBTC_left.php'); ?>
		<?php  include('WBTC_middle.php'); ?>
		<!-- begin #content -->
		<div class="modal modal-warning fade" id="modal-warning171" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Add New Employee</span></h4>
                            </div>
                            <form id="indent_form" method="post" action="WBTC_EmployeeMasterAdd.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '80%'style="color:black ;">
                                                <tr>
							<td><label >BADGE NUMBER</label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="card" name="card" placeholder=""  required /></td>
						</tr>
                                                <tr>
							<td><label >PF A/C NO.</label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="empno" name="empno" placeholder=""   /></td>
						</tr>
                                                <tr>
							<td><label >COMPUTER NO.</label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="comp_id" name="comp_id" placeholder=""   /></td>
						</tr>
                                                <tr>
							<td><label >NAME OF EMPLOYEE</label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="name" name="name" placeholder=""  required /></td>
						</tr>
                                                <tr>
							<td><label >GENDER</label></td>
							<td width="30"></td>
                                                        <td><select name="gender" id = "gender">
                                                                <option value ="M">MALE</OPTION>
                                                                <option value ="F">FEMALE</OPTION>
                                                            </select>
                                                        </td>
						</tr>
                                                <tr>
							<td><label >ADDRESS</label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="add1" name="add1" placeholder=""  required /></td>
						</tr>
                                                <tr>
							<td><label ></label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="add2" name="add2" placeholder=""  required /></td>
						</tr>
                                                <tr>
							<td><label >PIN</label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="pin" name="pin" placeholder=""  required /></td>
						</tr>
                                                <tr>
							<td><label >DESIGNATION</label></td>
							<td width="30"></td>
							<td><select  class="form-control" name="desig" id="desig">
                            <?php
do {  
?>
                            <option value="<?php echo $row_Recordset21['desig']?>"><?php echo $row_Recordset21['desig']?></option>
                            <?php
} while ($row_Recordset21 = mysqli_fetch_assoc($Recordset21));
  $rows = mysqli_num_rows($Recordset21);
  if($rows > 0) {
      mysqli_data_seek($Recordset21, 0);
	  $row_Recordset21 = mysqli_fetch_assoc($Recordset21);
  }
?></select></td>
						</tr>
                                                <tr>
							<td><label >DEPARTMENT</label></td>
							<td width="30"></td>
							<td><select  class="form-control" name="department" id="department">
                            <?php
do {  
?>
                            <option value="<?php echo $row_Recordset211['department']?>"><?php echo $row_Recordset211['department']?></option>
                            <?php
} while ($row_Recordset211 = mysqli_fetch_assoc($Recordset211));
  $rows = mysqli_num_rows($Recordset211);
  if($rows > 0) {
      mysqli_data_seek($Recordset211, 0);
	  $row_Recordset211 = mysqli_fetch_assoc($Recordset211);
  }
?></select></td>
						</tr>
                                                <tr>
							<td><label >EMAIL ID</label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="email" name="email" placeholder=""   /></td>
						</tr>
                                                <tr>
							<td><label >MOBILE NO.</label></td>
							<td width="30"></td>
							<td><input  class="form-control"type="text" id="mobile" name="mobile" placeholder=""   /></td>
						</tr>
                                                <tr><td colspan="3"><p></p></td></tr>
                                                
                                               <tr>
                                                    <td><label >DATE OF BIRTH</label></td>
							<td width="30"></td>
							
							<td >
                                                <div class="form-group">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                    <div class="col-md-14">
                                                <input class="form-control"value=""type="text" class="form-control" id="indent_ref_date" name="indent_ref_date"placeholder="Select Date" readonly="yes" />
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
						</tr>
                                                <tr>
                                                    <td><label >DATE OF JOIN</label></td>
							<td width="30"></td>
							
							<td >
                                                <div class="form-group">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                    <div class="col-md-14">
                                                <input class="form-control"value="<?php echo date('d-m-Y',strtotime("-1 days")) ; ?>"type="text" class="form-control" id="indent_ref_date1" name="indent_ref_date1"placeholder="Select Date" readonly="yes" />
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
						</tr>
                                                <tr><td colspan="3"><p></p></td></tr>
                                               
							<tr>
							<td><label >DEPOT</label></td>
							<td width="30"></td>
							<td><select  class="form-control"name="unit" id="unit">
                            <?php
do {  
?>
                            <option value="<?php echo $row_Recordset2['UNIT']?>"><?php echo $row_Recordset2['UNIT_DESC']?></option>
                            <?php
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
  $rows = mysqli_num_rows($Recordset2);
  if($rows > 0) {
      mysqli_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysqli_fetch_assoc($Recordset2);
  }
?></select></td>
						</tr>
                                    </table>
                                </div>
                                <div class="modal-footer"style="color:white ;background-color:#a8a646;">
                                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button type="submit" name="Submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
		<!-- end #content -->
		<?php  include('WBTC_ThemePanel.php'); ?>
        
		
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
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/dashboard.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
        <script src="assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Dashboard.init();
                        $("#modal-warning171").modal('show');
                        FormPlugins.init();
		});
	</script>
</body>
</html>
