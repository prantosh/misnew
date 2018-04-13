<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');


$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$unit = htmlspecialchars($_POST['unit_to_new'],ENT_QUOTES);



$sql_itm="SELECT A.PART_NO,A.ALT_NO,A.ALT_NO_2,A.UOM_ID,A.ITM_NM,B.ISS_QTY,C.ALT_NO_3 FROM itm A, bincrd B,current_part_no C where A.PART_NO = C.PART_NO AND A.PART_NO = '" . $folio_no . "' and A.PART_NO = B.PART_NO";
$result_itm=mysqli_query($cstccon,$sql_itm);
$row_itm =mysqli_fetch_array($result_itm);
        if($row_itm['PART_NO'] == $folio_no)
{
    
    $sql_itm1="SELECT OPNG_QTY,ISS_QTY,RCT_QTY from bincrd where FIN_YR = '$CUR_FIN_YR' AND PART_NO = '" . $folio_no . "'";
    $result_itm1=mysqli_query($cstccon,$sql_itm1);
    $row_itm1 =mysqli_fetch_array($result_itm1);
   
 
echo "<p></p>";?>
<table width="80%" align ="center">
    <tr>
        <td align ="center">
<?php
//echo '<table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners"style="color:red">';
//echo '<table  id="tbl_id" cellpadding="0" cellspacing="0" border="0"  class="TFtable">';
echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';


echo "<tr>";
echo "<th >";
echo "FOLIO NO";
echo "</th>";
echo "<th >";
echo "PART NO";
echo "</th>";
echo "<th >";
echo "DESCRIPTION";
echo "</th>";
echo "<th >";
echo "UOM" ;
echo "</th>";
echo "<th >";
echo "STOCK" ;
echo "</th>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<font style = 'color:black;;'>" . $row_itm['PART_NO'] . "</font>";
echo "</td>";
echo "<td>";
echo "<font style = 'color:black;;'>" . $row_itm['ALT_NO_3']  . "</font>";
echo "</td>";
echo "<td >";
echo "<font style = 'color:black;;'>" . $row_itm['ITM_NM'] . "</font>";
echo "</td>";
echo "<td >";
echo "<font style = 'color:black;;'>" . $row_itm['UOM_ID'] . "</font>"  ;
echo "</td>";
echo "<td>";
echo "<font style = 'color:black;;'>" . ($row_itm1['OPNG_QTY'] + $row_itm1['RCT_QTY'] - $row_itm1['ISS_QTY']) . "</font>";
echo "</tr>";


echo "</table>";    
echo "<p></p>";
// ***************************************************************************
?>
<!-- *************************************************************8 -->           
            
            
            
            
            
            
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-warning172">
                Show Depot Wise Issue
              </button>
 <div class="modal modal-warning fade" id="modal-warning172" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
              <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Depot-Wise Issue </span></h4>
                            </div>
              <div class="modal-body"> <?php
                  $sql_itm = "select A.PRTY_CD,SUM(B.ITM_QTY) TOT_QTY FROM bintxn A,bintxnitm B WHERE A.BNTXN_ID = B.BNTXN_ID AND  B.PART_NO = '" . $folio_no . "' group by A.PRTY_CD HAVING SUM(B.ITM_QTY) < 0 ORDER BY A.PRTY_CD";
$result_itm=mysqli_query($cstccon,$sql_itm);

if(mysqli_num_rows($result_itm)>0)
{
   // $row_itm =mysqli_fetch_array($result_itm);
    echo "<p></p>";
    echo "<font style = 'color:black;;'>" . "DEPOTWISE ISSUE FOR : " . $folio_no . "</font>";;
echo "<p></p>";
echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
echo "<tr>";

while ($row_itm = mysqli_fetch_assoc($result_itm)){
    
                echo "<td >"; 
                
                echo  $row_itm['PRTY_CD'] . " : " ;
              
                echo "<font style = 'color:black;;'>" . abs($row_itm['TOT_QTY'])  . "</font>";
                echo "</td>";
               
 
} 

echo "</tr>";
echo "</table>";  

?>
              </div>
              <div class="modal-footer"style="color:white ;background-color:#a8a646;">
                                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<!--- *************************************************** -->            
<?php } ?>            
            
 <!-- *************************************************************8 -->           
            
            
            
            
            
            
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-warning173">
                Show Depot Wise Indent
              </button>
 <div class="modal modal-warning fade" id="modal-warning173" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
              <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Depot-Wise Indent </span></h4>
                            </div>
              <div class="modal-body">
                  <?php
               $sql_itmi = "select A.CC_ID,SUM(B.REQ_QTY) TOT_QTY FROM indnt A,indntitm B WHERE A.INDNT_ID = B.INDNT_ID AND  B.PART_NO = '" . $folio_no . "' group by A.CC_ID ORDER BY A.CC_ID";
$result_itmi=mysqli_query($cstccon,$sql_itmi);

if(mysqli_num_rows($result_itmi)>0)
{
  //  $row_itmi =mysqli_fetch_array($result_itmi);
    echo "<p></p>";
    echo "<font style = 'color:black;;'>" . "DEPOTWISE INDENT FOR : " . $folio_no . "</font>";;
echo "<p></p>";
echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
echo "<tr>";

while ($row_itmi = mysqli_fetch_assoc($result_itmi))
{
                echo "<td >"; 
                
                echo  $row_itmi['CC_ID'] . " : " ;
              
                echo "<font style = 'color:black;;'>" . abs($row_itmi['TOT_QTY'])  . "</font>";
                echo "</td>";
               
 
}

echo "</tr>";
echo "</table>";    
?>
              </div>
              <div class="modal-footer"style="color:white ;background-color:#a8a646;">
                                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<?php }?>
<!--- *************************************************** ok -->


           
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-warning174">
                Show Date Wise Issue
              </button>
 <div class="modal modal-warning fade" id="modal-warning174" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Date-Wise Issue </span></h4>
                            </div>
              
              <div class="modal-body"> <?php
                  echo "<table  width = '100%'>";
echo "<tr>";
echo "<td width = '100%'align='center'>";
        echo "<font style = 'color:black;;'>" . "DATEWISE INDENT DETAILS " . "</font>";;
echo "</td>";

echo "</tr>";
echo "</table>";
        
        
        echo "<p></p>";

//$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);iiiiI
//$unit = htmlspecialchars($_POST['unit'],ENT_QUOTES);?>
            <table width = '100%'>
                <tr>
                    <td width = '45%'>
                                    <div id="msgboxshowOLD" valign="top">
<?php
$sql_itm="SELECT distinct A.CREDT,A.REQ_QTY FROM indntitm A,indnt B where A.PART_NO = '" . $folio_no . "' and A.INDNT_ID = B.INDNT_ID AND B.CC_ID = '" . $unit . "' ORDER BY A.CREDT DESC";
$result_itm=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result_itm)>0){
//$row_itm =mysqli_fetch_array($result_itm);


    

//echo '<table class"TFtable" width="80%"id="table1" cellpadding="0" cellspacing="0" border="0"  id="example"class="rounded-corners"style="color:red"width="50%">';
echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';


$X =1;
 while ($row_itm = mysqli_fetch_assoc($result_itm)){
    echo "<tr>";
                echo "<td >"; 
                
                echo "<font style = 'color:black;;'>" . date('d-m-Y',strtotime($row_itm['CREDT'])) . "</font>";
                echo "</td>";
               
                echo "<td >"; 
                
                echo "<font style = 'color:black;;'>" . abs($row_itm['REQ_QTY']) . "</font>";
                echo "</td>";
               
    echo "</tr>";
  
    
    
    $X = $X + 1;
 
}  

//echo "</tr>";
echo "</table>";   } ?>
              </div>
              <div class="modal-footer"style="color:white ;background-color:#a8a646;">
                                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<!--- *************************************************** -->            
<?php

echo "<table  width = '100%'>";
echo "<tr>";

echo "<td width = '100%'align='center'>";
        echo "<font style = 'color:black;;'>" . "DATEWISE ISSUE DETAILS " . "</font>";;
echo "</td>";
echo "</tr>";
echo "</table>";
        
        
        echo "<p></p>";

//$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);iiiiI
//$unit = htmlspecialchars($_POST['unit'],ENT_QUOTES);?>
            
                                    <div id="msgboxshowNEW"">
<?php
$sql_itm="SELECT distinct A.CREDT,A.ITM_QTY FROM bintxnitm A,bintxn B where A.PART_NO = '" . $folio_no . "' and A.BNTXN_ID = B.BNTXN_ID AND B.PRTY_CD = '" . $unit . "' and A.ITM_QTY < 0   ORDER BY A.CREDT DESC";
$result_itm=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result_itm)>0){
//$row_itm =mysqli_fetch_array($result_itm);



//echo '<table class"TFtable" width="80%"id="table1" cellpadding="0" cellspacing="0" border="0"  id="example"class="rounded-corners"style="color:red"width="50%">';
echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';


$X =1;
 while ($row_itm = mysqli_fetch_assoc($result_itm)){
    //echo "<tbody style='display:block;'>";
    echo "<tr>";
                echo "<td >"; 
                
                echo "<font style = 'color:black;;'>" . date('d-m-Y',strtotime($row_itm['CREDT'])) . "</font>";
                echo "</td>";
               
                echo "<td >"; 
                
                echo "<font style = 'color:black;;'>" . abs($row_itm['ITM_QTY']) . "</font>";
                echo "</td>";
               
    echo "</tr>";
  //echo "</tbody>";
    
    
    $X = $X + 1;
 
}  

//echo "</tr>";
echo "</table>";    
?>
                                        
 </div> 
                    </td>
                </tr>
            </table>
                                           
<?php    

        
}

//$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
//$unit = htmlspecialchars($_POST['unit'],ENT_QUOTES);


  
                                           
// below ok    

        
}



                            
    
?>
        </td>
    </tr>
</table>
<?php
        
}


?>
