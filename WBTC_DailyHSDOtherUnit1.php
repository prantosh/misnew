<?php include('Connections/cstccon.php'); 


 //session_start(); 
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
 //echo $_SESSION['UNIT'] ;
 $no_of_days = $_SESSION['no_of_days'];?>

 <script src="js/datatables.min.js"></script> 
 <link rel="stylesheet" type="text/css" href="css/datatables.min.css">




<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script language="javascript">






</script>
<p></p>   
HSD ISSUE TO OTHER UNIT
<p></p>
 <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <a href="WBTC_Modal_DailyHSDOtherUnit.php" class="btn btn-info" role="button">ISSUE HSD TO OTHER UNIT</a>
                           
              
                    
                   
                        </div>
<div class="panel-body">
        
         
<table id="data-table" class="table table-striped table-bordered"  style="font-size: 10px">                            
                            <thead>
                                <tr style="font-size: 8">
                                    <th style="text-align:center;"><b>DATE</b> </th>
                                    <th style="text-align:center;font-size: 10px"><b>VEHICLE NUMBER</b> </th>
                                    <th style="text-align:center;">ISSUED TO </th>
                                    <th style="text-align:center;">ISSUED FROM </th>
                                    <th style="text-align:center;">QUANTITY (Lit) </th>
                                    <th style="text-align:center;">UPDATE </th>
                                    <th style="text-align:center;">UPDATE BY </th>
                                    
                                    <th style="text-align:center;">ACTION</th>
									
                                </tr>
                            </thead>
                            <tbody>
								<?php
								//session_start();
                                                                $sql_itm="SELECT * FROM cstcmis.veh_hsd_other_depot WHERE issued_from = '" . $_SESSION['UNIT'] . "' AND issue_date BETWEEN CURDATE() - INTERVAL 31 DAY AND CURDATE() order by issue_date desc";
                                                                $result=mysqli_query($cstccon,$sql_itm);
								//$result= mysqli_query($cstccon,"select * from daily_record_model where unit = '" . $_SESSION['UNIT'] . "' order by op_date ASC" ) or die (mysqli_error());
								while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                                $id_no = $row['id'];
                                                                $issue_date = $row['issue_date'];
                                                                ?>
								<tr>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['issue_date']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['vehno']; ?></td>
                                                                <?php
                                                                $sqlaa1="SELECT UNIT_DESC FROM cstcmis.unit WHERE  UNIT = '" . $row['depot'] . "'";
                                                                $resultaa1=mysqli_query($cstccon,$sqlaa1);
                                                                $rowsaa1 = mysqli_fetch_assoc($resultaa1);
                                                                
                                                                ?>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $rowsaa1['UNIT_DESC']; ?></td>
                                                                <?php
                                                                $sqlaa2="SELECT UNIT_DESC FROM cstcmis.unit WHERE  UNIT = '" . $row['issued_from'] . "'";
                                                                $resultaa2=mysqli_query($cstccon,$sqlaa2);
                                                                $rowsaa2 = mysqli_fetch_assoc($resultaa2);
                                                                
                                                                ?>                                                   
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo $rowsaa2['UNIT_DESC']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['qty']; ?></td>
								 <td style="text-align:center; word-break:break-all; "> <?php echo substr($row ['upd_date'],8,2) . '-' . substr($row ['upd_date'],5,2) . '-' .substr($row ['upd_date'],0,4) ; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['op_code']; ?></td>
								                                                                                                              
								 <td style="text-align:center; ">
                                                                <?php   
                                                                     if($row['issue_date'] == date('Y-m-d',strtotime("-1 days"))){         ?>
                                                                     <a href="WBTC_Modal_DailyHSDOtherUnitEdit.php<?php echo '?id_hsd='.$id_no; ?>" class=" btn-danger">EDIT</a>
									 <?php } ?>	
								</td>
								</tr>

								

								<?php } ?>
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
	
	




