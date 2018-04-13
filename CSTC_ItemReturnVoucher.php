<?php
ob_start ();
require_once('Connections/cstccon.php');
require_once('number2word.php');
session_start();
$cur_fin_yr             = $_SESSION['CUR_FIN_YR'];
//$v_no_org=htmlspecialchars($_POST['v_no'],ENT_QUOTES);


$sql3SR = "select * from item_return";
$result3SR=mysqli_query($cstccon,$sql3SR);
$row3SR = mysqli_fetch_array($result3SR);
$v_no_org = $row3SR['BNTXN_ID'];


$sql3S = "delete from item_issue";
$result3S=mysqli_query($cstccon,$sql3S);



$sql3S5 = "insert into item_issue (PART_NO,QTY) SELECT PART_NO,QTY_TO_RETURN FROM item_return WHERE QTY_TO_RETURN > 0";
$result3S5=mysqli_query($cstccon,$sql3S5);

$sql3S = "select * from item_return WHERE QTY_TO_RETURN > 0";
$result3S=mysqli_query($cstccon,$sql3S);
while($row3S = mysqli_fetch_array($result3S)){
    $part_no = $row3S['PART_NO'];
    $qty_to_return = $row3S['QTY_TO_RETURN'];
    
    $sql3S1 = "select * from bintxnitm where BNTXN_ID = '" . $v_no_org . "' and PART_NO = '" . $part_no . "'";
    $result3S1=mysqli_query($cstccon,$sql3S1);
    $row3S1 = mysqli_fetch_array($result3S1);
    $qty_org = -$row3S1['ITM_QTY'];
    $itm_val = -$row3S1['ITM_VAL'];
    
    //$qty_diff = $qty_org - $qty_to_return ;
    $itm_rate = $itm_val / $qty_org ;
    $itm_val = $itm_rate * $qty_to_return ;
    
    
   
    $sql3S1111 = "update bincrd set ISS_QTY = ISS_QTY - " . $qty_to_return . " , ISS_VAL = ISS_VAL - " . $itm_val . " where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "'";
    $result3S1111=mysqli_query($cstccon,$sql3S1111);
    
    // $sql3S111 = "update bintxnitm set ITM_QTY = " . -$iss_qty . " , ITM_VAL = " . -$iss_val . " where BNTXN_ID = '" . $v_no_org . "' and PART_NO = '" . $part_no . "'";
   // $result3S111=mysqli_query($cstccon,$sql3S111);

    }

if(mysqli_num_rows($result3S) > 0){
    
    

$sql1 = "select PRTY_CD UNIT_TO FROM bintxn where BNTXN_ID = '" . $v_no_org . "'";
$result1=mysqli_query($cstccon,$sql1);
$row1 = mysqli_fetch_array($result1);        
        
$unit    		= $row1['UNIT_TO'];  //e.g KD 


//$unit_code = substr($v_no, -5, 1); // returns "d"   
$unit_from = substr($v_no_org, 0, 1); // returns "d"   

$user_id = $_SESSION['USER_ID'];

$remark = "test";

$sql11 = "select * from unit where UNIT = '" . $unit . "'";
$result11=mysqli_query($cstccon,$sql11);
$row11 = mysqli_fetch_array($result11);
$unit_desc = $row11['UNIT_DESC'];
$unit_code = $row11['UNIT_CODE'];

$sql12 = "select * from unit where UNIT_CODE = '" . $unit_from . "'";
$result12=mysqli_query($cstccon,$sql12);
$row12 = mysqli_fetch_array($result12);
$unit_from_desc = $row12['UNIT_DESC'];
$unit_from_code = $row12['UNIT_CODE'];

$sql1 = "select max(substring(BNTXN_ID,length(BNTXN_ID) - 3,4)) MAX_ID FROM bintxn where FIN_YR = '" . $cur_fin_yr . "' and substring(BNTXN_ID,length(BNTXN_ID) - 4,1) IN('I','R')";
$result1=mysqli_query($cstccon,$sql1);
if(mysqli_num_rows($result1) > 0){
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;}
else { $new_number = 1;}
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}
if($unit != ''){
$v_no = $unit_from_code . $cur_fin_yr . $unit_code . 'R' . $new_number;
//echo $v_no . $cur_fin_yr . $unit . $remark  . $v_no . $_SESSION['UNAME'] ;

$sql4 = "insert into bintxn(BNTXN_ID,FIN_YR,CLS,DOC_DT,PRTY_CD,REF_DOC,RMK,CREUSR,CREDT) VALUES('" . $v_no . "','$cur_fin_yr','MR',now(),'" . $unit . "','" . $v_no_org ."','" . $remark . "','" . $_SESSION['UNAME'] . "',NOW())";
$result4=mysqli_query($cstccon,$sql4);

$sql49 = "insert into bntxn_id_create_datetime(BNTXN_ID) VALUES('" . $v_no . "')";
$result49=mysqli_query($cstccon,$sql49);

}

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
global $unit_desc;
global $iss_val_tot;
global $date;
global $time;
global $v_no_org;

$date =  date("F j, Y");
$time = date("H:i:s", strtotime('+210 minutes')); 

    $y = 0.3;
    $this->SetFont('Arial','',11);

    $y = $y + .3; 
    $image1 = "images/cstclogo.jpg";
    $this->setXY(1.0, $y);
    $this->Cell( 0,0, $this->Image($image1, 1.0,0.15, 0.8), 0, 0, 'L', false );
    $this->setXY(4.0, $y);
    $this->SetFont('Arial','B',16);
    $this->Cell(0,0,"               MATERIAL RETURN VOUCHER                                   " );
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
    $this->Cell(0,0,"VOUCHER NO.: " . $v_no  ." : " . $date . " : " . $time);
    $this->setXY(9.9, $y);
    
    $y = $y + .2; 
    
    $this->setXY(1.2, $y);
    $this->Cell(0,0,"Web: www.cstc.org.in, Email: cosp@cstc.org.in                                   " );
    $y = $y + .1; 
    $this->Line(1,$y,4.6,$y);
    $y = $y + .3; 
   
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"RETURNED FROM :                                   " );
    $this->setXY(8.0, $y);
    //$this->Cell(0,0,"RECEIPT NO : " . $mat_rct_no );
    $this->setXY(8.0, $y);
    $this->Cell(0,0, "OPERATOR CODE: " . $user_id);
    $y = $y + .3; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"UNIT : " . $unit_desc  );
    $this->setXY(8.0, $y);
   
   
   
    
   
    $y = $y + .3; 
    $this->SetFont('Arial','U',11);
    $this->setXY(1.0, $y);
    $this->Cell(0,0, "DETAILS OF MATERIALS RETURNED :");
    $this->SetFont('Arial','',11);
    
    
    
$y = $y + .1; 
    $this->Line(1,$y,11.5,$y);
    $y = $y + .1; 
$this->setFillColor(200,200,200);
$this->SetFont('Arial', '', 10);
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
$this->setFillColor(200,200,200);
$this->SetFont('Arial', '', 10);
	
	$this->setXY(1.7, $y);
	$this->Cell(1.5,0.3,"INDENT QTY." ,1,1,'C',true);
        $this->setXY(3.2, $y);
	$this->Cell(1.5,0.3,"YTD ISSUE QTY." ,1,1,'C',true);
        $this->setXY(4.7, $y);
	$this->Cell(1.5,0.3,"RETURNED QTY" ,1,1,'C',true);
        $this->setXY(6.2, $y);
	$this->Cell(1.5,0.3,"STOCK " ,1,1,'C',true);
        $this->setXY(7.7, $y);
	$this->Cell(2.0,0.3,"RETURNED VALUE (Rs.)" ,1,1,'C',true);
        
        

$this->setFillColor(255,255,255);
   
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
$max = 17;
$y=$y + 2.6;
$line = 1;
$total_value = 0;
$iss_val_tot = 0;
while($row3 = mysqli_fetch_array($result3))
{
 //If the current row is the last one, create new page and print column title
    
	$part_no 		= $row3['PART_NO'];
        $itm_nm 		= $row3['SPEC'];
        $uom_id 		= $row3['UOM_ID'];
        $spec                   = $row3['SPEC'];
        $qty_to_return          = $row3['QTY'];
        
         $query11 = "select ALT_NO_3 FROM current_part_no where PART_NO = '" . $part_no . "'";
            $result11 = mysqli_query($cstccon,$query11);
        $row11 = mysqli_fetch_array($result11);
        $alt_no = $row11['ALT_NO_3'];
        
             
             $sql3S1 = "select * from bintxnitm where BNTXN_ID = '" . $v_no_org . "' and PART_NO = '" . $part_no . "'";
    $result3S1=mysqli_query($cstccon,$sql3S1);
    $row3S1 = mysqli_fetch_array($result3S1);
    $qty_org = -$row3S1['ITM_QTY'];
    $itm_val = -$row3S1['ITM_VAL'];
    $itm_rate = $itm_val / $qty_org ;
    $iss_val = $qty_to_return * $itm_rate ;
        
          
        $sql5 = "insert into bintxnitm(BNTXN_ID,LINE,PART_NO,ITM_QTY,ITM_VAL,CREUSR,CREDT) values('" . $v_no . "'," . $line . ",'" . $part_no . "'," . $qty_to_return . "," . $iss_val . ",'" . $user_id . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'))";
        $result5=mysqli_query($cstccon,$sql5);
        
        $sql7 = "UPDATE bintxnitm set QTY_RETURN_STAT = 'Y' WHERE BNTXN_ID = '" . $v_no_org . "' and PART_NO = '" . $part_no . "'";
        $result7=mysqli_query($cstccon,$sql7);
        
        
        
        $sql62 = "select * from bincrd_depot where PART_NO = '" . $part_no . "' and FIN_YR = '$cur_fin_yr' and DEPOT = '" . $unit . "'";
        $result62=mysqli_query($cstccon,$sql62);
        if(mysqli_num_rows($result62) > 0){
        
        $sql72 = "UPDATE bincrd_depot set RCT_QTY = RCT_QTY - " . abs($qty_to_return) . ",RCT_VAL = RCT_VAL + " . abs($iss_val) . ", LRCT_DT = NOW() where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "' AND DEPOT = '" . $unit . "'";
        $result72=mysqli_query($cstccon,$sql72);
        }
       
        
        $sql8 = "select SUM(A.ITM_QTY) YTD_ISS,B.PRTY_CD FROM  bintxnitm A, bintxn B where A.BNTXN_ID = B.BNTXN_ID AND B.FIN_YR = '$cur_fin_yr' AND A.PART_NO = '" . $part_no . "' GROUP BY B.PRTY_CD HAVING B.PRTY_CD = '" . $unit . "'";
        $result8=mysqli_query($cstccon,$sql8);
        $row8 = mysqli_fetch_array($result8);
        $ytd_iss = $row8['YTD_ISS'];
        
        $sql9 = "select A.REQ_QTY FROM  indntitm A, indnt B where A.INDNT_ID = B.INDNT_ID AND B.FIN_YR = '$cur_fin_yr' AND A.PART_NO = '" . $part_no . "' AND B.CC_ID = '" . $unit . "'";
        $result9=mysqli_query($cstccon,$sql9);
        $row9 = mysqli_fetch_array($result9);
        $indnt_qty = $row9['REQ_QTY'];
        
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
	$pdf->Cell(1.3, 0.3, number_format($iss_val / $qty_to_return,2 ),1,1,'R');
        
        
        $y = $y + .3;  
        
       
       
	
        $pdf->setXY(1.7, $y);
        $pdf->Cell(1.5, 0.3, number_format($indnt_qty,2) ,1,1,'R');
        $pdf->setXY(3.2, $y);
	$pdf->Cell(1.5, 0.3,  number_format(-$ytd_iss,2) ,1,1,'R');
        $pdf->SetFont('Arial','B',11);
        $pdf->setXY(4.7, $y);
	$pdf->Cell(1.5, 0.3,  number_format($qty_to_return,2) ,1,1,'R');
        $pdf->setXY(6.2, $y);
	$pdf->Cell(1.5, 0.3,  number_format($stock,2) ,1,1,'R');
        $pdf->SetFont('Arial','',11);
        $pdf->setXY(7.7, $y);
	$pdf->Cell(2.0, 0.3,  number_format($iss_val,2) ,1,1,'R');
	$srl = $srl + 1;
        $line = $line + 1;
       // $y = $y + .2;
        $iss_val_tot = $iss_val_tot + $iss_val ;
       
}
$y = $y + .4;
$pdf->SetFont('Arial', '', 12);
$pdf->setXY(2.5, $y);
$pdf->Cell(1.0, 0, 'TOTAL VALUE OF THIS VOUCHER = Rs.' . number_format($iss_val_tot,2) . '(' . convert_number($iss_val_tot) . ')',0,0,'L');

$y = $y + .2; 
$pdf->SetFont('Arial', 'I', 11);
$pdf->setXY(1.0, $y);
$pdf->Cell(1.0, 0, 'Remark : ' . $remark);

$y = $y + .2; 
$pdf->SetFont('Arial', '', 12);
$pdf->setXY(1.0, $y);

$pdf->Cell(0, 0, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
 
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
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(1.0, $y);
$pdf->Cell(0, 0, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + .2; 
$pdf->setXY(1.0, $y);
$pdf->Cell(0, 0, 'Receiver Copy');        

//********************************88 STORE COPY

//*****************************************************


$_SESSION['unit_to'] = '';
$sql7 = "delete from item_issue";
//$result7=mysqli_query($cstccon,$sql7);


$_SESSION['unit_to'] = '';
//$sql7 = "delete from item_issue";
//$result7=mysqli_query($cstccon,$sql7);
ob_clean();
$filename="REPORT/Issue_Voucher/" . $v_no . ".pdf";
//$pdf->Output('Voucher.pdf','D');
$pdf->Output($filename,'F');
$text = "Return Voucher Number " . $v_no . " Created Successfully" ;
?>
    <script type="text/JavaScript">
     alert("<?php echo $text ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   
<?php
}?>

