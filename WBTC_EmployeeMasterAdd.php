

       <?php
session_start();
	include('Connections/cstccon.php');
        
        $empno      = htmlspecialchars($_POST['empno'],ENT_QUOTES);;
        $card       =htmlspecialchars($_POST['card'],ENT_QUOTES);
	$comp_id    =htmlspecialchars($_POST['comp_id'],ENT_QUOTES);
	$name       =htmlspecialchars($_POST['name'],ENT_QUOTES);
	$email      =htmlspecialchars($_POST['email'],ENT_QUOTES);
	$mobile     =htmlspecialchars($_POST['mobile'],ENT_QUOTES);
        $dob        = htmlspecialchars($_POST['indent_ref_date'],ENT_QUOTES);;
        $doj        =htmlspecialchars($_POST['indent_ref_date1'],ENT_QUOTES);
	$unit       =htmlspecialchars($_POST['unit'],ENT_QUOTES);
	$department =htmlspecialchars($_POST['department'],ENT_QUOTES);
	$desig      =htmlspecialchars($_POST['desig'],ENT_QUOTES);
	$gender     =htmlspecialchars($_POST['gender'],ENT_QUOTES);
        $add1        =htmlspecialchars($_POST['add1'],ENT_QUOTES);
	$add2       =htmlspecialchars($_POST['add2'],ENT_QUOTES);
	$pin        =htmlspecialchars($_POST['pin'],ENT_QUOTES);
	
	
        $unit_user = $_SESSION['UNIT'];
        $dob1 = substr($dob,6,4) . '-' . substr($dob,3,2) . '-' . substr($dob,0,2);
        $doj1 = substr($doj,6,4) . '-' . substr($doj,3,2) . '-' . substr($doj,0,2);
	
        $sql_itm51="SELECT * FROM cstcmis.cstc_master WHERE empno ='" . $empno . "' || card = '" . $card . "'";
        $result_itm51=mysqli_query($cstccon,$sql_itm51);
        if(mysqli_num_rows($result_itm51) > 0){?>
            <script type="text/JavaScript">
     alert("<?php echo "Employee Number Already Exists." ; ?>");
    
     document.location="WBTC_EmployeeMaster.php";

</script> <?php
        }
        
       
        $user_id = $_SESSION['USER_ID'];             

        
        
        //$sql_itm="insert into daily_record_model(op_date,unit,model,ac,veh_out_1st,veh_out_2nd,sch_trip,act_trip,km,km_2nd,hsd,sale_1st,sale_2nd,op_code,ip) values('" . $op_date1 . "','" . $unit . "','" . $model . "','" . $type . "'," . $veh_out_1st . "," . $veh_out_2nd . "," . $sch_trip . "," . $act_trip . "," . $km . "," . $km_2nd . "," . $hsd . "," . $sale_1st . "," . $sale_2nd . ",'" . $user_id . "','" . $_SESSION['IP'] . "')";
       

        
        
        $sql = "insert into cstcmis.cstc_master (empno,card,comp_id,name,email,mobile,dob,doj,unit,department,desig,gender,add1,add2,pin,op_code,ip) "
                . "values('" . $empno . "','" . $card . "','" . $comp_id . "','" . $name . "','" . $email . "','" . $mobile . "','" . $dob1 . "','" . $doj1 . "','" . $unit . "','" . $department . "','" . $desig . "','" . $gender . "','" . $add1 . "','" . $add2 . "','" . $pin .  "','" . $user_id . "','" . $_SESSION['IP'] . "')";
	$result=mysqli_query($cstccon,$sql);?>
        <script language="javascript">
           alert("<?php echo 'Employee Number Added Successfully' ; ?>");
             document.location='WBTC_EmployeeMaster.php';
       </script>
					
								