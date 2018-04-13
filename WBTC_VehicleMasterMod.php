

       <?php
session_start();
	include('Connections/cstccon.php');
        
        $vehno = htmlspecialchars($_POST['veh_no'],ENT_QUOTES);;
        $cur_stat = htmlspecialchars($_POST['cur_stat'],ENT_QUOTES);;
        $held_stat = htmlspecialchars($_POST['held_stat'],ENT_QUOTES);;
       
	$macid=htmlspecialchars($_POST['macid'],ENT_QUOTES);
	
	$depot=htmlspecialchars($_POST['depot'],ENT_QUOTES);
	
        $unit = $_SESSION['UNIT'];
      $sql_itm51="SELECT * FROM cstcmis.veh0214 WHERE vehno ='" . $vehno . "'";
        $result_itm51=mysqli_query($cstccon,$sql_itm51);
        if(mysqli_num_rows($result_itm51) <= 0){?>
            <script type="text/JavaScript">
     alert("<?php echo "Vehicle Number Does not Exist." ; ?>");
    
     document.location="WBTC_VehicleMaster.php";

</script> <?php
        }
        if($cur_stat != 'X'){
            $sql_itm5="update cstcmis.veh0214 set cur_stat = '" . $cur_stat ."' where vehno = '" . $vehno . "'";
            $result_itm5=mysqli_query($cstccon,$sql_itm5);
        }
        if($held_stat != 'S'){
            $sql_itm51="update cstcmis.veh0214 set runfleet = '" . $held_stat ."' where vehno = '" . $vehno . "'";
            $result_itm51=mysqli_query($cstccon,$sql_itm51);
        }
        if($depot != 'S'){
            $sql_itm51="update cstcmis.veh0214 set depot = '" . $depot ."' where vehno = '" . $vehno . "'";
            $result_itm51=mysqli_query($cstccon,$sql_itm51);
        }
        if($macid != ' '){
            $sql_itm51="update cstcmis.veh0214 set macid = '" . $macid ."' where vehno = '" . $vehno . "'";
            $result_itm51=mysqli_query($cstccon,$sql_itm51);
        }
        

        
        
        //$sql_itm="insert into daily_record_model(op_date,unit,model,ac,veh_out_1st,veh_out_2nd,sch_trip,act_trip,km,km_2nd,hsd,sale_1st,sale_2nd,op_code,ip) values('" . $op_date1 . "','" . $unit . "','" . $model . "','" . $type . "'," . $veh_out_1st . "," . $veh_out_2nd . "," . $sch_trip . "," . $act_trip . "," . $km . "," . $km_2nd . "," . $hsd . "," . $sale_1st . "," . $sale_2nd . ",'" . $user_id . "','" . $_SESSION['IP'] . "')";
        //$result_itm=mysqli_query($cstccon,$sql_itm);
       ?>
        <script language="javascript">
            alert('Record Updated Successfuly');
             document.location='WBTC_VehicleMaster.php';
       </script>
					
								