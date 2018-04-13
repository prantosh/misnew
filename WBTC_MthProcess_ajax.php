
<?php 
session_start();
ini_set('display_errors', 1);
require_once('Connections/cstccon.php');

$mth = htmlspecialchars($_POST['mth'],ENT_QUOTES);
$unit =  $_SESSION['UNIT'];
?>
 <script language="javascript">
            alert("ok1");
             </script>
       <?php
$mth_mm = substr($mth, 2,2);
$mth_yyyy = '20' . substr($mth, 0,2);
//
//$sql1="insert into DEB(TET) VALUES('C')";
//$result1=mysqli_query($cstccon,$sql1);
$query5 = "SELECT * from cstcmis.month_data where unit = 'BD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('BD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'ND' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('ND','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'PD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('PD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'MD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('MD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'SLD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('SLD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'KD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('KD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'GD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('GD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'LD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('LD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'TD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('TD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'TPD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('TPD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'HD' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('HD','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'HQ' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('HQ','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'CT' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('CT','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'CW' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('CW','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
$query5 = "SELECT * from cstcmis.month_data where unit = 'CE' and mth = '" . $mth . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)< 1)
{
$query6 = "insert into cstcmis.month_data (unit,mth) values ('CE','" . $mth . "')";
$result6 = mysqli_query($cstccon,$query6) or die(mysqli_error());
}
?>
 <script language="javascript">
            alert("ok2");
             </script>
       <?php
$query15 = "update cstcmis.month_data set fleet_ac = 0 where  mth = '" . $mth . "'"; 
      $result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
     
      $query16 = "update cstcmis.month_data set fleet_nac_new = 0 where  mth = '" . $mth . "'"; 
      $result16 = mysqli_query($cstccon,$query16) or die(mysqli_error());
     
      $query17 = "update cstcmis.month_data set fleet_nac_old = 0 where   mth = '" . $mth . "'"; 
      $result17 = mysqli_query($cstccon,$query17) or die(mysqli_error());


$query = "SELECT B.TYPE type1,A.depot depot1,count(*) nos from cstcmis.veh0214 A,cstcmis.model_master B where A.cur_stat = 'S' and A.model = B.model 
       group by B.type, A.depot";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
?>
 <script language="javascript">
            alert("ok3");
             </script>
       <?php
 while($row = mysqli_fetch_assoc($result))  {
     
      
     
     
     
     
        if($row['type1'] == 'A'){
        $query1 = "update cstcmis.month_data set fleet_ac = " . $row['nos'] . " where unit = '" . $row['depot1'] . "' and mth = '" . $mth . "'"; 
       
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
        }
        if($row['type1'] == 'N'){
        $query24 = "update cstcmis.month_data set fleet_nac_new = " . $row['nos'] . " where unit = '" . $row['depot1'] . "' and mth = '" . $mth . "'"; 
       
        $result24 = mysqli_query($cstccon,$query24) or die(mysqli_error());
        }
        if($row['type1'] == 'O'){
        $query25 = "update cstcmis.month_data set fleet_nac_old = " . $row['nos'] . " where unit = '" . $row['depot1'] . "' and mth = '" . $mth . "'"; 
       
        $result25 = mysqli_query($cstccon,$query25) or die(mysqli_error());
        }
 }
?>
 <script language="javascript">
            alert("ok4");
             </script>
       <?php
 $queryzz = "SELECT depot,runfleet,count(*) nos from cstcmis.veh0214 group by depot,runfleet";
$resultzz = mysqli_query($cstccon,$queryzz) or die(mysqli_error());

 while($rowzz = mysqli_fetch_assoc($resultzz))  {
     
      
     
     
     
     
        if($rowzz['runfleet'] == 'R'){
        $query12 = "update cstcmis.month_data set running = " . $rowzz['nos'] . " where unit = '" . $rowzz['depot'] . "' and mth = '" . $mth . "'"; 
       
        $result12 = mysqli_query($cstccon,$query12) or die(mysqli_error());
        }
        if($rowzz['runfleet'] == 'H'){
        $query13 = "update cstcmis.month_data set heldup = " . $rowzz['nos'] . " where unit = '" . $rowzz['depot'] . "' and mth = '" . $mth . "'"; 
       
        $result13 = mysqli_query($cstccon,$query13) or die(mysqli_error());
        }
       
 }

 
 
 
 
 
 
 ?>
 <script language="javascript">
            alert("ok5");
             </script>
       <?php
 
 
 $query = "SELECT date_format(op_date,'%y%m') mth1, unit,avg(veh_supply_1st) veh_supply_1st_avg ,"
          .  "avg(veh_supply_2nd) veh_supply_2nd_avg,"
          .  "avg(att_driver_1st) att_driver_1st_avg,avg(att_driver_tr_1st) att_driver_tr_1st_avg,"
          .  "avg(att_cond_1st) att_cond_1st_avg,avg(att_cond_tr_1st) att_cond_tr_1st_avg,"
          .  "avg(att_driver_2nd) att_driver_2nd_avg,avg(att_driver_tr_2nd) att_driver_tr_2nd_avg,"
          .  "avg(att_cond_2nd) att_cond_2nd_avg,avg(att_cond_tr_2nd) att_cond_tr_2nd_avg, "
          .  "avg(ab_driver_1st) ab_driver_1st_avg,avg(ab_driver_tr_1st) ab_driver_tr_1st_avg,"
          .  "avg(ab_cond_1st) ab_cond_1st_avg,avg(ab_cond_tr_1st) ab_cond_tr_1st_avg,"
          .  "avg(ab_driver_2nd) ab_driver_2nd_avg,avg(ab_driver_tr_2nd) ab_driver_tr_2nd_avg,"
          .  "avg(ab_cond_2nd) ab_cond_2nd_avg,avg(ab_cond_tr_2nd) ab_cond_tr_2nd_avg "
          .  "from cstcmis.daily_record_sum group by date_format(op_date,'%y%m'),unit";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());

 while($row = mysqli_fetch_assoc($result))  {
        
        $query1 = "update cstcmis.month_data set supply_1st_tot = " . $row['veh_supply_1st_avg'] . ","
                . "supply_2nd_tot = " . $row['veh_supply_2nd_avg'] . ","
                . "att_driver_1st = " . $row['att_driver_1st_avg'] . ","
                . "att_driver_tr_1st = " . $row['att_driver_tr_1st_avg'] . ","
                . "att_conductor_1st = " . $row['att_cond_1st_avg'] . ","
                . "att_conductor_tr_1st = " . $row['att_cond_tr_1st_avg'] . ","
                . "att_driver_2nd = " . $row['att_driver_2nd_avg'] . ","
                . "att_driver_tr_2nd = " . $row['att_driver_tr_2nd_avg'] . ","
                . "att_conductor_2nd = " . $row['att_cond_2nd_avg'] . ","
                . "att_conductor_tr_2nd = " . $row['att_cond_tr_2nd_avg'] . ","
                . "ab_driver_1st = " . $row['ab_driver_1st_avg'] . ","
                . "ab_driver_tr_1st = " . $row['ab_driver_tr_1st_avg'] . ","
                . "ab_conductor_1st = " . $row['ab_cond_1st_avg'] . ","
                . "ab_conductor_tr_1st = " . $row['ab_cond_tr_1st_avg'] . ","
                . "ab_driver_2nd = " . $row['ab_driver_2nd_avg'] . ","
                . "ab_driver_tr_2nd = " . $row['ab_driver_tr_2nd_avg'] . ","
                . "ab_conductor_2nd = " . $row['ab_cond_2nd_avg'] . ","
                . "ab_conductor_tr_2nd = " . $row['ab_cond_tr_2nd_avg'] . 
                
                " where unit = '" . $row['unit'] . "' and mth = '" . $row['mth1'] . "'"; 
       
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
        
       
 }
 
// *************************************************************************************************************8 

 ?>
 <script language="javascript">
            alert("ok6");
             </script>
       <?php
 
 $query1 = "select distinct op_date from cstcmis.daily_record_model where date_format(op_date,'%y%m') = '" . $mth . "'";
 $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
 $days = mysqli_num_rows($result1);
 
 $query = "SELECT date_format(op_date,'%y%m') mth1, ac,unit,sum(veh_out_1st) veh_out_1st_sum ,"
            .  "sum(veh_out_2nd) veh_out_2nd_sum,"
            .  "sum(sale_1st) sale_1st_sum,"
            .  "sum(sale_2nd) sale_2nd_sum,"
            .  "sum(km) km_sum,"
            .  "sum(km_2nd) km_2nd_sum,"            
            .  "sum(hsd) hsd_sum,"
              
            .  "sum(sch_trip) sch_trip_sum,"
            .  "sum(act_trip) act_trip_sum "      
       //     .  "from daily_record_model   group by date_format(op_date,'%y%m'),ac,unit having mth1 = '" . $mth . "'";
 .  "from cstcmis.daily_record_model where (sale_1st + sale_2nd) > 0 group by date_format(op_date,'%y%m'),ac,unit having mth1 = '" . $mth . "'";

 $result = mysqli_query($cstccon,$query) or die(mysqli_error());
?>
 <script language="javascript">
            alert("ok7");
             </script>
       <?php
 while($row = mysqli_fetch_assoc($result))  {
     
        if($row['ac'] == 'A'){
        $query1 = "update cstcmis.month_data set out_1st_ac = " . $row['veh_out_1st_sum']  / $days . ","
                . "out_2nd_ac = " . $row['veh_out_2nd_sum']  / $days . ","
                . "sale_ac_1st = " . $row['sale_1st_sum'] . ","
                . "sale_ac_2nd = " . $row['sale_2nd_sum'] . ","
                . "km_ac = " . $row['km_sum'] . ","
                . "km_ac_2nd = " . $row['km_2nd_sum'] . ","
                . "hsd_ac = " . $row['hsd_sum'] . ","
                . "sch_trip_ac = " . $row['sch_trip_sum'] . ","
                . "act_trip_ac = " . $row['act_trip_sum']  
                               
                . " where unit = '" . $row['unit'] . "' and mth = '" . $mth . "'"; 
       
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
        
        }
        if($row['ac'] == 'N'){
        $query1 = "update cstcmis.month_data set out_1st_nac_new = " . $row['veh_out_1st_sum']  / $days . ","
                . "out_2nd_nac_new = " . $row['veh_out_2nd_sum']  / $days . ","
                . "sale_nac_1st_new = " . $row['sale_1st_sum'] . ","
                . "sale_nac_new_2nd = " . $row['sale_2nd_sum'] . ","
                . "km_nac_new = " . $row['km_sum'] . ","
                . "km_nac_new_2nd = " . $row['km_2nd_sum'] . ","
                . "hsd_nac_new = " . $row['hsd_sum'] . ","
                . "sch_trip_nac_new = " . $row['sch_trip_sum'] . ","
                . "act_trip_nac_new = " . $row['act_trip_sum']  
                               
                . " where unit = '" . $row['unit'] . "' and mth = '" . $mth . "'"; 
       
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
        
        }
        if($row['ac'] == 'O'){
        $query1 = "update cstcmis.month_data set out_1st_nac_old = " . $row['veh_out_1st_sum']  / $days . ","
                . "out_2nd_nac_old = " . $row['veh_out_2nd_sum']  / $days . ","
                . "sale_nac_1st_old = " . $row['sale_1st_sum'] . ","
                . "sale_nac_old_2nd = " . $row['sale_2nd_sum'] . ","
                . "km_nac_old = " . $row['km_sum'] . ","
                . "km_nac_old_2nd = " . $row['km_2nd_sum'] . ","
                . "hsd_nac_old = " . $row['hsd_sum'] . ","
                . "sch_trip_nac_old = " . $row['sch_trip_sum'] . ","
                . "act_trip_nac_old = " . $row['act_trip_sum']  
                               
                . " where unit = '" . $row['unit'] . "' and mth = '" . $mth . "'"; 
       
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
        
        }
 }
 ?>
 <script language="javascript">
            alert("ok8");
             </script>
       <?php
 
 // update 1st shift out from daily_record_sum table
 $query166 = "select unit,sum(veh_out_1623) out_1623,sum(veh_out_al_nac) out_al_nac,sum(veh_out_al_ac) out_al_ac,sum(veh_out_volvo) out_volvo,sum(veh_out_old) out_old from cstcmis.daily_record_sum where date_format(op_date,'%y%m') = '" . $mth . "' group by unit";
 $result166 = mysqli_query($cstccon,$query166) or die(mysqli_error());
 //$row166 = mysqli_fetch_assoc($result166);
 //$out_ac = $row166['out_al_ac'] +  $row166['out_volvo'];
 //$out_nac = $row166['out_al_nac'] +  $row166['out_1623'];
 //$out_old = $row166['out_old'];
 
 while($row166 = mysqli_fetch_assoc($result166))  {
    
 $out_ac = $row166['out_al_ac'] +  $row166['out_volvo'];
 $out_nac = $row166['out_al_nac'] +  $row166['out_1623'];
 $out_old = $row166['out_old'];
 
 $query1 = "update cstcmis.month_data set out_1st_nac_old = " . $out_old  / $days . ","
                . "out_1st_nac_new = " . $out_nac  / $days . ","
                . "out_1st_ac = " . $out_ac / $days
                               
                . " where unit = '" . $row166['unit'] . "' and mth = '" . $mth . "'"; 
       
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
        
 
 }
 
 
 ?>
 <script language="javascript">
            alert("ok9");
             </script>
       <?php

 //UPDATE KM FFROM cb FILE
 $qrycb = "select a.type type1,b.ser_shift ser_shift1,c.depot depot1,sum(tic_amt) tic_amt1,sum(b.sch_km * b.trp_dn / b.trp_sch) km from cstcmis.model_master a,cstcmis.veh0214 c,cstcmis.cb b where b.veh_no = c.vehno and a.model = c.model and date_format(wb_date,'%y%m') = '" . $mth . "' group by c.depot,a.type,b.ser_shift having sum(b.sch_km * b.trp_dn / b.trp_sch) > 0";
$resultcb = mysqli_query($cstccon,$qrycb) or die(mysqli_error());

 while($rowcb = mysqli_fetch_assoc($resultcb))  {
          

  //   if($rowcb['depot1'] != 'BD' && $rowcb['depot1'] != 'PD' && $rowcb['depot1'] != 'KD' && $rowcb['depot1'] != 'GD' && $rowcb['depot1'] != 'TPD' && $rowcb['depot1'] != 'TD'){
     if($rowcb['type1'] == 'A'){
         if($rowcb['ser_shift1'] == '1'){
         $query1 = "update cstcmis.month_data set sale_ac_1st = " . $rowcb['tic_amt1'] . ",km_ac = " . $rowcb['km'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         }
         if($rowcb['ser_shift1'] == '2'){
        $query1 = "update cstcmis.month_data set sale_ac_2nd = " . $rowcb['tic_amt1'] . ",km_ac_2nd = " . $rowcb['km'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         }
     }
     if($rowcb['type1'] == 'N'){
         if($rowcb['ser_shift1'] == '1'){
        $query1 = "update cstcmis.month_data set sale_nac_1st_new = " . $rowcb['tic_amt1'] . ",km_nac_new = " . $rowcb['km'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         }
         if($rowcb['ser_shift1'] == '2'){
        $query1 = "update cstcmis.month_data set sale_nac_new_2nd = " . $rowcb['tic_amt1'] . ",km_nac_new_2nd = " . $rowcb['km'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         }
     }
     if($rowcb['type1'] == 'O'){
         if($rowcb['ser_shift1'] == '1'){
        $query1 = "update cstcmis.month_data set sale_nac_1st_old = " . $rowcb['tic_amt1'] . ",km_nac_old = " . $rowcb['km'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         }
         if($rowcb['ser_shift1'] == '2'){
        $query1 = "update cstcmis.month_data set sale_nac_old_2nd = " . $rowcb['tic_amt1'] . ",km_nac_old_2nd = " . $rowcb['km'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         }
     }
     
 }
 ?>
 <script language="javascript">
            alert("ok10");
             </script>
       <?php
 
 //SALE UPDATE FROM daily_record_model
  $qrycb1 = "select a.type type1,b.unit depot1,sum(km) km_1st,sum(km_2nd) km_2nd1,sum(b.sale_1st) sale1,sum(b.sale_2nd) sale2 from cstcmis.model_master a,cstcmis.daily_record_model b where a.model = b.model and date_format(b.op_date,'%y%m') = '" . $mth . "' group by b.unit,a.type";
$resultcb1 = mysqli_query($cstccon,$qrycb1) or die(mysqli_error());

 while($rowcb1 = mysqli_fetch_assoc($resultcb1))  {
     
  //   if($rowcb['depot1'] != 'BD' && $rowcb['depot1'] != 'PD' && $rowcb['depot1'] != 'KD' && $rowcb['depot1'] != 'GD' && $rowcb['depot1'] != 'TPD' && $rowcb['depot1'] != 'TD'){
     if($rowcb1['type1'] == 'A'){
        
         $query1 = "update cstcmis.month_data set sale_ac_1st = " . $rowcb1['sale1'] . ",sale_ac_2nd = " . $rowcb1['sale2'] . ",km_ac = " . $rowcb1['km_1st'] . ",km_ac_2nd = " . $rowcb1['km_2nd1'] . " where unit = '" . $rowcb1['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         
        
     }
      if($rowcb1['type1'] == 'N'){
        
         $query1 = "update cstcmis.month_data set sale_nac_1st_new = " . $rowcb1['sale1'] . ",sale_nac_new_2nd = " . $rowcb1['sale2'] . ",km_nac_new = " . $rowcb1['km_1st'] . ",km_nac_new_2nd = " . $rowcb1['km_2nd1'] . " where unit = '" . $rowcb1['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         
        
     }
     if($rowcb1['type1'] == 'O'){
        
         $query1 = "update cstcmis.month_data set sale_nac_1st_old = " . $rowcb1['sale1'] . ",sale_nac_old_2nd = " . $rowcb1['sale2'] . ",km_nac_old = " . $rowcb1['km_1st'] . ",km_nac_old_2nd = " . $rowcb1['km_2nd1'] . " where unit = '" . $rowcb1['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         
        
     }
     
     
 }
 
 ?>
 <script language="javascript">
            alert("ok11");
             </script>
       <?php
 
 $queryx1 = "delete from cstcmis.veh_mth_data_temp";
$resultx1 = mysqli_query($cstccon,$queryx1) or die(mysqli_error()); 

$queryx11 = "insert into cstcmis.veh_mth_data_temp select * from cstcmis.veh_mth_data";
$resultx11 = mysqli_query($cstccon,$queryx11) or die(mysqli_error()); 

$queryx11y = "select vehno, date_format(issue_date,'%y%m') mth,sum(qty) qty1 from cstcmis.veh_hsd_other_depot where date_format(issue_date,'%y%m') = '" . $mth . "' group by vehno,date_format(issue_date,'%y%m')";
$resultx11y = mysqli_query($cstccon,$queryx11y) or die(mysqli_error()); 
while($rowx11y = mysqli_fetch_assoc($resultx11y))  {
    $queryx112 = "update cstcmis.veh_mth_data_temp set hsd_from_other_depot = " . intval($rowx11y['qty1']) . " where veh_no = '" . $rowx11y['vehno'] . "' and month = '" . $rowx11y['mth'] . "'";
$resultx112 = mysqli_query($cstccon,$queryx112) or die(mysqli_error()); 
    
}
$queryx1 = "delete from cstcmis.veh_mth_data";
$resultx1 = mysqli_query($cstccon,$queryx1) or die(mysqli_error()); 

$queryx11 = "insert into cstcmis.veh_mth_data select * from cstcmis.veh_mth_data_temp";
$resultx11 = mysqli_query($cstccon,$queryx11) or die(mysqli_error()); 

 
$queryx = "select a.TYPE type1,b.depot depot1,sum(c.hsd ) hsd_tot from cstcmis.model_master a, cstcmis.veh0214 b, cstcmis.veh_mth_data c where c.month = '" . $mth . "' and b.vehno = c.veh_no and a.model = b.model group by b.depot,a.TYPE";

$resultx = mysqli_query($cstccon,$queryx) or die(mysqli_error()); 
 
while($rowcb = mysqli_fetch_assoc($resultx))  {
     
     if($rowcb['type1'] == 'A'){
         
         $query1 = "update cstcmis.month_data set hsd_ac = " . $rowcb['hsd_tot'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'" ; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         
     }
     if($rowcb['type1'] == 'N'){
         
         $query1 = "update cstcmis.month_data set hsd_nac_new = " . $rowcb['hsd_tot'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'" ; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         
     }
     if($rowcb['type1'] == 'O'){
         
         $query1 = "update cstcmis.month_data set hsd_nac_old = " . $rowcb['hsd_tot'] . " where unit = '" . $rowcb['depot1'] . "' and mth = '" . $mth . "'" ; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
         
     }
     
     
 } 
 ?>
 <script language="javascript">
            alert("ok12");
             </script>
       <?php
 
 //echo $mth;
 
$qq = "select vehno,count(*) xx from cstcmis.maint_tran where maint_code = '3' and DATE_FORMAT(maint_date,'%y%m') = '" . $mth . "' group by vehno";
$qq1 = mysqli_query($cstccon,$qq) or die(mysqli_error()); 
$qq2 = mysqli_fetch_assoc($qq1);
do {
    $aaa = intval($qq2['xx']);
    
     $qq3 = "update cstcmis.veh_mth_data set daily_maint = " . $aaa . " where veh_no = '" . $qq2['vehno'] . "' and month = '" . $mth . "'" ; 
     $qq4 = mysqli_query($cstccon,$qq3) or die(mysqli_error());
}while($qq2 = mysqli_fetch_assoc($qq1));

$qq3 = "select vehno,count(*) xx from cstcmis.maint_tran where maint_code = '4' and DATE_FORMAT(maint_date,'%y%m') = '" . $mth . "' group by vehno";
$qq4 = mysqli_query($cstccon,$qq3) or die(mysqli_error()); 
$qq5 = mysqli_fetch_assoc($qq4);
do {
    $aaa = intval($qq5['xx']);
    
     $qq6 = "update cstcmis.veh_mth_data set washing = " . $aaa . " where veh_no = '" . $qq5['vehno'] . "' and month = '" . $mth . "'" ; 
     $qq7 = mysqli_query($cstccon,$qq6) or die(mysqli_error());
}while($qq5 = mysqli_fetch_assoc($qq4));

$qq8 = "drop table cstcmis.ttt";
$qq9 = mysqli_query($cstccon,$qq8) or die(mysqli_error());


$qq10 = "create table cstcmis.ttt select veh_no,wb_date,count(*) xx,sum(tic_amt) tic_amt1 from cstcmis.cb where DATE_FORMAT(wb_date,'%y%m') = '" . $mth . "' group by veh_no,wb_date";
$qq11 = mysqli_query($cstccon,$qq10) or die(mysqli_error()); 

$qq12 = "select veh_no,sum(tic_amt1) tic_amt_tot , count(*) xx from cstcmis.ttt group by veh_no";
$qq13 = mysqli_query($cstccon,$qq12) or die(mysqli_error());
$qq14 = mysqli_fetch_assoc($qq13);
do {
    $aaa = intval($qq14['xx']);
    $bbb = intval($qq14['tic_amt_tot']);
    
     $qq15 = "update cstcmis.veh_mth_data set sale = " . $bbb . ",out_days = " . $aaa . " where veh_no = '" . $qq14['veh_no'] . "' and month = '" . $mth . "'" ; 
     $qq16 = mysqli_query($cstccon,$qq15) or die(mysqli_error());
}while($qq14 = mysqli_fetch_assoc($qq13));

$qq12 = "select a.vehno,sum(a.ITM_VAL) xx from cstc_store.bintxnitm_depot a,bintxn_depot b where a.BNTXN_ID = b.BNTXN_ID and DATE_FORMAT(b.DOC_DT,'%y%m') = '" . $mth . "'  group by a.vehno";
$qq13 = mysqli_query($cstccon,$qq12) or die(mysqli_error());
$qq14 = mysqli_fetch_assoc($qq13);
do {
    $ccc = intval($qq14['xx']);
    
    
     $qq15 = "update cstcmis.veh_mth_data set spares = " . $ccc . " where veh_no = '" . $qq14['vehno'] . "' and month = '" . $mth . "'" ; 
     $qq16 = mysqli_query($cstccon,$qq15) or die(mysqli_error());
}while($qq14 = mysqli_fetch_assoc($qq13));
// PROCESS FOR HSD ISSUED FROM OTHER DEPOT START 
 $query11 = "select a.depot depot1,c.TYPE ac_type,sum(a.qty) qty_tot from cstcmis.veh_hsd_other_depot a, cstcmis.veh0214 b, cstcmis.model_master c where a.vehno = b.vehno and b.model = c.model and date_format(a.issue_date,'%y%m') = '" . $mth . "' group by c.TYPE,b.model having qty_tot > 0";
$result11 = mysqli_query($cstccon,$query11) or die(mysqli_error()); 
while($rowp = mysqli_fetch_assoc($result11))  { 
 
     if($rowp['ac_type'] == 'A'){
        $query1 = "update cstcmis.month_data set hsd_ac = hsd_ac + " . intval($rowp['qty_tot']) . " where unit = '" . $rowp['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error()); 
     }
    if($rowp['ac_type'] == 'N'){
        $query1 = "update cstcmis.month_data set hsd_nac_new = hsd_nac_new + " . intval($rowp['qty_tot']) . " where unit = '" . $rowp['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error()); 
     }
     if($rowp['ac_type'] == 'O'){
        $query1 = "update cstcmis.month_data set hsd_nac_old = hsd_nac_old + " . intval($rowp['qty_tot']) . " where unit = '" . $rowp['depot1'] . "' and mth = '" . $mth . "'"; 
        $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error()); 
    }
    
}
// PROCESS FOR HSD ISSUED FROM OTHER DEPOT END 
 ?>
 <script language="javascript">
            alert("ok13");
             </script>
       <?php
 
 
 
 
 
 
 $query1 = "select rate from cstcmis.item_rate where item = 'hsd' and mth = '" . $mth . "'";
 $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
    $row = mysqli_fetch_assoc($result1);
    $hsd_rate = $row['rate'];

 $query3 = "update cstcmis.month_data set hsd_rate = " . $hsd_rate . " where mth = '" . $mth . "'";
 $result3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
 

  $query5 = "SELECT date_format(op_date,'%y%m')  xx,"
          . "depot,"
          . "SUM(IF(daily_maint = 'Y', 1,0)) daily_maint_tot,"
          . "SUM(IF(nontech_maint = 'Y', 1,0)) nontech_maint_tot,"
          . "SUM(IF(heavy_maint = 'Y', 1,0)) heavy_maint_tot "
          . "FROM cstcmis.daily_record_vehicle "
          . "GROUP BY date_format(op_date,'%y%m'),depot having xx = '" . $mth . "'";
  $result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
 
    while($row5 = mysqli_fetch_assoc($result5))  {
     
    $query3 = "update cstcmis.month_data set non_tech_maint_ac = " . $row5['nontech_maint_tot'] . ",daily_tech_maint = " . $row5['daily_maint_tot'] . ",heavy_maint = " . $row5['heavy_maint_tot'] . " where mth = '" . $mth . "' and unit = '" . $row5['depot'] . "'";
    $result3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
 
 }
 
 $query51 = "SELECT date_format(op_date,'%y%m')  xx,"
          . "unit,"
          . "SUM(hsd_nrv) hsd_nrv_tot,"
          . "SUM(hsd_od) hsd_od_tot "
          . "FROM cstcmis.daily_record_engg "
          . "GROUP BY date_format(op_date,'%y%m'),unit having xx = '" . $mth . "'";
  $result51 = mysqli_query($cstccon,$query51) or die(mysqli_error());
 
    while($row51 = mysqli_fetch_assoc($result51))  {
     
    $query3 = "update cstcmis.month_data set hsd_nrv = " . $row51['hsd_nrv_tot'] . ",hsd_od = " . $row51['hsd_od_tot'] . " where mth = '" . $mth . "' and unit = '" . $row51['unit'] . "'";
    $result3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
    
     
 
 }
 
 //$queryx = "select a.depot,a.model,b.type,c.month,sum(c.km),sum(c.hsd)* from veh0214 a,model_master b,veh_mth_data c where  a.vehno = c.veh_no and a.model = c.model and c.month = '" . $mth . "' group by a.depot,b.model,c.type"
 
 ?>
 <script language="javascript">
            alert("ok14");
             </script>
       <?php
 
 
 
 
 
 
 
 
 
 
 
 
    $query3 = "update cstcmis.month_data set opr_cost_ac = hsd_ac * hsd_rate, opr_cost_nac_new = hsd_nac_new * hsd_rate, opr_cost_nac_old = hsd_nac_old * hsd_rate where mth = '" . $mth .  "'";
    $result3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
	
	///  closing stock
	
	$query16 = "delete from cstcmis.hsd_open_close_stock where mth = '" . $mth . "'";
	$result16 = mysqli_query($cstccon,$query16) or die(mysqli_error());
	
	
	$queryday = "SELECT LAST_DAY('" . "20" . substr($mth,0,2) . "-" . substr($mth,2,2) . "-01') as 'last_day_mth'";
	$resultday = mysqli_query($cstccon,$queryday) or die(mysqli_error());
	$rowday = mysqli_fetch_assoc($resultday);
	$last_day_mth = $rowday['last_day_mth'];

	
	
	$query1 = "SELECT DATE_ADD('" . "20" . substr($mth,0,2) . "-" . substr($mth,2,2) . "-01',INTERVAL -20 DAY) as 'day_prev_mth'";
	$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
	$row1 = mysqli_fetch_assoc($result1);
	$any_day_prev_mth = $row1['day_prev_mth'];
	
	
	$query5 = "SELECT LAST_DAY('" . $any_day_prev_mth . "') as 'last_day_prev_mth'";
	$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
	$row5 = mysqli_fetch_assoc($result5);
	$last_day_prev_mth = $row5['last_day_prev_mth'];
	
	$query1 = "select * from cstcmis.hsd where op_date = '" . $last_day_prev_mth . "'";
 	$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
 	$rows1 = mysqli_fetch_assoc($result1);
	if(mysqli_num_rows($result1)< 1){$hsd_bd_open = 0;} 	else{$hsd_bd_open = $rows1['hsd_bd'];}
	if(mysqli_num_rows($result1)< 1){$hsd_nd_open = 0;} 	else{$hsd_nd_open = $rows1['hsd_nd'];}
	if(mysqli_num_rows($result1)< 1){$hsd_pd_open = 0;} 	else{$hsd_pd_open = $rows1['hsd_pd'];}
	if(mysqli_num_rows($result1)< 1){$hsd_md_open = 0;} 	else{$hsd_md_open = $rows1['hsd_md'];}
	if(mysqli_num_rows($result1)< 1){$hsd_sld_open = 0;} else{$hsd_sld_open = $rows1['hsd_sld'];}
	if(mysqli_num_rows($result1)< 1){$hsd_kd_open = 0;} 	else{$hsd_kd_open = $rows1['hsd_kd'];}
	if(mysqli_num_rows($result1)< 1){$hsd_gd_open = 0;} 	else{$hsd_gd_open = $rows1['hsd_gd'];}
	if(mysqli_num_rows($result1)< 1){$hsd_ld_open = 0;} 	else{$hsd_ld_open = $rows1['hsd_ld'];}
	if(mysqli_num_rows($result1)< 1){$hsd_td_open = 0;} 	else{$hsd_td_open = $rows1['hsd_td'];}
	if(mysqli_num_rows($result1)< 1){$hsd_tpd_open = 0;} else{$hsd_tpd_open = $rows1['hsd_tpd'];}
	if(mysqli_num_rows($result1)< 1){$hsd_hd_open = 0;} 	else{$hsd_hd_open = $rows1['hsd_hd'];}
	
	$query13 = "select * from cstcmis.hsd where op_date = '" . $last_day_mth . "'";
 	$result13 = mysqli_query($cstccon,$query13) or die(mysqli_error());
 	$rows13 = mysqli_fetch_assoc($result13);
	if(mysqli_num_rows($result13)< 1){$hsd_bd_close = 0;} 	else{$hsd_bd_close = $rows13['hsd_bd'];}
	if(mysqli_num_rows($result13)< 1){$hsd_nd_close = 0;} 	else{$hsd_nd_close = $rows13['hsd_nd'];}
	if(mysqli_num_rows($result13)< 1){$hsd_pd_close = 0;} 	else{$hsd_pd_close = $rows13['hsd_pd'];}
	if(mysqli_num_rows($result13)< 1){$hsd_md_close = 0;} 	else{$hsd_md_close = $rows13['hsd_md'];}
	if(mysqli_num_rows($result13)< 1){$hsd_sld_close = 0;} 	else{$hsd_sld_close = $rows13['hsd_sld'];}
	if(mysqli_num_rows($result13)< 1){$hsd_kd_close = 0;} 	else{$hsd_kd_close = $rows13['hsd_kd'];}
	if(mysqli_num_rows($result13)< 1){$hsd_gd_close = 0;} 	else{$hsd_gd_close = $rows13['hsd_gd'];}
	if(mysqli_num_rows($result13)< 1){$hsd_ld_close = 0;} 	else{$hsd_ld_close = $rows13['hsd_ld'];}
	if(mysqli_num_rows($result13)< 1){$hsd_td_close = 0;} 	else{$hsd_td_close = $rows13['hsd_td'];}
	if(mysqli_num_rows($result13)< 1){$hsd_tpd_close = 0;} 	else{$hsd_tpd_close = $rows13['hsd_tpd'];}
	if(mysqli_num_rows($result13)< 1){$hsd_hd_close = 0;} 	else{$hsd_hd_close = $rows13['hsd_hd'];}
 	
	
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('BD','" . $mth . "'," . $hsd_bd_open . "," . $hsd_bd_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('ND','" . $mth . "'," . $hsd_nd_open . "," . $hsd_nd_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('PD','" . $mth . "'," . $hsd_pd_open . "," . $hsd_pd_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('MD','" . $mth . "'," . $hsd_md_open . "," . $hsd_md_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('SLD','" . $mth . "'," . $hsd_sld_open . "," . $hsd_sld_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('KD','" . $mth . "'," . $hsd_kd_open . "," . $hsd_kd_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('GD','" . $mth . "'," . $hsd_gd_open . "," . $hsd_gd_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('LD','" . $mth . "'," . $hsd_ld_open . "," . $hsd_ld_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('TD','" . $mth . "'," . $hsd_td_open . "," . $hsd_td_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('TPD','" . $mth . "'," . $hsd_tpd_open . "," . $hsd_tpd_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	$query15 = "insert into cstcmis.hsd_open_close_stock (unit,mth,hsd_stock_open,hsd_stock_close) values ('HD','" . $mth . "'," . $hsd_hd_open . "," . $hsd_hd_close . ")";
	$result15 = mysqli_query($cstccon,$query15) or die(mysqli_error());
	
	//********************************************8888888888  ROUTE DATA UPDATE
	
?>
 <script language="javascript">
            alert("ok15");
             </script>
       <?php
 	
	
$queryx1 = "DELETE FROM  cstcmis.month_data_route where mth = '" . $mth . "'";
$resultx1 = mysqli_query($cstccon,$queryx1) or die(mysqli_error());	
	
$queryx = "SELECT RT_NO from cstcmis.route_master";
$resultx = mysqli_query($cstccon,$queryx) or die(mysqli_error());
while($rowx = mysqli_fetch_assoc($resultx))  {
$rt_no = $rowx['RT_NO'];

$query = "select unit ,route ,YEAR(op_date) as yearx, MONTH(op_date) as monthx, "
        . "sum(km) as km_tot,sum(km_2nd) as km_2nd_tot,"
        . " sum(sale_1st) as sale_1st_tot, sum(sale_2nd) as sale_2nd_tot,"
        . "sum(sch_trip) as sch_trip_tot, sum(act_trip) as act_trip_tot,"
        . "sum(veh_out_1st) as veh_out_1st_tot, sum(veh_out_2nd) as veh_out_2nd_tot "
        . " from cstcmis.daily_record_route  "
        . "group by unit,route,YEAR(op_date), MONTH(op_date) having route = '" . $rt_no . "' and yearx = '" . '20' . substr($mth,0,2) . "' and monthx = '" . substr($mth,2,2) . "' and sch_trip_tot > 0 "
        . "order by route,unit,YEAR(op_date) , MONTH(op_date) ";

                                             
$result = mysqli_query($cstccon,$query) or die(mysqli_error());

	while($row = mysqli_fetch_assoc($result))  {
		
		if($row['monthx'] < 10){$monthx = '0' . $row['monthx'];} else {$monthx = $row['monthx'];}
		$unit = $row['unit'];
		$yearx = $row['yearx'];
		$mthx = $yearx . $monthx;
		
		//if($unit == 'BD' && $yearx == '20' . substr($mth2,0,2) && $monthx == substr($mth,2,2)){
		$queryx2 = "insert into cstcmis.month_data_route(unit, mth, rt_no, out_1st, out_2nd, sch_trip, act_trip, sale_1st, sale_2nd, km, km_2nd) values ('" . $row['unit'] . "','" . $mth . "','" . $rt_no . "'," . $row['veh_out_1st_tot'] . "," . $row['veh_out_2nd_tot'] . "," . $row['sch_trip_tot'] . "," . $row['act_trip_tot'] . "," . $row['sale_1st_tot'] . "," . $row['sale_2nd_tot'] . "," . $row['km_tot'] . "," . $row['km_2nd_tot'] . ")";
		$resultx2 = mysqli_query($cstccon,$queryx2) or die(mysqli_error());
		}}
	
$sql121 = "delete from cstcmis.daily_record_sum where DATE_FORMAT(op_date,'%m') = '" . $mth_mm . "' and DATE_FORMAT(op_date,'%Y') = '" . $mth_yyyy . "'";
$result121 = mysqli_query($cstccon,$sql121) or die(mysqli_error());                  
                
                
                
 $sql = "insert into cstcmis.cstc_daily_performance(op_date,veh_supply_old1,veh_supply_16231,veh_supply_al_nac1,veh_supply_al_ac1,veh_supply_volvo1,veh_supply_1st_tot,veh_supply_2nd_tot, att_driver_1st_tot,att_driver_2nd_tot, att_cond_1st_tot, att_cond_2nd_tot) select op_date,sum(veh_supply_old) veh_supply_old1,sum(veh_supply_1623) veh_supply_16231,sum(veh_supply_al_nac) veh_supply_al_nac1,sum(veh_supply_al_ac) veh_supply_al_ac1,sum(veh_supply_volvo) veh_supply_volvo1,sum(veh_supply_1st) veh_supply_1st_tot,sum(veh_supply_2nd) veh_supply_2nd_tot, sum(att_driver_1st + att_driver_tr_1st) att_driver_1st_tot,sum(att_driver_2nd + att_driver_tr_2nd) att_driver_2nd_tot,sum(att_cond_1st + att_cond_tr_1st) att_cond_1st_tot,sum(att_cond_2nd + att_cond_tr_2nd) att_cond_2nd_tot from cstcmis.daily_record_sum where DATE_FORMAT(op_date,'%m') = '" . $mth_mm . "' and DATE_FORMAT(op_date,'%Y') = '" . $mth_yyyy . "' group by op_date order by op_date desc,unit";
$result = mysqli_query($cstccon,$sql) or die(mysqli_error());  ?>
 <script language="javascript">
            alert("Processing Done Successfully");
             document.location='WBTC_MainMenu.php';
       </script>





