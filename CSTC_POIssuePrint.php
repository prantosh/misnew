<?php
ob_start ();
//if(isset($_POST['po_no1'])){
require_once('Connections/cstccon.php');

require_once('number2word.php');
session_start();
$po_no=htmlspecialchars($_POST['po_no1'],ENT_QUOTES);

$po_no=htmlspecialchars($_POST['po_no1'],ENT_QUOTES);
$po_no=htmlspecialchars($_POST['po_no1'],ENT_QUOTES);
$vnd_id=htmlspecialchars($_POST['vnd_id'],ENT_QUOTES);
//$note=htmlspecialchars($_POST['note_to_print'],ENT_QUOTES);
$ofr_dt=htmlspecialchars($_POST['ofr_date'],ENT_QUOTES);
$user_id = $_SESSION['USER_ID'];
//echo $po_no ;
$sql_itma="update po set AMD_NO = 0 WHERE AMD_NO IS NULL";
$result_itma=mysqli_query($cstccon,$sql_itma); 

$sql_itma1="update po set UPDDT = NOW(),UPDUSR = '" . $user_id . "' WHERE PO_NO = '" . $po_no . "'";
$result_itma1=mysqli_query($cstccon,$sql_itma1); 


$i = 0;
$sql_itm="select * FROM po WHERE PO_NO = '" . $po_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result_itm) > 0){
$sql_itma2="update po set AMD_NO = AMD_NO + 1 WHERE PO_NO = '" . $po_no . "'";
$result_itma2=mysqli_query($cstccon,$sql_itma2); 

 

$note=htmlspecialchars($_POST['note_to_mod'],ENT_QUOTES);
$pay_trm=htmlspecialchars($_POST['pay_trm'],ENT_QUOTES);
$f08 = htmlspecialchars($_POST['f08'],ENT_QUOTES);
$f09 = htmlspecialchars($_POST['f09'],ENT_QUOTES);

$sql_itma2k="update po set PAY_TRM = '" . $pay_trm . "',F08 = " . $f08 . ",F09 = " . $f09 . ",NOTE = '" . $note . "' WHERE PO_NO = '" . $po_no . "'";
$result_itma2k=mysqli_query($cstccon,$sql_itma2k); 

}
else {
$note=htmlspecialchars($_POST['note_to_print'],ENT_QUOTES);
$sql_itm="select * FROM po_item_issue WHERE PO_QTY > 0";
$result_itm=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result_itm) > 0){

//$vnd_id = $_SESSION['vnd_id'];    
if(isset($_POST['amd_no'])) { $amd_no=htmlspecialchars($_POST['amd_no'],ENT_QUOTES);}  

else {$amd_no = 0; $sts = 'D';}
$ofr_no=htmlspecialchars($_POST['ofr_no'],ENT_QUOTES);  
$dlv_dt=htmlspecialchars($_POST['mydate'],ENT_QUOTES);  
$dlv_dt_disp = $dlv_dt ;
$dlv_dt = substr($dlv_dt,6,4) . '-' . substr($dlv_dt,3,2) . '-' . substr($dlv_dt,0,2) ;
$ofr_dt = substr($ofr_dt,6,4) . '-' . substr($ofr_dt,3,2) . '-' . substr($ofr_dt,0,2) ;
if($amd_no != 0){$sts = 'C';}


$unt_id=htmlspecialchars($_POST['unt_id'],ENT_QUOTES);  
$del_term=htmlspecialchars($_POST['del_term'],ENT_QUOTES);  
//$note=htmlspecialchars($_POST['note_to_print'],ENT_QUOTES);  
    
$pay_term=htmlspecialchars($_POST['pay_term'],ENT_QUOTES); 
//$del_sch_type=htmlspecialchars($_POST['del_sch_type'],ENT_QUOTES); 



$f08=htmlspecialchars($_POST['f08'],ENT_QUOTES); 
$f09=htmlspecialchars($_POST['f09'],ENT_QUOTES); 
//$f06=htmlspecialchars($_POST['f06'],ENT_QUOTES); 
//$ofr_date=htmlspecialchars($_POST['ofr_dt'],ENT_QUOTES); 
//$ofr_dt = substr($ofr_dt,6,4) . '-' . substr($ofr_dt,3,2) . '-' . substr($ofr_dt,0,2) ;
$mydate=htmlspecialchars($_POST['mydate'],ENT_QUOTES); 
$mydate = substr($mydate,6,4) . '-' . substr($mydate,3,2) . '-' . substr($mydate,0,2) ;
$po_val = 0;

while ($row_itm = mysqli_fetch_assoc($result_itm)){    
$part_no = $row_itm['PART_NO']; 
$po_qty = $row_itm['PO_QTY'];
$max_po_qty_allowed = $po_qty * 1.05 ;
$unt_rt = $row_itm['UNT_RT'];
$pur_req_id = $row_itm['REQ_ID'];
$cd = $row_itm['cd'];
$cgst = $row_itm['cgst'];
$sgst = $row_itm['sgst'];
$igst = $row_itm['igst'];

$sql_itmC="select UOM_ID FROM itm where PART_NO = '$part_no'";
$result_itmC=mysqli_query($cstccon,$sql_itmC);
$row_itmC = mysqli_fetch_assoc($result_itmC);
$uom_id = $row_itmC['UOM_ID'];

$po_disc = $unt_rt * $cd / 100 ;
$po_val_after_disc = $unt_rt - $po_disc ;
$po_tax = $po_val_after_disc * ($cgst + $sgst + $igst) / 100 ;

$po_val = $po_val + ($po_val_after_disc + $po_tax) * $po_qty;





    $sql2del =  "delete from poitm  where PO_NO = '$po_no' and PART_NO = '$part_no'";
     $result2del =        mysqli_query($cstccon,$sql2del);

    $sql2 =  "INSERT INTO poitm (PO_NO,PART_NO,REQ_ID,PO_QTY,UOM_ID,UNT_RT,AMD_NO,cd,cgst,sgst,igst,MAX_PO_QTY_ALLOWED,CREUSR,CREDT) VALUES ('$po_no','$part_no','$pur_req_id','$po_qty','$uom_id','$unt_rt','$amd_no','$cd','$cgst','$sgst','$igst','$max_po_qty_allowed','$user_id',now())";
     $result2 = mysqli_query($cstccon,$sql2);
            
            
            
    $sql_itmG="SELECT PART_NO,SUM(PO_QTY) tot_po_qty FROM poitm where REQ_ID = '$pur_req_id' AND PART_NO = '" . $part_no . "' GROUP BY PART_NO";
$result_itmG=mysqli_query($cstccon,$sql_itmG);
$row_itmG = mysqli_fetch_assoc($result_itmG);

          $tot_po_qty =  $row_itmG['tot_po_qty'];
            
            
            $sql4 =  "update purreqitm set PO_QTY = '$tot_po_qty' where PART_NO = '$part_no' and PUR_REQ_ID = '$pur_req_id";
    $result4 =  mysqli_query($cstccon,$sql4);
    
    
    
}    
   // $sql3del =  "delete from po where PO_NO = '$po_no'";
     //       mysqli_query($cstccon,$sql3del); 
$query11c = "select * from po WHERE PO_NO = '" . $po_no . "'";
        $result11c=mysqli_query($cstccon,$query11c);
        $row11c = mysqli_fetch_array($result11c);
        $FO8 = $row11c['F08'];
        $FO9 = $row11c['F09'];
$po_val = $po_val + $F08 + $F09 ; 
    
    $sql3 =  "INSERT INTO po (PO_NO,UNT_ID,CLS,PO_DT,AMD_NO,VND_ID,OFR_NO,DLV_DT,STS,PAY_TRM,REF_DOC,PRC_SCM,F02,F03,F05,F04,F08,F09,PO_VAL,OTH_TRM,WEF_DT,NOTE,CREUSR,CREDT)"
        . " VALUES ('$po_no','$unt_id','M','$ofr_dt',0,'$vnd_id','$ofr_no','$mydate','$sts','$pay_term','','01','$f02','$f03','$f05','$f04','$f08','$f09','$po_val','$del_term','$ofr_dt','$note','$user_id',now())";
    $result3 =  mysqli_query($cstccon,$sql3);    
    
}

}

// PRINTING START

$sql = "select * from po where PO_NO = '$po_no'";
$result=mysqli_query($cstccon,$sql);
$row = mysqli_fetch_array($result);

$unt_id = $row['UNT_ID'];
$cls = $row['CLS'];
$po_dt = $row['PO_DT'];
$amd_no = $row['AMD_NO'];
$amd_dt = $row['AMD_DT'];
$vnd_id = $row['VND_ID'];
$ofr_no = $row['OFR_NO'];
$dlv_dt = $row['DLV_DT'];
$prc_scm = $row['PRC_SCM'];
$f02 = $row['F02'];
$f03 = $row['F03'];
$f04 = $row['F04'];
$f05 = $row['F05'];
$f08 = $row['F08'];
$f09 = $row['F09'];
$pay_term = $row['PAY_TRM'];
//$note = $row['NOTE'];
$po_schdl = $row['PO_SCHDL'];

$po_val = $row['PO_VAL'];
$creusr = $row['CREUSR'];
$credt = $row['CREDT'];
$wef_dt = $row['WEF_DT'];
$del_term = $row['OTH_TRM'];


$sql61 = "select * from vnd where VND_ID = '$vnd_id'";
$result61=mysqli_query($cstccon,$sql61);
$row61 = mysqli_fetch_array($result61);
$vnd_nm = $row61['VND_NM'];
$addr_1 = $row61['ADDR_1'];
$addr_2 = $row61['ADDR_2'];
$addr_3 = $row61['ADDR_3'];
$zip = $row61['ZIP'];


$sql62 = "select * from pay_term where pay_term_code = '$pay_term'";
    $result62=mysqli_query($cstccon,$sql62);
    $row62 = mysqli_fetch_array($result62);
    $pay_term_desc = $row62['pay_term_desc'];


$sql3 = "select * from poitm A,itm B where A.PART_NO = B.PART_NO and A.PO_NO = '$po_no'";
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

global $vnd_id;
global $vnd_nm;
global $addr_1;
global $addr_2;
global $addr_3;
global $zip;
global $total_value;
global $del_term ;
global $unt_id ;
global $cls ;
global $po_no;
global $po_dt;
global $alt_no;
global $amd_no ;
global $amd_dt ;
global $vnd_id ;
global $ofr_no;
global $dlv_dt;
global $dlv_dt_disp;
global $prc_scm ;
global $f02 ;
global $f03;
global $f04;
global $f05 ;
global $f06 ;
global $f08 ;
global $f09 ;
global $pay_term_desc ;

global $note ;
global $po_schdl;

global $po_val;
global $creusr ;
global $credt ;
global $wef_dt ;
global $po_schdl_disp;
global $dlv_dt;
global $dlv_dt1;
global $dlv_dt2;
global $dlv_dt3;
global $dlv_dt4;
global $dlv_dt5;
global $dlv_dt6;
global $dlv_dt7;
global $dlv_dt8;
global $dlv_dt9;
global $dlv_dt10;
global $dlv_dt11;
global $dlv_dt12;
global $dlv_qty;
global $dlv_qty1;
global $dlv_qty2;
global $dlv_qty3;
global $dlv_qty4;
global $dlv_qty5;
global $dlv_qty6;
global $dlv_qty7;
global $dlv_qty8;
global $dlv_qty9;
global $dlv_qty10;
global $dlv_qty11;
global $dlv_qty12;
global $p;
global $cd;
global $cgst;
global $sgst;
global $igst;

$date =  date("F j, Y");
//$new_time = date('H:i', strtotime('+15 minutes'));
$time = date("H:i:s", strtotime('+210 minutes')); 
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    $y = 0.5;
    $this->SetFont('Arial','',11);
    // Move to the right
    
    // Title
    //$this->setXY(0.3, $y);
    //$this->Cell(0, 0, '-----------------------------------------------------------');
    //$this->Image('images/cstclogo.jpg',10,6,30);
    
    $y = $y + .3; 
    $image1 = "images/cstclogo.jpg";
    $this->setXY(1.0, $y);
    $this->Cell( 0,0, $this->Image($image1, 1.0,0.15, 0.8), 0, 0, 'L', false );
    $this->setXY(4.0, $y);
    $this->SetFont('Arial','B',16);
    $this->Cell(0,0,"               PURCHASE ORDER                                   " );
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
    $this->setXY(9.5, $y);
    $this->SetFont('Arial','',11);
    $this->Cell(0,0,"GSTIN : 19AAAJC0330P1ZA                                  " );
    
    $y = $y + .2; 
    
    
    $this->setXY(1.6, $y);
    $this->Cell(0,0,"5, Nilgunj Road. Kolkata - 700 056                                   " );
    $this->setXY(8.9, $y);
    $this->SetFillColor(192);
    $this->Rect(8,  1.5, 3.9, '0.4', 'DF');
   
      
//$y = $y + .1; 
    

    $y = $y + .2; 
    
    $this->setXY(1.3, $y);
    $this->Cell(0,0,"Phone: 033-25532090, Fax: 033-25533017                                   " );
    
     $po_dt_disp = substr($po_dt,8,2) . '-' . substr($po_dt,5,2) . '-' . substr($po_dt,0,4);

    $this->SetFillColor(0);
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"PO NO.: " . $po_no . "(" . trim($amd_no) . ")" . "            PO DATE : " . $po_dt_disp);
    $this->setXY(9.9, $y);
    
    $y = $y + .2; 
    
    $this->setXY(1.2, $y);
    $this->Cell(0,0,"Web: www.cstc.org.in, Email: cosp@cstc.org.in                                   " );
    $y = $y + .1; 
    $this->Line(1,$y,4.6,$y);
    $y = $y + .3; 
   
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"VENDOR :                                   " );
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"DELIVERY ADDRESS :                                   " );
    $y = $y + .3; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"Code: " . $vnd_id  );
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"CENTRAL STORES & PURCHASE                                   " );
    $y = $y + .2; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0, $vnd_nm  );
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"5,NILGUNJ ROAD, KOLKATA - 700056 " );
    $y = $y + .2; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0, $addr_1 . ', ' . $addr_2   );
    $this->setXY(8.0, $y);
    $this->SetFont('Arial','B',11);
    $this->Cell(0,0,"DELIVERY TERMS :                                   " );
    $this->SetFont('Arial','',11);
    $y = $y + .2; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0, $addr_3 . " "  . $zip);
    
    $this->setXY(8.0, $y);
    $this->Cell(0,0, $del_term);
    
   
    
    $y = $y + .2;
    $this->setXY(1.0, $y);
    $this->Cell(3.0,0.4,"REF. NO. :" . $ofr_no ,1,1,'C');
    $this->setXY(4.2, $y);
    $this->Cell(4.1,0.4,"PAYMENT TERMS :" . $pay_term_desc ,1,1,'C');
    $this->setXY(8.5, $y);
    $dlv_dt = substr($dlv_dt,8,2) . '-' . substr($dlv_dt,5,2) . '-' . substr($dlv_dt,0,4) ;

    $this->Cell(3.0,0.4,"LAST DATE OF DELIVERY :" . $dlv_dt_disp  ,1,1,'C');
    $y = $y + .7; 
    $this->SetFont('Arial','U',11);
    $this->setXY(1.0, $y);
    $this->Cell(0,0, "DETAILS OF MATERIALS TO SUPPLY :");
    $this->SetFont('Arial','',11);
    
    
    
$y = $y + .1; 
    $this->Line(1,$y,11.5,$y);
    $y = $y + .1; 
$this->setFillColor(200,200,200);
$this->SetFont('Arial', '', 10);
	$this->setXY(1.0, $y);
        $this->Cell(0.7,0.3,"SRL.NO." ,1,1,'C',true);
	//$this->Cell(0.5, 0, 'SRL.NO.' );
	//$pdf->setXY(1.3, $y);
	//$pdf->Cell(0, 0, '  MONTH: ');
	$this->setXY(1.7, $y);
	$this->Cell(0.8,0.3,"QUANTITY" ,1,1,'C',true);
        $this->setXY(2.5, $y);
	$this->Cell(1.2,0.3,"PART NO." ,1,1,'C',true);
        $this->setXY(3.7, $y);
	$this->Cell(0.8,0.3,"FOLIO NO." ,1,1,'C',true);
        $this->setXY(4.5, $y);
	$this->Cell(2.8,0.3,"DESCRIPTION" ,1,1,'C',true);
        $this->setXY(7.3, $y);
	$this->Cell(0.5,0.3,"UNIT" ,1,1,'C',true);
        $this->setXY(7.8, $y);
	$this->Cell(1.2,0.3,"UNIT PRICE(Rs.)" ,1,1,'C',true);
        $this->setXY(9.0, $y);
	$this->Cell(0.7,0.3,"DISC(%)" ,1,1,'C',true);
        $this->setXY(9.7, $y);
	$this->Cell(0.7,0.3,"CGST(%)" ,1,1,'C',true);
        $this->setXY(10.4, $y);
	$this->Cell(0.7,0.3,"SGST(%)" ,1,1,'C',true);
        $this->setXY(11.1, $y);
	$this->Cell(0.7,0.3,"IGST(%)" ,1,1,'C',true);

$this->setFillColor(255,255,255);

    
    
    
    
    
    
    
    
    
    
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    //$this->SetY(-.5);
    // Arial italic 8
    //$this->SetFont('Arial','I',8);
    // Page number
    //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(0.2,$txt,$URL);
   // $this->SetStyle('U',false);
   // $this->SetTextColor(0);
}






}













// Instanciation of inherited class
//$pdf = new PDF('P','mm',array(100,150));
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
$max = 13;
$y=$y + 3.8;
$line = 1;
$total_value = 0;	

while($row3 = mysqli_fetch_array($result3))
{
    
//If the current row is the last one, create new page and print column title
    if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
	$part_no 		= $row3['PART_NO'];
        
        $query11 = "select ALT_NO_3 FROM current_part_no where PART_NO = '" . $part_no . "'";
      //  $sql62 = "select * from pay_term where pay_term_code = '$pay_term'";
        $result11=mysqli_query($cstccon,$query11);
        $row11 = mysqli_fetch_array($result11);
        $alt_no = $row11['ALT_NO_3'];
        
        
        
        $itm_nm 		= $row3['ITM_NM'];
        $uom_id 		= $row3['UOM_ID'];
        $spec                   = $row3['ITM_NM'];
        $cd                     = $row3['cd'];
        $cgst                     = $row3['cgst'];
        $sgst                     = $row3['sgst'];
        $igst                     = $row3['igst'];

        $po_qty                = $row3['PO_QTY'] ;
        //$alt_no                 = $row3['ALT_NO'];
        //$alt_no_2                 = $row3['ALT_NO_2'];
        $unt_rt                 = $row3['UNT_RT'];
        $unt_rt_after_disc = $unt_rt - ($unt_rt * $cd / 100) ;
        $tot_tax = $unt_rt_after_disc * ($cgst + $sgst + $igst) / 100 ;
        
        $gross_val              =  $po_qty * ($unt_rt_after_disc +  $tot_tax) ;
        
        $total_value = $total_value + $gross_val;
        
    	$y = $y + .25; 
        
        
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0.7,0.3,$srl ,1,1,'C',true);
	//$pdf->Cell(0.5, 0, 'SRL.NO.' );
	//$pdf->setXY(1.3, $y);
	//$pdf->Cell(0, 0, '  MONTH: ');
       
        
              
	$pdf->setXY(1.7, $y);
	$pdf->Cell(0.8,0.3,$po_qty ,1,1,'R',true);
        $pdf->setXY(2.5, $y);
	$pdf->Cell(1.2,0.3,$alt_no ,1,1,'C',true);
        $pdf->setXY(3.7, $y);
	$pdf->Cell(0.8,0.3,$part_no ,1,1,'C',true);
        $pdf->setXY(4.5, $y);
	$pdf->Cell(2.8,0.3,$spec ,1,1,'C',true);
        $pdf->setXY(7.3, $y);
	$pdf->Cell(0.5,0.3,$uom_id ,1,1,'C',true);
        $pdf->setXY(7.8, $y);
	$pdf->Cell(1.2,0.3,number_format($unt_rt,2) ,1,1,'R',true);
        $pdf->setXY(9.0, $y);
	$pdf->Cell(0.7,0.3,number_format($cd,2) ,1,1,'R',true);
        $pdf->setXY(9.7, $y);
	$pdf->Cell(0.7,0.3,number_format($cgst,2) ,1,1,'R',true);
        $pdf->setXY(10.4, $y);
	$pdf->Cell(0.7,0.3,number_format($sgst,2) ,1,1,'R',true);
        $pdf->setXY(11.1, $y);
	$pdf->Cell(0.7,0.3,number_format($igst,2) ,1,1,'R',true);
        
        $srl = $srl + 1;
        $line = $line + 1;
        $i = $i + 1;
}
        




        $query11c = "select * from po WHERE PO_NO = '" . $po_no . "'";
        $result11c=mysqli_query($cstccon,$query11c);
        $row11c = mysqli_fetch_array($result11c);
        $FO8 = $row11c['F08'];
        $FO9 = $row11c['F09'];
$total_value = $total_value + $F08 + $F09 ;
$y = $y + .3; 
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }

        $pdf->setXY(1.0, $y);
        $pdf->SetFont('Arial','B',10);
	$pdf->Cell(1.3,0.3,'Total: Rs. '. convert_number($total_value). ' (Including Tax and Other Charges)');
        $pdf->setXY(10.4, $y);
	$pdf->Cell(1.4,0.3,'TOTAL : ' . number_format($total_value,2) ,1,1,'R',true);
        //$pdf->setXY(10.1, $y);
	//$pdf->Cell(1.4,0.3,number_format($total_value,2) ,1,1,'R',true);
        $pdf->SetFont('Arial','',11);
        
        $y = $y + .5; 
        if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
        $pdf->SetFont('Arial','U',11);
$pdf->setXY(1.0, $y);
    $pdf->Cell(0,0, "DETAILS OF TAXES AND OTHER CHARGES :");
$pdf->setXY(6.0, $y);
    $pdf->Cell(0,0, "DETAILS OF DELIVERY SCHEDULE : ");
    $pdf->SetFont('Arial','',11);
 $y = $y + .1;
 if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $pdf->setXY(1.0, $y);
    $pdf->Cell(2.8,0.3,"Handling & Packaging(Rs.) :" . $f08 ,1,1,'C');
    $pdf->setXY(3.8, $y);
    $pdf->Cell(1.6,0.3,"Freight(Rs) :" . $f09  ,1,1,'C');
    
    $pdf->setXY(6.2, $y);
    $pdf->Cell(2.8,0.3,"% of Quantity to Deliver :",1,1,'C' );
    $pdf->setXY(9.0, $y);
    $pdf->Cell(1.6,0.3,"Delivery Date :",1,1,'C' );
    
    
    
    //$y = $y + .6;
   // $pdf->setXY(1.0, $y);
    //$pdf->SetFont('Arial','',11);
    //if($po_schdl == '1'){$po_schdl_disp = 'NO DELIIVERY SCHEDULE';}
   // if($po_schdl == '2'){$po_schdl_disp = 'TYPE OF SCHEDULE WILL BE IN % FIGURE AT PO LEVEL';}
   // if($po_schdl == '3'){$po_schdl_disp = 'TYPE OF SCHEDULE WILL BE IN QAUNTITY FIGURE AT PO LEVE';}
   // $pdf->Cell(0,0, "DETAILS OF DELIVERY SCHEDULE : " . $po_schdl_disp);
   // $pdf->SetFont('Arial','',11);
 
    
    
    
    $y = $y + .3;
   // $pdf->setXY(3.0, $y);
   // $pdf->Cell(3.5,0.3,"Delivery Date                   % of Quantity to Deliver",1,1,'C');
    $sql39 = "select * from posch where PO_NO = '$po_no' order by DLV_DT";
    $result39=mysqli_query($cstccon,$sql39);
    $p = 1;
    while($row39 = mysqli_fetch_array($result39)){
     if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    
    $dlv_dt1 = $row39['DLV_DT']; $dlv_qty1 = $row39['DLV_QTY'];  
    $dlv_dt1 = substr($dlv_dt1,8,2) . '-' . substr($dlv_dt1,5,2) . '-' . substr($dlv_dt1,0,4) ;
    
    $pdf->setXY(6.2, $y);
    $pdf->Cell(2.8,0.2,$dlv_qty1,1,1,'C');
    $pdf->setXY(9.0, $y);
    $pdf->Cell(1.6,0.2,$dlv_dt1 ,1,1,'C');
    $y = $y + .3; 
    if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    
   // $pdf->setXY(6.2, $y);
   // $dlv_dt1 = $row39['DLV_DT']; $dlv_qty1 = $row39['DLV_QTY'];    
   // $pdf->Cell(1.50,0.3,$dlv_dt1 ,0,0,'C');
   // $pdf->setXY(3.0, $y);
   // $pdf->Cell(5.0,0.3,$dlv_qty1,0,0,'C');    
      //$y = $y + .2;  
     $i = $i + 1;   
        
       
        
        
        $p =$p +1 ;
    }
    
    

    
$y = $y + .1;  
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $y = $y + .1;  
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }

$y = $y + .1;
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $y = $y + .1;
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $y = $y + .1;
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
$pdf->SetFont('Arial','',11);
    $pdf->setXY(1.0, $y);
    $pdf->Cell(0,0, "TERMS AND CONDITION :");
$y = $y + .2;   
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $pdf->setXY(1.0, $y);
    $pdf->Cell(0,0, "1. Vendor has to acknowledge receipt of this PO and confirm the delivery schedule as indicated.");
$y = $y + .2;   
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $pdf->setXY(1.0, $y);
    $pdf->Cell(0,0, "2. Payment will be made through ECS only. Vender has to fill-in and submit Mandate Form as formality to clear payment.");
$y = $y + .2;   
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $pdf->setXY(1.0, $y);
    $pdf->Cell(0,0, "3. Other Terms & Condition of the PO will be as per the Enquiry/Tender/RfP published.");
$y = $y + .2;   
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $pdf->setXY(1.0, $y);
    $pdf->Cell(0,0, "4. EMD (if any) has been converted to Security Deposit which will carry no interest and will refunded after successful execution of the order.");
        
$y = $y + 0.8;  
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $pdf->setXY(8.0, $y);
    $pdf->Cell(0,0, "Controller of Stores and Purchase.");

$pdf->SetFont('Arial','I',11);
$y = $y + .2; 
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.8;
 	$i = 0;	
    }
    $pdf->setXY(1.0, $y);
    $pdf->MultiCell(10.5, 0.2, 'NOTE : ' . $note, 1, 'L', TRUE);
    //$pdf->Cell(1.0,0.3,$note,1,1,'C');

$pdf->SetFont('Arial','',11);
 
$y = $pdf->getY() + 0.3;   
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 5.0;
 	$i = 0;	
    }
    $pdf->setXY(1.0, $y);
    $pdf->Cell(0,0, "Copy for information to : 1) CAO-cum-FA  2) A.O.(Bill) 3) Internal Audit 4) R.A.O. 5) Store Keeper ");

$y = $y + 0.8;   
if ($y > $max)
    {
        $pdf->AddPage();
	$y = 4.3;
 	$i = 0;	
    }
    $pdf->setXY(8.0, $y);
    $pdf->Cell(0,0, "Controller of Stores and Purchase.");




//$pdf->Output( "Purchase_Order.pdf", "I" );
//}
//$pdf->Output();

ob_clean();
if($amd_no > 0){
$po_no_disp = $po_no . $amd_no ;}
else {
$po_no_disp = $po_no ;}
   
    $filename="REPORT/PO_Order/" . trim($po_no_disp) . ".pdf";
$filename=preg_replace('/\s+/', '', $filename);

$pdf->Output($filename,'F');
$text = "Purchase Order Number " .   $po_no . " Created / Modified Successfully" ;

?>
    <script type="text/JavaScript">
     alert("<?php echo $filename ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   