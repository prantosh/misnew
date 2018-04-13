<?php
ob_start ();
error_reporting(E_ERROR|E_WARNING);
require('fpdf.php');

require_once('Connections/cstccon.php');
//require_once('number2word.php');
session_start();
$user_id = $_SESSION['USER_ID'];
$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$sql3S = "select * from purreqitm_temp";
$result3S=mysqli_query($cstccon,$sql3S);
if(mysqli_num_rows($result3S) > 0){


$unit    		= $_SESSION['unit_to'];

$cur_fin_yr             = $_SESSION['CUR_FIN_YR'];

$user_id = $_SESSION['USER_ID'];



$sql11 = "select * from unit where UNIT = '" . $unit . "'";
$result11=mysqli_query($cstccon,$sql11);
$row11 = mysqli_fetch_array($result11);
$unit_desc = $row11['UNIT_DESC'];
$unit_code = $row11['UNIT_CODE'];



$sql1 = "select max(substring(PUR_REQ_ID,length(PUR_REQ_ID) - 3,4)) MAX_ID FROM purreq where substring(PUR_REQ_ID,2,2) = '" . $cur_fin_yr . "'";
$result1=mysqli_query($cstccon,$sql1);
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}
if($unit != ''){
$v_no = $unit_code . $cur_fin_yr . $new_number;

$sql4 = "insert into purreq(PUR_REQ_ID,UNT_ID,REQ_DT,CLS,CREUSR,CREDT) VALUES('" . $v_no . "','$unit_code',now(),'P','" . $_SESSION['UNAME'] . "',NOW())";
$result4=mysqli_query($cstccon,$sql4);



}


//require('pdfb/pdfb.php');

class PDF extends FPDF
{

// Page header
function Header()
{
global $unit;

global $user_id;
global $v_no; 
global $unit_desc;
global $iss_val_tot;
global $indent_id;
$date =  date("F j, Y");

$time = date("H:i:s", strtotime('+330 minutes')); 

    $y = 0.3;
    $this->SetFont('Arial','',11);
    $this->Rect(.2,0.1,11.5,14.5);
    $y = $y + .3; 
    
    $image1 = "images/cstclogo.jpg";
    $this->setXY(1.0, $y);
    $this->Cell( 0,0, $this->Image($image1, 1.0,0.15, 0.8), 0, 0, 'L', false );
    $this->setXY(4.0, $y);
    $this->SetFont('Arial','B',16);
    $this->Cell(0,0,"               PURCHASE REQUISITION                                   " );
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
    
     $po_dt_disp = substr($po_dt,8,2) . '-' . substr($po_dt,5,2) . '-' . substr($po_dt,0,4);

    $this->SetFillColor(0);
    $this->setXY(7.0, $y);
    $this->Cell(0,0,"REQUISITION NO.: " . $v_no  ." : " . $date . " : " . $time);
    $this->setXY(9.9, $y);
    
    $y = $y + .2; 
    
    $this->setXY(1.2, $y);
    //$this->Cell(0,0,"Web: www.cstc.org.in, Email: cosp@cstc.org.in                                   " );
   
    $this->Line(1,$y,4.6,$y);
    $y = $y + .2; 
    $this->setXY(1.0, $y);
    
    $this->Cell(0,0,"CENTRAL STORES AND PURCHASE                                   " );
    $this->setXY(8.0, $y);
    $this->Cell(0,0, "OPERATOR CODE: " . $user_id);
   
    
 

$y = $y + .2; 
$this->SetFont('Arial', '', 10);
$this->setXY(1.0, $y);
$this->Line(1,$y,11.5,$y);
// $this->Cell(0, 0, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + .2; 
$this->SetFont('Arial', '', 11);
$this->setXY(0.5, $y);
$this->SetFont('Arial', '', 10);
	$this->setXY(1.0, $y);
	$this->Cell(0.5, 0, 'SRL.' );
	//$pdf->setXY(1.3, $y);
	//$pdf->Cell(0, 0, '  MONTH: ');
	$this->setXY(1.5, $y);
	$this->Cell(0.7, 0, 'FOLIO NO' );
        $this->setXY(2.7, $y);
	$this->Cell(0.8, 0, 'PART NO' );
        $this->setXY(4.0, $y);
	$this->Cell(2.5, 0, 'DESCRIPTION' );
        $this->setXY(7.9, $y);
	$this->Cell(0.5, 0, 'UNIT' );
        $this->setXY(8.5, $y);
	$this->Cell(0.5, 0, 'STOCK' );
        $this->setXY(10.0, $y);
	$this->Cell(1.0, 0, 'PROPOSED QUANTITY',0,0,'R');
       

$y = $y + .2; 
$this->SetFont('Arial', '', 10);
$this->setXY(1.0, $y);
$this->Line(1,$y,11.5,$y);
}

// Page footer
function Footer()
{
    
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
            { $this->PutLink($this->HREF,$e);}
            else 
            {   $this->Write(5,$e);}
        }
        else
        {
            // Tag
            if($e[0]=='/'){
            $this->CloseTag(strtoupper(substr($e,1)));}
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
    { $this->SetStyle($tag,true);}
    if($tag=='A')
    {  $this->HREF = $attr['HREF'];}
    if($tag=='BR')
    {  $this->Ln(5);}
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
    { $this->SetStyle($tag,false);}
    if($tag=='A')
    {   $this->HREF = '';}
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
        {  $style .= $s;}
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

$pdf = new PDF('P','in',array(12,15));
//$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$y = 0.5;
//print column titles for the actual page
$pdf->SetFillColor(232, 232, 232);

$i = 0;
$srl = 1;

//Set maximum rows per page
$max = 14;
$y=$y + 2.2;



$sql3 = "select *  from purreqitm_temp order by PART_NO";
//$sql3 = "select * from purreqitm_temp A,itm B where A.PART_NO = B.PART_NO";
$result3=mysqli_query($cstccon,$sql3);
$part_no_prev = '';	
while($row3 = mysqli_fetch_array($result3))
{
    
//If the current row is the last one, create new page and print column title
    if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
	$part_no 		= $row3['PART_NO'];
        if($part_no != $part_no_prev){
        
        $sql33 = "select * from itm WHERE PART_NO = '" . $part_no . "'";
        $result33=mysqli_query($cstccon,$sql33);
        $row33 = mysqli_fetch_array($result33);
        
        $itm_nm 		= $row33['ITM_NM'];
        $uom_id 		= $row33['UOM_ID'];
        $spec                   = $row33['SPEC'];
        $query11 = "select ALT_NO_3 FROM current_part_no where PART_NO = '" . $part_no . "'";
        $result11=mysqli_query($cstccon,$query11);
        $row11 = mysqli_fetch_array($result11);
        $alt_no = $row11['ALT_NO_3'];
        
$sql3T = "select PART_NO,SUM(PUR_PLN_QTY) PUR_PLN_QTY_TOT  from purreqitm_temp where PART_NO = '" . $part_no . "' group by PART_NO";
$result3T=mysqli_query($cstccon,$sql3T); 
$row3T = mysqli_fetch_array($result3T);
        $qty                    = $row3T['PUR_PLN_QTY_TOT'];
        $indent_id               = $row3['INDNT_ID'];
  
        
        $sql_itm1="SELECT OPNG_QTY,ISS_QTY,RCT_QTY from bincrd where FIN_YR = '$CUR_FIN_YR' AND PART_NO = '" . $part_no . "'";
        $result_itm1=mysqli_query($cstccon,$sql_itm1);
        $row_itm1 =mysqli_fetch_array($result_itm1);
        $stock = $row_itm1['OPNG_QTY'] + $row_itm1['RCT_QTY'] - $row_itm1['ISS_QTY'] ;                       
        
        $qty = $qty - $stock ;
        
        $sql5 = "insert into purreqitm(PUR_REQ_ID,PART_NO,PUR_PLN_QTY,ITEM_NO,CREUSR,CREDT) values('" . $v_no . "','" . $part_no . "'," . $qty . ",'" . $alt_no . "','" . $user_id . "',NOW())";
        $result5=mysqli_query($cstccon,$sql5);

        
        
        $y = $y + .2; 
         if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }      
	
	$pdf->SetFont('Arial', '', 10);
	$pdf->setXY(1.0, $y);
	$pdf->Cell(0.3, 0, $srl,0,0,'R' );
     
	$pdf->setXY(1.5, $y);
	$pdf->Cell(0.7, 0, $part_no );
        $pdf->setXY(2.7, $y);
	$pdf->Cell(0.8, 0, $alt_no );
        $pdf->setXY(4.0, $y);
	$pdf->Cell(2.5, 0, $spec );
        $pdf->setXY(7.9, $y);
	$pdf->Cell(0.5, 0, $uom_id );
        $pdf->setXY(8.5, $y);
        
                              
        $pdf->Cell(0.5, 0, $stock ,0,0,'R');
        $pdf->setXY(10.0, $y);
    
	$pdf->Cell(1.0, 0, $qty ,0,0,'R');
     
         $y = $y + .25; 
          if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
       
        $sql_itmK="SELECT A.INDNT_ID,A.BUCKET_ID,A.PART_NO,A.REQ_DT,A.REQ_QTY,B.CC_ID from indntitm A,indnt B,purreqitm_temp C where A.INDNT_ID = C.INDNT_ID and A.INDNT_ID = B.INDNT_ID AND A.PART_NO = C.PART_NO AND C.PART_NO = '" . $part_no . "' and A.BUCKET_ID = 'Y'";
        $result_itmK=mysqli_query($cstccon,$sql_itmK);
       
        if(mysqli_num_rows($result_itmK)>0){
            $pdf->SetFont('Arial', 'U', 10);
            $pdf->setXY(1.5, $y);
	$pdf->Cell(0.5, 0, 'DETAILS OF INDENT RECEIVED : ' );
       
        $pdf->SetFont('Arial', 'U', 10);
	$pdf->setXY(5.0, $y);
	$pdf->Cell(0.5, 0, 'SRL.' );
	
	$pdf->setXY(5.4, $y);
	$pdf->Cell(0.7, 0, 'INDENT NO.' );
        $pdf->setXY(6.9, $y);
	$pdf->Cell(0.8, 0, 'INDENT DATE' );
        $pdf->setXY(8.4, $y);
	$pdf->Cell(2.5, 0, 'UNIT' );
        $pdf->setXY(9.4, $y);
	$pdf->Cell(0.5, 0, 'QUANTITY' );
        $z = 1; 
       
         $y = $y + .2; 
          if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
        $srlxx1 = 1;
       while($row_itmK = mysqli_fetch_array($result_itmK))
        { 
           
           if ($y >= $max)
                {
                    $pdf->AddPage();
                    $y = 2.7;
                   
                }
             
        $indnt_id    = $row_itmK['INDNT_ID'];
        $req_dt      = $row_itmK['REQ_DT'];
        $unit_disp   = $row_itmK['CC_ID'];
        $req_qty      = $row_itmK['REQ_QTY'];
           
        $pdf->SetFont('Arial', '', 10);
	$pdf->setXY(5.0, $y);
	$pdf->Cell(0.5, 0, $srlxx1 );
      
	$pdf->setXY(5.4, $y);
	$pdf->Cell(0.7, 0, $indnt_id );
        $pdf->setXY(6.9, $y);
	$pdf->Cell(0.8, 0, $req_dt );
        $pdf->setXY(8.4, $y);
	$pdf->Cell(2.5, 0, $unit_disp );
        $pdf->setXY(9.4, $y);
	$pdf->Cell(0.5, 0, $req_qty );
       
           
         $sql_itmF="UPDATE indntitm SET BUCKET_ID = 'N',PUR_REQ_ID = '" . $v_no . "' WHERE PART_NO = '" . $part_no . "' and INDNT_ID = '" . $indnt_id . "'";
         $result_itmF=mysqli_query($cstccon,$sql_itmF);  
           
         $y = $y + .2;   
          if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
         
         $srlxx1 = $srlxx1 + 1;

        }
}      
        $sql51 = "select * from poitm where PART_NO = '" . $part_no . "' and PO_QTY - RCT_QTY > 0";
        $result51=mysqli_query($cstccon,$sql51);
        if(mysqli_num_rows($result51) > 0){
         
        $y = $y + .2; 
         if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
        $pdf->SetFont('Arial', '', 11);
        $pdf->setXY(0.5, $y);
        $pdf->SetFont('Arial', 'U', 10);
	$pdf->setXY(1.5, $y);
	$pdf->Cell(0.5, 0, 'PENDING PURCHASE ORDER DETAILS : ' );
        
        $pdf->setXY(5.0, $y);
	$pdf->Cell(0.5, 0, 'SRL.' );
	//$pdf->setXY(1.3, $y);
	//$pdf->Cell(0, 0, '  MONTH: ');
	
        $pdf->setXY(5.4, $y);
	$pdf->Cell(0.8, 0, 'PENDING PO NO.' );
        $pdf->setXY(7.4, $y);
	$pdf->Cell(2.5, 0, 'PENDING QUANTITY' );
        $pdf->SetFont('Arial', '', 10);
$y = $y + .2; 
 if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
    $srlyy2 = 1;
        while($row51 = mysqli_fetch_array($result51))
        {
            
            if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
         
        $po_no = $row51['PO_NO']  ;  
        $po_qty =     $row51['PO_QTY']  ;  
        $rct_qty =     $row51['RCT_QTY']  ;  
        $pending_qty =  $po_qty -  $rct_qty ;  
        
        
        $pdf->setXY(5.0, $y);
	$pdf->Cell(0.3, 0, $srlyy2,0,0,'R' );
        //$pdf->Cell(0.3, 0, $tot_srl,0,0,'R' );
        
        $pdf->setXY(5.4, $y);
	$pdf->Cell(0.8, 0, $po_no );
        $pdf->setXY(7.4, $y);
	$pdf->Cell(1.5, 0, $pending_qty,0,0,'R' );
        $y = $y + .2; 
         if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
       $srlyy2 = $srlyy2 + 1;
        } 
        }
        $y = $y + .2; 
         if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
        $pdf->setXY(1.0, $y);
        $pdf->Line(1,$y,11.5,$y);

 $part_no_prev = $part_no ;
 $srl = $srl + 1;
        }
 
}

$y = $y + .2; 
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(1.0, $y);
//$pdf->Cell(0, 0, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');

if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    } 
        




$y = $y + 1.0; 
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(1.0, $y);
$pdf->Cell(0, 0, 'Prepared By');
$pdf->setXY(3.5, $y);
$pdf->Cell(0, 0, 'Store Keeper');
$pdf->setXY(6.0, $y);
$pdf->Cell(0, 0, 'Controller of Stores & Purchase');
//$pdf->setXY(8.5, $y);
//$pdf->Cell(0, 0, 'Store Keeper');
if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
$y = $y + .2; 
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(1.0, $y);
$pdf->Line(1,$y,11.5,$y);

//$pdf->Cell(0, 0, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
if ($y >= $max)
    {
        $pdf->AddPage();
	$y = 2.7;
 	
    }
$y = $y + .2; 
$pdf->setXY(1.0, $y);
//$pdf->Cell(0, 0, 'Receiver Copy');
//$html = '<a href="CSTC_MainMenu.php">BACK</a>';
$pdf->WriteHTML($html);

//*****************************************************



$_SESSION['unit_to'] = '';
$sql7 = "delete from purreqitm_temp";
$result7=mysqli_query($cstccon,$sql7);
ob_clean();
$filename="REPORT/purchase_requisition/" . $v_no . ".pdf";
$pdf->Output($filename,'F');
//$pdf->Output( "purchase_requisition/" . $v_no . ".pdf"  , "D" );
$text = "Purchase Requisition Number " . $v_no . " Created Successfully" ;
?>
    <script type="text/JavaScript">
     alert("<?php echo $text ; ?>");
     
</script>   
<?php
}
else
{?>
    <script type="text/JavaScript">
     alert("You have not issued any item");
     return false;
</script>   
<?php }
//$pdf->Output( "slip.pdf", "D" );

?>
<script type="text/JavaScript">
     document.location="CSTC_MainMenu.php";
</script>       



?>
