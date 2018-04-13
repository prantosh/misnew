

       <?php
        session_start();
	include('Connections/cstccon.php');
        
        error_reporting(E_ERROR|E_WARNING);
        
        $maint_date=htmlspecialchars($_POST['ref_date'],ENT_QUOTES);
	$vehno=htmlspecialchars($_POST['vehno'],ENT_QUOTES);
        $maint_code1=htmlspecialchars($_POST['maint_code'],ENT_QUOTES);
        
        $query = "SELECT tot_km FROM veh0214 where vehno = '" . $vehno . "'";
        $Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
        $row = mysqli_fetch_assoc($Recordset);
        $tot_km = $row['tot_km'];
        $user_id = $_SESSION['USER_ID']   ; 
        
        $unit = $_SESSION['UNIT'];
        $maint_date1 = substr($maint_date,6,4) . '-' . substr($maint_date,3,2) . '-' . substr($maint_date,0,2);
	
        
        //$sql_itm="insert into daily_record_model(op_date,unit,model,ac,veh_out_1st,veh_out_2nd,sch_trip,act_trip,km,km_2nd,hsd,sale_1st,sale_2nd,op_code,ip) values('" . $op_date1 . "','" . $unit . "','" . $model . "','" . $type . "'," . $veh_out_1st . "," . $veh_out_2nd . "," . $sch_trip . "," . $act_trip . "," . $km . "," . $km_2nd . "," . $hsd . "," . $sale_1st . "," . $sale_2nd . ",'" . $user_id . "','" . $_SESSION['IP'] . "')";
        //$result_itm=mysqli_query($cstccon,$sql_itm);
        $sql_itm="delete from maint_tran where vehno ='" . $vehno . "' and maint_date = '" . $maint_date1 . "' and maint_code = " . $maint_code1 ;
        $result_itm=mysqli_query($cstccon,$sql_itm);

        
        
        $sql = "insert into cstcmis.maint_tran (vehno,depot,maint_code,maint_date,maint_at_km,upd_date,op_code,ip) values('" . $vehno . "','" . $unit . "'," . $maint_code1 . ",'" . $maint_date1 . "'," . intval($tot_km) . ",now(),'" . $user_id . "','" . $_SESSION['IP'] . "')";
	$result=mysqli_query($cstccon,$sql);
 ?>
        <script language="javascript">
            alert('<?php echo $vehno .  $unit .  $maint_code1 .  $maint_date1 .  intval($tot_km) .  $user_id .  $_SESSION['IP'] . "Record Added Successfuly"?>');
                              
    document.location='WBTC_VehicleMaintenance.php';
       </script>
					
								