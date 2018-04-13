<?php include('Connections/cstccon.php'); 


 //session_start(); 
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
 //echo $_SESSION['UNIT'] ;
 $no_of_days = $_SESSION['no_of_days'];
if(!isset($_POST['rt_no'] )){$route = $_GET['id'];}
 else{
 $route = $_POST['rt_no'] ;}
$_SESSION['route'] = $route;?>
 <script src="js/datatables.min.js"></script> 
 <link rel="stylesheet" type="text/css" href="css/datatables.min.css">




<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script language="javascript">






</script>
<p></p>   
TIME TABLE MASTER DATA ENTRY
<p></p>
 <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <a href="WBTC_Modal_MasterTimeTableAdd.php" class="btn btn-info" role="button">Add New Time Schedule</a>
                           
              
                    
                   
                        </div>
<div class="panel-body">
        
         
<table id="data-table" class="table table-striped table-bordered"  style="font-size: 10px">                            
                            <thead>
                                <tr style="font-size: 8">
                                   
                                    <th style="text-align:center;"><b>SRL</b> </th>
                                     <th style="text-align:center;"><b>ROUTE</b> </th>
                                    <th style="text-align:center;"><b>TERMINUS</b> </th>
                                    <th style="text-align:'left';"><b>OPERATING DEPOT</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">SHIFT<i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">DEPOT CAR NO.<i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">TRIP.<i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">TERMINUS CAR NO. </th>
                                    <th style="text-align:center;">DEPARTURE TIME </th>
                                   <th style="text-align:center;">ACTION</th>
                                    <th style="text-align:center;">ACTION</th>
							
                                </tr>
                            </thead>
                            <tbody>
								<?php
                                                                $i=1;
								//session_start();
                                                                $sql_itm="SELECT a.route route1,a.unit unit1,b.STOP_DESC stop_desc1,a.shift shift1,a.car_no_depot car_no_depot1,a.trip trip1,a.car_no_terminus car_no_terminus1,a.dept_time dept_time1 FROM cstcmis.time_table a,cstcmis.stop_master b where a.route = '" . $route . "' and a.stop_code = b.STOP_CODE order by b.STOP_DESC,a.shift,a.car_no_terminus";
                                                                $result=mysqli_query($cstccon,$sql_itm);
								//$result= mysqli_query($cstccon,"select * from daily_record_model where unit = '" . $_SESSION['UNIT'] . "' order by op_date ASC" ) or die (mysqli_error());
								while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                                $id = $row['stop_desc1'];
                                                                $id1 = $row['shift1'];
                                                                $id2 = $row['car_no_terminus1'];
                                                                
								?>
								<tr>
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo $i; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['route1']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php 
                                                                if($row ['stop_desc1'] != '-SELECT-'){echo $row['stop_desc1'];} ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['unit1']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['shift1']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['car_no_depot1']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['trip1']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['car_no_terminus1']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['dept_time1']; ?></td>
								
                                                                <td>
                                                                
                                                                    <a href="WBTC_Modal_MasterTimeTableEdit.php<?php echo '?id='.$id . '&id1=' . $id1 . '&id2=' . $id2 . '&id3=' . $route ; ?>" class=" btn-info">EDIT</a>
									
								</td>
                                               			<td style="text-align:center; ">
                                                                <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn-danger" >DELETE </a>
								</td>	
								                                                 
                                                                <!-- Modal -->
								<div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
								<h3 id="myModalLabel">Delete Record from Model Wise Details</h3>
								</div>
								<div class="modal-body">
								<p><div class="alert alert-danger"><?php echo "Are you Sure you want Delete? "  ; ?> </p>
								</div>
								<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
								<a href="WBTC_Modal_MasterTimeTableDelete.php<?php echo '?id='.$id . '&id1=' . $id1 . '&id2=' . $id2 ; ?>" class="btn btn-danger">Yes</a>
								</div>
								</div>
								</div>
                                                                
                                                                
								</tr>


								<?php $i=$i+1;} ?>
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
	
	




