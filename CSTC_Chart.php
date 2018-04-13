<?php error_reporting(E_ERROR|E_WARNING);
$cur_fin_yr = '18';
session_start();
require_once('Connections/cstccon.php'); 
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}

$sql = "SELECT count(*) nos from itm";
$result = mysqli_query($cstccon,$sql);
$row1 = mysqli_fetch_array($result);
$tot_item = $row1['nos'];

$tata = 0;
$leyland = 0;
$leyland1 = 0;
$leyland2 = 0;
$volvo = 0;
$common = 0;
$sql4 = "SELECT substr(PART_NO,1,1) aa,count(*) nos from itm group by substr(PART_NO,1,1)";
$result4 = mysqli_query($cstccon,$sql4);
while ($row4 = mysqli_fetch_array($result4)) {
    if($row4['aa'] == 'T'){$tata = $row4['nos'];}
    if($row4['aa'] == 'C'){$leyland1 = $row4['nos'];}
    if($row4['aa'] == 'J'){$leyland2 = $row4['nos'];}
    if($row4['aa'] == 'V'){$volvo = $row4['nos'];}
}  
$leyland = $leyland1 + $leyland2 ;
$common = $tot_item - $tata - $leyland - $volvo ;


$sql2 = "SELECT SUM(GRS_VAL)  AS tot_value FROM matrctitm  WHERE  PERIOD_ADD(DATE_FORMAT(NOW(),'%Y%m'), -1) = DATE_FORMAT(CREDT,'%Y%m')";
$result2 = mysqli_query($cstccon,$sql2);
$row2 = mysqli_fetch_array($result2);
$tot_rct_val = $row2['tot_value'];

$sql3 = "SELECT SUM(ITM_VAL)  AS tot_value FROM bintxnitm  WHERE ITM_VAL < 0 AND  PERIOD_ADD(DATE_FORMAT(NOW(),'%Y%m'), -1) = DATE_FORMAT(CREDT,'%Y%m')";
$result3 = mysqli_query($cstccon,$sql3);
$row3 = mysqli_fetch_array($result3);
$tot_iss_val = -$row3['tot_value'];
    

$query = "SELECT B.GRP_NM_NEW GRP_NM_NEW1 ,format(sum(A.OPNG_VAL + A.RCT_VAL - A.ISS_VAL)/ 100000,2) NOS FROM bincrd A,itmgrp B,itmsbgrp C,itm D where C.GRP_ID = B.GRP_ID AND D.SBGRP_ID = C.SBGRP_ID AND D.PART_NO = A.PART_NO AND A.FIN_YR = '" . $cur_fin_yr . "' group by B.GRP_NM_NEW";
$results = mysqli_query($cstccon,$query);
$pieData = array();

while ($row = mysqli_fetch_array($results)) {
   
    $pieData[] = array($row['GRP_NM_NEW1'], $row['NOS']);
}

$query5 = "SELECT A.PRTY_CD PRTY_CD1,format(SUM(B.ITM_VAL)/ 100000,2)  tot_value FROM bintxn A,bintxnitm B, unit C WHERE A.PRTY_CD = C.UNIT AND C.UNIT IN('ND','BD','PD','MD','SLD','KD','GD','LD','TD','TPD','HD','CWS') AND A.BNTXN_ID = B.BNTXN_ID AND B.ITM_VAL < 0 AND  DATE_FORMAT(A.CREDT,'%Y%m')  in (PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1), PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -3),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -4),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -5),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -6),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -7),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -8),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -9),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -10),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -11),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -12)) GROUP BY A.PRTY_CD";
$results5 = mysqli_query($cstccon,$query5);
$pieData5 = array();

while ($row5 = mysqli_fetch_array($results5)) {
    
    $pieData5[] = array($row5['PRTY_CD1'], -$row5['tot_value']);
}



$query6 = "SELECT a.unit unit1, "
        . "SUM(a.km_ac + a.km_nac_new + a.km_nac_old + a.km_ac_2nd + a.km_nac_new_2nd + a.km_nac_old_2nd) km, "
        . "sum(a.hsd_ac + a.hsd_nac_new + a.hsd_nac_old) hsd "
        . "FROM cstcmis.month_data a " 
        . "WHERE "
        . "concat('20',a.mth) in (PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1), PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -3),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -4),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -5),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -6),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -7),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -8),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -9),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -10),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -11),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -12)) "
        . "group by a.unit having "
        . "SUM(a.km_ac + a.km_nac_new + a.km_nac_old + a.km_ac_2nd + a.km_nac_new_2nd + a.km_nac_old_2nd) > 0";
//$query5 = "SELECT A.PRTY_CD PRTY_CD1,SUM(B.ITM_VAL)  tot_value FROM bintxn A,bintxnitm B, unit C WHERE A.PRTY_CD = C.UNIT AND C.UNIT IN('ND','BD','PD','MD','SLD','KD','GD','LD','TD','TPD','HD','CWS') AND A.BNTXN_ID = B.BNTXN_ID AND B.ITM_VAL < 0 AND  PERIOD_ADD(DATE_FORMAT(NOW(),'%Y%m'), -1) = DATE_FORMAT(A.CREDT,'%Y%m') GROUP BY A.PRTY_CD";
$results6 = mysqli_query($cstccon,$query6);
$pieData6 = array();

while ($row6 = mysqli_fetch_array($results6)) {
    
    $pieData6[] = array($row6['unit1'],$row6['km']);
}


$sql = "select * from cstcmis.month_data where concat('20',mth) = PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1) and running > 0" ;
$result = mysqli_query($cstccon,$sql);
if(mysqli_num_rows($result) > 0){
$sqlz = "select month_name,year_name from cstcmis.month_data where concat('20',mth) = PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1) and running > 0" ;
$resultz = mysqli_query($cstccon,$sqlz);
$rowz = mysqli_fetch_array($resultz);
$month_name = $rowz['month_name'];
$year_name = $rowz['year_name'];

$query7 = "SELECT unit,cpkm_opr cpkm_opr,"
        . "epkm, "
        . "(sal + incen + ot) / (km_ac + km_nac_new + km_nac_old + km_ac_2nd + km_nac_new_2nd + km_nac_old_2nd) sal_per_km "
        . " from cstcmis.month_data where concat('20',mth) = PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1)";
}  
else {
    $sqlz = "select month_name,year_name from cstcmis.month_data where concat('20',mth) = PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2) and running > 0" ;
$resultz = mysqli_query($cstccon,$sqlz);
$rowz = mysqli_fetch_array($resultz);
$month_name = $rowz['month_name'];
$year_name = $rowz['year_name'];

    $query7 = "SELECT unit,cpkm_opr ,"
        . " epkm, "
        . "(sal + incen + ot) / (km_ac + km_nac_new + km_nac_old + km_ac_2nd + km_nac_new_2nd + km_nac_old_2nd) sal_per_km "
        . " from cstcmis.month_data where concat('20',mth) = PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2)";

}
$results7 = mysqli_query($cstccon,$query7);
while ($row7 = mysqli_fetch_array($results7)) {
    if($row7['unit'] == 'BD'){
        $cpkm_opr_bd = number_format($row7['cpkm_opr'],2);
        $epkm_bd = number_format($row7['epkm'],2);
        $sal_per_km_bd = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'ND'){
        $cpkm_opr_nd = number_format($row7['cpkm_opr'],2);
        $epkm_nd = number_format($row7['epkm'],2);
        $sal_per_km_nd = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'PD'){
        $cpkm_opr_pd = number_format($row7['cpkm_opr'],2);
        $epkm_pd = number_format($row7['epkm'],2);
        $sal_per_km_pd = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'MD'){
        $cpkm_opr_md = number_format($row7['cpkm_opr'],2);
        $epkm_md = number_format($row7['epkm'],2);
        $sal_per_km_md = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'SLD'){
        $cpkm_opr_sld = number_format($row7['cpkm_opr'],2);
        $epkm_sld = number_format($row7['epkm'],2);
        $sal_per_km_sld = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'KD'){
        $cpkm_opr_kd = number_format($row7['cpkm_opr'],2);
        $epkm_kd = number_format($row7['epkm'],2);
        $sal_per_km_kd = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'GD'){
        $cpkm_opr_gd = number_format($row7['cpkm_opr'],2);
        $epkm_gd = number_format($row7['epkm'],2);
        $sal_per_km_gd = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'LD'){
        $cpkm_opr_ld = number_format($row7['cpkm_opr'],2);
        $epkm_ld = number_format($row7['epkm'],2);
        $sal_per_km_ld = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'TD'){
        $cpkm_opr_td = number_format($row7['cpkm_opr'],2);
        $epkm_td = number_format($row7['epkm'],2);
        $sal_per_km_td = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'TPD'){
        $cpkm_opr_tpd = number_format($row7['cpkm_opr'],2);
        $epkm_tpd = number_format($row7['epkm'],2);
        $sal_per_km_tpd = number_format($row7['sal_per_km'],2);
    }
    if($row7['unit'] == 'HD'){
        $cpkm_opr_hd = number_format($row7['cpkm_opr'],2);
        $epkm_hd = number_format($row7['epkm'],2);
        $sal_per_km_hd = number_format($row7['sal_per_km'],2);
    }
    
}

$query8 = "SELECT unit,sum(hsd_ac + hsd_nac_new + hsd_nac_old) /1000 hsd1 from cstcmis.month_data where concat('20',mth) in (PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1), PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -3),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -4),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -5),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -6),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -7),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -8),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -9),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -10),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -11),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -12)) and  unit IN('ND','BD','PD','MD','SLD','KD','GD','LD','TD','TPD','HD')  group by unit";
        
$results8 = mysqli_query($cstccon,$query8);
$pieData8 = array();

while ($row8 = mysqli_fetch_array($results8)) {
    
    $pieData8[] = array($row8['unit'],$row8['hsd1']);
}
$query9 = "SELECT a.sale_type1 sale_type2,sum(b.hsd) hsd1 from cstcmis.model_master a,cstcmis.daily_record_model b where DATE_FORMAT(b.op_date,'%Y%m') in (PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1), PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -3),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -4),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -5),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -6),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -7),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -8),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -9),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -10),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -11),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -12)) and a.model = b.model group by a.sale_type1";

//$query9 = "SELECT sum(hsd_ac) hsd_ac1 , sum(hsd_nac_new) hsd_nac_new1 , sum(hsd_nac_old) hsd_nac_old1 from cstcmis.month_data where concat('20',mth) in (PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1), PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -3),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -4),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -5),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -6),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -7),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -8),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -9),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -10),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -11),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -12)) ";
        
$results9 = mysqli_query($cstccon,$query9);
$hsd_volvo = 0;
$hsd_alac = 0;
$hsd_nac_bs4 = 0;
$hsd_other = 0;
while ($row9 = mysqli_fetch_array($results9)) {
    if($row9['sale_type2'] == 'VO'){$hsd_volvo = $row9['hsd1'];}
    if($row9['sale_type2'] == 'AA'){$hsd_alac = $row9['hsd1'];}
    if($row9['sale_type2'] == 'NN'){$hsd_nac_bs4 = $row9['hsd1'];}
    if($row9['sale_type2'] == 'OL'){$hsd_other = $row9['hsd1'];}
}



$query10 = "SELECT unit,sum(sale_entered_from_depot) / 100000 sale from cstcmis.month_data where concat('20',mth) in (PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1), PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -3),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -4),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -5),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -6),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -7),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -8),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -9),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -10),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -11),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -12)) and  unit IN('ND','BD','PD','MD','SLD','KD','GD','LD','TD','TPD','HD')  group by unit having sale > 0";
        
$results10 = mysqli_query($cstccon,$query10);
$pieData10 = array();

while ($row10 = mysqli_fetch_array($results10)) {
    
    $pieData10[] = array($row10['unit'],$row10['sale']);
}

$query11 = "SELECT a.sale_type1 sale_type2,sum(b.sale_1st + b.sale_2nd) sale from cstcmis.model_master a,cstcmis.daily_record_model b where DATE_FORMAT(b.op_date,'%Y%m') in (PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -1), PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -2),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -3),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -4),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -5),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -6),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -7),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -8),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -9),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -10),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -11),PERIOD_ADD(DATE_FORMAT(NOW(),'%y%m'), -12)) and a.model = b.model group by a.sale_type1";
        
$results11 = mysqli_query($cstccon,$query11);
$sale_volvo = 0;
$sale_alac = 0;
$sale_nac_bs4 = 0;
$sale_other = 0;
while ($row11 = mysqli_fetch_array($results11)) {
    if($row11['sale_type2'] == 'VO'){$sale_volvo = $row11['sale'];}
    if($row11['sale_type2'] == 'AA'){$sale_alac = $row11['sale'];}
    if($row11['sale_type2'] == 'NN'){$sale_nac_bs4 = $row11['sale'];}
    if($row11['sale_type2'] == 'OL'){$sale_other = $row11['sale'];}
}

$hsd_ac = $row9['hsd_ac1'];
$hsd_nac_new = $row9['hsd_nac_new1'];
$hsd_nac_old = $row9['hsd_nac_old1'];?>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
     

</script>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>WBTC / Material Management System</title>
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
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE CSS ================== -->
    <link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS ================== -->
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

	<!--<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
		 begin #header -->
		<?php  include('CSTC_header.php'); ?>
		
		<?php  include('CSTC_left.php'); ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Performance</a></li>
				<li class="active">Charts</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Performances <small>In Different Parameters ...</small></h1>
			<!-- end page-header -->
			
			<!-- begin alert -->
			
			<!-- end alert -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title"><?php echo 'Last Month Performance - ' . $month_name . ' , ' . $year_name . ' - (Operating Cost, Salary Expenses and EPKM)';?></span></h4>
                        </div>
                        <div class="panel-body">
                            <div  >
                                <script type="text/javascript">
                src="https://www.gstatic.com/charts/loader.js"></script>
       <div id="chart_div"></div>
       <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['NAME OF DEPOT', 'CPKM (OPERATING)(Rs.)', 'SALARY/KM (Rs.)', 'EPKM (Rs.)'],
          ['BELGHORIA', <?php echo $cpkm_opr_bd ; ?>, <?php echo $sal_per_km_bd ; ?>, <?php echo $epkm_bd ; ?>],
          ['NILGUNJ', <?php echo $cpkm_opr_nd ; ?>, <?php echo $sal_per_km_nd ; ?>, <?php echo $epkm_nd ; ?>],
          ['PAIKPARA', <?php echo $cpkm_opr_pd ; ?>, <?php echo $sal_per_km_pd ; ?>, <?php echo $epkm_pd ; ?>],
          ['MANICKTALA', <?php echo $cpkm_opr_md ; ?>, <?php echo $sal_per_km_md ; ?>, <?php echo $epkm_md ; ?>],
          ['SALTLAKE', <?php echo $cpkm_opr_sld ; ?>, <?php echo $sal_per_km_sld ; ?>, <?php echo $epkm_sld ; ?>],
          ['KASBA', <?php echo $cpkm_opr_kd ; ?>, <?php echo $sal_per_km_kd ; ?>, <?php echo $epkm_kd ; ?>],
          ['GARIA', <?php echo $cpkm_opr_gd ; ?>, <?php echo $sal_per_km_gd ; ?>, <?php echo $epkm_gd ; ?>],
          ['LAKE', <?php echo $cpkm_opr_ld ; ?>, <?php echo $sal_per_km_ld ; ?>, <?php echo $epkm_ld ; ?>],
          ['TARATALA', <?php echo $cpkm_opr_td ; ?>, <?php echo $sal_per_km_td ; ?>, <?php echo $epkm_td ; ?>],
          ['TPD', <?php echo $cpkm_opr_tpd ; ?>, <?php echo $sal_per_km_tpd ; ?>, <?php echo $epkm_tpd ; ?>],
          ['HOWRAH', <?php echo $cpkm_opr_hd ; ?>, <?php echo $sal_per_km_hd ; ?>, <?php echo $epkm_hd ; ?>]
         
        ]);

        var options = {
          chart: {
            
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 275,
          colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

        var btns = document.getElementById('btn-group');

        btns.onclick = function (e) {

          if (e.target.tagName === 'BUTTON') {
            options.vAxis.format = e.target.id === 'none' ? '' : e.target.id;
            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        }
      }
      </script>
                            </div>
                        </div>
                    </div>
			    </div>
			    <!-- end col-6 -->
			    <!-- begin col-6 -->
			    
			    <!-- end col-6 -->
			</div>
			<!-- end row -->
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-6">
			        <div class="panel panel-info">
			            <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Inventory Classification (Rs. in Lakh)</span></h4>
			            </div>
			            <div class="panel-body">
			                <div >
             <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
      
                function drawChart()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'CATEGORY');
                        data.addColumn('number', 'NUMBERS');
                        data.addRows(<?php echo json_encode($pieData, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data,options);
                    }
            </script>
            <div id="donutchart" style="border: 1px solid #ccc"></div>                               
</div>
			            </div>
			        </div>
			    </div>
			    <!-- end col-6 -->
			    <!-- begin col-6 -->
			    <div class="col-md-6">
			        <div class="panel panel-info">
			            <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Spare-OEM Classification (No. of Items)</span></h4>
			            </div>
			            <div class="panel-body">
                                        <div >
                                            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart1);
      
                function drawChart1() {

                var data = google.visualization.arrayToDataTable([
                ['DESCRIPTION', 'NO. OF ITEMS'],
                ['TATA', <?php echo $tata ; ?>],
                ['LEYLAND',  <?php echo $leyland ; ?>],
                ['VOLVO',  <?php echo $volvo ; ?>],
                ['COMMON', <?php echo $common ; ?>]
               
                ]);
                 var options = {
                    title: '',
                     pieHole: 0.3, width:500,height:325
                 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart1'));
                        chart.draw(data,options);
                          
                }
            </script>
            <div id="donutchart1" style="border: 1px solid #ccc"></div>
                                        </div>
			            </div>
			        </div>
			    </div>
			    <!-- end col-6 -->
			</div>
			<!-- end row -->
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Spares Issued in Rs. Lakh (Last 1 Year)</span></h4>
                        </div>
                        <div class="panel-body">
                            <div >
                                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart2);
      
                function drawChart2()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'UNIT');
                        data.addColumn('number', 'VALUE');
                        data.addRows(<?php echo json_encode($pieData5, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart5'));
                        chart.draw(data,options);
                    }
            </script>
            <div id="donutchart5" style="border: 1px solid #ccc"></div>
                            </div>
                        </div>
                    </div>
			    </div>
			    <!-- end col-6 -->
			    <!-- begin col-6 -->
			    <div class="col-md-6">
			        <div class="panel panel-info">
			            <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">K.M. Covered (Last 1 Year)</span></h4>
			            </div>
			            <div class="panel-body">
                                        <div >
                                            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart3);
      
                function drawChart3()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'UNIT');
                        data.addColumn('number', 'VALUE');
                        data.addRows(<?php echo json_encode($pieData6, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart6'));
                        
    var formatter = new google.visualization.NumberFormat(
    {prefix: '$', negativeColor: 'red', negativeParens: true});
formatter.format(data, 0); // Apply formatter to second column
    
    
    
    chart.draw(data,options);
                    }
            </script>
            <div id="donutchart6" style="border: 1px solid #ccc"></div>
                                        </div>
			            </div>
			        </div>
			    </div>
			    <!-- end col-6 -->
			</div>
			<!-- end row -->
                        <div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">HSD Consumption (Service Type-Wise)(Last 1 Year)</span></h4>
                        </div>
                        <div class="panel-body">
                            <div >
                                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart9);
      
                function drawChart9() {

                var data = google.visualization.arrayToDataTable([
                ['DESCRIPTION', 'HSD CONSUMED'],
                ['VOLVO', <?php echo $hsd_volvo ; ?>],
                ['LEYLAND AC',  <?php echo $hsd_alac ; ?>],
                ['NON-AC BS-IV',  <?php echo $hsd_nac_bs4 ; ?>],
                ['OTHER',  <?php echo $hsd_other ; ?>]
               
               
                ]);
                 var options = {
                    title: '',
                     pieHole: 0.3, width:500,height:325
                 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart9'));
                        chart.draw(data,options);
                          
                }
            </script>
            <div id="donutchart9" style="border: 1px solid #ccc"></div>
                            </div>
                        </div>
                    </div>
			    </div>
			    <!-- end col-6 -->
			    <!-- begin col-6 -->
			    <div class="col-md-6">
			        <div class="panel panel-info">
			            <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Revenue (Depot-Wise)Rs. Lakh) (Last 1 Year)</span></h4>
			            </div>
			            <div class="panel-body">
                                        <div >
                                            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart10);
      
                function drawChart10()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'DEPOT');
                        data.addColumn('number', 'REVENUE');
                        data.addRows(<?php echo json_encode($pieData10, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart10'));
                        chart.draw(data,options);
                    }
            </script>
            <div id="donutchart10" style="border: 1px solid #ccc"></div>
                                        </div>
			            </div>
			        </div>
			    </div>
			    <!-- end col-6 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
        <!-- begin theme-panel -->
        <?php  include('CSTC_ThemePanel.php'); ?>
		
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js"></script>
    <script src="assets/plugins/nvd3/build/nv.d3.js"></script>
	<script src="assets/js/chart-d3.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			ChartNvd3.init();
		});
	</script>
</body>
</html>
