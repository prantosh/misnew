<?php error_reporting(E_ERROR|E_WARNING);
require_once('Connections/cstccon.php');
session_start();
$vehno=htmlspecialchars($_POST['vehno'],ENT_QUOTES);
 
$cur_stat=htmlspecialchars($_POST['cur_stat'],ENT_QUOTES);



$runfleet=htmlspecialchars($_POST['runfleet'],ENT_QUOTES);
$loc_id=htmlspecialchars($_POST['loc_id'],ENT_QUOTES);
$macid=htmlspecialchars($_POST['macid'],ENT_QUOTES);




$sql_itm2="update cstcmis.veh0214 set cur_stat = '" . $cur_stat . "',runfleet = '" . $runfleet . "',loc_id = '" . $loc_id . "',macid = '" . $macid . "',op_code = '" . $_SESSION['USER_ID'] . "',upd_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:00' HOUR_MINUTE),'%Y-%m-%d') , ip = '" . $_SESSION['IP'] . "' where vehno = '" . $vehno . "'"; 
$result_itm2=mysqli_query($cstccon,$sql_itm2);
								
					
?> 
    <script language="javascript">
            alert('Record Updated Successfully');
             document.location='WBTC_VehicleStatus.php';
       </script>
<?php
//header("Location:MIS_DailyEntryTrafficDisp.php");	

					
								
								?>
								</center>
								</center>

								</div>
								</div>
								</div>
								
								</div>
								</div>
								</div>
								</div>
								</div>
      </td>
      </tr>
    </table>
    <?php include "WBTC_footer.php" ; ?> 
</body>
</html>
								