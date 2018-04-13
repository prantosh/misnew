<?php include('Connections/cstccon.php'); 

 session_start(); 
$yesterday = date('Y-m-d',strtotime("-1 days"));
$unit = $_SESSION['UNIT'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
 
 
$query_Recordsetvehmaster = "select * from cstcmis.veh0214";
$Recordsetvehmaster = mysqli_query($cstccon,$query_Recordsetvehmaster) or die(mysqli_error());
$row_Recordsetvehmaster = mysqli_fetch_assoc($Recordsetvehmaster);
$totalRows_Recordsetvehmaster = mysqli_num_rows($Recordsetvehmaster);

$query_RecordsetVehCurStat = "select * from cstcmis.veh_cur_stat";
$RecordsetVehCurStat = mysqli_query($cstccon,$query_RecordsetVehCurStat) or die(mysqli_error());
$row_RecordsetVehCurStat = mysqli_fetch_assoc($RecordsetVehCurStat);
$totalRows_RecordsetVehCurStat = mysqli_num_rows($RecordsetVehCurStat);

$query_Recordsetrunfleet = "select * from cstcmis.runfleet";
$Recordsetrunfleet = mysqli_query($cstccon,$query_Recordsetrunfleet) or die(mysqli_error());
$row_Recordsetrunfleet = mysqli_fetch_assoc($Recordsetrunfleet);
$totalRows_Recordsetrunfleet = mysqli_num_rows($Recordsetrunfleet);


$query_Recordsetyesno = "select * from cstcmis.yesno";
$Recordsetyesno = mysqli_query($cstccon,$query_Recordsetyesno) or die(mysqli_error());
$row_Recordsetyesno = mysqli_fetch_assoc($Recordsetyesno);
$totalRows_Recordsetyesno = mysqli_num_rows($Recordsetyesno);



$query_RecordsetLOC = "SELECT * FROM cstcmis.location";
$RecordsetLOC = mysqli_query($cstccon,$query_RecordsetLOC) or die(mysqli_error());
$row_RecordsetLOC = mysqli_fetch_assoc($RecordsetLOC);
$totalRows_RecordsetLOC = mysqli_num_rows($RecordsetLOC);

$query_RecordsetLOCATION = "SELECT * FROM cstcmis.location";
$RecordsetLOCATION = mysqli_query($cstccon,$query_RecordsetLOCATION) or die(mysqli_error());
$row_RecordsetLOCATION = mysqli_fetch_assoc($RecordsetLOCATION);
$totalRows_RecordsetLOCATION = mysqli_num_rows($RecordsetLOCATION);


$query2 = "update cstcmis.veh0214 set loc_id = depot where loc_id is null";
$Recordset2 = mysqli_query($cstccon,$query2) or die(mysqli_error());


?>
<script src="js/datatables.min.js"></script> 
 <link rel="stylesheet" type="text/css" href="css/datatables.min.css">




<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<p></p>
 
<p>
    VEHICLE STATUS DETAILS 
</p>
 <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                           
               VEHICLE STATUS AS ON DATE
                    
                   
                        </div>
<div class="panel-body">
        
         
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data-table">
                            
                            <thead>
                                <tr style="font-size: 8px">
                                    <th style="text-align:center;">SRL </th>
                                    <th style="text-align:center;">VEHICLE </th>
                                    <th style="text-align:center;">CHASIS NO. </th>
                                    <th style="text-align:center;">MAC ID </th>
                                    <th style="text-align:center;">COMMISSION </th>
                                    <th style="text-align:center;">MODEL </th>

                                    <th style="text-align:center;">CURRENT STATUS</th>
                                    <th style="text-align:center;">RUNNING / HELDUP</th>
                                    <th style="text-align:center;">LOCATION </th>
                                     <th style="text-align:center;">USER</th>
                                    <th style="text-align:center;">DATE </th>
                                    <th style="text-align:center;">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php
                                                                $i = 1;
								//session_start();
                                                              $sql_itm="SELECT * FROM cstcmis.veh0214 where depot = '" . $unit . "'";
                                                                $result=mysqli_query($cstccon,$sql_itm);     
                                                                while($row = mysqli_fetch_assoc($result))  {
                                                                $id = $row['vehno'];
                                                                ?>
								<tr style="font-size: 8px">
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $i; ?></td>

								<td style="text-align:center; word-break:break-all; "> <?php echo $row['vehno']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row['chs_no']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row['macid']; ?></td>
                                                                <?php $commdate = $row['commdate'];?>
								<td style="text-align:center; word-break:break-all; "> <?php echo substr($commdate,8,2) . '-' . substr($commdate,5,2) . '-' . substr($commdate,0,4); ?></td>
                                                                <?php                $queryX = "select * from cstcmis.veh_cur_stat where cur_stat = '" . $row['cur_stat'] . "'";
                                                                                     $RecordsetX = mysqli_query($cstccon,$queryX) or die(mysqli_error());
                                                                                     $rowsX = mysqli_fetch_assoc($RecordsetX);
                                                                                     $cur_stat_desc = $rowsX['cur_stat_desc'];?>

								<td style="text-align:center; word-break:break-all; "> <?php echo $row['model']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $cur_stat_desc; ?></td>
                                                          <?php      if ($row['runfleet'] == 'R'){
                                                                $vehstat = 'RUNNING';};
                                                                if ($row['runfleet'] == 'H'){
                                                                $vehstat = 'HELD UP';};?>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $vehstat; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row['loc_id']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row['op_code']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo substr($row['upd_date'],8,2) . '-' . substr($row['upd_date'],5,2) . '-' .substr($row['upd_date'],0,4) ; ?></td>
                                                                
								<td style="text-align:center; ">
                                                                        <a href="WBTC_Modal_VehicleStatus.php<?php echo '?id='.$id ; ?>" class=" btn-info">EDIT</a>
                                                                                                                                               
                                                                        

								</td>
                                                               
								                                                 
                                                                <!-- Modal -->
								<div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
								<h3 id="myModalLabel">Delete Record Vehicle Master</h3>
								</div>
								<div class="modal-body">
								<p><div class="alert alert-danger"><?php echo "Are you Sure you want Delete? VEHICLE NUMBER = " . $id ; ?> </p>
								</div>
								<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
								<a href="MIS_VehicleStatusDelete.php<?php echo '?id='.$id; ?>" class="btn btn-danger">Yes</a>
								</div>
								</div>
								</div>
                                                                
								</tr>

								<!-- Modal Bigger Image -->
								<div id="<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">

								<h3 id="myModalLabel"><?php echo $row['out_1st']." ".$row['out_2nd']; ?></h3>
								</div>
								<div class="modal-body">
								<?php if($row['location'] != ""): ?>
								<img src="upload/<?php echo $row['location']; ?>" style="width:390px; border-radius:9px; border:5px solid #d0d0d0; margin-left: 63px; height:387px;">
								<?php else: ?>
								<img src="images/default.png" style="width:390px; border-radius:9px; border:5px solid #d0d0d0; margin-left: 63px; height:387px;">
								<?php endif; ?>
								</div>
								<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
								</div>
								</div>

								<?php 
                                                                $i = $i + 1;
                                                              } ?>
                            </tbody>
                        </table>


          
</div>
       
        </div>
    
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
	
 




