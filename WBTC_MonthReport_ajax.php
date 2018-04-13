<?php
require_once('Connections/cstccon.php');


error_reporting(E_ERROR|E_WARNING);
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=depot-perfo.xls");



$mth1 = $_POST['mth1'];
$mth2 = $_POST['mth2'];
$yr1 = $_POST['yr1'];
$yr2 = $_POST['yr2'];
$mth1 = $yr1 . $mth1;
$mth2 = $yr2 . $mth2;
// for april 2015 only
//$mth1 = '1505';
//$mth2 = '1504';

$query27 = "SELECT * FROM cstcmis.out_maint_rate where mth  = '" . $mth1 . "'";
$result27 = mysqli_query($cstccon,$query27) or die(mysqli_error());
$row27 = mysqli_fetch_assoc($result27);
$mth1_heavy_maint_rate = $row27['heavy_maint'];
$mth1_daily_tech_maint_rate = $row27['daily_tech_maint'];
$mth1_non_tech_maint_ac_rate = $row27['non_tech_maint_ac'];
$mth1_non_tech_maint_nac_rate = $row27['non_tech_maint_nac'];

$query28 = "SELECT * FROM cstcmis.out_maint_rate where mth  = '" . $mth2 . "'";
$result28 = mysqli_query($cstccon,$query28) or die(mysqli_error());
$row28 = mysqli_fetch_assoc($result28);
$mth2_heavy_maint_rate = $row28['heavy_maint'];
$mth2_daily_tech_maint_rate = $row28['daily_tech_maint'];
$mth2_non_tech_maint_ac_rate = $row28['non_tech_maint_ac'];
$mth2_non_tech_maint_nac_rate = $row28['non_tech_maint_nac'];

$query2 = "SELECT * FROM cstcmis.item_rate where item = 'hsd' and mth  = '" . $mth1 . "'";
$result2 = mysqli_query($cstccon,$query2) or die(mysqli_error());
$row2 = mysqli_fetch_assoc($result2);
$hsd_rate_mth1 = $row2['rate'];

$query3 = "SELECT * FROM cstcmis.item_rate where item = 'hsd' and mth  = '" . $mth2 . "'";
$result3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
$row3 = mysqli_fetch_assoc($result3);
$hsd_rate_mth2 = $row3['rate'];

    $query1 = "SELECT * FROM cstcmis.month_data where mth in( '" . $mth1 . "','" . $mth2 . "') order by unit";
    $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
   // $row1 = mysqli_fetch_assoc($Result1";
  // echo "kolkata'; 
    
     while($row1 = mysqli_fetch_assoc($result1))  {
         if($row1['unit'] == 'BD'){
             if($row1['mth'] == $mth1 ) {
                 $bd_mth1_fleet_ac = $row1['fleet_ac'];
                 $bd_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $bd_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $bd_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $bd_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $bd_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $bd_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $bd_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $bd_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $bd_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $bd_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $bd_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $bd_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $bd_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $bd_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $bd_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $bd_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $bd_mth1_sch_trip_tot = $bd_mth1_sch_trip_ac + $bd_mth1_sch_trip_nac_new + $bd_mth1_sch_trip_nac_old ;
                 $bd_mth1_act_trip_tot = $bd_mth1_act_trip_ac + $bd_mth1_act_trip_nac_new + $bd_mth1_act_trip_nac_old ;
                 $bd_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $bd_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000 ;
                 $bd_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000 ;
                 $bd_mth1_km_tot = $bd_mth1_km_ac + $bd_mth1_km_nac_old + $bd_mth1_km_nac_new;
                 $bd_mth1_hsd_ac = $row1['hsd_ac'];
                 $bd_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $bd_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $bd_mth1_hsd_tot = $bd_mth1_hsd_ac + $bd_mth1_hsd_nac_old + $bd_mth1_hsd_nac_new;
                 $bd_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $bd_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $bd_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $bd_mth1_sale_1st_tot = $bd_mth1_sale_1st_ac + $bd_mth1_sale_1st_nac_new + $bd_mth1_sale_1st_nac_old;
                 $bd_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $bd_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $bd_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $bd_mth1_sale_2nd_tot = $bd_mth1_sale_2nd_ac + $bd_mth1_sale_2nd_nac_new + $bd_mth1_sale_2nd_nac_old;
                 
                 $bd_mth1_sale_tot_ac = $bd_mth1_sale_1st_ac + $bd_mth1_sale_2nd_ac;
                 $bd_mth1_sale_tot_nac_new = $bd_mth1_sale_1st_nac_new + $bd_mth1_sale_2nd_nac_new;
                 $bd_mth1_sale_tot_nac_old = $bd_mth1_sale_1st_nac_old + $bd_mth1_sale_2nd_nac_old;
                 
                 
                 $bd_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;;
                    // $bd_mth1_sch_trip_tot = $bd_mth1_sch_trip_ac + $bd_mth1_sch_trip_nac_new + $bd_mth1_sch_trip_nac_old;
                // $bd_mth1_act_trip_tot = $bd_mth1_act_trip_ac + $bd_mth1_act_trip_nac_new + $bd_mth1_act_trip_nac_old;
              
                 $bd_mth1_cost_tot =  $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $bd_mth1_cost_tot_without_hsd =  $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $bd_mth1_opr_cost_tot_without_hsd =  $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $bd_mth1_opr_cost_tot = $bd_mth1_cost_tot - $row1['sal'];
                 $bd_mth1_opr_cost_ac = $bd_mth1_opr_cost_tot_without_hsd * ($bd_mth1_km_ac / $bd_mth1_km_tot) + $hsd_rate_mth1 * $bd_mth1_hsd_ac ;
                 $bd_mth1_opr_cost_nac_new = $bd_mth1_opr_cost_tot_without_hsd * ($bd_mth1_km_nac_new / $bd_mth1_km_tot) + $hsd_rate_mth1 * $bd_mth1_hsd_nac_new ;
                 $bd_mth1_opr_cost_nac_old = $bd_mth1_opr_cost_tot_without_hsd * ($bd_mth1_km_nac_old / $bd_mth1_km_tot) + $hsd_rate_mth1 * $bd_mth1_hsd_nac_old ;
				 $bd_mth1_cost_ac = $bd_mth1_opr_cost_ac + $row1['sal'] * ($bd_mth1_km_ac / $bd_mth1_km_tot);
				 $bd_mth1_cost_nac_new = $bd_mth1_opr_cost_nac_new + $row1['sal'] * ($bd_mth1_km_nac_new / $bd_mth1_km_tot);
				 $bd_mth1_cost_nac_old = $bd_mth1_opr_cost_nac_old + $row1['sal'] * ($bd_mth1_km_nac_old / $bd_mth1_km_tot);
				 $bd_mth1_officer = $row1['officer'];
				 $bd_mth1_admin = $row1['admin'];
				 $bd_mth1_security = $row1['security'];
				 $bd_mth1_cash = $row1['cash'];
				 $bd_mth1_traffic = $row1['traffic'];
				 $bd_mth1_comp = $row1['comp'];
				 $bd_mth1_engg = $row1['engg'];
				 $bd_mth1_driver = $row1['driver'];
				 $bd_mth1_driver_cont = $row1['driver_cont'];
				 $bd_mth1_conductor = $row1['conductor'];
				 $bd_mth1_conductor_cont = $row1['conductor_cont'];
				
				 
                                 
                                 
				 
				 $bd_mth1_sal = $row1['sal'] / 100000;
				 $bd_mth1_ot = $row1['ot'] / 100000;
				 $bd_mth1_incen = $row1['incen'] / 100000;
				 $bd_mth1_store = $row1['store'] / 100000;
				 $bd_mth1_local = $row1['local'] / 100000;
				 $bd_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $bd_mth1_hsd_od = $row1['hsd_od'];
                                 
                                 $bd_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $bd_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                 $bd_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $bd_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;
                                 
                                 $bd_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $bd_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $bd_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $bd_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $bd_mth1_maint = $bd_mth1_heavy_maint + $bd_mth1_daily_tech_maint + $bd_mth1_non_tech_maint_ac + $bd_mth1_non_tech_maint_nac;
                                
                                 $bd_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $bd_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $bd_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $bd_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                
                                 $bd_mth1_running = $row1['running'];
                                 $bd_mth1_heldup = $row1['heldup'];
                                 }  
              if($row1['mth'] == $mth2 ) {
                 $bd_mth2_fleet_ac = $row1['fleet_ac'];
                 $bd_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $bd_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $bd_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $bd_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $bd_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $bd_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $bd_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $bd_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $bd_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $bd_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $bd_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $bd_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $bd_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $bd_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $bd_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $bd_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $bd_mth2_sch_trip_tot = $bd_mth2_sch_trip_ac + $bd_mth2_sch_trip_nac_new + $bd_mth2_sch_trip_nac_old ;
                 $bd_mth2_act_trip_tot = $bd_mth2_act_trip_ac + $bd_mth2_act_trip_nac_new + $bd_mth2_act_trip_nac_old ;
                 $bd_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $bd_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $bd_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $bd_mth2_km_tot = $bd_mth2_km_ac + $bd_mth2_km_nac_old + $bd_mth2_km_nac_new;
                 $bd_mth2_hsd_ac = $row1['hsd_ac'];
                 $bd_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $bd_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $bd_mth2_hsd_tot = $bd_mth2_hsd_ac + $bd_mth2_hsd_nac_old + $bd_mth2_hsd_nac_new;
                 
                 $bd_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $bd_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $bd_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $bd_mth2_sale_1st_tot = $bd_mth2_sale_1st_ac + $bd_mth2_sale_1st_nac_new + $bd_mth2_sale_1st_nac_old;
                 $bd_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $bd_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $bd_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $bd_mth2_sale_2nd_tot = $bd_mth2_sale_2nd_ac + $bd_mth2_sale_2nd_nac_new + $bd_mth2_sale_2nd_nac_old;
                 
                 $bd_mth2_sale_tot_ac = $bd_mth2_sale_1st_ac + $bd_mth2_sale_2nd_ac;
                 $bd_mth2_sale_tot_nac_new = $bd_mth2_sale_1st_nac_new + $bd_mth2_sale_2nd_nac_new;
                 $bd_mth2_sale_tot_nac_old = $bd_mth2_sale_1st_nac_old + $bd_mth2_sale_2nd_nac_old;
                 
                 
                 $bd_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
                 
                 $bd_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $bd_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $bd_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $bd_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $bd_mth2_maint = $bd_mth2_heavy_maint + $bd_mth2_daily_tech_maint + $bd_mth2_non_tech_maint_ac + $bd_mth2_non_tech_maint_nac;

                 
                 
				 
				 $bd_mth2_cost_tot = $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $bd_mth2_cost_tot_without_hsd = $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate ;
				 $bd_mth2_opr_cost_tot_without_hsd = $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate;
                
                 $bd_mth2_opr_cost_tot = $bd_mth2_cost_tot - $row1['sal'];
                 $bd_mth2_opr_cost_ac = $bd_mth2_opr_cost_tot_without_hsd * ($bd_mth2_km_ac / $bd_mth2_km_tot) + $hsd_rate_mth2 * $bd_mth2_hsd_ac ;
                 $bd_mth2_opr_cost_nac_new = $bd_mth2_opr_cost_tot_without_hsd * ($bd_mth2_km_nac_new / $bd_mth2_km_tot) + $hsd_rate_mth2 * $bd_mth2_hsd_nac_new ;
                 $bd_mth2_opr_cost_nac_old = $bd_mth2_opr_cost_tot_without_hsd * ($bd_mth2_km_nac_old / $bd_mth2_km_tot) + $hsd_rate_mth2 * $bd_mth2_hsd_nac_old ;
				 $bd_mth2_cost_ac = $bd_mth2_opr_cost_ac + $row1['sal'] * ($bd_mth2_km_ac / $bd_mth2_km_tot);
				 $bd_mth2_cost_nac_new = $bd_mth2_opr_cost_nac_new + $row1['sal'] * ($bd_mth2_km_nac_new / $bd_mth2_km_tot);
				 $bd_mth2_cost_nac_old = $bd_mth2_opr_cost_nac_old + $row1['sal'] * ($bd_mth2_km_nac_old / $bd_mth2_km_tot);
                 $bd_mth2_officer = $row1['officer'];
				 $bd_mth2_admin = $row1['admin'];
				 $bd_mth2_security = $row1['security'];
				 $bd_mth2_cash = $row1['cash'];
				 $bd_mth2_traffic = $row1['traffic'];
				 $bd_mth2_comp = $row1['comp'];
				 $bd_mth2_engg = $row1['engg'];
				 $bd_mth2_driver = $row1['driver'];
				 $bd_mth2_driver_cont = $row1['driver_cont'];
				 $bd_mth2_conductor = $row1['conductor'];
				 $bd_mth2_conductor_cont = $row1['conductor_cont'];
				 
				 
				 
				 $bd_mth2_sal = $row1['sal'] / 100000;
				 $bd_mth2_ot = $row1['ot'] / 100000;
				 $bd_mth2_incen = $row1['incen'] / 100000;
				 $bd_mth2_store = $row1['store'] / 100000;
				 $bd_mth2_local = $row1['local'] / 100000;
				 $bd_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $bd_mth2_hsd_od = $row1['hsd_od'];
                                 $bd_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $bd_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                 $bd_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $bd_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;
                                  $bd_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $bd_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $bd_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $bd_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 
                                 $bd_mth2_running = $row1['running'];
                                 $bd_mth2_heldup = $row1['heldup'];
                                             }   
         }
         if($row1['unit'] == 'ND'){
             if($row1['mth'] == $mth1 ) {
                 $nd_mth1_fleet_ac = $row1['fleet_ac'];
                 $nd_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $nd_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $nd_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $nd_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $nd_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $nd_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $nd_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $nd_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $nd_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $nd_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $nd_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $nd_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $nd_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $nd_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $nd_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $nd_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $nd_mth1_sch_trip_tot = $nd_mth1_sch_trip_ac + $nd_mth1_sch_trip_nac_new + $nd_mth1_sch_trip_nac_old ;
                 $nd_mth1_act_trip_tot = $nd_mth1_act_trip_ac + $nd_mth1_act_trip_nac_new + $nd_mth1_act_trip_nac_old ;
                 $nd_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $nd_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000 ;
                 $nd_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000 ;
                 $nd_mth1_km_tot = $nd_mth1_km_ac + $nd_mth1_km_nac_old + $nd_mth1_km_nac_new;
                 $nd_mth1_hsd_ac = $row1['hsd_ac'];
                 $nd_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $nd_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $nd_mth1_hsd_tot = $nd_mth1_hsd_ac + $nd_mth1_hsd_nac_old + $nd_mth1_hsd_nac_new;
                 $nd_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $nd_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $nd_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $nd_mth1_sale_1st_tot = $nd_mth1_sale_1st_ac + $nd_mth1_sale_1st_nac_new + $nd_mth1_sale_1st_nac_old;
                 $nd_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $nd_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $nd_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $nd_mth1_sale_2nd_tot = $nd_mth1_sale_2nd_ac + $nd_mth1_sale_2nd_nac_new + $nd_mth1_sale_2nd_nac_old;
                 
                 $nd_mth1_sale_tot_ac = $nd_mth1_sale_1st_ac + $nd_mth1_sale_2nd_ac;
                 $nd_mth1_sale_tot_nac_new = $nd_mth1_sale_1st_nac_new + $nd_mth1_sale_2nd_nac_new;
                 $nd_mth1_sale_tot_nac_old = $nd_mth1_sale_1st_nac_old + $nd_mth1_sale_2nd_nac_old;
                 
                 $nd_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
                    // $nd_mth1_sch_trip_tot = $nd_mth1_sch_trip_ac + $nd_mth1_sch_trip_nac_new + $nd_mth1_sch_trip_nac_old;
                // $nd_mth1_act_trip_tot = $nd_mth1_act_trip_ac + $nd_mth1_act_trip_nac_new + $nd_mth1_act_trip_nac_old;
              
                 $nd_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $nd_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $nd_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $nd_mth1_opr_cost_tot = $nd_mth1_cost_tot - $row1['sal'];
                 $nd_mth1_opr_cost_ac = $nd_mth1_opr_cost_tot_without_hsd * ($nd_mth1_km_ac / $nd_mth1_km_tot) + $hsd_rate_mth1 * $nd_mth1_hsd_ac ;
                 $nd_mth1_opr_cost_nac_new = $nd_mth1_opr_cost_tot_without_hsd * ($nd_mth1_km_nac_new / $nd_mth1_km_tot) + $hsd_rate_mth1 * $nd_mth1_hsd_nac_new ;
                 $nd_mth1_opr_cost_nac_old = $nd_mth1_opr_cost_tot_without_hsd * ($nd_mth1_km_nac_old / $nd_mth1_km_tot) + $hsd_rate_mth1 * $nd_mth1_hsd_nac_old ;
				 $nd_mth1_cost_ac = $nd_mth1_opr_cost_ac + $row1['sal'] * ($nd_mth1_km_ac / $nd_mth1_km_tot);
				 $nd_mth1_cost_nac_new = $nd_mth1_opr_cost_nac_new + $row1['sal'] * ($nd_mth1_km_nac_new / $nd_mth1_km_tot);
				 $nd_mth1_cost_nac_old = $nd_mth1_opr_cost_nac_old + $row1['sal'] * ($nd_mth1_km_nac_old / $nd_mth1_km_tot);
				 $nd_mth1_officer = $row1['officer'];
				 $nd_mth1_admin = $row1['admin'];
				 $nd_mth1_security = $row1['security'];
				 $nd_mth1_cash = $row1['cash'];
				 $nd_mth1_traffic = $row1['traffic'];
				 $nd_mth1_comp = $row1['comp'];
				 $nd_mth1_engg = $row1['engg'];
				 $nd_mth1_driver = $row1['driver'];
				 $nd_mth1_driver_cont = $row1['driver_cont'];
				 $nd_mth1_conductor = $row1['conductor'];
				 $nd_mth1_conductor_cont = $row1['conductor_cont'];
				
				 
				 
				 $nd_mth1_sal = $row1['sal'] / 100000;
				 $nd_mth1_ot = $row1['ot'] / 100000;
				 $nd_mth1_incen = $row1['incen'] / 100000;
				 $nd_mth1_store = $row1['store'] / 100000;
				 $nd_mth1_local = $row1['local'] / 100000;
				 $nd_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $nd_mth1_hsd_od = $row1['hsd_od'];
                                 $nd_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $nd_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                 $nd_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $nd_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $nd_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $nd_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $nd_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $nd_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $nd_mth1_maint = $nd_mth1_heavy_maint + $nd_mth1_daily_tech_maint + $nd_mth1_non_tech_maint_ac + $nd_mth1_non_tech_maint_nac;
                                  $nd_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $nd_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $nd_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $nd_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $nd_mth1_running = $row1['running'];
                                 $nd_mth1_heldup = $row1['heldup'];
             }  
              if($row1['mth'] == $mth2 ) {
                 $nd_mth2_fleet_ac = $row1['fleet_ac'];
                 $nd_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $nd_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $nd_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $nd_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $nd_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $nd_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $nd_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $nd_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $nd_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $nd_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $nd_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $nd_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $nd_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $nd_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $nd_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $nd_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $nd_mth2_sch_trip_tot = $nd_mth2_sch_trip_ac + $nd_mth2_sch_trip_nac_new + $nd_mth2_sch_trip_nac_old ;
                 $nd_mth2_act_trip_tot = $nd_mth2_act_trip_ac + $nd_mth2_act_trip_nac_new + $nd_mth2_act_trip_nac_old ;
                 $nd_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $nd_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $nd_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $nd_mth2_km_tot = $nd_mth2_km_ac + $nd_mth2_km_nac_old + $nd_mth2_km_nac_new;
                 $nd_mth2_hsd_ac = $row1['hsd_ac'];
                 $nd_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $nd_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $nd_mth2_hsd_tot = $nd_mth2_hsd_ac + $nd_mth2_hsd_nac_old + $nd_mth2_hsd_nac_new;
                 $nd_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $nd_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $nd_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $nd_mth2_sale_1st_tot = $nd_mth2_sale_1st_ac + $nd_mth2_sale_1st_nac_new + $nd_mth2_sale_1st_nac_old;
                 $nd_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $nd_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $nd_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $nd_mth2_sale_2nd_tot = $nd_mth2_sale_2nd_ac + $nd_mth2_sale_2nd_nac_new + $nd_mth2_sale_2nd_nac_old;
                 
                 $nd_mth2_sale_tot_ac = $nd_mth2_sale_1st_ac + $nd_mth2_sale_2nd_ac;
                 $nd_mth2_sale_tot_nac_new = $nd_mth2_sale_1st_nac_new + $nd_mth2_sale_2nd_nac_new;
                 $nd_mth2_sale_tot_nac_old = $nd_mth2_sale_1st_nac_old + $nd_mth2_sale_2nd_nac_old;
                 $nd_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				 $nd_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $nd_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
				 $nd_mth2_opr_cost_tot_without_hsd = $row2['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                
                 $nd_mth2_opr_cost_tot = $nd_mth2_cost_tot - $row1['sal'];
                 $nd_mth2_opr_cost_ac = $nd_mth2_opr_cost_tot_without_hsd * ($nd_mth2_km_ac / $nd_mth2_km_tot) + $hsd_rate_mth2 * $nd_mth2_hsd_ac ;
                 $nd_mth2_opr_cost_nac_new = $nd_mth2_opr_cost_tot_without_hsd * ($nd_mth2_km_nac_new / $nd_mth2_km_tot) + $hsd_rate_mth2 * $nd_mth2_hsd_nac_new ;
                 $nd_mth2_opr_cost_nac_old = $nd_mth2_opr_cost_tot_without_hsd * ($nd_mth2_km_nac_old / $nd_mth2_km_tot) + $hsd_rate_mth2 * $nd_mth2_hsd_nac_old ;
				 $nd_mth2_cost_ac = $nd_mth2_opr_cost_ac + $row1['sal'] * ($nd_mth2_km_ac / $nd_mth2_km_tot);
				 $nd_mth2_cost_nac_new = $nd_mth2_opr_cost_nac_new + $row1['sal'] * ($nd_mth2_km_nac_new / $nd_mth2_km_tot);
				 $nd_mth2_cost_nac_old = $nd_mth2_opr_cost_nac_old + $row1['sal'] * ($nd_mth2_km_nac_old / $nd_mth2_km_tot);
                 $nd_mth2_officer = $row1['officer'];
				 $nd_mth2_admin = $row1['admin'];
				 $nd_mth2_security = $row1['security'];
				 $nd_mth2_cash = $row1['cash'];
				 $nd_mth2_traffic = $row1['traffic'];
				 $nd_mth2_comp = $row1['comp'];
				 $nd_mth2_engg = $row1['engg'];
				 $nd_mth2_driver = $row1['driver'];
				 $nd_mth2_driver_cont = $row1['driver_cont'];
				 $nd_mth2_conductor = $row1['conductor'];
				 $nd_mth2_conductor_cont = $row1['conductor_cont'];
				 
				 
				 
				 $nd_mth2_sal = $row1['sal'] / 100000;
				 $nd_mth2_ot = $row1['ot'] / 100000;
				 $nd_mth2_incen = $row1['incen'] / 100000;
				 $nd_mth2_store = $row1['store'] / 100000;
				 $nd_mth2_local = $row1['local'] / 100000;
				 $nd_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $nd_mth2_hsd_od = $row1['hsd_od'];
                                 $nd_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $nd_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $nd_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $nd_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $nd_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $nd_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $nd_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $nd_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $nd_mth2_maint = $nd_mth2_heavy_maint + $nd_mth2_daily_tech_maint + $nd_mth2_non_tech_maint_ac + $nd_mth2_non_tech_maint_nac;
              
                                             $nd_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $nd_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $nd_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $nd_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $nd_mth2_running = $row1['running'];
                                 $nd_mth2_heldup = $row1['heldup'];
              }   
         }
         if($row1['unit'] == 'PD'){
             if($row1['mth'] == $mth1 ) {
                 $pd_mth1_fleet_ac = $row1['fleet_ac'];
                 $pd_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $pd_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $pd_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $pd_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $pd_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $pd_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $pd_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $pd_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $pd_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $pd_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $pd_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $pd_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $pd_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $pd_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $pd_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $pd_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $pd_mth1_sch_trip_tot = $pd_mth1_sch_trip_ac + $pd_mth1_sch_trip_nac_new + $pd_mth1_sch_trip_nac_old ;
                 $pd_mth1_act_trip_tot = $pd_mth1_act_trip_ac + $pd_mth1_act_trip_nac_new + $pd_mth1_act_trip_nac_old ;
                 $pd_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $pd_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $pd_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $pd_mth1_km_tot = $pd_mth1_km_ac + $pd_mth1_km_nac_old + $pd_mth1_km_nac_new;
                 $pd_mth1_hsd_ac = $row1['hsd_ac'];
                 $pd_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $pd_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $pd_mth1_hsd_tot = $pd_mth1_hsd_ac + $pd_mth1_hsd_nac_old + $pd_mth1_hsd_nac_new;
                 $pd_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $pd_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $pd_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $pd_mth1_sale_1st_tot = $pd_mth1_sale_1st_ac + $pd_mth1_sale_1st_nac_new + $pd_mth1_sale_1st_nac_old;
                 $pd_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $pd_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $pd_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $pd_mth1_sale_2nd_tot = $pd_mth1_sale_2nd_ac + $pd_mth1_sale_2nd_nac_new + $pd_mth1_sale_2nd_nac_old;
                 
                 $pd_mth1_sale_tot_ac = $pd_mth1_sale_1st_ac + $pd_mth1_sale_2nd_ac;
                 $pd_mth1_sale_tot_nac_new = $pd_mth1_sale_1st_nac_new + $pd_mth1_sale_2nd_nac_new;
                 $pd_mth1_sale_tot_nac_old = $pd_mth1_sale_1st_nac_old + $pd_mth1_sale_2nd_nac_old;
                 
                 $pd_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $pd_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $pd_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $pd_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $pd_mth1_opr_cost_tot = $pd_mth1_cost_tot - $row1['sal'];
                 $pd_mth1_opr_cost_ac = $pd_mth1_opr_cost_tot_without_hsd * ($pd_mth1_km_ac / $pd_mth1_km_tot) + $hsd_rate_mth1 * $pd_mth1_hsd_ac ;
                 $pd_mth1_opr_cost_nac_new = $pd_mth1_opr_cost_tot_without_hsd * ($pd_mth1_km_nac_new / $pd_mth1_km_tot) + $hsd_rate_mth1 * $pd_mth1_hsd_nac_new ;
                 $pd_mth1_opr_cost_nac_old = $pd_mth1_opr_cost_tot_without_hsd * ($pd_mth1_km_nac_old / $pd_mth1_km_tot) + $hsd_rate_mth1 * $pd_mth1_hsd_nac_old ;
				 $pd_mth1_cost_ac = $pd_mth1_opr_cost_ac + $row1['sal'] * ($pd_mth1_km_ac / $pd_mth1_km_tot);
				 $pd_mth1_cost_nac_new = $pd_mth1_opr_cost_nac_new + $row1['sal'] * ($pd_mth1_km_nac_new / $pd_mth1_km_tot);
				 $pd_mth1_cost_nac_old = $pd_mth1_opr_cost_nac_old + $row1['sal'] * ($pd_mth1_km_nac_old / $pd_mth1_km_tot);
                 $pd_mth1_officer = $row1['officer'];
				 $pd_mth1_admin = $row1['admin'];
				 $pd_mth1_security = $row1['security'];
				 $pd_mth1_cash = $row1['cash'];
				 $pd_mth1_traffic = $row1['traffic'];
				 $pd_mth1_comp = $row1['comp'];
				 $pd_mth1_engg = $row1['engg'];
				 $pd_mth1_driver = $row1['driver'];
				 $pd_mth1_driver_cont = $row1['driver_cont'];
				 $pd_mth1_conductor = $row1['conductor'];
				 $pd_mth1_conductor_cont = $row1['conductor_cont'];
				 
				
				 
				 $pd_mth1_sal = $row1['sal'] / 100000;
				 $pd_mth1_ot = $row1['ot'] / 100000;
				 $pd_mth1_incen = $row1['incen'] / 100000;
				 $pd_mth1_store = $row1['store'] / 100000;
				 $pd_mth1_local = $row1['local'] / 100000;
				 $pd_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $pd_mth1_hsd_od = $row1['hsd_od'];
                                 $pd_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $pd_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                 $pd_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $pd_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

				$pd_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $pd_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $pd_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $pd_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $pd_mth1_maint = $pd_mth1_heavy_maint + $pd_mth1_daily_tech_maint + $pd_mth1_non_tech_maint_ac + $pd_mth1_non_tech_maint_nac;
                                  $pd_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $pd_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $pd_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $pd_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $pd_mth1_running = $row1['running'];
                                 $pd_mth1_heldup = $row1['heldup'];
             }  
              if($row1['mth'] == $mth2 ) {
                 $pd_mth2_fleet_ac = $row1['fleet_ac'];
                 $pd_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $pd_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $pd_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $pd_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $pd_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $pd_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $pd_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $pd_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $pd_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $pd_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $pd_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $pd_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $pd_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $pd_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $pd_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $pd_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $pd_mth2_sch_trip_tot = $pd_mth2_sch_trip_ac + $pd_mth2_sch_trip_nac_new + $pd_mth2_sch_trip_nac_old ;
                 $pd_mth2_act_trip_tot = $pd_mth2_act_trip_ac + $pd_mth2_act_trip_nac_new + $pd_mth2_act_trip_nac_old ;
                  $pd_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $pd_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $pd_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $pd_mth2_km_tot = $pd_mth2_km_ac + $pd_mth2_km_nac_old + $pd_mth2_km_nac_new;
                 $pd_mth2_hsd_ac = $row1['hsd_ac'];
                 $pd_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $pd_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $pd_mth2_hsd_tot = $pd_mth2_hsd_ac + $pd_mth2_hsd_nac_old + $pd_mth2_hsd_nac_new;
                 $pd_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $pd_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $pd_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $pd_mth2_sale_1st_tot = $pd_mth2_sale_1st_ac + $pd_mth2_sale_1st_nac_new + $pd_mth2_sale_1st_nac_old;
                 $pd_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $pd_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $pd_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $pd_mth2_sale_2nd_tot = $pd_mth2_sale_2nd_ac + $pd_mth2_sale_2nd_nac_new + $pd_mth2_sale_2nd_nac_old;
                 $pd_mth2_sale_tot_ac = $pd_mth2_sale_1st_ac + $pd_mth2_sale_2nd_ac;
                 $pd_mth2_sale_tot_nac_new = $pd_mth2_sale_1st_nac_new + $pd_mth2_sale_2nd_nac_new;
                 $pd_mth2_sale_tot_nac_old = $pd_mth2_sale_1st_nac_old + $pd_mth2_sale_2nd_nac_old;
                 $pd_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $pd_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $pd_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $pd_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $pd_mth2_opr_cost_tot = $pd_mth2_cost_tot - $row1['sal'];
                 $pd_mth2_opr_cost_ac = $pd_mth2_opr_cost_tot_without_hsd * ($pd_mth2_km_ac / $pd_mth2_km_tot) + $hsd_rate_mth2 * $pd_mth2_hsd_ac ;
                 $pd_mth2_opr_cost_nac_new = $pd_mth2_opr_cost_tot_without_hsd * ($pd_mth2_km_nac_new / $pd_mth2_km_tot) + $hsd_rate_mth2 * $pd_mth2_hsd_nac_new ;
                 $pd_mth2_opr_cost_nac_old = $pd_mth2_opr_cost_tot_without_hsd * ($pd_mth2_km_nac_old / $pd_mth2_km_tot) + $hsd_rate_mth2 * $pd_mth2_hsd_nac_old ;
				 $pd_mth2_cost_ac = $pd_mth2_opr_cost_ac + $row1['sal'] * ($pd_mth2_km_ac / $pd_mth2_km_tot);
				 $pd_mth2_cost_nac_new = $pd_mth2_opr_cost_nac_new + $row1['sal'] * ($pd_mth2_km_nac_new / $pd_mth2_km_tot);
				 $pd_mth2_cost_nac_old = $pd_mth2_opr_cost_nac_old + $row1['sal'] * ($pd_mth2_km_nac_old / $pd_mth2_km_tot);
				  $pd_mth2_officer = $row1['officer'];
				 $pd_mth2_admin = $row1['admin'];
				 $pd_mth2_security = $row1['security'];
				 $pd_mth2_cash = $row1['cash'];
				 $pd_mth2_traffic = $row1['traffic'];
				 $pd_mth2_comp = $row1['comp'];
				 $pd_mth2_engg = $row1['engg'];
				 $pd_mth2_driver = $row1['driver'];
				 $pd_mth2_driver_cont = $row1['driver_cont'];
				 $pd_mth2_conductor = $row1['conductor'];
				 $pd_mth2_conductor_cont = $row1['conductor_cont'];
				 
				
				 
				  $pd_mth2_sal = $row1['sal'] / 100000;
				 $pd_mth2_ot = $row1['ot'] / 100000;
				 $pd_mth2_incen = $row1['incen'] / 100000;
				 $pd_mth2_store = $row1['store'] / 100000;
				 $pd_mth2_local = $row1['local'] / 100000;
				 $pd_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $pd_mth2_hsd_od = $row1['hsd_od'];
                                 $pd_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $pd_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $pd_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $pd_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $pd_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $pd_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $pd_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $pd_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $pd_mth2_maint = $pd_mth2_heavy_maint + $pd_mth2_daily_tech_maint + $pd_mth2_non_tech_maint_ac + $pd_mth2_non_tech_maint_nac;
                                             $pd_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $pd_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $pd_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $pd_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $pd_mth2_running = $row1['running'];
                                 $pd_mth2_heldup = $row1['heldup'];
                                            }   
         }
          if($row1['unit'] == 'MD'){
             if($row1['mth'] == $mth1 ) {
                 $md_mth1_fleet_ac = $row1['fleet_ac'];
                 $md_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $md_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $md_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $md_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $md_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $md_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $md_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $md_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $md_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $md_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $md_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $md_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $md_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $md_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $md_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $md_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $md_mth1_sch_trip_tot = $md_mth1_sch_trip_ac + $md_mth1_sch_trip_nac_new + $md_mth1_sch_trip_nac_old ;
                 $md_mth1_act_trip_tot = $md_mth1_act_trip_ac + $md_mth1_act_trip_nac_new + $md_mth1_act_trip_nac_old ;
                 $md_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $md_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $md_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $md_mth1_km_tot = $md_mth1_km_ac + $md_mth1_km_nac_old + $md_mth1_km_nac_new;
                 $md_mth1_hsd_ac = $row1['hsd_ac'];
                 $md_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $md_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $md_mth1_hsd_tot = $md_mth1_hsd_ac + $md_mth1_hsd_nac_old + $md_mth1_hsd_nac_new;
                 $md_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $md_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $md_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $md_mth1_sale_1st_tot = $md_mth1_sale_1st_ac + $md_mth1_sale_1st_nac_new + $md_mth1_sale_1st_nac_old;
                 $md_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $md_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $md_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $md_mth1_sale_2nd_tot = $md_mth1_sale_2nd_ac + $md_mth1_sale_2nd_nac_new + $md_mth1_sale_2nd_nac_old;
                 
                 $md_mth1_sale_tot_ac = $md_mth1_sale_1st_ac + $md_mth1_sale_2nd_ac;
                 $md_mth1_sale_tot_nac_new = $md_mth1_sale_1st_nac_new + $md_mth1_sale_2nd_nac_new;
                 $md_mth1_sale_tot_nac_old = $md_mth1_sale_1st_nac_old + $md_mth1_sale_2nd_nac_old;
                 
                 $md_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $md_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $md_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $md_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $md_mth1_opr_cost_tot = $md_mth1_cost_tot - $row1['sal'];
                 $md_mth1_opr_cost_ac = $md_mth1_opr_cost_tot_without_hsd * ($md_mth1_km_ac / $md_mth1_km_tot) + $hsd_rate_mth1 * $md_mth1_hsd_ac ;
                 $md_mth1_opr_cost_nac_new = $md_mth1_opr_cost_tot_without_hsd * ($md_mth1_km_nac_new / $md_mth1_km_tot) + $hsd_rate_mth1 * $md_mth1_hsd_nac_new ;
                 $md_mth1_opr_cost_nac_old = $md_mth1_opr_cost_tot_without_hsd * ($md_mth1_km_nac_old / $md_mth1_km_tot) + $hsd_rate_mth1 * $md_mth1_hsd_nac_old ;
				 $md_mth1_cost_ac = $md_mth1_opr_cost_ac + $row1['sal'] * ($md_mth1_km_ac / $md_mth1_km_tot);
				 $md_mth1_cost_nac_new = $md_mth1_opr_cost_nac_new + $row1['sal'] * ($md_mth1_km_nac_new / $md_mth1_km_tot);
				 $md_mth1_cost_nac_old = $md_mth1_opr_cost_nac_old + $row1['sal'] * ($md_mth1_km_nac_old / $md_mth1_km_tot);
                 $md_mth1_officer = $row1['officer'];
				 $md_mth1_admin = $row1['admin'];
				 $md_mth1_security = $row1['security'];
				 $md_mth1_cash = $row1['cash'];
				 $md_mth1_traffic = $row1['traffic'];
				 $md_mth1_comp = $row1['comp'];
				 $md_mth1_engg = $row1['engg'];
				 $md_mth1_driver = $row1['driver'];
				 $md_mth1_driver_cont = $row1['driver_cont'];
				 $md_mth1_conductor = $row1['conductor'];
				 $md_mth1_conductor_cont = $row1['conductor_cont'];
				 
				
				 
				 $md_mth1_sal = $row1['sal'] / 100000;
				 $md_mth1_ot = $row1['ot'] / 100000;
				 $md_mth1_incen = $row1['incen'] / 100000;
				 $md_mth1_store = $row1['store'] / 100000;
				 $md_mth1_local = $row1['local'] / 100000;
				 $md_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $md_mth1_hsd_od = $row1['hsd_od'];
                                 $md_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $md_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                 $md_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $md_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

				$md_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $md_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $md_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $md_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $md_mth1_maint = $md_mth1_heavy_maint + $md_mth1_daily_tech_maint + $md_mth1_non_tech_maint_ac + $md_mth1_non_tech_maint_nac;
                                  $md_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $md_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $md_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $md_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $md_mth1_running = $row1['running'];
                                 $md_mth1_heldup = $row1['heldup'];
             }  
              if($row1['mth'] == $mth2 ) {
                 $md_mth2_fleet_ac = $row1['fleet_ac'];
                 $md_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $md_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $md_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $md_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $md_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $md_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $md_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $md_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $md_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $md_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $md_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $md_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $md_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $md_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $md_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $md_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $md_mth2_sch_trip_tot = $md_mth2_sch_trip_ac + $md_mth2_sch_trip_nac_new + $md_mth2_sch_trip_nac_old ;
                 $md_mth2_act_trip_tot = $md_mth2_act_trip_ac + $md_mth2_act_trip_nac_new + $md_mth2_act_trip_nac_old ;
                  $md_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $md_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $md_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $md_mth2_km_tot = $md_mth2_km_ac + $md_mth2_km_nac_old + $md_mth2_km_nac_new;
                 $md_mth2_hsd_ac = $row1['hsd_ac'];
                 $md_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $md_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $md_mth2_hsd_tot = $md_mth2_hsd_ac + $md_mth2_hsd_nac_old + $md_mth2_hsd_nac_new;
                 $md_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $md_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $md_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $md_mth2_sale_1st_tot = $md_mth2_sale_1st_ac + $md_mth2_sale_1st_nac_new + $md_mth2_sale_1st_nac_old;
                 $md_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $md_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $md_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $md_mth2_sale_2nd_tot = $md_mth2_sale_2nd_ac + $md_mth2_sale_2nd_nac_new + $md_mth2_sale_2nd_nac_old;
                 $md_mth2_sale_tot_ac = $md_mth2_sale_1st_ac + $md_mth2_sale_2nd_ac;
                 $md_mth2_sale_tot_nac_new = $md_mth2_sale_1st_nac_new + $md_mth2_sale_2nd_nac_new;
                 $md_mth2_sale_tot_nac_old = $md_mth2_sale_1st_nac_old + $md_mth2_sale_2nd_nac_old;
                 $md_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $md_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $md_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $md_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $md_mth2_opr_cost_tot = $md_mth2_cost_tot - $row1['sal'];
                 $md_mth2_opr_cost_ac = $md_mth2_opr_cost_tot_without_hsd * ($md_mth2_km_ac / $md_mth2_km_tot) + $hsd_rate_mth2 * $md_mth2_hsd_ac ;
                 $md_mth2_opr_cost_nac_new = $md_mth2_opr_cost_tot_without_hsd * ($md_mth2_km_nac_new / $md_mth2_km_tot) + $hsd_rate_mth2 * $md_mth2_hsd_nac_new ;
                 $md_mth2_opr_cost_nac_old = $md_mth2_opr_cost_tot_without_hsd * ($md_mth2_km_nac_old / $md_mth2_km_tot) + $hsd_rate_mth2 * $md_mth2_hsd_nac_old ;
				 $md_mth2_cost_ac = $md_mth2_opr_cost_ac + $row1['sal'] * ($md_mth2_km_ac / $md_mth2_km_tot);
				 $md_mth2_cost_nac_new = $md_mth2_opr_cost_nac_new + $row1['sal'] * ($md_mth2_km_nac_new / $md_mth2_km_tot);
				 $md_mth2_cost_nac_old = $md_mth2_opr_cost_nac_old + $row1['sal'] * ($md_mth2_km_nac_old / $md_mth2_km_tot);
				  $md_mth2_officer = $row1['officer'];
				 $md_mth2_admin = $row1['admin'];
				 $md_mth2_security = $row1['security'];
				 $md_mth2_cash = $row1['cash'];
				 $md_mth2_traffic = $row1['traffic'];
				 $md_mth2_comp = $row1['comp'];
				 $md_mth2_engg = $row1['engg'];
				 $md_mth2_driver = $row1['driver'];
				 $md_mth2_driver_cont = $row1['driver_cont'];
				 $md_mth2_conductor = $row1['conductor'];
				 $md_mth2_conductor_cont = $row1['conductor_cont'];
				 
				
				 
				  $md_mth2_sal = $row1['sal'] / 100000;
				 $md_mth2_ot = $row1['ot'] / 100000;
				 $md_mth2_incen = $row1['incen'] / 100000;
				 $md_mth2_store = $row1['store'] / 100000;
				 $md_mth2_local = $row1['local'] / 100000;
				 $md_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $md_mth2_hsd_od = $row1['hsd_od'];
                                 $md_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $md_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $md_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $md_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $md_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $md_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $md_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $md_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $md_mth2_maint = $md_mth2_heavy_maint + $md_mth2_daily_tech_maint + $md_mth2_non_tech_maint_ac + $md_mth2_non_tech_maint_nac;
                                             $md_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $md_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $md_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $md_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $md_mth2_running = $row1['running'];
                                 $md_mth2_heldup = $row1['heldup'];
                                            }   
         }
         if($row1['unit'] == 'SLD'){
             if($row1['mth'] == $mth1 ) {
                 $sld_mth1_fleet_ac = $row1['fleet_ac'];
                 $sld_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $sld_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $sld_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $sld_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $sld_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $sld_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $sld_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $sld_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $sld_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $sld_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $sld_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $sld_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $sld_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $sld_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $sld_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $sld_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $sld_mth1_sch_trip_tot = $sld_mth1_sch_trip_ac + $sld_mth1_sch_trip_nac_new + $sld_mth1_sch_trip_nac_old ;
                 $sld_mth1_act_trip_tot = $sld_mth1_act_trip_ac + $sld_mth1_act_trip_nac_new + $sld_mth1_act_trip_nac_old ;
                 $sld_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $sld_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $sld_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $sld_mth1_km_tot = $sld_mth1_km_ac + $sld_mth1_km_nac_old + $sld_mth1_km_nac_new;
                 $sld_mth1_hsd_ac = $row1['hsd_ac'];
                 $sld_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $sld_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $sld_mth1_hsd_tot = $sld_mth1_hsd_ac + $sld_mth1_hsd_nac_old + $sld_mth1_hsd_nac_new;
                 $sld_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $sld_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $sld_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $sld_mth1_sale_1st_tot = $sld_mth1_sale_1st_ac + $sld_mth1_sale_1st_nac_new + $sld_mth1_sale_1st_nac_old;
                 $sld_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $sld_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $sld_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $sld_mth1_sale_2nd_tot = $sld_mth1_sale_2nd_ac + $sld_mth1_sale_2nd_nac_new + $sld_mth1_sale_2nd_nac_old;
                 
                 $sld_mth1_sale_tot_ac = $sld_mth1_sale_1st_ac + $sld_mth1_sale_2nd_ac;
                 $sld_mth1_sale_tot_nac_new = $sld_mth1_sale_1st_nac_new + $sld_mth1_sale_2nd_nac_new;
                 $sld_mth1_sale_tot_nac_old = $sld_mth1_sale_1st_nac_old + $sld_mth1_sale_2nd_nac_old;
                 $sld_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $sld_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $sld_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $sld_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $sld_mth1_opr_cost_tot = $sld_mth1_cost_tot - $row1['sal'];
                 $sld_mth1_opr_cost_ac = $sld_mth1_opr_cost_tot_without_hsd * ($sld_mth1_km_ac / $sld_mth1_km_tot) + $hsd_rate_mth1 * $sld_mth1_hsd_ac ;
                 $sld_mth1_opr_cost_nac_new = $sld_mth1_opr_cost_tot_without_hsd * ($sld_mth1_km_nac_new / $sld_mth1_km_tot) + $hsd_rate_mth1 * $sld_mth1_hsd_nac_new ;
                 $sld_mth1_opr_cost_nac_old = $sld_mth1_opr_cost_tot_without_hsd * ($sld_mth1_km_nac_old / $sld_mth1_km_tot) + $hsd_rate_mth1 * $sld_mth1_hsd_nac_old ;
				 $sld_mth1_cost_ac = $sld_mth1_opr_cost_ac + $row1['sal'] * ($sld_mth1_km_ac / $sld_mth1_km_tot);
				 $sld_mth1_cost_nac_new = $sld_mth1_opr_cost_nac_new + $row1['sal'] * ($sld_mth1_km_nac_new / $sld_mth1_km_tot);
				 $sld_mth1_cost_nac_old = $sld_mth1_opr_cost_nac_old + $row1['sal'] * ($sld_mth1_km_nac_old / $sld_mth1_km_tot);
                 $sld_mth1_officer = $row1['officer'];
				 $sld_mth1_admin = $row1['admin'];
				 $sld_mth1_security = $row1['security'];
				 $sld_mth1_cash = $row1['cash'];
				 $sld_mth1_traffic = $row1['traffic'];
				 $sld_mth1_comp = $row1['comp'];
				 $sld_mth1_engg = $row1['engg'];
				 $sld_mth1_driver = $row1['driver'];
				 $sld_mth1_driver_cont = $row1['driver_cont'];
				 $sld_mth1_conductor = $row1['conductor'];
				 $sld_mth1_conductor_cont = $row1['conductor_cont'];
				 
				
				 
				  $sld_mth1_sal = $row1['sal'] / 100000;
				 $sld_mth1_ot = $row1['ot'] / 100000;
				 $sld_mth1_incen = $row1['incen'] / 100000;
				 $sld_mth1_store = $row1['store'] / 100000;
				 $sld_mth1_local = $row1['local'] / 100000;
				 $sld_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $sld_mth1_hsd_od = $row1['hsd_od'];
                                 $sld_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $sld_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                 $sld_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $sld_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

				$sld_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $sld_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $sld_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $sld_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $sld_mth1_maint = $sld_mth1_heavy_maint + $sld_mth1_daily_tech_maint + $sld_mth1_non_tech_maint_ac + $sld_mth1_non_tech_maint_nac;
                                  $sld_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $sld_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $sld_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $sld_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $sld_mth1_running = $row1['running'];
                                 $sld_mth1_heldup = $row1['heldup'];
                                 
                                 
             }  
              if($row1['mth'] == $mth2 ) {
                 $sld_mth2_fleet_ac = $row1['fleet_ac'];
                 $sld_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $sld_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $sld_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $sld_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $sld_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $sld_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $sld_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $sld_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $sld_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $sld_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $sld_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $sld_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $sld_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $sld_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $sld_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $sld_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $sld_mth2_sch_trip_tot = $sld_mth2_sch_trip_ac + $sld_mth2_sch_trip_nac_new + $sld_mth2_sch_trip_nac_old ;
                 $sld_mth2_act_trip_tot = $sld_mth2_act_trip_ac + $sld_mth2_act_trip_nac_new + $sld_mth2_act_trip_nac_old ;
                  $sld_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $sld_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $sld_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $sld_mth2_km_tot = $sld_mth2_km_ac + $sld_mth2_km_nac_old + $sld_mth2_km_nac_new;
                 $sld_mth2_hsd_ac = $row1['hsd_ac'];
                 $sld_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $sld_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $sld_mth2_hsd_tot = $sld_mth2_hsd_ac + $sld_mth2_hsd_nac_old + $sld_mth2_hsd_nac_new;
                 $sld_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $sld_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $sld_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $sld_mth2_sale_1st_tot = $sld_mth2_sale_1st_ac + $sld_mth2_sale_1st_nac_new + $sld_mth2_sale_1st_nac_old;
                 $sld_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $sld_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $sld_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $sld_mth2_sale_2nd_tot = $sld_mth2_sale_2nd_ac + $sld_mth2_sale_2nd_nac_new + $sld_mth2_sale_2nd_nac_old;
                 
                 $sld_mth2_sale_tot_ac = $sld_mth2_sale_1st_ac + $sld_mth2_sale_2nd_ac;
                 $sld_mth2_sale_tot_nac_new = $sld_mth2_sale_1st_nac_new + $sld_mth2_sale_2nd_nac_new;
                 $sld_mth2_sale_tot_nac_old = $sld_mth2_sale_1st_nac_old + $sld_mth2_sale_2nd_nac_old;
                 
                 $sld_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
                 
				  $sld_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $sld_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $sld_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $sld_mth2_opr_cost_tot = $sld_mth2_cost_tot - $row1['sal'];
                 $sld_mth2_opr_cost_ac = $sld_mth2_opr_cost_tot_without_hsd * ($sld_mth2_km_ac / $sld_mth2_km_tot) + $hsd_rate_mth2 * $sld_mth2_hsd_ac ;
                 $sld_mth2_opr_cost_nac_new = $sld_mth2_opr_cost_tot_without_hsd * ($sld_mth2_km_nac_new / $sld_mth2_km_tot) + $hsd_rate_mth2 * $sld_mth2_hsd_nac_new ;
                 $sld_mth2_opr_cost_nac_old = $sld_mth2_opr_cost_tot_without_hsd * ($sld_mth2_km_nac_old / $sld_mth2_km_tot) + $hsd_rate_mth2 * $sld_mth2_hsd_nac_old ;
				 $sld_mth2_cost_ac = $sld_mth2_opr_cost_ac + $row1['sal'] * ($sld_mth2_km_ac / $sld_mth2_km_tot);
				 $sld_mth2_cost_nac_new = $sld_mth2_opr_cost_nac_new + $row1['sal'] * ($sld_mth2_km_nac_new / $sld_mth2_km_tot);
				 $sld_mth2_cost_nac_old = $sld_mth2_opr_cost_nac_old + $row1['sal'] * ($sld_mth2_km_nac_old / $sld_mth2_km_tot);
				  $sld_mth2_officer = $row1['officer'];
				 $sld_mth2_admin = $row1['admin'];
				 $sld_mth2_security = $row1['security'];
				 $sld_mth2_cash = $row1['cash'];
				 $sld_mth2_traffic = $row1['traffic'];
				 $sld_mth2_comp = $row1['comp'];
				 $sld_mth2_engg = $row1['engg'];
				 $sld_mth2_driver = $row1['driver'];
				 $sld_mth2_driver_cont = $row1['driver_cont'];
				 $sld_mth2_conductor = $row1['conductor'];
				 $sld_mth2_conductor_cont = $row1['conductor_cont'];
				 
				
				  $sld_mth2_sal = $row1['sal'] / 100000;
				 $sld_mth2_ot = $row1['ot'] / 100000;
				 $sld_mth2_incen = $row1['incen'] / 100000;
				 $sld_mth2_store = $row1['store'] / 100000;
				 $sld_mth2_local = $row1['local'] / 100000;
				 
				 $sld_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $sld_mth2_hsd_od = $row1['hsd_od'];
                                 $sld_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $sld_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $sld_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $sld_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $sld_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $sld_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $sld_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $sld_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $sld_mth2_maint = $sld_mth2_heavy_maint + $sld_mth2_daily_tech_maint + $sld_mth2_non_tech_maint_ac + $sld_mth2_non_tech_maint_nac;
                                             $sld_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $sld_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $sld_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $sld_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $sld_mth2_running = $row1['running'];
                                 $sld_mth2_heldup = $row1['heldup'];           
                                            
              }   
         }
         if($row1['unit'] == 'KD'){
             if($row1['mth'] == $mth1 ) {
                 $kd_mth1_fleet_ac = $row1['fleet_ac'];
                 $kd_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $kd_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $kd_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $kd_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $kd_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $kd_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $kd_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $kd_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $kd_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $kd_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $kd_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $kd_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $kd_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $kd_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $kd_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $kd_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $kd_mth1_sch_trip_tot = $kd_mth1_sch_trip_ac + $kd_mth1_sch_trip_nac_new + $kd_mth1_sch_trip_nac_old ;
                 $kd_mth1_act_trip_tot = $kd_mth1_act_trip_ac + $kd_mth1_act_trip_nac_new + $kd_mth1_act_trip_nac_old ;
                 $kd_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $kd_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $kd_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $kd_mth1_km_tot = $kd_mth1_km_ac + $kd_mth1_km_nac_old + $kd_mth1_km_nac_new;
                 $kd_mth1_hsd_ac = $row1['hsd_ac'];
                 $kd_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $kd_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $kd_mth1_hsd_tot = $kd_mth1_hsd_ac + $kd_mth1_hsd_nac_old + $kd_mth1_hsd_nac_new;
                 $kd_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $kd_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $kd_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $kd_mth1_sale_1st_tot = $kd_mth1_sale_1st_ac + $kd_mth1_sale_1st_nac_new + $kd_mth1_sale_1st_nac_old;
                 $kd_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $kd_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $kd_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $kd_mth1_sale_2nd_tot = $kd_mth1_sale_2nd_ac + $kd_mth1_sale_2nd_nac_new + $kd_mth1_sale_2nd_nac_old;
                 $kd_mth1_sale_tot_ac = $kd_mth1_sale_1st_ac + $kd_mth1_sale_2nd_ac;
                 $kd_mth1_sale_tot_nac_new = $kd_mth1_sale_1st_nac_new + $kd_mth1_sale_2nd_nac_new;
                 $kd_mth1_sale_tot_nac_old = $kd_mth1_sale_1st_nac_old + $kd_mth1_sale_2nd_nac_old;
                 $kd_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $kd_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $kd_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $kd_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $kd_mth1_opr_cost_tot = $kd_mth1_cost_tot - $row1['sal'];
                 $kd_mth1_opr_cost_ac = $kd_mth1_opr_cost_tot_without_hsd * ($kd_mth1_km_ac / $kd_mth1_km_tot) + $hsd_rate_mth1 * $kd_mth1_hsd_ac ;
                 $kd_mth1_opr_cost_nac_new = $kd_mth1_opr_cost_tot_without_hsd * ($kd_mth1_km_nac_new / $kd_mth1_km_tot) + $hsd_rate_mth1 * $kd_mth1_hsd_nac_new ;
                 $kd_mth1_opr_cost_nac_old = $kd_mth1_opr_cost_tot_without_hsd * ($kd_mth1_km_nac_old / $kd_mth1_km_tot) + $hsd_rate_mth1 * $kd_mth1_hsd_nac_old ;
				 $kd_mth1_cost_ac = $kd_mth1_opr_cost_ac + $row1['sal'] * ($kd_mth1_km_ac / $kd_mth1_km_tot);
				 $kd_mth1_cost_nac_new = $kd_mth1_opr_cost_nac_new + $row1['sal'] * ($kd_mth1_km_nac_new / $kd_mth1_km_tot);
				 $kd_mth1_cost_nac_old = $kd_mth1_opr_cost_nac_old + $row1['sal'] * ($kd_mth1_km_nac_old / $kd_mth1_km_tot);
                 $kd_mth1_officer = $row1['officer'];
				 $kd_mth1_admin = $row1['admin'];
				 $kd_mth1_security = $row1['security'];
				 $kd_mth1_cash = $row1['cash'];
				 $kd_mth1_traffic = $row1['traffic'];
				 $kd_mth1_comp = $row1['comp'];
				 $kd_mth1_engg = $row1['engg'];
				 $kd_mth1_driver = $row1['driver'];
				 $kd_mth1_driver_cont = $row1['driver_cont'];
				 $kd_mth1_conductor = $row1['conductor'];
				 $kd_mth1_conductor_cont = $row1['conductor_cont'];
				 
				 
				 
				  $kd_mth1_sal = $row1['sal'] / 100000;
				 $kd_mth1_ot = $row1['ot'] / 100000;
				 $kd_mth1_incen = $row1['incen'] / 100000;
				 $kd_mth1_store = $row1['store'] / 100000;
				 $kd_mth1_local = $row1['local'] / 100000;
				 $kd_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $kd_mth1_hsd_od = $row1['hsd_od'];
                                 $kd_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $kd_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $kd_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $kd_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

				$kd_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $kd_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $kd_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $kd_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $kd_mth1_maint = $kd_mth1_heavy_maint + $kd_mth1_daily_tech_maint + $kd_mth1_non_tech_maint_ac + $kd_mth1_non_tech_maint_nac;
                                  $kd_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $kd_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $kd_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $kd_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 
                                 $kd_mth1_running = $row1['running'];
                                 $kd_mth1_heldup = $row1['heldup'];
                                 }  
              if($row1['mth'] == $mth2 ) {
                 $kd_mth2_fleet_ac = $row1['fleet_ac'];
                 $kd_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $kd_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $kd_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $kd_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $kd_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $kd_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $kd_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $kd_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $kd_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $kd_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $kd_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $kd_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $kd_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $kd_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $kd_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $kd_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $kd_mth2_sch_trip_tot = $kd_mth2_sch_trip_ac + $kd_mth2_sch_trip_nac_new + $kd_mth2_sch_trip_nac_old ;
                 $kd_mth2_act_trip_tot = $kd_mth2_act_trip_ac + $kd_mth2_act_trip_nac_new + $kd_mth2_act_trip_nac_old ;
                  $kd_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $kd_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $kd_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $kd_mth2_km_tot = $kd_mth2_km_ac + $kd_mth2_km_nac_old + $kd_mth2_km_nac_new;
                 $kd_mth2_hsd_ac = $row1['hsd_ac'];
                 $kd_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $kd_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $kd_mth2_hsd_tot = $kd_mth2_hsd_ac + $kd_mth2_hsd_nac_old + $kd_mth2_hsd_nac_new;
                 $kd_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $kd_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $kd_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $kd_mth2_sale_1st_tot = $kd_mth2_sale_1st_ac + $kd_mth2_sale_1st_nac_new + $kd_mth2_sale_1st_nac_old;
                 $kd_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $kd_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $kd_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $kd_mth2_sale_2nd_tot = $kd_mth2_sale_2nd_ac + $kd_mth2_sale_2nd_nac_new + $kd_mth2_sale_2nd_nac_old;
                 
                 $kd_mth2_sale_tot_ac = $kd_mth2_sale_1st_ac + $kd_mth2_sale_2nd_ac;
                 $kd_mth2_sale_tot_nac_new = $kd_mth2_sale_1st_nac_new + $kd_mth2_sale_2nd_nac_new;
                 $kd_mth2_sale_tot_nac_old = $kd_mth2_sale_1st_nac_old + $kd_mth2_sale_2nd_nac_old;
                 $kd_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $kd_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $kd_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $kd_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $kd_mth2_opr_cost_tot = $kd_mth2_cost_tot - $row1['sal'];
                 $kd_mth2_opr_cost_ac = $kd_mth2_opr_cost_tot_without_hsd * ($kd_mth2_km_ac / $kd_mth2_km_tot) + $hsd_rate_mth2 * $kd_mth2_hsd_ac ;
                 $kd_mth2_opr_cost_nac_new = $kd_mth2_opr_cost_tot_without_hsd * ($kd_mth2_km_nac_new / $kd_mth2_km_tot) + $hsd_rate_mth2 * $kd_mth2_hsd_nac_new ;
                 $kd_mth2_opr_cost_nac_old = $kd_mth2_opr_cost_tot_without_hsd * ($kd_mth2_km_nac_old / $kd_mth2_km_tot) + $hsd_rate_mth2 * $kd_mth2_hsd_nac_old ;
				 $kd_mth2_cost_ac = $kd_mth2_opr_cost_ac + $row1['sal'] * ($kd_mth2_km_ac / $kd_mth2_km_tot);
				 $kd_mth2_cost_nac_new = $kd_mth2_opr_cost_nac_new + $row1['sal'] * ($kd_mth2_km_nac_new / $kd_mth2_km_tot);
				 $kd_mth2_cost_nac_old = $kd_mth2_opr_cost_nac_old + $row1['sal'] * ($kd_mth2_km_nac_old / $kd_mth2_km_tot);
                  $kd_mth2_officer = $row1['officer'];
				 $kd_mth2_admin = $row1['admin'];
				 $kd_mth2_security = $row1['security'];
				 $kd_mth2_cash = $row1['cash'];
				 $kd_mth2_traffic = $row1['traffic'];
				 $kd_mth2_comp = $row1['comp'];
				 $kd_mth2_engg = $row1['engg'];
				 $kd_mth2_driver = $row1['driver'];
				 $kd_mth2_driver_cont = $row1['driver_cont'];
				 $kd_mth2_conductor = $row1['conductor'];
				 $kd_mth2_conductor_cont = $row1['conductor_cont'];
				 
				 
				  $kd_mth2_sal = $row1['sal'] / 100000;
				 $kd_mth2_ot = $row1['ot'] / 100000;
				 $kd_mth2_incen = $row1['incen'] / 100000;
				 $kd_mth2_store = $row1['store'] / 100000;
				 $kd_mth2_local = $row1['local'] / 100000;
				 $kd_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $kd_mth2_hsd_od = $row1['hsd_od'];
                                 $kd_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $kd_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $kd_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $kd_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                   $kd_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $kd_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $kd_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $kd_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $kd_mth2_maint = $kd_mth2_heavy_maint + $kd_mth2_daily_tech_maint + $kd_mth2_non_tech_maint_ac + $kd_mth2_non_tech_maint_nac;
                                             $kd_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $kd_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $kd_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $kd_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $kd_mth2_running = $row1['running'];
                                 $kd_mth2_heldup = $row1['heldup'];
                                            
                                            
              }   
			  
         }
         if($row1['unit'] == 'GD'){
             if($row1['mth'] == $mth1 ) {
                 $gd_mth1_fleet_ac = $row1['fleet_ac'];
                 $gd_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $gd_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $gd_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $gd_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $gd_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $gd_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $gd_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $gd_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $gd_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $gd_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $gd_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $gd_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $gd_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $gd_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $gd_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $gd_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $gd_mth1_sch_trip_tot = $gd_mth1_sch_trip_ac + $gd_mth1_sch_trip_nac_new + $gd_mth1_sch_trip_nac_old ;
                 $gd_mth1_act_trip_tot = $gd_mth1_act_trip_ac + $gd_mth1_act_trip_nac_new + $gd_mth1_act_trip_nac_old ;
                 $gd_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $gd_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $gd_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $gd_mth1_km_tot = $gd_mth1_km_ac + $gd_mth1_km_nac_old + $gd_mth1_km_nac_new;
                 $gd_mth1_hsd_ac = $row1['hsd_ac'];
                 $gd_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $gd_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $gd_mth1_hsd_tot = $gd_mth1_hsd_ac + $gd_mth1_hsd_nac_old + $gd_mth1_hsd_nac_new;
                 $gd_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $gd_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $gd_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $gd_mth1_sale_1st_tot = $gd_mth1_sale_1st_ac + $gd_mth1_sale_1st_nac_new + $gd_mth1_sale_1st_nac_old;
                 $gd_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $gd_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $gd_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $gd_mth1_sale_2nd_tot = $gd_mth1_sale_2nd_ac + $gd_mth1_sale_2nd_nac_new + $gd_mth1_sale_2nd_nac_old;
                 
                 $gd_mth1_sale_tot_ac = $gd_mth1_sale_1st_ac + $gd_mth1_sale_2nd_ac;
                 $gd_mth1_sale_tot_nac_new = $gd_mth1_sale_1st_nac_new + $gd_mth1_sale_2nd_nac_new;
                 $gd_mth1_sale_tot_nac_old = $gd_mth1_sale_1st_nac_old + $gd_mth1_sale_2nd_nac_old;
                 
                 
                 $gd_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $gd_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $gd_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $gd_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $gd_mth1_opr_cost_tot = $gd_mth1_cost_tot - $row1['sal'];
                 $gd_mth1_opr_cost_ac = $gd_mth1_opr_cost_tot_without_hsd * ($gd_mth1_km_ac / $gd_mth1_km_tot) + $hsd_rate_mth1 * $gd_mth1_hsd_ac ;
                 $gd_mth1_opr_cost_nac_new = $gd_mth1_opr_cost_tot_without_hsd * ($gd_mth1_km_nac_new / $gd_mth1_km_tot) + $hsd_rate_mth1 * $gd_mth1_hsd_nac_new ;
                 $gd_mth1_opr_cost_nac_old = $gd_mth1_opr_cost_tot_without_hsd * ($gd_mth1_km_nac_old / $gd_mth1_km_tot) + $hsd_rate_mth1 * $gd_mth1_hsd_nac_old ;
				 $gd_mth1_cost_ac = $gd_mth1_opr_cost_ac + $row1['sal'] * ($gd_mth1_km_ac / $gd_mth1_km_tot);
				 $gd_mth1_cost_nac_new = $gd_mth1_opr_cost_nac_new + $row1['sal'] * ($gd_mth1_km_nac_new / $gd_mth1_km_tot);
				 $gd_mth1_cost_nac_old = $gd_mth1_opr_cost_nac_old + $row1['sal'] * ($gd_mth1_km_nac_old / $gd_mth1_km_tot);
				 $gd_mth1_officer = $row1['officer'];
				 $gd_mth1_admin = $row1['admin'];
				 $gd_mth1_security = $row1['security'];
				 $gd_mth1_cash = $row1['cash'];
				 $gd_mth1_traffic = $row1['traffic'];
				 $gd_mth1_comp = $row1['comp'];
				 $gd_mth1_engg = $row1['engg'];
				 $gd_mth1_driver = $row1['driver'];
				 $gd_mth1_driver_cont = $row1['driver_cont'];
				 $gd_mth1_conductor = $row1['conductor'];
				 $gd_mth1_conductor_cont = $row1['conductor_cont'];
				 
				 
				  $gd_mth1_sal = $row1['sal'] / 100000;
				 $gd_mth1_ot = $row1['ot'] / 100000;
				 $gd_mth1_incen = $row1['incen'] / 100000;
				 $gd_mth1_store = $row1['store'] / 100000;
				 $gd_mth1_local = $row1['local'] / 100000;
				 $gd_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $gd_mth1_hsd_od = $row1['hsd_od'];
                                 $gd_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $gd_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $gd_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $gd_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

				$gd_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $gd_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $gd_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $gd_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $gd_mth1_maint = $gd_mth1_heavy_maint + $gd_mth1_daily_tech_maint + $gd_mth1_non_tech_maint_ac + $gd_mth1_non_tech_maint_nac;
                 
                                  $gd_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $gd_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $gd_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $gd_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $gd_mth1_running = $row1['running'];
                                 $gd_mth1_heldup = $row1['heldup'];
             }  
              if($row1['mth'] == $mth2 ) {
                 $gd_mth2_fleet_ac = $row1['fleet_ac'];
                 $gd_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $gd_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $gd_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $gd_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $gd_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $gd_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $gd_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $gd_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $gd_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $gd_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $gd_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $gd_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $gd_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $gd_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $gd_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $gd_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $gd_mth2_sch_trip_tot = $gd_mth2_sch_trip_ac + $gd_mth2_sch_trip_nac_new + $gd_mth2_sch_trip_nac_old ;
                 $gd_mth2_act_trip_tot = $gd_mth2_act_trip_ac + $gd_mth2_act_trip_nac_new + $gd_mth2_act_trip_nac_old ;
                  $gd_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $gd_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $gd_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $gd_mth2_km_tot = $gd_mth2_km_ac + $gd_mth2_km_nac_old + $gd_mth2_km_nac_new;
                 $gd_mth2_hsd_ac = $row1['hsd_ac'];
                 $gd_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $gd_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $gd_mth2_hsd_tot = $gd_mth2_hsd_ac + $gd_mth2_hsd_nac_old + $gd_mth2_hsd_nac_new;
                 $gd_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $gd_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $gd_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $gd_mth2_sale_1st_tot = $gd_mth2_sale_1st_ac + $gd_mth2_sale_1st_nac_new + $gd_mth2_sale_1st_nac_old;
                 $gd_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $gd_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $gd_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $gd_mth2_sale_2nd_tot = $gd_mth2_sale_2nd_ac + $gd_mth2_sale_2nd_nac_new + $gd_mth2_sale_2nd_nac_old;
                 
                 $gd_mth2_sale_tot_ac = $gd_mth2_sale_1st_ac + $gd_mth2_sale_2nd_ac;
                 $gd_mth2_sale_tot_nac_new = $gd_mth2_sale_1st_nac_new + $gd_mth2_sale_2nd_nac_new;
                 $gd_mth2_sale_tot_nac_old = $gd_mth2_sale_1st_nac_old + $gd_mth2_sale_2nd_nac_old;
                 $gd_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $gd_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $gd_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                  $gd_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $gd_mth2_opr_cost_tot = $gd_mth2_cost_tot - $row1['sal'];
                 $gd_mth2_opr_cost_ac = $gd_mth2_opr_cost_tot_without_hsd * ($gd_mth2_km_ac / $gd_mth2_km_tot) + $hsd_rate_mth2 * $gd_mth2_hsd_ac ;
                 $gd_mth2_opr_cost_nac_new = $gd_mth2_opr_cost_tot_without_hsd * ($gd_mth2_km_nac_new / $gd_mth2_km_tot) + $hsd_rate_mth2 * $gd_mth2_hsd_nac_new ;
                 $gd_mth2_opr_cost_nac_old = $gd_mth2_opr_cost_tot_without_hsd * ($gd_mth2_km_nac_old / $gd_mth2_km_tot) + $hsd_rate_mth2 * $gd_mth2_hsd_nac_old ;
				 $gd_mth2_cost_ac = $gd_mth2_opr_cost_ac + $row1['sal'] * ($gd_mth2_km_ac / $gd_mth2_km_tot);
				 $gd_mth2_cost_nac_new = $gd_mth2_opr_cost_nac_new + $row1['sal'] * ($gd_mth2_km_nac_new / $gd_mth2_km_tot);
				 $gd_mth2_cost_nac_old = $gd_mth2_opr_cost_nac_old + $row1['sal'] * ($gd_mth2_km_nac_old / $gd_mth2_km_tot);
                 $gd_mth2_officer = $row1['officer'];
				 $gd_mth2_admin = $row1['admin'];
				 $gd_mth2_security = $row1['security'];
				 $gd_mth2_cash = $row1['cash'];
				 $gd_mth2_traffic = $row1['traffic'];
				 $gd_mth2_comp = $row1['comp'];
				 $gd_mth2_engg = $row1['engg'];
				 $gd_mth2_driver = $row1['driver'];
				 $gd_mth2_driver_cont = $row1['driver_cont'];
				 $gd_mth2_conductor = $row1['conductor'];
				 $gd_mth2_conductor_cont = $row1['conductor_cont']; 
				 
				 
				 
				  $gd_mth2_sal = $row1['sal'] / 100000;
				 $gd_mth2_ot = $row1['ot'] / 100000;
				 $gd_mth2_incen = $row1['incen'] / 100000;
				 $gd_mth2_store = $row1['store'] / 100000;
				 $gd_mth2_local = $row1['local'] / 100000;
				 $gd_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $gd_mth2_hsd_od = $row1['hsd_od'];
                                 $gd_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $gd_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;
                                 
                                 $gd_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $gd_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $gd_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $gd_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $gd_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $gd_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $gd_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $gd_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                                                  $gd_mth2_maint = $gd_mth2_heavy_maint + $gd_mth2_daily_tech_maint + $gd_mth2_non_tech_maint_ac + $gd_mth2_non_tech_maint_nac;
                                                                   $gd_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $gd_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $gd_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $gd_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                  $gd_mth2_running = $row1['running'];
                                 $gd_mth2_heldup = $row1['heldup'];                                
                                                                  
              }   
         }
         if($row1['unit'] == 'LD'){
             if($row1['mth'] == $mth1 ) {
                 $ld_mth1_fleet_ac = $row1['fleet_ac'];
                 $ld_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $ld_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $ld_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $ld_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $ld_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $ld_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $ld_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $ld_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $ld_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $ld_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $ld_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $ld_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $ld_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $ld_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $ld_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $ld_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $ld_mth1_sch_trip_tot = $ld_mth1_sch_trip_ac + $ld_mth1_sch_trip_nac_new + $ld_mth1_sch_trip_nac_old ;
                 $ld_mth1_act_trip_tot = $ld_mth1_act_trip_ac + $ld_mth1_act_trip_nac_new + $ld_mth1_act_trip_nac_old ;
                 $ld_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $ld_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $ld_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $ld_mth1_km_tot = $ld_mth1_km_ac + $ld_mth1_km_nac_old + $ld_mth1_km_nac_new;
                 $ld_mth1_hsd_ac = $row1['hsd_ac'];
                 $ld_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $ld_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $ld_mth1_hsd_tot = $ld_mth1_hsd_ac + $ld_mth1_hsd_nac_old + $ld_mth1_hsd_nac_new;
                 $ld_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $ld_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $ld_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $ld_mth1_sale_1st_tot = $ld_mth1_sale_1st_ac + $ld_mth1_sale_1st_nac_new + $ld_mth1_sale_1st_nac_old;
                 $ld_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $ld_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $ld_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $ld_mth1_sale_2nd_tot = $ld_mth1_sale_2nd_ac + $ld_mth1_sale_2nd_nac_new + $ld_mth1_sale_2nd_nac_old;
                 
                 $ld_mth1_sale_tot_ac = $ld_mth1_sale_1st_ac + $ld_mth1_sale_2nd_ac;
                 $ld_mth1_sale_tot_nac_new = $ld_mth1_sale_1st_nac_new + $ld_mth1_sale_2nd_nac_new;
                 $ld_mth1_sale_tot_nac_old = $ld_mth1_sale_1st_nac_old + $ld_mth1_sale_2nd_nac_old;
                 
                 
                 $ld_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $ld_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $ld_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $ld_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $ld_mth1_opr_cost_tot = $ld_mth1_cost_tot - $row1['sal'];
                 $ld_mth1_opr_cost_ac = $ld_mth1_opr_cost_tot_without_hsd * ($ld_mth1_km_ac / $ld_mth1_km_tot) + $hsd_rate_mth1 * $ld_mth1_hsd_ac ;
                 $ld_mth1_opr_cost_nac_new = $ld_mth1_opr_cost_tot_without_hsd * ($ld_mth1_km_nac_new / $ld_mth1_km_tot) + $hsd_rate_mth1 * $ld_mth1_hsd_nac_new ;
                 $ld_mth1_opr_cost_nac_old = $ld_mth1_opr_cost_tot_without_hsd * ($ld_mth1_km_nac_old / $ld_mth1_km_tot) + $hsd_rate_mth1 * $ld_mth1_hsd_nac_old ;
				 $ld_mth1_cost_ac = $ld_mth1_opr_cost_ac + $row1['sal'] * ($ld_mth1_km_ac / $ld_mth1_km_tot);
				 $ld_mth1_cost_nac_new = $ld_mth1_opr_cost_nac_new + $row1['sal'] * ($ld_mth1_km_nac_new / $ld_mth1_km_tot);
				 $ld_mth1_cost_nac_old = $ld_mth1_opr_cost_nac_old + $row1['sal'] * ($ld_mth1_km_nac_old / $ld_mth1_km_tot);
                 $ld_mth1_officer = $row1['officer'];
				 $ld_mth1_admin = $row1['admin'];
				 $ld_mth1_security = $row1['security'];
				 $ld_mth1_cash = $row1['cash'];
				 $ld_mth1_traffic = $row1['traffic'];
				 $ld_mth1_comp = $row1['comp'];
				 $ld_mth1_engg = $row1['engg'];
				 $ld_mth1_driver = $row1['driver'];
				 $ld_mth1_driver_cont = $row1['driver_cont'];
				 $ld_mth1_conductor = $row1['conductor'];
				 $ld_mth1_conductor_cont = $row1['conductor_cont'];
				 
				
				  $ld_mth1_sal = $row1['sal'] / 100000;
				 $ld_mth1_ot = $row1['ot'] / 100000;
				 $ld_mth1_incen = $row1['incen'] / 100000;
				 $ld_mth1_store = $row1['store'] / 100000;
				 $ld_mth1_local = $row1['local'] / 100000;
				 $ld_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $ld_mth1_hsd_od = $row1['hsd_od'];
                                 $ld_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $ld_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                 $ld_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $ld_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

				$ld_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $ld_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $ld_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $ld_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $ld_mth1_maint = $ld_mth1_heavy_maint + $ld_mth1_daily_tech_maint + $ld_mth1_non_tech_maint_ac + $ld_mth1_non_tech_maint_nac;
             
                                  $ld_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $ld_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $ld_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $ld_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $ld_mth1_running = $row1['running'];
                                 $ld_mth1_heldup = $row1['heldup'];
             }  
              if($row1['mth'] == $mth2 ) {
                 $ld_mth2_fleet_ac = $row1['fleet_ac'];
                 $ld_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $ld_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $ld_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $ld_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $ld_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $ld_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $ld_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $ld_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $ld_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $ld_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $ld_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $ld_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $ld_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $ld_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $ld_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $ld_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $ld_mth2_sch_trip_tot = $ld_mth2_sch_trip_ac + $ld_mth2_sch_trip_nac_new + $ld_mth2_sch_trip_nac_old ;
                 $ld_mth2_act_trip_tot = $ld_mth2_act_trip_ac + $ld_mth2_act_trip_nac_new + $ld_mth2_act_trip_nac_old ;
                  $ld_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $ld_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $ld_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $ld_mth2_km_tot = $ld_mth2_km_ac + $ld_mth2_km_nac_old + $ld_mth2_km_nac_new;
                 $ld_mth2_hsd_ac = $row1['hsd_ac'];
                 $ld_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $ld_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $ld_mth2_hsd_tot = $ld_mth2_hsd_ac + $ld_mth2_hsd_nac_old + $ld_mth2_hsd_nac_new;
                 $ld_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $ld_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $ld_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $ld_mth2_sale_1st_tot = $ld_mth2_sale_1st_ac + $ld_mth2_sale_1st_nac_new + $ld_mth2_sale_1st_nac_old;
                 $ld_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $ld_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $ld_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $ld_mth2_sale_2nd_tot = $ld_mth2_sale_2nd_ac + $ld_mth2_sale_2nd_nac_new + $ld_mth2_sale_2nd_nac_old;
                 
                 $ld_mth2_sale_tot_ac = $ld_mth2_sale_1st_ac + $ld_mth2_sale_2nd_ac;
                 $ld_mth2_sale_tot_nac_new = $ld_mth2_sale_1st_nac_new + $ld_mth2_sale_2nd_nac_new;
                 $ld_mth2_sale_tot_nac_old = $ld_mth2_sale_1st_nac_old + $ld_mth2_sale_2nd_nac_old;
                 
                 $ld_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $ld_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $ld_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $ld_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $ld_mth2_opr_cost_tot = $ld_mth2_cost_tot - $row1['sal'];
                 $ld_mth2_opr_cost_ac = $ld_mth2_opr_cost_tot_without_hsd * ($ld_mth2_km_ac / $ld_mth2_km_tot) + $hsd_rate_mth2 * $ld_mth2_hsd_ac ;
                 $ld_mth2_opr_cost_nac_new = $ld_mth2_opr_cost_tot_without_hsd * ($ld_mth2_km_nac_new / $ld_mth2_km_tot) + $hsd_rate_mth2 * $ld_mth2_hsd_nac_new ;
                 $ld_mth2_opr_cost_nac_old = $ld_mth2_opr_cost_tot_without_hsd * ($ld_mth2_km_nac_old / $ld_mth2_km_tot) + $hsd_rate_mth2 * $ld_mth2_hsd_nac_old ;
				 $ld_mth2_cost_ac = $ld_mth2_opr_cost_ac + $row1['sal'] * ($ld_mth2_km_ac / $ld_mth2_km_tot);
				 $ld_mth2_cost_nac_new = $ld_mth2_opr_cost_nac_new + $row1['sal'] * ($ld_mth2_km_nac_new / $ld_mth2_km_tot);
				 $ld_mth2_cost_nac_old = $ld_mth2_opr_cost_nac_old + $row1['sal'] * ($ld_mth2_km_nac_old / $ld_mth2_km_tot);
                                 $ld_mth2_officer = $row1['officer'];
				 $ld_mth2_admin = $row1['admin'];
				 $ld_mth2_security = $row1['security'];
				 $ld_mth2_cash = $row1['cash'];
				 $ld_mth2_traffic = $row1['traffic'];
				 $ld_mth2_comp = $row1['comp'];
				 $ld_mth2_engg = $row1['engg'];
				 $ld_mth2_driver = $row1['driver'];
				 $ld_mth2_driver_cont = $row1['driver_cont'];
				 $ld_mth2_conductor = $row1['conductor'];
				 $ld_mth2_conductor_cont = $row1['conductor_cont'];
				 
				 
				 
				  $ld_mth2_sal = $row1['sal'] / 100000;
				 $ld_mth2_ot = $row1['ot'] / 100000;
				 $ld_mth2_incen = $row1['incen'] / 100000;
				 $ld_mth2_store = $row1['store'] / 100000;
				 $ld_mth2_local = $row1['local'] / 100000;
				 $ld_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $ld_mth2_hsd_od = $row1['hsd_od'];
                                 $ld_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $ld_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;
                                  $ld_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $ld_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                 $ld_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $ld_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $ld_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $ld_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $ld_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $ld_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $ld_mth2_maint = $ld_mth2_heavy_maint + $ld_mth2_daily_tech_maint + $ld_mth2_non_tech_maint_ac + $ld_mth2_non_tech_maint_nac;
             
                                   $ld_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $ld_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $ld_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $ld_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];          
                                   $ld_mth2_running = $row1['running'];
                                 $ld_mth2_heldup = $row1['heldup'];         
              }   
         }
         if($row1['unit'] == 'TD'){
             if($row1['mth'] == $mth1 ) {
                 $td_mth1_fleet_ac = $row1['fleet_ac'];
                 $td_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $td_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $td_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $td_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $td_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $td_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $td_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $td_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $td_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $td_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $td_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $td_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $td_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $td_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $td_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $td_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $td_mth1_sch_trip_tot = $td_mth1_sch_trip_ac + $td_mth1_sch_trip_nac_new + $td_mth1_sch_trip_nac_old ;
                 $td_mth1_act_trip_tot = $td_mth1_act_trip_ac + $td_mth1_act_trip_nac_new + $td_mth1_act_trip_nac_old ;
                 $td_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $td_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $td_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $td_mth1_km_tot = $td_mth1_km_ac + $td_mth1_km_nac_old + $td_mth1_km_nac_new;
                 $td_mth1_hsd_ac = $row1['hsd_ac'];
                 $td_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $td_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $td_mth1_hsd_tot = $td_mth1_hsd_ac + $td_mth1_hsd_nac_old + $td_mth1_hsd_nac_new;
                 $td_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $td_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $td_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $td_mth1_sale_1st_tot = $td_mth1_sale_1st_ac + $td_mth1_sale_1st_nac_new + $td_mth1_sale_1st_nac_old;
                 $td_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $td_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $td_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $td_mth1_sale_2nd_tot = $td_mth1_sale_2nd_ac + $td_mth1_sale_2nd_nac_new + $td_mth1_sale_2nd_nac_old;
                 
                 $td_mth1_sale_tot_ac = $td_mth1_sale_1st_ac + $td_mth1_sale_2nd_ac;
                 $td_mth1_sale_tot_nac_new = $td_mth1_sale_1st_nac_new + $td_mth1_sale_2nd_nac_new;
                 $td_mth1_sale_tot_nac_old = $td_mth1_sale_1st_nac_old + $td_mth1_sale_2nd_nac_old;
                 
                 $td_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $td_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $td_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $td_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $td_mth1_opr_cost_tot = $td_mth1_cost_tot - $row1['sal'];
                 $td_mth1_opr_cost_ac = $td_mth1_opr_cost_tot_without_hsd * ($td_mth1_km_ac / $td_mth1_km_tot) + $hsd_rate_mth1 * $td_mth1_hsd_ac ;
                 $td_mth1_opr_cost_nac_new = $td_mth1_opr_cost_tot_without_hsd * ($td_mth1_km_nac_new / $td_mth1_km_tot) + $hsd_rate_mth1 * $td_mth1_hsd_nac_new ;
                 $td_mth1_opr_cost_nac_old = $td_mth1_opr_cost_tot_without_hsd * ($td_mth1_km_nac_old / $td_mth1_km_tot) + $hsd_rate_mth1 * $td_mth1_hsd_nac_old ;
				 $td_mth1_cost_ac = $td_mth1_opr_cost_ac + $row1['sal'] * ($td_mth1_km_ac / $td_mth1_km_tot);
				 $td_mth1_cost_nac_new = $td_mth1_opr_cost_nac_new + $row1['sal'] * ($td_mth1_km_nac_new / $td_mth1_km_tot);
				 $td_mth1_cost_nac_old = $td_mth1_opr_cost_nac_old + $row1['sal'] * ($td_mth1_km_nac_old / $td_mth1_km_tot);
                 $td_mth1_officer = $row1['officer'];
				 $td_mth1_admin = $row1['admin'];
				 $td_mth1_security = $row1['security'];
				 $td_mth1_cash = $row1['cash'];
				 $td_mth1_traffic = $row1['traffic'];
				 $td_mth1_comp = $row1['comp'];
				 $td_mth1_engg = $row1['engg'];
				 $td_mth1_driver = $row1['driver'];
				 $td_mth1_driver_cont = $row1['driver_cont'];
				 $td_mth1_conductor = $row1['conductor'];
				 $td_mth1_conductor_cont = $row1['conductor_cont'];
				 
				
				  $td_mth1_sal = $row1['sal'] / 100000;
				 $td_mth1_ot = $row1['ot'] / 100000;
				 $td_mth1_incen = $row1['incen'] / 100000;
				 $td_mth1_store = $row1['store'] / 100000;
				 $td_mth1_local = $row1['local'] / 100000;
				 $td_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $td_mth1_hsd_od = $row1['hsd_od'];
                                 $td_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $td_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $td_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $td_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

				$td_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $td_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $td_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $td_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $td_mth1_maint = $td_mth1_heavy_maint + $td_mth1_daily_tech_maint + $td_mth1_non_tech_maint_ac + $td_mth1_non_tech_maint_nac;
                                  $td_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $td_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $td_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $td_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $td_mth1_running = $row1['running'];
                                 $td_mth1_heldup = $row1['heldup'];
                                 
                                 
             }  
              if($row1['mth'] == $mth2 ) {
                 $td_mth2_fleet_ac = $row1['fleet_ac'];
                 $td_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $td_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $td_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $td_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $td_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $td_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $td_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $td_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $td_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $td_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $td_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $td_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $td_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $td_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $td_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $td_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $td_mth2_sch_trip_tot = $td_mth2_sch_trip_ac + $td_mth2_sch_trip_nac_new + $td_mth2_sch_trip_nac_old ;
                 $td_mth2_act_trip_tot = $td_mth2_act_trip_ac + $td_mth2_act_trip_nac_new + $td_mth2_act_trip_nac_old ;
                 $td_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $td_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $td_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $td_mth2_km_tot = $td_mth2_km_ac + $td_mth2_km_nac_old + $td_mth2_km_nac_new;
                 $td_mth2_hsd_ac = $row1['hsd_ac'];
                 $td_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $td_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $td_mth2_hsd_tot = $td_mth2_hsd_ac + $td_mth2_hsd_nac_old + $td_mth2_hsd_nac_new;
                 $td_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $td_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $td_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $td_mth2_sale_1st_tot = $td_mth2_sale_1st_ac + $td_mth2_sale_1st_nac_new + $td_mth2_sale_1st_nac_old;
                 $td_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $td_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $td_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $td_mth2_sale_2nd_tot = $td_mth2_sale_2nd_ac + $td_mth2_sale_2nd_nac_new + $td_mth2_sale_2nd_nac_old;
                 
                 $td_mth2_sale_tot_ac = $td_mth2_sale_1st_ac + $td_mth2_sale_2nd_ac;
                 $td_mth2_sale_tot_nac_new = $td_mth2_sale_1st_nac_new + $td_mth2_sale_2nd_nac_new;
                 $td_mth2_sale_tot_nac_old = $td_mth2_sale_1st_nac_old + $td_mth2_sale_2nd_nac_old;
                 
                 $td_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $td_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $td_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $td_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $td_mth2_opr_cost_tot = $td_mth2_cost_tot - $row1['sal'];
                 $td_mth2_opr_cost_ac = $td_mth2_opr_cost_tot_without_hsd * ($td_mth2_km_ac / $td_mth2_km_tot) + $hsd_rate_mth2 * $td_mth2_hsd_ac ;
                 $td_mth2_opr_cost_nac_new = $td_mth2_opr_cost_tot_without_hsd * ($td_mth2_km_nac_new / $td_mth2_km_tot) + $hsd_rate_mth2 * $td_mth2_hsd_nac_new ;
                 $td_mth2_opr_cost_nac_old = $td_mth2_opr_cost_tot_without_hsd * ($td_mth2_km_nac_old / $td_mth2_km_tot) + $hsd_rate_mth2 * $td_mth2_hsd_nac_old ;
				 $td_mth2_cost_ac = $td_mth2_opr_cost_ac + $row1['sal'] * ($td_mth2_km_ac / $td_mth2_km_tot);
				 $td_mth2_cost_nac_new = $td_mth2_opr_cost_nac_new + $row1['sal'] * ($td_mth2_km_nac_new / $td_mth2_km_tot);
				 $td_mth2_cost_nac_old = $td_mth2_opr_cost_nac_old + $row1['sal'] * ($td_mth2_km_nac_old / $td_mth2_km_tot);
                  $td_mth2_officer = $row1['officer'];
				 $td_mth2_admin = $row1['admin'];
				 $td_mth2_security = $row1['security'];
				 $td_mth2_cash = $row1['cash'];
				 $td_mth2_traffic = $row1['traffic'];
				 $td_mth2_comp = $row1['comp'];
				 $td_mth2_engg = $row1['engg'];
				 $td_mth2_driver = $row1['driver'];
				 $td_mth2_driver_cont = $row1['driver_cont'];
				 $td_mth2_conductor = $row1['conductor'];
				 $td_mth2_conductor_cont = $row1['conductor_cont'];
				 
				 
				 
				  $td_mth2_sal = $row1['sal'] / 100000;
				 $td_mth2_ot = $row1['ot'] / 100000;
				 $td_mth2_incen = $row1['incen'] / 100000;
				 $td_mth2_store = $row1['store'] / 100000;
				 $td_mth2_local = $row1['local'] / 100000;
				 $td_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $td_mth2_hsd_od = $row1['hsd_od'];
                                 $td_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $td_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $td_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $td_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                   $td_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $td_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $td_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $td_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $td_mth2_maint = $td_mth2_heavy_maint + $td_mth2_daily_tech_maint + $td_mth2_non_tech_maint_ac + $td_mth2_non_tech_maint_nac;
                                             $td_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $td_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $td_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $td_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                   $td_mth2_running = $row1['running'];
                                 $td_mth2_heldup = $row1['heldup'];         
                                            
              }
         }
         if($row1['unit'] == 'TPD'){
             if($row1['mth'] == $mth1 ) {
                 $tpd_mth1_fleet_ac = $row1['fleet_ac'];
                 $tpd_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $tpd_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $tpd_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $tpd_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $tpd_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $tpd_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $tpd_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $tpd_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $tpd_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $tpd_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $tpd_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $tpd_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $tpd_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $tpd_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $tpd_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $tpd_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $tpd_mth1_sch_trip_tot = $tpd_mth1_sch_trip_ac + $tpd_mth1_sch_trip_nac_new + $tpd_mth1_sch_trip_nac_old ;
                 $tpd_mth1_act_trip_tot = $tpd_mth1_act_trip_ac + $tpd_mth1_act_trip_nac_new + $tpd_mth1_act_trip_nac_old ;
                 $tpd_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $tpd_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $tpd_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $tpd_mth1_km_tot = $tpd_mth1_km_ac + $tpd_mth1_km_nac_old + $tpd_mth1_km_nac_new;
                 $tpd_mth1_hsd_ac = $row1['hsd_ac'];
                 $tpd_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $tpd_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $tpd_mth1_hsd_tot = $tpd_mth1_hsd_ac + $tpd_mth1_hsd_nac_old + $tpd_mth1_hsd_nac_new;
                 $tpd_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $tpd_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $tpd_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $tpd_mth1_sale_1st_tot = $tpd_mth1_sale_1st_ac + $tpd_mth1_sale_1st_nac_new + $tpd_mth1_sale_1st_nac_old;
                 $tpd_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $tpd_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $tpd_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $tpd_mth1_sale_2nd_tot = $tpd_mth1_sale_2nd_ac + $tpd_mth1_sale_2nd_nac_new + $tpd_mth1_sale_2nd_nac_old;
                 
                 $tpd_mth1_sale_tot_ac = $tpd_mth1_sale_1st_ac + $tpd_mth1_sale_2nd_ac;
                 $tpd_mth1_sale_tot_nac_new = $tpd_mth1_sale_1st_nac_new + $tpd_mth1_sale_2nd_nac_new;
                 $tpd_mth1_sale_tot_nac_old = $tpd_mth1_sale_1st_nac_old + $tpd_mth1_sale_2nd_nac_old;
                 
                 
                 $tpd_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $tpd_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $tpd_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $tpd_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $tpd_mth1_opr_cost_tot = $tpd_mth1_cost_tot - $row1['sal'];
                 $tpd_mth1_opr_cost_ac = $tpd_mth1_opr_cost_tot_without_hsd * ($tpd_mth1_km_ac / $tpd_mth1_km_tot) + $hsd_rate_mth1 * $tpd_mth1_hsd_ac ;
                 $tpd_mth1_opr_cost_nac_new = $tpd_mth1_opr_cost_tot_without_hsd * ($tpd_mth1_km_nac_new / $tpd_mth1_km_tot) + $hsd_rate_mth1 * $tpd_mth1_hsd_nac_new ;
                 $tpd_mth1_opr_cost_nac_old = $tpd_mth1_opr_cost_tot_without_hsd * ($tpd_mth1_km_nac_old / $tpd_mth1_km_tot) + $hsd_rate_mth1 * $tpd_mth1_hsd_nac_old ;
				 $tpd_mth1_cost_ac = $tpd_mth1_opr_cost_ac + $row1['sal'] * ($tpd_mth1_km_ac / $tpd_mth1_km_tot);
				 $tpd_mth1_cost_nac_new = $tpd_mth1_opr_cost_nac_new + $row1['sal'] * ($tpd_mth1_km_nac_new / $tpd_mth1_km_tot);
				 $tpd_mth1_cost_nac_old = $tpd_mth1_opr_cost_nac_old + $row1['sal'] * ($tpd_mth1_km_nac_old / $tpd_mth1_km_tot);
				 $tpd_mth1_officer = $row1['officer'];
				 $tpd_mth1_admin = $row1['admin'];
				 $tpd_mth1_security = $row1['security'];
				 $tpd_mth1_cash = $row1['cash'];
				 $tpd_mth1_traffic = $row1['traffic'];
				 $tpd_mth1_comp = $row1['comp'];
				 $tpd_mth1_engg = $row1['engg'];
				 $tpd_mth1_driver = $row1['driver'];
				 $tpd_mth1_driver_cont = $row1['driver_cont'];
				 $tpd_mth1_conductor = $row1['conductor'];
				 $tpd_mth1_conductor_cont = $row1['conductor_cont'];
				
				
				 
				  $tpd_mth1_sal = $row1['sal'] / 100000;
				 $tpd_mth1_ot = $row1['ot'] / 100000;
				 $tpd_mth1_incen = $row1['incen'] / 100000;
				 $tpd_mth1_store = $row1['store'] / 100000;
				 $tpd_mth1_local = $row1['local'] / 100000;
				 $tpd_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $tpd_mth1_hsd_od = $row1['hsd_od'];
                                 $tpd_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $tpd_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                   $tpd_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $tpd_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $tpd_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $tpd_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $tpd_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $tpd_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $tpd_mth1_maint = $tpd_mth1_heavy_maint + $tpd_mth1_daily_tech_maint + $tpd_mth1_non_tech_maint_ac + $tpd_mth1_non_tech_maint_nac;
                                  $tpd_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $tpd_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $tpd_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $tpd_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $tpd_mth1_running = $row1['running'];
                                 $tpd_mth1_heldup = $row1['heldup'];
                                 
             }  
              if($row1['mth'] == $mth2 ) {
                 $tpd_mth2_fleet_ac = $row1['fleet_ac'];
                 $tpd_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $tpd_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $tpd_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $tpd_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $tpd_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $tpd_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $tpd_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $tpd_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $tpd_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $tpd_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $tpd_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $tpd_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $tpd_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $tpd_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $tpd_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $tpd_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $tpd_mth2_sch_trip_tot = $tpd_mth2_sch_trip_ac + $tpd_mth2_sch_trip_nac_new + $tpd_mth2_sch_trip_nac_old ;
                 $tpd_mth2_act_trip_tot = $tpd_mth2_act_trip_ac + $tpd_mth2_act_trip_nac_new + $tpd_mth2_act_trip_nac_old ;
                  $tpd_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $tpd_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $tpd_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $tpd_mth2_km_tot = $tpd_mth2_km_ac + $tpd_mth2_km_nac_old + $tpd_mth2_km_nac_new;
                 $tpd_mth2_hsd_ac = $row1['hsd_ac'];
                 $tpd_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $tpd_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $tpd_mth2_hsd_tot = $tpd_mth2_hsd_ac + $tpd_mth2_hsd_nac_old + $tpd_mth2_hsd_nac_new;
                 $tpd_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000 ;
                 $tpd_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000 ;
                 $tpd_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000 ;
                 $tpd_mth2_sale_1st_tot = $tpd_mth2_sale_1st_ac + $tpd_mth2_sale_1st_nac_new + $tpd_mth2_sale_1st_nac_old;
                 $tpd_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000 ;
                 $tpd_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000 ;
                 $tpd_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000 ;
                 $tpd_mth2_sale_2nd_tot = $tpd_mth2_sale_2nd_ac + $tpd_mth2_sale_2nd_nac_new + $tpd_mth2_sale_2nd_nac_old;
                 $tpd_mth2_sale_tot_ac = $tpd_mth2_sale_1st_ac + $tpd_mth2_sale_2nd_ac;
                 $tpd_mth2_sale_tot_nac_new = $tpd_mth2_sale_1st_nac_new + $tpd_mth2_sale_2nd_nac_new;
                 $tpd_mth2_sale_tot_nac_old = $tpd_mth2_sale_1st_nac_old + $tpd_mth2_sale_2nd_nac_old;
                 
                 $tpd_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $tpd_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $tpd_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $tpd_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $tpd_mth2_opr_cost_tot = $tpd_mth2_cost_tot - $row1['sal'];
                 $tpd_mth2_opr_cost_ac = $tpd_mth2_opr_cost_tot_without_hsd * ($tpd_mth2_km_ac / $tpd_mth2_km_tot) + $hsd_rate_mth2 * $tpd_mth2_hsd_ac ;
                 $tpd_mth2_opr_cost_nac_new = $tpd_mth2_opr_cost_tot_without_hsd * ($tpd_mth2_km_nac_new / $tpd_mth2_km_tot) + $hsd_rate_mth2 * $tpd_mth2_hsd_nac_new ;
                 $tpd_mth2_opr_cost_nac_old = $tpd_mth2_opr_cost_tot_without_hsd * ($tpd_mth2_km_nac_old / $tpd_mth2_km_tot) + $hsd_rate_mth2 * $tpd_mth2_hsd_nac_old ;
				 $tpd_mth2_cost_ac = $tpd_mth2_opr_cost_ac + $row1['sal'] * ($tpd_mth2_km_ac / $tpd_mth2_km_tot);
				 $tpd_mth2_cost_nac_new = $tpd_mth2_opr_cost_nac_new + $row1['sal'] * ($tpd_mth2_km_nac_new / $tpd_mth2_km_tot);
				 $tpd_mth2_cost_nac_old = $tpd_mth2_opr_cost_nac_old + $row1['sal'] * ($tpd_mth2_km_nac_old / $tpd_mth2_km_tot);
                  $tpd_mth2_officer = $row1['officer'];
				 $tpd_mth2_admin = $row1['admin'];
				 $tpd_mth2_security = $row1['security'];
				 $tpd_mth2_cash = $row1['cash'];
				 $tpd_mth2_traffic = $row1['traffic'];
				 $tpd_mth2_comp = $row1['comp'];
				 $tpd_mth2_engg = $row1['engg'];
				 $tpd_mth2_driver = $row1['driver'];
				 $tpd_mth2_driver_cont = $row1['driver_cont'];
				 $tpd_mth2_conductor = $row1['conductor'];
				 $tpd_mth2_conductor_cont = $row1['conductor_cont'];
				 
				
				 
				  $tpd_mth2_sal = $row1['sal'] / 100000;
				 $tpd_mth2_ot = $row1['ot'] / 100000;
				 $tpd_mth2_incen = $row1['incen'] / 100000;
				 $tpd_mth2_store = $row1['store'] / 100000;
				 $tpd_mth2_local = $row1['local'] / 100000;
				 $tpd_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $tpd_mth2_hsd_od = $row1['hsd_od'];
                                 $tpd_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $tpd_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $tpd_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $tpd_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                  $tpd_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $tpd_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $tpd_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $tpd_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                            $tpd_mth2_maint = $tpd_mth2_heavy_maint + $tpd_mth2_daily_tech_maint + $tpd_mth2_non_tech_maint_ac + $tpd_mth2_non_tech_maint_nac;
                                             $tpd_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $tpd_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $tpd_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $tpd_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                   $tpd_mth2_running = $row1['running'];
                                 $tpd_mth2_heldup = $row1['heldup'];         
                                            
              }   
         }
         if($row1['unit'] == 'HD'){
             if($row1['mth'] == $mth1 ) {
                 $hd_mth1_fleet_ac = $row1['fleet_ac'];
                 $hd_mth1_fleet_nac_new = $row1['fleet_nac_new'];
                 $hd_mth1_fleet_nac_old = $row1['fleet_nac_old'];
                 $hd_mth1_supply_1st_tot = $row1['supply_1st_tot'];
                 $hd_mth1_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $hd_mth1_out_1st_ac = $row1['out_1st_ac'];
                 $hd_mth1_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $hd_mth1_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $hd_mth1_out_2nd_ac = $row1['out_2nd_ac'];
                 $hd_mth1_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $hd_mth1_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $hd_mth1_sch_trip_ac = $row1['sch_trip_ac'];
                 $hd_mth1_act_trip_ac = $row1['act_trip_ac'];
                 $hd_mth1_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $hd_mth1_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $hd_mth1_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $hd_mth1_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $hd_mth1_sch_trip_tot = $hd_mth1_sch_trip_ac + $hd_mth1_sch_trip_nac_new + $hd_mth1_sch_trip_nac_old ;
                 $hd_mth1_act_trip_tot = $hd_mth1_act_trip_ac + $hd_mth1_act_trip_nac_new + $hd_mth1_act_trip_nac_old ;
                 $hd_mth1_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $hd_mth1_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $hd_mth1_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $hd_mth1_km_tot = $hd_mth1_km_ac + $hd_mth1_km_nac_old + $hd_mth1_km_nac_new;
                 $hd_mth1_hsd_ac = $row1['hsd_ac'];
                 $hd_mth1_hsd_nac_old = $row1['hsd_nac_old'];
                 $hd_mth1_hsd_nac_new = $row1['hsd_nac_new'];
                 $hd_mth1_hsd_tot = $hd_mth1_hsd_ac + $hd_mth1_hsd_nac_old + $hd_mth1_hsd_nac_new;
                 $hd_mth1_sale_1st_ac = $row1['sale_ac_1st'] / 100000;
                 $hd_mth1_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000;
                 $hd_mth1_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000;
                 $hd_mth1_sale_1st_tot = $hd_mth1_sale_1st_ac + $hd_mth1_sale_1st_nac_new + $hd_mth1_sale_1st_nac_old;
                 $hd_mth1_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000;
                 $hd_mth1_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000;
                 $hd_mth1_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000;
                 $hd_mth1_sale_2nd_tot = $hd_mth1_sale_2nd_ac + $hd_mth1_sale_2nd_nac_new + $hd_mth1_sale_2nd_nac_old;
                 
                 $hd_mth1_sale_tot_ac = $hd_mth1_sale_1st_ac + $hd_mth1_sale_2nd_ac;
                 $hd_mth1_sale_tot_nac_new = $hd_mth1_sale_1st_nac_new + $hd_mth1_sale_2nd_nac_new;
                 $hd_mth1_sale_tot_nac_old = $hd_mth1_sale_1st_nac_old + $hd_mth1_sale_2nd_nac_old;
                 
                 
                 $hd_mth1_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $hd_mth1_cost_tot = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth1 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $hd_mth1_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $hd_mth1_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth1_heavy_maint_rate + $row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $hd_mth1_opr_cost_tot = $hd_mth1_cost_tot - $row1['sal'];
                 $hd_mth1_opr_cost_ac = $hd_mth1_opr_cost_tot_without_hsd * ($hd_mth1_km_ac / $hd_mth1_km_tot) + $hsd_rate_mth1 * $hd_mth1_hsd_ac ;
                 $hd_mth1_opr_cost_nac_new = $hd_mth1_opr_cost_tot_without_hsd * ($hd_mth1_km_nac_new / $hd_mth1_km_tot) + $hsd_rate_mth1 * $hd_mth1_hsd_nac_new ;
                 $hd_mth1_opr_cost_nac_old = $hd_mth1_opr_cost_tot_without_hsd * ($hd_mth1_km_nac_old / $hd_mth1_km_tot) + $hsd_rate_mth1 * $hd_mth1_hsd_nac_old ;
				 $hd_mth1_cost_ac = $hd_mth1_opr_cost_ac + $row1['sal'] * ($hd_mth1_km_ac / $hd_mth1_km_tot);
				 $hd_mth1_cost_nac_new = $hd_mth1_opr_cost_nac_new + $row1['sal'] * ($hd_mth1_km_nac_new / $hd_mth1_km_tot);
				 $hd_mth1_cost_nac_old = $hd_mth1_opr_cost_nac_old + $row1['sal'] * ($hd_mth1_km_nac_old / $hd_mth1_km_tot);
                 $hd_mth1_officer = $row1['officer'];
				 $hd_mth1_admin = $row1['admin'];
				 $hd_mth1_security = $row1['security'];
				 $hd_mth1_cash = $row1['cash'];
				 $hd_mth1_traffic = $row1['traffic'];
				$hd_mth1_comp = $row1['comp'];
				 $hd_mth1_engg = $row1['engg'];
				 $hd_mth1_driver = $row1['driver'];
				 $hd_mth1_driver_cont = $row1['driver_cont'];
				 $hd_mth1_conductor = $row1['conductor'];
				 $hd_mth1_conductor_cont = $row1['conductor_cont'];
				 
				
				 
				  $hd_mth1_sal = $row1['sal'] / 100000;
				 $hd_mth1_ot = $row1['ot'] / 100000;
				 $hd_mth1_incen = $row1['incen'] / 100000;
				 $hd_mth1_store = $row1['store'] / 100000;
				 $hd_mth1_local = $row1['local'] / 100000;
				 $hd_mth1_hsd_nrv = $row1['hsd_nrv'];
				 $hd_mth1_hsd_od = $row1['hsd_od'];
                                 $hd_mth1_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $hd_mth1_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                  $hd_mth1_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $hd_mth1_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

				$hd_mth1_heavy_maint = ($row1['heavy_maint'] * $mth1_heavy_maint_rate) / 100000;
                                 $hd_mth1_daily_tech_maint = ($row1['daily_tech_maint'] * $mth1_daily_tech_maint_rate) / 100000;
                                 $hd_mth1_non_tech_maint_ac = ($row1['non_tech_maint_ac'] * $mth1_non_tech_maint_ac_rate) / (100000 * 30);
                                 $hd_mth1_non_tech_maint_nac = ($row1['non_tech_maint_nac'] * $mth1_non_tech_maint_nac_rate) / 100000;
                                 $hd_mth1_maint = $hd_mth1_heavy_maint + $hd_mth1_daily_tech_maint + $hd_mth1_non_tech_maint_ac + $hd_mth1_non_tech_maint_nac;
                                  $hd_mth1_heavy_maint_no = $row1['heavy_maint']; 
                                 $hd_mth1_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $hd_mth1_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $hd_mth1_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $hd_mth1_running = $row1['running'];
                                 $hd_mth1_heldup = $row1['heldup'];
                                 }  
              if($row1['mth'] == $mth2 ) {
                 $hd_mth2_fleet_ac = $row1['fleet_ac'];
                 $hd_mth2_fleet_nac_new = $row1['fleet_nac_new'];
                 $hd_mth2_fleet_nac_old = $row1['fleet_nac_old'];
                 $hd_mth2_supply_1st_tot = $row1['supply_1st_tot'];
                 $hd_mth2_supply_2nd_tot = $row1['supply_2nd_tot'];
                 $hd_mth2_out_1st_ac = $row1['out_1st_ac'];
                 $hd_mth2_out_1st_nac_new = $row1['out_1st_nac_new'];
                 $hd_mth2_out_1st_nac_old = $row1['out_1st_nac_old'];
                 $hd_mth2_out_2nd_ac = $row1['out_2nd_ac'];
                 $hd_mth2_out_2nd_nac_new = $row1['out_2nd_nac_new'];
                 $hd_mth2_out_2nd_nac_old = $row1['out_2nd_nac_old'];
                 $hd_mth2_sch_trip_ac = $row1['sch_trip_ac'];
                 $hd_mth2_act_trip_ac = $row1['act_trip_ac'];
                 $hd_mth2_sch_trip_nac_new = $row1['sch_trip_nac_new'];
                 $hd_mth2_act_trip_nac_new = $row1['act_trip_nac_new'];
                 $hd_mth2_sch_trip_nac_old = $row1['sch_trip_nac_old'];
                 $hd_mth2_act_trip_nac_old = $row1['act_trip_nac_old'];
                 $hd_mth2_sch_trip_tot = $hd_mth2_sch_trip_ac + $hd_mth2_sch_trip_nac_new + $hd_mth2_sch_trip_nac_old ;
                 $hd_mth2_act_trip_tot = $hd_mth2_act_trip_ac + $hd_mth2_act_trip_nac_new + $hd_mth2_act_trip_nac_old ;
                 $hd_mth2_km_ac = ($row1['km_ac'] + $row1['km_ac_2nd']) / 100000 ;
                 $hd_mth2_km_nac_old = ($row1['km_nac_old'] + $row1['km_nac_old_2nd']) / 100000;
                 $hd_mth2_km_nac_new = ($row1['km_nac_new'] + $row1['km_nac_new_2nd']) / 100000;
                 $hd_mth2_km_tot = $hd_mth2_km_ac + $hd_mth2_km_nac_old + $hd_mth2_km_nac_new;
                 $hd_mth2_hsd_ac = $row1['hsd_ac'];
                 $hd_mth2_hsd_nac_old = $row1['hsd_nac_old'];
                 $hd_mth2_hsd_nac_new = $row1['hsd_nac_new'];
                 $hd_mth2_hsd_tot = $hd_mth2_hsd_ac + $hd_mth2_hsd_nac_old + $hd_mth2_hsd_nac_new;
                 $hd_mth2_sale_1st_ac = $row1['sale_ac_1st'] / 100000;
                 $hd_mth2_sale_1st_nac_new = $row1['sale_nac_1st_new'] / 100000;
                 $hd_mth2_sale_1st_nac_old = $row1['sale_nac_1st_old'] / 100000;
                 $hd_mth2_sale_1st_tot = $hd_mth2_sale_1st_ac + $hd_mth2_sale_1st_nac_new + $hd_mth2_sale_1st_nac_old;
                 $hd_mth2_sale_2nd_ac = $row1['sale_ac_2nd'] / 100000;
                 $hd_mth2_sale_2nd_nac_new = $row1['sale_nac_new_2nd'] / 100000;
                 $hd_mth2_sale_2nd_nac_old = $row1['sale_nac_old_2nd'] / 100000;
                 $hd_mth2_sale_2nd_tot = $hd_mth2_sale_2nd_ac + $hd_mth2_sale_2nd_nac_new + $hd_mth2_sale_2nd_nac_old;
                 
                 $hd_mth2_sale_tot_ac = $hd_mth2_sale_1st_ac + $hd_mth2_sale_2nd_ac;
                 $hd_mth2_sale_tot_nac_new = $hd_mth2_sale_1st_nac_new + $hd_mth2_sale_2nd_nac_new;
                 $hd_mth2_sale_tot_nac_old = $hd_mth2_sale_1st_nac_old + $hd_mth2_sale_2nd_nac_old;
                 
                 $hd_mth2_sale_tot = $row1['sale_entered_from_depot'] / 100000;
				 
				  $hd_mth2_cost_tot = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] + $hsd_rate_mth2 * ($row1['hsd_ac'] + $row1['hsd_nac_new'] + $row1['hsd_nac_old']);
                 $hd_mth2_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['sal'] + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $hd_mth2_opr_cost_tot_without_hsd = $row1['heavy_maint'] * $mth2_heavy_maint_rate + $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate + $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / 30 + $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate + $row1['ot'] + $row1['incen'] + $row1['store'] + $row1['volvo_spare'] + $row1['local'] ;
                 $hd_mth2_opr_cost_tot = $hd_mth2_cost_tot - $row1['sal'];
                 $hd_mth2_opr_cost_ac = $hd_mth2_opr_cost_tot_without_hsd * ($hd_mth2_km_ac / $hd_mth2_km_tot) + $hsd_rate_mth2 * $hd_mth2_hsd_ac ;
                 $hd_mth2_opr_cost_nac_new = $hd_mth2_opr_cost_tot_without_hsd * ($hd_mth2_km_nac_new / $hd_mth2_km_tot) + $hsd_rate_mth2 * $hd_mth2_hsd_nac_new ;
                 $hd_mth2_opr_cost_nac_old = $hd_mth2_opr_cost_tot_without_hsd * ($hd_mth2_km_nac_old / $hd_mth2_km_tot) + $hsd_rate_mth2 * $hd_mth2_hsd_nac_old ;
				 $hd_mth2_cost_ac = $hd_mth2_opr_cost_ac + $row1['sal'] * ($hd_mth2_km_ac / $hd_mth2_km_tot);
				 $hd_mth2_cost_nac_new = $hd_mth2_opr_cost_nac_new + $row1['sal'] * ($hd_mth2_km_nac_new / $hd_mth2_km_tot);
				 $hd_mth2_cost_nac_old = $hd_mth2_opr_cost_nac_old + $row1['sal'] * ($hd_mth2_km_nac_old / $hd_mth2_km_tot);
				  $hd_mth2_officer = $row1['officer'];
				 $hd_mth2_admin = $row1['admin'];
				 $hd_mth2_security = $row1['security'];
				 $hd_mth2_cash = $row1['cash'];
				 $hd_mth2_traffic = $row1['traffic'];
				 $hd_mth2_comp = $row1['comp'];
				 $hd_mth2_engg = $row1['engg'];
				 $hd_mth2_driver = $row1['driver'];
				 $hd_mth2_driver_cont = $row1['driver_cont'];
				 $hd_mth2_conductor = $row1['conductor'];
				 $hd_mth2_conductor_cont = $row1['conductor_cont'];
				 
				 
				  $hd_mth2_sal = $row1['sal'] / 100000;
				 $hd_mth2_ot = $row1['ot'] / 100000;
				 $hd_mth2_incen = $row1['incen'] / 100000;
				 $hd_mth2_store = $row1['store'] / 100000;
				 $hd_mth2_local = $row1['local'] / 100000;
				 $hd_mth2_hsd_nrv = $row1['hsd_nrv'];
				 $hd_mth2_hsd_od = $row1['hsd_od'];
                                 $hd_mth2_att_driver_mth_cur = $row1['att_driver_1st'] + $row1['att_driver_tr_1st'] + $row1['att_driver_2nd'] + $row1['att_driver_tr_2nd'] ;
                                 $hd_mth2_att_conductor_mth_cur = $row1['att_conductor_1st'] + $row1['att_conductor_tr_1st'] + $row1['att_conductor_2nd'] + $row1['att_conductor_tr_2nd'] ;
                                   $hd_mth2_ab_driver_mth_cur = $row1['ab_driver_1st'] + $row1['ab_driver_tr_1st'] + $row1['ab_driver_2nd'] + $row1['ab_driver_tr_2nd'] ;
                                 $hd_mth2_ab_conductor_mth_cur = $row1['ab_conductor_1st'] + $row1['ab_conductor_tr_1st'] + $row1['ab_conductor_2nd'] + $row1['ab_conductor_tr_2nd'] ;

                                 $hd_mth2_heavy_maint = $row1['heavy_maint'] * $mth2_heavy_maint_rate / 100000;
                                 $hd_mth2_daily_tech_maint = $row1['daily_tech_maint'] * $mth2_daily_tech_maint_rate / 100000;
                                 $hd_mth2_non_tech_maint_ac = $row1['non_tech_maint_ac'] * $mth2_non_tech_maint_ac_rate / (100000 * 30);
                                 $hd_mth2_non_tech_maint_nac = $row1['non_tech_maint_nac'] * $mth2_non_tech_maint_nac_rate / 100000;
                                 $hd_mth2_maint = $hd_mth2_heavy_maint + $hd_mth2_daily_tech_maint + $hd_mth2_non_tech_maint_ac + $hd_mth2_non_tech_maint_nac;
                                     $hd_mth2_heavy_maint_no = $row1['heavy_maint']; 
                                 $hd_mth2_daily_tech_maint_no = $row1['daily_tech_maint'];
                                 $hd_mth2_non_tech_maint_ac_no = $row1['non_tech_maint_ac'];
                                 $hd_mth2_non_tech_maint_nac_no = $row1['non_tech_maint_nac'];
                                 $hd_mth2_running = $row1['running'];
                                 $hd_mth2_heldup = $row1['heldup'];
              }   
         }
		 if($row1['unit'] == 'HQ'){
             if($row1['mth'] == $mth1 ) {
                 
                 $hq_mth1_officer = $row1['officer'];
				 $hq_mth1_admin = $row1['admin'];
				 $hq_mth1_security = $row1['security'];
				 $hq_mth1_cash = $row1['cash'];
				 $hq_mth1_traffic = $row1['traffic'];
				 $hq_mth1_engg = $row1['comp'];
				 $hq_mth1_driver = $row1['driver'];
				 $hq_mth1_driver_cont = $row1['driver_cont'];
				 $hq_mth1_conductor = $row1['conductor'];
				 $hq_mth1_conductor_cont = $row1['conductor_cont'];
				
             }  
              if($row1['mth'] == $mth2 ) {
                 
				  $hq_mth2_officer = $row1['officer'];
				 $hq_mth2_admin = $row1['admin'];
				 $hq_mth2_security = $row1['security'];
				 $hq_mth2_cash = $row1['cash'];
				 $hq_mth2_traffic = $row1['traffic'];
				 $hq_mth2_engg = $row1['comp'];
				 $hq_mth2_driver = $row1['driver'];
				 $hq_mth2_driver_cont = $row1['driver_cont'];
				 $hq_mth2_conductor = $row1['conductor'];
				 $hq_mth2_conductor_cont = $row1['conductor_cont'];
                 }   
         }
		 if($row1['unit'] == 'CT'){
             if($row1['mth'] == $mth1 ) {
                 
                 $ct_mth1_officer = $row1['officer'];
				 $ct_mth1_admin = $row1['admin'];
				 $ct_mth1_security = $row1['security'];
				 $ct_mth1_cash = $row1['cash'];
				 $ct_mth1_traffic = $row1['traffic'];
				 $ct_mth1_engg = $row1['comp'];
				 $ct_mth1_driver = $row1['driver'];
				 $ct_mth1_driver_cont = $row1['driver_cont'];
				 $ct_mth1_conductor = $row1['conductor'];
				 $ct_mth1_conductor_cont = $row1['conductor_cont'];
				
             }  
              if($row1['mth'] == $mth2 ) {
                 
				  $ct_mth2_officer = $row1['officer'];
				 $ct_mth2_admin = $row1['admin'];
				 $ct_mth2_security = $row1['security'];
				 $ct_mth2_cash = $row1['cash'];
				 $ct_mth2_traffic = $row1['traffic'];
				 $ct_mth2_engg = $row1['comp'];
				 $ct_mth2_driver = $row1['driver'];
				 $ct_mth2_driver_cont = $row1['driver_cont'];
				 $ct_mth2_conductor = $row1['conductor'];
				 $ct_mth2_conductor_cont = $row1['conductor_cont'];
                 }   
         }
		 if($row1['unit'] == 'CW'){
             if($row1['mth'] == $mth1 ) {
                 
                 $cw_mth1_officer = $row1['officer'];
				 $cw_mth1_admin = $row1['admin'];
				 $cw_mth1_security = $row1['security'];
				 $cw_mth1_cash = $row1['cash'];
				 $cw_mth1_traffic = $row1['traffic'];
				 $cw_mth1_engg = $row1['comp'];
				 $cw_mth1_driver = $row1['driver'];
				 $cw_mth1_driver_cont = $row1['driver_cont'];
				 $cw_mth1_conductor = $row1['conductor'];
				 $cw_mth1_conductor_cont = $row1['conductor_cont'];
				
             }  
              if($row1['mth'] == $mth2 ) {
                 
				  $cw_mth2_officer = $row1['officer'];
				 $cw_mth2_admin = $row1['admin'];
				 $cw_mth2_security = $row1['security'];
				 $cw_mth2_cash = $row1['cash'];
				 $cw_mth2_traffic = $row1['traffic'];
				 $cw_mth2_engg = $row1['comp'];
				 $cw_mth2_driver = $row1['driver'];
				 $cw_mth2_driver_cont = $row1['driver_cont'];
				 $cw_mth2_conductor = $row1['conductor'];
				 $cw_mth2_conductor_cont = $row1['conductor_cont'];
                 }   
         }
		 if($row1['unit'] == 'CE'){
             if($row1['mth'] == $mth1 ) {
                 
                 $ce_mth1_officer = $row1['officer'];
				 $ce_mth1_admin = $row1['admin'];
				 $ce_mth1_security = $row1['security'];
				 $ce_mth1_cash = $row1['cash'];
				 $ce_mth1_traffic = $row1['traffic'];
				 $ce_mth1_engg = $row1['comp'];
				 $ce_mth1_driver = $row1['driver'];
				 $ce_mth1_driver_cont = $row1['driver_cont'];
				 $ce_mth1_conductor = $row1['conductor'];
				 $ce_mth1_conductor_cont = $row1['conductor_cont'];
				
             }  
              if($row1['mth'] == $mth2 ) {
                 
				  $ce_mth2_officer = $row1['officer'];
				 $ce_mth2_admin = $row1['admin'];
				 $ce_mth2_security = $row1['security'];
				 $ce_mth2_cash = $row1['cash'];
				 $ce_mth2_traffic = $row1['traffic'];
				 $ce_mth2_engg = $row1['comp'];
				 $ce_mth2_driver = $row1['driver'];
				 $ce_mth2_driver_cont = $row1['driver_cont'];
				 $ce_mth2_conductor = $row1['conductor'];
				 $ce_mth2_conductor_cont = $row1['conductor_cont'];
                 }   
         }
     }?>

<?php
if(substr($mth2,2,2) == '01'){$month2 = 'JAN';}
if(substr($mth2,2,2) == '02'){$month2 = 'FEB';}
if(substr($mth2,2,2) == '03'){$month2 = 'MAR';}
if(substr($mth2,2,2) == '04'){$month2 = 'APR';}
if(substr($mth2,2,2) == '05'){$month2 = 'MAY';}
if(substr($mth2,2,2) == '06'){$month2 = 'JUN';}
if(substr($mth2,2,2) == '07'){$month2 = 'JUL';}
if(substr($mth2,2,2) == '08'){$month2 = 'AUG';}
if(substr($mth2,2,2) == '09'){$month2 = 'SEP';}
if(substr($mth2,2,2) == '10'){$month2 = 'OCT';}
if(substr($mth2,2,2) == '11'){$month2 = 'NOV';}
if(substr($mth2,2,2) == '12'){$month2 = 'DEC';}

if(substr($mth1,2,2) == '01'){$month1 = 'JAN';}
if(substr($mth1,2,2) == '02'){$month1 = 'FEB';}
if(substr($mth1,2,2) == '03'){$month1 = 'MAR';}
if(substr($mth1,2,2) == '04'){$month1 = 'APR';}
if(substr($mth1,2,2) == '05'){$month1 = 'MAY';}
if(substr($mth1,2,2) == '06'){$month1 = 'JUN';}
if(substr($mth1,2,2) == '07'){$month1 = 'JUL';}
if(substr($mth1,2,2) == '08'){$month1 = 'AUG';}
if(substr($mth1,2,2) == '09'){$month1 = 'SEP';}
if(substr($mth1,2,2) == '10'){$month1 = 'OCT';}
if(substr($mth1,2,2) == '11'){$month1 = 'NOV';}
if(substr($mth1,2,2) == '12'){$month1 = 'DEC';}





echo "<table border='1' eidth='100%'>";
echo "<thead>";
echo "<tr>";
echo "<td align='center' style='background: yellow;font-size: 10px;font-weight:bold'colspan='25'>";
echo "CALCUTTA STATE TRANSPORT CORPORATION";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='center' style='background: yellow;font-size: 10px;font-weight:bold'colspan='25'>";
echo "MONTHLY REPORT FOR THE MONTH OF " . $month2 . ", 20" .  substr($mth2,0,2) . " and " . $month1 . ", 20" .  substr($mth1,0,2);
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='background: yellow;font-size: 8.5px;'style='font-size: 8.5px;'>";
echo "DESC";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "BD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "ND";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "PD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "MD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "SLD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "KD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "GD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "LD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "TD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "TPD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "HD";
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'colspan='2' align='center'>";
echo "CSTC";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='background: yellow;font-size: 8.5px;'>";
echo "MONTH ->";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "FLEET STRENGTH";
echo "</td>";
echo "</tr>";
echo "</thead>";
echo "<tr>";
echo "<td style='background: yellow;font-size: 8.5px;'>";
echo "AC";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth2_fleet_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_fleet_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth2_fleet_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_fleet_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth2_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_fleet_ac;

echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_fleet_ac;

echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_fleet_ac;

echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_fleet_ac;

echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_fleet_ac;

echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_fleet_ac;

echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_fleet_ac;

echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_fleet_ac;

echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth2_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_fleet_ac;

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_fleet_ac;

echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_fleet_ac + $nd_mth2_fleet_ac + $pd_mth2_fleet_ac + $md_mth2_fleet_ac + $sld_mth2_fleet_ac + $kd_mth2_fleet_ac + $gd_mth2_fleet_ac + $ld_mth2_fleet_ac + $td_mth2_fleet_ac + $tpd_mth2_fleet_ac + $hd_mth2_fleet_ac ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_fleet_ac + $nd_mth1_fleet_ac + $pd_mth1_fleet_ac + $md_mth1_fleet_ac + $sld_mth1_fleet_ac + $kd_mth1_fleet_ac + $gd_mth1_fleet_ac + $ld_mth1_fleet_ac + $td_mth1_fleet_ac + $tpd_mth1_fleet_ac + $hd_mth1_fleet_ac ;

 




 

//$pdf->Rect(0, 0, 210, 297, 'F";
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";

echo "NAC NEW";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth2_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_fleet_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_fleet_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_fleet_nac_new;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_fleet_nac_new + $nd_mth2_fleet_nac_new + $pd_mth2_fleet_nac_new + $md_mth2_fleet_nac_new + $sld_mth2_fleet_nac_new + $kd_mth2_fleet_nac_new + $gd_mth2_fleet_nac_new + $ld_mth2_fleet_nac_new + $td_mth2_fleet_nac_new + $tpd_mth2_fleet_nac_new + $hd_mth2_fleet_nac_new ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_fleet_nac_new + $nd_mth1_fleet_nac_new + $pd_mth1_fleet_nac_new + $md_mth1_fleet_nac_new + $sld_mth1_fleet_nac_new + $kd_mth1_fleet_nac_new + $gd_mth1_fleet_nac_new + $ld_mth1_fleet_nac_new + $td_mth1_fleet_nac_new + $tpd_mth1_fleet_nac_new + $hd_mth1_fleet_nac_new ;

 





 


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_fleet_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_fleet_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_fleet_nac_old;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_fleet_nac_old + $nd_mth2_fleet_nac_old + $pd_mth2_fleet_nac_old + $md_mth2_fleet_nac_old + $sld_mth2_fleet_nac_old + $kd_mth2_fleet_nac_old + $gd_mth2_fleet_nac_old + $ld_mth2_fleet_nac_old + $td_mth2_fleet_nac_old + $tpd_mth2_fleet_nac_old + $hd_mth2_fleet_nac_old ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_fleet_nac_old + $nd_mth1_fleet_nac_old + $pd_mth1_fleet_nac_old + $md_mth1_fleet_nac_old + $sld_mth1_fleet_nac_old + $kd_mth1_fleet_nac_old + $gd_mth1_fleet_nac_old + $ld_mth1_fleet_nac_old + $td_mth1_fleet_nac_old + $tpd_mth1_fleet_nac_old + $hd_mth1_fleet_nac_old ;

 




 


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$bd_mth2_fleet_total = $bd_mth2_fleet_nac_old + $bd_mth2_fleet_nac_new + $bd_mth2_fleet_ac;
echo $bd_mth2_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$bd_mth1_fleet_total = $bd_mth1_fleet_nac_old + $bd_mth1_fleet_nac_new + $bd_mth1_fleet_ac;
echo $bd_mth1_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$nd_mth2_fleet_total = $nd_mth2_fleet_nac_old + $nd_mth2_fleet_nac_new + $nd_mth2_fleet_ac;
echo $nd_mth2_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$nd_mth1_fleet_total = $nd_mth1_fleet_nac_old + $nd_mth1_fleet_nac_new + $nd_mth1_fleet_ac;
echo $nd_mth1_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$pd_mth2_fleet_total = $pd_mth2_fleet_nac_old + $pd_mth2_fleet_nac_new + $pd_mth2_fleet_ac;
echo $pd_mth2_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$pd_mth1_fleet_total = $pd_mth1_fleet_nac_old + $pd_mth1_fleet_nac_new + $pd_mth1_fleet_ac;
echo $pd_mth1_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$md_mth2_fleet_total = $md_mth2_fleet_nac_old + $md_mth2_fleet_nac_new + $md_mth2_fleet_ac;
echo $md_mth2_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$md_mth1_fleet_total = $md_mth1_fleet_nac_old + $md_mth1_fleet_nac_new + $md_mth1_fleet_ac;
echo $md_mth1_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$sld_mth2_fleet_total = $sld_mth2_fleet_nac_old + $sld_mth2_fleet_nac_new + $sld_mth2_fleet_ac;
echo $sld_mth2_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$sld_mth1_fleet_total = $sld_mth1_fleet_nac_old + $sld_mth1_fleet_nac_new + $sld_mth1_fleet_ac;
echo $sld_mth1_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$kd_mth2_fleet_total = $kd_mth2_fleet_nac_old + $kd_mth2_fleet_nac_new + $kd_mth2_fleet_ac;
echo $kd_mth2_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$kd_mth1_fleet_total = $kd_mth1_fleet_nac_old + $kd_mth1_fleet_nac_new + $kd_mth1_fleet_ac;
echo $kd_mth1_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$gd_mth2_fleet_total = $gd_mth2_fleet_nac_old + $gd_mth2_fleet_nac_new + $gd_mth2_fleet_ac;
echo $gd_mth2_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$gd_mth1_fleet_total = $gd_mth1_fleet_nac_old + $gd_mth1_fleet_nac_new + $gd_mth1_fleet_ac;
echo $gd_mth1_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$ld_mth2_fleet_total = $ld_mth2_fleet_nac_old + $ld_mth2_fleet_nac_new + $ld_mth2_fleet_ac;
echo $ld_mth2_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$ld_mth1_fleet_total = $ld_mth1_fleet_nac_old + $ld_mth1_fleet_nac_new + $ld_mth1_fleet_ac;
echo $ld_mth1_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$td_mth2_fleet_total = $td_mth2_fleet_nac_old + $td_mth2_fleet_nac_new + $td_mth2_fleet_ac;
echo $td_mth2_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$td_mth1_fleet_total = $td_mth1_fleet_nac_old + $td_mth1_fleet_nac_new + $td_mth1_fleet_ac;
echo $td_mth1_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$tpd_mth2_fleet_total = $tpd_mth2_fleet_nac_old + $tpd_mth2_fleet_nac_new + $tpd_mth2_fleet_ac;
echo $tpd_mth2_fleet_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$tpd_mth1_fleet_total = $tpd_mth1_fleet_nac_old + $tpd_mth1_fleet_nac_new + $tpd_mth1_fleet_ac;
echo $tpd_mth1_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$hd_mth2_fleet_total = $hd_mth2_fleet_nac_old + $hd_mth2_fleet_nac_new + $hd_mth2_fleet_ac;
echo $hd_mth2_fleet_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$hd_mth1_fleet_total = $hd_mth1_fleet_nac_old + $hd_mth1_fleet_nac_new + $hd_mth1_fleet_ac;
echo $hd_mth1_fleet_total;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_fleet_total + $nd_mth2_fleet_total + $pd_mth2_fleet_total + $md_mth2_fleet_total + $sld_mth2_fleet_total + $kd_mth2_fleet_total + $gd_mth2_fleet_total + $ld_mth2_fleet_total + $td_mth2_fleet_total + $tpd_mth2_fleet_total + $hd_mth2_fleet_total ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_fleet_total + $nd_mth1_fleet_total + $pd_mth1_fleet_total + $md_mth1_fleet_total + $sld_mth1_fleet_total + $kd_mth1_fleet_total + $gd_mth1_fleet_total + $ld_mth1_fleet_total + $td_mth1_fleet_total + $tpd_mth1_fleet_total + $hd_mth1_fleet_total ;

 
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "HELDUP";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_heldup;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_heldup;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_heldup;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_heldup + $nd_mth2_heldup + $pd_mth2_heldup + $md_mth2_heldup + $sld_mth2_heldup + $kd_mth2_heldup + $gd_mth2_heldup + $ld_mth2_heldup + $td_mth2_heldup + $tpd_mth2_heldup + $hd_mth2_heldup ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_heldup + $nd_mth1_heldup + $pd_mth1_heldup + $md_mth1_heldup + $sld_mth1_heldup + $kd_mth1_heldup + $gd_mth1_heldup + $ld_mth1_heldup + $td_mth1_heldup + $tpd_mth1_heldup + $hd_mth1_heldup ;

 


     
  

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "RUNNING";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_running;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_running;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_running;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_running + $nd_mth2_running + $pd_mth2_running + $md_mth2_running + $sld_mth2_running + $kd_mth2_running + $gd_mth2_running + $ld_mth2_running + $td_mth2_running + $tpd_mth2_running + $hd_mth2_running ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_running + $nd_mth1_running + $pd_mth1_running + $md_mth1_running + $sld_mth1_running + $kd_mth1_running + $gd_mth1_running + $ld_mth1_running + $td_mth1_running + $tpd_mth1_running + $hd_mth1_running ;

 




 


echo "</td></tr><tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "DAILY AVERAGE OUTSHED (1ST SHIFT)";

 


  


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC ";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_out_1st_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_out_1st_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_out_1st_ac;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_out_1st_ac + $nd_mth2_out_1st_ac + $pd_mth2_out_1st_ac + $md_mth2_out_1st_ac + $sld_mth2_out_1st_ac + $kd_mth2_out_1st_ac + $gd_mth2_out_1st_ac + $ld_mth2_out_1st_ac + $td_mth2_out_1st_ac + $tpd_mth2_out_1st_ac + $hd_mth2_out_1st_ac ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_out_1st_ac + $nd_mth1_out_1st_ac + $pd_mth1_out_1st_ac + $md_mth1_out_1st_ac + $sld_mth1_out_1st_ac + $kd_mth1_out_1st_ac + $gd_mth1_out_1st_ac + $ld_mth1_out_1st_ac + $td_mth1_out_1st_ac + $tpd_mth1_out_1st_ac + $hd_mth1_out_1st_ac ;

 





 


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_out_1st_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_out_1st_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_out_1st_nac_new;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_out_1st_nac_new + $nd_mth2_out_1st_nac_new + $pd_mth2_out_1st_nac_new + $md_mth2_out_1st_nac_new + $sld_mth2_out_1st_nac_new + $kd_mth2_out_1st_nac_new + $gd_mth2_out_1st_nac_new + $ld_mth2_out_1st_nac_new + $td_mth2_out_1st_nac_new + $tpd_mth2_out_1st_nac_new + $hd_mth2_out_1st_nac_new ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_out_1st_nac_new + $nd_mth1_out_1st_nac_new + $pd_mth1_out_1st_nac_new + $md_mth1_out_1st_nac_new + $sld_mth1_out_1st_nac_new + $kd_mth1_out_1st_nac_new + $gd_mth1_out_1st_nac_new + $ld_mth1_out_1st_nac_new + $td_mth1_out_1st_nac_new + $tpd_mth1_out_1st_nac_new + $hd_mth1_out_1st_nac_new ;

 





 


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_out_1st_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_out_1st_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_out_1st_nac_old;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_out_1st_nac_old + $nd_mth2_out_1st_nac_old + $pd_mth2_out_1st_nac_old + $md_mth2_out_1st_nac_old + $sld_mth2_out_1st_nac_old + $kd_mth2_out_1st_nac_old + $gd_mth2_out_1st_nac_old + $ld_mth2_out_1st_nac_old + $td_mth2_out_1st_nac_old + $tpd_mth2_out_1st_nac_old + $hd_mth2_out_1st_nac_old ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_out_1st_nac_old + $nd_mth1_out_1st_nac_old + $pd_mth1_out_1st_nac_old + $md_mth1_out_1st_nac_old + $sld_mth1_out_1st_nac_old + $kd_mth1_out_1st_nac_old + $gd_mth1_out_1st_nac_old + $ld_mth1_out_1st_nac_old + $td_mth1_out_1st_nac_old + $tpd_mth1_out_1st_nac_old + $hd_mth1_out_1st_nac_old ;

 




 


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$bd_mth2_out_1st_total = $bd_mth2_out_1st_nac_old + $bd_mth2_out_1st_nac_new + $bd_mth2_out_1st_ac;
echo $bd_mth2_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$bd_mth1_out_1st_total = $bd_mth1_out_1st_nac_old + $bd_mth1_out_1st_nac_new + $bd_mth1_out_1st_ac;
echo $bd_mth1_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$nd_mth2_out_1st_total = $nd_mth2_out_1st_nac_old + $nd_mth2_out_1st_nac_new + $nd_mth2_out_1st_ac;
echo $nd_mth2_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$nd_mth1_out_1st_total = $nd_mth1_out_1st_nac_old + $nd_mth1_out_1st_nac_new + $nd_mth1_out_1st_ac;
echo $nd_mth1_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$pd_mth2_out_1st_total = $pd_mth2_out_1st_nac_old + $pd_mth2_out_1st_nac_new + $pd_mth2_out_1st_ac;
echo $pd_mth2_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$pd_mth1_out_1st_total = $pd_mth1_out_1st_nac_old + $pd_mth1_out_1st_nac_new + $pd_mth1_out_1st_ac;
echo $pd_mth1_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$md_mth2_out_1st_total = $md_mth2_out_1st_nac_old + $md_mth2_out_1st_nac_new + $md_mth2_out_1st_ac;
echo $md_mth2_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$md_mth1_out_1st_total = $md_mth1_out_1st_nac_old + $md_mth1_out_1st_nac_new + $md_mth1_out_1st_ac;
echo $md_mth1_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$sld_mth2_out_1st_total = $sld_mth2_out_1st_nac_old + $sld_mth2_out_1st_nac_new + $sld_mth2_out_1st_ac;
echo $sld_mth2_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$sld_mth1_out_1st_total = $sld_mth1_out_1st_nac_old + $sld_mth1_out_1st_nac_new + $sld_mth1_out_1st_ac;
echo $sld_mth1_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$kd_mth2_out_1st_total = $kd_mth2_out_1st_nac_old + $kd_mth2_out_1st_nac_new + $kd_mth2_out_1st_ac;
echo $kd_mth2_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$kd_mth1_out_1st_total = $kd_mth1_out_1st_nac_old + $kd_mth1_out_1st_nac_new + $kd_mth1_out_1st_ac;
echo $kd_mth1_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$gd_mth2_out_1st_total = $gd_mth2_out_1st_nac_old + $gd_mth2_out_1st_nac_new + $gd_mth2_out_1st_ac;
echo $gd_mth2_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$gd_mth1_out_1st_total = $gd_mth1_out_1st_nac_old + $gd_mth1_out_1st_nac_new + $gd_mth1_out_1st_ac;
echo $gd_mth1_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$ld_mth2_out_1st_total = $ld_mth2_out_1st_nac_old + $ld_mth2_out_1st_nac_new + $ld_mth2_out_1st_ac;
echo $ld_mth2_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$ld_mth1_out_1st_total = $ld_mth1_out_1st_nac_old + $ld_mth1_out_1st_nac_new + $ld_mth1_out_1st_ac;
echo $ld_mth1_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$td_mth2_out_1st_total = $td_mth2_out_1st_nac_old + $td_mth2_out_1st_nac_new + $td_mth2_out_1st_ac;
echo $td_mth2_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$td_mth1_out_1st_total = $td_mth1_out_1st_nac_old + $td_mth1_out_1st_nac_new + $td_mth1_out_1st_ac;
echo $td_mth1_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$tpd_mth2_out_1st_total = $tpd_mth2_out_1st_nac_old + $tpd_mth2_out_1st_nac_new + $tpd_mth2_out_1st_ac;
echo $tpd_mth2_out_1st_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$tpd_mth1_out_1st_total = $tpd_mth1_out_1st_nac_old + $tpd_mth1_out_1st_nac_new + $tpd_mth1_out_1st_ac;
echo $tpd_mth1_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$hd_mth2_out_1st_total = $hd_mth2_out_1st_nac_old + $hd_mth2_out_1st_nac_new + $hd_mth2_out_1st_ac;
echo $hd_mth2_out_1st_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$hd_mth1_out_1st_total = $hd_mth1_out_1st_nac_old + $hd_mth1_out_1st_nac_new + $hd_mth1_out_1st_ac;
echo $hd_mth1_out_1st_total;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_out_1st_total + $nd_mth2_out_1st_total + $pd_mth2_out_1st_total + $md_mth2_out_1st_total + $sld_mth2_out_1st_total + $kd_mth2_out_1st_total + $gd_mth2_out_1st_total + $ld_mth2_out_1st_total + $td_mth2_out_1st_total + $tpd_mth2_out_1st_total + $hd_mth2_out_1st_total ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_out_1st_total + $nd_mth1_out_1st_total + $pd_mth1_out_1st_total + $md_mth1_out_1st_total + $sld_mth1_out_1st_total + $kd_mth1_out_1st_total + $gd_mth1_out_1st_total + $ld_mth1_out_1st_total + $td_mth1_out_1st_total + $tpd_mth1_out_1st_total + $hd_mth1_out_1st_total ;





echo "</td></tr>";
//echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
//echo "DAILY AVERAGE SUPPLY (1ST SHIFT)";
 




     
 


//echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
//echo "TOTAL";

//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$bd_mth2_out_1st_total = $bd_mth2_out_1st_nac_old + $bd_mth2_out_1st_nac_new + $bd_mth2_out_1st_ac;
//echo $bd_mth2_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$bd_mth1_out_1st_total = $bd_mth1_out_1st_nac_old + $bd_mth1_out_1st_nac_new + $bd_mth1_out_1st_ac;
//echo $bd_mth1_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$nd_mth2_out_1st_total = $nd_mth2_out_1st_nac_old + $nd_mth2_out_1st_nac_new + $nd_mth2_out_1st_ac;
//echo $nd_mth2_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$nd_mth1_out_1st_total = $nd_mth1_out_1st_nac_old + $nd_mth1_out_1st_nac_new + $nd_mth1_out_1st_ac;
//echo $nd_mth1_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$pd_mth2_out_1st_total = $pd_mth2_out_1st_nac_old + $pd_mth2_out_1st_nac_new + $pd_mth2_out_1st_ac;
//echo $pd_mth2_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$pd_mth1_out_1st_total = $pd_mth1_out_1st_nac_old + $pd_mth1_out_1st_nac_new + $pd_mth1_out_1st_ac;
//echo $pd_mth1_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$md_mth2_out_1st_total = $md_mth2_out_1st_nac_old + $md_mth2_out_1st_nac_new + $md_mth2_out_1st_ac;
//echo $md_mth2_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$md_mth1_out_1st_total = $md_mth1_out_1st_nac_old + $md_mth1_out_1st_nac_new + $md_mth1_out_1st_ac;
//echo $md_mth1_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$sld_mth2_out_1st_total = $sld_mth2_out_1st_nac_old + $sld_mth2_out_1st_nac_new + $sld_mth2_out_1st_ac;
//echo $sld_mth2_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$sld_mth1_out_1st_total = $sld_mth1_out_1st_nac_old + $sld_mth1_out_1st_nac_new + $sld_mth1_out_1st_ac;
//echo $sld_mth1_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$kd_mth2_out_1st_total = $kd_mth2_out_1st_nac_old + $kd_mth2_out_1st_nac_new + $kd_mth2_out_1st_ac;
//echo $kd_mth2_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$kd_mth1_out_1st_total = $kd_mth1_out_1st_nac_old + $kd_mth1_out_1st_nac_new + $kd_mth1_out_1st_ac;
//echo $kd_mth1_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$gd_mth2_out_1st_total = $gd_mth2_out_1st_nac_old + $gd_mth2_out_1st_nac_new + $gd_mth2_out_1st_ac;
//echo $gd_mth2_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$gd_mth1_out_1st_total = $gd_mth1_out_1st_nac_old + $gd_mth1_out_1st_nac_new + $gd_mth1_out_1st_ac;
//echo $gd_mth1_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$ld_mth2_out_1st_total = $ld_mth2_out_1st_nac_old + $ld_mth2_out_1st_nac_new + $ld_mth2_out_1st_ac;
//echo $ld_mth2_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$ld_mth1_out_1st_total = $ld_mth1_out_1st_nac_old + $ld_mth1_out_1st_nac_new + $ld_mth1_out_1st_ac;
//echo $ld_mth1_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$td_mth2_out_1st_total = $td_mth2_out_1st_nac_old + $td_mth2_out_1st_nac_new + $td_mth2_out_1st_ac;
//echo $td_mth2_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$td_mth1_out_1st_total = $td_mth1_out_1st_nac_old + $td_mth1_out_1st_nac_new + $td_mth1_out_1st_ac;
//echo $td_mth1_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$tpd_mth2_out_1st_total = $tpd_mth2_out_1st_nac_old + $tpd_mth2_out_1st_nac_new + $tpd_mth2_out_1st_ac;
//echo $tpd_mth2_supply_1st_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$tpd_mth1_out_1st_total = $tpd_mth1_out_1st_nac_old + $tpd_mth1_out_1st_nac_new + $tpd_mth1_out_1st_ac;
//echo $td_mth1_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$hd_mth2_out_1st_total = $hd_mth2_out_1st_nac_old + $hd_mth2_out_1st_nac_new + $hd_mth2_out_1st_ac;
//echo $hd_mth2_supply_1st_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$hd_mth1_out_1st_total = $hd_mth1_out_1st_nac_old + $hd_mth1_out_1st_nac_new + $hd_mth1_out_1st_ac;
//echo $hd_mth1_supply_1st_tot;
//echo "</td><td style='background: yellow;font-size: 8.5px;'>";

//echo $bd_mth2_supply_1st_tot + $nd_mth2_supply_1st_tot + $pd_mth2_supply_1st_tot + $md_mth2_supply_1st_tot + $sld_mth2_supply_1st_tot + $kd_mth2_supply_1st_tot + $gd_mth2_supply_1st_tot + $ld_mth2_supply_1st_tot + $td_mth2_supply_1st_tot + $tpd_mth2_supply_1st_tot + $hd_mth2_supply_1st_tot ;
//echo "</td><td style='background: yellow;font-size: 8.5px;'>";
//echo $bd_mth1_supply_1st_tot + $nd_mth1_supply_1st_tot + $pd_mth1_supply_1st_tot + $md_mth1_supply_1st_tot + $sld_mth1_supply_1st_tot + $kd_mth1_supply_1st_tot + $gd_mth1_supply_1st_tot + $ld_mth1_supply_1st_tot + $td_mth1_supply_1st_tot + $tpd_mth1_supply_1st_tot + $hd_mth1_supply_1st_tot ;

 



  
   
 
//echo "</td></tr>";
echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "DAILY AVERAGE OUTSHED (2ND SHIFT)";
 



  
     
      
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC ";
  
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_out_2nd_ac;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_out_2nd_ac;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_out_2nd_ac;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_out_2nd_ac + $nd_mth2_out_2nd_ac + $pd_mth2_out_2nd_ac + $md_mth2_out_2nd_ac + $sld_mth2_out_2nd_ac + $kd_mth2_out_2nd_ac + $gd_mth2_out_2nd_ac + $ld_mth2_out_2nd_ac + $td_mth2_out_2nd_ac + $tpd_mth2_out_2nd_ac + $hd_mth2_out_2nd_ac ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
echo $bd_mth1_out_2nd_ac + $nd_mth1_out_2nd_ac + $pd_mth1_out_2nd_ac + $md_mth1_out_2nd_ac + $sld_mth1_out_2nd_ac + $kd_mth1_out_2nd_ac + $gd_mth1_out_2nd_ac + $ld_mth1_out_2nd_ac + $td_mth1_out_2nd_ac + $tpd_mth1_out_2nd_ac + $hd_mth1_out_2nd_ac ;

 




 

  
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW";
  
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_out_2nd_nac_new;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_out_2nd_nac_new;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_out_2nd_nac_new + $nd_mth2_out_2nd_nac_new + $pd_mth2_out_2nd_nac_new + $md_mth2_out_2nd_nac_new + $sld_mth2_out_2nd_nac_new + $kd_mth2_out_2nd_nac_new + $gd_mth2_out_2nd_nac_new + $ld_mth2_out_2nd_nac_new + $td_mth2_out_2nd_nac_new + $tpd_mth2_out_2nd_nac_new + $hd_mth2_out_2nd_nac_new ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_out_2nd_nac_new + $nd_mth1_out_2nd_nac_new + $pd_mth1_out_2nd_nac_new + $md_mth1_out_2nd_nac_new + $sld_mth1_out_2nd_nac_new + $kd_mth1_out_2nd_nac_new + $gd_mth1_out_2nd_nac_new + $ld_mth1_out_2nd_nac_new + $td_mth1_out_2nd_nac_new + $tpd_mth1_out_2nd_nac_new + $hd_mth1_out_2nd_nac_new ;

 




 

  
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD";
  
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $bd_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $bd_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $nd_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $nd_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $pd_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $pd_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $md_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $md_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $sld_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $sld_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $kd_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $kd_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $gd_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $gd_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $ld_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $ld_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $td_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $td_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

echo $tpd_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
echo $tpd_mth1_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

echo $hd_mth2_out_2nd_nac_old;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
echo $hd_mth1_out_2nd_nac_old;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_out_2nd_nac_old + $nd_mth2_out_2nd_nac_old + $pd_mth2_out_2nd_nac_old + $md_mth2_out_2nd_nac_old + $sld_mth2_out_2nd_nac_old + $kd_mth2_out_2nd_nac_old + $gd_mth2_out_2nd_nac_old + $ld_mth2_out_2nd_nac_old + $td_mth2_out_2nd_nac_old + $tpd_mth2_out_2nd_nac_old + $hd_mth2_out_2nd_nac_old ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_out_2nd_nac_old + $nd_mth1_out_2nd_nac_old + $pd_mth1_out_2nd_nac_old + $md_mth1_out_2nd_nac_old + $sld_mth1_out_2nd_nac_old + $kd_mth1_out_2nd_nac_old + $gd_mth1_out_2nd_nac_old + $ld_mth1_out_2nd_nac_old + $td_mth1_out_2nd_nac_old + $tpd_mth1_out_2nd_nac_old + $hd_mth1_out_2nd_nac_old ;

 



 

  
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL";
  
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$bd_mth2_out_2nd_total = $bd_mth2_out_2nd_nac_old + $bd_mth2_out_2nd_nac_new + $bd_mth2_out_2nd_ac;
echo $bd_mth2_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$bd_mth1_out_2nd_total = $bd_mth1_out_2nd_nac_old + $bd_mth1_out_2nd_nac_new + $bd_mth1_out_2nd_ac;
echo $bd_mth1_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$nd_mth2_out_2nd_total = $nd_mth2_out_2nd_nac_old + $nd_mth2_out_2nd_nac_new + $nd_mth2_out_2nd_ac;
echo $nd_mth2_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$nd_mth1_out_2nd_total = $nd_mth1_out_2nd_nac_old + $nd_mth1_out_2nd_nac_new + $nd_mth1_out_2nd_ac;
echo $nd_mth1_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$pd_mth2_out_2nd_total = $pd_mth2_out_2nd_nac_old + $pd_mth2_out_2nd_nac_new + $pd_mth2_out_2nd_ac;
echo $pd_mth2_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$pd_mth1_out_2nd_total = $pd_mth1_out_2nd_nac_old + $pd_mth1_out_2nd_nac_new + $pd_mth1_out_2nd_ac;
echo $pd_mth1_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$md_mth2_out_2nd_total = $md_mth2_out_2nd_nac_old + $md_mth2_out_2nd_nac_new + $md_mth2_out_2nd_ac;
echo $md_mth2_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$md_mth1_out_2nd_total = $md_mth1_out_2nd_nac_old + $md_mth1_out_2nd_nac_new + $md_mth1_out_2nd_ac;
echo $md_mth1_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$sld_mth2_out_2nd_total = $sld_mth2_out_2nd_nac_old + $sld_mth2_out_2nd_nac_new + $sld_mth2_out_2nd_ac;
echo $sld_mth2_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$sld_mth1_out_2nd_total = $sld_mth1_out_2nd_nac_old + $sld_mth1_out_2nd_nac_new + $sld_mth1_out_2nd_ac;
echo $sld_mth1_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$kd_mth2_out_2nd_total = $kd_mth2_out_2nd_nac_old + $kd_mth2_out_2nd_nac_new + $kd_mth2_out_2nd_ac;
echo $kd_mth2_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$kd_mth1_out_2nd_total = $kd_mth1_out_2nd_nac_old + $kd_mth1_out_2nd_nac_new + $kd_mth1_out_2nd_ac;
echo $kd_mth1_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$gd_mth2_out_2nd_total = $gd_mth2_out_2nd_nac_old + $gd_mth2_out_2nd_nac_new + $gd_mth2_out_2nd_ac;
echo $gd_mth2_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$gd_mth1_out_2nd_total = $gd_mth1_out_2nd_nac_old + $gd_mth1_out_2nd_nac_new + $gd_mth1_out_2nd_ac;
echo $gd_mth1_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$ld_mth2_out_2nd_total = $ld_mth2_out_2nd_nac_old + $ld_mth2_out_2nd_nac_new + $ld_mth2_out_2nd_ac;
echo $ld_mth2_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$ld_mth1_out_2nd_total = $ld_mth1_out_2nd_nac_old + $ld_mth1_out_2nd_nac_new + $ld_mth1_out_2nd_ac;
echo $ld_mth1_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$td_mth2_out_2nd_total = $td_mth2_out_2nd_nac_old + $td_mth2_out_2nd_nac_new + $td_mth2_out_2nd_ac;
echo $td_mth2_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$td_mth1_out_2nd_total = $td_mth1_out_2nd_nac_old + $td_mth1_out_2nd_nac_new + $td_mth1_out_2nd_ac;
echo $td_mth1_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

$tpd_mth2_out_2nd_total = $tpd_mth2_out_2nd_nac_old + $tpd_mth2_out_2nd_nac_new + $tpd_mth2_out_2nd_ac;
echo $tpd_mth2_out_2nd_total;
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
$tpd_mth1_out_2nd_total = $tpd_mth1_out_2nd_nac_old + $tpd_mth1_out_2nd_nac_new + $tpd_mth1_out_2nd_ac;
echo $tpd_mth1_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$hd_mth2_out_2nd_total = $hd_mth2_out_2nd_nac_old + $hd_mth2_out_2nd_nac_new + $hd_mth2_out_2nd_ac;
echo $hd_mth2_out_2nd_total;
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
$hd_mth1_out_2nd_total = $hd_mth1_out_2nd_nac_old + $hd_mth1_out_2nd_nac_new + $hd_mth1_out_2nd_ac;
echo $hd_mth1_out_2nd_total;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

echo $bd_mth2_out_2nd_total + $nd_mth2_out_2nd_total + $pd_mth2_out_2nd_total + $md_mth2_out_2nd_total + $sld_mth2_out_2nd_total + $kd_mth2_out_2nd_total + $gd_mth2_out_2nd_total + $ld_mth2_out_2nd_total + $td_mth2_out_2nd_total + $tpd_mth2_out_2nd_total + $hd_mth2_out_2nd_total ;
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
echo $bd_mth1_out_2nd_total + $nd_mth1_out_2nd_total + $pd_mth1_out_2nd_total + $md_mth1_out_2nd_total + $sld_mth1_out_2nd_total + $kd_mth1_out_2nd_total + $gd_mth1_out_2nd_total + $ld_mth1_out_2nd_total + $td_mth1_out_2nd_total + $tpd_mth1_out_2nd_total + $hd_mth1_out_2nd_total;

 



     
 


echo "</td></tr>";
//echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
//echo "DAILY AVERAGE SUPPLY (2ND SHIFT)";
 



     
 

//echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";

//echo "TOTAL";

//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$bd_mth2_out_2nd_total = $bd_mth2_out_2nd_nac_old + $bd_mth2_out_2nd_nac_new + $bd_mth2_out_2nd_ac;
//echo $bd_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$bd_mth1_out_2nd_total = $bd_mth1_out_2nd_nac_old + $bd_mth1_out_2nd_nac_new + $bd_mth1_out_2nd_ac;
//echo $bd_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$nd_mth2_out_2nd_total = $nd_mth2_out_2nd_nac_old + $nd_mth2_out_2nd_nac_new + $nd_mth2_out_2nd_ac;
//echo $nd_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$nd_mth1_out_2nd_total = $nd_mth1_out_2nd_nac_old + $nd_mth1_out_2nd_nac_new + $nd_mth1_out_2nd_ac;
//echo $nd_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$pd_mth2_out_2nd_total = $pd_mth2_out_2nd_nac_old + $pd_mth2_out_2nd_nac_new + $pd_mth2_out_2nd_ac;
//echo $pd_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$pd_mth1_out_2nd_total = $pd_mth1_out_2nd_nac_old + $pd_mth1_out_2nd_nac_new + $pd_mth1_out_2nd_ac;
//echo $pd_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$md_mth2_out_2nd_total = $md_mth2_out_2nd_nac_old + $md_mth2_out_2nd_nac_new + $md_mth2_out_2nd_ac;
//echo $md_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$md_mth1_out_2nd_total = $md_mth1_out_2nd_nac_old + $md_mth1_out_2nd_nac_new + $md_mth1_out_2nd_ac;
//echo $md_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$sld_mth2_out_2nd_total = $sld_mth2_out_2nd_nac_old + $sld_mth2_out_2nd_nac_new + $sld_mth2_out_2nd_ac;
//echo $sld_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$sld_mth1_out_2nd_total = $sld_mth1_out_2nd_nac_old + $sld_mth1_out_2nd_nac_new + $sld_mth1_out_2nd_ac;
//echo $sld_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$kd_mth2_out_2nd_total = $kd_mth2_out_2nd_nac_old + $kd_mth2_out_2nd_nac_new + $kd_mth2_out_2nd_ac;
//echo $kd_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$kd_mth1_out_2nd_total = $kd_mth1_out_2nd_nac_old + $kd_mth1_out_2nd_nac_new + $kd_mth1_out_2nd_ac;
//echo $kd_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$gd_mth2_out_2nd_total = $gd_mth2_out_2nd_nac_old + $gd_mth2_out_2nd_nac_new + $gd_mth2_out_2nd_ac;
//echo $gd_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$gd_mth1_out_2nd_total = $gd_mth1_out_2nd_nac_old + $gd_mth1_out_2nd_nac_new + $gd_mth1_out_2nd_ac;
//echo $gd_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$ld_mth2_out_2nd_total = $ld_mth2_out_2nd_nac_old + $ld_mth2_out_2nd_nac_new + $ld_mth2_out_2nd_ac;
//echo $ld_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$ld_mth1_out_2nd_total = $ld_mth1_out_2nd_nac_old + $ld_mth1_out_2nd_nac_new + $ld_mth1_out_2nd_ac;
//echo $ld_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$td_mth2_out_2nd_total = $td_mth2_out_2nd_nac_old + $td_mth2_out_2nd_nac_new + $td_mth2_out_2nd_ac;
//echo $td_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$td_mth1_out_2nd_total = $td_mth1_out_2nd_nac_old + $td_mth1_out_2nd_nac_new + $td_mth1_out_2nd_ac;
//echo $td_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//$tpd_mth2_out_2nd_total = $tpd_mth2_out_2nd_nac_old + $tpd_mth2_out_2nd_nac_new + $tpd_mth2_out_2nd_ac;
//echo $tpd_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
//$tpd_mth1_out_2nd_total = $tpd_mth1_out_2nd_nac_old + $tpd_mth1_out_2nd_nac_new + $tpd_mth1_out_2nd_ac;
//echo $td_mth1_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

//$hd_mth2_out_2nd_total = $hd_mth2_out_2nd_nac_old + $hd_mth2_out_2nd_nac_new + $hd_mth2_out_2nd_ac;
//echo $hd_mth2_supply_2nd_tot;
//echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
//$hd_mth1_out_2nd_total = $hd_mth1_out_2nd_nac_old + $hd_mth1_out_2nd_nac_new + $hd_mth1_out_2nd_ac;
//echo $hd_mth1_supply_2nd_tot;
//echo "</td><td style='background: yellow;font-size: 8.5px;'>";

//echo $bd_mth2_supply_2nd_tot + $nd_mth2_supply_2nd_tot + $pd_mth2_supply_2nd_tot + $md_mth2_supply_2nd_tot + $sld_mth2_supply_2nd_tot + $kd_mth2_supply_2nd_tot + $gd_mth2_supply_2nd_tot + $ld_mth2_supply_2nd_tot + $td_mth2_supply_2nd_tot + $tpd_mth2_supply_2nd_tot + $hd_mth2_supply_2nd_tot ;
//echo "</td><td style='background: yellow;font-size: 8.5px;'>";
//echo $bd_mth1_supply_2nd_tot + $nd_mth1_supply_2nd_tot + $pd_mth1_supply_2nd_tot + $md_mth1_supply_2nd_tot + $sld_mth1_supply_2nd_tot + $kd_mth1_supply_2nd_tot + $gd_mth1_supply_2nd_tot + $ld_mth1_supply_2nd_tot + $td_mth1_supply_2nd_tot + $tpd_mth1_supply_2nd_tot + $hd_mth1_supply_2nd_tot ;


     
//$y = $y + .1; 
//echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

//***********************************************************
//**********************************************************



	

//echo "</td></tr>";
echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "DAILY AVERAGE TRIP LOSS (%)";





	

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($bd_mth2_act_trip_ac / $bd_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($bd_mth1_act_trip_ac / $bd_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($nd_mth2_act_trip_ac / $nd_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($nd_mth1_act_trip_ac / $nd_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($pd_mth2_act_trip_ac / $pd_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($pd_mth1_act_trip_ac / $pd_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($md_mth2_act_trip_ac / $md_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($md_mth1_act_trip_ac / $md_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($sld_mth2_act_trip_ac / $sld_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($sld_mth1_act_trip_ac / $sld_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($kd_mth2_act_trip_ac / $kd_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($kd_mth1_act_trip_ac / $kd_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($gd_mth2_act_trip_ac / $gd_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($gd_mth1_act_trip_ac / $gd_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($ld_mth2_act_trip_ac / $ld_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($ld_mth1_act_trip_ac / $ld_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($td_mth2_act_trip_ac / $td_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($td_mth1_act_trip_ac / $td_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($tpd_mth2_act_trip_ac / $tpd_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($tpd_mth1_act_trip_ac / $tpd_mth1_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sch_trip_ac > 0){
echo number_format(100 * (1 - ($hd_mth2_act_trip_ac / $hd_mth2_sch_trip_ac)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sch_trip_ac > 0){
echo number_format(100 * (1 - ($hd_mth1_act_trip_ac / $hd_mth1_sch_trip_ac)),1);}


$xx_act_mth2_ac = $bd_mth2_act_trip_ac + $nd_mth2_act_trip_ac + $pd_mth2_act_trip_ac+ $md_mth2_act_trip_ac + $sld_mth2_act_trip_ac + $kd_mth2_act_trip_ac + $gd_mth2_act_trip_ac + $ld_mth2_act_trip_ac + $td_mth2_act_trip_ac + $tpd_mth2_act_trip_ac + $hd_mth2_act_trip_ac;
$xx_sch_mth2_ac = $bd_mth2_sch_trip_ac + $nd_mth2_sch_trip_ac + $pd_mth2_sch_trip_ac+ $md_mth2_sch_trip_ac + $sld_mth2_act_trip_ac + $kd_mth2_sch_trip_ac + $gd_mth2_sch_trip_ac + $ld_mth2_sch_trip_ac + $td_mth2_sch_trip_ac + $tpd_mth2_sch_trip_ac + $hd_mth2_sch_trip_ac;

$xx_act_mth1_ac = $bd_mth1_act_trip_ac + $nd_mth1_act_trip_ac + $pd_mth1_act_trip_ac+ $md_mth1_act_trip_ac + $sld_mth1_act_trip_ac + $kd_mth1_act_trip_ac + $gd_mth1_act_trip_ac + $ld_mth1_act_trip_ac + $td_mth1_act_trip_ac + $tpd_mth1_act_trip_ac + $hd_mth1_act_trip_ac;
$xx_sch_mth1_ac = $bd_mth1_sch_trip_ac + $nd_mth1_sch_trip_ac + $pd_mth1_sch_trip_ac+ $md_mth1_sch_trip_ac + $sld_mth1_act_trip_ac + $kd_mth1_sch_trip_ac + $gd_mth1_sch_trip_ac + $ld_mth1_sch_trip_ac + $td_mth1_sch_trip_ac + $tpd_mth1_sch_trip_ac + $hd_mth1_sch_trip_ac;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($xx_sch_mth2_ac > 0){
echo number_format(100 * (1 - ($xx_act_mth2_ac / $xx_sch_mth2_ac)),1);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($xx_sch_mth1_ac > 0){
echo number_format(100 * (1 - ($xx_act_mth1_ac / $xx_sch_mth1_ac)),1);}


 


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($bd_mth2_act_trip_nac_new / $bd_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($bd_mth1_act_trip_nac_new / $bd_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($nd_mth2_act_trip_nac_new / $nd_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($nd_mth1_act_trip_nac_new / $nd_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($pd_mth2_act_trip_nac_new / $pd_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($pd_mth1_act_trip_nac_new / $pd_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($md_mth2_act_trip_nac_new / $md_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($md_mth1_act_trip_nac_new / $md_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($sld_mth2_act_trip_nac_new / $sld_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($sld_mth1_act_trip_nac_new / $sld_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($kd_mth2_act_trip_nac_new / $kd_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($kd_mth1_act_trip_nac_new / $kd_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($gd_mth2_act_trip_nac_new / $gd_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($gd_mth1_act_trip_nac_new / $gd_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($ld_mth2_act_trip_nac_new / $ld_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($ld_mth1_act_trip_nac_new / $ld_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($td_mth2_act_trip_nac_new / $td_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($td_mth1_act_trip_nac_new / $td_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($tpd_mth2_act_trip_nac_new / $tpd_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($tpd_mth1_act_trip_nac_new / $tpd_mth1_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($hd_mth2_act_trip_nac_new / $hd_mth2_sch_trip_nac_new)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sch_trip_nac_new > 0){
echo number_format(100 * (1 - ($hd_mth1_act_trip_nac_new / $hd_mth1_sch_trip_nac_new)),1);}


$xx_act_mth2_nac_new = $bd_mth2_act_trip_nac_new + $nd_mth2_act_trip_nac_new + $pd_mth2_act_trip_nac_new+ $md_mth2_act_trip_nac_new + $sld_mth2_act_trip_nac_new + $kd_mth2_act_trip_nac_new + $gd_mth2_act_trip_nac_new + $ld_mth2_act_trip_nac_new + $td_mth2_act_trip_nac_new + $tpd_mth2_act_trip_nac_new + $hd_mth2_act_trip_nac_new;
$xx_sch_mth2_nac_new = $bd_mth2_sch_trip_nac_new + $nd_mth2_sch_trip_nac_new + $pd_mth2_sch_trip_nac_new+ $md_mth2_sch_trip_nac_new + $sld_mth2_act_trip_nac_new + $kd_mth2_sch_trip_nac_new + $gd_mth2_sch_trip_nac_new + $ld_mth2_sch_trip_nac_new + $td_mth2_sch_trip_nac_new + $tpd_mth2_sch_trip_nac_new + $hd_mth2_sch_trip_nac_new;

$xx_act_mth1_nac_new = $bd_mth1_act_trip_nac_new + $nd_mth1_act_trip_nac_new + $pd_mth1_act_trip_nac_new+ $md_mth1_act_trip_nac_new + $sld_mth1_act_trip_nac_new + $kd_mth1_act_trip_nac_new + $gd_mth1_act_trip_nac_new + $ld_mth1_act_trip_nac_new + $td_mth1_act_trip_nac_new + $tpd_mth1_act_trip_nac_new + $hd_mth1_act_trip_nac_new;
$xx_sch_mth1_nac_new = $bd_mth1_sch_trip_nac_new + $nd_mth1_sch_trip_nac_new + $pd_mth1_sch_trip_nac_new+ $md_mth1_sch_trip_nac_new + $sld_mth1_act_trip_nac_new + $kd_mth1_sch_trip_nac_new + $gd_mth1_sch_trip_nac_new + $ld_mth1_sch_trip_nac_new + $td_mth1_sch_trip_nac_new + $tpd_mth1_sch_trip_nac_new + $hd_mth1_sch_trip_nac_new;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($xx_sch_mth2_nac_new > 0){
echo number_format(100 * (1 - ($xx_act_mth2_nac_new / $xx_sch_mth2_nac_new)),1);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($xx_sch_mth1_nac_new > 0){
echo number_format(100 * (1 - ($xx_act_mth1_nac_new / $xx_sch_mth1_nac_new)),1);}


 







echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($bd_mth2_act_trip_nac_old / $bd_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($bd_mth1_act_trip_nac_old / $bd_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($nd_mth2_act_trip_nac_old / $nd_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($nd_mth1_act_trip_nac_old / $nd_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($pd_mth2_act_trip_nac_old / $pd_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($pd_mth1_act_trip_nac_old / $pd_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($md_mth2_act_trip_nac_old / $md_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($md_mth1_act_trip_nac_old / $md_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($sld_mth2_act_trip_nac_old / $sld_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($sld_mth1_act_trip_nac_old / $sld_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($kd_mth2_act_trip_nac_old / $kd_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($kd_mth1_act_trip_nac_old / $kd_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($gd_mth2_act_trip_nac_old / $gd_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($gd_mth1_act_trip_nac_old / $gd_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($ld_mth2_act_trip_nac_old / $ld_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($ld_mth1_act_trip_nac_old / $ld_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($td_mth2_act_trip_nac_old / $td_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($td_mth1_act_trip_nac_old / $td_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($tpd_mth2_act_trip_nac_old / $tpd_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($tpd_mth1_act_trip_nac_old / $tpd_mth1_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($hd_mth2_act_trip_nac_old / $hd_mth2_sch_trip_nac_old)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sch_trip_nac_old > 0){
echo number_format(100 * (1 - ($hd_mth1_act_trip_nac_old / $hd_mth1_sch_trip_nac_old)),1);}


$xx_act_mth2_nac_old = $bd_mth2_act_trip_nac_old + $nd_mth2_act_trip_nac_old + $pd_mth2_act_trip_nac_old+ $md_mth2_act_trip_nac_old + $sld_mth2_act_trip_nac_old + $kd_mth2_act_trip_nac_old + $gd_mth2_act_trip_nac_old + $ld_mth2_act_trip_nac_old + $td_mth2_act_trip_nac_old + $tpd_mth2_act_trip_nac_old + $hd_mth2_act_trip_nac_old;
$xx_sch_mth2_nac_old = $bd_mth2_sch_trip_nac_old + $nd_mth2_sch_trip_nac_old + $pd_mth2_sch_trip_nac_old+ $md_mth2_sch_trip_nac_old + $sld_mth2_act_trip_nac_old + $kd_mth2_sch_trip_nac_old + $gd_mth2_sch_trip_nac_old + $ld_mth2_sch_trip_nac_old + $td_mth2_sch_trip_nac_old + $tpd_mth2_sch_trip_nac_old + $hd_mth2_sch_trip_nac_old;

$xx_act_mth1_nac_old = $bd_mth1_act_trip_nac_old + $nd_mth1_act_trip_nac_old + $pd_mth1_act_trip_nac_old+ $md_mth1_act_trip_nac_old + $sld_mth1_act_trip_nac_old + $kd_mth1_act_trip_nac_old + $gd_mth1_act_trip_nac_old + $ld_mth1_act_trip_nac_old + $td_mth1_act_trip_nac_old + $tpd_mth1_act_trip_nac_old + $hd_mth1_act_trip_nac_old;
$xx_sch_mth1_nac_old = $bd_mth1_sch_trip_nac_old + $nd_mth1_sch_trip_nac_old + $pd_mth1_sch_trip_nac_old+ $md_mth1_sch_trip_nac_old + $sld_mth1_act_trip_nac_old + $kd_mth1_sch_trip_nac_old + $gd_mth1_sch_trip_nac_old + $ld_mth1_sch_trip_nac_old + $td_mth1_sch_trip_nac_old + $tpd_mth1_sch_trip_nac_old + $hd_mth1_sch_trip_nac_old;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($xx_sch_mth2_nac_old > 0){
echo number_format(100 * (1 - ($xx_act_mth2_nac_old / $xx_sch_mth2_nac_old)),1);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($xx_sch_mth1_nac_old > 0){
echo number_format(100 * (1 - ($xx_act_mth1_nac_old / $xx_sch_mth1_nac_old)),1);}

 







echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($bd_mth2_act_trip_tot / $bd_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($bd_mth1_act_trip_tot / $bd_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($nd_mth2_act_trip_tot / $nd_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($nd_mth1_act_trip_tot / $nd_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($pd_mth2_act_trip_tot / $pd_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($pd_mth1_act_trip_tot / $pd_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($md_mth2_act_trip_tot / $md_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($md_mth1_act_trip_tot / $md_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($sld_mth2_act_trip_tot / $sld_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($sld_mth1_act_trip_tot / $sld_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($kd_mth2_act_trip_tot / $kd_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($kd_mth1_act_trip_tot / $kd_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($gd_mth2_act_trip_tot / $gd_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($gd_mth1_act_trip_tot / $gd_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($ld_mth2_act_trip_tot / $ld_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($ld_mth1_act_trip_tot / $ld_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($td_mth2_act_trip_tot / $td_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($td_mth1_act_trip_tot / $td_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($tpd_mth2_act_trip_tot / $tpd_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($tpd_mth1_act_trip_tot / $tpd_mth1_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sch_trip_tot > 0){
echo number_format(100 * (1 - ($hd_mth2_act_trip_tot / $hd_mth2_sch_trip_tot)),1);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sch_trip_tot > 0){
echo number_format(100 * (1 - ($hd_mth1_act_trip_tot / $hd_mth1_sch_trip_tot)),1);}


$xx_act_mth2_tot = $bd_mth2_act_trip_tot + $nd_mth2_act_trip_tot + $pd_mth2_act_trip_tot+ $md_mth2_act_trip_tot + $sld_mth2_act_trip_tot + $kd_mth2_act_trip_tot + $gd_mth2_act_trip_tot + $ld_mth2_act_trip_tot + $td_mth2_act_trip_tot + $tpd_mth2_act_trip_tot + $hd_mth2_act_trip_tot;
$xx_sch_mth2_tot = $bd_mth2_sch_trip_tot + $nd_mth2_sch_trip_tot + $pd_mth2_sch_trip_tot+ $md_mth2_sch_trip_tot + $sld_mth2_act_trip_tot + $kd_mth2_sch_trip_tot + $gd_mth2_sch_trip_tot + $ld_mth2_sch_trip_tot + $td_mth2_sch_trip_tot + $tpd_mth2_sch_trip_tot + $hd_mth2_sch_trip_tot;

$xx_act_mth1_tot = $bd_mth1_act_trip_tot + $nd_mth1_act_trip_tot + $pd_mth1_act_trip_tot+ $md_mth1_act_trip_tot + $sld_mth1_act_trip_tot + $kd_mth1_act_trip_tot + $gd_mth1_act_trip_tot + $ld_mth1_act_trip_tot + $td_mth1_act_trip_tot + $tpd_mth1_act_trip_tot + $hd_mth1_act_trip_tot;
$xx_sch_mth1_tot = $bd_mth1_sch_trip_tot + $nd_mth1_sch_trip_tot + $pd_mth1_sch_trip_tot+ $md_mth1_sch_trip_tot + $sld_mth1_act_trip_tot + $kd_mth1_sch_trip_tot + $gd_mth1_sch_trip_tot + $ld_mth1_sch_trip_tot + $td_mth1_sch_trip_tot + $tpd_mth1_sch_trip_tot + $hd_mth1_sch_trip_tot;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($xx_sch_mth2_tot > 0){
echo number_format(100 * (1 - ($xx_act_mth2_tot / $xx_sch_mth2_tot)),1);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($xx_sch_mth1_tot > 0){
echo number_format(100 * (1 - ($xx_act_mth1_tot / $xx_sch_mth1_tot)),1);}


 








echo "</td></tr>";




echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "K.M. COVERED (Lakh)";
 







echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_ac >0){
echo number_format($bd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_ac >0){
echo number_format($bd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_ac >0){
echo number_format($nd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_ac >0){
echo number_format($nd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_ac >0){
echo number_format($pd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_ac >0){
echo number_format($pd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_ac >0){
echo number_format($md_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_ac >0){
echo number_format($md_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_ac >0){
echo number_format($sld_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_ac >0){
echo number_format($sld_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_ac >0){
echo number_format($kd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_ac >0){
echo number_format($kd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_ac >0){
echo number_format($gd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_ac >0){
echo number_format($gd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_ac >0){
echo number_format($ld_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_ac >0){
echo number_format($ld_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_ac >0){
echo number_format($td_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_ac >0){
echo number_format($td_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_ac >0){
echo number_format($tpd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_ac >0){
echo number_format($tpd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_ac >0){
echo number_format($hd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_ac >0){
echo number_format($hd_mth1_km_ac,2);}

$cstc_km_mth2_ac_tot = $bd_mth2_km_ac + $nd_mth2_km_ac + $pd_mth2_km_ac+ $md_mth2_km_ac + $sld_mth2_km_ac + $kd_mth2_km_ac + $gd_mth2_km_ac + $ld_mth2_km_ac + $td_mth2_km_ac + $tpd_mth2_km_ac + $hd_mth2_km_ac;
$cstc_km_mth1_ac_tot = $bd_mth1_km_ac + $nd_mth1_km_ac + $pd_mth1_km_ac+ $md_mth1_km_ac + $sld_mth1_km_ac + $kd_mth1_km_ac + $gd_mth1_km_ac + $ld_mth1_km_ac + $td_mth1_km_ac + $tpd_mth1_km_ac + $hd_mth1_km_ac;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_km_mth2_ac_tot >0){
echo number_format($cstc_km_mth2_ac_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_km_mth1_ac_tot >0){
echo number_format($cstc_km_mth1_ac_tot,2);}


 





echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_nac_new >0){
echo number_format($bd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_nac_new >0){
echo number_format($bd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_nac_new >0){
echo number_format($nd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_nac_new >0){
echo number_format($nd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_nac_new >0){
echo number_format($pd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_nac_new >0){
echo number_format($pd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_nac_new >0){
echo number_format($md_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_nac_new >0){
echo number_format($md_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_nac_new >0){
echo number_format($sld_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_nac_new >0){
echo number_format($sld_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_nac_new >0){
echo number_format($kd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_nac_new >0){
echo number_format($kd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_nac_new >0){
echo number_format($gd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_nac_new >0){
echo number_format($gd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_nac_new >0){
echo number_format($ld_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_nac_new >0){
echo number_format($ld_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_nac_new >0){
echo number_format($td_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_nac_new >0){
echo number_format($td_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_nac_new >0){
echo number_format($tpd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_nac_new >0){
echo number_format($tpd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_nac_new >0){
echo number_format($hd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_nac_new >0){
echo number_format($hd_mth1_km_nac_new,2);}

$cstc_km_mth2_nac_new_tot = $bd_mth2_km_nac_new + $nd_mth2_km_nac_new + $pd_mth2_km_nac_new+ $md_mth2_km_nac_new + $sld_mth2_km_nac_new + $kd_mth2_km_nac_new + $gd_mth2_km_nac_new + $ld_mth2_km_nac_new + $td_mth2_km_nac_new + $tpd_mth2_km_nac_new + $hd_mth2_km_nac_new;
$cstc_km_mth1_nac_new_tot = $bd_mth1_km_nac_new + $nd_mth1_km_nac_new + $pd_mth1_km_nac_new+ $md_mth1_km_nac_new + $sld_mth1_km_nac_new + $kd_mth1_km_nac_new + $gd_mth1_km_nac_new + $ld_mth1_km_nac_new + $td_mth1_km_nac_new + $tpd_mth1_km_nac_new + $hd_mth1_km_nac_new;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_km_mth2_nac_new_tot >0){
echo number_format($cstc_km_mth2_nac_new_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_km_mth1_nac_new_tot >0){
echo number_format($cstc_km_mth1_nac_new_tot,2);}


 





echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD ";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_nac_old >0){
echo number_format($bd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_nac_old >0){
echo number_format($bd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_nac_old >0){
echo number_format($nd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_nac_old >0){
echo number_format($nd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_nac_old >0){
echo number_format($pd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_nac_old >0){
echo number_format($pd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_nac_old >0){
echo number_format($md_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_nac_old >0){
echo number_format($md_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_nac_old >0){
echo number_format($sld_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_nac_old >0){
echo number_format($sld_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_nac_old >0){
echo number_format($kd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_nac_old >0){
echo number_format($kd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_nac_old >0){
echo number_format($gd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_nac_old >0){
echo number_format($gd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_nac_old >0){
echo number_format($ld_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_nac_old >0){
echo number_format($ld_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_nac_old >0){
echo number_format($td_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_nac_old >0){
echo number_format($td_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_nac_old >0){
echo number_format($tpd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_nac_old >0){
echo number_format($tpd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_nac_old >0){
echo number_format($hd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_nac_old >0){
echo number_format($hd_mth1_km_nac_old,2);}

$cstc_km_mth2_nac_old_tot = $bd_mth2_km_nac_old + $nd_mth2_km_nac_old + $pd_mth2_km_nac_old+ $md_mth2_km_nac_old + $sld_mth2_km_nac_old + $kd_mth2_km_nac_old + $gd_mth2_km_nac_old + $ld_mth2_km_nac_old + $td_mth2_km_nac_old + $tpd_mth2_km_nac_old + $hd_mth2_km_nac_old;
$cstc_km_mth1_nac_old_tot = $bd_mth1_km_nac_old + $nd_mth1_km_nac_old + $pd_mth1_km_nac_old+ $md_mth1_km_nac_old + $sld_mth1_km_nac_old + $kd_mth1_km_nac_old + $gd_mth1_km_nac_old + $ld_mth1_km_nac_old + $td_mth1_km_nac_old + $tpd_mth1_km_nac_old + $hd_mth1_km_nac_old;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_km_mth2_nac_old_tot >0){
echo number_format($cstc_km_mth2_nac_old_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_km_mth1_nac_old_tot >0){
echo number_format($cstc_km_mth1_nac_old_tot,2);}




 






echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_tot >0){
echo number_format($bd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_tot >0){
echo number_format($bd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_tot >0){
echo number_format($nd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_tot >0){
echo number_format($nd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_tot >0){
echo number_format($pd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_tot >0){
echo number_format($pd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_tot >0){
echo number_format($md_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_tot >0){
echo number_format($md_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_tot >0){
echo number_format($sld_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_tot >0){
echo number_format($sld_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_tot >0){
echo number_format($kd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_tot >0){
echo number_format($kd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_tot >0){
echo number_format($gd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_tot >0){
echo number_format($gd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_tot >0){
echo number_format($ld_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_tot >0){
echo number_format($ld_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_tot >0){
echo number_format($td_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_tot >0){
echo number_format($td_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_tot >0){
echo number_format($tpd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_tot >0){
echo number_format($tpd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_tot >0){
echo number_format($hd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_tot >0){
echo number_format($hd_mth1_km_tot,2);}

$cstc_km_mth2_tot = $bd_mth2_km_tot + $nd_mth2_km_tot + $pd_mth2_km_tot+ $md_mth2_km_tot + $sld_mth2_km_tot + $kd_mth2_km_tot + $gd_mth2_km_tot + $ld_mth2_km_tot + $td_mth2_km_tot + $tpd_mth2_km_tot + $hd_mth2_km_tot;
$cstc_km_mth1_tot = $bd_mth1_km_tot + $nd_mth1_km_tot + $pd_mth1_km_tot+ $md_mth1_km_tot + $sld_mth1_km_tot + $kd_mth1_km_tot + $gd_mth1_km_tot + $ld_mth1_km_tot + $td_mth1_km_tot + $tpd_mth1_km_tot + $hd_mth1_km_tot;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_km_mth2_tot >0){
echo number_format($cstc_km_mth2_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_km_mth1_tot >0){
echo number_format($cstc_km_mth1_tot,2);}
echo "</td></tr>";

//echo "<tr rowspan='2'><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
//echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";

echo "<tr>";
echo "<td style='background: yellow;font-size: 8.5px;'style='font-size: 8.5px;'>";
echo "DESC";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "BD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "ND";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "PD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "MD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "SLD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "KD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "GD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "LD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "TD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "TPD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "HD";
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'colspan='2' align='center'>";
echo "CSTC";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='background: yellow;font-size: 8.5px;'>";
echo "";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "</tr>";

echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "REVENUE 1ST SHIFT (Lakh)";
 






echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_1st_ac >0){
echo number_format($bd_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_1st_ac >0){
echo number_format($bd_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_1st_ac >0){
echo number_format($nd_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_1st_ac >0){
echo number_format($nd_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_1st_ac >0){
echo number_format($pd_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_1st_ac >0){
echo number_format($pd_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_1st_ac >0){
echo number_format($md_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_1st_ac >0){
echo number_format($md_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_1st_ac >0){
echo number_format($sld_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_1st_ac >0){
echo number_format($sld_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_1st_ac >0){
echo number_format($kd_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_1st_ac >0){
echo number_format($kd_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_1st_ac >0){
echo number_format($gd_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_1st_ac >0){
echo number_format($gd_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_1st_ac >0){
echo number_format($ld_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_1st_ac >0){
echo number_format($ld_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_1st_ac >0){
echo number_format($td_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_1st_ac >0){
echo number_format($td_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_1st_ac >0){
echo number_format($tpd_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_1st_ac >0){
echo number_format($tpd_mth1_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_1st_ac >0){
echo number_format($hd_mth2_sale_1st_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_1st_ac >0){
echo number_format($hd_mth1_sale_1st_ac,2);}

$cstc_sale_1st_mth2_ac_tot = $bd_mth2_sale_1st_ac + $nd_mth2_sale_1st_ac + $pd_mth2_sale_1st_ac+ $md_mth2_sale_1st_ac + $sld_mth2_sale_1st_ac + $kd_mth2_sale_1st_ac + $gd_mth2_sale_1st_ac + $ld_mth2_sale_1st_ac + $td_mth2_sale_1st_ac + $tpd_mth2_sale_1st_ac + $hd_mth2_sale_1st_ac;
$cstc_sale_1st_mth1_ac_tot = $bd_mth1_sale_1st_ac + $nd_mth1_sale_1st_ac + $pd_mth1_sale_1st_ac+ $md_mth1_sale_1st_ac + $sld_mth1_sale_1st_ac + $kd_mth1_sale_1st_ac + $gd_mth1_sale_1st_ac + $ld_mth1_sale_1st_ac + $td_mth1_sale_1st_ac + $tpd_mth1_sale_1st_ac + $hd_mth1_sale_1st_ac;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_1st_mth2_ac_tot >0){
echo number_format($cstc_sale_1st_mth2_ac_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_1st_mth1_ac_tot >0){
echo number_format($cstc_sale_1st_mth1_ac_tot,2);}


 







echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_1st_nac_new >0){
echo number_format($bd_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_1st_nac_new >0){
echo number_format($bd_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_1st_nac_new >0){
echo number_format($nd_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_1st_nac_new >0){
echo number_format($nd_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_1st_nac_new >0){
echo number_format($pd_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_1st_nac_new >0){
echo number_format($pd_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_1st_nac_new >0){
echo number_format($md_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_1st_nac_new >0){
echo number_format($md_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_1st_nac_new >0){
echo number_format($sld_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_1st_nac_new >0){
echo number_format($sld_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_1st_nac_new >0){
echo number_format($kd_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_1st_nac_new >0){
echo number_format($kd_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_1st_nac_new >0){
echo number_format($gd_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_1st_nac_new >0){
echo number_format($gd_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_1st_nac_new >0){
echo number_format($ld_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_1st_nac_new >0){
echo number_format($ld_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_1st_nac_new >0){
echo number_format($td_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_1st_nac_new >0){
echo number_format($td_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_1st_nac_new >0){
echo number_format($tpd_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_1st_nac_new >0){
echo number_format($tpd_mth1_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_1st_nac_new >0){
echo number_format($hd_mth2_sale_1st_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_1st_nac_new >0){
echo number_format($hd_mth1_sale_1st_nac_new,2);}

$cstc_sale_1st_mth2_nac_new_tot = $bd_mth2_sale_1st_nac_new + $nd_mth2_sale_1st_nac_new + $pd_mth2_sale_1st_nac_new+ $md_mth2_sale_1st_nac_new + $sld_mth2_sale_1st_nac_new + $kd_mth2_sale_1st_nac_new + $gd_mth2_sale_1st_nac_new + $ld_mth2_sale_1st_nac_new + $td_mth2_sale_1st_nac_new + $tpd_mth2_sale_1st_nac_new + $hd_mth2_sale_1st_nac_new;
$cstc_sale_1st_mth1_nac_new_tot = $bd_mth1_sale_1st_nac_new + $nd_mth1_sale_1st_nac_new + $pd_mth1_sale_1st_nac_new+ $md_mth1_sale_1st_nac_new + $sld_mth1_sale_1st_nac_new + $kd_mth1_sale_1st_nac_new + $gd_mth1_sale_1st_nac_new + $ld_mth1_sale_1st_nac_new + $td_mth1_sale_1st_nac_new + $tpd_mth1_sale_1st_nac_new + $hd_mth1_sale_1st_nac_new;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_1st_mth2_nac_new_tot >0){
echo number_format($cstc_sale_1st_mth2_nac_new_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_1st_mth1_nac_new_tot >0){
echo number_format($cstc_sale_1st_mth1_nac_new_tot,2);}


 







echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_1st_nac_old >0){
echo number_format($bd_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_1st_nac_old >0){
echo number_format($bd_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_1st_nac_old >0){
echo number_format($nd_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_1st_nac_old >0){
echo number_format($nd_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_1st_nac_old >0){
echo number_format($pd_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_1st_nac_old >0){
echo number_format($pd_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_1st_nac_old >0){
echo number_format($md_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_1st_nac_old >0){
echo number_format($md_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_1st_nac_old >0){
echo number_format($sld_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_1st_nac_old >0){
echo number_format($sld_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_1st_nac_old >0){
echo number_format($kd_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_1st_nac_old >0){
echo number_format($kd_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_1st_nac_old >0){
echo number_format($gd_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_1st_nac_old >0){
echo number_format($gd_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_1st_nac_old >0){
echo number_format($ld_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_1st_nac_old >0){
echo number_format($ld_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_1st_nac_old >0){
echo number_format($td_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_1st_nac_old >0){
echo number_format($td_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_1st_nac_old >0){
echo number_format($tpd_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_1st_nac_old >0){
echo number_format($tpd_mth1_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_1st_nac_old >0){
echo number_format($hd_mth2_sale_1st_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_1st_nac_old >0){
echo number_format($hd_mth1_sale_1st_nac_old,2);}

$cstc_sale_1st_mth2_nac_old_tot = $bd_mth2_sale_1st_nac_old + $nd_mth2_sale_1st_nac_old + $pd_mth2_sale_1st_nac_old+ $md_mth2_sale_1st_nac_old + $sld_mth2_sale_1st_nac_old + $kd_mth2_sale_1st_nac_old + $gd_mth2_sale_1st_nac_old + $ld_mth2_sale_1st_nac_old + $td_mth2_sale_1st_nac_old + $tpd_mth2_sale_1st_nac_old + $hd_mth2_sale_1st_nac_old;
$cstc_sale_1st_mth1_nac_old_tot = $bd_mth1_sale_1st_nac_old + $nd_mth1_sale_1st_nac_old + $pd_mth1_sale_1st_nac_old+ $md_mth1_sale_1st_nac_old + $sld_mth1_sale_1st_nac_old + $kd_mth1_sale_1st_nac_old + $gd_mth1_sale_1st_nac_old + $ld_mth1_sale_1st_nac_old + $td_mth1_sale_1st_nac_old + $tpd_mth1_sale_1st_nac_old + $hd_mth1_sale_1st_nac_old;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_1st_mth2_nac_old_tot >0){
echo number_format($cstc_sale_1st_mth2_nac_old_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_1st_mth1_nac_old_tot >0){
echo number_format($cstc_sale_1st_mth1_nac_old_tot,2);}




 






echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL(1) ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_1st_tot >0){
echo number_format($bd_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_1st_tot >0){
echo number_format($bd_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_1st_tot >0){
echo number_format($nd_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_1st_tot >0){
echo number_format($nd_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_1st_tot >0){
echo number_format($pd_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_1st_tot >0){
echo number_format($pd_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_1st_tot >0){
echo number_format($md_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_1st_tot >0){
echo number_format($md_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_1st_tot >0){
echo number_format($sld_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_1st_tot >0){
echo number_format($sld_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_1st_tot >0){
echo number_format($kd_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_1st_tot >0){
echo number_format($kd_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_1st_tot >0){
echo number_format($gd_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_1st_tot >0){
echo number_format($gd_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_1st_tot >0){
echo number_format($ld_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_1st_tot >0){
echo number_format($ld_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_1st_tot >0){
echo number_format($td_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_1st_tot >0){
echo number_format($td_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_1st_tot >0){
echo number_format($tpd_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_1st_tot >0){
echo number_format($tpd_mth1_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_1st_tot >0){
echo number_format($hd_mth2_sale_1st_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_1st_tot >0){
echo number_format($hd_mth1_sale_1st_tot,2);}

$cstc_sale_1st_mth2_tot = $bd_mth2_sale_1st_tot + $nd_mth2_sale_1st_tot + $pd_mth2_sale_1st_tot+ $md_mth2_sale_1st_tot + $sld_mth2_sale_1st_tot + $kd_mth2_sale_1st_tot + $gd_mth2_sale_1st_tot + $ld_mth2_sale_1st_tot + $td_mth2_sale_1st_tot + $tpd_mth2_sale_1st_tot + $hd_mth2_sale_1st_tot;
$cstc_sale_1st_mth1_tot = $bd_mth1_sale_1st_tot + $nd_mth1_sale_1st_tot + $pd_mth1_sale_1st_tot+ $md_mth1_sale_1st_tot + $sld_mth1_sale_1st_tot + $kd_mth1_sale_1st_tot + $gd_mth1_sale_1st_tot + $ld_mth1_sale_1st_tot + $td_mth1_sale_1st_tot + $tpd_mth1_sale_1st_tot + $hd_mth1_sale_1st_tot;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_1st_mth2_tot >0){
echo number_format($cstc_sale_1st_mth2_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_1st_mth1_tot >0){
echo number_format($cstc_sale_1st_mth1_tot,2);}




 








echo "</td></tr>";
echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "REVENUE 2ND SHIFT(Lakh)";
echo "</td></tr>";





echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_2nd_ac >0){
echo number_format($bd_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_2nd_ac >0){
echo number_format($bd_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_2nd_ac >0){
echo number_format($nd_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_2nd_ac >0){
echo number_format($nd_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_2nd_ac >0){
echo number_format($pd_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_2nd_ac >0){
echo number_format($pd_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_2nd_ac >0){
echo number_format($md_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_2nd_ac >0){
echo number_format($md_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_2nd_ac >0){
echo number_format($sld_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_2nd_ac >0){
echo number_format($sld_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_2nd_ac >0){
echo number_format($kd_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_2nd_ac >0){
echo number_format($kd_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_2nd_ac >0){
echo number_format($gd_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_2nd_ac >0){
echo number_format($gd_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_2nd_ac >0){
echo number_format($ld_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_2nd_ac >0){
echo number_format($ld_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_2nd_ac >0){
echo number_format($td_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_2nd_ac >0){
echo number_format($td_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_2nd_ac >0){
echo number_format($tpd_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_2nd_ac >0){
echo number_format($tpd_mth1_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_2nd_ac >0){
echo number_format($hd_mth2_sale_2nd_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_2nd_ac >0){
echo number_format($hd_mth1_sale_2nd_ac,2);}

$cstc_sale_2nd_mth2_ac_tot = $bd_mth2_sale_2nd_ac + $nd_mth2_sale_2nd_ac + $pd_mth2_sale_2nd_ac+ $md_mth2_sale_2nd_ac + $sld_mth2_sale_2nd_ac + $kd_mth2_sale_2nd_ac + $gd_mth2_sale_2nd_ac + $ld_mth2_sale_2nd_ac + $td_mth2_sale_2nd_ac + $tpd_mth2_sale_2nd_ac + $hd_mth2_sale_2nd_ac;
$cstc_sale_2nd_mth1_ac_tot = $bd_mth1_sale_2nd_ac + $nd_mth1_sale_2nd_ac + $pd_mth1_sale_2nd_ac+ $md_mth1_sale_2nd_ac + $sld_mth1_sale_2nd_ac + $kd_mth1_sale_2nd_ac + $gd_mth1_sale_2nd_ac + $ld_mth1_sale_2nd_ac + $td_mth1_sale_2nd_ac + $tpd_mth1_sale_2nd_ac + $hd_mth1_sale_2nd_ac;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_2nd_mth2_ac_tot >0){
echo number_format($cstc_sale_2nd_mth2_ac_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_2nd_mth1_ac_tot >0){
echo number_format($cstc_sale_2nd_mth1_ac_tot,2);}


 

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_2nd_nac_new >0){
echo number_format($bd_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_2nd_nac_new >0){
echo number_format($bd_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_2nd_nac_new >0){
echo number_format($nd_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_2nd_nac_new >0){
echo number_format($nd_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_2nd_nac_new >0){
echo number_format($pd_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_2nd_nac_new >0){
echo number_format($pd_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_2nd_nac_new >0){
echo number_format($md_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_2nd_nac_new >0){
echo number_format($md_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_2nd_nac_new >0){
echo number_format($sld_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_2nd_nac_new >0){
echo number_format($sld_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_2nd_nac_new >0){
echo number_format($kd_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_2nd_nac_new >0){
echo number_format($kd_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_2nd_nac_new >0){
echo number_format($gd_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_2nd_nac_new >0){
echo number_format($gd_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_2nd_nac_new >0){
echo number_format($ld_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_2nd_nac_new >0){
echo number_format($ld_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_2nd_nac_new >0){
echo number_format($td_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_2nd_nac_new >0){
echo number_format($td_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_2nd_nac_new >0){
echo number_format($tpd_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_2nd_nac_new >0){
echo number_format($tpd_mth1_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_2nd_nac_new >0){
echo number_format($hd_mth2_sale_2nd_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_2nd_nac_new >0){
echo number_format($hd_mth1_sale_2nd_nac_new,2);}

$cstc_sale_2nd_mth2_nac_new_tot = $bd_mth2_sale_2nd_nac_new + $nd_mth2_sale_2nd_nac_new + $pd_mth2_sale_2nd_nac_new+ $md_mth2_sale_2nd_nac_new + $sld_mth2_sale_2nd_nac_new + $kd_mth2_sale_2nd_nac_new + $gd_mth2_sale_2nd_nac_new + $ld_mth2_sale_2nd_nac_new + $td_mth2_sale_2nd_nac_new + $tpd_mth2_sale_2nd_nac_new + $hd_mth2_sale_2nd_nac_new;
$cstc_sale_2nd_mth1_nac_new_tot = $bd_mth1_sale_2nd_nac_new + $nd_mth1_sale_2nd_nac_new + $pd_mth1_sale_2nd_nac_new+ $md_mth1_sale_2nd_nac_new + $sld_mth1_sale_2nd_nac_new + $kd_mth1_sale_2nd_nac_new + $gd_mth1_sale_2nd_nac_new + $ld_mth1_sale_2nd_nac_new + $td_mth1_sale_2nd_nac_new + $tpd_mth1_sale_2nd_nac_new + $hd_mth1_sale_2nd_nac_new;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_2nd_mth2_nac_new_tot >0){
echo number_format($cstc_sale_2nd_mth2_nac_new_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_2nd_mth1_nac_new_tot >0){
echo number_format($cstc_sale_2nd_mth1_nac_new_tot,2);}


 



echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_2nd_nac_old >0){
echo number_format($bd_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_2nd_nac_old >0){
echo number_format($bd_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_2nd_nac_old >0){
echo number_format($nd_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_2nd_nac_old >0){
echo number_format($nd_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_2nd_nac_old >0){
echo number_format($pd_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_2nd_nac_old >0){
echo number_format($pd_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_2nd_nac_old >0){
echo number_format($md_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_2nd_nac_old >0){
echo number_format($md_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_2nd_nac_old >0){
echo number_format($sld_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_2nd_nac_old >0){
echo number_format($sld_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_2nd_nac_old >0){
echo number_format($kd_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_2nd_nac_old >0){
echo number_format($kd_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_2nd_nac_old >0){
echo number_format($gd_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_2nd_nac_old >0){
echo number_format($gd_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_2nd_nac_old >0){
echo number_format($ld_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_2nd_nac_old >0){
echo number_format($ld_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_2nd_nac_old >0){
echo number_format($td_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_2nd_nac_old >0){
echo number_format($td_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_2nd_nac_old >0){
echo number_format($tpd_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_2nd_nac_old >0){
echo number_format($tpd_mth1_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_2nd_nac_old >0){
echo number_format($hd_mth2_sale_2nd_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_2nd_nac_old >0){
echo number_format($hd_mth1_sale_2nd_nac_old,2);}

$cstc_sale_2nd_mth2_nac_old_tot = $bd_mth2_sale_2nd_nac_old + $nd_mth2_sale_2nd_nac_old + $pd_mth2_sale_2nd_nac_old+ $md_mth2_sale_2nd_nac_old + $sld_mth2_sale_2nd_nac_old + $kd_mth2_sale_2nd_nac_old + $gd_mth2_sale_2nd_nac_old + $ld_mth2_sale_2nd_nac_old + $td_mth2_sale_2nd_nac_old + $tpd_mth2_sale_2nd_nac_old + $hd_mth2_sale_2nd_nac_old;
$cstc_sale_2nd_mth1_nac_old_tot = $bd_mth1_sale_2nd_nac_old + $nd_mth1_sale_2nd_nac_old + $pd_mth1_sale_2nd_nac_old+ $md_mth1_sale_2nd_nac_old + $sld_mth1_sale_2nd_nac_old + $kd_mth1_sale_2nd_nac_old + $gd_mth1_sale_2nd_nac_old + $ld_mth1_sale_2nd_nac_old + $td_mth1_sale_2nd_nac_old + $tpd_mth1_sale_2nd_nac_old + $hd_mth1_sale_2nd_nac_old;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_2nd_mth2_nac_old_tot >0){
echo number_format($cstc_sale_2nd_mth2_nac_old_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_2nd_mth1_nac_old_tot >0){
echo number_format($cstc_sale_2nd_mth1_nac_old_tot,2);}




 


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL(2) ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_2nd_tot >0){
echo number_format($bd_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_2nd_tot >0){
echo number_format($bd_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_2nd_tot >0){
echo number_format($nd_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_2nd_tot >0){
echo number_format($nd_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_2nd_tot >0){
echo number_format($pd_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_2nd_tot >0){
echo number_format($pd_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_2nd_tot >0){
echo number_format($md_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_2nd_tot >0){
echo number_format($md_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_2nd_tot >0){
echo number_format($sld_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_2nd_tot >0){
echo number_format($sld_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_2nd_tot >0){
echo number_format($kd_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_2nd_tot >0){
echo number_format($kd_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_2nd_tot >0){
echo number_format($gd_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_2nd_tot >0){
echo number_format($gd_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_2nd_tot >0){
echo number_format($ld_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_2nd_tot >0){
echo number_format($ld_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_2nd_tot >0){
echo number_format($td_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_2nd_tot >0){
echo number_format($td_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_2nd_tot >0){
echo number_format($tpd_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_2nd_tot >0){
echo number_format($tpd_mth1_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_2nd_tot >0){
echo number_format($hd_mth2_sale_2nd_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_2nd_tot >0){
echo number_format($hd_mth1_sale_2nd_tot,2);}

$cstc_sale_2nd_mth2_tot = $bd_mth2_sale_2nd_tot + $nd_mth2_sale_2nd_tot + $pd_mth2_sale_2nd_tot+ $md_mth2_sale_2nd_tot + $sld_mth2_sale_2nd_tot + $kd_mth2_sale_2nd_tot + $gd_mth2_sale_2nd_tot + $ld_mth2_sale_2nd_tot + $td_mth2_sale_2nd_tot + $tpd_mth2_sale_2nd_tot + $hd_mth2_sale_2nd_tot;
$cstc_sale_2nd_mth1_tot = $bd_mth1_sale_2nd_tot + $nd_mth1_sale_2nd_tot + $pd_mth1_sale_2nd_tot+ $md_mth1_sale_2nd_tot + $sld_mth1_sale_2nd_tot + $kd_mth1_sale_2nd_tot + $gd_mth1_sale_2nd_tot + $ld_mth1_sale_2nd_tot + $td_mth1_sale_2nd_tot + $tpd_mth1_sale_2nd_tot + $hd_mth1_sale_2nd_tot;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_2nd_mth2_tot >0){
echo number_format($cstc_sale_2nd_mth2_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_2nd_mth1_tot >0){
echo number_format($cstc_sale_2nd_mth1_tot,2);}




 


echo "</td></tr>";

echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "REVENUE 1ST + 2ND SHIFT(Lakh)";
echo "</td></tr>";
//****************************************************
//*************************************************
echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_tot_ac >0){
echo number_format($bd_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_tot_ac >0){
echo number_format($bd_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_tot_ac >0){
echo number_format($nd_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_tot_ac >0){
echo number_format($nd_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_tot_ac >0){
echo number_format($pd_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_tot_ac >0){
echo number_format($pd_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_tot_ac >0){
echo number_format($md_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_tot_ac >0){
echo number_format($md_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_tot_ac >0){
echo number_format($sld_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_tot_ac >0){
echo number_format($sld_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_tot_ac >0){
echo number_format($kd_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_tot_ac >0){
echo number_format($kd_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_tot_ac >0){
echo number_format($gd_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_tot_ac >0){
echo number_format($gd_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_tot_ac >0){
echo number_format($ld_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_tot_ac >0){
echo number_format($ld_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_tot_ac >0){
echo number_format($td_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_tot_ac >0){
echo number_format($td_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_tot_ac >0){
echo number_format($tpd_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_tot_ac >0){
echo number_format($tpd_mth1_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_tot_ac >0){
echo number_format($hd_mth2_sale_tot_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_tot_ac >0){
echo number_format($hd_mth1_sale_tot_ac,2);}

$cstc_sale_tot_mth2_ac = $bd_mth2_sale_tot_ac + $nd_mth2_sale_tot_ac + $pd_mth2_sale_tot_ac+ $md_mth2_sale_tot_ac + $sld_mth2_sale_tot_ac + $kd_mth2_sale_tot_ac + $gd_mth2_sale_tot_ac + $ld_mth2_sale_tot_ac + $td_mth2_sale_tot_ac + $tpd_mth2_sale_tot_ac + $hd_mth2_sale_tot_ac;
$cstc_sale_tot_mth1_ac = $bd_mth1_sale_tot_ac + $nd_mth1_sale_tot_ac + $pd_mth1_sale_tot_ac+ $md_mth1_sale_tot_ac + $sld_mth1_sale_tot_ac + $kd_mth1_sale_tot_ac + $gd_mth1_sale_tot_ac + $ld_mth1_sale_tot_ac + $td_mth1_sale_tot_ac + $tpd_mth1_sale_tot_ac + $hd_mth1_sale_tot_ac;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_tot_mth2_ac >0){
echo number_format($cstc_sale_tot_mth2_ac,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_tot_mth1_ac >0){
echo number_format($cstc_sale_tot_mth1_ac,2);}








echo "</td></tr>";
echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_tot_nac_new >0){
echo number_format($bd_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_tot_nac_new >0){
echo number_format($bd_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_tot_nac_new >0){
echo number_format($nd_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_tot_nac_new >0){
echo number_format($nd_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_tot_nac_new >0){
echo number_format($pd_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_tot_nac_new >0){
echo number_format($pd_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_tot_nac_new >0){
echo number_format($md_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_tot_nac_new >0){
echo number_format($md_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_tot_nac_new >0){
echo number_format($sld_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_tot_nac_new >0){
echo number_format($sld_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_tot_nac_new >0){
echo number_format($kd_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_tot_nac_new >0){
echo number_format($kd_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_tot_nac_new >0){
echo number_format($gd_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_tot_nac_new >0){
echo number_format($gd_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_tot_nac_new >0){
echo number_format($ld_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_tot_nac_new >0){
echo number_format($ld_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_tot_nac_new >0){
echo number_format($td_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_tot_nac_new >0){
echo number_format($td_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_tot_nac_new >0){
echo number_format($tpd_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_tot_nac_new >0){
echo number_format($tpd_mth1_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_tot_nac_new >0){
echo number_format($hd_mth2_sale_tot_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_tot_nac_new >0){
echo number_format($hd_mth1_sale_tot_nac_new,2);}

$cstc_sale_tot_mth2_nac_new = $bd_mth2_sale_tot_nac_new + $nd_mth2_sale_tot_nac_new + $pd_mth2_sale_tot_nac_new+ $md_mth2_sale_tot_nac_new + $sld_mth2_sale_tot_nac_new + $kd_mth2_sale_tot_nac_new + $gd_mth2_sale_tot_nac_new + $ld_mth2_sale_tot_nac_new + $td_mth2_sale_tot_nac_new + $tpd_mth2_sale_tot_nac_new + $hd_mth2_sale_tot_nac_new;
$cstc_sale_tot_mth1_nac_new = $bd_mth1_sale_tot_nac_new + $nd_mth1_sale_tot_nac_new + $pd_mth1_sale_tot_nac_new+ $md_mth1_sale_tot_nac_new + $sld_mth1_sale_tot_nac_new + $kd_mth1_sale_tot_nac_new + $gd_mth1_sale_tot_nac_new + $ld_mth1_sale_tot_nac_new + $td_mth1_sale_tot_nac_new + $tpd_mth1_sale_tot_nac_new + $hd_mth1_sale_tot_nac_new;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_tot_mth2_nac_new >0){
echo number_format($cstc_sale_tot_mth2_nac_new,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_tot_mth1_nac_new >0){
echo number_format($cstc_sale_tot_mth1_nac_new,2);}








echo "</td></tr>";
echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_tot_nac_old >0){
echo number_format($bd_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_tot_nac_old >0){
echo number_format($bd_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_tot_nac_old >0){
echo number_format($nd_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_tot_nac_old >0){
echo number_format($nd_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_tot_nac_old >0){
echo number_format($pd_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_tot_nac_old >0){
echo number_format($pd_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_tot_nac_old >0){
echo number_format($md_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_tot_nac_old >0){
echo number_format($md_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_tot_nac_old >0){
echo number_format($sld_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_tot_nac_old >0){
echo number_format($sld_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_tot_nac_old >0){
echo number_format($kd_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_tot_nac_old >0){
echo number_format($kd_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_tot_nac_old >0){
echo number_format($gd_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_tot_nac_old >0){
echo number_format($gd_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_tot_nac_old >0){
echo number_format($ld_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_tot_nac_old >0){
echo number_format($ld_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_tot_nac_old >0){
echo number_format($td_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_tot_nac_old >0){
echo number_format($td_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_tot_nac_old >0){
echo number_format($tpd_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_tot_nac_old >0){
echo number_format($tpd_mth1_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_tot_nac_old >0){
echo number_format($hd_mth2_sale_tot_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_tot_nac_old >0){
echo number_format($hd_mth1_sale_tot_nac_old,2);}

$cstc_sale_tot_mth2_nac_old = $bd_mth2_sale_tot_nac_old + $nd_mth2_sale_tot_nac_old + $pd_mth2_sale_tot_nac_old+ $md_mth2_sale_tot_nac_old + $sld_mth2_sale_tot_nac_old + $kd_mth2_sale_tot_nac_old + $gd_mth2_sale_tot_nac_old + $ld_mth2_sale_tot_nac_old + $td_mth2_sale_tot_nac_old + $tpd_mth2_sale_tot_nac_old + $hd_mth2_sale_tot_nac_old;
$cstc_sale_tot_mth1_nac_old = $bd_mth1_sale_tot_nac_old + $nd_mth1_sale_tot_nac_old + $pd_mth1_sale_tot_nac_old+ $md_mth1_sale_tot_nac_old + $sld_mth1_sale_tot_nac_old + $kd_mth1_sale_tot_nac_old + $gd_mth1_sale_tot_nac_old + $ld_mth1_sale_tot_nac_old + $td_mth1_sale_tot_nac_old + $tpd_mth1_sale_tot_nac_old + $hd_mth1_sale_tot_nac_old;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_tot_mth2_nac_old >0){
echo number_format($cstc_sale_tot_mth2_nac_old,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_tot_mth1_nac_old >0){
echo number_format($cstc_sale_tot_mth1_nac_old,2);}








echo "</td></tr>";
echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_sale_tot >0){
echo number_format($bd_mth2_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sale_tot >0){
echo number_format($bd_mth1_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sale_tot >0){
echo number_format($nd_mth2_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sale_tot >0){
echo number_format($nd_mth1_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sale_tot >0){
echo number_format($pd_mth2_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sale_tot >0){
echo number_format($pd_mth1_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sale_tot >0){
echo number_format($md_mth2_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sale_tot >0){
echo number_format($md_mth1_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sale_tot >0){
echo number_format($sld_mth2_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sale_tot >0){
echo number_format($sld_mth1_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sale_tot >0){
echo number_format($kd_mth2_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sale_tot >0){
echo number_format($kd_mth1_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sale_tot >0){
echo number_format($gd_mth2_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sale_tot >0){
echo number_format($gd_mth1_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sale_tot >0){
echo number_format($ld_mth2_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sale_tot >0){
echo number_format($ld_mth1_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sale_tot >0){
echo number_format($td_mth2_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sale_tot >0){
echo number_format($td_mth1_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sale_tot >0){
echo number_format($tpd_mth2_sale_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sale_tot >0){
echo number_format($tpd_mth1_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sale_tot >0){
echo number_format($hd_mth2_sale_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sale_tot >0){
echo number_format($hd_mth1_sale_tot,2);}

$cstc_sale_mth2_tot = $bd_mth2_sale_tot + $nd_mth2_sale_tot + $pd_mth2_sale_tot+ $md_mth2_sale_tot + $sld_mth2_sale_tot + $kd_mth2_sale_tot + $gd_mth2_sale_tot + $ld_mth2_sale_tot + $td_mth2_sale_tot + $tpd_mth2_sale_tot + $hd_mth2_sale_tot;
$cstc_sale_mth1_tot = $bd_mth1_sale_tot + $nd_mth1_sale_tot + $pd_mth1_sale_tot+ $md_mth1_sale_tot + $sld_mth1_sale_tot + $kd_mth1_sale_tot + $gd_mth1_sale_tot + $ld_mth1_sale_tot + $td_mth1_sale_tot + $tpd_mth1_sale_tot + $hd_mth1_sale_tot;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_sale_mth2_tot >0){
echo number_format($cstc_sale_mth2_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";
if($cstc_sale_mth1_tot >0){
echo number_format($cstc_sale_mth1_tot,2);}








echo "</td></tr>";

echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "EXPENDITURE (Lakh)";
 
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "SALARY";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";


if($bd_mth2_sal > 0){
echo number_format($bd_mth2_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_sal > 0){
echo number_format($bd_mth1_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_sal > 0){
echo number_format($nd_mth2_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_sal > 0){
echo number_format($nd_mth1_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_sal > 0){
echo number_format($pd_mth2_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_sal > 0){
echo number_format($pd_mth1_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_sal > 0){
echo number_format($md_mth2_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_sal > 0){
echo number_format($md_mth1_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_sal > 0){
echo number_format($sld_mth2_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_sal > 0){
echo number_format($sld_mth1_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_sal > 0){
echo number_format($kd_mth2_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_sal > 0){
echo number_format($kd_mth1_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_sal > 0){
echo number_format($gd_mth2_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_sal > 0){
echo number_format($gd_mth1_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_sal > 0){
echo number_format($ld_mth2_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_sal > 0){
echo number_format($ld_mth1_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_sal > 0){
echo number_format($td_mth2_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_sal > 0){
echo number_format($td_mth1_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_sal > 0){
echo number_format($tpd_mth2_sal,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_sal > 0){
echo number_format($tpd_mth1_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_sal > 0){
echo number_format($hd_mth2_sal,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_sal > 0){
echo number_format($hd_mth1_sal,2);}



$cstc_mth1_sal = $bd_mth1_sal + $nd_mth1_sal + $pd_mth1_sal + $md_mth1_sal + $sld_mth1_sal + $kd_mth1_sal + $gd_mth1_sal + $ld_mth1_sal + $td_mth1_sal + $tpd_mth1_sal + $hd_mth1_sal + $hq_mth1_sal + $ct_mth1_sal + $cw_mth1_sal + $ce_mth1_sal;
$cstc_mth2_sal = $bd_mth2_sal + $nd_mth2_sal + $pd_mth2_sal + $md_mth2_sal + $sld_mth2_sal + $kd_mth2_sal + $gd_mth2_sal + $ld_mth2_sal + $td_mth2_sal + $tpd_mth2_sal + $hd_mth2_sal + $hq_mth2_sal + $ct_mth2_sal + $cw_mth2_sal + $ce_mth2_sal;

echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_sal >0){
echo number_format($cstc_mth2_sal,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

//$cstc_mth2_sal = $bd_mth2_sal + $nd_mth2_sal + $pd_mth2_sal + $md_mth2_sal + $sld_mth2_sal + $kd_mth2_sal + $gd_mth2_sal + $ld_mth2_sal + $td_mth2_sal + $tpd_mth2_sal + $hd_mth2_sal + $hq_mth2_sal + $ct_mth2_sal + $cw_mth2_sal + $ce_mth2_sal;
if($cstc_mth1_sal >0){
echo number_format($cstc_mth1_sal,2);}

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "O.T.";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";


if($bd_mth2_ot > 0){
echo number_format($bd_mth2_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_ot > 0){
echo number_format($bd_mth1_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_ot > 0){
echo number_format($nd_mth2_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_ot > 0){
echo number_format($nd_mth1_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_ot > 0){
echo number_format($pd_mth2_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_ot > 0){
echo number_format($pd_mth1_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_ot > 0){
echo number_format($md_mth2_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_ot > 0){
echo number_format($md_mth1_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_ot > 0){
echo number_format($sld_mth2_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_ot > 0){
echo number_format($sld_mth1_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_ot > 0){
echo number_format($kd_mth2_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_ot > 0){
echo number_format($kd_mth1_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_ot > 0){
echo number_format($gd_mth2_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_ot > 0){
echo number_format($gd_mth1_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_ot > 0){
echo number_format($ld_mth2_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_ot > 0){
echo number_format($ld_mth1_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_ot > 0){
echo number_format($td_mth2_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_ot > 0){
echo number_format($td_mth1_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_ot > 0){
echo number_format($tpd_mth2_ot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_ot > 0){
echo number_format($tpd_mth1_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_ot > 0){
echo number_format($hd_mth2_ot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_ot > 0){
echo number_format($hd_mth1_ot,2);}



$cstc_mth1_ot = $bd_mth1_ot + $nd_mth1_ot + $pd_mth1_ot + $md_mth1_ot + $sld_mth1_ot + $kd_mth1_ot + $gd_mth1_ot + $ld_mth1_ot + $td_mth1_ot + $tpd_mth1_ot + $hd_mth1_ot ;
$cstc_mth2_ot = $bd_mth2_ot + $nd_mth2_ot + $pd_mth2_ot + $md_mth2_ot + $sld_mth2_ot + $kd_mth2_ot + $gd_mth2_ot + $ld_mth2_ot + $td_mth2_ot + $tpd_mth2_ot + $hd_mth2_ot ;

echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_ot >0){
echo number_format($cstc_mth2_ot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>";

//$cstc_mth2_ot = $bd_mth2_ot + $nd_mth2_ot + $pd_mth2_ot + $md_mth2_ot + $sld_mth2_ot + $kd_mth2_ot + $gd_mth2_ot + $ld_mth2_ot + $td_mth2_ot + $tpd_mth2_ot + $hd_mth2_ot ;
if($cstc_mth1_ot >0){
echo number_format($cstc_mth1_ot,2);}


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "INCENTIVE";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";


if($bd_mth2_incen > 0){
echo number_format($bd_mth2_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_incen > 0){
echo number_format($bd_mth1_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_incen > 0){
echo number_format($nd_mth2_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_incen > 0){
echo number_format($nd_mth1_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_incen > 0){
echo number_format($pd_mth2_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_incen > 0){
echo number_format($pd_mth1_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_incen > 0){
echo number_format($md_mth2_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_incen > 0){
echo number_format($md_mth1_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_incen > 0){
echo number_format($sld_mth2_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_incen > 0){
echo number_format($sld_mth1_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_incen > 0){
echo number_format($kd_mth2_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_incen > 0){
echo number_format($kd_mth1_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_incen > 0){
echo number_format($gd_mth2_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_incen > 0){
echo number_format($gd_mth1_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_incen > 0){
echo number_format($ld_mth2_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_incen > 0){
echo number_format($ld_mth1_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_incen > 0){
echo number_format($td_mth2_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_incen > 0){
echo number_format($td_mth1_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_incen > 0){
echo number_format($tpd_mth2_incen,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_incen > 0){
echo number_format($tpd_mth1_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_incen > 0){
echo number_format($hd_mth2_incen,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_incen > 0){
echo number_format($hd_mth1_incen,2);}



$cstc_mth1_incen = $bd_mth1_incen + $nd_mth1_incen + $pd_mth1_incen + $md_mth1_incen + $sld_mth1_incen + $kd_mth1_incen + $gd_mth1_incen + $ld_mth1_incen + $td_mth1_incen + $tpd_mth1_incen + $hd_mth1_incen ;
$cstc_mth2_incen = $bd_mth2_incen + $nd_mth2_incen + $pd_mth2_incen + $md_mth2_incen + $sld_mth2_incen + $kd_mth2_incen + $gd_mth2_incen + $ld_mth2_incen + $td_mth2_incen + $tpd_mth2_incen + $hd_mth2_incen ;

echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_incen >0){
echo number_format($cstc_mth2_incen,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

//$cstc_mth2_incen = $bd_mth2_incen + $nd_mth2_incen + $pd_mth2_incen + $md_mth2_incen + $sld_mth2_incen + $kd_mth2_incen + $gd_mth2_incen + $ld_mth2_incen + $td_mth2_incen + $tpd_mth2_incen + $hd_mth2_incen ;
if($cstc_mth1_incen >0){
echo number_format($cstc_mth1_incen,2);}


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "SPARES";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";


if($bd_mth2_store > 0){
echo number_format($bd_mth2_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_store > 0){
echo number_format($bd_mth1_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_store > 0){
echo number_format($nd_mth2_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_store > 0){
echo number_format($nd_mth1_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_store > 0){
echo number_format($pd_mth2_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_store > 0){
echo number_format($pd_mth1_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_store > 0){
echo number_format($md_mth2_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_store > 0){
echo number_format($md_mth1_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_store > 0){
echo number_format($sld_mth2_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_store > 0){
echo number_format($sld_mth1_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_store > 0){
echo number_format($kd_mth2_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_store > 0){
echo number_format($kd_mth1_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_store > 0){
echo number_format($gd_mth2_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_store > 0){
echo number_format($gd_mth1_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_store > 0){
echo number_format($ld_mth2_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_store > 0){
echo number_format($ld_mth1_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_store > 0){
echo number_format($td_mth2_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_store > 0){
echo number_format($td_mth1_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_store > 0){
echo number_format($tpd_mth2_store,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_store > 0){
echo number_format($tpd_mth1_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_store > 0){
echo number_format($hd_mth2_store,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_store > 0){
echo number_format($hd_mth1_store,2);}



$cstc_mth1_store = $bd_mth1_store + $nd_mth1_store + $pd_mth1_store + $md_mth1_store + $sld_mth1_store + $kd_mth1_store + $gd_mth1_store + $ld_mth1_store + $td_mth1_store + $tpd_mth1_store + $hd_mth1_store ;
$cstc_mth2_store = $bd_mth2_store + $nd_mth2_store + $pd_mth2_store + $md_mth2_store + $sld_mth2_store + $kd_mth2_store + $gd_mth2_store + $ld_mth2_store + $td_mth2_store + $tpd_mth2_store + $hd_mth2_store ;

echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_store >0){
echo number_format($cstc_mth2_store,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

//$cstc_mth2_store = $bd_mth2_store + $nd_mth2_store + $pd_mth2_store + $md_mth2_store + $sld_mth2_store + $kd_mth2_store + $gd_mth2_store + $ld_mth2_store + $td_mth2_store + $tpd_mth2_store + $hd_mth2_store ;
if($cstc_mth1_store >0){
echo number_format($cstc_mth1_store,2);}


//******************************************
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "MAINTENANCE";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";


if($bd_mth2_maint > 0){
echo number_format($bd_mth2_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_maint > 0){
echo number_format($bd_mth1_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_maint > 0){
echo number_format($nd_mth2_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_maint > 0){
echo number_format($nd_mth1_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_maint > 0){
echo number_format($pd_mth2_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_maint > 0){
echo number_format($pd_mth1_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_maint > 0){
echo number_format($md_mth2_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_maint > 0){
echo number_format($md_mth1_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_maint > 0){
echo number_format($sld_mth2_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_maint > 0){
echo number_format($sld_mth1_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_maint > 0){
echo number_format($kd_mth2_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_maint > 0){
echo number_format($kd_mth1_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_maint > 0){
echo number_format($gd_mth2_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_maint > 0){
echo number_format($gd_mth1_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_maint > 0){
echo number_format($ld_mth2_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_maint > 0){
echo number_format($ld_mth1_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_maint > 0){
echo number_format($td_mth2_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_maint > 0){
echo number_format($td_mth1_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_maint > 0){
echo number_format($tpd_mth2_maint,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_maint > 0){
echo number_format($tpd_mth1_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_maint > 0){
echo number_format($hd_mth2_maint,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_maint > 0){
echo number_format($hd_mth1_maint,2);}



$cstc_mth1_maint = $bd_mth1_maint + $nd_mth1_maint + $pd_mth1_maint + $md_mth1_maint + $sld_mth1_maint + $kd_mth1_maint + $gd_mth1_maint + $ld_mth1_maint + $td_mth1_maint + $tpd_mth1_maint + $hd_mth1_maint ;
$cstc_mth2_maint = $bd_mth2_maint + $nd_mth2_maint + $pd_mth2_maint + $md_mth2_maint + $sld_mth2_maint + $kd_mth2_maint + $gd_mth2_maint + $ld_mth2_maint + $td_mth2_maint + $tpd_mth2_maint + $hd_mth2_maint ;

echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_maint >0){
echo number_format($cstc_mth2_maint,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

//$cstc_mth2_maint = $bd_mth2_maint + $nd_mth2_maint + $pd_mth2_maint + $md_mth2_maint + $sld_mth2_maint + $kd_mth2_maint + $gd_mth2_maint + $ld_mth2_maint + $td_mth2_maint + $tpd_mth2_maint + $hd_mth2_maint ;
if($cstc_mth1_maint >0){
echo number_format($cstc_mth1_maint,2);}

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "HSD";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";


if($bd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($bd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($bd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($nd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($nd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($pd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($pd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($md_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($md_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($sld_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($sld_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($kd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($kd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($gd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($gd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($ld_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($ld_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($td_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($td_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($tpd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($tpd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 > 0){
echo number_format($hd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 > 0){
echo number_format($hd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000,2);}



$cstc_mth1_hsd_tot  = $bd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $nd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $pd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $md_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $sld_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $kd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $gd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $ld_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $td_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $tpd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 + $hd_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 ;
$cstc_mth2_hsd_tot  = $bd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $nd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $pd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $md_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $sld_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $kd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $gd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $ld_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $td_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $tpd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 + $hd_mth2_hsd_tot *  $hsd_rate_mth2 / 100000 ;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_hsd_tot  >0){
echo number_format($cstc_mth2_hsd_tot ,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

//$cstc_mth2_hsd_tot  = $bd_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $nd_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $pd_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $md_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $sld_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $kd_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $gd_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $ld_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $td_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $tpd_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 + $hd_mth2_hsd_tot *  $hsd_rate_mth1 / 100000 ;
if($cstc_mth1_hsd_tot *  $hsd_rate_mth1 / 100000 >0){
echo number_format($cstc_mth1_hsd_tot ,2);}


 

echo "</td></tr>";






echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "EPKM (Rs.)";
	


 

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC ";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_ac >0){
echo number_format(($bd_mth2_sale_1st_ac + $bd_mth2_sale_2nd_ac) / $bd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_ac >0){
echo number_format(($bd_mth1_sale_1st_ac + $bd_mth1_sale_2nd_ac) / $bd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_ac >0){
echo number_format(($nd_mth2_sale_1st_ac + $nd_mth2_sale_2nd_ac) / $nd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_ac >0){
echo number_format(($nd_mth1_sale_1st_ac + $nd_mth1_sale_2nd_ac) / $nd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_ac >0){
echo number_format(($pd_mth2_sale_1st_ac + $pd_mth2_sale_2nd_ac) / $pd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_ac >0){
echo number_format(($pd_mth1_sale_1st_ac + $pd_mth1_sale_2nd_ac) / $pd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_ac >0){
echo number_format(($md_mth2_sale_1st_ac + $md_mth2_sale_2nd_ac) / $md_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_ac >0){
echo number_format(($md_mth1_sale_1st_ac + $md_mth1_sale_2nd_ac) / $md_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_ac >0){
echo number_format(($sld_mth2_sale_1st_ac + $sld_mth2_sale_2nd_ac) / $sld_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_ac >0){
echo number_format(($sld_mth1_sale_1st_ac + $sld_mth1_sale_2nd_ac) / $sld_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_ac >0){
echo number_format(($kd_mth2_sale_1st_ac + $kd_mth2_sale_2nd_ac) / $kd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_ac >0){
echo number_format(($kd_mth1_sale_1st_ac + $kd_mth1_sale_2nd_ac) / $kd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_ac >0){
echo number_format(($gd_mth2_sale_1st_ac + $gd_mth2_sale_2nd_ac) / $gd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_ac >0){
echo number_format(($gd_mth1_sale_1st_ac + $gd_mth1_sale_2nd_ac) / $gd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_ac >0){
echo number_format(($ld_mth2_sale_1st_ac + $ld_mth2_sale_2nd_ac) / $ld_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_ac >0){
echo number_format(($ld_mth1_sale_1st_ac + $ld_mth1_sale_2nd_ac) / $ld_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_ac >0){
echo number_format(($td_mth2_sale_1st_ac + $td_mth2_sale_2nd_ac) / $td_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_ac >0){
echo number_format(($td_mth1_sale_1st_ac + $td_mth1_sale_2nd_ac) / $td_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_ac >0){
echo number_format(($tpd_mth2_sale_1st_ac + $tpd_mth2_sale_2nd_ac) / $tpd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_ac >0){
echo number_format(($tpd_mth1_sale_1st_ac + $tpd_mth1_sale_2nd_ac) / $tpd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_ac >0){
echo number_format(($hd_mth2_sale_1st_ac + $hd_mth2_sale_2nd_ac) / $hd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_ac >0){
echo number_format(($hd_mth1_sale_1st_ac + $hd_mth1_sale_2nd_ac) / $hd_mth1_km_ac,2);}

$cstc_epkm_mth2_ac_tot = ($bd_mth2_sale_1st_ac + $nd_mth2_sale_1st_ac + $pd_mth2_sale_1st_ac+ $md_mth2_sale_1st_ac + $sld_mth2_sale_1st_ac + $kd_mth2_sale_1st_ac + $gd_mth2_sale_1st_ac + $ld_mth2_sale_1st_ac + $td_mth2_sale_1st_ac + $tpd_mth2_sale_1st_ac + $hd_mth2_sale_1st_ac + $bd_mth2_sale_2nd_ac + $nd_mth2_sale_2nd_ac + $pd_mth2_sale_2nd_ac+ $md_mth2_sale_2nd_ac + $sld_mth2_sale_2nd_ac + $kd_mth2_sale_2nd_ac + $gd_mth2_sale_2nd_ac + $ld_mth2_sale_2nd_ac + $td_mth2_sale_2nd_ac + $tpd_mth2_sale_2nd_ac + $hd_mth2_sale_2nd_ac) /($bd_mth1_km_ac + $nd_mth1_km_ac + $pd_mth1_km_ac + $md_mth1_km_ac + $sld_mth1_km_ac + $kd_mth1_km_ac + $gd_mth1_km_ac + $ld_mth1_km_ac + $td_mth1_km_ac + $tpd_mth1_km_ac + $hd_mth1_km_ac) ;
$cstc_epkm_mth1_ac_tot = ($bd_mth1_sale_1st_ac + $nd_mth1_sale_1st_ac + $pd_mth1_sale_1st_ac+ $md_mth1_sale_1st_ac + $sld_mth1_sale_1st_ac + $kd_mth1_sale_1st_ac + $gd_mth1_sale_1st_ac + $ld_mth1_sale_1st_ac + $td_mth1_sale_1st_ac + $tpd_mth1_sale_1st_ac + $hd_mth1_sale_1st_ac + $bd_mth1_sale_2nd_ac + $nd_mth1_sale_2nd_ac + $pd_mth1_sale_2nd_ac+ $md_mth1_sale_2nd_ac + $sld_mth1_sale_2nd_ac + $kd_mth1_sale_2nd_ac + $gd_mth1_sale_2nd_ac + $ld_mth1_sale_2nd_ac + $td_mth1_sale_2nd_ac + $tpd_mth1_sale_2nd_ac + $hd_mth1_sale_2nd_ac) /($bd_mth1_km_ac + $nd_mth1_km_ac + $pd_mth1_km_ac + $md_mth1_km_ac + $sld_mth1_km_ac + $kd_mth1_km_ac + $gd_mth1_km_ac + $ld_mth1_km_ac + $td_mth1_km_ac + $tpd_mth1_km_ac + $hd_mth1_km_ac) ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_epkm_mth2_ac_tot >0){
echo number_format($cstc_epkm_mth2_ac_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_epkm_mth1_ac_tot >0){
echo number_format($cstc_epkm_mth1_ac_tot,2);}


 

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_nac_new >0){
echo number_format(($bd_mth2_sale_1st_nac_new + $bd_mth2_sale_2nd_nac_new) / $bd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth1_km_nac_new >0){
echo number_format(($bd_mth1_sale_1st_nac_new + $bd_mth1_sale_2nd_nac_new) / $bd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_nac_new >0){
echo number_format(($nd_mth2_sale_1st_nac_new + $nd_mth2_sale_2nd_nac_new) / $nd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_nac_new >0){
echo number_format(($nd_mth1_sale_1st_nac_new + $nd_mth1_sale_2nd_nac_new) / $nd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_nac_new >0){
echo number_format(($pd_mth2_sale_1st_nac_new + $pd_mth2_sale_2nd_nac_new) / $pd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_nac_new >0){
echo number_format(($pd_mth1_sale_1st_nac_new + $pd_mth1_sale_2nd_nac_new) / $pd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_nac_new >0){
echo number_format(($md_mth2_sale_1st_nac_new + $md_mth2_sale_2nd_nac_new) / $md_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_nac_new >0){
echo number_format(($md_mth1_sale_1st_nac_new + $md_mth1_sale_2nd_nac_new) / $md_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_nac_new >0){
echo number_format(($sld_mth2_sale_1st_nac_new + $sld_mth2_sale_2nd_nac_new) / $sld_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_nac_new >0){
echo number_format(($sld_mth1_sale_1st_nac_new + $sld_mth1_sale_2nd_nac_new) / $sld_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_nac_new >0){
echo number_format(($kd_mth2_sale_1st_nac_new + $kd_mth2_sale_2nd_nac_new) / $kd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_nac_new >0){
echo number_format(($kd_mth1_sale_1st_nac_new + $kd_mth1_sale_2nd_nac_new) / $kd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_nac_new >0){
echo number_format(($gd_mth2_sale_1st_nac_new + $gd_mth2_sale_2nd_nac_new) / $gd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_nac_new >0){
echo number_format(($gd_mth1_sale_1st_nac_new + $gd_mth1_sale_2nd_nac_new) / $gd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_nac_new >0){
echo number_format(($ld_mth2_sale_1st_nac_new + $ld_mth2_sale_2nd_nac_new) / $ld_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_nac_new >0){
echo number_format(($ld_mth1_sale_1st_nac_new + $ld_mth1_sale_2nd_nac_new) / $ld_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_nac_new >0){
echo number_format(($td_mth2_sale_1st_nac_new + $td_mth2_sale_2nd_nac_new) / $td_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_nac_new >0){
echo number_format(($td_mth1_sale_1st_nac_new + $td_mth1_sale_2nd_nac_new) / $td_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_nac_new >0){
echo number_format(($tpd_mth2_sale_1st_nac_new + $tpd_mth2_sale_2nd_nac_new) / $tpd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_nac_new >0){
echo number_format(($tpd_mth1_sale_1st_nac_new + $tpd_mth1_sale_2nd_nac_new) / $tpd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_nac_new >0){
echo number_format(($hd_mth2_sale_1st_nac_new + $hd_mth2_sale_2nd_nac_new) / $hd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_nac_new >0){
echo number_format(($hd_mth1_sale_1st_nac_new + $hd_mth1_sale_2nd_nac_new) / $hd_mth1_km_nac_new,2);}

$cstc_epkm_mth2_nac_new_tot = ($bd_mth2_sale_1st_nac_new + $nd_mth2_sale_1st_nac_new + $pd_mth2_sale_1st_nac_new+ $md_mth2_sale_1st_nac_new + $sld_mth2_sale_1st_nac_new + $kd_mth2_sale_1st_nac_new + $gd_mth2_sale_1st_nac_new + $ld_mth2_sale_1st_nac_new + $td_mth2_sale_1st_nac_new + $tpd_mth2_sale_1st_nac_new + $hd_mth2_sale_1st_nac_new + $bd_mth2_sale_2nd_nac_new + $nd_mth2_sale_2nd_nac_new + $pd_mth2_sale_2nd_nac_new+ $md_mth2_sale_2nd_nac_new + $sld_mth2_sale_2nd_nac_new + $kd_mth2_sale_2nd_nac_new + $gd_mth2_sale_2nd_nac_new + $ld_mth2_sale_2nd_nac_new + $td_mth2_sale_2nd_nac_new + $tpd_mth2_sale_2nd_nac_new + $hd_mth2_sale_2nd_nac_new) /($bd_mth1_km_nac_new + $nd_mth1_km_nac_new + $pd_mth1_km_nac_new + $md_mth1_km_nac_new + $sld_mth1_km_nac_new + $kd_mth1_km_nac_new + $gd_mth1_km_nac_new + $ld_mth1_km_nac_new + $td_mth1_km_nac_new + $tpd_mth1_km_nac_new + $hd_mth1_km_nac_new) ;
$cstc_epkm_mth1_nac_new_tot = ($bd_mth1_sale_1st_nac_new + $nd_mth1_sale_1st_nac_new + $pd_mth1_sale_1st_nac_new+ $md_mth1_sale_1st_nac_new + $sld_mth1_sale_1st_nac_new + $kd_mth1_sale_1st_nac_new + $gd_mth1_sale_1st_nac_new + $ld_mth1_sale_1st_nac_new + $td_mth1_sale_1st_nac_new + $tpd_mth1_sale_1st_nac_new + $hd_mth1_sale_1st_nac_new + $bd_mth1_sale_2nd_nac_new + $nd_mth1_sale_2nd_nac_new + $pd_mth1_sale_2nd_nac_new+ $md_mth1_sale_2nd_nac_new + $sld_mth1_sale_2nd_nac_new + $kd_mth1_sale_2nd_nac_new + $gd_mth1_sale_2nd_nac_new + $ld_mth1_sale_2nd_nac_new + $td_mth1_sale_2nd_nac_new + $tpd_mth1_sale_2nd_nac_new + $hd_mth1_sale_2nd_nac_new) /($bd_mth1_km_nac_new + $nd_mth1_km_nac_new + $pd_mth1_km_nac_new + $md_mth1_km_nac_new + $sld_mth1_km_nac_new + $kd_mth1_km_nac_new + $gd_mth1_km_nac_new + $ld_mth1_km_nac_new + $td_mth1_km_nac_new + $tpd_mth1_km_nac_new + $hd_mth1_km_nac_new) ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_epkm_mth2_nac_new_tot >0){
echo number_format($cstc_epkm_mth2_nac_new_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_epkm_mth1_nac_new_tot >0){
echo number_format($cstc_epkm_mth1_nac_new_tot,2);}


 


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_nac_old >0){
echo number_format(($bd_mth2_sale_1st_nac_old + $bd_mth2_sale_2nd_nac_old) / $bd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_nac_old >0){
echo number_format(($bd_mth1_sale_1st_nac_old + $bd_mth1_sale_2nd_nac_old) / $bd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_nac_old >0){
echo number_format(($nd_mth2_sale_1st_nac_old + $nd_mth2_sale_2nd_nac_old) / $nd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_nac_old >0){
echo number_format(($nd_mth1_sale_1st_nac_old + $nd_mth1_sale_2nd_nac_old) / $nd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_nac_old >0){
echo number_format(($pd_mth2_sale_1st_nac_old + $pd_mth2_sale_2nd_nac_old) / $pd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_nac_old >0){
echo number_format(($pd_mth1_sale_1st_nac_old + $pd_mth1_sale_2nd_nac_old) / $pd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_nac_old >0){
echo number_format(($md_mth2_sale_1st_nac_old + $md_mth2_sale_2nd_nac_old) / $md_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_nac_old >0){
echo number_format(($md_mth1_sale_1st_nac_old + $md_mth1_sale_2nd_nac_old) / $md_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_nac_old >0){
echo number_format(($sld_mth2_sale_1st_nac_old + $sld_mth2_sale_2nd_nac_old) / $sld_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_nac_old >0){
echo number_format(($sld_mth1_sale_1st_nac_old + $sld_mth1_sale_2nd_nac_old) / $sld_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_nac_old >0){
echo number_format(($kd_mth2_sale_1st_nac_old + $kd_mth2_sale_2nd_nac_old) / $kd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_nac_old >0){
echo number_format(($kd_mth1_sale_1st_nac_old + $kd_mth1_sale_2nd_nac_old) / $kd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_nac_old >0){
echo number_format(($gd_mth2_sale_1st_nac_old + $gd_mth2_sale_2nd_nac_old) / $gd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_nac_old >0){
echo number_format(($gd_mth1_sale_1st_nac_old + $gd_mth1_sale_2nd_nac_old) / $gd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_nac_old >0){
echo number_format(($ld_mth2_sale_1st_nac_old + $ld_mth2_sale_2nd_nac_old) / $ld_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_nac_old >0){
echo number_format(($ld_mth1_sale_1st_nac_old + $ld_mth1_sale_2nd_nac_old) / $ld_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_nac_old >0){
echo number_format(($td_mth2_sale_1st_nac_old + $td_mth2_sale_2nd_nac_old) / $td_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_nac_old >0){
echo number_format(($td_mth1_sale_1st_nac_old + $td_mth1_sale_2nd_nac_old) / $td_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_nac_old >0){
echo number_format(($tpd_mth2_sale_1st_nac_old + $tpd_mth2_sale_2nd_nac_old) / $tpd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_nac_old >0){
echo number_format(($tpd_mth1_sale_1st_nac_old + $tpd_mth1_sale_2nd_nac_old) / $tpd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_nac_old >0){
echo number_format(($hd_mth2_sale_1st_nac_old + $hd_mth2_sale_2nd_nac_old) / $hd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_nac_old >0){
echo number_format(($hd_mth1_sale_1st_nac_old + $hd_mth1_sale_2nd_nac_old) / $hd_mth1_km_nac_old,2);}

$cstc_epkm_mth2_nac_old_tot = ($bd_mth2_sale_1st_nac_old + $nd_mth2_sale_1st_nac_old + $pd_mth2_sale_1st_nac_old+ $md_mth2_sale_1st_nac_old + $sld_mth2_sale_1st_nac_old + $kd_mth2_sale_1st_nac_old + $gd_mth2_sale_1st_nac_old + $ld_mth2_sale_1st_nac_old + $td_mth2_sale_1st_nac_old + $tpd_mth2_sale_1st_nac_old + $hd_mth2_sale_1st_nac_old + $bd_mth2_sale_2nd_nac_old + $nd_mth2_sale_2nd_nac_old + $pd_mth2_sale_2nd_nac_old+ $md_mth2_sale_2nd_nac_old + $sld_mth2_sale_2nd_nac_old + $kd_mth2_sale_2nd_nac_old + $gd_mth2_sale_2nd_nac_old + $ld_mth2_sale_2nd_nac_old + $td_mth2_sale_2nd_nac_old + $tpd_mth2_sale_2nd_nac_old + $hd_mth2_sale_2nd_nac_old) /($bd_mth1_km_nac_old + $nd_mth1_km_nac_old + $pd_mth1_km_nac_old + $md_mth1_km_nac_old + $sld_mth1_km_nac_old + $kd_mth1_km_nac_old + $gd_mth1_km_nac_old + $ld_mth1_km_nac_old + $td_mth1_km_nac_old + $tpd_mth1_km_nac_old + $hd_mth1_km_nac_old) ;
$cstc_epkm_mth1_nac_old_tot = ($bd_mth1_sale_1st_nac_old + $nd_mth1_sale_1st_nac_old + $pd_mth1_sale_1st_nac_old+ $md_mth1_sale_1st_nac_old + $sld_mth1_sale_1st_nac_old + $kd_mth1_sale_1st_nac_old + $gd_mth1_sale_1st_nac_old + $ld_mth1_sale_1st_nac_old + $td_mth1_sale_1st_nac_old + $tpd_mth1_sale_1st_nac_old + $hd_mth1_sale_1st_nac_old + $bd_mth1_sale_2nd_nac_old + $nd_mth1_sale_2nd_nac_old + $pd_mth1_sale_2nd_nac_old+ $md_mth1_sale_2nd_nac_old + $sld_mth1_sale_2nd_nac_old + $kd_mth1_sale_2nd_nac_old + $gd_mth1_sale_2nd_nac_old + $ld_mth1_sale_2nd_nac_old + $td_mth1_sale_2nd_nac_old + $tpd_mth1_sale_2nd_nac_old + $hd_mth1_sale_2nd_nac_old) /($bd_mth1_km_nac_old + $nd_mth1_km_nac_old + $pd_mth1_km_nac_old + $md_mth1_km_nac_old + $sld_mth1_km_nac_old + $kd_mth1_km_nac_old + $gd_mth1_km_nac_old + $ld_mth1_km_nac_old + $td_mth1_km_nac_old + $tpd_mth1_km_nac_old + $hd_mth1_km_nac_old) ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_epkm_mth2_nac_old_tot >0){
echo number_format($cstc_epkm_mth2_nac_old_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_epkm_mth1_nac_old_tot >0){
echo number_format($cstc_epkm_mth1_nac_old_tot,2);}





 

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_tot >0){
echo number_format($bd_mth2_sale_tot / $bd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_tot >0){
echo number_format($bd_mth1_sale_tot / $bd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_tot >0){
echo number_format($nd_mth2_sale_tot / $nd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_tot >0){
echo number_format($nd_mth1_sale_tot / $nd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_tot >0){
echo number_format($pd_mth2_sale_tot / $pd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_tot >0){
echo number_format($pd_mth1_sale_tot / $pd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_tot >0){
echo number_format($md_mth2_sale_tot / $md_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_tot >0){
echo number_format($md_mth1_sale_tot / $md_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_tot >0){
echo number_format($sld_mth2_sale_tot / $sld_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_tot >0){
echo number_format($sld_mth1_sale_tot / $sld_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_tot >0){
echo number_format($kd_mth2_sale_tot / $kd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_tot >0){
echo number_format($kd_mth1_sale_tot / $kd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_tot >0){
echo number_format($gd_mth2_sale_tot / $gd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_tot >0){
echo number_format($gd_mth1_sale_tot / $gd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_tot >0){
echo number_format($ld_mth2_sale_tot / $sld_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_tot >0){
echo number_format($ld_mth1_sale_tot / $ld_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_tot >0){
echo number_format($td_mth2_sale_tot / $td_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_tot >0){
echo number_format($td_mth1_sale_tot / $td_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_tot >0){
echo number_format($tpd_mth2_sale_tot / $tpd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_tot >0){
echo number_format($tpd_mth1_sale_tot / $tpd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_tot >0){
echo number_format($hd_mth2_sale_tot / $hd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_tot >0){
echo number_format($hd_mth1_sale_tot / $hd_mth1_km_tot,2);}

$cstc_epkm_mth2_tot = ($bd_mth2_sale_tot + $nd_mth2_sale_tot + $pd_mth2_sale_tot + $md_mth2_sale_tot + $sld_mth2_sale_tot + $kd_mth2_sale_tot + $gd_mth2_sale_tot + $ld_mth2_sale_tot + $td_mth2_sale_tot + $tpd_mth2_sale_tot + $hd_mth2_sale_tot) / $cstc_km_mth2_tot;
$cstc_epkm_mth1_tot = ($bd_mth1_sale_tot + $nd_mth1_sale_tot + $pd_mth1_sale_tot + $md_mth1_sale_tot + $sld_mth1_sale_tot + $kd_mth1_sale_tot + $gd_mth1_sale_tot + $ld_mth1_sale_tot + $td_mth1_sale_tot + $tpd_mth1_sale_tot + $hd_mth1_sale_tot) / $cstc_km_mth1_tot;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_epkm_mth2_tot >0){
echo number_format($cstc_epkm_mth2_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_epkm_mth1_tot >0){
echo number_format($cstc_epkm_mth1_tot,2);}


$sql = "update month_data set epkm = " .  number_format(($bd_mth2_sale_tot ) / $bd_mth2_km_tot,2)  . " where mth = '" . $mth2 ."' and unit = 'BD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($bd_mth1_sale_tot ) / $bd_mth1_km_tot,2)  . " where mth = '" . $mth1 ."' and unit = 'BD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($nd_mth2_sale_tot ) / $nd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'ND'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($nd_mth1_sale_tot ) / $nd_mth1_km_tot,2)  . "   where mth = '" . $mth1 ."' and unit = 'ND'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($pd_mth2_sale_tot ) / $pd_mth2_km_tot,2)  . "   where mth = '" . $mth2 ."' and unit = 'PD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($pd_mth1_sale_tot ) / $pd_mth1_km_tot,2)  . "   where mth = '" . $mth1 ."' and unit = 'PD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($md_mth2_sale_tot ) / $md_mth2_km_tot,2)  . "   where mth = '" . $mth2 ."' and unit = 'MD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($md_mth1_sale_tot ) / $md_mth1_km_tot,2) . "   where mth = '" . $mth1 ."' and unit = 'MD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($sld_mth2_sale_tot ) / $sld_mth2_km_tot,2)  . "   where mth = '" . $mth2 ."' and unit = 'SLD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($sld_mth1_sale_tot ) / $sld_mth1_km_tot,2)  . "   where mth = '" . $mth1 ."' and unit = 'SLD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($kd_mth2_sale_tot ) / $kd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'KD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($kd_mth1_sale_tot ) / $kd_mth1_km_tot,2)  . "   where mth = '" . $mth1 ."' and unit = 'KD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($gd_mth2_sale_tot ) / $gd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'GD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($gd_mth1_sale_tot ) / $gd_mth1_km_tot,2)  . "  where mth = '" . $mth1 ."' and unit = 'GD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($ld_mth2_sale_tot ) / $ld_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'LD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($ld_mth1_sale_tot ) / $ld_mth1_km_tot,2)  . "  where mth = '" . $mth1 ."' and unit = 'LD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($td_mth2_sale_tot ) / $td_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'TD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($td_mth1_sale_tot ) / $td_mth1_km_tot,2) . "  where mth = '" . $mth1 ."' and unit = 'TD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($tpd_mth2_sale_tot ) / $tpd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'TPD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($tpd_mth1_sale_tot ) / $tpd_mth1_km_tot,2) . "  where mth = '" . $mth1 ."' and unit = 'TPD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($hd_mth2_sale_tot ) / $hd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'HD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set epkm = "  . number_format(($hd_mth1_sale_tot ) / $hd_mth1_km_tot,2)  . "  where mth = '" . $mth1 ."' and unit = 'HD'" ;
$result = mysqli_query($cstccon,$sql);








 
echo "</td></tr>";
echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "CPKM (Rs.) OPERATIONAL";



 

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC ";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_ac >0){
echo number_format((($bd_mth2_opr_cost_ac / 100000)) / $bd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_ac >0){
echo number_format((($bd_mth1_opr_cost_ac / 100000)) / $bd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_ac >0){
echo number_format((($nd_mth2_opr_cost_ac / 100000)) / $nd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_ac >0){
echo number_format((($nd_mth1_opr_cost_ac / 100000)) / $nd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_ac >0){
echo number_format((($pd_mth2_opr_cost_ac / 100000)) / $pd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_ac >0){
echo number_format((($pd_mth1_opr_cost_ac / 100000)) / $pd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_ac >0){
echo number_format((($md_mth2_opr_cost_ac / 100000)) / $md_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_ac >0){
echo number_format((($md_mth1_opr_cost_ac / 100000)) / $md_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_ac >0){
echo number_format((($sld_mth2_opr_cost_ac / 100000)) / $sld_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_ac >0){
echo number_format((($sld_mth1_opr_cost_ac / 100000)) / $sld_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_ac >0){
echo number_format((($kd_mth2_opr_cost_ac / 100000)) / $kd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_ac >0){
echo number_format((($kd_mth1_opr_cost_ac / 100000)) / $kd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_ac >0){
echo number_format((($gd_mth2_opr_cost_ac / 100000)) / $gd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_ac >0){
echo number_format((($gd_mth1_opr_cost_ac / 100000)) / $gd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_ac >0){
echo number_format((($ld_mth2_opr_cost_ac / 100000)) / $ld_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_ac >0){
echo number_format((($ld_mth1_opr_cost_ac / 100000)) / $ld_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_ac >0){
echo number_format((($td_mth2_opr_cost_ac / 100000)) / $td_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_ac >0){
echo number_format((($td_mth1_opr_cost_ac / 100000)) / $td_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_ac >0){
echo number_format((($tpd_mth2_opr_cost_ac / 100000)) / $tpd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_ac >0){
echo number_format((($tpd_mth1_opr_cost_ac / 100000)) / $tpd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_ac >0){
echo number_format((($hd_mth2_opr_cost_ac / 100000) ) / $hd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_ac >0){
echo number_format((($hd_mth1_opr_cost_ac / 100000)) / $hd_mth1_km_ac,2);}

$cstc_cpkm_mth2_ac_tot = ((($bd_mth2_opr_cost_ac + $nd_mth2_opr_cost_ac + $pd_mth2_opr_cost_ac+ $md_mth2_opr_cost_ac + $sld_mth2_opr_cost_ac + $kd_mth2_opr_cost_ac + $gd_mth2_opr_cost_ac + $ld_mth2_opr_cost_ac + $td_mth2_opr_cost_ac + $tpd_mth2_opr_cost_ac + $hd_mth2_opr_cost_ac )) / 100000 ) /($cstc_km_mth2_ac_tot) ;
$cstc_cpkm_mth1_ac_tot = ((($bd_mth1_opr_cost_ac + $nd_mth1_opr_cost_ac + $pd_mth1_opr_cost_ac+ $md_mth1_opr_cost_ac + $sld_mth1_opr_cost_ac + $kd_mth1_opr_cost_ac + $gd_mth1_opr_cost_ac + $ld_mth1_opr_cost_ac + $td_mth1_opr_cost_ac + $tpd_mth1_opr_cost_ac + $hd_mth1_opr_cost_ac )) / 100000 ) /($bd_mth1_km_ac + $nd_mth1_km_ac + $pd_mth1_km_ac + $md_mth1_km_ac + $sld_mth1_km_ac + $kd_mth1_km_ac + $gd_mth1_km_ac + $ld_mth1_km_ac + $td_mth1_km_ac + $tpd_mth1_km_ac + $hd_mth1_km_ac) ;




echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_cpkm_mth2_ac_tot >0){
echo number_format($cstc_cpkm_mth2_ac_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_cpkm_mth1_ac_tot >0){
echo number_format($cstc_cpkm_mth1_ac_tot,2);}


 



echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_nac_new >0){
echo number_format((($bd_mth2_opr_cost_nac_new / 100000)) / $bd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_nac_new >0){
echo number_format((($bd_mth1_opr_cost_nac_new / 100000)) / $bd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_nac_new >0){
echo number_format((($nd_mth2_opr_cost_nac_new / 100000)) / $nd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_nac_new >0){
echo number_format((($nd_mth1_opr_cost_nac_new / 100000)) / $nd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_nac_new >0){
echo number_format((($pd_mth2_opr_cost_nac_new / 100000)) / $pd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_nac_new >0){
echo number_format((($pd_mth1_opr_cost_nac_new / 100000)) / $pd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_nac_new >0){
echo number_format((($md_mth2_opr_cost_nac_new / 100000)) / $md_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_nac_new >0){
echo number_format((($md_mth1_opr_cost_nac_new / 100000)) / $md_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_nac_new >0){
echo number_format((($sld_mth2_opr_cost_nac_new / 100000)) / $sld_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_nac_new >0){
echo number_format((($sld_mth1_opr_cost_nac_new / 100000)) / $sld_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_nac_new >0){
echo number_format((($kd_mth2_opr_cost_nac_new / 100000) ) / $kd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_nac_new >0){
echo number_format((($kd_mth1_opr_cost_nac_new / 100000)) / $kd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_nac_new >0){
echo number_format((($gd_mth2_opr_cost_nac_new / 100000)) / $gd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_nac_new >0){
echo number_format((($gd_mth1_opr_cost_nac_new / 100000)) / $gd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_nac_new >0){
echo number_format((($ld_mth2_opr_cost_nac_new / 100000)) / $ld_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_nac_new >0){
echo number_format((($ld_mth1_opr_cost_nac_new / 100000)) / $ld_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_nac_new >0){
echo number_format((($td_mth2_opr_cost_nac_new / 100000)) / $td_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_nac_new >0){
echo number_format((($td_mth1_opr_cost_nac_new / 100000)) / $td_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_nac_new >0){
echo number_format((($tpd_mth2_opr_cost_nac_new / 100000)) / $tpd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_nac_new >0){
echo number_format((($tpd_mth1_opr_cost_nac_new / 100000)) / $tpd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_nac_new >0){
echo number_format((($hd_mth2_opr_cost_nac_new / 100000)) / $hd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_nac_new >0){
echo number_format((($hd_mth1_opr_cost_nac_new / 100000)) / $hd_mth1_km_nac_new,2);}

$cstc_cpkm_mth2_nac_new_tot = ((($bd_mth2_opr_cost_nac_new + $nd_mth2_opr_cost_nac_new + $pd_mth2_opr_cost_nac_new+ $md_mth2_opr_cost_nac_new + $sld_mth2_opr_cost_nac_new + $kd_mth2_opr_cost_nac_new + $gd_mth2_opr_cost_nac_new + $ld_mth2_opr_cost_nac_new + $td_mth2_opr_cost_nac_new + $tpd_mth2_opr_cost_nac_new + $hd_mth2_opr_cost_nac_new )) / 100000 ) /($bd_mth2_km_nac_new + $nd_mth2_km_nac_new + $pd_mth2_km_nac_new + $md_mth2_km_nac_new + $sld_mth2_km_nac_new + $kd_mth2_km_nac_new + $gd_mth2_km_nac_new + $ld_mth2_km_nac_new + $td_mth2_km_nac_new + $tpd_mth2_km_nac_new + $hd_mth2_km_nac_new)  ;
$cstc_cpkm_mth1_nac_new_tot = ((($bd_mth1_opr_cost_nac_new + $nd_mth1_opr_cost_nac_new + $pd_mth1_opr_cost_nac_new+ $md_mth1_opr_cost_nac_new + $sld_mth1_opr_cost_nac_new + $kd_mth1_opr_cost_nac_new + $gd_mth1_opr_cost_nac_new + $ld_mth1_opr_cost_nac_new + $td_mth1_opr_cost_nac_new + $tpd_mth1_opr_cost_nac_new + $hd_mth1_opr_cost_nac_new )) / 100000 ) /($bd_mth1_km_nac_new + $nd_mth1_km_nac_new + $pd_mth1_km_nac_new + $md_mth1_km_nac_new + $sld_mth1_km_nac_new + $kd_mth1_km_nac_new + $gd_mth1_km_nac_new + $ld_mth1_km_nac_new + $td_mth1_km_nac_new + $tpd_mth1_km_nac_new + $hd_mth1_km_nac_new) ;




echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_cpkm_mth2_nac_new_tot >0){
echo number_format($cstc_cpkm_mth2_nac_new_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_cpkm_mth1_nac_new_tot >0){
echo number_format($cstc_cpkm_mth1_nac_new_tot,2);}


 



echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD ";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_nac_old >0){
echo number_format((($bd_mth2_opr_cost_nac_old / 100000)) / $bd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_nac_old >0){
echo number_format((($bd_mth1_opr_cost_nac_old / 100000)) / $bd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_nac_old >0){
echo number_format((($nd_mth2_opr_cost_nac_old / 100000)) / $nd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_nac_old >0){
echo number_format((($nd_mth1_opr_cost_nac_old / 100000)) / $nd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_nac_old >0){
echo number_format((($pd_mth2_opr_cost_nac_old / 100000)) / $pd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_nac_old >0){
echo number_format((($pd_mth1_opr_cost_nac_old / 100000)) / $pd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_nac_old >0){
echo number_format((($md_mth2_opr_cost_nac_old / 100000) ) / $md_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_nac_old >0){
echo number_format((($md_mth1_opr_cost_nac_old / 100000) ) / $md_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_nac_old >0){
echo number_format((($sld_mth2_opr_cost_nac_old / 100000)) / $sld_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_nac_old >0){
echo number_format((($sld_mth1_opr_cost_nac_old / 100000) ) / $sld_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_nac_old >0){
echo number_format((($kd_mth2_opr_cost_nac_old / 100000)) / $kd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_nac_old >0){
echo number_format((($kd_mth1_opr_cost_nac_old / 100000) ) / $kd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_nac_old >0){
echo number_format((($gd_mth2_opr_cost_nac_old / 100000)) / $gd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_nac_old >0){
echo number_format((($gd_mth1_opr_cost_nac_old / 100000)) / $gd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_nac_old >0){
echo number_format((($ld_mth2_opr_cost_nac_old / 100000)) / $ld_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_nac_old >0){
echo number_format((($ld_mth1_opr_cost_nac_old / 100000) ) / $ld_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_nac_old >0){
echo number_format((($td_mth2_opr_cost_nac_old / 100000)) / $td_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_nac_old >0){
echo number_format((($td_mth1_opr_cost_nac_old / 100000)) / $td_mth1_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_nac_old >0){
echo number_format((($tpd_mth2_opr_cost_nac_old / 100000)) / $tpd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_nac_old >0){
echo number_format((($tpd_mth1_opr_cost_nac_old / 100000)) / $tpd_mth1_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_nac_old >0){
echo number_format((($hd_mth2_opr_cost_nac_old / 100000)) / $hd_mth2_km_nac_old,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_nac_old >0){
echo number_format((($hd_mth1_opr_cost_nac_old / 100000)) / $hd_mth1_km_nac_old,2);}

$cstc_cpkm_mth2_nac_old_tot = ((($bd_mth2_opr_cost_nac_old + $nd_mth2_opr_cost_nac_old + $pd_mth2_opr_cost_nac_old+ $md_mth2_opr_cost_nac_old + $sld_mth2_opr_cost_nac_old + $kd_mth2_opr_cost_nac_old + $gd_mth2_opr_cost_nac_old + $ld_mth2_opr_cost_nac_old + $td_mth2_opr_cost_nac_old + $tpd_mth2_opr_cost_nac_old + $hd_mth2_opr_cost_nac_old )) / 100000 ) /($bd_mth2_km_nac_old + $nd_mth2_km_nac_old + $pd_mth2_km_nac_old + $md_mth2_km_nac_old + $sld_mth2_km_nac_old + $kd_mth2_km_nac_old + $gd_mth2_km_nac_old + $ld_mth2_km_nac_old + $td_mth2_km_nac_old + $tpd_mth2_km_nac_old + $hd_mth2_km_nac_old)  ;
$cstc_cpkm_mth1_nac_old_tot = ((($bd_mth1_opr_cost_nac_old + $nd_mth1_opr_cost_nac_old + $pd_mth1_opr_cost_nac_old+ $md_mth1_opr_cost_nac_old + $sld_mth1_opr_cost_nac_old + $kd_mth1_opr_cost_nac_old + $gd_mth1_opr_cost_nac_old + $ld_mth1_opr_cost_nac_old + $td_mth1_opr_cost_nac_old + $tpd_mth1_opr_cost_nac_old + $hd_mth1_opr_cost_nac_old )) / 100000 ) /($bd_mth1_km_nac_old + $nd_mth1_km_nac_old + $pd_mth1_km_nac_old + $md_mth1_km_nac_old + $sld_mth1_km_nac_old + $kd_mth1_km_nac_old + $gd_mth1_km_nac_old + $ld_mth1_km_nac_old + $td_mth1_km_nac_old + $tpd_mth1_km_nac_old + $hd_mth1_km_nac_old) ;




echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_cpkm_mth2_nac_old_tot >0){
echo number_format($cstc_cpkm_mth2_nac_old_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_cpkm_mth1_nac_old_tot >0){
echo number_format($cstc_cpkm_mth1_nac_old_tot,2);}


 



echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_tot >0){
echo number_format((($bd_mth2_opr_cost_tot / 100000)) / $bd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_tot >0){
echo number_format((($bd_mth1_opr_cost_tot / 100000)) / $bd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_tot >0){
echo number_format((($nd_mth2_opr_cost_tot / 100000)) / $nd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_tot >0){
echo number_format((($nd_mth1_opr_cost_tot / 100000)) / $nd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_tot >0){
echo number_format((($pd_mth2_opr_cost_tot / 100000)) / $pd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_tot >0){
echo number_format((($pd_mth1_opr_cost_tot / 100000) ) / $pd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_tot >0){
echo number_format((($md_mth2_opr_cost_tot / 100000)) / $md_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_tot >0){
echo number_format((($md_mth1_opr_cost_tot / 100000)) / $md_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_tot >0){
echo number_format((($sld_mth2_opr_cost_tot / 100000)) / $sld_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_tot >0){
echo number_format((($sld_mth1_opr_cost_tot / 100000)) / $sld_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_tot >0){
echo number_format((($kd_mth2_opr_cost_tot / 100000)) / $kd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_tot >0){
echo number_format((($kd_mth1_opr_cost_tot / 100000)) / $kd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_tot >0){
echo number_format((($gd_mth2_opr_cost_tot / 100000)) / $gd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_tot >0){
echo number_format((($gd_mth1_opr_cost_tot / 100000)) / $gd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_tot >0){
echo number_format((($ld_mth2_opr_cost_tot / 100000)) / $ld_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_tot >0){
echo number_format((($ld_mth1_opr_cost_tot / 100000)) / $ld_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_tot >0){
echo number_format((($td_mth2_opr_cost_tot / 100000)) / $td_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_tot >0){
echo number_format((($td_mth1_opr_cost_tot / 100000)) / $td_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_tot >0){
echo number_format((($tpd_mth2_opr_cost_tot / 100000)) / $tpd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_tot >0){
echo number_format((($tpd_mth1_opr_cost_tot / 100000)) / $tpd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_tot >0){
echo number_format((($hd_mth2_opr_cost_tot / 100000) ) / $hd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_tot >0){
echo number_format((($hd_mth1_opr_cost_tot / 100000)) / $hd_mth1_km_tot,2);}

$cstc_cpkm_mth2_opr_tot = ((($bd_mth2_opr_cost_tot + $nd_mth2_opr_cost_tot + $pd_mth2_opr_cost_tot+ $md_mth2_opr_cost_tot + $sld_mth2_opr_cost_tot + $kd_mth2_opr_cost_tot + $gd_mth2_opr_cost_tot + $ld_mth2_opr_cost_tot + $td_mth2_opr_cost_tot + $tpd_mth2_opr_cost_tot + $hd_mth2_opr_cost_tot )) / 100000 ) /($bd_mth2_km_tot + $nd_mth2_km_tot + $pd_mth2_km_tot + $md_mth2_km_tot + $sld_mth2_km_tot + $kd_mth2_km_tot + $gd_mth2_km_tot + $ld_mth2_km_tot + $td_mth2_km_tot + $tpd_mth2_km_tot + $hd_mth2_km_tot)  ;
$cstc_cpkm_mth1_opr_tot = ((($bd_mth1_opr_cost_tot + $nd_mth1_opr_cost_tot + $pd_mth1_opr_cost_tot+ $md_mth1_opr_cost_tot + $sld_mth1_opr_cost_tot + $kd_mth1_opr_cost_tot + $gd_mth1_opr_cost_tot + $ld_mth1_opr_cost_tot + $td_mth1_opr_cost_tot + $tpd_mth1_opr_cost_tot + $hd_mth1_opr_cost_tot )) / 100000 ) /($bd_mth1_km_tot + $nd_mth1_km_tot + $pd_mth1_km_tot + $md_mth1_km_tot + $sld_mth1_km_tot + $kd_mth1_km_tot + $gd_mth1_km_tot + $ld_mth1_km_tot + $td_mth1_km_tot + $tpd_mth1_km_tot + $hd_mth1_km_tot)  ;

$sql = "update month_data set cpkm_opr = " .  number_format(($bd_mth2_opr_cost_tot / 100000) / $bd_mth2_km_tot,2)  . " where mth = '" . $mth2 ."' and unit = 'BD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($bd_mth1_opr_cost_tot / 100000) / $bd_mth1_km_tot,2)  . " where mth = '" . $mth1 ."' and unit = 'BD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($nd_mth2_opr_cost_tot / 100000) / $nd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'ND'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($nd_mth1_opr_cost_tot / 100000) / $nd_mth1_km_tot,2)  . "   where mth = '" . $mth1 ."' and unit = 'ND'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($pd_mth2_opr_cost_tot / 100000) / $pd_mth2_km_tot,2)  . "   where mth = '" . $mth2 ."' and unit = 'PD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($pd_mth1_opr_cost_tot / 100000) / $pd_mth1_km_tot,2)  . "   where mth = '" . $mth1 ."' and unit = 'PD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($md_mth2_opr_cost_tot / 100000) / $md_mth2_km_tot,2)  . "   where mth = '" . $mth2 ."' and unit = 'MD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($md_mth1_opr_cost_tot / 100000) / $md_mth1_km_tot,2) . "   where mth = '" . $mth1 ."' and unit = 'MD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($sld_mth2_opr_cost_tot / 100000) / $sld_mth2_km_tot,2)  . "   where mth = '" . $mth2 ."' and unit = 'SLD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($sld_mth1_opr_cost_tot / 100000) / $sld_mth1_km_tot,2)  . "   where mth = '" . $mth1 ."' and unit = 'SLD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($kd_mth2_opr_cost_tot / 100000) / $kd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'KD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($kd_mth1_opr_cost_tot / 100000) / $kd_mth1_km_tot,2)  . "   where mth = '" . $mth1 ."' and unit = 'KD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($gd_mth2_opr_cost_tot / 100000) / $gd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'GD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($gd_mth1_opr_cost_tot / 100000) / $gd_mth1_km_tot,2)  . "  where mth = '" . $mth1 ."' and unit = 'GD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($ld_mth2_opr_cost_tot / 100000) / $ld_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'LD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($ld_mth1_opr_cost_tot / 100000) / $ld_mth1_km_tot,2)  . "  where mth = '" . $mth1 ."' and unit = 'LD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($td_mth2_opr_cost_tot / 100000) / $td_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'TD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($td_mth1_opr_cost_tot / 100000) / $td_mth1_km_tot,2) . "  where mth = '" . $mth1 ."' and unit = 'TD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($tpd_mth2_opr_cost_tot / 100000) / $tpd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'TPD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($tpd_mth1_opr_cost_tot / 100000) / $tpd_mth1_km_tot,2) . "  where mth = '" . $mth1 ."' and unit = 'TPD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($hd_mth2_opr_cost_tot / 100000) / $hd_mth2_km_tot,2)  . "  where mth = '" . $mth2 ."' and unit = 'HD'" ;
$result = mysqli_query($cstccon,$sql);
$sql = "update month_data set cpkm_opr = "  . number_format(($hd_mth1_opr_cost_tot / 100000) / $hd_mth1_km_tot,2)  . "  where mth = '" . $mth1 ."' and unit = 'HD'" ;
$result = mysqli_query($cstccon,$sql);


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_cpkm_mth2_opr_tot >0){
echo number_format($cstc_cpkm_mth2_opr_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_cpkm_mth1_opr_tot >0){
echo number_format($cstc_cpkm_mth1_opr_tot,2);}
echo "</td></tr>";




echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "DESC";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "BD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "ND";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "PD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "MD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "SLD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "KD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "GD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "LD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "TD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "TPD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "HD";
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'colspan='2' align='center'>";
echo "CSTC";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='background: yellow;font-size: 8.5px;'>";
echo "";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "</tr>";






echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "CPKM (Rs.) TOTAL";

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC ";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_ac >0){
echo number_format(($bd_mth2_cost_ac / 100000) / $bd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_ac >0){
echo number_format(($bd_mth1_cost_ac / 100000) / $bd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_ac >0){
echo number_format(($nd_mth2_cost_ac / 100000) / $nd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_ac >0){
echo number_format(($nd_mth1_cost_ac / 100000) / $nd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_ac >0){
echo number_format(($pd_mth2_cost_ac / 100000) / $pd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_ac >0){
echo number_format(($pd_mth1_cost_ac / 100000) / $pd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_ac >0){
echo number_format(($md_mth2_cost_ac / 100000) / $md_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_ac >0){
echo number_format(($md_mth1_cost_ac / 100000) / $md_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_ac >0){
echo number_format(($sld_mth2_cost_ac / 100000) / $sld_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_ac >0){
echo number_format(($sld_mth1_cost_ac / 100000) / $sld_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_ac >0){
echo number_format(($kd_mth2_cost_ac / 100000) / $kd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_ac >0){
echo number_format(($kd_mth1_cost_ac / 100000) / $kd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_ac >0){
echo number_format(($gd_mth2_cost_ac / 100000) / $gd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_ac >0){
echo number_format(($gd_mth1_cost_ac / 100000) / $gd_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_ac >0){
echo number_format(($ld_mth2_cost_ac / 100000) / $ld_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_ac >0){
echo number_format(($ld_mth1_cost_ac / 100000) / $ld_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_ac >0){
echo number_format(($td_mth2_cost_ac / 100000) / $td_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_ac >0){
echo number_format(($td_mth1_cost_ac / 100000) / $td_mth1_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_ac >0){
echo number_format(($tpd_mth2_cost_ac / 100000) / $tpd_mth2_km_ac,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_ac >0){
echo number_format(($tpd_mth1_cost_ac / 100000) / $tpd_mth1_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_ac >0){
echo number_format(($hd_mth2_cost_ac / 100000) / $hd_mth2_km_ac,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_ac >0){
echo number_format(($hd_mth1_cost_ac / 100000) / $hd_mth1_km_ac,2);}

$cstc4_cpkm_mth2_ac_tot = (($bd_mth2_cost_ac + $nd_mth2_cost_ac + $pd_mth2_cost_ac+ $md_mth2_cost_ac + $sld_mth2_cost_ac + $kd_mth2_cost_ac + $gd_mth2_cost_ac + $ld_mth2_cost_ac + $td_mth2_cost_ac + $tpd_mth2_cost_ac + $hd_mth2_cost_ac )) /($bd_mth2_km_ac + $nd_mth2_km_ac + $pd_mth2_km_ac + $md_mth2_km_ac + $sld_mth2_km_ac + $kd_mth2_km_ac + $gd_mth2_km_ac + $ld_mth2_km_ac + $td_mth2_km_ac + $tpd_mth2_km_ac + $hd_mth2_km_ac) / 100000 ;
$cstc4_cpkm_mth1_ac_tot = (($bd_mth1_cost_ac + $nd_mth1_cost_ac + $pd_mth1_cost_ac+ $md_mth1_cost_ac + $sld_mth1_cost_ac + $kd_mth1_cost_ac + $gd_mth1_cost_ac + $ld_mth1_cost_ac + $td_mth1_cost_ac + $tpd_mth1_cost_ac + $hd_mth1_cost_ac )) /($bd_mth1_km_ac + $nd_mth1_km_ac + $pd_mth1_km_ac + $md_mth1_km_ac + $sld_mth1_km_ac + $kd_mth1_km_ac + $gd_mth1_km_ac + $ld_mth1_km_ac + $td_mth1_km_ac + $tpd_mth1_km_ac + $hd_mth1_km_ac) / 100000 ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc4_cpkm_mth2_ac_tot >0){
echo number_format($cstc4_cpkm_mth2_ac_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc4_cpkm_mth1_ac_tot >0){
echo number_format($cstc4_cpkm_mth1_ac_tot,2);}

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC NEW ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_nac_new >0){
echo number_format(($bd_mth2_cost_nac_new / 100000) / $bd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_nac_new >0){
echo number_format(($bd_mth1_cost_nac_new / 100000) / $bd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_nac_new >0){
echo number_format(($nd_mth2_cost_nac_new / 100000) / $nd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_nac_new >0){
echo number_format(($nd_mth1_cost_nac_new / 100000) / $nd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_nac_new >0){
echo number_format(($pd_mth2_cost_nac_new / 100000) / $pd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_nac_new >0){
echo number_format(($pd_mth1_cost_nac_new / 100000) / $pd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_nac_new >0){
echo number_format(($md_mth2_cost_nac_new / 100000) / $md_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_nac_new >0){
echo number_format(($md_mth1_cost_nac_new / 100000) / $md_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_nac_new >0){
echo number_format(($sld_mth2_cost_nac_new / 100000) / $sld_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_nac_new >0){
echo number_format(($sld_mth1_cost_nac_new / 100000) / $sld_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_nac_new >0){
echo number_format(($kd_mth2_cost_nac_new / 100000) / $kd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_nac_new >0){
echo number_format(($kd_mth1_cost_nac_new / 100000) / $kd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_nac_new >0){
echo number_format(($gd_mth2_cost_nac_new / 100000) / $gd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_nac_new >0){
echo number_format(($gd_mth1_cost_nac_new / 100000) / $gd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_nac_new >0){
echo number_format(($ld_mth2_cost_nac_new / 100000) / $ld_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_nac_new >0){
echo number_format(($ld_mth1_cost_nac_new / 100000) / $ld_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_nac_new >0){
echo number_format(($td_mth2_cost_nac_new / 100000) / $td_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_nac_new >0){
echo number_format(($td_mth1_cost_nac_new / 100000) / $td_mth1_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_nac_new >0){
echo number_format(($tpd_mth2_cost_nac_new / 100000) / $tpd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_nac_new >0){
echo number_format(($tpd_mth1_cost_nac_new / 100000) / $tpd_mth1_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_nac_new >0){
echo number_format(($hd_mth2_cost_nac_new / 100000) / $hd_mth2_km_nac_new,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_nac_new >0){
echo number_format(($hd_mth1_cost_nac_new / 100000) / $hd_mth1_km_nac_new,2);}

$cstc_cpkm_mth2_nac_new_tot = (($bd_mth2_cost_nac_new + $nd_mth2_cost_nac_new + $pd_mth2_cost_nac_new+ $md_mth2_cost_nac_new + $sld_mth2_cost_nac_new + $kd_mth2_cost_nac_new + $gd_mth2_cost_nac_new + $ld_mth2_cost_nac_new + $td_mth2_cost_nac_new + $tpd_mth2_cost_nac_new + $hd_mth2_cost_nac_new )) /($bd_mth2_km_nac_new + $nd_mth2_km_nac_new + $pd_mth2_km_nac_new + $md_mth2_km_nac_new + $sld_mth2_km_nac_new + $kd_mth2_km_nac_new + $gd_mth2_km_nac_new + $ld_mth2_km_nac_new + $td_mth2_km_nac_new + $tpd_mth2_km_nac_new + $hd_mth2_km_nac_new) / 100000 ;
$cstc_cpkm_mth1_nac_new_tot = (($bd_mth1_cost_nac_new + $nd_mth1_cost_nac_new + $pd_mth1_cost_nac_new+ $md_mth1_cost_nac_new + $sld_mth1_cost_nac_new + $kd_mth1_cost_nac_new + $gd_mth1_cost_nac_new + $ld_mth1_cost_nac_new + $td_mth1_cost_nac_new + $tpd_mth1_cost_nac_new + $hd_mth1_cost_nac_new )) /($bd_mth1_km_nac_new + $nd_mth1_km_nac_new + $pd_mth1_km_nac_new + $md_mth1_km_nac_new + $sld_mth1_km_nac_new + $kd_mth1_km_nac_new + $gd_mth1_km_nac_new + $ld_mth1_km_nac_new + $td_mth1_km_nac_new + $tpd_mth1_km_nac_new + $hd_mth1_km_nac_new) / 100000 ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_cpkm_mth2_nac_new_tot >0){
echo number_format($cstc_cpkm_mth2_nac_new_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_cpkm_mth1_nac_new_tot >0){
echo number_format($cstc_cpkm_mth1_nac_new_tot,2);}

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NAC OLD ";

echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_nac_old >0){
echo number_format(($bd_mth2_cost_nac_old ) / ($bd_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_nac_old >0){
echo number_format(($bd_mth1_cost_nac_old) / ($bd_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_nac_old >0){
echo number_format(($nd_mth2_cost_nac_old) / ($nd_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_nac_old >0){
echo number_format(($nd_mth1_cost_nac_old ) / ($nd_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_nac_old >0){
echo number_format(($pd_mth2_cost_nac_old) / ($pd_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_nac_old >0){
echo number_format(($pd_mth1_cost_nac_old ) / ($pd_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_nac_old >0){
echo number_format(($md_mth2_cost_nac_old ) / ($md_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_nac_old >0){
echo number_format(($md_mth1_cost_nac_old ) / ($md_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_nac_old >0){
echo number_format(($sld_mth2_cost_nac_old ) / ($sld_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_nac_old >0){
echo number_format(($sld_mth1_cost_nac_old) / ($sld_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_nac_old >0){
echo number_format(($kd_mth2_cost_nac_old ) / ($kd_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_nac_old >0){
echo number_format(($kd_mth1_cost_nac_old) / ($kd_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_nac_old >0){
echo number_format(($gd_mth2_cost_nac_old) / ($gd_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_nac_old >0){
echo number_format(($gd_mth1_cost_nac_old ) / ($gd_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_nac_old >0){
echo number_format(($ld_mth2_cost_nac_old ) / ($ld_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_nac_old >0){
echo number_format(($ld_mth1_cost_nac_old ) / ($ld_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_nac_old >0){
echo number_format(($td_mth2_cost_nac_old ) / ($td_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_nac_old >0){
echo number_format(($td_mth1_cost_nac_old ) / ($td_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_nac_old >0){
echo number_format(($tpd_mth2_cost_nac_old ) / ($tpd_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_nac_old >0){
echo number_format(($tpd_mth1_cost_nac_old ) / ($tpd_mth1_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_nac_old >0){
echo number_format(($hd_mth2_cost_nac_old) / ($hd_mth2_km_nac_old * 100000),2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_nac_old >0){
echo number_format(($hd_mth1_cost_nac_old ) / ($hd_mth1_km_nac_old * 100000),2);}

$cstc_cpkm_mth2_nac_old_tot = (($bd_mth2_cost_nac_old + $nd_mth2_cost_nac_old + $pd_mth2_cost_nac_old+ $md_mth2_cost_nac_old + $sld_mth2_cost_nac_old + $kd_mth2_cost_nac_old + $gd_mth2_cost_nac_old + $ld_mth2_cost_nac_old + $td_mth2_cost_nac_old + $tpd_mth2_cost_nac_old + $hd_mth2_cost_nac_old )) /($bd_mth2_km_nac_old + $nd_mth2_km_nac_old + $pd_mth2_km_nac_old + $md_mth2_km_nac_old + $sld_mth2_km_nac_old + $kd_mth2_km_nac_old + $gd_mth2_km_nac_old + $ld_mth2_km_nac_old + $td_mth2_km_nac_old + $tpd_mth2_km_nac_old + $hd_mth2_km_nac_old) / 100000 ;
$cstc_cpkm_mth1_nac_old_tot = (($bd_mth1_cost_nac_old + $nd_mth1_cost_nac_old + $pd_mth1_cost_nac_old+ $md_mth1_cost_nac_old + $sld_mth1_cost_nac_old + $kd_mth1_cost_nac_old + $gd_mth1_cost_nac_old + $ld_mth1_cost_nac_old + $td_mth1_cost_nac_old + $tpd_mth1_cost_nac_old + $hd_mth1_cost_nac_old )) /($bd_mth1_km_nac_old + $nd_mth1_km_nac_old + $pd_mth1_km_nac_old + $md_mth1_km_nac_old + $sld_mth1_km_nac_old + $kd_mth1_km_nac_old + $gd_mth1_km_nac_old + $ld_mth1_km_nac_old + $td_mth1_km_nac_old + $tpd_mth1_km_nac_old + $hd_mth1_km_nac_old) / 100000 ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_cpkm_mth2_nac_old_tot >0){
echo number_format($cstc_cpkm_mth2_nac_old_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_cpkm_mth1_nac_old_tot >0){
echo number_format($cstc_cpkm_mth1_nac_old_tot,2);}

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "TOTAL ";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_km_tot >0){
echo number_format(($bd_mth2_cost_tot / 100000) / $bd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_km_tot >0){
echo number_format(($bd_mth1_cost_tot / 100000) / $bd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_km_tot >0){
echo number_format(($nd_mth2_cost_tot / 100000) / $nd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_km_tot >0){
echo number_format(($nd_mth1_cost_tot / 100000) / $nd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_km_tot >0){
echo number_format(($pd_mth2_cost_tot / 100000) / $pd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_km_tot >0){
echo number_format(($pd_mth1_cost_tot / 100000) / $pd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_km_tot >0){
echo number_format(($md_mth2_cost_tot / 100000) / $md_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_km_tot >0){
echo number_format(($md_mth1_cost_tot / 100000) / $md_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_km_tot >0){
echo number_format(($sld_mth2_cost_tot / 100000) / $sld_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_km_tot >0){
echo number_format(($sld_mth1_cost_tot / 100000) / $sld_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_km_tot >0){
echo number_format(($kd_mth2_cost_tot / 100000) / $kd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_km_tot >0){
echo number_format(($kd_mth1_cost_tot / 100000) / $kd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_km_tot >0){
echo number_format(($gd_mth2_cost_tot / 100000) / $gd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_km_tot >0){
echo number_format(($gd_mth1_cost_tot / 100000) / $gd_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_km_tot >0){
echo number_format(($ld_mth2_cost_tot / 100000) / $ld_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_km_tot >0){
echo number_format(($ld_mth1_cost_tot / 100000) / $ld_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_km_tot >0){
echo number_format(($td_mth2_cost_tot / 100000) / $td_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_km_tot >0){
echo number_format(($td_mth1_cost_tot / 100000) / $td_mth1_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_km_tot >0){
echo number_format(($tpd_mth2_cost_tot / 100000) / $tpd_mth2_km_tot,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_km_tot >0){
echo number_format(($tpd_mth1_cost_tot / 100000) / $tpd_mth1_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_km_tot >0){
echo number_format(($hd_mth2_cost_tot / 100000) / $hd_mth2_km_tot,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_km_tot >0){
echo number_format(($hd_mth1_cost_tot / 100000) / $hd_mth1_km_tot,2);}

$cstc_cpkm_mth2_tot_tot = (($bd_mth2_cost_tot + $nd_mth2_cost_tot + $pd_mth2_cost_tot+ $md_mth2_cost_tot + $sld_mth2_cost_tot + $kd_mth2_cost_tot + $gd_mth2_cost_tot + $ld_mth2_cost_tot + $td_mth2_cost_tot + $tpd_mth2_cost_tot + $hd_mth2_cost_tot )) /($bd_mth2_km_tot + $nd_mth2_km_tot + $pd_mth2_km_tot + $md_mth2_km_tot + $sld_mth2_km_tot + $kd_mth2_km_tot + $gd_mth2_km_tot + $ld_mth2_km_tot + $td_mth2_km_tot + $tpd_mth2_km_tot + $hd_mth2_km_tot) / 100000 ;
$cstc_cpkm_mth1_tot_tot = (($bd_mth1_cost_tot + $nd_mth1_cost_tot + $pd_mth1_cost_tot+ $md_mth1_cost_tot + $sld_mth1_cost_tot + $kd_mth1_cost_tot + $gd_mth1_cost_tot + $ld_mth1_cost_tot + $td_mth1_cost_tot + $tpd_mth1_cost_tot + $hd_mth1_cost_tot )) /($bd_mth1_km_tot + $nd_mth1_km_tot + $pd_mth1_km_tot + $md_mth1_km_tot + $sld_mth1_km_tot + $kd_mth1_km_tot + $gd_mth1_km_tot + $ld_mth1_km_tot + $td_mth1_km_tot + $tpd_mth1_km_tot + $hd_mth1_km_tot) / 100000 ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_cpkm_mth2_tot_tot >0){
echo number_format($cstc_cpkm_mth2_tot_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_cpkm_mth1_tot_tot >0){
echo number_format($cstc_cpkm_mth1_tot_tot,2);}
echo "</td></tr>";






echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "OPERATIONAL COST (Lakh)";

echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo " ";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_opr_cost_tot >0){
echo number_format(($bd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_opr_cost_tot >0){
echo number_format(($bd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_opr_cost_tot >0){
echo number_format(($nd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_opr_cost_tot >0){
echo number_format(($nd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_opr_cost_tot >0){
echo number_format(($pd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_opr_cost_tot >0){
echo number_format(($pd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_opr_cost_tot >0){
echo number_format(($md_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_opr_cost_tot >0){
echo number_format(($md_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_opr_cost_tot >0){
echo number_format(($sld_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_opr_cost_tot >0){
echo number_format(($sld_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_opr_cost_tot >0){
echo number_format(($kd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_opr_cost_tot >0){
echo number_format(($kd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_opr_cost_tot >0){
echo number_format(($gd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_opr_cost_tot >0){
echo number_format(($gd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_opr_cost_tot >0){
echo number_format(($ld_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_opr_cost_tot >0){
echo number_format(($ld_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_opr_cost_tot >0){
echo number_format(($td_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_opr_cost_tot >0){
echo number_format(($td_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_opr_cost_tot >0){
echo number_format(($tpd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_opr_cost_tot >0){
echo number_format(($tpd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_opr_cost_tot >0){
echo number_format(($hd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_opr_cost_tot >0){
echo number_format(($hd_mth1_opr_cost_tot / 100000) ,2);}

$cstc_mth2_opr_cost_tot = (($bd_mth2_opr_cost_tot + $nd_mth2_opr_cost_tot + $pd_mth2_opr_cost_tot+ $md_mth2_opr_cost_tot + $sld_mth2_opr_cost_tot + $kd_mth2_opr_cost_tot + $gd_mth2_opr_cost_tot + $ld_mth2_opr_cost_tot + $td_mth2_opr_cost_tot + $tpd_mth2_opr_cost_tot + $hd_mth2_opr_cost_tot )) / 100000 ;
$cstc_mth1_opr_cost_tot = (($bd_mth1_opr_cost_tot + $nd_mth1_opr_cost_tot + $pd_mth1_opr_cost_tot+ $md_mth1_opr_cost_tot + $sld_mth1_opr_cost_tot + $kd_mth1_opr_cost_tot + $gd_mth1_opr_cost_tot + $ld_mth1_opr_cost_tot + $td_mth1_opr_cost_tot + $tpd_mth1_opr_cost_tot + $hd_mth1_opr_cost_tot )) / 100000 ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_opr_cost_tot >0){
echo number_format($cstc_mth2_opr_cost_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_mth1_opr_cost_tot >0){
echo number_format($cstc_mth1_opr_cost_tot,2);}

echo "</td></tr><tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "TOTAL COST (Lakh)";
	
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo " ";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_cost_tot >0){
echo number_format(($bd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_cost_tot >0){
echo number_format(($bd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_cost_tot >0){
echo number_format(($nd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_cost_tot >0){
echo number_format(($nd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_cost_tot >0){
echo number_format(($pd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_cost_tot >0){
echo number_format(($pd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_cost_tot >0){
echo number_format(($md_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_cost_tot >0){
echo number_format(($md_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_cost_tot >0){
echo number_format(($sld_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_cost_tot >0){
echo number_format(($sld_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_cost_tot >0){
echo number_format(($kd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_cost_tot >0){
echo number_format(($kd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_cost_tot >0){
echo number_format(($gd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_cost_tot >0){
echo number_format(($gd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_cost_tot >0){
echo number_format(($ld_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_cost_tot >0){
echo number_format(($ld_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_cost_tot >0){
echo number_format(($td_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_cost_tot >0){
echo number_format(($td_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_cost_tot >0){
echo number_format(($tpd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_cost_tot >0){
echo number_format(($tpd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_cost_tot >0){
echo number_format(($hd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_cost_tot >0){
echo number_format(($hd_mth1_cost_tot / 100000) ,2);}

$cstc_mth2_cost_tot = (($bd_mth2_cost_tot + $nd_mth2_cost_tot + $pd_mth2_cost_tot+ $md_mth2_cost_tot + $sld_mth2_cost_tot + $kd_mth2_cost_tot + $gd_mth2_cost_tot + $ld_mth2_cost_tot + $td_mth2_cost_tot + $tpd_mth2_cost_tot + $hd_mth2_cost_tot )) / 100000 ;
$cstc_mth1_cost_tot = (($bd_mth1_cost_tot + $nd_mth1_cost_tot + $pd_mth1_cost_tot+ $md_mth1_cost_tot + $sld_mth1_cost_tot + $kd_mth1_cost_tot + $gd_mth1_cost_tot + $ld_mth1_cost_tot + $td_mth1_cost_tot + $tpd_mth1_cost_tot + $hd_mth1_cost_tot )) / 100000 ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_cost_tot >0){
echo number_format($cstc_mth2_cost_tot,2);}
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 
if($cstc_mth1_cost_tot >0){
echo number_format($cstc_mth1_cost_tot,2);}

echo "</td></tr><tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "PROFIT (Lakh)";
	
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "GROSS";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_cost_tot >0){
echo number_format(($bd_mth2_sale_tot - $bd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_cost_tot >0){
echo number_format(($bd_mth1_sale_tot - $bd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_cost_tot >0){
echo number_format(($nd_mth2_sale_tot - $nd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_cost_tot >0){
echo number_format(($nd_mth1_sale_tot - $nd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_cost_tot >0){
echo number_format(($pd_mth2_sale_tot - $pd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_cost_tot >0){
echo number_format(($pd_mth1_sale_tot - $pd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_cost_tot >0){
echo number_format(($md_mth2_sale_tot - $md_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_cost_tot >0){
echo number_format(($md_mth1_sale_tot - $md_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_cost_tot >0){
echo number_format(($sld_mth2_sale_tot - $sld_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_cost_tot >0){
echo number_format(($sld_mth1_sale_tot - $sld_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_cost_tot >0){
echo number_format(($kd_mth2_sale_tot - $kd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_cost_tot >0){
echo number_format(($kd_mth1_sale_tot - $kd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_cost_tot >0){
echo number_format(($gd_mth2_sale_tot - $gd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_cost_tot >0){
echo number_format(($gd_mth1_sale_tot - $gd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_cost_tot >0){
echo number_format(($ld_mth2_sale_tot - $ld_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_cost_tot >0){
echo number_format(($ld_mth1_sale_tot - $ld_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_cost_tot >0){
echo number_format(($td_mth2_sale_tot - $td_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_cost_tot >0){
echo number_format(($td_mth1_sale_tot - $td_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_cost_tot >0){
echo number_format(($tpd_mth2_sale_tot - $tpd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_cost_tot >0){
echo number_format(($tpd_mth1_sale_tot - $tpd_mth1_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_cost_tot >0){
echo number_format(($hd_mth2_sale_tot - $hd_mth2_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_cost_tot >0){
echo number_format(($hd_mth2_sale_tot - $hd_mth1_cost_tot / 100000) ,2);}

$cstc_mth2_gross_profit = (($bd_mth2_sale_tot + $nd_mth2_sale_tot + $pd_mth2_sale_tot + $md_mth2_sale_tot + $sld_mth2_sale_tot + $kd_mth2_sale_tot + $gd_mth2_sale_tot + $ld_mth2_sale_tot + $td_mth2_sale_tot + $tpd_mth2_sale_tot + $hd_mth2_sale_tot) - ($bd_mth2_cost_tot + $nd_mth2_cost_tot + $pd_mth2_cost_tot+ $md_mth2_cost_tot + $sld_mth2_cost_tot + $kd_mth2_cost_tot + $gd_mth2_cost_tot + $ld_mth2_cost_tot + $td_mth2_cost_tot + $tpd_mth2_cost_tot + $hd_mth2_cost_tot ) / 100000) ;

$cstc_mth1_gross_profit = (($bd_mth1_sale_tot + $nd_mth1_sale_tot + $pd_mth1_sale_tot + $md_mth1_sale_tot + $sld_mth1_sale_tot + $kd_mth1_sale_tot + $gd_mth1_sale_tot + $ld_mth1_sale_tot + $td_mth1_sale_tot + $tpd_mth1_sale_tot + $hd_mth1_sale_tot) - ($bd_mth1_cost_tot + $nd_mth1_cost_tot + $pd_mth1_cost_tot+ $md_mth1_cost_tot + $sld_mth1_cost_tot + $kd_mth1_cost_tot + $gd_mth1_cost_tot + $ld_mth1_cost_tot + $td_mth1_cost_tot + $tpd_mth1_cost_tot + $hd_mth1_cost_tot ) / 100000) ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";


echo number_format($cstc_mth2_gross_profit,2);
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

echo number_format($cstc_mth1_gross_profit,2);


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "OPR";



echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_opr_cost_tot >0){
echo number_format(($bd_mth2_sale_tot - $bd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_opr_cost_tot >0){
echo number_format(($bd_mth1_sale_tot - $bd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_opr_cost_tot >0){

echo number_format(($nd_mth2_sale_tot - $nd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_opr_cost_tot >0){
echo number_format(($nd_mth1_sale_tot - $nd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_opr_cost_tot >0){
echo number_format(($pd_mth2_sale_tot - $pd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_opr_cost_tot >0){
echo number_format(($pd_mth1_sale_tot - $pd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_opr_cost_tot >0){

echo number_format(($md_mth2_sale_tot - $md_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_opr_cost_tot >0){
echo number_format(($md_mth1_sale_tot - $md_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_opr_cost_tot >0){
echo number_format(($sld_mth2_sale_tot - $sld_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_opr_cost_tot >0){
echo number_format(($sld_mth1_sale_tot - $sld_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_opr_cost_tot >0){

echo number_format(($kd_mth2_sale_tot - $kd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_opr_cost_tot >0){
echo number_format(($kd_mth1_sale_tot - $kd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_opr_cost_tot >0){
echo number_format(($gd_mth2_sale_tot - $gd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_opr_cost_tot >0){
echo number_format(($gd_mth1_sale_tot - $gd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_opr_cost_tot >0){

echo number_format(($ld_mth2_sale_tot - $ld_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_opr_cost_tot >0){
echo number_format(($ld_mth1_sale_tot - $ld_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_opr_cost_tot >0){
echo number_format(($td_mth2_sale_tot - $td_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_opr_cost_tot >0){
echo number_format(($td_mth1_sale_tot - $td_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_opr_cost_tot >0){

echo number_format(($tpd_mth2_sale_tot - $tpd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_opr_cost_tot >0){
echo number_format(($tpd_mth1_sale_tot - $tpd_mth1_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_opr_cost_tot >0){
echo number_format(($hd_mth2_sale_tot - $hd_mth2_opr_cost_tot / 100000) ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_opr_cost_tot >0){
echo number_format(($hd_mth2_sale_tot - $hd_mth1_opr_cost_tot / 100000) ,2);}

$cstc_mth2_opr_profit = (($bd_mth2_sale_tot + $nd_mth2_sale_tot + $pd_mth2_sale_tot + $md_mth2_sale_tot + $sld_mth2_sale_tot + $kd_mth2_sale_tot + $gd_mth2_sale_tot + $ld_mth2_sale_tot + $td_mth2_sale_tot + $tpd_mth2_sale_tot + $hd_mth2_sale_tot) - ($bd_mth2_opr_cost_tot + $nd_mth2_opr_cost_tot + $pd_mth2_opr_cost_tot+ $md_mth2_opr_cost_tot + $sld_mth2_opr_cost_tot + $kd_mth2_opr_cost_tot + $gd_mth2_opr_cost_tot + $ld_mth2_opr_cost_tot + $td_mth2_opr_cost_tot + $tpd_mth2_opr_cost_tot + $hd_mth2_opr_cost_tot ) / 100000) ;

$cstc_mth1_opr_profit = (($bd_mth1_sale_tot + $nd_mth1_sale_tot + $pd_mth1_sale_tot + $md_mth1_sale_tot + $sld_mth1_sale_tot + $kd_mth1_sale_tot + $gd_mth1_sale_tot + $ld_mth1_sale_tot + $td_mth1_sale_tot + $tpd_mth1_sale_tot + $hd_mth1_sale_tot) - ($bd_mth1_opr_cost_tot + $nd_mth1_opr_cost_tot + $pd_mth1_opr_cost_tot+ $md_mth1_opr_cost_tot + $sld_mth1_opr_cost_tot + $kd_mth1_opr_cost_tot + $gd_mth1_opr_cost_tot + $ld_mth1_opr_cost_tot + $td_mth1_opr_cost_tot + $tpd_mth1_opr_cost_tot + $hd_mth1_opr_cost_tot ) / 100000) ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";


echo number_format($cstc_mth2_opr_profit,2);
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

echo number_format($cstc_mth1_opr_profit,2);


echo "</td></tr>";

//OPERATING PROFIT PER KM

echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "PROFIT / KM (Rs.)";
	
echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "GROSS";


echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

$bd_mth2_opr_profit_per_km_over_mth1 = -($bd_mth2_sale_tot - $bd_mth2_opr_cost_tot / 100000) / $bd_mth2_km_tot + ($bd_mth1_sale_tot - $bd_mth1_opr_cost_tot / 100000) / $bd_mth1_km_tot;
$nd_mth2_opr_profit_per_km_over_mth1 = -($nd_mth2_sale_tot - $nd_mth2_opr_cost_tot / 100000) / $nd_mth2_km_tot + ($nd_mth1_sale_tot - $nd_mth1_opr_cost_tot / 100000) / $nd_mth1_km_tot;
$pd_mth2_opr_profit_per_km_over_mth1 = -($pd_mth2_sale_tot - $pd_mth2_opr_cost_tot / 100000) / $pd_mth2_km_tot + ($pd_mth1_sale_tot - $pd_mth1_opr_cost_tot / 100000) / $pd_mth1_km_tot;
$md_mth2_opr_profit_per_km_over_mth1 = -($md_mth2_sale_tot - $md_mth2_opr_cost_tot / 100000) / $md_mth2_km_tot + ($md_mth1_sale_tot - $md_mth1_opr_cost_tot / 100000) / $md_mth1_km_tot;
$sld_mth2_opr_profit_per_km_over_mth1 = -($sld_mth2_sale_tot - $sld_mth2_opr_cost_tot / 100000) / $sld_mth2_km_tot + ($sld_mth1_sale_tot - $sld_mth1_opr_cost_tot / 100000) / $sld_mth1_km_tot;
$kd_mth2_opr_profit_per_km_over_mth1 = -($kd_mth2_sale_tot - $kd_mth2_opr_cost_tot / 100000) / $kd_mth2_km_tot + ($kd_mth1_sale_tot - $kd_mth1_opr_cost_tot / 100000) / $kd_mth1_km_tot;
$gd_mth2_opr_profit_per_km_over_mth1 = -($gd_mth2_sale_tot - $gd_mth2_opr_cost_tot / 100000) / $gd_mth2_km_tot + ($gd_mth1_sale_tot - $gd_mth1_opr_cost_tot / 100000) / $gd_mth1_km_tot;
$ld_mth2_opr_profit_per_km_over_mth1 = -($ld_mth2_sale_tot - $ld_mth2_opr_cost_tot / 100000) / $ld_mth2_km_tot + ($ld_mth1_sale_tot - $ld_mth1_opr_cost_tot / 100000) / $ld_mth1_km_tot;
$td_mth2_opr_profit_per_km_over_mth1 = -($td_mth2_sale_tot - $td_mth2_opr_cost_tot / 100000) / $td_mth2_km_tot + ($td_mth1_sale_tot - $td_mth1_opr_cost_tot / 100000) / $td_mth1_km_tot;
$tpd_mth2_opr_profit_per_km_over_mth1 = -($tpd_mth2_sale_tot - $tpd_mth2_opr_cost_tot / 100000) / $tpd_mth2_km_tot + ($tpd_mth1_sale_tot - $tpd_mth1_opr_cost_tot / 100000) / $tpd_mth1_km_tot;
$hd_mth2_opr_profit_per_km_over_mth1 = -($hd_mth2_sale_tot - $hd_mth2_opr_cost_tot / 100000) / $hd_mth2_km_tot + ($hd_mth1_sale_tot - $hd_mth1_opr_cost_tot / 100000) / $hd_mth1_km_tot;

//$cstc_mth2_opr_profit_per_km_over_mth1 = -($cstc_mth2_sale_tot - $cstc_mth2_opr_cost_tot / 100000) / $cstc_mth2_km_tot - ($cstc_mth1_sale_tot - $cstc_mth1_opr_cost_tot / 100000) / $cstc_mth1_km_tot;




if($bd_mth2_cost_tot >0){
echo number_format(($bd_mth2_sale_tot - $bd_mth2_cost_tot / 100000) / $bd_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_cost_tot >0){
echo number_format(($bd_mth1_sale_tot - $bd_mth1_cost_tot / 100000) / $bd_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_cost_tot >0){
echo number_format(($nd_mth2_sale_tot - $nd_mth2_cost_tot / 100000) / $nd_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_cost_tot >0){
echo number_format(($nd_mth1_sale_tot - $nd_mth1_cost_tot / 100000)  / $nd_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_cost_tot >0){
echo number_format(($pd_mth2_sale_tot - $pd_mth2_cost_tot / 100000)/ $pd_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_cost_tot >0){
echo number_format(($pd_mth1_sale_tot - $pd_mth1_cost_tot / 100000) / $pd_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_cost_tot >0){
echo number_format(($md_mth2_sale_tot - $md_mth2_cost_tot / 100000) / $md_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_cost_tot >0){
echo number_format(($md_mth1_sale_tot - $md_mth1_cost_tot / 100000) / $md_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_cost_tot >0){
echo number_format(($sld_mth2_sale_tot - $sld_mth2_cost_tot / 100000) / $sld_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_cost_tot >0){
echo number_format(($sld_mth1_sale_tot - $sld_mth1_cost_tot / 100000) / $sld_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_cost_tot >0){
echo number_format(($kd_mth2_sale_tot - $kd_mth2_cost_tot / 100000) / $kd_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_cost_tot >0){
echo number_format(($kd_mth1_sale_tot - $kd_mth1_cost_tot / 100000) / $kd_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_cost_tot >0){
echo number_format(($gd_mth2_sale_tot - $gd_mth2_cost_tot / 100000) / $gd_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_cost_tot >0){
echo number_format(($gd_mth1_sale_tot - $gd_mth1_cost_tot / 100000) / $gd_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_cost_tot >0){
echo number_format(($ld_mth2_sale_tot - $ld_mth2_cost_tot / 100000) / $ld_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_cost_tot >0){
echo number_format(($ld_mth1_sale_tot - $ld_mth1_cost_tot / 100000) / $ld_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_cost_tot >0){
echo number_format(($td_mth2_sale_tot - $td_mth2_cost_tot / 100000) / $td_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_cost_tot >0){
echo number_format(($td_mth1_sale_tot - $td_mth1_cost_tot / 100000) / $td_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_cost_tot >0){
echo number_format(($tpd_mth2_sale_tot - $tpd_mth2_cost_tot / 100000) / $tpd_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_cost_tot >0){
echo number_format(($tpd_mth1_sale_tot - $tpd_mth1_cost_tot / 100000) / $tpd_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_cost_tot >0){
echo number_format(($hd_mth2_sale_tot - $hd_mth2_cost_tot / 100000) / $hd_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_cost_tot >0){
echo number_format(($hd_mth2_sale_tot - $hd_mth1_cost_tot / 100000) / $hd_mth1_km_tot ,2);}

$cstc_mth2_km_tot = $bd_mth2_km_tot + $nd_mth2_km_tot + $pd_mth2_km_tot + $md_mth2_km_tot + $sld_mth2_km_tot + $kd_mth2_km_tot + $gd_mth2_km_tot + $ld_mth2_km_tot + $td_mth2_km_tot + $tpd_mth2_km_tot + $hd_mth2_km_tot ;
$cstc_mth1_km_tot = $bd_mth1_km_tot + $nd_mth1_km_tot + $pd_mth1_km_tot + $md_mth1_km_tot + $sld_mth1_km_tot + $kd_mth1_km_tot + $gd_mth1_km_tot + $ld_mth1_km_tot + $td_mth1_km_tot + $tpd_mth1_km_tot + $hd_mth1_km_tot ;

$cstc_mth2_gross_profit = (($bd_mth2_sale_tot + $nd_mth2_sale_tot + $pd_mth2_sale_tot + $md_mth2_sale_tot + $sld_mth2_sale_tot + $kd_mth2_sale_tot + $gd_mth2_sale_tot + $ld_mth2_sale_tot + $td_mth2_sale_tot + $tpd_mth2_sale_tot + $hd_mth2_sale_tot) - ($bd_mth2_cost_tot + $nd_mth2_cost_tot + $pd_mth2_cost_tot+ $md_mth2_cost_tot + $sld_mth2_cost_tot + $kd_mth2_cost_tot + $gd_mth2_cost_tot + $ld_mth2_cost_tot + $td_mth2_cost_tot + $tpd_mth2_cost_tot + $hd_mth2_cost_tot ) / 100000) / $cstc_mth2_km_tot ;

$cstc_mth1_gross_profit = (($bd_mth1_sale_tot + $nd_mth1_sale_tot + $pd_mth1_sale_tot + $md_mth1_sale_tot + $sld_mth1_sale_tot + $kd_mth1_sale_tot + $gd_mth1_sale_tot + $ld_mth1_sale_tot + $td_mth1_sale_tot + $tpd_mth1_sale_tot + $hd_mth1_sale_tot) - ($bd_mth1_cost_tot + $nd_mth1_cost_tot + $pd_mth1_cost_tot+ $md_mth1_cost_tot + $sld_mth1_cost_tot + $kd_mth1_cost_tot + $gd_mth1_cost_tot + $ld_mth1_cost_tot + $td_mth1_cost_tot + $tpd_mth1_cost_tot + $hd_mth1_cost_tot ) / 100000) / $cstc_mth1_km_tot ;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";


echo number_format($cstc_mth2_gross_profit,2);
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

echo number_format($cstc_mth1_gross_profit,2);


echo "</td></tr><tr><td style='background: yellow;font-size: 8.5px;'>";
echo "OPR";



echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($bd_mth2_opr_cost_tot >0){
echo number_format(($bd_mth2_sale_tot - $bd_mth2_opr_cost_tot / 100000) / $bd_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_opr_cost_tot >0){
echo number_format(($bd_mth1_sale_tot - $bd_mth1_opr_cost_tot / 100000) / $bd_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_opr_cost_tot >0){
echo number_format(($nd_mth2_sale_tot - $nd_mth2_opr_cost_tot / 100000) / $nd_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_opr_cost_tot >0){
echo number_format(($nd_mth1_sale_tot - $nd_mth1_opr_cost_tot / 100000)  / $nd_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_opr_cost_tot >0){
echo number_format(($pd_mth2_sale_tot - $pd_mth2_opr_cost_tot / 100000) / $pd_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_opr_cost_tot >0){
echo number_format(($pd_mth1_sale_tot - $pd_mth1_opr_cost_tot / 100000) / $pd_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_opr_cost_tot >0){
echo number_format(($md_mth2_sale_tot - $md_mth2_opr_cost_tot / 100000) / $md_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_opr_cost_tot >0){
echo number_format(($md_mth1_sale_tot - $md_mth1_opr_cost_tot / 100000) / $md_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_opr_cost_tot >0){
echo number_format(($sld_mth2_sale_tot - $sld_mth2_opr_cost_tot / 100000) / $sld_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_opr_cost_tot >0){
echo number_format(($sld_mth1_sale_tot - $sld_mth1_opr_cost_tot / 100000) / $sld_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_opr_cost_tot >0){
echo number_format(($kd_mth2_sale_tot - $kd_mth2_opr_cost_tot / 100000) / $kd_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_opr_cost_tot >0){
echo number_format(($kd_mth1_sale_tot - $kd_mth1_opr_cost_tot / 100000) / $kd_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_opr_cost_tot >0){
echo number_format(($gd_mth2_sale_tot - $gd_mth2_opr_cost_tot / 100000) / $gd_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_opr_cost_tot >0){
echo number_format(($gd_mth1_sale_tot - $gd_mth1_opr_cost_tot / 100000) / $gd_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_opr_cost_tot >0){
echo number_format(($ld_mth2_sale_tot - $ld_mth2_opr_cost_tot / 100000) / $ld_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_opr_cost_tot >0){
echo number_format(($ld_mth1_sale_tot - $ld_mth1_opr_cost_tot / 100000) / $ld_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_opr_cost_tot >0){
echo number_format(($td_mth2_sale_tot - $td_mth2_opr_cost_tot / 100000) / $td_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_opr_cost_tot >0){
echo number_format(($td_mth1_sale_tot - $td_mth1_opr_cost_tot / 100000) / $td_mth1_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_opr_cost_tot >0){
echo number_format(($tpd_mth2_sale_tot - $tpd_mth2_opr_cost_tot / 100000) / $tpd_mth2_km_tot ,2);}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_opr_cost_tot >0){
echo number_format(($tpd_mth1_sale_tot - $tpd_mth1_opr_cost_tot / 100000) / $tpd_mth1_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_opr_cost_tot >0){
echo number_format(($hd_mth2_sale_tot - $hd_mth2_opr_cost_tot / 100000) / $hd_mth2_km_tot ,2);}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_opr_cost_tot >0){
echo number_format(($hd_mth2_sale_tot - $hd_mth1_opr_cost_tot / 100000) / $hd_mth1_km_tot ,2);}

$cstc_mth2_km_tot = $bd_mth2_km_tot + $nd_mth2_km_tot + $pd_mth2_km_tot + $md_mth2_km_tot + $sld_mth2_km_tot + $kd_mth2_km_tot + $gd_mth2_km_tot + $ld_mth2_km_tot + $td_mth2_km_tot + $tpd_mth2_km_tot + $hd_mth2_km_tot ;
$cstc_mth1_km_tot = $bd_mth1_km_tot + $nd_mth1_km_tot + $pd_mth1_km_tot + $md_mth1_km_tot + $sld_mth1_km_tot + $kd_mth1_km_tot + $gd_mth1_km_tot + $ld_mth1_km_tot + $td_mth1_km_tot + $tpd_mth1_km_tot + $hd_mth1_km_tot ;

$cstc_mth2_opr_profit = (($bd_mth2_sale_tot + $nd_mth2_sale_tot + $pd_mth2_sale_tot + $md_mth2_sale_tot + $sld_mth2_sale_tot + $kd_mth2_sale_tot + $gd_mth2_sale_tot + $ld_mth2_sale_tot + $td_mth2_sale_tot + $tpd_mth2_sale_tot + $hd_mth2_sale_tot) - ($bd_mth2_opr_cost_tot + $nd_mth2_opr_cost_tot + $pd_mth2_opr_cost_tot+ $md_mth2_opr_cost_tot + $sld_mth2_opr_cost_tot + $kd_mth2_opr_cost_tot + $gd_mth2_opr_cost_tot + $ld_mth2_opr_cost_tot + $td_mth2_opr_cost_tot + $tpd_mth2_opr_cost_tot + $hd_mth2_opr_cost_tot ) / 100000) / $cstc_mth2_km_tot ;

$cstc_mth1_opr_profit = (($bd_mth1_sale_tot + $nd_mth1_sale_tot + $pd_mth1_sale_tot + $md_mth1_sale_tot + $sld_mth1_sale_tot + $kd_mth1_sale_tot + $gd_mth1_sale_tot + $ld_mth1_sale_tot + $td_mth1_sale_tot + $tpd_mth1_sale_tot + $hd_mth1_sale_tot) - ($bd_mth1_opr_cost_tot + $nd_mth1_opr_cost_tot + $pd_mth1_opr_cost_tot+ $md_mth1_opr_cost_tot + $sld_mth1_opr_cost_tot + $kd_mth1_opr_cost_tot + $gd_mth1_opr_cost_tot + $ld_mth1_opr_cost_tot + $td_mth1_opr_cost_tot + $tpd_mth1_opr_cost_tot + $hd_mth1_opr_cost_tot ) / 100000) / $cstc_mth1_km_tot ;


$cstc_mth2_opr_profit_per_km_over_mth1 = - $cstc_mth2_opr_profit + $cstc_mth1_opr_profit;



echo "</td><td style='background: yellow;font-size: 8.5px;'>";


echo number_format($cstc_mth2_opr_profit,2);
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

echo number_format($cstc_mth1_opr_profit,2);


echo "</td></tr>";



//echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
//echo "INCREASE OF OPERATING PROFIT/KM (Rs.) IN " . $month1 . ", " . substr($mth1,0,2) . " OVER " . $month2 . ", " . substr($mth2,0,2);
	
//echo "</td></tr>

//<tr><td style='background: yellow;font-size: 8.5px;'>";
//echo "";



//echo "</td>";


//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($bd_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($nd_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($pd_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($md_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($sld_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($kd_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($gd_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($ld_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($td_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($tpd_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($hd_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";
//echo "<td colspan='2' align='center' style='background: #F6CEF5;font-size: 8.5px;'>";
//echo number_format($cstc_mth2_opr_profit_per_km_over_mth1 ,2);
//echo "</td>";


//echo "</tr>";



//OPERATING PROFIT PER KM END



echo "<tr>";
echo "<td style='background: yellow;font-size: 8.5px;'style='font-size: 8.5px;'>";
echo "DESC";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "BD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "ND";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "PD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "MD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "SLD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "KD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "GD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "LD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "TD";
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'colspan='2' align='center'>";
echo "TPD";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'colspan='2' align='center'>";
echo "HD";
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'colspan='2' align='center'>";
echo "CSTC";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='background: yellow;font-size: 8.5px;'>";
echo "";
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F2F2F2;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: #F6CEF5;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'align='center'>";
echo $month2 . ", " . substr($mth2,0,2);
echo "</td>";
echo "<td style='background: yellow;font-size: 8.5px;'align='center'>";
echo $month1 . ", " . substr($mth1,0,2);
echo "</td>";
echo "</tr>";




echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "TECHNICAL MAINTENANCE INFORMATION (NUMBER OF VEHICLE ATTENDED) ";
 
echo "</td></tr>";


echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "HEAVY";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";





if($bd_mth2_heavy_maint_no  > 0){
echo $bd_mth2_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_heavy_maint_no  > 0){
echo $bd_mth1_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_heavy_maint_no  > 0){
echo $nd_mth2_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_heavy_maint_no  > 0){
echo $nd_mth1_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_heavy_maint_no  > 0){
echo $pd_mth2_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_heavy_maint_no  > 0){
echo $pd_mth1_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_heavy_maint_no  > 0){
echo $md_mth2_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_heavy_maint_no  > 0){
echo $md_mth1_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_heavy_maint_no  > 0){
echo $sld_mth2_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_heavy_maint_no  > 0){
echo $sld_mth1_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_heavy_maint_no  > 0){
echo $kd_mth2_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_heavy_maint_no  > 0){
echo $kd_mth1_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_heavy_maint_no  > 0){
echo $gd_mth2_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_heavy_maint_no  > 0){
echo $gd_mth1_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_heavy_maint_no  > 0){
echo $ld_mth2_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_heavy_maint_no  > 0){
echo $ld_mth1_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_heavy_maint_no  > 0){
echo $td_mth2_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_heavy_maint_no  > 0){
echo $td_mth1_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_heavy_maint_no  > 0){
echo $tpd_mth2_heavy_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_heavy_maint_no  > 0){
echo $tpd_mth1_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_heavy_maint_no  > 0){
echo $hd_mth2_heavy_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_heavy_maint_no  > 0){
echo $hd_mth1_heavy_maint_no;}

$cstc_mth2_heavy_maint_no  = $bd_mth2_heavy_maint_no  + $nd_mth2_heavy_maint_no  + $pd_mth2_heavy_maint_no  + $md_mth2_heavy_maint_no  + $sld_mth2_heavy_maint_no  + $kd_mth2_heavy_maint_no  + $gd_mth2_heavy_maint_no  + $ld_mth2_heavy_maint_no  + $td_mth2_heavy_maint_no  + $tpd_mth2_heavy_maint_no  + $hd_mth2_heavy_maint_no  ;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_heavy_maint_no  >0){
echo $cstc_mth2_heavy_maint_no; }
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

$cstc_mth1_heavy_maint_no  = $bd_mth1_heavy_maint_no  + $nd_mth1_heavy_maint_no  + $pd_mth1_heavy_maint_no  + $md_mth1_heavy_maint_no  + $sld_mth1_heavy_maint_no  + $kd_mth1_heavy_maint_no  + $gd_mth1_heavy_maint_no  + $ld_mth1_heavy_maint_no  + $td_mth1_heavy_maint_no  + $tpd_mth1_heavy_maint_no  + $hd_mth1_heavy_maint_no  ;
if($cstc_mth1_heavy_maint_no >0){
echo $cstc_mth1_heavy_maint_no;}


echo "</td></tr>";

echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "DAILY";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";





if($bd_mth2_daily_tech_maint_no  > 0){
echo $bd_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_daily_tech_maint_no  > 0){
echo $bd_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_daily_tech_maint_no  > 0){
echo $nd_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_daily_tech_maint_no  > 0){
echo $nd_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_daily_tech_maint_no  > 0){
echo $pd_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_daily_tech_maint_no  > 0){
echo $pd_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_daily_tech_maint_no  > 0){
echo $md_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_daily_tech_maint_no  > 0){
echo $md_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_daily_tech_maint_no  > 0){
echo $sld_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_daily_tech_maint_no  > 0){
echo $sld_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_daily_tech_maint_no  > 0){
echo $kd_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_daily_tech_maint_no  > 0){
echo $kd_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_daily_tech_maint_no  > 0){
echo $gd_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_daily_tech_maint_no  > 0){
echo $gd_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_daily_tech_maint_no  > 0){
echo $ld_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_daily_tech_maint_no  > 0){
echo $ld_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_daily_tech_maint_no  > 0){
echo $td_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_daily_tech_maint_no  > 0){
echo $td_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_daily_tech_maint_no  > 0){
echo $tpd_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_daily_tech_maint_no  > 0){
echo $tpd_mth1_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_daily_tech_maint_no  > 0){
echo $hd_mth2_daily_tech_maint_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_daily_tech_maint_no  > 0){
echo $hd_mth1_daily_tech_maint_no;}

$cstc_mth2_daily_tech_maint_no  = $bd_mth2_daily_tech_maint_no  + $nd_mth2_daily_tech_maint_no  + $pd_mth2_daily_tech_maint_no  + $md_mth2_daily_tech_maint_no  + $sld_mth2_daily_tech_maint_no  + $kd_mth2_daily_tech_maint_no  + $gd_mth2_daily_tech_maint_no  + $ld_mth2_daily_tech_maint_no  + $td_mth2_daily_tech_maint_no  + $tpd_mth2_daily_tech_maint_no  + $hd_mth2_daily_tech_maint_no  ;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_daily_tech_maint_no  >0){
echo $cstc_mth2_daily_tech_maint_no; }
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

$cstc_mth1_daily_tech_maint_no  = $bd_mth1_daily_tech_maint_no  + $nd_mth1_daily_tech_maint_no  + $pd_mth1_daily_tech_maint_no  + $md_mth1_daily_tech_maint_no  + $sld_mth1_daily_tech_maint_no  + $kd_mth1_daily_tech_maint_no  + $gd_mth1_daily_tech_maint_no  + $ld_mth1_daily_tech_maint_no  + $td_mth1_daily_tech_maint_no  + $tpd_mth1_daily_tech_maint_no  + $hd_mth1_daily_tech_maint_no  ;
if($cstc_mth1_daily_tech_maint_no >0){
echo $cstc_mth1_daily_tech_maint_no;}


echo "</td></tr>";

echo "<tr><td align='center' style='font-size: 10px;font-weight:bold'colspan='25'>";
echo "NON-TECHNICAL MAINTENANCE INFORMATION (NUMBER OF VEHICLE ATTENDED) ";
 
echo "</td></tr>";


echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "AC";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";






if($bd_mth2_non_tech_maint_ac_no  > 0){
echo $bd_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_non_tech_maint_ac_no  > 0){
echo $bd_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_non_tech_maint_ac_no  > 0){
echo $nd_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_non_tech_maint_ac_no  > 0){
echo $nd_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_non_tech_maint_ac_no  > 0){
echo $pd_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_non_tech_maint_ac_no  > 0){
echo $pd_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_non_tech_maint_ac_no  > 0){
echo $md_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_non_tech_maint_ac_no  > 0){
echo $md_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_non_tech_maint_ac_no  > 0){
echo $sld_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_non_tech_maint_ac_no  > 0){
echo $sld_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_non_tech_maint_ac_no  > 0){
echo $kd_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_non_tech_maint_ac_no  > 0){
echo $kd_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_non_tech_maint_ac_no  > 0){
echo $gd_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_non_tech_maint_ac_no  > 0){
echo $gd_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_non_tech_maint_ac_no  > 0){
echo $ld_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_non_tech_maint_ac_no  > 0){
echo $ld_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_non_tech_maint_ac_no  > 0){
echo $td_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_non_tech_maint_ac_no  > 0){
echo $td_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_non_tech_maint_ac_no  > 0){
echo $tpd_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_non_tech_maint_ac_no  > 0){
echo $tpd_mth1_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_non_tech_maint_ac_no  > 0){
echo $hd_mth2_non_tech_maint_ac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_non_tech_maint_ac_no  > 0){
echo $hd_mth1_non_tech_maint_ac_no;}

$cstc_mth2_non_tech_maint_ac_no  = $bd_mth2_non_tech_maint_ac_no  + $nd_mth2_non_tech_maint_ac_no  + $pd_mth2_non_tech_maint_ac_no  + $md_mth2_non_tech_maint_ac_no  + $sld_mth2_non_tech_maint_ac_no  + $kd_mth2_non_tech_maint_ac_no  + $gd_mth2_non_tech_maint_ac_no  + $ld_mth2_non_tech_maint_ac_no  + $td_mth2_non_tech_maint_ac_no  + $tpd_mth2_non_tech_maint_ac_no  + $hd_mth2_non_tech_maint_ac_no  ;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_non_tech_maint_ac_no  >0){
echo $cstc_mth2_non_tech_maint_ac_no; }
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

$cstc_mth1_non_tech_maint_ac_no  = $bd_mth1_non_tech_maint_ac_no  + $nd_mth1_non_tech_maint_ac_no  + $pd_mth1_non_tech_maint_ac_no  + $md_mth1_non_tech_maint_ac_no  + $sld_mth1_non_tech_maint_ac_no  + $kd_mth1_non_tech_maint_ac_no  + $gd_mth1_non_tech_maint_ac_no  + $ld_mth1_non_tech_maint_ac_no  + $td_mth1_non_tech_maint_ac_no  + $tpd_mth1_non_tech_maint_ac_no  + $hd_mth1_non_tech_maint_ac_no  ;
if($cstc_mth1_non_tech_maint_ac_no >0){
echo $cstc_mth1_non_tech_maint_ac_no;}


echo "</td></tr>";
        

echo "<tr><td style='background: yellow;font-size: 8.5px;'>";
echo "NON-AC";
echo "";
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";





if($bd_mth2_non_tech_maint_nac_no  > 0){
echo $bd_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($bd_mth1_non_tech_maint_nac_no  > 0){
echo $bd_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($nd_mth2_non_tech_maint_nac_no  > 0){
echo $nd_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($nd_mth1_non_tech_maint_nac_no  > 0){
echo $nd_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($pd_mth2_non_tech_maint_nac_no  > 0){
echo $pd_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($pd_mth1_non_tech_maint_nac_no  > 0){
echo $pd_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($md_mth2_non_tech_maint_nac_no  > 0){
echo $md_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($md_mth1_non_tech_maint_nac_no  > 0){
echo $md_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($sld_mth2_non_tech_maint_nac_no  > 0){
echo $sld_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($sld_mth1_non_tech_maint_nac_no  > 0){
echo $sld_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($kd_mth2_non_tech_maint_nac_no  > 0){
echo $kd_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($kd_mth1_non_tech_maint_nac_no  > 0){
echo $kd_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($gd_mth2_non_tech_maint_nac_no  > 0){
echo $gd_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($gd_mth1_non_tech_maint_nac_no  > 0){
echo $gd_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($ld_mth2_non_tech_maint_nac_no  > 0){
echo $ld_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($ld_mth1_non_tech_maint_nac_no  > 0){
echo $ld_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($td_mth2_non_tech_maint_nac_no  > 0){
echo $td_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($td_mth1_non_tech_maint_nac_no  > 0){
echo $td_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";

if($tpd_mth2_non_tech_maint_nac_no  > 0){
echo $tpd_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F2F2F2;font-size: 8.5px;'>";
if($tpd_mth1_non_tech_maint_nac_no  > 0){
echo $tpd_mth1_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";

if($hd_mth2_non_tech_maint_nac_no  > 0){
echo $hd_mth2_non_tech_maint_nac_no;}
echo "</td><td style='background: #F6CEF5;font-size: 8.5px;'>";
if($hd_mth1_non_tech_maint_nac_no  > 0){
echo $hd_mth1_non_tech_maint_nac_no;}

$cstc_mth2_non_tech_maint_nac_no  = $bd_mth2_non_tech_maint_nac_no  + $nd_mth2_non_tech_maint_nac_no  + $pd_mth2_non_tech_maint_nac_no  + $md_mth2_non_tech_maint_nac_no  + $sld_mth2_non_tech_maint_nac_no  + $kd_mth2_non_tech_maint_nac_no  + $gd_mth2_non_tech_maint_nac_no  + $ld_mth2_non_tech_maint_nac_no  + $td_mth2_non_tech_maint_nac_no  + $tpd_mth2_non_tech_maint_nac_no  + $hd_mth2_non_tech_maint_nac_no  ;


echo "</td><td style='background: yellow;font-size: 8.5px;'>";

if($cstc_mth2_non_tech_maint_nac_no  >0){
echo $cstc_mth2_non_tech_maint_nac_no; }
echo "</td><td style='background: yellow;font-size: 8.5px;'>"; 

$cstc_mth1_non_tech_maint_nac_no  = $bd_mth1_non_tech_maint_nac_no  + $nd_mth1_non_tech_maint_nac_no  + $pd_mth1_non_tech_maint_nac_no  + $md_mth1_non_tech_maint_nac_no  + $sld_mth1_non_tech_maint_nac_no  + $kd_mth1_non_tech_maint_nac_no  + $gd_mth1_non_tech_maint_nac_no  + $ld_mth1_non_tech_maint_nac_no  + $td_mth1_non_tech_maint_nac_no  + $tpd_mth1_non_tech_maint_nac_no  + $hd_mth1_non_tech_maint_nac_no  ;
if($cstc_mth1_non_tech_maint_nac_no >0){
echo $cstc_mth1_non_tech_maint_nac_no;}


echo "</td></tr>";
        
echo        "</table>";



?>	







	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
