<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
require_once('Connections/cstccon.php'); 
$queryxx = "SELECT * from itm WHERE CREDT > '2010-01-01'";
$resultxx = mysqli_query($cstccon,$queryxx) or die(mysqli_error());
//$row = mysqli_fetch_assoc($result);
//$unit_desc = $row['UNIT_DESC'];



session_cache_limiter('must-revalidate');
$query_uom = "SELECT * FROM uom";
$result_uom = mysqli_query($cstccon,$query_uom) or die(mysqli_error());


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
	<title>Item Master List</title>
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
				
				<li class="active">Item Master</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Item Master <small>Detail List</small></h1>
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
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-warning17A">
                Add New item
                </button>
                <div class="modal modal-warning fade" id="modal-warning17A" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">ADD NEW ITEM</span></h4>
                            </div>
                            <form id="indent_form" method="post" action="CSTC_ItemMasterAdd_ajax.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '80%'style="color:black ;">
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>FOLIO NO.:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='folio_no' id='folio_no'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>PART NO.:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='alt_no' id='alt_no'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>DESCRIPTION:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='itm_nm' id='itm_nm'>
                                            </td>
                                        </tr>
                                        <tr>
                                <td width='20%'></td>
                                <td align='left'><h6>UOM :</h6></td>
                                <td >
                                <div class="form-group">
						<select class="form-control"name="uom_id" id="uom_id">
                                               
                               
                          	<?php
				while ($row_uom = mysqli_fetch_assoc($result_uom)) {  ?>
                                        <option value="<?php echo $row_uom['UOM_ID']?>"><?php echo $row_uom['UOM_NM']?></option>
                          	<?php
					} 
  						$rows = mysqli_num_rows($result_uom);
  						if($rows > 0) {
      						mysqli_data_seek($result_uom, 0);
	  					$row_uom = mysqli_fetch_assoc($result_uom);
 					      }
				?>
                        			</select>
                                </div>
                                </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>SPECIFICATION:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='spec' id='spec'>
                                            </td>
                                        </tr>
                                        <tr>
                                <td width='20%'></td>
                                <td align='left'><h6>CATEGORY :</h6></td>
                                <td >
                                    <div class="form-group">
						<select class="form-control"name="cat" id="cat">
                                               
                          	<?php
				do {  ?>
                                        <option value="<?php echo $row_Recordsetunit_cat['SBGRP_ID']?>"><?php echo $row_Recordsetunit_cat['SBGRP_NM']?></option>
                          	<?php
					} while ($row_Recordsetunit_cat = mysqli_fetch_assoc($Recordsetunit_cat));
  						$rows = mysqli_num_rows($Recordsetunit_cat);
  						if($rows > 0) {
      						mysqli_data_seek($Recordsetunit_cat, 0);
	  					$row_Recordsetunit_cat = mysqli_fetch_assoc($Recordsetunit_cat);
 					      }
				?>
                        			</select>
                                    </div>
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
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning18A">
                        Modify Existing Item
                    </button>
                    <div class="modal modal-warning fade" id="modal-warning18A" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">MODIFY EXISTING ITEM</span></h4>
                            </div>
                            <form id="indent_form" method="post" action="CSTC_ItemMasterMod_ajax.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '80%'style="color:black ;">
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>FOLIO NO.:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='folio_no' id='indnt_id'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>PART NO.:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='alt_no' id='alt_no'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>DESCRIPTION:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='itm_nm' id='itm_nm'>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td width='20%'></td>
                                            <td align='left'><h6>SPECIFICATION:</h6></td>
                                            <td >
                                                <input class="form-control"type='text' name='spec' id='spec'>
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
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                  <th>FOLIO NO.</th>
                  <th>DESCRIPTION</th>
                  <th>UNIT</th>
                  <th>PART NO.</th>
                  <th>LAST RECEIPT DATE</th>
                  <th>LAST ISSUE DATE</th>
                  <th>STATUS</th>
                </tr>
                                </thead>
                                <tbody>
                                    <?php 
while ($row=mysqli_fetch_array($resultxx) ){ 
                echo "<tr>";
                echo "<td>";
                echo $row['PART_NO'];
                echo "</td>";
                echo "<td>";
                echo $row['SPEC'];
                echo "</td>";
                echo "<td>";
                echo $row['UOM_ID'];
                echo "</td>";
                echo "<td>";
$query1 = "SELECT * from itmalias WHERE PART_NO = '" . $row['PART_NO'] . "'";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());  
$X = 1;
if(mysqli_num_rows($result1) > 0){
    while ($row1 = mysqli_fetch_assoc($result1)){
   
                echo $row1['ALIAS_NO'] ;
                if($X < mysqli_num_rows($result1)) {echo  ' , ';}
                $X = $X + 1;
}}
else{
    echo "NA";
}
                echo "</td>";
                echo "<td>";
                if($row['LRCT_DT'] != '0000-00-00'){
                echo substr($row['LRCT_DT'],8,2) . '-' . substr($row['LRCT_DT'],5,2) . '-' . substr($row['LRCT_DT'],0,4) ;}


                echo "</td>";
                echo "<td>";
                if($row['LISS_DT'] != '0000-00-00'){
                echo substr($row['LISS_DT'],8,2) . '-' . substr($row['LISS_DT'],5,2) . '-' . substr($row['LISS_DT'],0,4) ;}

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
