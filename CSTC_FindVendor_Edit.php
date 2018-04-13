<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
require_once('Connections/cstccon.php'); 
$query = "SELECT * from itm WHERE CREDT > '2010-01-01'";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
//$row = mysqli_fetch_assoc($result);
//$unit_desc = $row['UNIT_DESC'];


header('Cache-Control: no cache'); //no cache

session_cache_limiter('must-revalidate');
$query1 = "SELECT * FROM vnd";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
//$row1 = mysqli_fetch_assoc($result1);


$query_Recordsetunit_cat = "SELECT * FROM itmsbgrp";
$Recordsetunit_cat = mysqli_query($cstccon,$query_Recordsetunit_cat) or die(mysqli_error());
$row_Recordsetunit_cat = mysqli_fetch_assoc($Recordsetunit_cat);

?>




<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Vendor Master List</title>
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
				
				<li class="active">Vendor Master</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Vendor Master <small>Detail List</small></h1>
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
                           <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-warning19">
                Add New Vendor
              </button>
                <div class="modal modal-warning fade" id="modal-warning19" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content"style="color:white ;">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">ADD NEW VENDOR</span></h4>
                            </div>
                            <form id="indent_form" method="post" action="CSTC_VendorMasterAdd_ajax.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '80%'style="color:white ;">
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'color='white'><h6>VENDOR ID:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='vnd_id' id='vnd_id' required="YES">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'style="color:white ;"><h6>VENDOR NAME:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='vnd_nm' id='vnd_nm'required="YES">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'style="color:white ;"><h6>ADDRESS :</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='addr_1' id='addr_1' required="YES">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6></h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='addr_2' id='addr_2'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6></h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='addr_3' id='addr_3'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'style="color:white ;"><h6>PIN :</h6></td>
                                            <td >
                                                <input class="form-control"type='number' name='zip' id='zip'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'style="color:white ;"><h6>PHONE :</h6></td>
                                            <td >
                                                <input class="form-control"type='number' name='tel' id='tel'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'style="color:white ;"><h6>EMAIL :</h6></td>
                                            <td >
                                                <input class="form-control"type='email' name='email' id='email'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'style="color:white ;"><h6>GSTIN :</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='gstin' id='gstin' required="YES">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'style="color:white ;"><h6>ACTIVE :</h6></td>
                                            <td >
                                                <div class="form-group">
						<select class="form-control"name="act" id="act">
                                               
                                               
                                                    <option value="Y">YES</option>
                                                    <option value="N">NO</option>
                                    
                                                </select>
                                                </div>
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
                  <!-- /.modal-content -->
                    </div>
          <!-- /.modal-dialog -->
                </div>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning18">
                        Modify Existing Vendor
                    </button>
                    <div class="modal modal-warning fade" id="modal-warning18" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">MODIFY EXISTING VENDOR</span></h4>
                            </div>
                            <form id="indent_form" method="post" action="CSTC_VendorMasterMod_ajax.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '80%'style="color:white ;">
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>VENDOR ID:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='vnd_id' id='vnd_id' required="YES">
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>ADDRESS :</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='addr_1' id='addr_1' >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6></h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='addr_2' id='addr_2'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6></h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='addr_3' id='addr_3'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>PIN :</h6></td>
                                            <td >
                                                <input class="form-control"type='number' name='zip' id='zip'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>PHONE :</h6></td>
                                            <td >
                                                <input class="form-control"type='number' name='tel' id='tel'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>EMAIL :</h6></td>
                                            <td >
                                                <input class="form-control"type='email' name='email' id='email'>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>ACTIVE :</h6></td>
                                            <td >
                                                <div class="form-group">
						<select class="form-control"name="act" id="act">
                                               
                                               
                                                    <option value="Y">YES</option>
                                                    <option value="N">NO</option>
                                    
                                                </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>  
                                </div>
                                <div class="modal-footer"style="background-color: #a8a646;">
                                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button type="submit" name="Submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                  <!-- /.modal-content -->
                    </div>
          <!-- /.modal-dialog -->
                </div>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                   <tr>
                  <th>VENDOR ID.</th>
                  <th>VENDOR NAME</th>
                  <th>ADDRESS</th>
                  <th>ADDRESS</th>
                  <th>ADDRESS</th>
                  <th>PIN</th>
                  <th>PHONE</th>
                  <th>EMAIL</th>
                  <th>GSTIN</th>
                   <th>ACTIVE</th>
                </tr>
                                </thead>
                                <tbody>
                                   <?php 
while ($row=mysqli_fetch_array($result1) ){ 
                echo "<tr>";
                echo "<td>";
                echo $row['VND_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['VND_NM'];
                echo "</td>";
                echo "<td>";
                echo $row['ADDR_1'];
                echo "</td>";
                echo "<td>";
                echo $row['ADDR_2'];
                echo "</td>";
                echo "<td>";
                echo $row['ADDR_3'];
                echo "</td>";
                echo "<td>";
                echo $row['ZIP'];
                echo "</td>";
                echo "<td>";
                echo $row['TEL'];
                echo "</td>";
                echo "<td>";
                echo $row['EMAIL'];
                echo "</td>";
                echo "<td>";
                echo $row['GSTIN'];
                echo "</td>";
                
                echo "<td>";
                if($row['ACT_FLG'] == 'Y'){
                    echo "YES";
                }
                else{
                    echo "NO";
                }
                echo "</td>";
                echo "</tr>";
}?>
                
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
		});
	</script>
</body>
</html>
