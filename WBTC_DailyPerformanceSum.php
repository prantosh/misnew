<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}


$sql1 = "select DATE_FORMAT(CURRENT_DATE() ,'%m') mth,DATE_FORMAT(CURRENT_DATE() ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() ,'%b') mth_desc1";
$Recordset1=mysqli_query($cstccon,$sql1);
$row1 = mysqli_fetch_assoc($Recordset1);
$mth_desc1 = $row1['mth_desc1'];
$mth1 = $row1['mth'];
$yr1 = substr($row1['yr'],2,2);

$sql2 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 1 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 1 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 1 MONTH ,'%b') mth_desc2";        
$Recordset2=mysqli_query($cstccon,$sql2);
$row2 = mysqli_fetch_assoc($Recordset2);
$mth_desc2 = $row2['mth_desc2'];
$mth2 = $row2['mth'];
$yr2 = substr($row2['yr'],2,2);

$sql3 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 2 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 2 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 2 MONTH ,'%b') mth_desc3";        
$Recordset3=mysqli_query($cstccon,$sql3);
$row3 = mysqli_fetch_assoc($Recordset3);
$mth_desc3 = $row3['mth_desc3'];
$mth3 = $row3['mth'];
$yr3 = substr($row3['yr'],2,2);

$sql4 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 3 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 3 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 3 MONTH ,'%b') mth_desc4";        
$Recordset4=mysqli_query($cstccon,$sql4);
$row4 = mysqli_fetch_assoc($Recordset4);
$mth_desc4 = $row4['mth_desc4'];
$mth4 = $row4['mth'];
$yr4 = substr($row4['yr'],2,2);

$sql5 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 4 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 4 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 4 MONTH ,'%b') mth_desc5";        
$Recordset5=mysqli_query($cstccon,$sql5);
$row5 = mysqli_fetch_assoc($Recordset5);
$mth_desc5 = $row5['mth_desc5'];
$mth5 = $row5['mth'];
$yr5 = substr($row5['yr'],2,2);

$sql6 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 5 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 5 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 5 MONTH ,'%b') mth_desc6";        
$Recordset6=mysqli_query($cstccon,$sql6);
$row6 = mysqli_fetch_assoc($Recordset6);
$mth_desc6 = $row6['mth_desc6'];
$mth6 = $row6['mth'];
$yr6 = substr($row6['yr'],2,2);

$sql7 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 6 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 6 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 6 MONTH ,'%b') mth_desc7";        
$Recordset7=mysqli_query($cstccon,$sql7);
$row7 = mysqli_fetch_assoc($Recordset7);
$mth_desc7 = $row7['mth_desc7'];
$mth7 = $row7['mth'];
$yr7 = substr($row7['yr'],2,2);

$sql8 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 7 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 7 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 7 MONTH ,'%b') mth_desc8";        
$Recordset8=mysqli_query($cstccon,$sql8);
$row8 = mysqli_fetch_assoc($Recordset8);
$mth_desc8 = $row8['mth_desc8'];
$mth8 = $row8['mth'];
$yr8 = substr($row8['yr'],2,2);

$sql9 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 8 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 8 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 8 MONTH ,'%b') mth_desc9";        
$Recordset9=mysqli_query($cstccon,$sql9);
$row9 = mysqli_fetch_assoc($Recordset9);
$mth_desc9 = $row9['mth_desc9'];
$mth9 = $row9['mth'];
$yr9 = substr($row9['yr'],2,2);

$sql10 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 9 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 9 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 9 MONTH ,'%b') mth_desc10";        
$Recordset10=mysqli_query($cstccon,$sql10);
$row10 = mysqli_fetch_assoc($Recordset10);
$mth_desc10 = $row10['mth_desc10'];
$mth10 = $row10['mth'];
$yr10 = substr($row10['yr'],2,2);

$sql11 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 10 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 10 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 10 MONTH ,'%b') mth_desc11";        
$Recordset11=mysqli_query($cstccon,$sql11);
$row11 = mysqli_fetch_assoc($Recordset11);
$mth_desc11 = $row11['mth_desc11'];
$mth11 = $row11['mth'];
$yr11 = substr($row11['yr'],2,2);

$sql12 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 11 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 11 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 11 MONTH ,'%b') mth_desc12";        
$Recordset12=mysqli_query($cstccon,$sql12);
$row12 = mysqli_fetch_assoc($Recordset12);
$mth_desc12 = $row12['mth_desc12'];
$mth12 = $row12['mth'];
$yr12 = substr($row12['yr'],2,2);

$sql13 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 12 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 12 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 12 MONTH ,'%b') mth_desc13";        
$Recordset13=mysqli_query($cstccon,$sql13);
$row13 = mysqli_fetch_assoc($Recordset13);
$mth_desc13 = $row13['mth_desc13'];
$mth13 = $row13['mth'];
$yr13 = substr($row13['yr'],2,2);

$sql14 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 13 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 13 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 13 MONTH ,'%b') mth_desc14";        
$Recordset14=mysqli_query($cstccon,$sql14);
$row14 = mysqli_fetch_assoc($Recordset14);
$mth_desc14 = $row14['mth_desc14'];
$mth14 = $row14['mth'];
$yr14 = substr($row14['yr'],2,2);

$sql15 = "select DATE_FORMAT(CURRENT_DATE() - INTERVAL 14 MONTH ,'%m') mth,DATE_FORMAT(CURRENT_DATE() - INTERVAL 14 MONTH ,'%Y') yr,DATE_FORMAT(CURRENT_DATE() - INTERVAL 14 MONTH ,'%b') mth_desc15";        
$Recordset15=mysqli_query($cstccon,$sql15);
$row15 = mysqli_fetch_assoc($Recordset15);
$mth_desc15 = $row15['mth_desc15'];
$mth15 = $row15['mth'];
$yr15 = substr($row15['yr'],2,2);
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Date-Wise CSTC performance</title>
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
        <script>
function goBack() {
    window.history.back();
}
</script>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


<link href="IMS_Web.css" rel="stylesheet" type="text/css" >
<script src="js/datatables.min.js"></script> 
 <link rel="stylesheet" type="text/css" href="datatables.min.css">
<link href="font-awesome.min.css" rel="stylesheet"> 

<script src="js/jquery-ui-1.11.4/jquery-ui.js"></script>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader">
	    <div class="material-loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
            <div class="message">Please Wait. It will take time...</div>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
		<?php  include('WBTC_header.php'); ?>
		
		<?php  include('WBTC_left.php'); ?>
            <div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				
				<li class="active">Performance</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Date-Wise Performace <small>Last One Year</small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
            <div class="row">
            <div class="col-md-12" >	
		<!-- begin #content -->
<table  width="90%" align="center"> 
    <tr style="font-size: 10;">
        <td style="background-color: white">

  
            <div class="panel panel-success">
                <div class="panel-heading">
                            
                            <div class="panel-heading-btn">
                                
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                           <h4 class="panel-title">
<a href="#" onClick="goBack()"><b><img src=images/go_back.png class="img-circle" alt="User Image"></b></a>
                        
                           </span></h4>
                </div>
                
                
  
  
  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><?php echo $mth_desc1 . "'" . $yr1; ; ?></a></li>
    
    <li><a data-toggle="tab" href="#menu2"><?php echo $mth_desc2 . "'" . $yr2; ?></a></li>
    <li><a data-toggle="tab" href="#menu3"><?php echo $mth_desc3 . "'" . $yr3; ?></a></li>
    <li><a data-toggle="tab" href="#menu4"><?php echo $mth_desc4 . "'" . $yr4;?></a></li>
    <li><a data-toggle="tab" href="#menu5"><?php echo $mth_desc5 . "'" . $yr5;?></a></li>
    <li><a data-toggle="tab" href="#menu6"><?php echo $mth_desc6 . "'" . $yr6; ?></a></li>
    <li><a data-toggle="tab" href="#menu7"><?php echo $mth_desc7 . "'" . $yr7; ?></a></li>
    <li><a data-toggle="tab" href="#menu8"><?php echo $mth_desc8 . "'" . $yr8; ?></a></li>
    <li><a data-toggle="tab" href="#menu9"><?php echo $mth_desc9 . "'" . $yr9; ?></a></li>
    <li><a data-toggle="tab" href="#menu10"><?php echo $mth_desc10 . "'" . $yr10;?></a></li>
    <li><a data-toggle="tab" href="#menu11"><?php echo $mth_desc11 . "'" . $yr11;?></a></li>
    <li><a data-toggle="tab" href="#menu12"><?php echo $mth_desc12 . "'" . $yr12;?></a></li>
    
  </ul>

  
                        
                        
  
  <div class="tab-content"id='p'>
      
         
          <div id="home" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc1 . "'" . $yr1; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,"
                                    . "sum(veh_supply_old) veh_supply_old1,"
                                    . "sum(veh_supply_1623) veh_supply_16231,"
                                    . "sum(veh_supply_al_nac) veh_supply_al_nac1,"
                                    . "sum(veh_supply_al_ac) veh_supply_al_ac1,"
                                    . "sum(veh_supply_volvo) veh_supply_volvo1,"
                                    . "sum(veh_supply_1st) veh_supply_1st_tot,"
                                    . "sum(veh_supply_2nd) veh_supply_2nd_tot, "
                                    . "sum(att_driver_1st + att_driver_tr_1st) att_driver_1st_tot,"
                                    . "sum(att_driver_2nd + att_driver_tr_2nd) att_driver_2nd_tot,"
                                    . "sum(att_cond_1st + att_cond_tr_1st) att_cond_1st_tot,"
                                    . "sum(att_cond_2nd + att_cond_tr_2nd) att_cond_2nd_tot "
                                    . "from cstcmis.daily_record_sum "
                                    . "where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE ,'%m') "
                                    . "and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE,'%Y') "
                                    . "group by op_date order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                            $query11 = "select op_date,"
                                    . "SUM(veh_out_1st) veh_out_1st_tot,"
                                    . "sum(veh_out_2nd) veh_out_2nd_tot,"
                                    . "sum(sch_trip) sch_trip_tot, "
                                    . "sum(act_trip) act_trip_tot,"
                                    . "sum(km) km_tot, "
                                    . "sum(km_2nd) km_2nd_tot ,"
                                    . "sum(hsd) hsd_tot,"
                                    . "sum(sale_1st) sale_1st_tot, "
                                    . "sum(sale_2nd) sale_2nd_tot "
                                    . "from  cstcmis.daily_record_model "
                                    . "where (sale_1st + sale_2nd) > 0 "
                                    . "and op_date = '" . $row1['op_date'] . "' "
                                    . "group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                            $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 "
                                    . "from cstcmis.daily_record_sum  "
                                    . "where op_date = '" . $row1['op_date'] . "' "
                                    . "group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
     
      <div id="menu2" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc2 . "'" . $yr2; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 1 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      
       <div id="menu3" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc3 . "'" . $yr3; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr style="font-size: 10;">
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 2 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 2 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
     
      <div id="menu4" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc4 . "'" . $yr4; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 3 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 3 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      
      
       <div id="menu5" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc5 . "'" . $yr5; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 4 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 4 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      
      <div id="menu6" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc6 . "'" . $yr6; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 5 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 5 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      <div id="menu7" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc7 . "'" . $yr7; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 6 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 6 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      
      <div id="menu8" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc8 . "'" . $yr8; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 7 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 7 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      
      <div id="menu9" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc9 . "'" . $yr9; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 8 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 8 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      
       <div id="menu10" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc10 . "'" . $yr10; ; ?></b><p></p>
   <thead>
                                <tr style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 9 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 9 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      <div id="menu11" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc11 . "'" . $yr11; ; ?></b><p></p>
   <thead>
                                <tr  style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr  style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 10 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 10 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      
      <div id="menu12" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
     
    <p></p>PERFORMANCE DETAIL FOR<b>  <?php echo $mth_desc12 . "'" . $yr12; ; ?></b><p></p>
   <thead>
                                <tr  style="font-size: 10;">
                                    <th>DATE</th>
                                    <th >SUPPLY</th>
                                    <th  >OUT</th>
                                    <th> % TRIP </th>
                                    <th colspan='3'style='text-align: center'>REVENUE (Lakh) </th>
                                    <th >KM (Lakh)</th>
                                    <th >KMPL </th>
                                    <th ALIGN='CENTER'colspan='3'style='text-align: center'>EPKM </th>
			        </tr>
                                <tr style="font-size: 10;">
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th>LOSS </th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
                                    <th>TOTAL </th>
                                    <th></th>
                                    <th>Shift-I</th>
                                    <th>Shift-II</th>
                                    <th>TOTAL</th>
			        </tr>
    </thead>
    <tbody>
                           <?php
                            $sql1 = "select op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1, veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot, att_driver_2nd_tot,att_cond_1st_tot, att_cond_2nd_tot from cstcmis.cstc_daily_performance where DATE_FORMAT(op_date,'%m') = DATE_FORMAT(CURRENT_DATE  - INTERVAL 11 MONTH,'%m') and DATE_FORMAT(op_date,'%Y') = DATE_FORMAT(CURRENT_DATE - INTERVAL 11 MONTH,'%Y')  order by op_date desc";
                            $Recordset1=mysqli_query($cstccon,$sql1);
                            $row1 = mysqli_fetch_assoc($Recordset1);
                                                  
								do{
                                                                $veh_supply_1st = $row1 ['veh_supply_old1'] + $row1 ['veh_supply_16231'] + $row1 ['veh_supply_al_nac1'] + $row1 ['veh_supply_al_ac1'] + $row1 ['veh_supply_volvo1'];
								?>
								<tr style="font-size: 10;">
                                                                <td> <?php echo substr($row1['op_date'],8,2) ; ?></td>
                                                                <td> <?php echo $veh_supply_1st; ?></td>
					                        <?php
                                                                                                          
                                                                $query11 = "select op_date,SUM(veh_out_1st) veh_out_1st_tot,sum(veh_out_2nd) veh_out_2nd_tot,sum(sch_trip) sch_trip_tot, sum(act_trip) act_trip_tot,sum(km) km_tot, sum(km_2nd) km_2nd_tot ,sum(hsd) hsd_tot,sum(sale_1st) sale_1st_tot, sum(sale_2nd) sale_2nd_tot from  cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0  and op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
                                                                $row11 = mysqli_fetch_assoc($result11);
                                                                                               
                                                                $query1n = "select sum(veh_out_old + veh_out_1623 + veh_out_al_ac + veh_out_al_nac + veh_out_volvo) out_cstc1 from cstcmis.daily_record_sum  where op_date = '" . $row1['op_date'] . "' group by op_date";
                                                                $Recordset1n = mysqli_query($cstccon,$query1n) or die(mysqli_error());
                                                                if(mysqli_num_rows($Recordset1n)>0)
                                                                {
                                                                $row1n = mysqli_fetch_assoc($Recordset1n);
                                                                $out_cstc1 = $row1n['out_cstc1'];
                                                                    }
                                                              ?>
                                                                                                             
                                                                <td> <?php echo $out_cstc1; ?></td>
                                                                <td  style='text-align: right'>
                                                                <?php  if($row11['sch_trip_tot'] > 0){
                                                                echo number_format(($row11['sch_trip_tot'] - $row11['act_trip_tot']) * 100 / $row11['sch_trip_tot'],1);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_1st_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format($row11['sale_2nd_tot']/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot'])/100000,2);?> </td>
                                                                <td style='text-align: right'> <?php  echo number_format(($row11['km_tot'] + $row11['km_2nd_tot'])/100000,2) ;?> </td>
                                                                
                                                                <td style='text-align: right'>
                                                                <?php if($row11['hsd_tot'] > 0){
                                                                echo number_format(($row11['km_tot'] + $row11['km_2nd_tot']) / $row11['hsd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] > 0){
                                                                echo number_format($row11['sale_1st_tot'] / $row11['km_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_2nd_tot'] > 0){
                                                                echo number_format($row11['sale_2nd_tot'] / $row11['km_2nd_tot'],2);
                                                                }?>
                                                                </td>
                                                                <td style='text-align: right'>
                                                                <?php if($row11['km_tot'] + $row11['km_2nd_tot'] > 0){
                                                                echo number_format(($row11['sale_1st_tot'] + $row11['sale_2nd_tot']) / ($row11['km_tot'] + $row11['km_2nd_tot']),2);
                                                                } ?>
                                                                </td>
                                                                </tr>
                                                                <?php }while ($row1= mysqli_fetch_array ($Recordset1) ) ?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
<!--- **********************************************888 -->
   
<!--- **********************************************888 -->
   
<!--- **********************************************888 -->
 
<!--- **********************************************888 -->

<!--- **********************************************888 -->


  </div>
      </div>
        </td>
    </tr>
</table>
<p></p>

<div align ="center"><a href="CSTC_MainMenu.php" class="btn btn-success">EXIT</a>
            

            

            </div>		<!-- end #content -->
		<?php  include('WBTC_ThemePanel.php'); ?>
        
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
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
	<!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript">
       

$(document).ready(function()
{       
    
    $('#tbl_id').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id1').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id2').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id3').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id4').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id5').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id6').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        
        App.init();
			Dashboard.init();
        
			 FormPlugins.init();
});
</script>	
	
</body>
</html>
