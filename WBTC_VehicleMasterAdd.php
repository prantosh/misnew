

       <?php
session_start();
	include('Connections/cstccon.php');
        
        $vehno = htmlspecialchars($_POST['vehno'],ENT_QUOTES);;
        $commdate=htmlspecialchars($_POST['commdate1'],ENT_QUOTES);
	$model=htmlspecialchars($_POST['model'],ENT_QUOTES);
	$macid=htmlspecialchars($_POST['macid'],ENT_QUOTES);
	$chs_no=htmlspecialchars($_POST['chs_no'],ENT_QUOTES);
	$depot=htmlspecialchars($_POST['depot'],ENT_QUOTES);
	
        $unit = $_SESSION['UNIT'];
        $commdate1 = substr($commdate,6,4) . '-' . substr($commdate,3,2) . '-' . substr($commdate,0,2);
	
        $sql_itm51="SELECT * FROM cstcmis.veh0214 WHERE vehno ='" . $vehno . "'";
        $result_itm51=mysqli_query($cstccon,$sql_itm51);
        if(mysqli_num_rows($result_itm51) > 0){?>
            <script type="text/JavaScript">
     alert("<?php echo "Vehicle Number Already Exists." ; ?>");
    
     document.location="WBTC_VehicleMaster.php";

</script> <?php
        }
        
        $sql_itm5="SELECT * FROM cstcmis.model_master WHERE model ='" . $model . "'";
        $result_itm5=mysqli_query($cstccon,$sql_itm5);
        $row_itm5=mysqli_fetch_array($result_itm5);
        $type = $row_itm5['TYPE'];
        $user_id = $_SESSION['USER_ID'];             

        
        
        //$sql_itm="insert into daily_record_model(op_date,unit,model,ac,veh_out_1st,veh_out_2nd,sch_trip,act_trip,km,km_2nd,hsd,sale_1st,sale_2nd,op_code,ip) values('" . $op_date1 . "','" . $unit . "','" . $model . "','" . $type . "'," . $veh_out_1st . "," . $veh_out_2nd . "," . $sch_trip . "," . $act_trip . "," . $km . "," . $km_2nd . "," . $hsd . "," . $sale_1st . "," . $sale_2nd . ",'" . $user_id . "','" . $_SESSION['IP'] . "')";
        //$result_itm=mysqli_query($cstccon,$sql_itm);
        $sql_itm="delete from cstcmis.veh0214 where vehno ='" . $vehno . "'";
        $result_itm=mysqli_query($cstccon,$sql_itm);

        
        
        $sql = "insert into cstcmis.veh0214 (vehno,commdate,model,type,cur_stat,runfleet,macid,chs_no,depot,upd_date,op_code,ip) values('" . $vehno . "','" . $commdate1 . "','" . $model . "','" . $type . "','S','R','" . $macid . "','" . $chs_no . "','" . $depot . "',now(),'" . $user_id . "','" . $_SESSION['IP'] . "')";
	$result=mysqli_query($cstccon,$sql);?>
        <script language="javascript">
           alert("Vehicle Added Successfully")
             document.location='WBTC_VehicleMaster.php';
       </script>
					
								