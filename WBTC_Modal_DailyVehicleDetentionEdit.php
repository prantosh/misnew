<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();

$vehno=$_GET['id'];

$query = "SELECT model FROM cstcmis.veh0214 where vehno = '" . $vehno . "'";
$Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($Recordset);
$model = $row['model'];


$unit = $_SESSION['UNIT'];
$user_id = $_SESSION['USER_ID'];



$query_Recordset1REASONBD = "SELECT * FROM cstcmis.veh_cur_stat_op";
$Recordset1REASONBD = mysqli_query($cstccon,$query_Recordset1REASONBD) or die(mysqli_error());
$row_Recordset1REASONBD = mysqli_fetch_assoc($Recordset1REASONBD);
$totalRows_Recordset1REASONBD = mysqli_num_rows($Recordset1REASONBD);

?>
<?php
$query=mysqli_query($cstccon,"select * from cstcmis.veh_cur_stat_op_tran a,cstcmis.veh_cur_stat_op b where a.cur_stat_op = b.cur_stat_op and a.vehno ='" . $vehno . "'  and a.op_date = '" . date('Y-m-d',strtotime("-1 days")) . "'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
$cur_stat_op = $row['cur_stat_op'];
$cur_stat_op_desc = $row['cur_stat_op_desc'];

$sql1= "select * from cstcmis.veh_heldup_status  where vehno='" . $vehno . "' and heldup_from != '0000-00-00' and heldup_to = '0000-00-00'";
$result1=mysqli_query($cstccon,$sql1);
$row1=mysqli_fetch_array($result1);

 if(mysqli_num_rows($result1)>0){
    
     $reason_heldup = $row1['reason_heldup'];
     $heldup_from = $row1['heldup_from'];
     $target_ok_date = $row1['target_ok_date'];
     $heldup_from = substr($heldup_from,8,2) . '-' . substr($heldup_from,5,2) . '-' . substr($heldup_from,0,4) ;
$target_ok_date = substr($target_ok_date,8,2) . '-' . substr($target_ok_date,5,2) . '-' . substr($target_ok_date,0,4) ;

 }
 else{
     $sql11= "insert into cstcmis.veh_heldup_status (vehno) values('" . $vehno . "')";
$result11=mysqli_query($cstccon,$sql11);
 }?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Daily Attendance Edit</title>
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
		<?php  include('WBTC_DailyVehicleDetention1.php'); ?>
		<!-- begin #content -->
		<div class="modal modal-warning fade" id="modal-warning171" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;color:black">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:black;"><?php echo "DETENTION FOR YESTERDAY FOR VEHICLE NO. : " . $vehno ; ?>  </span></h4>
                            </div>
                            <form method="post" action="WBTC_DailyVehicleDetentionEdit.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
					<table width='100%'style="color:black">
                                            <tr style="color:black">
                                                <td >
                                                SELECT REASON 
                                                </td>
                                                <td>
                                                     <div class="form-group">
                                                    <div class="col-md-10">
                                                    <select class="form-control"name="reason_non_out"  id="reason_non_out">
                                                        <option value="<?php echo $cur_stat_op ; ?>"><?php echo $cur_stat_op_desc ; ?></option>
                                                        <?php
                                                            do {  
    
                                                            ?>
                                                        <option value="<?php echo $row_Recordset1REASONBD['cur_stat_op']?>"><?php echo $row_Recordset1REASONBD['cur_stat_op_desc']?></option>
                                                        <?php
                                                        } while ($row_Recordset1REASONBD = mysqli_fetch_assoc($Recordset1REASONBD));
                                                        $rows = mysqli_num_rows($Recordset1REASONBD);
                                                        if($rows > 0) {
                                                        mysqli_data_seek($Recordset1REASONBD, 0);
                                                        $row_Recordset1REASONBD = mysqli_fetch_assoc($Recordset1REASONBD);
                                                        }
                                                        ?>
                                                    </select> 
                                                    </div>  
                                                     </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                       DETAIL REPORT 
                                                </td>
                                                <td>
                                                    
                                                <div class="col-md-10">
                                                    <input onblur="this.value=this.value.toUpperCase()"class="form-control"type="text" name="reason_heldup"class="form-control pull-right" id="reason_heldup"  >
                                                </div>
                                               
                                               
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    HELD-UP FROM (DATE)
                                                </td>
                                                <td>
                                                       <div class="form-group" >
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                <div class="col-md-8">
                                                <input type='text' class="form-control"name='stock_date' id ='stock_date' value="<?php echo $heldup_from; ?>"></input>
                                                </div>
                                                </div>
                                                       </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                     TARGET DATE FOR ON-ROAD 
                                                </td>
                                                <td>
                                                       <div class="form-group" >
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                <div class="col-md-8">
                                                <input type='text'class="form-control" name='mydate' id ='mydate' value="<?php echo $target_ok_date; ?>"></input>
                                                </div>
                                                </div>
                                                       </div>
                                                </td>
                                            </tr>
                                        </table>
	<input type="hidden" name="vehno" value ="<?php echo $vehno ; ?>">
    
     <div class="modal-footer"style="color:white ;background-color:#a8a646;">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-success">Update</button>
    </div>
	

					
                            
                        </div>
                                </form>
                    </div>
                </div>
		<!-- end #content -->
		
        
		
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
