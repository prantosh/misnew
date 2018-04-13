<?php 

error_reporting(E_ERROR|E_WARNING);   
//session_start();
$cur_fin_yr = '18';
require_once('Connections/cstccon.php'); 


$sql = "SELECT count(*) nos from cstcmis.veh0214 where runfleet = 'R'";
$result = mysqli_query($cstccon,$sql);
$row1 = mysqli_fetch_array($result);
$tot_veh = $row1['nos'];

$sql = "SELECT count(*) nos from cstcmis.cstc_emp_master where EMPNO LIKE 'TC%' OR EMPNO LIKE 'TD%'";
$result = mysqli_query($cstccon,$sql);
$row1 = mysqli_fetch_array($result);
$tot_emp_cont = $row1['nos'];

$sql = "SELECT count(*) nos from cstcmis.cstc_emp_master";
$result = mysqli_query($cstccon,$sql);
$row1 = mysqli_fetch_array($result);
$tot_emp = $row1['nos'];

$tot_emp_permanent = $tot_emp - $tot_emp_cont;


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
$hsd_nac_old = $row9['hsd_nac_old1'];
?>

<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Dashboard <small>West Bengal Transport Corporation</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon"><i class="fa fa-bus"></i></div>
						<div class="stats-info">
							<h4>FLEET STRENGTH</h4>
							<p><?php echo $tot_veh ; ?></p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon"><i class="fa fa-users"></i></div>
						<div class="stats-info">
							<h4>EMPLOYEES - PERMANENT</h4>
							<p><?php echo $tot_emp_permanent ; ?></p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-purple">
						<div class="stats-icon"><i class="fa fa-users"></i></div>
						<div class="stats-info">
							<h4>EMPLOYEES - CONTRACTUAL</h4>
							<p><?php echo $tot_emp_cont ; ?></p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fa fa-users"></i></div>
						<div class="stats-info">
							<h4>EMPLOYEES - AGENCY</h4>
							<p><?php echo $tot_emp_cont ; ?></p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>
                        <div class="row">
				<!-- begin col-3 -->
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
            title: "<?php echo 'Last Month Performance - ' . $month_name . ' , ' . $year_name ;?>",
            subtitle: 'Operating Cost, Salary Expenses and EPKM',
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
				<!-- end col-3 -->
				<!-- begin col-3 -->
				
				<!-- end col-3 -->
				<!-- begin col-3 -->
				
			</div>
			<!-- end row -->
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-8">
					<div class="panel panel-inverse" data-sortable-id="index-1">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Website Analytics (Last 7 Days)</h4>
						</div>
						<div class="panel-body">
							<div id="interactive-chart" class="height-sm"></div>
						</div>
					</div>
					
					<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">
						<li class="active"><a href="#latest-post" data-toggle="tab"><i class="fa fa-picture-o m-r-5"></i> <span class="hidden-xs">Latest Post</span></a></li>
						<li class=""><a href="#purchase" data-toggle="tab"><i class="fa fa-shopping-cart m-r-5"></i> <span class="hidden-xs">Purchase</span></a></li>
						<li class=""><a href="#email" data-toggle="tab"><i class="fa fa-envelope m-r-5"></i> <span class="hidden-xs">Email</span></a></li>
					</ul>
					<div class="tab-content" data-sortable-id="index-3">
						<div class="tab-pane fade active in" id="latest-post">
							<div class="height-sm" data-scrollbar="true">
								<ul class="media-list media-list-with-divider">
									<li class="media media-lg">
										<a href="javascript:;" class="pull-left">
											<img class="media-object" src="assets/img/gallery/gallery-1.jpg" alt="" />
										</a>
										<div class="media-body">
											<h4 class="media-heading">Aenean viverra arcu nec pellentesque ultrices. In erat purus, adipiscing nec lacinia at, ornare ac eros.</h4>
											Nullam at risus metus. Quisque nisl purus, pulvinar ut mauris vel, elementum suscipit eros. Praesent ornare ante massa, egestas pellentesque orci convallis ut. Curabitur consequat convallis est, id luctus mauris lacinia vel. Nullam tristique lobortis mauris, ultricies fermentum lacus bibendum id. Proin non ante tortor. Suspendisse pulvinar ornare tellus nec pulvinar. Nam pellentesque accumsan mi, non pellentesque sem convallis sed. Quisque rutrum erat id auctor gravida.
										</div>
									</li>
									<li class="media media-lg">
										<a href="javascript:;" class="pull-left">
											<img class="media-object" src="assets/img/gallery/gallery-10.jpg" alt="" />
										</a>
										<div class="media-body">
											<h4 class="media-heading">Vestibulum vitae diam nec odio dapibus placerat. Ut ut lorem justo.</h4>
											Fusce bibendum augue nec fermentum tempus. Sed laoreet dictum tempus. Aenean ac sem quis nulla malesuada volutpat. Nunc vitae urna pulvinar velit commodo cursus. Nullam eu felis quis diam adipiscing hendrerit vel ac turpis. Nam mattis fringilla euismod. Donec eu ipsum sit amet mauris iaculis aliquet. Quisque sit amet feugiat odio. Cras convallis lorem at libero lobortis, placerat lobortis sapien lacinia. Duis sit amet elit bibendum sapien dignissim bibendum.
										</div>
									</li>
									<li class="media media-lg">
										<a href="javascript:;" class="pull-left">
											<img class="media-object" src="assets/img/gallery/gallery-7.jpg" alt="" />
										</a>
										<div class="media-body">
											<h4 class="media-heading">Maecenas eget turpis luctus, scelerisque arcu id, iaculis urna. Interdum et malesuada fames ac ante ipsum primis in faucibus.</h4>
											Morbi placerat est nec pharetra placerat. Ut laoreet nunc accumsan orci aliquam accumsan. Maecenas volutpat dolor vitae sapien ultricies fringilla. Suspendisse vitae orci sed nibh ultrices tristique. Aenean in ante eget urna semper imperdiet. Pellentesque sagittis a nulla at scelerisque. Nam augue nulla, accumsan quis nisi a, facilisis eleifend nulla. Praesent aliquet odio non imperdiet fringilla. Morbi a porta nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.
										</div>
									</li>
									<li class="media media-lg">
										<a href="javascript:;" class="pull-left">
											<img class="media-object" src="assets/img/gallery/gallery-8.jpg" alt="" />
										</a>
										<div class="media-body">
											<h4 class="media-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor accumsan rutrum.</h4>
											Fusce augue diam, vestibulum a mattis sit amet, vehicula eu ipsum. Vestibulum eu mi nec purus tempor consequat. Vestibulum porta non mi quis cursus. Fusce vulputate cursus magna, tincidunt sodales ipsum lobortis tincidunt. Mauris quis lorem ligula. Morbi placerat est nec pharetra placerat. Ut laoreet nunc accumsan orci aliquam accumsan. Maecenas volutpat dolor vitae sapien ultricies fringilla. Suspendisse vitae orci sed nibh ultrices tristique. Aenean in ante eget urna semper imperdiet. Pellentesque sagittis a nulla at scelerisque.
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="tab-pane fade" id="purchase">
							<div class="height-sm" data-scrollbar="true">
								<table class="table">
									<thead>
										<tr>
											<th>Date</th>
											<th class="hidden-sm">Product</th>
											<th>Amount</th>
											<th>User</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>13/02/2013</td>
											<td class="hidden-sm">
												<a href="javascript:;">
													<img src="assets/img/product/product-1.png" alt=""  />
												</a>
											</td>
											<td>
												<h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
											</td>
											<td>$349.00</td>
											<td><a href="javascript:;">Derick Wong</a></td>
										</tr>
										<tr>
											<td>13/02/2013</td>
											<td class="hidden-sm">
												<a href="javascript:;">
													<img src="assets/img/product/product-2.png" alt="" />
												</a>
											</td>
											<td>
												<h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
											</td>
											<td>$399.00</td>
											<td><a href="javascript:;">Derick Wong</a></td>
										</tr>
										<tr>
											<td>13/02/2013</td>
											<td class="hidden-sm">
												<a href="javascript:;">
													<img src="assets/img/product/product-3.png" alt="" />
												</a>
											</td>
											<td>
												<h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
											</td>
											<td>$499.00</td>
											<td><a href="javascript:;">Derick Wong</a></td>
										</tr>
										<tr>
											<td>13/02/2013</td>
											<td class="hidden-sm">
												<a href="javascript:;">
													<img src="assets/img/product/product-4.png" alt="" />
												</a>
											</td>
											<td>
												<h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
											</td>
											<td>$230.00</td>
											<td><a href="javascript:;">Derick Wong</a></td>
										</tr>
										<tr>
											<td>13/02/2013</td>
											<td class="hidden-tablet hidden-phone">
												<a href="javascript:;">
													<img src="assets/img/product/product-5.png" alt="" />
												</a>
											</td>
											<td>
												<h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
											</td>
											<td>$500.00</td>
											<td><a href="javascript:;">Derick Wong</a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="email">
							<div class="height-sm" data-scrollbar="true">
								<ul class="media-list media-list-with-divider">
									<li class="media media-sm">
										<a href="javascript:;" class="pull-left">
											<img src="assets/img/user-1.jpg" alt="" class="media-object rounded-corner" />
										</a>
										<div class="media-body">
											<a href="javascript:;"><h4 class="media-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4></a>
											<p class="m-b-5">
												Aenean mollis arcu sed turpis accumsan dignissim. Etiam vel tortor at risus tristique convallis. Donec adipiscing euismod arcu id euismod. Suspendisse potenti. Aliquam lacinia sapien ac urna placerat, eu interdum mauris viverra.
											</p>
											<i class="text-muted">Received on 04/16/2013, 12.39pm</i>
										</div>
									</li>
									<li class="media media-sm">
										<a href="javascript:;" class="pull-left">
											<img src="assets/img/user-2.jpg" alt="" class="media-object rounded-corner" />
										</a>
										<div class="media-body">
											<a href="javascript:;"><h4 class="media-heading">Praesent et sem porta leo tempus tincidunt eleifend et arcu.</h4></a>
											<p class="m-b-5">
												Proin adipiscing dui nulla. Duis pharetra vel sem ac adipiscing. Vestibulum ut porta leo. Pellentesque orci neque, tempor ornare purus nec, fringilla venenatis elit. Duis at est non nisl dapibus lacinia.
											</p>
											<i class="text-muted">Received on 04/16/2013, 12.39pm</i>
										</div>
									</li>
									<li class="media media-sm">
										<a href="javascript:;" class="pull-left">
											<img src="assets/img/user-3.jpg" alt="" class="media-object rounded-corner" />
										</a>
										<div class="media-body">
											<a href="javascript:;"><h4 class="media-heading">Ut mi eros, varius nec mi vel, consectetur convallis diam.</h4></a>
											<p class="m-b-5">
												Ut mi eros, varius nec mi vel, consectetur convallis diam. Nullam eget hendrerit eros. Duis lacinia condimentum justo at ultrices. Phasellus sapien arcu, fringilla eu pulvinar id, mattis quis mauris.
											</p>
											<i class="text-muted">Received on 04/16/2013, 12.39pm</i>
										</div>
									</li>
									<li class="media media-sm">
										<a href="javascript:;" class="pull-left">
											<img src="assets/img/user-4.jpg" alt="" class="media-object rounded-corner" />
										</a>
										<div class="media-body">
											<a href="javascript:;"><h4 class="media-heading">Aliquam nec dolor vel nisl dictum ullamcorper.</h4></a>
											<p class="m-b-5">
												Aliquam nec dolor vel nisl dictum ullamcorper. Duis vel magna enim. Aenean volutpat a dui vitae pulvinar. Nullam ligula mauris, dictum eu ullamcorper quis, lacinia nec mauris.
											</p>
											<i class="text-muted">Received on 04/16/2013, 12.39pm</i>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="panel panel-inverse" data-sortable-id="index-4">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Quick Post</h4>
                        </div>
                        <div class="panel-toolbar">
                            <div class="btn-group m-r-5">
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-bold"></i></a>
								<a class="btn btn-white active" href="javascript:;"><i class="fa fa-italic"></i></a>
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-underline"></i></a>
							</div>
                            <div class="btn-group">
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-align-left"></i></a>
								<a class="btn btn-white active" href="javascript:;"><i class="fa fa-align-center"></i></a>
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-align-right"></i></a>
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-align-justify"></i></a>
							</div>
                        </div>
                        <textarea class="form-control no-rounded-corner bg-silver" rows="14">Enter some comment.</textarea>
                        <div class="panel-footer text-right">
                            <a href="javascript:;" class="btn btn-white btn-sm">Cancel</a>
                            <a href="javascript:;" class="btn btn-primary btn-sm m-l-5">Action</a>
                        </div>
                    </div>
                    
					<div class="panel panel-inverse" data-sortable-id="index-5">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Message</h4>
						</div>
						<div class="panel-body">
							<div class="height-sm" data-scrollbar="true">
								<ul class="media-list media-list-with-divider media-messaging">
									<li class="media media-sm">
										<a href="javascript:;" class="pull-left">
											<img src="assets/img/user-5.jpg" alt="" class="media-object rounded-corner" />
										</a>
										<div class="media-body">
											<h5 class="media-heading">John Doe</h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id nunc non eros fermentum vestibulum ut id felis. Nunc molestie libero eget urna aliquet, vitae laoreet felis ultricies. Fusce sit amet massa malesuada, tincidunt augue vitae, gravida felis.</p>
										</div>
									</li>
									<li class="media media-sm">
										<a href="javascript:;" class="pull-left">
											<img src="assets/img/user-6.jpg" alt="" class="media-object rounded-corner" />
										</a>
										<div class="media-body">
											<h5 class="media-heading">Terry Ng</h5>
											<p>Sed in ante vel ipsum tristique euismod posuere eget nulla. Quisque ante sem, scelerisque iaculis interdum quis, eleifend id mi. Fusce congue leo nec mauris malesuada, id scelerisque sapien ultricies.</p>
										</div>
									</li>
									<li class="media media-sm">
										<a href="javascript:;" class="pull-left">
											<img src="assets/img/user-8.jpg" alt="" class="media-object rounded-corner" />
										</a>
										<div class="media-body">
											<h5 class="media-heading">Fiona Log</h5>
											<p>Pellentesque dictum in tortor ac blandit. Nulla rutrum eu leo vulputate ornare. Nulla a semper mi, ac lacinia sapien. Sed volutpat ornare eros, vel semper sem sagittis in. Quisque risus ipsum, iaculis quis cursus eu, tristique sed nulla.</p>
										</div>
									</li>
									<li class="media media-sm">
										<a href="javascript:;" class="pull-left">
											<img src="assets/img/user-7.jpg" alt="" class="media-object rounded-corner" />
										</a>
										<div class="media-body">
											<h5 class="media-heading">John Doe</h5>
											<p>Morbi molestie lorem quis accumsan elementum. Morbi condimentum nisl iaculis, laoreet risus sed, porta neque. Proin mi leo, dapibus at ligula a, aliquam consectetur metus.</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="panel-footer">
							<form>
								<div class="input-group">
									<input type="text" class="form-control bg-silver" placeholder="Enter message" />
									<span class="input-group-btn">
										<button class="btn btn-primary" type="button"><i class="fa fa-pencil"></i></button>
									</span>
								</div>
							</form>
                        </div>
					</div>
				</div>
				<!-- end col-8 -->
				<!-- begin col-4 -->
				<div class="col-md-4">
					<div class="panel panel-inverse" data-sortable-id="index-6">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Analytics Details</h4>
						</div>
						<div class="panel-body p-t-0">
							<table class="table table-valign-middle m-b-0">
								<thead>
									<tr>	
										<th>Source</th>
										<th>Total</th>
										<th>Trend</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><label class="label label-danger">Unique Visitor</label></td>
										<td>13,203 <span class="text-success"><i class="fa fa-arrow-up"></i></span></td>
										<td><div id="sparkline-unique-visitor"></div></td>
									</tr>
									<tr>
										<td><label class="label label-warning">Bounce Rate</label></td>
										<td>28.2%</td>
										<td><div id="sparkline-bounce-rate"></div></td>
									</tr>
									<tr>
										<td><label class="label label-success">Total Page Views</label></td>
										<td>1,230,030</td>
										<td><div id="sparkline-total-page-views"></div></td>
									</tr>
									<tr>
										<td><label class="label label-primary">Avg Time On Site</label></td>
										<td>00:03:45</td>
										<td><div id="sparkline-avg-time-on-site"></div></td>
									</tr>
									<tr>
										<td><label class="label label-default">% New Visits</label></td>
										<td>40.5%</td>
										<td><div id="sparkline-new-visits"></div></td>
									</tr>
									<tr>
										<td><label class="label label-inverse">Return Visitors</label></td>
										<td>73.4%</td>
										<td><div id="sparkline-return-visitors"></div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="panel panel-inverse" data-sortable-id="index-7">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Visitors User Agent</h4>
						</div>
						<div class="panel-body">
							<div id="donut-chart" class="height-sm"></div>
						</div>
					</div>
					
					<div class="panel panel-inverse" data-sortable-id="index-8">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Todo List</h4>
						</div>
						<div class="panel-body p-0">
							<ul class="todolist">
								<li class="active">
									<a href="javascript:;" class="todolist-container active" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Donec vehicula pretium nisl, id lacinia nisl tincidunt id.</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Duis a ullamcorper massa.</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Phasellus bibendum, odio nec vestibulum ullamcorper.</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Duis pharetra mi sit amet dictum congue.</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Duis pharetra mi sit amet dictum congue.</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Phasellus bibendum, odio nec vestibulum ullamcorper.</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container active" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Donec vehicula pretium nisl, id lacinia nisl tincidunt id.</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
					
					<div class="panel panel-inverse" data-sortable-id="index-9">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">World Visitors</h4>
						</div>
						<div class="panel-body p-0">
							<div id="world-map" class="height-sm width-full"></div>
						</div>
					</div>
					
					<div class="panel panel-inverse" data-sortable-id="index-10">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Calendar</h4>
						</div>
						<div class="panel-body">
							<div id="datepicker-inline" class="datepicker-full-width"><div></div></div>
						</div>
					</div>
				</div>
				<!-- end col-4 -->
                                <table width="100%" align="center"class='rounded-corners'>
    <tr>
         <td width="22%"></td>
        <td colspan="2"style="background-color: white;color: white;">
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
            title: "<?php echo 'Last Month Performance - ' . $month_name . ' , ' . $year_name ;?>",
            subtitle: 'Operating Cost, Salary Expenses and EPKM',
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
        </td>
    </tr>
    <tr>
         <td width="2%"></td>
        <td colspan="2"style="background-color: white;color: white;"></td>
    </tr>
    <tr>
         <td width="2%"></td>
        <td witdh='50%'align='center'style="background-color: white;color: white;">
           <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
      
                function drawChart()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'CATEGORY');
                        data.addColumn('number', 'NUMBERS');
                        data.addRows(<?php echo json_encode($pieData, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'INVENTORY CLASIFICATION (Rs. in Lakh)',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data,options);
                    }
            </script>
            <div id="donutchart" style="border: 1px solid #ccc"></div>
        </td>
        <td witdh='50%'align='center'style="background-color: white;color: white;">
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
                    title: 'SPARE-OEM CLASSIFICATION (No. OF ITEM)',
                     pieHole: 0.3, width:500,height:325
                 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart1'));
                        chart.draw(data,options);
                          
                }
            </script>
            <div id="donutchart1" style="border: 1px solid #ccc"></div>
        </td>
    </tr>
    <tr>
         <td width="2%"></td>
        <td witdh='50%'align='center'style="background-color: white;color: white;">
           <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart2);
      
                function drawChart2()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'UNIT');
                        data.addColumn('number', 'VALUE');
                        data.addRows(<?php echo json_encode($pieData5, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'SPARES ISSUE in Lakh (LAST ONE YEAR)',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart5'));
                        chart.draw(data,options);
                    }
            </script>
            <div id="donutchart5" style="border: 1px solid #ccc"></div>
        </td>
        <td witdh='50%'align='center'style="background-color: white;color: white;">
           <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart3);
      
                function drawChart3()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'UNIT');
                        data.addColumn('number', 'VALUE');
                        data.addRows(<?php echo json_encode($pieData6, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'K.M. COVERED (LAST ONE YEAR)',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart6'));
                        
    var formatter = new google.visualization.NumberFormat(
    {prefix: '$', negativeColor: 'red', negativeParens: true});
formatter.format(data, 0); // Apply formatter to second column
    
    
    
    chart.draw(data,options);
                    }
            </script>
            <div id="donutchart6" style="border: 1px solid #ccc"></div>
        </td>
    </tr>
    <tr>
         <td width="2%"></td>
         <td witdh='50%'align='center'style="background-color: white;color: white;">
           <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart8);
      
                function drawChart8()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'DEPOT');
                        data.addColumn('number', 'HSD CONSUMED');
                        data.addRows(<?php echo json_encode($pieData8, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'HSD CONSUMPTION (DEPOT WISE)(K.L.) (LAST ONE YEAR)',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart8'));
                        chart.draw(data,options);
                    }
            </script>
            <div id="donutchart8" style="border: 1px solid #ccc"></div>
        </td>  
    
        <td witdh='50%'align='center'style="background-color: white;color: white;">
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
                    title: 'HSD CONSUMPTION (SERVICE TYPE WISE)(LAST ONE YEAR)',
                     pieHole: 0.3, width:500,height:325
                 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart9'));
                        chart.draw(data,options);
                          
                }
            </script>
            <div id="donutchart9" style="border: 1px solid #ccc"></div>
        </td>
        
        
    </tr>
    
    <tr>
         <td width="2%"></td>
        <td witdh='50%'align='center'style="background-color: white;color: white;">
           <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart10);
      
                function drawChart10()
                    {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'DEPOT');
                        data.addColumn('number', 'REVENUE');
                        data.addRows(<?php echo json_encode($pieData10, JSON_NUMERIC_CHECK); ?>);

                        var options = {'title':'REVENUE (DEPOT WISE)(LAKH) (LAST ONE YEAR)',
                        pieHole: 0.3, width:500,height:325 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart10'));
                        chart.draw(data,options);
                    }
            </script>
            <div id="donutchart10" style="border: 1px solid #ccc"></div>
        </td>  
        
        <td witdh='50%'align='center'style="background-color: white;color: white;">
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart11);
      
                function drawChart11() {

                var data = google.visualization.arrayToDataTable([
                ['SERVICE TYPE', 'REVENUE'],
                ['VOLVO', <?php echo $sale_volvo ; ?>],
                ['LEYLAND AC',  <?php echo $sale_alac ; ?>],
                ['NON-AC BS-IV',  <?php echo $sale_nac_bs4 ; ?>],
                ['OTHER',  <?php echo $sale_other ; ?>]
               
               
                ]);
                 var options = {
                    title: 'REVENUE (SERVICE TYPE WISE)(LAST ONE YEAR)',
                     pieHole: 0.3, width:500,height:325
                 };
                        var chart=new google.visualization.PieChart(document.getElementById('donutchart11'));
                        chart.draw(data,options);
                          
                }
            </script>
            <div id="donutchart11" style="border: 1px solid #ccc"></div>
        </td>
        
        
    </tr>
   
</table>

			</div>
			<!-- end row -->
                        
		</div>
