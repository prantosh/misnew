<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$unit = $_SESSION['UNIT'] ;
$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$issue_date=htmlspecialchars($_POST['issue_date2'],ENT_QUOTES);
$issue_date3 = substr($issue_date,6,4) . '-' . substr($issue_date,3,2) . '-' . substr($issue_date,0,2);
//echo '**' . $_POST['unit_to_iss1'];
$unit_to_iss=htmlspecialchars($_POST['unit_to_iss1'],ENT_QUOTES);
$_SESSION['folio_no'] = $folio_no;
$qty_to_other_unit=htmlspecialchars($_POST['qty_to_other_unit'],ENT_QUOTES);
//echo $vehno ;
$query = "SELECT * from unit WHERE UNIT = '" . $unit_to_iss . "'";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
$unit_to_iss_desc = $row['UNIT_DESC'];
//now validating the PF A/C NO
$sql_itm="DELETE FROM item_issue_to_other_depot WHERE PART_NO = '" . $folio_no . "' and UNIT_FROM = '" . $unit . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmz="DELETE FROM item_issue_veh_to_other_depot WHERE QTY = 0";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
//*****************************************************
$sql_itm="SELECT * FROM bincrd_depot WHERE DEPOT = '" . $unit . "' and PART_NO = '" . $folio_no . "' and FIN_YR = '" . $CUR_FIN_YR . "'";
//$sql_itm="SELECT * FROM depot_disp1 WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
$row_itm=mysqli_fetch_array($result_itm);
$stock = $row_itm['OPNG_QTY'] + $row_itm['RCT_QTY'] - $row_itm['ISS_QTY'] ;
if($qty_to_other_unit <= $stock){

$sql_itmtot="select * FROM item_issue_to_other_unit where UNIT_FROM = '" . $unit . "'";
$result_itmtot=mysqli_query($cstccon,$sql_itmtot);
if(mysqli_num_rows($result_itmtot) > 0){
$row_itmtot=mysqli_fetch_array($result_itmtot);   
$xx = $row_itmtot;}
else { $xx = 0 ; }


$sql_itmZ1="SELECT a.PART_NO,SUM(a.ITM_QTY) TOT_ITEM_QTY FROM bintxnitm_depot a,bintxn_depot b where b.PRTY_CD = '$unit' and a.PART_NO = '$folio_no' and  a.BNTXN_ID = b.BNTXN_ID AND b.FIN_YR = '$CUR_FIN_YR' group by a.PART_NO";
$result_itmZ1=mysqli_query($cstccon,$sql_itmZ1);
if(mysqli_num_rows($result_itmZ1) > 0){
$row_itmZ1=mysqli_fetch_array($result_itmZ1);
$ytd_issue = $row_itmZ1['TOT_ITEM_QTY'] ;
}
else{
    $ytd_issue = 0;
}
//************************************************    
if ($xx <= 14){   
   // echo '*' . $unit_to ; 
$sql_itm="INSERT INTO item_issue_to_other_unit(DOC_DT,UNIT_FROM,UNIT_TO,PART_NO,QTY) VALUES('" . $issue_date3 . "','" . $unit . "','" . $unit_to_iss . "','" . $folio_no . "'," . $qty_to_other_unit . ")";
$result_itm=mysqli_query($cstccon,$sql_itm);
}

echo "<style type='text/css'>";
//echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black;}";
//echo "table.alternate tr:nth-child(even) {background-color: grey;color:white;}";

echo "</style>";

       $sql_itm="SELECT A.PART_NO,C.ALT_NO_3,A.QTY,B.ITM_NM,B.ALT_NO,B.ALT_NO_2,B.UOM_ID,A.UNIT_FROM UNIT_FROM1,A.UNIT_TO UNIT_TO1 FROM item_issue_to_other_unit A, itm B,current_part_no C where A.PART_NO = B.PART_NO and A.PART_NO = C.PART_NO and A.UNIT_FROM = '" . $unit . "'";
        $result_itm=mysqli_query($cstccon,$sql_itm);
        $row_itm=mysqli_fetch_array($result_itm);
       
        echo "<H6><font color='black'>FOLLOWING ITEMS WILL BE ISSUED TO " . $unit_to_iss_desc .  "</font></H6>";
echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';

        echo "<tbody>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th align='center'>SRL</th>";
                        echo "<th align='center'>FOLIO NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>UOM</th>";
                      //  echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>INDENT QTY</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>ISSUE FROM</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>ISSUE TO</th>";
                       // echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PENDING PO</th>";
                       // echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PENDING PR</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>QTY</th>";
                        echo "</tr>";
              
                                
                               
                                $i = 1;                       
                               
                                $x = 1;
                    do{
                                
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        echo "<td>" . $row_itm['PART_NO'] . "</td>";
                        echo "<td>" . $row_itm['ALT_NO_3'] ."</td>";
                        echo "<td>" . $row_itm['ITM_NM'] . "</td>";
                        echo "<td>" . $row_itm['UOM_ID'] . "</td>";
                        
                        $part_no = $row_itm['PART_NO'];

                        echo "<td align='right'>" . $row_itm['UNIT_FROM1'] . "</td>";
                        
           
                        
                        
                        echo "<td align='right'>" . $row_itm['UNIT_TO1'] . "</td>";
                      
                        echo "<td align='right'>" . $row_itm['QTY'] . "</td>";
                        echo "</tr>";
                          $x = $x + 1;
                          } while ($row_itm = mysqli_fetch_assoc($result_itm));
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";

        
}
else{
    echo "<p>";
        echo"Sorry. Issue Quantity is Greater than Stock";
        echo "</p>";
    
       
}
       
       
	
}

?>
