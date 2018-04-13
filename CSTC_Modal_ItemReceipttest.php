<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();

$query_Recordsetunit = "SELECT * FROM unit";
$Recordsetunit1 = mysqli_query($cstccon,$query_Recordsetunit) or die(mysqli_error());


?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Goods Receipt</title>
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
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Receive Goods from Vendor</span></h4>
                            </div>
                            <form method="POST" action="CSTC_ItemReceipttest.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '80%'style="color:black ;">
                                        <tr>
                                            <td width="10%"></td>
                                            <td align='left'width='50%' autofocus="autofocus"><h6>Purchase Order No.:</h6></td>
                                            <td >
                                                <div class="col-md-10">
                                                <input class="form-control"type='number' name='po_no' id='po_no'>
                                                </div>
                                                </td>
                                        </tr>
                                        <tr><td colspan="3"><p></p></td></tr>
                                        <tr>
                                            <td width="10%"></td>
                                            <td align='left'><h6>Receive Item At:</h6></td>
                                            <td >
                                                <div class="form-group">
                                                    <div class="col-md-14">
                                                <select class="form-control"name="unit_to" id="unit_to" tabindex="2">
                                                    <option value="B">CENTRAL STORES</option>
                                                <?php
                                                $sql22="update item_R_temp_update set stat = 'N'";
                                                $result22=mysqli_query($cstccon,$sql22);
                         	while ($row_Recordsetunit1 = mysqli_fetch_assoc($Recordsetunit1)) {  ?>
                          		<option value="<?php echo $row_Recordsetunit1['UNIT_CODE']?>"><?php echo $row_Recordsetunit1['UNIT_DESC']?></option>
                          	<?php
					} 
  						$rows = mysqli_num_rows($Recordsetunit1);
  						if($rows > 0) {
      						mysqli_data_seek($Recordsetunit1, 0);
	  					$row_Recordsetunit1 = mysqli_fetch_assoc($Recordsetunit1);
 					      }
				?>
                        			</select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr><td colspan="3"><p></p></td></tr>
                                        <tr>
                                            <td width="10%"></td>
                                            <td align='left'width='50%'><h6>Challan No.:</h6></td>
                                            <td >
                                                <div class="col-md-10">
                                                <input class="form-control"type='text' name='challan_no' id='challan_no'>
                                                </div>
                                                </td>
                                        </tr>
                                        <tr><td colspan="3"><p></p></td></tr>
                                        <tr>
                                            <td width="10%"></td>
                                            <td align='left'width='50%'><h6>Challan Date:</h6></td>
                                            <td width='50%'>
                                               
                                                <div class="input-group date">
                                                
                                               
                                                
                                                
                                                <input class="form-control"type="text" name="challan_date"class="form-control pull-right" id="challan_date"placeholder="Select Date" maxlength="40" size="20" readonly="yes" >
                                                
                                                
                                                </div>
                                            </td>
                                        </tr>
                                        <tr><td colspan="3"><p></p></td></tr>
                                        <tr>
                                            <td width="10%"></td>
                                            <td align='left'width='50%'><h6>Payment Proposal No.:</h6></td>
                                            <td width='50%'>
                                                <div class="col-md-10">
                                                <input class="form-control"type='text' name='advnc_no_set' id='advnc_no_set'>
                                                </div>
                                                </td>
                                        </tr>
                                        <tr><td colspan="3"><p></p></td></tr>
                                        <tr>
                                            <td width="10%"></td>
                                            <td align='left'width='50%'><h6>Payment Proposal Year:</h6></td>
                                            <td width='50%'>
                                                <div class="col-md-10">
                                            <input class="form-control"type='text' name='advnc_fin_yr' id='advnc_fin_yr'>
                                                </div>
                                            </td>
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
                            
                            
                        </div>
                                </form>
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
