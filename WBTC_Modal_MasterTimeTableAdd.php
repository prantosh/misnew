<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();

$unit = $_SESSION['UNIT'];
$user_id = $_SESSION['USER_ID'];

$query_Recordsetrt = "SELECT * FROM cstcmis.route_master";
$Recordsetrt = mysqli_query($cstccon,$query_Recordsetrt) or die(mysqli_error());
$row_Recordsetrt = mysqli_fetch_assoc($Recordsetrt);



$query_Recordset1 = "SELECT * FROM cstcmis.stop_master ORDER BY STOP_DESC";
$Recordset1 = mysqli_query($cstccon,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


$query_Recordset2 = "SELECT * FROM cstcmis.unit ORDER BY UNIT_DESC";
$Recordset2 = mysqli_query($cstccon,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Add New Route Schedule</title>
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
		<?php  include('WBTC_middle.php'); ?>
		<!-- begin #content -->
		<div class="modal modal-warning fade" id="modal-warning171" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Add New Time Schedule</span></h4>
                            </div>
                            <form method="post" action="WBTC_MasterTimeTableAdd.php"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
					<table class="table1">
						
						<tr>
							<td width="10%"></td>
                                            <td align='left'><h6>ROUTE NUMBER:</h6></td>
							<td>
                                                             <div class="form-group">
                                                            <div class="col-md-16">
                                                            <select class="form-control" name="rt_no" id="rt_no">
                                                            <?php do {?>
                                                            <option value="<?php echo $row_Recordsetrt['RT_NO']?>"><?php echo $row_Recordsetrt['RT_NO']?></option>
                                                            <?php
                                                            } while ($row_Recordsetrt = mysqli_fetch_assoc($Recordsetrt));
                                                            $rows = mysqli_num_rows($Recordsetrt);
                                                            if($rows > 0) {
                                                            mysqli_data_seek($Recordsetrt, 0);
                                                            $row_Recordsetrt = mysqli_fetch_assoc($Recordsetrt);
                                                            }?>
                                                            </select>
                                                     </div>
                                                 </div>
                                                    </td>
						</tr>
						<tr>
							<td width="10%"></td>
                                            <td align='left'><h6>TERMINUS:</h6></td>
							<td>
                                                             <div class="form-group">
                                                            <div class="col-md-16">
                                                            <select  class="form-control" name="terminus"id="terminus">
                                                                <?php
do {  
?>
                                                                <option value="<?php echo $row_Recordset1['STOP_CODE']?>"><?php echo $row_Recordset1['STOP_DESC']?></option>
                                                                <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
                                                              </select>
                                                              </div>
                                                 </div></td>
						</tr>
                                                <tr>
							<td width="10%"></td>
                                            <td align='left'><h6>DEPOT:</h6></td>
							<td>
                                                             <div class="form-group">
                                                            <div class="col-md-16">
                                                            <select  class="form-control" name="depot"id="depot">
                                                              <?php
do {  
?>
                                                              <option value="<?php echo $row_Recordset2['UNIT']?>"><?php echo $row_Recordset2['UNIT_DESC']?></option>
                                                              <?php
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
  $rows = mysqli_num_rows($Recordset2);
  if($rows > 0) {
      mysqli_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysqli_fetch_assoc($Recordset2);
  }
?>
                                                            </select>   </div>
                                                 </div></td>
						</tr>
						<tr>
							<td width="10%"></td>
                                            <td align='left'><h6>SHIFT:</h6></td>
							<td><input  class="form-control" type="text" id="shift" name="shift" placeholder="Shift" onkeypress="return isNumber(event)" required />  </div>
                                                 </div></td>
						</tr>
                                                <tr>
							<td width="10%"></td>
                                            <td align='left'><h6>TRIP:</h6></td>
							<td>
                                                             <div class="form-group">
                                                            <div class="col-md-16">
                                                            <input  class="form-control" type="text" id="trip" name="trip" placeholder="Trip No." onkeypress="return isNumber(event)" required />  </div>
                                                 </div></td>
						</tr>
                                                <tr>
							<td width="10%"></td>
                                            <td align='left'><h6>DEPOT CAR NO.:</h6></td>
							<td>
                                                 <div class="form-group">
                                                            <div class="col-md-16"><input  class="form-control" type="text" id="car_no_depot" name="car_no_depot" placeholder="Car no. Depot" onkeypress="return isNumber(event)" required />  </div>
                                                 </div></td>
						</tr>
                                                <tr>
							<td width="10%"></td>
                                            <td align='left'><h6>TERMINUS CAR NO:</h6></td>
							<td>
                                                             <div class="form-group">
                                                            <div class="col-md-16">
                                                            <input  class="form-control" type="text" id="car_no_terminus" name="car_no_terminus" placeholder="Car No.Terminus" onkeypress="return isNumber(event)" required /></div>
                                                 </div></td>
						</tr>
                                                
                                                <tr>
							
                                                        <td width="10%"></td>
                                            <td align='left'><h6>DEPT. TIME(HR)</h6></td>
							<td>
                                                             <div class="form-group">
                                                            <div class="col-md-16">
                                                            <select  class="form-control" name="hour"id="hour">
                   
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                    </select>    </div>
                                                 </div>         </td>
						</tr>
                                                <tr>
							<td width="10%"></td>
                                            <td align='left'><h6>DEPT. TIME(MIN)</h6></td>
                                                        
							<td>
                                                             <div class="form-group">
                                                            <div class="col-md-16">
                                                            <select  class="form-control" name="minute1"id="minute1">

                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                      <option value="32">32</option>
                      <option value="33">33</option>
                      <option value="34">34</option>
                      <option value="35">35</option>
                      <option value="36">36</option>
                      <option value="37">37</option>
                      <option value="38">38</option>
                      <option value="39">39</option>
                      <option value="40">40</option>
                      <option value="41">41</option>
                      <option value="42">42</option>
                      <option value="43">43</option>
                      <option value="44">44</option>
                      <option value="45">45</option>
                      <option value="46">46</option>
                      <option value="47">47</option>
                      <option value="48">48</option>
                      <option value="49">49</option>
                      <option value="50">50</option>
                      <option value="51">51</option>
                      <option value="52">52</option>
                      <option value="53">53</option>
                      <option value="54">54</option>
                      <option value="55">55</option>
                      <option value="56">56</option>
                      <option value="57">57</option>
                      <option value="58">58</option>
                      <option value="59">59</option>
                      <option value="00">00</option>
                    </select>         </div>
                                                 </div>    </td>
						</tr>
						
						
					</table>
					
	
    
    <div class="modal-footer"style="color:white ;background-color:#a8a646;">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-primary">Add</button>
    </div>
	

					</form>
                        </div>
                        </div>
                    </div>
                </div>
		<!-- end #content -->
		<?php  include('WBTC_ThemePanel.php'); ?>
        
		
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
