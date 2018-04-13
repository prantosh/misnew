<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');

	
//$sql1="insert into DEB(TET) VALUES('C')";
//$result1=mysqli_query($cstccon,$sql1);
//$my_array = array();
//$my_array = array();
//if(issset($_SESSION['emp_record'])){	
//unset($_SESSION['emp_record']);}
//get the posted values
//$no_of_item=htmlspecialchars($_POST['no_of_item'],ENT_QUOTES);
$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$_SESSION['folio_no'] = $folio_no;
$qty=htmlspecialchars($_POST['qty'],ENT_QUOTES);

$unit = $_POST['unit_to_new'];
$sql_itm="DELETE FROM item_issue WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);



$sql_itm="SELECT * FROM depot_disp1 WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
$row_itm=mysqli_fetch_array($result_itm);

if($qty <= $row_itm['CS_STK']){

$sql_itmtot="select count(*) tot FROM item_issue";
$result_itmtot=mysqli_query($cstccon,$sql_itmtot);
$row_itmtot=mysqli_fetch_array($result_itmtot);    
    
//if($row_itmtot['tot'] <= 16){    
//$sql_itm="INSERT INTO item_issue(PART_NO,QTY,UNIT) VALUES('" . $folio_no . "'," . $qty . ",'" . $unit . "')";
//$result_itm=mysqli_query($cstccon,$sql_itm);
//}
//$row_itm=mysqli_fetch_array($result_itm);
//$row_itm=mysqli_fetch_array($result_itm);
       //echo $_session['folio_no'];
       //$row_itm=mysqli_fetch_array($result_itm);
//$row_itm=mysqli_fetch_array($result_itm);
       //echo $_session['folio_no'];
echo "<style type='text/css'>";
echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black}";
echo "table.alternate tr:nth-child(even) {background-color: #5aa6ed;}";

echo "</style>";



       //echo "yes"; 
       $sql_itm="SELECT A.PART_NO,A.QTY,B.ITM_NM FROM item_issue A, itm B where A.PART_NO = B.PART_NO";
        $result_itm=mysqli_query($cstccon,$sql_itm);
        $row_itm=mysqli_fetch_array($result_itm);
        //echo "<p>";
        //echo"ITEM ISSUED SUCCESSFULLY";
        //echo "</p>";
        //
        //
        //
        //
        echo "ITEMS TO BE ISSUED";
       echo "<table valign='top' style='margin: 0; padding: 0; border-collapse: collapse; color: White; width: 100%; height: 20px; text-align: left; background-color: Blue;'>";
                echo "<colgroup>";
                echo "<col width='12%'/><col width='20%'/><col width='54%'/><col width='14%'/>";
                echo "</colgroup>";
                echo "<tbody>";
                echo "    <tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>SRL</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>FOLIO NOL</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>QTY</th>";
                        
               echo "     </tr>";
              echo "  </tbody>";
           echo " </table>";

        
       
          echo "      <table valign='top' id='tblMain' class='alternate' width: 100%; style='margin: 0; padding: 0; border-collapse: collapse; width: 100%; height: 200px;'>";
         echo "       <colgroup>";
                echo "<col width='12%'/><col width='20%'/><col width='54%'/><col width='14%'/>";
          echo "      </colgroup>";
          echo "      <tbody style='margin: 0; padding: 0; border-collapse: collapse;'>";
                                
                                $query =  "SELECT * FROM depot_disp1 order by PART_NO";
                                //$query =  "SELECT TO_NUMBER(FIN_YR) FIN_YR1, OPNG_QTY, RCT_QTY,ISS_QTY,LRCT_DT,LISS_DT,LISS_RT FROM bincrd WHERE PART_NO = '" & $folio_no & "' ORDER BY TO_NUMBER(FIN_YR) DESC";
                                $i = 1;                       
                                $result = mysqli_query($cstccon,$query) or die(mysqli_error());
                                $x = 1;
                    do{
                                
                                    echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        echo "<td>" . $row_itm['PART_NO'] . "</td>";
                        echo "<td>" . $row_itm['ITM_NM'] . "</td>";
                        echo "<td>" . $row_itm['QTY'] . "</td>";
                    echo "</tr>";
                    $x = $x + 1;
                    } while ($row_itm = mysqli_fetch_assoc($result_itm));
                                           
    
            echo "        </tbody>";
            echo "        </table>";
          echo "  </div>";
          echo "  </div>";
        //***********************************************************
        
         
        
}
else{
    
    echo "<style type='text/css'>";
    echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black}";
    echo "table.alternate tr:nth-child(even) {background-color: #5aa6ed;}";

    echo "</style>";



       //echo "yes"; 
       $sql_itm="SELECT A.PART_NO,A.QTY,B.ITM_NM FROM item_issue A, itm B where A.PART_NO = B.PART_NO";
        $result_itm=mysqli_query($cstccon,$sql_itm);
        $row_itm=mysqli_fetch_array($result_itm);
        echo "<p>";
        echo"Sorry. Issue Quantity is Greater than Stock";
        echo "</p>";
        echo "<p>";
        echo "FOLLOWING ITEMS WILL BE ISSUED";
        echo "</p>";
        echo "<div style='margin: 0; padding: 0; border-collapse: collapse; width: 100%; height: 100px; overflow: hidden; border: 1px solid black;'>";

        echo "<table style='margin: 0; padding: 0; border-collapse: collapse; color: White; width: 100%; height: 5px; text-align: left; background-color: Blue;'>";
                echo "<colgroup>";
                echo "<col width='12%'/><col width='20%'/><col width='54%'/><col width='14%'/>";
                echo "</colgroup>";
                echo "<tbody>";
                    echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>SRL</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>FOLIO NOL</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>QTY</th>";
                    echo "</tr>";
                echo "</tbody>";
         echo "</table>";   
         
         echo "<table class = 'alternate'; style='margin: 0; padding: 0; border-collapse: collapse; color: White; width: 100%; height: 5px; text-align: left; background-color: Blue;'>";
                echo "<colgroup>";
                echo "<col width='12%'/><col width='20%'/><col width='54%'/><col width='14%'/>";
                echo "</colgroup>";
                echo "<tbody>";
                $x = 1;
                    do{
                    echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        echo "<td>" . $row_itm['PART_NO'] . "</td>";
                        echo "<td>" . $row_itm['ITM_NM'] . "</td>";
                        echo "<td>" . $row_itm['QTY'] . "</td>";
                    echo "</tr>";
                    $x = $x + 1;
                    } while ($row_itm = mysqli_fetch_assoc($result_itm));
                echo "</tbody>";
         echo "</table>";
         echo "</div>";
         echo "<a href='CSTC_create_IssueSlip.php'>PRINT</a>"; 
}
       
       
	
}

?>
