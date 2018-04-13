<?php include('Connections/cstccon.php'); 

 session_start(); 
$unit = $_SESSION['UNIT'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
 
 

?>
<script src="js/datatables.min.js"></script> 
 <link rel="stylesheet" type="text/css" href="css/datatables.min.css">

 <p></p><p></p>


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
                           
               MATCHING DEPOT ROUTE CODE TO MIS 
                    
                   
                        </div>



<div class="panel-body">
        
        
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data-table">
                            
                            <thead>
                                <tr style="font-size: 10px">
                                    <th style="text-align:center;">SRL </th>
                                    <th style="text-align:center;">ROUTE NO. IN MIS </th>
                                    <th style="text-align:center;">FROM </th>
                                    <th style="text-align:center;">TO </th>
                                    <th style="text-align:center;">LENGTH (KM) </th>

                                    <th style="text-align:center;">ROUTE NO. DMS</th>
                                    <th style="text-align:center;">UPDATE </th>
                                    <th style="text-align:center;">UPDATE BY </th>
                                    <th style="text-align:center;">ACTION</th>
                                </tr>
                                
                            </thead>
                            <tbody>
								<?php
								//session_start();
                                                                $sql_itm="SELECT * FROM cstcmis.route_master order by RT_NO";
                                                                $result=mysqli_query($cstccon,$sql_itm);
                                                                $SRL = 1;
								//$result= mysqli_query($cstccon,"select * from daily_record_model where unit = '" . $_SESSION['UNIT'] . "' order by op_date ASC" ) or die (mysqli_error());
								while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                                $id= $row ['RT_NO'];
								?>
								<tr>
                                                                    <td> <?php echo $srl ; ?> </td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['RT_NO']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php 
                                                                $sql_itm1="SELECT * FROM cstcmis.stop_master where STOP_CODE = " . $row['FROM_ST'];
                                                                $result1=mysqli_query($cstccon,$sql_itm1);
                                                                $row1= mysqli_fetch_array ($result1);
                                                                echo $row1 ['STOP_DESC']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php 
                                                                $sql_itm2="SELECT * FROM cstcmis.stop_master where STOP_CODE = " . $row['TO_ST'];
                                                                $result2=mysqli_query($cstccon,$sql_itm2);
                                                                $row2= mysqli_fetch_array ($result2);
                                                                echo $row2 ['STOP_DESC']; ?></td>
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['LENGTH']; ?></td>
                                                                
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php 
                                                                $sql_itm3="SELECT * from cstcmis.route_master_depot where route_mis = '" . $row ['RT_NO'] . "' and depot = '" . $_SESSION['UNIT'] . "'";
                                                                $result3=mysqli_query($cstccon,$sql_itm3);
                                                                $row3= mysqli_fetch_array ($result3);
                                                                echo $row3 ['depot_route_desc']; ?></td>
								
                                                                
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo substr($row3 ['upd_date'],8,2) . '-' . substr($row3 ['upd_date'],5,2) . '-' .substr($row3 ['upd_date'],0,4) ; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row3 ['op_code']; ?></td>
								
                                                                
                                                                <td style="text-align:center; ">
                                                                
                                                                    <a href="WBTC_Modal_DepotRouteMISRoute.php<?php echo '?route='.$id; ?>" class=" btn-info">EDIT</a>
									
                                                                        
								</td>
                                                                
                                                            
                                                                
								</tr>

								

								<?php $srl = $srl + 1; } ?>
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
	
 






