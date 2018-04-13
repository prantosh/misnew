<?php
ob_start ();
if(isset($_POST['po_no1']))
//1{{
    {

require_once('Connections/cstccon.php');

require_once('number2word.php');
session_start();

$po_no=htmlspecialchars($_POST['po_no1'],ENT_QUOTES);
$ofr_dt=htmlspecialchars($_POST['ofr_date'],ENT_QUOTES);
$ofr_dt = substr($ofr_dt,6,4) . '-' . substr($ofr_dt,3,2) . '-' . substr($ofr_dt,0,2) ;

$unt_id = htmlspecialchars($_POST['unt_id'],ENT_QUOTES);
$bill_no = htmlspecialchars($_POST['bill_no'],ENT_QUOTES);
$advnc_no = '';
$bill_dt = htmlspecialchars($_POST['bill_dt'],ENT_QUOTES);
$bill_dt = substr($bill_dt,6,4) . '-' . substr($bill_dt,3,2) . '-' . substr($bill_dt,0,2) ;
$rmk = htmlspecialchars($_POST['rmk'],ENT_QUOTES);
$vnd_id = htmlspecialchars($_POST['vnd_id'],ENT_QUOTES);
$vnd_nm = htmlspecialchars($_POST['vnd_nm'],ENT_QUOTES);
$po_dt = htmlspecialchars($_POST['po_dt'],ENT_QUOTES);
//$po_dt = substr($po_dt,6,4) . '-' . substr($po_dt,3,2) . '-' . substr($po_dt,0,2) ;
$cur_fin_yr = $_SESSION['CUR_FIN_YR'];
//echo $ofr_dt . '*' . $bill_dt . '*' . $po_dt ;
$user_id = $_SESSION['USER_ID'];

$i = 0;

$sql_itm="select A.PART_NO,A.ITM_NM,A.UOM_ID,B.PO_LINE,B.OFR_QTY,B.OFR_VAL FROM itm A,billitm_temp B where A.PART_NO = B.PO_LINE AND B.OFR_QTY > 0";
$result3=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result3) > 0)
// 2 {
    {
$sql1 = "select max(substring(BIL_ID,length(BIL_ID) - 3,4)) MAX_ID FROM bill where FIN_YR = '" . $cur_fin_yr . "'";
$result1=mysqli_query($cstccon,$sql1);
if(mysqli_num_rows($result1) > 0){
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;}
else { $new_number = 1;}
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}
if($unt_id != ''){
$bil_id = $unt_id . $cur_fin_yr . $new_number;

}  

$sql1 = "select max(substring(ADVNC_NO,10,2)) MAX_ID FROM bill where ORD_NO = '" . $po_no . "'";
$result1=mysqli_query($cstccon,$sql1);
if(mysqli_num_rows($result1) > 0){
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;}
else { $new_number = 1;}
//if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '0' . $new_number ;}
//if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}

$advnc_no = 'AP' . $po_no . $new_number;
        

require('fpdf.php');

class PDF extends FPDF
// 3{
{
    protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';
// Page header
function Header()
// 4 {
{
global $unit;
global $bil_id;
global $vnd_id;
global $vnd_nm;
global $unt_id;
global $advnc_no;
global $ofr_dt;
global $bill_no;
global $bill_dt;
global $rmk ;
global $unit ;
global $unt_id ;
global $po_no;
global $po_dt;
global $cur_fin_yr;
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
    $this->Cell(0,0,"               ADVANCE PROPOSAL                                   " );
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
    //$this->Cell(0,0,"VAT RC NO. 19661710075                                  " );
    
    $y = $y + .2; 
        
    $this->setXY(1.6, $y);
    $this->Cell(0,0,"5, Nilgunj Road. Kolkata - 700 056                                   " );
    $this->setXY(8.9, $y);
    $this->SetFillColor(192);
    $this->Rect(7,  1.3, 4.5, '0.4', 'DF');
 
    $y = $y + .2; 
    
    $this->setXY(1.3, $y);
    $this->Cell(0,0,"Phone: 033-25532090, Fax: 033-25533017                                   " );
    
     $po_dt_disp = substr($po_dt,8,2) . '-' . substr($po_dt,5,2) . '-' . substr($po_dt,0,4);

    $this->SetFillColor(0);
    $this->setXY(7.0, $y);
    $this->Cell(0,0,"PROPOSAL NO.: " . $advnc_no . "        DATE : " . $ofr_dt);
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
    $this->Cell(0,0,"PURCHASE ORDER DETAIL :                                   " );
    $y = $y + .3; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"Code: " . $vnd_id  );
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"ORDER NO. " . $po_no );
    $y = $y + .2; 
    $this->setXY(1.0, $y);
    $this->Cell(0,0, $vnd_nm  );
    $this->setXY(8.0, $y);
    $this->Cell(0,0,"ORDER DATE : " . $po_dt_disp );
    $y = $y + .2; 
   
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"INVOICE NO. : " . $bill_no . " ; DATE : " . $bill_dt );
   
   $y = $y + .3; 
   
    $this->setXY(1.0, $y);
    $this->Cell(0,0,"MODE OF PAYMENT : 100% ADVANCE AGAINST PI. THROUGH " );
    $this->Rect(5.8, $y, 0.15, 0.15);
     $this->Rect(6.8, $y, 0.15, 0.15);
  $y = $y + .1;   
    $this->setXY(6.0, $y);
    $this->Cell(0,0,"CHEQUE" ); 
    $this->setXY(7.0, $y);
    $this->Cell(0,0,"NET BANKING" );    
       
    $y = $y + .4; 
    $this->SetFont('Arial','U',11);
    $this->setXY(1.0, $y);
    $this->Cell(0,0, "DETAILS OF MATERIALS FOR PAYMENT :");
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
	$this->Cell(0.8,0.3,"FOLIO NO." ,1,1,'C',true);
        $this->setXY(2.5, $y);
	$this->Cell(1.6,0.3,"PART NO." ,1,1,'C',true);
        $this->setXY(4.1, $y);
	$this->Cell(3.0,0.3,"DESCRIPTION" ,1,1,'C',true);
        $this->setXY(7.1, $y);
	$this->Cell(1.0,0.3,"UNIT" ,1,1,'C',true);
        $this->setXY(8.1, $y);
	$this->Cell(1.0,0.3,"QUANTITY" ,1,1,'C',true);
        $this->setXY(9.1, $y);
	$this->Cell(1.3,0.3,"VALUE(Rs.)" ,1,1,'C',true);
       

$this->setFillColor(255,255,255);
// 4 }
}}

// ******************************* put page header
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
$y=$y + 3.4;
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
	$folio_no 		= $row3['PO_LINE'];
        $ofr_qty 		= $row3['OFR_QTY'];
        $ofr_val 		= $row3['OFR_VAL'];
        $itm_nm                 = $row3['ITM_NM'];
        $uom_id                 = $row3['UOM_ID'];
        
        $sql_itm1="select ALT_NO_3 FROM current_part_no where PART_NO = '" . $folio_no . "'";
        $result1=mysqli_query($cstccon,$sql_itm1);
        $row1 = mysqli_fetch_array($result1);
        $part_no = $row1['ALT_NO_3'];
        
        $total_value = $total_value + $ofr_val;
        
    	$y = $y + .25; 
        
        
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0.7,0.3,$srl ,1,1,'C',true);
        $pdf->setXY(1.7, $y);
	$pdf->Cell(0.8,0.3,$folio_no ,1,1,'C',true);
        $pdf->setXY(2.5, $y);
	$pdf->Cell(1.6,0.3,$part_no ,1,1,'C',true);
        $pdf->setXY(4.1, $y);
	$pdf->Cell(3.0,0.3,$itm_nm ,1,1,'C',true);
        $pdf->setXY(7.1, $y);
	$pdf->Cell(1.0,0.3,$uom_id ,1,1,'C',true);
        $pdf->setXY(8.1, $y);
	$pdf->Cell(1.0,0.3,$ofr_qty ,1,1,'R',true);
        $pdf->setXY(9.1, $y);
	$pdf->Cell(1.3,0.3,$ofr_val ,1,1,'R',true);
	
        $sql51="delete from billitm where BIL_ID = '" . $bil_id . "' and PO_LINE = '" . $folio_no . "'";
        $result51=mysqli_query($cstccon,$sql51);
	
        $sql5="insert into billitm(BIL_ID,PO_LINE,OFR_QTY,OFR_VAL,CREUSR,CREDT) values('" . $bil_id . "','" . $folio_no . "'," . $ofr_qty . "," . $ofr_val . ",'" . $user_id . "',now())";
        $result5=mysqli_query($cstccon,$sql5);
        
        $srl = $srl + 1;
        $line = $line + 1;
}

        $sql52="delete from bill where BIL_ID = '" . $bil_id . "'";
        $result52=mysqli_query($cstccon,$sql52);
	
        $sql53="insert into bill(BIL_ID,UNT_ID,FIN_YR,SBACT,ORD_NO,BILL_NO,BILL_DT,AP10,RMK,ADVNC_NO,ORD_DT,CREUSR,CREDT) values('" . $bil_id . "','" . $unt_id . "','" . $cur_fin_yr . "','" . $vnd_id . "','" . $po_no . "','" . $bill_no . "','" . $bill_dt . "'," . $total_value . ",'" . $rmk . "','" . $advnc_no . "','" . $po_dt . "','" . $user_id . "',now())";
        $result53=mysqli_query($cstccon,$sql53);
       


$y = $y + .4; 
        $pdf->setXY(1.0, $y);
        $pdf->Cell(8.7,0.3,'Total Amount of the Advance Proposal : Rs.' . number_format($total_value,2) . '(' . convert_number($total_value) . ')' ,1,1,'L',true);
$y = $y + 1.4;
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0,0,'Signature of D.A.                                                                             Controller of Stores & Purchase');
$y = $y + 0.3;
        
        $pdf->SetFont('Arial', 'U', 10);       
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0,0,'To be filled in by Bill Section');
        
        $y = $y + 0.3;
        
        $pdf->SetFont('Arial', '', 10);       
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0,0,'ADVANCE C.B No. .......................................................................................DATE ....................................DRAWN ..........................................................');

$y = $y + 1.4;
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0,0,'Signature of D.A.                                                                             Accounts Officer');

$y = $y + 0.3;
        
        $pdf->SetFont('Arial', 'U', 10);       
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0,0,'To be filled in by Cash Section');
        
        $y = $y + 0.3;
        
        $pdf->SetFont('Arial', '', 10);       
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0,0,'CHEQUE NO. / REFERENCE NO.. .......................................................................................DATE OF PAYMENT....................................');
$y = $y + 1.4;
        $pdf->setXY(1.0, $y);
        $pdf->Cell(0,0,'Signature of Cashier                ');


$html = '<a href="CSTC_MainMenu.php">BACK</a>';

//$pdf->WriteHTML($html);
 $sql521="delete from billitm_temp";
 $result521=mysqli_query($cstccon,$sql521);
//$pdf->Output( "slip.pdf");
 
 ob_clean();
$filename="REPORT/Purchase_Proposal/" . $advnc_no . ".pdf";
//$pdf->Output('Voucher.pdf','D');
$pdf->Output($filename,'F');
$text = "Payment Proposal No. " . $advnc_no . " Created Successfully" ;
?>
    <script type="text/JavaScript">
     alert("<?php echo $text ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   
<?php
    }}?>
 
 
 
 
 
 