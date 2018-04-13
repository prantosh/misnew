<?php include('Connections/cstccon.php'); 

 session_start(); 
$yesterday = date('Y-m-d',strtotime("-1 days"));
$unit = $_SESSION['UNIT'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
 
 

$query = "select * from cstcmis.veh_cur_stat_op_tran where depot = '" . $unit . "' and     op_date = '" . $yesterday . "'" ;
$Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
$totalRows = mysqli_num_rows($Recordset);
if($totalRows <= 0){
    
    $sql_itm22="insert into cstcmisveh_cur_stat_op_tran (vehno,depot,cur_stat,runfleet) select vehno,depot,cur_stat,runfleet from veh0214 where cur_stat = 'S' and runfleet = 'R' and depot = '" . $unit . "'"; 
$result_itm22=mysqli_query($cstccon,$sql_itm22);

 

//$sql_itm24="delete from veh_cur_stat_op_tran where vehno in (select distinct veh_no from cb where wb_date = DATE(DATE_SUB(NOW(),INTERVAL 1 DAY)) and depot = '" . $unit . "') and op_date = '0000-00-00'";
//$result_itm24=mysqli_query($cstccon,$sql_itm24); 



$sql_itm23="update cstcmis.veh_cur_stat_op_tran set op_date = '" . $yesterday . "' where op_date = '0000-00-00'"; 
$result_itm23=mysqli_query($cstccon,$sql_itm23); 
    
    
    
    
 //  $query1 = "insert into veh_cur_stat_op_tran (op_date,depot,vehno) select DATE(DATE_SUB(NOW(),INTERVAL 1 DAY)),'" . $unit . "', (select vehno from veh0214 where depot = '" . $unit . "' and cur_stat = 'S'  and runfleet = 'R' and vehno not in (select veh_no from cb where wb_date = DATE(DATE_SUB(NOW(),INTERVAL 1 DAY))) ";

 //  $Recordset1 = mysqli_query($cstccon,$query1) or die(mysqli_error());

} 


$query2 = "select * from cstcmis.veh_cur_stat_op_tran where cur_stat_op != 'X' and depot = '" . $unit . "' and op_date = '" . $yesterday . "'" ;
$Recordset2 = mysqli_query($cstccon,$query2) or die(mysqli_error());


 $no_of_days = $_SESSION['no_of_days']?>
<script src="js/datatables.min.js"></script> 
 <link rel="stylesheet" type="text/css" href="css/datatables.min.css">




<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<p></p>
 
<p>
    VEHICLE DETENTION DETAILS 
</p>
 <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                           
               VEHICLE DETENTION DETAILS FOR YESTERDAY 
                    
                   
                        </div>
<div class="panel-body">
        
         
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data-table">
                            
                            <thead>
                                <tr style="font-size: 10px">
                                    <th style="text-align:center;">SRL </th>
                                    <th style="text-align:center;">DATE </th>
                                    <th style="text-align:center;">VEHICLE NUMBER </th>
                                    <th style="text-align:center;">MODEL </th>
                                    <th style="text-align:center;">STATUS </th>

                                    <th style="text-align:center;">REASON FOR NON-OUTSHED</th>
                                    <th style="text-align:center;">UPDATE </th>
                                    <th style="text-align:center;">UPDATE BY </th>
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
								<tr style="font-size: 10px">
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $i; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['op_date']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['vehno']; ?></td>
                                                                <?php $query3 = "select model,runfleet from veh0214 where vehno = '" . $id . "'";
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
                                                                    $query3 = "select veh_no from cstcmis.cb where veh_no = '" . $row['vehno'] . "' and wb_date = '" . $yesterday . "'" ;
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
								
                                                                
                                                                <td style="text-align:center; ">
                                                              <?php if($out == 'N'){
                                                              echo "<a href='WBTC_Modal_DailyVehicleDetentionEdit.php?id=" .$id . "' class=' btn-info'>EDIT</a>";
                                                               } ?>	
								</td>
                                                                                                       
                                                                <!-- Modal -->
								<div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
								<h3 id="myModalLabel">Delete Record from Model Wise Details</h3>
								</div>
								<div class="modal-body">
								<p><div class="alert alert-danger"><?php echo "Are you Sure you want Delete? DATE = " . $op_date . " and MODEL = " . $model; ?> </p>
								</div>
								<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
								<a href="MIS_DailyEntryTrafficDispDelete.php<?php echo '?id='.$id; ?>" class="btn btn-danger">Yes</a>
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
	
 




