<?php
ob_start ();
require_once('Connections/cstccon.php');
require_once('number2word.php');
session_start();

$cur_fin_yr = $_SESSION['CUR_FIN_YR'];

$v_no_add = $_GET['q'];


$sql3S = "select * from item_issue";
$result3S=mysqli_query($cstccon,$sql3S);
if(mysqli_num_rows($result3S) > 0){
    $row3S = mysqli_fetch_array($result3S);
//$v_no_add=htmlspecialchars($_POST['v_no_add1'],ENT_QUOTES);
$unit_to    		= $row3S['UNIT'];
$unit_from    		= $row3S['UNIT_FROM'];

$user_id = $_SESSION['USER_ID'];
$remark = $_SESSION['remark'];

//$unit_from    		= $_SESSION['unit_from'];
//$cur_fin_yr             = $_SESSION['CUR_FIN_YR'];

if($v_no_add != ''){
    
    $v_no_org = $v_no_add ;
    
    
  //  **************************************************************
    $sql3Si = "insert into item_issue (PART_NO,QTY,old_voucher) select PART_NO,-ITM_QTY,'Y' from bintxnitm where BNTXN_ID = '" . $v_no_add . "'";
    $result3Si=mysqli_query($cstccon,$sql3Si);
    $remark1 = 'This is a modified Voucher. Item(s) has been added to the original voucher of this voucher number';

    $sql3Sir = "select RMK from bintxn where BNTXN_ID = '" . $v_no_add . "'";
    $result3Sir=mysqli_query($cstccon,$sql3Sir);
    $row3Sir = mysqli_fetch_array($result3Sir);
    $remark = $row3Sir['RMK'];
    if(strlen($v_no_add) == 10) {  
    if(substr($v_no_add,9,1) == 'C'){$v_no_add = substr($v_no_add,0,9) . 'D'; }
    if(substr($v_no_add,9,1) == 'B'){$v_no_add = substr($v_no_add,0,9) . 'C'; }
    if(substr($v_no_add,9,1) == 'A'){$v_no_add = substr($v_no_add,0,9) . 'B'; }}
    if(strlen($v_no_add) == 9){$v_no_add = $v_no_add . 'A'; }
    
    $sql49u = "update bintxn set BNTXN_ID = '" . $v_no_add . "' where BNTXN_ID = '" . $v_no_org .  "'";
   $result49u=mysqli_query($cstccon,$sql49u);
   
   $sql49u1 = "update bintxnitm set BNTXN_ID = '" . $v_no_add . "' where BNTXN_ID = '" . $v_no_org .  "'";
   $result49u1=mysqli_query($cstccon,$sql49u1);
}

//$unit_from    		= $_SESSION['unit_from'];
//$bill_no 		= htmlspecialchars($_POST['bill_no'],ENT_QUOTES);

//require_once('Numbers/Words.php');


$sql11 = "select * from unit where UNIT = '" . $unit_to . "'";
$result11=mysqli_query($cstccon,$sql11);
$row11 = mysqli_fetch_array($result11);
$unit_desc = $row11['UNIT_DESC'];
$unit_code = $row11['UNIT_CODE'];

$sql12 = "select * from unit where UNIT = '" . $unit_from . "'";
$result12=mysqli_query($cstccon,$sql12);
$row12 = mysqli_fetch_array($result12);
$unit_from_desc = $row12['UNIT_DESC'];
$unit_from_code = $row12['UNIT_CODE'];



if($v_no_add == ''){
$sql1 = "select max(substring(BNTXN_ID,6,4)) MAX_ID FROM bintxn where FIN_YR = '" . $cur_fin_yr . "' and substring(BNTXN_ID,5,1) IN ('I','R')";
$result1=mysqli_query($cstccon,$sql1);

if(mysqli_num_rows($result1) > 0){
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;}
else { $new_number = 1;}
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}
if($unit_to != ''){
$v_no = $unit_from_code . $cur_fin_yr . $unit_code . 'I' . $new_number;
//md_time = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d-%T')
$sql4 = "insert into bintxn(BNTXN_ID,FIN_YR,CLS,DOC_DT,PRTY_CD,RMK,CREUSR,CREDT) VALUES('" . $v_no . "','$cur_fin_yr','MI',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'),'" . $unit_to . "','" . $remark . "','" . $_SESSION['UNAME'] . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'))";
$result4=mysqli_query($cstccon,$sql4);

$sql49 = "insert into bntxn_id_create_datetime(BNTXN_ID) VALUES('" . $v_no . "')";
$result49=mysqli_query($cstccon,$sql49);

}}
else{
   $v_no = $v_no_add ; 
   
}
//echo $new_number ;
?>
<script type="text/JavaScript">
     alert("<?php echo $cur_fin_yr ; ?>");
    
     

</script>   
<?php
$sql3 = "select * from item_issue A,itm B where A.PART_NO = B.PART_NO";
$result3=mysqli_query($cstccon,$sql3);

require('fpdf.php');

class PDF extends FPDF
{
       protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';
// Page header
function Header()

{global $unit;
global $unit_from;
global $user_id;
global $v_no; 
global $v_no_add; 
global $unit_desc;
global $iss_val_tot;
global $date;
global $old_voucher;
global $time;
global $remark1;
global $remark;
global $unit_to ;
 
$date =  date("F j, Y");
$time = date("H:i:s", strtotime('+210 minutes')); 

    $y = 0.3;
    
    $this->SetFont('Arial','',11);
    $this->Rect(.2,0.1,11.5,14.5);
    
    $y = $y + .3; 
    $image1 = "images/cstclogo.jpg";
    $this->setXY(1.0, $y);
    $this->Cell( 0,0, $this->Image($image1, 1.0,0.15, 0.8), 0, 0, 'L', false );
    $this->setXY(4.0, $y);
    $this->SetFont('Arial','B',16);
    $this->Cell(0,0,"               MATERIAL ISSUE VOUCHER                                   " );
    $this->setXY(9.9, $y);
    //$this->Cell(0,0,substr($mmyy,0,2) . "/" . substr($mmyy,2,2));
    $this->SetFont('Arial','',11);
    $this->setXY(11.5, $y);	
    
    $this->SetFont('Arial','',11);
    $y = $y + .5; 
    $image1 = "images/cstclogo.jpg";
    $this->setXY(1.0, $y);
    $this->Cell( 0,0, $this->Image($image1, 1.0,0.15, 0.8), 0, 0, 'L', false );
    $this->setXY(1.0, $y);
    $this->SetFont('Arial','B',11);
    $this->Cell(0,0,"CALCUTTA STATE TRANSPORT CORPORATION                                   " );
    $this->setXY(9.0, $y);
    $this->SetFont('Arial','',11);
    $this->Cell(0,0,"GSTIN : 19AAAJC0330P1ZA                                  " );
    
    $y = $y + .2; 
    
    
    $this->setXY(1.6, $y);
    $this->Cell(0,0,"5, Nilgunj Road. Kolkata - 700 056                                   " );
    $this->setXY(8.9, $y);
    $this->SetFillColor(192);
    $this->Rect(7,  1.3, 4.2, '0.4', 'DF');
   
      
//$y = $y + .1; 
    

    $y = $y + .2; 
    
    $this->setXY(1.3, $y);
    $this->Cell(0,0,"Phone: 033-25532090, Fax: 033-25533017                                   " );
    

    $this->SetFillColor(0);
    $this->setXY(7.0, $y);
    $this->Cell(0,0,"VOUCHER NO.: " . $v_no . " : " . $date . " : " . $time);
    $this->setXY(9.9, $y);
    
    $y = $y + .2; 
    
    $this->setXY(1.2, $y);
    $this->Cell(0,0,"Web: www.cstc.org.in, Email: cosp@cstc.org.in                                   " );
    $y = $y + .1; 
    $this->Line(1,$y,4.6,$y);
    $y = $y + .3; 
   
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"ISSUED FROM :  CENTRAL STORES & PURCHASE                                 " );
    $this->setXY(8.0, $y);
    //$this->Cell(0,0,"RECEIPT NO : " . $mat_rct_no );
    $this->setXY(8.0, $y);
    $this->Cell(0,0, "OPERATOR CODE: " . $user_id);
    $y = $y + .3; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"ISSUED TO : " . $unit_desc  );
    $this->setXY(8.0, $y);
   
   
   
    
   
    $y = $y + .3; 
    $this->SetFont('Arial','U',11);
    $this->setXY(1.0, $y);
    $this->Cell(0,0, "DETAILS OF MATERIALS ISSUED :");
    $this->SetFont('Arial','',11);
    
    
    
$y = $y + .1; 
    $this->Line(1,$y,11.5,$y);
    $y = $y + .1; 
$this->setFillColor(255,255,255);
$this->SetFont('Arial', 'B', 10);
	$this->setXY(1.0, $y);
        $this->Cell(0.7,0.3,"SRL.NO." ,1,1,'C',true);
	$this->setXY(1.7, $y);
        
	$this->Cell(1.0,0.3,"FOLIO NO." ,1,1,'C',true);
        $this->setXY(2.7, $y);
	$this->Cell(1.6,0.3,"PART NO." ,1,1,'C',true);
        $this->setXY(4.3, $y);
	$this->Cell(5.0,0.3,"DESCRIPTION" ,1,1,'C',true);
        $this->setXY(9.3, $y);
	$this->Cell(0.7,0.3,"UNIT" ,1,1,'C',true);
        $this->setXY(10.0, $y);
	$this->Cell(1.3,0.3,"UNIT PRICE(Rs.)" ,1,1,'C',true);
$y = $y + .1; 
   // $this->Line(1,$y,11.5,$y);
    $y = $y + .2; 
$this->setFillColor(255,255,255);
$this->SetFont('Arial', 'BI', 10);
	
	$this->setXY(1.7, $y);
	$this->Cell(1.5,0.3,"INDENT QTY." ,1,1,'C',true);
        $this->setXY(3.2, $y);
	$this->Cell(1.5,0.3,"YTD ISSUE QTY." ,1,1,'C',true);
        $this->setXY(4.7, $y);
	$this->Cell(1.5,0.3,"ISSUED QTY" ,1,1,'C',true);
        $this->setXY(6.2, $y);
	$this->Cell(1.5,0.3,"STOCK " ,1,1,'C',true);
        $this->setXY(7.7, $y);
	$this->Cell(2.0,0.3,"ISSUED VALUE (Rs.)" ,1,1,'C',true);
        
        

//$this->setFillColor(255,255,255);
   
}



// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-3);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}



}

$pdf = new PDF('P','in',array(12,15));
//$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$y = 0.5;
//print column titles for the actual page
$pdf->SetFillColor(255, 255, 255);

$i = 0;
$srl = 1;
//Set maximum rows per page
$max = 16.0;
$y=$y + 2.6;
$line = 1;
$total_value = 0;	
while($row3 = mysqli_fetch_array($result3))
{
 //If the current row is the last one, create new page and print column title
    if($y > $max || $srl == 15 || $srl == 29){
      $pdf->AddPage(); 
      $y = 3.1;
      $line = 1;
    }
	$part_no 		= $row3['PART_NO'];
        $itm_nm 		= $row3['SPEC'];
        $uom_id 		= $row3['UOM_ID'];
        $spec                   = $row3['SPEC'];
        $qty                    = -$row3['QTY'];
        $old_voucher            = $row3['old_voucher'];
        
         $query11 = "select ALT_NO_3 FROM current_part_no where PART_NO = '" . $part_no . "'";
            $result11 = mysqli_query($cstccon,$query11);
        $row11 = mysqli_fetch_array($result11);
        $alt_no = $row11['ALT_NO_3'];
        
        //$alt_no                 = $row3['ALT_NO'];

        
        $sql6 = "select * from bincrd where PART_NO = '" . $part_no . "' and FIN_YR = '$cur_fin_yr'";
        $result6=mysqli_query($cstccon,$sql6);
        $row6 = mysqli_fetch_array($result6);
        $iss_val = ($row6['OPNG_VAL'] + $row6['RCT_VAL'] - $row6['ISS_VAL']) * $qty /  ($row6['OPNG_QTY'] + $row6['RCT_QTY'] - $row6['ISS_QTY']) ;
        
        $iss_val_tot = $iss_val_tot + $iss_val;
        
        //qty shoub be  qty for new item included to old voucher
        if($old_voucher == 'N'){
        $sql7 = "UPDATE bincrd set ISS_QTY = ISS_QTY + " . abs($qty) . ",ISS_VAL = ISS_VAL + " . abs($iss_val) . ", LISS_DT = DATE_FORMAT(DATE_ADD( now( ) , INTERVAL  '12:30' HOUR_MINUTE ),'%Y-%m-%d') where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "'";
        $result7=mysqli_query($cstccon,$sql7);
        
        
        
        $sql62 = "select * from bincrd_depot where PART_NO = '" . $part_no . "' and FIN_YR = '$cur_fin_yr' and DEPOT = '" . $unit . "'";
        $result62=mysqli_query($cstccon,$sql62);
        if(mysqli_num_rows($result62) > 0){
        
        $sql72 = "UPDATE bincrd_depot set RCT_QTY = RCT_QTY + " . abs($qty) . ",RCT_VAL = RCT_VAL + " . abs($iss_val) . ", LRCT_DT = DATE_FORMAT(DATE_ADD( now( ) , INTERVAL  '12:30' HOUR_MINUTE ),'%Y-%m-%d') where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "' AND DEPOT = '" . $unit . "'";
        $result72=mysqli_query($cstccon,$sql72);
        }
        else{
        $sql_itm21="insert into bincrd_depot(DEPOT,FIN_YR,PART_NO,RCT_QTY,RCT_VAL) values('" . $unit . "','" . $cur_fin_yr . "','" . $part_no . "'," . abs($qty) . "," . abs($iss_val) . ")";
        $result_itm21=mysqli_query($cstccon,$sql_itm21);
        }
        // following 2 lines added on 15/10/17
        $sql312="update itm set LISS_DT = DATE_FORMAT(DATE_ADD( now( ) , INTERVAL  '12:30' HOUR_MINUTE ),'%Y-%m-%d') where PART_NO = '$part_no'";
        $result312=mysqli_query($cstccon,$sql312);
        
        }
//$sql_itmZ1="SELECT a.PART_NO,SUM(a.ITM_QTY) TOT_ITEM_QTY FROM bintxnitm a,bintxn b where a.PART_NO = '$folio_no' and  a.BNTXN_ID = b.BNTXN_ID AND b.FIN_YR = '$CUR_FIN_YR' and b.PRTY_CD = '$unit_to' group by a.PART_NO";
        $sql8 = "select SUM(A.ITM_QTY) YTD_ISS,B.PRTY_CD FROM  bintxnitm A, bintxn B where A.BNTXN_ID = B.BNTXN_ID AND B.FIN_YR = '$cur_fin_yr' AND A.PART_NO = '" . $part_no . "' GROUP BY B.PRTY_CD HAVING B.PRTY_CD = '" . $unit_to . "'";
        $result8=mysqli_query($cstccon,$sql8);
        $row8 = mysqli_fetch_array($result8);
        $ytd_iss = $row8['YTD_ISS'];
        
        $sql9 = "select A.REQ_QTY FROM  indntitm A, indnt B where A.INDNT_ID = B.INDNT_ID AND B.FIN_YR = '$cur_fin_yr' AND A.PART_NO = '" . $part_no . "' AND B.CC_ID = '" . $unit_to . "'";
        $result9=mysqli_query($cstccon,$sql9);
        if(mysqli_num_rows($result9) > 0){
        $row9 = mysqli_fetch_array($result9);
        $indnt_qty = $row9['REQ_QTY'];}
        else{
            $indnt_qty = 0;
        }
        
        $sql91 = "select * FROM bincrd WHERE PART_NO = '" . $part_no . "' AND  FIN_YR =  '" . $cur_fin_yr . "'";
        $result91=mysqli_query($cstccon,$sql91);
        $row91 = mysqli_fetch_array($result91);
        $stock = $row91['OPNG_QTY'] + $row91['RCT_QTY'] - $row91['ISS_QTY'] ;
        //$stock = $stock + $qty;
  	
        
        if($line == 1){
            $y = $y + .4; 
        }
        else{
    	$y = $y + .3; 
        }
         
	
	$pdf->SetFont('Arial', '', 10);
	$pdf->setXY(1.0, $y);
        $pdf->Cell(0.7,0.3,$srl ,1,1,'C',true);
        $pdf->SetFont('Arial','B',11);
	$pdf->setXY(1.7, $y);
	$pdf->Cell(1.0, 0.3, $part_no ,1,1,'C',true);
        $pdf->setXY(2.7, $y);
        $pdf->SetFont('Arial','',11);
	$pdf->Cell(1.6, 0.3, $alt_no,1,1,'C',true);
        $pdf->setXY(4.3, $y);
	$pdf->Cell(5.0, 0.3, $spec ,1,1,'C',true);
        $pdf->setXY(9.3, $y);
        $pdf->Cell(0.7, 0.3, $uom_id,1,1,'C',true);
	$pdf->setXY(10.0, $y);
	$pdf->Cell(1.3, 0.3, number_format($iss_val / $qty,2 ),1,1,'R');
        
        
        $y = $y + .3;  
        if($y > $max){
            
      $pdf->AddPage(); 
      $y = 3.1;
      $y = $y + .3; 
      $line = 1;
    }
       
       $pdf->SetFont('Arial', 'I', 10);
	
        $pdf->setXY(1.7, $y);
        $pdf->Cell(1.5, 0.3, number_format($indnt_qty,2) ,1,1,'R');
        $pdf->setXY(3.2, $y);
	$pdf->Cell(1.5, 0.3,  number_format(-$ytd_iss,2) ,1,1,'R');
        $pdf->SetFont('Arial','BI',11);
        $pdf->setXY(4.7, $y);
	$pdf->Cell(1.5, 0.3,  number_format(-$qty,2) ,1,1,'R');
        $pdf->setXY(6.2, $y);
	$pdf->Cell(1.5, 0.3,  number_format($stock,2) ,1,1,'R');
        $pdf->SetFont('Arial','',11);
        $pdf->setXY(7.7, $y);
	$pdf->Cell(2.0, 0.3,  number_format(-$iss_val,2) ,1,1,'R');
	$srl = $srl + 1;
        $line = $line + 1;
       // $y = $y + .2;
        if($old_voucher == 'N'){
        $sql5 = "insert into bintxnitm(BNTXN_ID,LINE,PART_NO,ITM_QTY,ITM_VAL,CREUSR,CREDT) values('" . $v_no . "'," . $line . ",'" . $part_no . "'," . $qty . "," . $iss_val . ",'" . $user_id . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'))";
        $result5=mysqli_query($cstccon,$sql5);
        
        
        $sql51 = "insert into item_issue_admin(UNIT,BNTXN_ID,old_voucher,ytd_issue,stock,indnt_qty,PART_NO,QTY,iss_val,CREUSR,CREDT,DATE_TIME) values('" . $unit_to . "','" . $v_no . "','" . $old_voucher . "'," . -$ytd_iss . "," . $stock . "," . $indnt_qty . ",'" . $part_no . "'," . $qty . "," . $iss_val . ",'" . $user_id . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'),'" . $date . " : " . $time . "')";
        $result51=mysqli_query($cstccon,$sql51);
        
        }
        if($old_voucher == 'Y'){
      
        $sql51U = "update item_issue_admin set old_voucher = 'Y' where BNTXN_ID = '$v_no' and PART_NO = '$part_no'";
        $result51U=mysqli_query($cstccon,$sql51U);
        
        }
}
$y = $y + .4;
if($y > $max){
      $pdf->AddPage(); 
      $y = 3.1;
      $line = 1;
    }
$pdf->SetFont('Arial', '', 12);
$pdf->setXY(2.5, $y);
$pdf->Cell(1.0, 0, 'TOTAL VALUE OF THIS VOUCHER = Rs.' . number_format(-$iss_val_tot,2) . '(' . convert_number(-$iss_val_tot) . ')',0,0,'L');

$y = $y + .2; 
if($y > $max){
      $pdf->AddPage(); 
      $y = 3.1;
      $line = 1;
    }
if($remark1 != ''){
$pdf->setXY(1.0, $y);
$pdf->Cell(1.0, 0, '** '. $remark1);  
$y = $y + .2; 
if($y > $max){
      $pdf->AddPage(); 
      $y = 3.1;
      $line = 1;
    }
}
$pdf->SetFont('Arial', 'I', 11);
$pdf->setXY(1.0, $y);
//$pdf->Cell(1.0, 0, 'Remark : ' . $remark);
$pdf->MultiCell(10.5, 0.2, 'Remark : ' . $remark, 1, 'L', TRUE);
$y = $y + .2; 
if($y > $max){
      $pdf->AddPage(); 
      $y = 3.1;
      $line = 1;
    }

$pdf->SetFont('Arial', '', 12);
$pdf->setXY(1.0, $y);

$pdf->Line(1,$y,11.5,$y); 
$y = $y + 1.2;
$pdf->SetFont('Arial', '', 12);
$pdf->setXY(1.0, $y);
$pdf->Cell(0, 0, 'Prepared By');
$pdf->setXY(3.5, $y);
$pdf->Cell(0, 0, 'Issued By');
$pdf->setXY(6.0, $y);
$pdf->Cell(0, 0, 'Received By');
$pdf->setXY(8.5, $y);
$pdf->Cell(0, 0, 'Store Keeper');

$y = $y + .2; 
if($y > $max){
      $pdf->AddPage(); 
      $y = 3.1;
      $line = 1;
    }
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(1.0, $y);
$pdf->Line(1,$y,11.5,$y); 
$y = $y + .2; 
if($y > $max){
      $pdf->AddPage(); 
      $y = 3.1;
      $line = 1;
    }
$pdf->setXY(1.0, $y);
$pdf->Cell(0, 0, 'Receiver Copy');        

//********************************88 STORE COPY

//*****************************************************



$_SESSION['unit_to'] = '';
$sql7 = "delete from item_issue";
$result7=mysqli_query($cstccon,$sql7);
ob_clean();
$filename="REPORT/Issue_Voucher/" . $v_no . ".pdf";
//$pdf->Output('Voucher.pdf','D');
$pdf->Output($filename,'F');
$text = "Issue Voucher Number " . $v_no . " Created Successfully" ;
?>
    <script type="text/JavaScript">
     alert("<?php echo $text ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   
<?php
}?>

