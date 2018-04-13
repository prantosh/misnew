<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();



?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Issue to Depot</title>
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
		<?php  include('CSTC_header.php'); ?>
		
		<?php  include('CSTC_left.php'); ?>
		<?php  include('CSTC_middle.php'); ?>
		<!-- begin #content -->
		<div class="modal modal-warning fade" id="modal-warning171" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Item Issue to Depot / Unit </span></h4>
                            </div>
                            <form id="indent_form" method="post" action="CSTC_ItemIssue.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '100%'style="color:black ;">
                                        <tr>
                               
                                <td align='left'><h6>ISSUE ITEM FROM :</h6></td>
                                <td >
                                    <div class="form-group">
                                        
						<select class="form-control"name="unit_from_code" id="unit_from_code">
                                               
				
                                    <option value='B'>CENTRAL STORES</option>
                          	<?php
				do {  ?>
                          		<option value="<?php echo $row_Recordsetunit['UNIT_CODE']?>"><?php echo $row_Recordsetunit['UNIT_DESC']?></option>
                          	<?php
					} while ($row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit));
  						$rows = mysqli_num_rows($Recordsetunit);
  						if($rows > 0) {
      						mysqli_data_seek($Recordsetunit, 0);
	  					$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);
 					      }
				?>
                        			</select>
                                        
                                    </div>
                                </td>
                                 <td width='10%'></td>
                            </tr>
                            <tr>
                               
                                <td align='left'><h6>ISSUE ITEM TO :</h6></td>
                                <td >
                                    <div class="form-group">
						<select class="form-control"name="unit_to_code" id="unit_to_code">
                                               
                                
                          	<?php
                                $query_Recordsetunit1 = "SELECT * FROM unit order by UNIT_CODE";
$Recordsetunit1 = mysqli_query($cstccon,$query_Recordsetunit1) or die(mysqli_error());
$row_Recordsetunit1 = mysqli_fetch_assoc($Recordsetunit1);
				do {  ?>
                                        <option value="<?php echo $row_Recordsetunit1['UNIT_CODE']?>"><?php echo $row_Recordsetunit1['UNIT_DESC']?></option>
                          	<?php
					} while ($row_Recordsetunit1 = mysqli_fetch_assoc($Recordsetunit1));
  						$rows = mysqli_num_rows($Recordsetunit1);
  						if($rows > 0) {
      						mysqli_data_seek($Recordsetunit1, 0);
	  					$row_Recordsetunit1 = mysqli_fetch_assoc($Recordsetunit1);
 					      }
				?>
                        			</select>
                                    </div>
                                </td>
                                 <td width='10%'></td>
                            </tr>
                            <tr>
                               
                                <td align='left'width='50%'><h6>ADD ITEM TO VOUCHER NO.:</h6></td>
                                <td >
				 <input class="form-control"type='text' name='v_no_add' id='v_no_add'>
                                </td>
                                 <td width='10%'></td>
                            </tr>
                                    </table>  
                                    <div align='center'>
                                        <table align='center'style="color:olive ;">
                                            <tr>
                                                <td colspan ='3'>
                                                    <label >Remarks (in 200 characters or less)</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align='right'colspan ='3'>
                                                    <textarea style="resize:none;height:80px; width:400px" placeholder="Type remarks (if any) here" maxlength="200" name="remark" id="remark"></textarea>
                                                </td>
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
		<?php  include('CSTC_ThemePanel.php'); ?>
        
		
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
