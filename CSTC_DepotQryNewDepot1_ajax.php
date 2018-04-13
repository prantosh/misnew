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

$vehno1=htmlspecialchars($_POST['vehno_xx_1'],ENT_QUOTES);
//echo $vehno1;

$_SESSION['folio_no'] = $folio_no;
$qty=htmlspecialchars($_POST['qty_to_issue_veh'],ENT_QUOTES);
//echo $vehno ;

//now validating the PF A/C NO
//$sql_itm="DELETE FROM item_issue_veh WHERE PART_NO = '" . $folio_no . "' and vehno = '" . $vehno . "'";
//$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmz="DELETE FROM item_issue_veh WHERE QTY = 0";
$result_itmz=mysqli_query($cstccon,$sql_itmz);

$sql_itmzx="DELETE FROM item_issue_veh WHERE PART_NO = '" . $folio_no . "' and DEPOT = '" . $unit . "'  and vehno = '" . $vehno1 . "'";
$result_itmzx=mysqli_query($cstccon,$sql_itmzx);
//*****************************************************
$sql_itm="SELECT * FROM bincrd_depot WHERE DEPOT = '" . $unit . "' and PART_NO = '" . $folio_no . "' and FIN_YR = '" . $CUR_FIN_YR . "'";
//$sql_itm="SELECT * FROM depot_disp1 WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result_itm) > 0){
$row_itm=mysqli_fetch_array($result_itm);
$stock = $row_itm['OPNG_QTY'] + $row_itm['RCT_QTY'] - $row_itm['ISS_QTY'] ;
if($qty <= $stock){

//$sql_itmtot="select count(*) tot FROM item_issue_veh";
//$result_itmtot=mysqli_query($cstccon,$sql_itmtot);
//$row_itmtot=mysqli_fetch_array($result_itmtot);   

//echo '*' . $unit . '*' . $folio_no . '*' . $CUR_FIN_YR;


$sql_itmZ1="SELECT a.PART_NO,SUM(a.ITM_QTY) TOT_ITEM_QTY FROM bintxnitm_depot a,bintxn_depot b where b.PRTY_CD = '$unit' and a.PART_NO = '$folio_no' and  a.BNTXN_ID = b.BNTXN_ID AND b.FIN_YR = '$CUR_FIN_YR' group by a.PART_NO";
$result_itmZ1=mysqli_query($cstccon,$sql_itmZ1);
if(mysqli_num_rows($result_itmZ1) > 0){
$row_itmZ1=mysqli_fetch_array($result_itmZ1);
$ytd_issue = $row_itmZ1['TOT_ITEM_QTY'] ;
}
else{
    $ytd_issue = 0;
}
    
//if($row_itmtot['tot'] <= 14){    
$sql_itm="INSERT INTO item_issue_veh(DOC_DT,DEPOT,PART_NO,QTY,vehno,ytd_issue,stock) VALUES('" . $issue_date3 . "','" . $unit . "','" . $folio_no . "'," . $qty . ",'" . $vehno1 . "'," . $ytd_issue . "," . $stock . ")";
$result_itm=mysqli_query($cstccon,$sql_itm);
//}

echo "<style type='text/css'>";
//echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black;}";
//echo "table.alternate tr:nth-child(even) {background-color: grey;color:white;}";

echo "</style>";

       $sql_itm="SELECT A.vehno vehno1,C.ALT_NO_3,A.PART_NO,A.QTY,A.ytd_issue,A.stock,B.ITM_NM,B.ALT_NO,B.ALT_NO_2,B.UOM_ID FROM item_issue_veh A, itm B,current_part_no C where A.PART_NO = C.PART_NO and A.PART_NO = B.PART_NO AND A.DEPOT = '" . $unit . "'";
        $result_itm=mysqli_query($cstccon,$sql_itm);
        $row_itm=mysqli_fetch_array($result_itm);
       

echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
        echo "<tbody>";
                        echo "<tr style='color:white;background-color:green;margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th style='color:black;'colspan='9'>FOLLOWING ITEMS WILL BE ISSUED</th>";
                        echo "</tr>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th align='center'>SRL</th>";
                        echo "<th align='center'>ISSUED FOR</th>";
                        echo "<th align='center'>FOLIO NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>UOM</th>";
                      //  echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>INDENT QTY</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>YTD ISSUED</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>STOCK</th>";
                       // echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PENDING PO</th>";
                       // echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PENDING PR</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>QTY</th>";
                        echo "</tr>";
              
                                
                               
                                $i = 1;                       
                               
                                $x = 1;
                    do{
                                
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        echo "<td>" . $row_itm['vehno1'] . "</td>";
                        echo "<td>" . $row_itm['PART_NO'] . "</td>";
                        echo "<td>" . $row_itm['ALT_NO_3'] ."</td>";
                        echo "<td>" . $row_itm['ITM_NM'] . "</td>";
                        echo "<td>" . $row_itm['UOM_ID'] . "</td>";
                        
                        $part_no = $row_itm['PART_NO'];
                        
                        echo "<td align='right'>" ;
                        if($row_itm['ytd_issue'] != 0){echo  -$row_itm['ytd_issue'];} 
                        echo "</td>";

                        
                        echo "<td align='right'>" . $row_itm['stock'] . "</td>";
                     
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
else{
    echo "<p>";
        echo"Sorry. Invalid Folio Number";
        echo "</p>";
}
	
}

?>
