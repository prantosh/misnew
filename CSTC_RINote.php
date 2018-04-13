<?php
ob_start ();
require_once('Connections/cstccon.php');
require_once('number2word.php');
session_start();
$cur_fin_yr = $_SESSION['CUR_FIN_YR'];
$unit    		= $_SESSION['unit_to'];
//$unit_from    		= $_SESSION['unit_from'];
//$unit_from    		= $_SESSION['unit_from'];
//$bill_no 		= htmlspecialchars($_POST['bill_no'],ENT_QUOTES);
$user_id = $_SESSION['USER_ID'];
$remark = $_SESSION['remark'];
//require_once('Numbers/Words.php');



$query32qn = "SELECT * from item_receive_ctrl";
$result32qn = mysqli_query($cstccon,$query32qn) or die(mysqli_error());
$row32qn = mysqli_fetch_assoc($result32qn);

$gstin = $row32qn['GSTIN'];






$sql = "select * from item_receive_temp";
$result=mysqli_query($cstccon,$sql);
$row = mysqli_fetch_array($result);
$po_no = $row['PO_NO'];
$mat_rct_no = $row['MAT_RCT_NO'];
$bntxn_id = $row['BNTXN_ID'];
$rcvd_at = $row['RCVD_AT'];
$challan_no = $row['challan_no'];
$challan_date = $row['challan_date'];
$challan_date = substr($challan_date,8,2) . '-' . substr($challan_date,5,2) . '-' . substr($challan_date,0,4);
$CREDT = $row['CREDT'];



$sql6 = "select * from po where PO_NO = '$po_no'";
$result6=mysqli_query($cstccon,$sql6);
$row6 = mysqli_fetch_array($result6);
$vnd_id = $row6['VND_ID'];
$po_dt = $row6['PO_DT'];
$po_dt = substr($po_dt,8,2) . '-' . substr($po_dt,5,2) . '-' . substr($po_dt,0,4);

$sql61 = "select * from item_receive_temp where PO_NO = '$po_no'";
$result61=mysqli_query($cstccon,$sql61);
$row61 = mysqli_fetch_array($result61);


$handle_pack = $row6['F08'];
$freight = $row6['F09'];

$sql61 = "select * from vnd where VND_ID = '$vnd_id'";
$result61=mysqli_query($cstccon,$sql61);
$row61 = mysqli_fetch_array($result61);
$vnd_nm = $row61['VND_NM'];
$addr_1 = $row61['ADDR_1'];
$addr_2 = $row61['ADDR_2'];
$addr_3 = $row61['ADDR_3'];
$zip = $row61['ZIP'];


$sql11 = "select * from unit where UNIT_CODE in (select RCVD_AT from item_receive_temp)";
$result11=mysqli_query($cstccon,$sql11);
$row11 = mysqli_fetch_array($result11);
$unit_desc = $row11['UNIT_DESC'];
$unit_code = $row11['UNIT_CODE'];





$sql3 = "select * from item_receive_temp A,itm B where A.PART_NO = B.PART_NO AND A.INV_QTY - A.SHORT_QTY > 0";
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
global $amd_no ;
global $amd_dt ;
global $vnd_id ;
global $ofr_no;
global $dlv_dt;
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
global $gstin;
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
global $unit;
global $unit_from;
global $bntxn_id;
global $mat_rct_no;
global $po_no;
global $po_dt;
global $challan_no;
global $challan_date;
global $vnd_id;
global $vnd_nm;
global $addr_1;
global $addr_2;
global $addr_3;
global $zip;
global $total_value;
global $freight;
global $handle_pack;
global $user_id;
$unit = $_SESSION['unit_to'];
global $CREDT;
//$unit_from = $_SESSION['unit_from']; 
global $v_no; 
global $unit_desc;
global $iss_val_tot;

$date =  date("F j, Y");
//$new_time = date('H:i', strtotime('+15 minutes'));
$time = date("H:i:s", strtotime('+210 minutes')); 
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    $y = 0.3;
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
    $this->Cell(0,0,"               RECEIPT AND INSPECTION NOTE                                   " );
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
    $this->Rect(8,  1.3, 3.5, '0.4', 'DF');
   
      
//$y = $y + .1; 
    

    $y = $y + .2; 
    
    $this->setXY(1.3, $y);
    $this->Cell(0,0,"Phone: 033-25532090, Fax: 033-25533017                                   " );
    
     $po_dt_disp = substr($po_dt,8,2) . '-' . substr($po_dt,5,2) . '-' . substr($po_dt,0,4);

    $this->SetFillColor(0);
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"GRN NO.: " . $bntxn_id . "   :" . $CREDT);
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
    $this->Cell(0,0,"RECEIPT NO : " . $mat_rct_no );
    $y = $y + .3; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"Code: " . $vnd_id  );
    $this->setXY(2.5, $y);
    $this->Cell(0,0,"GSTIN: " . $gstin  );
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"PO NO. " . $po_no . " ; DATE : " . $po_dt);
    $y = $y + .2; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0, $vnd_nm  );
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"CHALLAN NO. : " . $challan_no . " ; DATE : " . $challan_date );
    $y = $y + .2; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0, $addr_1 . ', ' . $addr_2   );
    $this->setXY(8.0, $y);
    $this->SetFont('Arial','B',11);
    //$this->Cell(0,0,"DELIVERY TERMS :                                   " );
    $this->SetFont('Arial','',11);
    $y = $y + .2; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0, $addr_3 . " "  . $zip);
    
    $this->setXY(8.0, $y);
    $this->Cell(0,0, "OPERATOR CODE: " . $user_id);
    
   
    
    $y = $y + .2;
    $this->setXY(1.0, $y);
    $this->Cell(3.0,0.4,'FREIGHT CHARGE = Rs.' . $freight  ,1,1,'C');
    $this->setXY(4.2, $y);
    $this->Cell(4.1,0.4,'HANDLING & PACKAGING CHARGE = Rs.' . $handle_pack ,1,1,'C');
    //$this->setXY(8.5, $y);
    //$this->Cell(3.0,0.4,"LAST DATE OF DELIVERY :" . $dlv_dt  ,1,1,'C');
    $y = $y + .7; 
    $this->SetFont('Arial','U',11);
    $this->setXY(1.0, $y);
    $this->Cell(0,0, "DETAILS OF MATERIALS RECEIVED :");
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
	$this->Cell(3.0,0.3,"DESCRIPTION" ,1,1,'C',true);
        $this->setXY(7.3, $y);
	$this->Cell(0.7,0.3,"UNIT" ,1,1,'C',true);
        $this->setXY(8.0, $y);
	$this->Cell(1.3,0.3,"UNIT PRICE(Rs.)" ,1,1,'C',true);
$y = $y + .1; 
   // $this->Line(1,$y,11.5,$y);
    $y = $y + .2; 
$this->setFillColor(200,200,200);
$this->SetFont('Arial', '', 10);
	
	$this->setXY(1.7, $y);
	$this->Cell(1.0,0.3,"INVOICE QTY." ,1,1,'C',true);
        $this->setXY(2.7, $y);
	$this->Cell(1.2,0.3,"RECEIVED QTY." ,1,1,'C',true);
        $this->setXY(3.9, $y);
	$this->Cell(1.2,0.3,"DISCOUNT (%)" ,1,1,'C',true);
        $this->setXY(5.1, $y);
	$this->Cell(0.8,0.3,"IGST (%)" ,1,1,'C',true);
        $this->setXY(5.9, $y);
	$this->Cell(0.8,0.3,"SGST (%)" ,1,1,'C',true);
        $this->setXY(6.7, $y);
	$this->Cell(0.8,0.3,"CGST (%)" ,1,1,'C',true);
        $this->setXY(7.5, $y);
	$this->Cell(1.5,0.3,"GROSS VALUE(Rs.)" ,1,1,'C',true);      
        $this->setXY(9.0, $y);
	$this->Cell(1.0,0.3,"STOCK" ,1,1,'C',true);      
        $this->setXY(10.0, $y);
	$this->Cell(1.5,0.3,"PENDING PO QTY." ,1,1,'C',true);      
        

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
$max = 17;
$y=$y + 4.0;
$line = 1;
$total_value = 0;	
while($row3 = mysqli_fetch_array($result3))
{
    
//If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();
	$y = 1.1;
 	$i = 0;	
    }
	$part_no 		= $row3['PART_NO'];
        $itm_nm 		= $row3['ITM_NM'];
        $uom_id 		= $row3['UOM_ID'];
        $spec                   = $row3['ITM_NM'];
        $igst                   = $row3['igst'];
        $cd                     = $row3['cd'];
        $sgst                   = $row3['sgst'];
        $cgst                   = $row3['cgst'];
        $inv_qty                = $row3['INV_QTY'];
        $rct_qty                = $row3['INV_QTY'] - $row3['SHORT_QTY'] ;
        $alt_no                 = $row3['ALT_NO'];
        $qty = $rct_qty;
        $gross_val              = $row3['GROSS_VAL'];
        
         $cd_val = $gross_val * $cd / 100 ;
         $igst_val = ($gross_val - $cd_val) * $igst / 100 ;
         $cgst_val = ($gross_val - $cd_val) * $cgst / 100 ;
         $sgst_val = ($gross_val - $cd_val) * $sgst / 100 ;
         
        $gross_val_new = $gross_val - $cd_val + $igst_val + $cgst_val + $sgst_val ;
        
        $total_value = $total_value + $gross_val_new;
        if($line == 1){
            $y = $y + .4; 
        }
        else{
    	$y = $y + .3; 
        }
    $sql34 = "select * from poitm where PO_NO = '$po_no' and PART_NO = '$part_no'";
$result34=mysqli_query($cstccon,$sql34);
$row34 = mysqli_fetch_array($result34);
        $unt_rt = $row34['UNT_RT'];
        $pending_qty = $row34['PO_QTY'] - $row34['RCT_QTY'] ;     
	
	$pdf->SetFont('Arial', '', 10);
	$pdf->setXY(1.0, $y);
        $pdf->Cell(0.7,0.3,$srl ,1,1,'C',true);
	$pdf->setXY(1.7, $y);
	$pdf->Cell(1.0, 0.3, $part_no ,1,1,'C',true);
        $pdf->setXY(2.7, $y);
	$pdf->Cell(1.6, 0.3, $alt_no,1,1,'C',true);
        $pdf->setXY(4.3, $y);
	$pdf->Cell(3.0, 0.3, $spec ,1,1,'C',true);
        $pdf->setXY(7.3, $y);
        $pdf->Cell(0.7, 0.3, $uom_id,1,1,'C',true);
	$pdf->setXY(8.0, $y);
	$pdf->Cell(1.3, 0.3, number_format(round($unt_rt,0),2),1,1,'R',true);
        

	
     $y = $y + .3;  
          
          
        $pdf->setXY(1.7, $y);
	$pdf->Cell(1.0, 0.3, number_format($inv_qty,2),1,1,'R');
        $pdf->setXY(2.7, $y);
	$pdf->Cell(1.2, 0.3, number_format($rct_qty,2),1,1,'R');
        $pdf->setXY(3.9, $y);
	$pdf->Cell(1.2, 0.3, number_format($cd,2),1,1,'R');
        $pdf->setXY(5.1, $y);
	$pdf->Cell(0.8, 0.3, number_format($igst,2),1,1,'R');
        $pdf->setXY(5.9, $y);
	$pdf->Cell(0.8, 0.3, number_format($sgst,2),1,1,'R');
        $pdf->setXY(6.7, $y);
	$pdf->Cell(0.8, 0.3, number_format($cgst,2),1,1,'R');
        $pdf->setXY(7.5, $y);
	$pdf->Cell(1.5, 0.3, number_format(round($gross_val,0),2),1,1,'R');
$sql341 = "select * from bincrd where PART_NO = '$part_no' and FIN_YR = '$cur_fin_yr'";
$result341=mysqli_query($cstccon,$sql341);
$row341 = mysqli_fetch_array($result341);
        $stock = $row341['OPNG_QTY'] + $row341['RCT_QTY'] - $row341['ISS_QTY'] ;

$sql347 = "update item_receive_temp set STOCK = '$stock' where PART_NO = '$part_no'";
$result347=mysqli_query($cstccon,$sql347);


        
        $pdf->setXY(9.0, $y);
        $pdf->Cell(1.0, 0.3, number_format($stock,2),1,1,'R');
	//$pdf->Cell(1.0, 0.3, number_format($stock,2),1.1,'R');
        $pdf->setXY(10.0, $y);
	$pdf->Cell(1.5, 0.3, number_format($pending_qty,2),1,1,'R');
        
	$srl = $srl + 1;
        $line = $line + 1;
}

$y = $y + .6; 
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(0.5, $y);
$pdf->Cell(0, 0, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$total_value = $total_value + $freight + $handle_pack;
$y = $y + .2; 
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(3.7, $y);
$pdf->Cell(1.0, 0, 'TOTAL VALUE OF THIS RI NOTE IS Rs.' . number_format(round($total_value,0),2),0,0,'R');

$y = $y + .2; 
$pdf->SetFont('Arial', 'I', 8);
$pdf->setXY(0.5, $y);
$pdf->Cell(1.0, 0, 'Remark : ' . $remark);




$y = $y + .2; 
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(0.5, $y);
$pdf->Cell(0, 0, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');

 
        




$y = $y + 1.4; 
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(0.5, $y);
$pdf->Cell(0, 0, 'Checked & Received By');
$pdf->setXY(3.5, $y);
$pdf->Cell(0, 0, 'Priced & Posted By');
$pdf->setXY(6.0, $y);
$pdf->Cell(0, 0, 'Bin By');
$pdf->setXY(8.5, $y);
$pdf->Cell(0, 0, 'Store Keeper');

$y = $y + .2; 
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(0.5, $y);
$pdf->Cell(0, 0, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');



//*****************************************************
$sql31 = "insert into item_receive_detail (select * from item_receive_temp where INV_QTY - SHORT_QTY > 0)";
$result31=mysqli_query($cstccon,$sql31);


$_SESSION['po_no'] = '';
//$sql7 = "delete from item_receive_temp";
//$result7=mysqli_query($cstccon,$sql7);
//$pdf->Output( "slip.pdf");
//$pdf->Output();

   

ob_clean();
$filename="REPORT/RI_Note/" . $mat_rct_no . ".pdf";

$pdf->Output($filename,'F');
$text = "Material Receipt Number " . $mat_rct_no . " Created Successfully" ;
?>
    <script type="text/JavaScript">
     alert("<?php echo $text ; ?>");
    
     document.location="CSTC_MainMenu_ajax.php";

</script>   