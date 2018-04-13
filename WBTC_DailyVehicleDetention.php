<?php include('Connections/cstccon.php'); 
 
error_reporting(E_ERROR|E_WARNING);
 session_start(); 
$yesterday = date('Y-m-d',strtotime("-1 days"));
$unit = $_SESSION['UNIT'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
$tablename = "cstcmis.cb_temp_yesterday_" . $unit ;

$queryd = "delete from " . $tablename ;
$Recordsetd = mysqli_query($cstccon,$queryd) or die(mysqli_error());

$queryd1 = "insert into " . $tablename . " select * from cstcmis.cb where wb_date = '" . $yesterday . "' and depot = '" . $unit . "'" ;
$Recordsetd1 = mysqli_query($cstccon,$queryd1) or die(mysqli_error());

$query = "select * from cstcmis.veh_cur_stat_op_tran where depot = '" . $unit . "' and     op_date = '" . $yesterday . "'" ;
$Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
$totalRows = mysqli_num_rows($Recordset);
if($totalRows <= 0){
    
    $sql_itm22="insert into cstcmis.veh_cur_stat_op_tran (vehno,depot,cur_stat,runfleet) select vehno,depot,cur_stat,runfleet from cstcmis.veh0214 where cur_stat = 'S' and runfleet = 'R' and depot = '" . $unit . "' and vehno not in(select veh_no from cstcmis.cb where wb_date = '" . $yesterday . "')"; 
$result_itm22=mysqli_query($cstccon,$sql_itm22);

 

//$sql_itm24="delete from veh_cur_stat_op_tran where vehno in (select distinct veh_no from cb where wb_date = DATE(DATE_SUB(NOW(),INTERVAL 1 DAY)) and depot = '" . $unit . "') and op_date = '0000-00-00'";
//$result_itm24=mysqli_query($cstccon,$sql_itm24); 



$sql_itm23="update cstcmis.veh_cur_stat_op_tran set op_date = '" . $yesterday . "' where op_date = '0000-00-00'"; 
$result_itm23=mysqli_query($cstccon,$sql_itm23); 
    
    
    
    
 //  $query1 = "insert into veh_cur_stat_op_tran (op_date,depot,vehno) select DATE(DATE_SUB(NOW(),INTERVAL 1 DAY)),'" . $unit . "', (select vehno from veh0214 where depot = '" . $unit . "' and cur_stat = 'S'  and runfleet = 'R' and vehno not in (select veh_no from cb where wb_date = DATE(DATE_SUB(NOW(),INTERVAL 1 DAY))) ";

 //  $Recordset1 = mysqli_query($cstccon,$query1) or die(mysqli_error());

} 


$query2 = "select * from cstcmis.veh_cur_stat_op_tran where depot = '" . $unit . "' and op_date = '" . $yesterday . "'" ;
$Recordset2 = mysqli_query($cstccon,$query2) or die(mysqli_error());

$query_Recordset1REASONBD = "SELECT * FROM cstcmis.veh_cur_stat_op";
$Recordset1REASONBD = mysqli_query($cstccon,$query_Recordset1REASONBD) or die(mysqli_error());
//$row_Recordset1REASONBD = mysqli_fetch_assoc($Recordset1REASONBD);
$totalRows_Recordset1REASONBD = mysqli_num_rows($Recordset1REASONBD);
 ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Vehicle - Performance</title>
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
var age = document.getElementById("reason_non_out").value;
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
				
				<li class="active">Performance - Vehicle</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Vehicle Performance for : <small><?php echo date('d-m-Y',strtotime("-1 days")) ; ?></small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
<div class="row">
        
        <div class="panel panel-success">
                        <div class="panel-heading">
                            
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                    Select Month 
                        </div>  
            <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                            
                            <thead>
                                 <tr style="font-size : 10px">
                                    <th style="text-align:center;"><b>SRL</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;"><b>DATE</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;"><b>VEHICLE NUMBER</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">MODEL <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">STATUS <i class="fa fa-fw fa-sort"></i></th>

                                    <th style="text-align:center;">REASON FOR NON-OUTSHED<i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">UPDATE <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">UPDATE BY <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                           
								<?php
                                                                $i = 1;
								//session_start();
                                                               while ($row= mysqli_fetch_array ($Recordset2) ){
								$id = $row['vehno'];
                                                                ?>
								<tr style="font-size : 10px">
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $i; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['op_date']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['vehno']; ?></td>
                                                                <?php $query3 = "select model,runfleet from cstcmis.veh0214 where vehno = '" . $id . "'";
                                                                $Recordset3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
                                                                $row3= mysqli_fetch_array ($Recordset3);
                                                                ?>
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo $row3 ['model']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php 
                                                                if($row3 ['runfleet'] == 'H') {echo 'HELD-UP';}
                                                                if($row3 ['runfleet'] == 'R') {echo 'RUNNING';}
                                                                ?></td>
                                                                <?php
                                                                $sql_itm2="select cur_stat_op_desc from cstcmis.veh_cur_stat_op where cur_stat_op = '" .  $row ['cur_stat_op'] . "'"; 
                                                                $result_itm2=mysqli_query($cstccon,$sql_itm2);  
                                                                $row4= mysqli_fetch_array ($result_itm2);
                                                                ?>
                                                                
								<td style="text-align:center; word-break:break-all; "> 
                                                                    <?php 
                                                                    $query3 = "select veh_no from " . $tablename . " where veh_no = '" . $row['vehno'] . "' and wb_date = '" . $yesterday . "'" ;
                                                                    $Recordset3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
                                                                    if(mysqli_num_rows($Recordset3) > 0){
                                                                    $query31 = "update cstcmis.veh0214 set runfleet = 'R' where vehno = '" . $row['vehno'] . "'";
                                                                    $Recordset31 = mysqli_query($cstccon,$query31) or die(mysqli_error());    
                                                                        
                                                                    
                                                                    $query33 = "update cstcmis.veh_heldup_status set heldup_to = '" . $yesterday . "' where vehno = '" . $row['vehno'] . "' and heldup_from != '0000-00-00' and heldup_to = '0000-00-00'" ;
                                                                    $Recordset33 = mysqli_query($cstccon,$query33) or die(mysqli_error());     
                                                                      
                                                                        
                                                                        echo 'OUT ATLEAST ONCE';
                                                                        $out = 'Y';
                                                                    }
                                                                    else{
                                                                        $out = 'N';
                                                                        
                                                                        
                                                                       $query32 = "select * from cstcmis.veh_heldup_status where vehno = '" . $row['vehno'] . "' and  heldup_to = '0000-00-00'" ;
                                                                    $Recordset32 = mysqli_query($cstccon,$query32) or die(mysqli_error());
                                                                    if(mysqli_num_rows($Recordset32) > 0){
                                                                        $row32= mysqli_fetch_array ($Recordset32);
                                                                        echo $row32['reason_heldup'];
                                                                    }
                                                                    else{ 
                                                                                                                                   
                                                                    
                                                                    echo $row4 ['cur_stat_op_desc']; }}
                                                                    ?>
                                                                </td>
								 <td style="text-align:center; word-break:break-all; "> <?php echo substr($row ['upd_date'],8,2) . '-' . substr($row ['upd_date'],5,2) . '-' .substr($row ['upd_date'],0,4) ; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['op_code']; ?></td>
								
                                                                
                                                                
                                                       <?php         //******************************** ?>
                                                                <td style="text-align:center; ">
                                                                    
                                                                    <?php   
                                                                    if($out == 'N'){       ?>
                                             
                                                                     <a href="#delete<?php echo $id;?>"  data-toggle="modal"  ><b>EDIT</b> </a> <?php }?>
                                                                </td>
                            <form>
                                                                    <div class="modal modal-warning fade" id="delete<?php  echo $id;?>" data-backdrop="false">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42">
                                                                            
                                                                                <span style="color:black;">
                                                                                    <?php echo "Select reason for OFF-ROAD for Vehicle No. = " . $id ; ?>
                                                                                </span>
                                                                                <p></p>
                                                                             
                                                                                <select class="form-control"name="reason_non_out"  id="reason_non_out">             
                                                             <?php
                                                    do {?>
                                                    <option value="<?php echo $row_Recordset1REASONBD['cur_stat_op']?>"><?php echo $row_Recordset1REASONBD['cur_stat_op_desc']?></option>
                                                <?php
                                                } while ($row_Recordset1REASONBD = mysqli_fetch_assoc($Recordset1REASONBD)) ;
  						$rows = mysqli_num_rows($Recordset1REASONBD);
  						if($rows > 0) {
      						mysqli_data_seek($Recordset1REASONBD, 0);
	  					$row_Recordset1REASONBD = mysqli_fetch_assoc($Recordset1REASONBD);
                                                }
                                        ?>                    
                                                                                </select>                              
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                          
                                                                           </div>
                						<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>

                                                                <a href="WBTC_DailyVehicleDetentionEdit.php?veh_id=<?php echo $id ; ?>&xxx="+age>link to page2</a>
								</div>
								</div>
								</div>
                                                                    </div>
                                                            </form>    
                                                                
                                                             <?php         //******************************** ?>
                                                                
                                                      
								</tr>

								

								<?php 
                                                                $i = $i + 1;
                                                              } ?>
                            
                            </tbody>
                        </table>

            </div>
        </div>
          
       
       
        </div>
		
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
                        
                       
                                                     
                            $('#ref_date').datepicker({
                               dateFormat: "dd-mm-yy",
                                maxDate: new Date()
                                });

                     
                        
                        
		});
   
                
                
                
                
                
                
                
	</script>
</body>
</html>
