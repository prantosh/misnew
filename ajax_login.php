<?php 
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
session_cache_expire(30);
$cache_expire = session_cache_expire();
//ob_start ();

session_start();
session_destroy();
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

//$user_name = htmlspecialchars($_POST['user_name'],ENT_QUOTES); 



// clean user inputs to prevent sql injections
$user_name = trim($_POST['user_name']);
$user_name = strip_tags($user_name);
$user_name = htmlspecialchars($user_name);

$txt_password = trim($_POST['password']);
$txt_password = strip_tags($txt_password);
$txt_password = htmlspecialchars($txt_password);


$password=sha1(md5(md5($txt_password)));

$sql="SELECT * FROM cstcmis.cstc_user WHERE UNAME='" . $user_name . "' and PWD = '" . $password . "' and  CURRENT_STATUS = 'A'";

$result=mysqli_query($cstccon,$sql);

$row=mysqli_fetch_array($result);


if(mysqli_num_rows($result) <= 0)
{ echo 'yes';}
else
{

		
		$_SESSION['UNAME']=$user_name; 
		$_SESSION['USER_ID']=$row['USER_ID']; 
                if($_SESSION['USER_ID'] == 0){
                    header("Location: mms.cstc.org.in");
                }
		$_SESSION['UNIT']=$row['UNIT'];
                $_SESSION['USER_NAME']=$row['NAME'];
                $_SESSION['EMAIL']=$row['EMAIL'];
                
                
                
$query_Recordsetunit = "SELECT *  FROM cstcmis.unit where UNIT = '" . $_SESSION['UNIT'] . "'";
$Recordsetunit = mysqli_query($cstccon,$query_Recordsetunit) or die(mysqli_error());
$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);
$unit_desc = $row_Recordsetunit['UNIT_DESC'];
              
                $_SESSION['UNIT_DESC']=$unit_desc;
		$_SESSION['ROLE']=$row['ROLE'];
                $_SESSION['UNIT_CODE']=$row_Recordsetunit['UNIT_CODE'];
		
		$_SESSION['STATUS'] = $row['CURRENT_STATUS'];
   		$_SESSION['IP']=$_SERVER['REMOTE_ADDR'];
 
                $sqlb="SELECT * from ctrl";
		$resultb=mysqli_query($cstccon,$sqlb);
		$rowb=mysqli_fetch_array($resultb);
                $_SESSION['CUR_FIN_YR'] = $rowb['CUR_FIN_YR'];
                $_SESSION['PREV_FIN_YR'] = $rowb['PREV_FIN_YR'];
//ADDTIME('2008-05-15 13:20:32.50','2 1:39:27.50') as required_datetime;  
                
		$sqla="SELECT ADDTIME(LOGIN_TIME,'0 12:30:00.00') xx FROM cstcmis.prev_login WHERE USER_ID = " . $_SESSION['USER_ID'];
		$resulta=mysqli_query($cstccon,$sqla);
		$rowa=mysqli_fetch_array($resulta);
		$_SESSION['LAST_LOGIN_PREV'] = $rowa['xx'];

		$sql2="delete from cstcmis.last_login WHERE USER_ID =".$_SESSION['USER_ID']; 
		$result2=mysqli_query($cstccon,$sql2);
		
		$sql1="INSERT INTO cstcmis.last_login(USER_ID,IP_ADDRESS) VALUES(". $_SESSION['USER_ID'] . ",'" . $_SERVER['REMOTE_ADDR'] . "')";
		$result1=mysqli_query($cstccon,$sql1);
              
                //$sql2="delete from prev_login WHERE USER_ID =".$_SESSION['USER_ID']; 
		//$result2=mysqli_query($cstccon,$sql2);
                
                $sql1="INSERT INTO cstcmis.prev_login(USER_ID,IP_ADDRESS,LOGIN_TIME) VALUES(". $_SESSION['USER_ID'] . ",'" . $_SERVER['REMOTE_ADDR'] . "',DATE_ADD( now( ) , INTERVAL  '12:30' HOUR_MINUTE ))";
		$result1=mysqli_query($cstccon,$sql1);
                
                
                $_SESSION['advnc_no']   = '';
                $_SESSION['po_no']      = '';  
                $_SESSION['folio_no']   = '';  
		//echo $_SESSION['UNIT'];
                echo "no";
                //echo $password;
	}
	


?>
