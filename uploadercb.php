
<?php
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
$op_date_insert11 =  $_POST["indent_ref_date"]      ;
$op_date_insert = substr($op_date_insert11,6,4) . '-' . substr($op_date_insert11,3,2) . '-' . substr($op_date_insert11,0,2); 

require_once('Connections/cstccon.php');
//echo 'kolkata';
//mysql_select_db("cstcmis");
$query5 = "SELECT * from veh_last_upload_date where unit = '" . $_SESSION['UNIT'] . "' and last_upload_date = '" . $op_date_insert . "'";
$result5 = mysqli_query($cstccon,$query5) or die(mysqli_error());
if(mysqli_num_rows($result5)>0)
{
   //echo 'kolkata1'; 
    
    $sql1F="DELETE FROM cstc_store.hsd_issue_to_other_vehicle WHERE DEPOT = '" . $_SESSION['UNIT'] . "' AND VEHNO IN (SELECT vehno from veh0214 where depot = '" . $_SESSION['UNIT'] . "') AND DOI = '" . $op_date_insert . "'";
        $result1F=mysqli_query($cstccon,$sql1F);


    $target_dir = $_SESSION['UNIT'] . "/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file1 = $target_dir . substr($op_date_insert,0,7) . basename($_FILES["fileToUpload"]["name"]);
    $target_file_date = $target_dir . basename($_FILES["fileToUpload"]["name"]) . $op_date_insert;
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $depot = $_SESSION['UNIT'];

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //$op_date_insert =  $_POST["datepicker_from"]      ;
        $test =  $_POST["test"]      ;     
           
        $i = 1; 
        if($_SESSION['UNIT'] == 'KD'){$source = fopen( 'KD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'ND'){$source = fopen( 'ND/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'BD'){$source = fopen( 'BD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'PD'){$source = fopen( 'PD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'MD'){$source = fopen( 'MD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'SLD'){$source = fopen( 'SLD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'GD'){$source = fopen( 'GD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'LD'){$source = fopen( 'LD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'TD'){$source = fopen( 'TD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'TPD'){$source = fopen( 'TPD/cb.csv', 'r') or die("Problem open file");}
        if($_SESSION['UNIT'] == 'HD'){$source = fopen( 'HD/cb.csv', 'r') or die("Problem open file");}
$hsd_tot_act = 0;
        do
        {       
            $dpt_no = $data[3];
            $wb_time = $data[4];
            $veh_no = $data[6];
            $ser_no1 = $data[7];
            $ser_car_no = $data[8];
            $ser_shift = $data[9];
            $ser_tp = $data[10];
            $route1 = $data[11];
            $cnd_no = $data[12];
            $drv_no = $data[13];
            $wb_act_srl = $data[14];
            $hsd_act = $data[15];
            $wb_r_tm = $data[17];
            $wb_date = $data[18];
            $tic_amt = $data[20];
            $mis_amt = $data[21];
            $ld_exp = $data[26];
            $a_to_rmt40 = $data[27];
            //$tic_amt = $data[28];
            // tic_amt will be changed to following after starting uploading by all depots
            //$tic_amt = $data[27];
            $pol_amt = $data[32];
            $inc_cnd = $data[30];
            $inc_drv = $data[31];
            $g_out = $data[34];
            $g_in = $data[35];
            $trp_dn = $data[37];
            $trp_sch = $data[38];
            $sch_km = $data[39];
       
            $tic_amt1 = $a_to_rmt40 + $pol_amt - 120;
            if($veh_no == 'WB050956'){
                echo '*' . $veh_no . '*' . $a_to_rmt40 . '*' . $tic_amt1 . '*' . $pol_amt . '*';
            }
        
            // if($dpt_no != '10' && $pol_amt < 1000){
            if($dpt_no != '10'){
            $tic_amt_etm = $a_to_rmt40 - $tic_amt + $pol_amt - 120 ;}
        
            if($dpt_no == '10'){
                $tic_amt_etm = $a_to_rmt40 - $tic_amt + $pol_amt - 120 ;
            }
            if($dpt_no == '3'){
                $tic_amt_etm = $mis_amt ;
            }
            if($tic_amt1 < 0){$tic_amt1 = 0;}
       //  if($tic_amt_etm < 10){$tic_amt_etm = 0;}
        
            $km = ($trp_dn / $trp_sch) * $sch_km ;
        $sql26 = "select veh_cur_kmpl from veh0214 where vehno = '" . $veh_no . "'";
        $result26=mysqli_query($cstccon,$sql26);  
        $row26 = mysqli_fetch_assoc($result26);  
        $veh_cur_kmpl = $row26['veh_cur_kmpl'];
        $hsd = number_format($km / $veh_cur_kmpl,0) ; 
        
//if($_SESSION['UNIT'] == 'SLD' && substr($route1,0,2) != 'AC'){$tic_amt_etm = 0;}
//if($_SESSION['UNIT'] == 'BD' && substr($route1,0,2) != 'AC'){$tic_amt_etm = 0;}
//if($_SESSION['UNIT'] == 'TPD'){$tic_amt_etm = 0;}

//if($_SESSION['UNIT'] == 'ND'){$tic_amt_etm = 0;}
//if($_SESSION['UNIT'] == 'SLD'){$tic_amt_etm = 0;}
//echo 'kolkata1';

if($_SESSION['UNIT'] == 'LD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPLD';
}
}    
if($_SESSION['UNIT'] == 'TD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPTD';
}
}   
if($_SESSION['UNIT'] == 'ND'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPND';
}
}  
if($_SESSION['UNIT'] == 'BD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPBD';
}
}  
if($_SESSION['UNIT'] == 'PD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPPD';
}
}  
if($_SESSION['UNIT'] == 'MD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPMD';
}
} 
if($_SESSION['UNIT'] == 'SLD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPSLD';
}
}   
if($_SESSION['UNIT'] == 'KD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPKD';
}
}
if($_SESSION['UNIT'] == 'GD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
    $veh_no = 'WBSDHOPGD';
}
} 
if($_SESSION['UNIT'] == 'TPD'){
if($ser_tp == 'ES'){
    $route1 = 'ES'; 
   $veh_no = 'WBSDHOPTPD';
}
}    
if($_SESSION['UNIT'] == 'TPD'){
    if($ser_no1 == 'CI')                  
     {$route1 = 'RESERV';}
    }
  
if($_SESSION['UNIT'] == 'HD'){
if($ser_tp == 'ES'){
   $route1 = 'ES'; 
    $veh_no = 'WBSDHOPHD';
}
}  
$op_date_insert1 =  substr($op_date_insert,2,2) . substr($op_date_insert,5,2) . substr($op_date_insert,8,2)  ;
//echo $op_date_insert1;
//if($wb_date == $op_date_insert1){
//echo $test;
//if($wb_date == '160121'){

// update veh0214 for last plied date

$sql2x = "update veh0214 set last_plied_date = '$op_date_insert' where vehno = '$veh_no'";
$result2x=mysqli_query($cstccon,$sql2x);




    if($wb_date == $op_date_insert1){
$sql2 = "delete from cb where depot = '" . $depot . "' and cnd_no = '" . $cnd_no . "' and drv_no = '" . $drv_no . "' and wb_date = '" . $wb_date . "' and wb_act_srl = '" . $wb_act_srl . "'";
$result2=mysqli_query($cstccon,$sql2);      

$sql3 = "select route_mis from route_master_depot where depot_route_desc = '" . $route1 . "' and depot = '" . $_SESSION['UNIT'] . "'";
$result3=mysqli_query($cstccon,$sql3);      
$row3 = mysqli_fetch_assoc($result3);  
$route = $row3['route_mis'];

$sql = "insert into cb (dpt_no,depot,wb_time,wb_date,veh_no,ser_no1,ser_car_no,ser_shift,ser_tp,route1,route,cnd_no,drv_no,wb_act_srl,hsd,wb_r_tm ,tic_amt,tic_amt_etm,inc_cnd,inc_drv,g_out,g_in,trp_dn,trp_sch,sch_km) values('" . $dpt_no . "','". $_SESSION['UNIT'] . "'," . $wb_time . ",'" . $wb_date . "','" . $veh_no . "','" . $ser_no1 . "'," . $ser_car_no . "," . $ser_shift .",'" . $ser_tp . "','" . $route1 . "','" . $route . "','" . $cnd_no . "','" . $drv_no . "','" . $wb_act_srl . "'," . $hsd . "," . $wb_r_tm . "," . $tic_amt1 . "," . $tic_amt_etm . "," . $inc_cnd . "," . $inc_drv . "," . $g_out . "," . $g_in . "," . $trp_dn . "," . $trp_sch . "," . $sch_km . ")";
$result=mysqli_query($cstccon,$sql);  

// HSD INSERT IN CSTC_STORE DATABASE
if(substr($veh_no,0,6) != 'WBSDHOP'){
$sql1="insert into cstc_store.hsd_issue_to_other_vehicle(DEPOT,VEHNO,DOI,QTY,UPDUSR,TRAN_TYPE) VALUES('" . $_SESSION['UNIT'] . "','" . $veh_no . "','" . $op_date_insert . "'," . $hsd_act . ",'" . $_SESSION['UNIT'] . "','I')";
        $result1=mysqli_query($cstccon,$sql1);
// FOLLOWING 2 LINES INSERTED ON 04/06/2017        
$sql1L="update cstc_store.unit set hsd_stock = hsd_stock - " . $hsd_act . " where UNIT = '" . $_SESSION['UNIT'] . "'";
        $result1L=mysqli_query($cstccon,$sql1L);
}

$hsd_tot_act = $hsd_tot_act + $hsd_act ;
}
$i = $i + 1;
    }while (($data = fgetcsv($source, 1000, ",")) !== FALSE);
   // echo 'ok1';
    fclose($source);
    
    $sql21xw = "delete from hsd_cons_day_depot_wise where DEPOT = '" . $_SESSION['UNIT'] . "' and CONSUMPTION_DATE = '" . $op_date_insert . "'";
    $result21xw=mysqli_query($cstccon,$sql21xw);      
    
    $sql21xw1 = "insert into hsd_cons_day_depot_wise(DEPOT,CONSUMPTION_DATE,QTY) VALUES('" . $_SESSION['UNIT'] . "','" .  $op_date_insert . "'," . $hsd_tot_act . ")";
    $result21xw1=mysqli_query($cstccon,$sql21xw1);   
    
    $sql3d = "select * from cstc_store.hsd_issue_to_other_vehicle where DEPOT = '" . $_SESSION['UNIT'] . "' and VEHNO = 'ROUTE' AND TRAN_TYPE ='I' AND DOI = '" . $op_date_insert . "'";
    $result3d=mysqli_query($cstccon,$sql3d); 
    if(mysqli_num_rows($result3d) > 0){
        
    }
    else {
       // $sql1="insert into cstc_store.hsd_issue_to_other_vehicle(DEPOT,VEHNO,DOI,QTY,UPDUSR,TRAN_TYPE) VALUES('" . $_SESSION['UNIT'] . "','ROUTE','" . $op_date_insert . "'," . $hsd_tot_act . ",'" . $_SESSION['UNIT'] . "','I')";
       // $result1=mysqli_query($cstccon,$sql1);
        
        $sql3f = "select * from cstc_store.ctrl";
$result3f=mysqli_query($cstccon,$sql3f);      
$row3f = mysqli_fetch_assoc($result3f); 
$cur_fin_yr = $row3f['CUR_FIN_YR'];
        
        
        $sql2="update cstc_store.bincrd_depot set ISS_QTY = ISS_QTY + " . $hsd_tot_act . " where FIN_YR = '" . $cur_fin_yr . "' AND DEPOT = '" . $_SESSION['UNIT'] . "' AND PART_NO = 'HSD'";
        $result2=mysqli_query($cstccon,$sql2);
    }
    
 $sql21x = "delete from cb_temp where depot = '" . $_SESSION['UNIT'] . "'";
$result21x=mysqli_query($cstccon,$sql21x);      

$sql21y = "insert into cb_temp (select * from cb where depot = '" . $_SESSION['UNIT'] . "' and wb_date = '" . $op_date_insert . "')";
$result21y=mysqli_query($cstccon,$sql21y); 

}
//move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file1);
copy($target_file,target_file1);
//****************************************
//****************************************cb file update start
$kmpl = 0;   
 $km = 0;
 $hsd = 0;
 
//************************************cb_temp file update end


$sql271 =  "delete from cb_temp where route1 in('','rout')";
$result271 = mysqli_query($cstccon,$sql271);

$sql27 =  "SELECT count(*) nos,a.depot depot1,a.ser_shift ser_shift1,b.model model1,a.wb_date wb_date1,sum(a.sch_km * a.trp_dn / a.trp_sch) km,sum(a.hsd) hsd, sum(a.tic_amt) sale,sum(a.trp_sch) sch_trip,sum(a.trp_dn) act_trip from cb_temp a, veh0214 b where a.veh_no = b.vehno and a.depot = '" . $_SESSION['UNIT'] . "' group by depot1,wb_date1,ser_shift1,model1";
$result27=mysqli_query($cstccon,$sql27); 
//$sql27 =  "SELECT count(*) nos,a.depot depot1,a.ser_shift ser_shift1,b.model model1,a.wb_date wb_date1,sum(a.sch_km * a.trp_dn / a.trp_sch) km,sum(a.hsd) hsd, sum(a.tic_amt) sale,sum(a.trp_sch) sch_trip,sum(a.trp_dn) act_trip from cb_temp a, veh0214 b where a.veh_no = b.vehno and a.depot = '" . $_SESSION['UNIT'] . "' group by depot1,wb_date1,ser_shift1,model1";
//$result27=mysqli_query($cstccon,$sql27);  

while($row27 = mysqli_fetch_assoc($result27))  {
$sql28 =  "delete from daily_record_model where op_date = '" . $row27['wb_date1'] . "' and unit = '" . $_SESSION['UNIT'] . "'";
$result28=mysqli_query($cstccon,$sql28); 
$sql28a =  "delete from daily_record_route where op_date = '" . $row27['wb_date1'] . "' and unit = '" . $_SESSION['UNIT'] . "'";
$result28a=mysqli_query($cstccon,$sql28a); 
}?>

<?php
$sql22 =  "SELECT count(*) nos,a.veh_no veh_no1,a.depot depot1,a.ser_shift ser_shift1,b.model model1,c.type type1,DATE_FORMAT(a.wb_date,'%Y-%m-%d') wb_date1,IFNULL(sum(a.sch_km * a.trp_dn / a.trp_sch),0) km,sum(a.hsd) hsd, sum(a.tic_amt) sale,sum(a.tic_amt_etm) sale_etm,sum(hsd) hsd1,sum(a.trp_sch) sch_trip,sum(a.trp_dn) act_trip from cb_temp a, veh0214 b,model_master c where b.model = c.model and a.veh_no = b.vehno and a.depot = '" . $_SESSION['UNIT'] . "' group by depot1,wb_date1,ser_shift1,model1 order by ser_shift1";
$result22=mysqli_query($cstccon,$sql22);  
//$row22 = mysql_fetch_assoc($result22);
while($row22 = mysqli_fetch_assoc($result22))  { 

$sql24 =  "SELECT wb_date,veh_no,sum(sch_km * trp_dn / trp_sch) km,sum(hsd) hsd1 from cb_temp where wb_date = '" . $row22['wb_date1'] . "' and  veh_no = '" . $row22['veh_no1'] . "' group by wb_date,veh_no ";
$result24=mysqli_query($cstccon,$sql24);     
$row24 = mysqli_fetch_assoc($result24);
if($row24['hsd1'] > 0){
$kmpl = $row24['km'] /  $row24['hsd1']; }
else{$kmpl = 0;}

if($row22['ser_shift1'] == 1){
$sql25 =  "insert into daily_record_model (op_date,unit,model,ac,km,hsd,sale_1st,sale_1st_etm,sch_trip,act_trip,veh_out_1st,op_code) values('" . $row22['wb_date1'] . "','" . $_SESSION['UNIT'] . "','" . $row22['model1'] . "','" . $row22['type1'] . "'," . $row22['km'] . "," . $row22['hsd1'] . "," . $row22['sale'] . "," . $row22['sale_etm'] . ",". $row22['sch_trip'] . "," . $row22['act_trip'] . "," . $row22['nos'] . "," . $_SESSION['USER_ID'] . ")"; 
$result25=mysqli_query($cstccon,$sql25);   
}   
if($row22['ser_shift1'] == 2){
    
$sql28 =  "select * from daily_record_model  where op_date = '" . $row22['wb_date1'] . "' and unit = '" . $_SESSION['UNIT'] . "' and model = '" . $row22['model1'] . "'"; 
$result28=mysqli_query($cstccon,$sql28); 
if(mysqli_num_rows($result28)>0){
  $sql26 =  "update daily_record_model set km_2nd = " . $row22['km'] . ", sale_2nd = " . $row22['sale'] .", sale_2nd_etm = " . $row22['sale_etm'] . ", sch_trip = sch_trip + " . $row22['sch_trip'] . ",hsd = hsd + " . $row22['hsd1']  . ",act_trip = act_trip + " . $row22['act_trip']  . ", veh_out_2nd = " . $row22['nos'] . " where op_date = '" . $row22['wb_date1'] . "' and unit = '" . $_SESSION['UNIT'] . "' and model = '" . $row22['model1'] . "'"; 
$result26=mysqli_query($cstccon,$sql26);  
}
else {
   $sql29 =  "insert into daily_record_model (op_date,unit,model,km_2nd,hsd,sale_2nd,sale_2nd_etm,sch_trip,act_trip,veh_out_2nd,op_code) values('" . $row22['wb_date1'] . "','" . $_SESSION['UNIT'] . "','" . $row22['model1'] . "'," . $row22['km'] . "," . $row22['hsd1'] . "," . $row22['sale'] . "," . $row22['sale_etm'] . "," . $row22['sch_trip'] . "," . $row22['act_trip'] . "," . $row22['nos'] . "," . $_SESSION['USER_ID'] . ")"; 
$result29=mysqli_query($cstccon,$sql29);  
}    
   
}   

$sql31 =  "insert into kmpl_test(model,kmpl,unit) values('" .  $row22['model1'] . "'," . $kmpl . ",'" . $_SESSION['UNIT'] . "')"; 
$result31=mysqli_query($cstccon,$sql31);  
}


///  ROUTE WISE PROCESS

$sql22r =  "SELECT count(*) nos,depot,ser_shift,route1 ,DATE_FORMAT(wb_date,'%Y-%m-%d') wb_date1,IFNULL(sum(sch_km * trp_dn / trp_sch),0) km,sum(hsd) hsd1, sum(tic_amt) sale,sum(trp_sch) sch_trip,sum(trp_dn) act_trip from cb_temp  where depot = '" . $_SESSION['UNIT'] . "' group by depot,wb_date1,ser_shift,route1 order by ser_shift,route1";
$result22r=mysqli_query($cstccon,$sql22r);  
//$row22 = mysql_fetch_assoc($result22);
while($row22r = mysqli_fetch_assoc($result22r))  { 
    $route1 = $row22r['route1'];
 
/// ************************  route check and update start
$sql23r =  "select * from route_master_depot where depot_route_desc = '" . $route1 . "' and depot = '" . $_SESSION['UNIT'] . "'";
$result23r=mysqli_query($cstccon,$sql23r);   
if(mysqli_num_rows($result23r)> 0)
{
/// ************************  route check and update end
//echo 'kolkata';
if($row22r['ser_shift'] == 1){
$sql25r =  "insert into daily_record_route (op_date,unit,route,km,sale_1st,sch_trip,act_trip,veh_out_1st,hsd,op_code) values('" . $row22r['wb_date1'] . "','" . $_SESSION['UNIT'] . "','" . $row22r['route1'] . "'," . $row22r['km'] . "," . $row22r['sale'] . "," . $row22r['sch_trip'] . "," . $row22r['act_trip'] . "," . $row22r['nos'] . "," . $row22r['hsd1'] . "," . $_SESSION['USER_ID'] . ")"; 
$result25r=mysqli_query($cstccon,$sql25r);   
}   
if($row22r['ser_shift'] == 2){
    
$sql28r =  "select * from daily_record_route  where op_date = '" . $row22r['wb_date1'] . "' and unit = '" . $_SESSION['UNIT'] . "' and route = '" . $row22r['route1'] . "'"; 
$result28r=mysqli_query($cstccon,$sql28r); 
if(mysqli_num_rows($result28r)>0){
  $sql26r =  "update daily_record_route set km_2nd = " . $row22r['km'] . ", sale_2nd = " . $row22r['sale'] . ", sch_trip = sch_trip + " . $row22r['sch_trip'] . ",act_trip = act_trip + " . $row22r['act_trip']  . ",hsd = hsd + " . $row22r['hsd1']  . ", veh_out_2nd = " . $row22r['nos'] . " where op_date = '" . $row22r['wb_date1'] . "' and unit = '" . $_SESSION['UNIT'] . "' and route = '" . $route1 . "'"; 
$result26r=mysqli_query($cstccon,$sql26r);  
}
else {
   $sql29r =  "insert into daily_record_route (op_date,unit,route,km_2nd,sale_2nd,sch_trip,act_trip,veh_out_2nd,hsd,op_code) values('" . $row22r['wb_date1'] . "','" . $_SESSION['UNIT'] . "','" . $route1 . "'," . $row22r['km'] . "," . $row22r['sale'] . "," . $row22r['sch_trip'] . "," . $row22r['act_trip'] . "," . $row22r['nos'] . "," . $row22r['hsd1'] . "," . $_SESSION['USER_ID'] . ")"; 
$result29r=mysqli_query($cstccon,$sql29r);  
}    
   
}   

}
else
{
$route_disp = $route1;
echo "<script language='javascript'>";
 echo 'alert("Route '. $route_disp . ' not found in MIS. Sale will not match with cb file. Please match depot route to MIS and run upload again. ")';
 

 echo '</script>';
echo "<html><script> document.location.href='WBTC_DailyFileUploadcb.php';</script></html>"; 

}
}

$sql32 =  "select op_date, sum(sale_1st + sale_2nd) total_sale from daily_record_model where op_date = '" . $op_date_insert ."' and unit = '" . $_SESSION['UNIT'] . "' group by op_date"; 
$result32=mysqli_query($cstccon,$sql32); 
$row32 = mysqli_fetch_assoc($result32);
$total_sale = $row32['total_sale'];
$op_date_new = $row32['op_date'];

$sql2111 = "insert into cb_update_log(unit,file_name,upd_done_date,upd_by,upd_date) values('" . $_SESSION['UNIT'] . "','" . $file_name . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d-%T')," . $_SESSION['USER_ID'] . ",'" . $op_date_insert . "')";
$result2111=mysqli_query($cstccon,$sql2111);  

 

echo "<script language='javascript'>";
 echo 'alert("cb file has been updated successfully. \nTotal Sale for ' . substr($op_date_new,8,2) . '-' . substr($op_date_new,5,2) . '-' . substr($op_date_new,0,4) . '-'  . ' is Rs. ' . $total_sale . '")';
 
 echo '</script>';
echo "<html><script> document.location.href='WBTC_MainMenu.php';</script></html>"; 

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_date);
echo 'kolkata2';
}
else{
    
    echo "<script language='javascript'>";
 echo 'alert("Please upload veh.csv file first then upload cb.csv")';
 
 echo '</script>';
echo "<html><script> document.location.href='WBTC_MainMenu.php';</script></html>"; 
    
}
?> 