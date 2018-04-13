

       <?php
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
	include('Connections/cstccon.php');
        
if(isset($_POST['route'])){        
$unit=$_SESSION['UNIT'];
$query_Recordsetitm = "SELECT * FROM stop_master order by STOP_DESC";
$Recordsetitm = mysqli_query($cstccon,$query_Recordsetitm) or die(mysqli_error());
$row_Recordsetitm = mysqli_fetch_assoc($Recordsetitm);


$route=htmlspecialchars($_POST['route'],ENT_QUOTES);
$from_st=htmlspecialchars($_POST['from_st'],ENT_QUOTES);
$to_st=htmlspecialchars($_POST['to_st'],ENT_QUOTES);
$via1=htmlspecialchars($_POST['select3'],ENT_QUOTES);
$via2=htmlspecialchars($_POST['select4'],ENT_QUOTES);
$via3=htmlspecialchars($_POST['select5'],ENT_QUOTES);
$via4=htmlspecialchars($_POST['select6'],ENT_QUOTES);
$via5=htmlspecialchars($_POST['select7'],ENT_QUOTES);
$via6=htmlspecialchars($_POST['select8'],ENT_QUOTES);
$via7=htmlspecialchars($_POST['select9'],ENT_QUOTES);
$via8=htmlspecialchars($_POST['select10'],ENT_QUOTES);
$via9=htmlspecialchars($_POST['select11'],ENT_QUOTES);
$via10=htmlspecialchars($_POST['select12'],ENT_QUOTES);
$via11=htmlspecialchars($_POST['select13'],ENT_QUOTES);
$via12=htmlspecialchars($_POST['select14'],ENT_QUOTES);

$length=htmlspecialchars($_POST['length'],ENT_QUOTES);

$depot1=htmlspecialchars($_POST['depot1'],ENT_QUOTES);
$depot2=htmlspecialchars($_POST['depot2'],ENT_QUOTES);
$depot3=htmlspecialchars($_POST['depot3'],ENT_QUOTES);
$depot4=htmlspecialchars($_POST['depot4'],ENT_QUOTES);

$sql_itm="SELECT * FROM cstcmis.route_master where RT_NO = '" . $route . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

if(mysqli_num_rows($result_itm)>0)
{
echo "no";
}
else
{
    $sql_itm1="insert INTO cstcmis.route_master(RT_NO,FROM_ST,TO_ST,VIA1,VIA2,VIA3,VIA4,VIA5,VIA6,VIA7,VIA8,VIA9,VIA10,VIA11,VIA12,LENGTH,DEPOT1,DEPOT2,DEPOT3,DEPOT4) VALUES('" . $route . "'," . $from_st . "," . $to_st . "," . $via1 . "," . $via2 . "," . $via3 . "," . $via4 . "," . $via5 . "," . $via6 . "," . $via7 . "," . $via8 . "," . $via9 . "," . $via10 . "," . $via11 . "," . $via12 . "," . $length . ",'" . $depot1 . "','" . $depot2 . "','" . $depot3 . "','" . $depot4 . "')"; 
$result_itm1=mysqli_query($cstccon,$sql_itm1);

$sql_itm="update cstcmis.stop_master set via = 'Y' where STOP_CODE = " . $from_st . " or STOP_CODE = " . $to_st . " or STOP_CODE = " . $via1 . " or STOP_CODE = " . $via2 . " or STOP_CODE = " . $via3 . " or STOP_CODE = " . $via4 . " or STOP_CODE = " . $via5 . " or STOP_CODE = " . $via6 . " or STOP_CODE = " . $via7 . " or STOP_CODE = " . $via8 . " or STOP_CODE = " . $via9 . " or STOP_CODE = " . $via10 . " or STOP_CODE = " . $via11 . " or STOP_CODE = " . $via12 ; 
$result_itm=mysqli_query($cstccon,$sql_itm);


}}

?>
        <script language="javascript">
            alert('Record Added Successfuly');
             document.location='WBTC_RouteMaster.php';
       </script>
					
								