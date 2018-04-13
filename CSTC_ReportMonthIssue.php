<?php
ob_start ();
error_reporting(E_ERROR|E_WARNING);

require_once('Connections/cstccon.php');

session_start();
$cur_fin_yr = $_SESSION['CUR_FIN_YR'];

$date_from = htmlspecialchars($_POST['datepicker-default1'],ENT_QUOTES);
$date_to   = htmlspecialchars($_POST['datepicker-default2'],ENT_QUOTES);

$date_from_new = substr($date_from,6,4) . '-' . substr($date_from,3,2) . '-' . substr($date_from,0,2);
$date_to_new = substr($date_to,6,4) . '-' . substr($date_to,3,2) . '-' . substr($date_to,0,2);


$yr = substr($date_from,6,4);
$mth = substr($date_from,3,2);

$user_id = $_SESSION['USER_ID'];

        
$sql3 = "SELECT D.SBGRP_ID SBGRP_ID1,B.PRTY_CD PRTY_CD1,SUM(C.ITM_QTY) ITM_QTY1,SUM(C.ITM_VAL) ITM_VAL1 from bintxn B,bintxnitm C, itm D where B.CLS = 'MI' AND C.BNTXN_ID = B.BNTXN_ID AND C.PART_NO = D.PART_NO AND  B.DOC_DT >= '$date_from_new' AND B.DOC_DT <= '$date_to_new' GROUP BY D.SBGRP_ID,B.PRTY_CD";
$result3=mysqli_query($cstccon,$sql3);

$sql4 = "SELECT b.make make1,c.depot depot1, sum(a.trp_dn * a.sch_km / a.trp_sch) km1 from cstcmis.cb a,cstcmis.model_master b,cstcmis.veh0214 c where a.wb_date >= '$date_from_new' and a.wb_date <= '$date_to_new' and a.veh_no = c.vehno and b.model = c.model group by b.make,c.depot";       
$result4=mysqli_query($cstccon,$sql4);

$yrmth = substr($yr,2,2) . $mth ;

$sql5 = "SELECT a.unit depot1,b.make make1,sum(a.hsd) hsd1 from cstcmis.daily_record_model a,cstcmis.model_master b where a.model = b.model and a.op_date  >=  '$date_from_new' AND a.op_date <=  '$date_to_new' group by a.unit,b.make";

$result5=mysqli_query($cstccon,$sql5);    

$sql6 = "SELECT * from cstcmis.item_rate where mth = '$yrmth' and item = 'hsd'";
$result6=mysqli_query($cstccon,$sql6);  
$row6 = mysqli_fetch_array($result6) ;
$hsd_rate = $row6['rate'];

$sql31 = "SELECT B.PRTY_CD PRTY_CD1,SUM(C.ITM_QTY) ITM_QTY1,SUM(C.ITM_VAL) ITM_VAL1 from bintxn B,bintxnitm C, itm D where D.SBGRP_ID NOT IN('A01','A02','A07','H01','H02','H03','H04','D01','F06') AND B.PRTY_CLS != 'V' AND C.BNTXN_ID = B.BNTXN_ID AND C.PART_NO = D.PART_NO AND  B.DOC_DT) >= '$date_from_new' AND B.DOC_DT = '$date_to_new' GROUP BY B.PRTY_CD";
$result31=mysqli_query($cstccon,$sql31);


require('fpdf.php');

class PDF extends FPDF
{

function Header()
{
 
    
    global $unit;
global $yr;
global $mth;
global $unit_from;
global $user_id;
global $v_no; 
global $unit_desc;
global $iss_val_tot;
global $date;
global $time;
global $itm_qty_other_a01 ;
global $itm_qty_other_a02 ;
global $itm_qty_other_a07 ;
global $itm_qty_other_d01 ;
global $itm_qty_other_f06 ;
global $itm_qty_other_h01 ;
global $itm_qty_other_h01 ;
global $itm_qty_other_h04 ;
global $itm_val_other_a01 ;
global $itm_val_other_a02 ;
global $itm_val_other_a07 ;
global $itm_val_other_d01 ;
global $itm_val_other_f06 ;
global $itm_val_other_h01 ;
global $itm_val_other_h01 ;
global $itm_val_other_h04 ;

global $itm_qty_bd_a01 ;
global $itm_qty_bd_a02 ;
global $itm_qty_bd_a07 ;
global $itm_qty_bd_d01 ;
global $itm_qty_bd_f06 ;
global $itm_qty_bd_h01 ;
global $itm_qty_bd_h01 ;
global $itm_qty_bd_h04 ;
global $itm_val_bd_a01 ;
global $itm_val_bd_a02 ;
global $itm_val_bd_a07 ;
global $itm_val_bd_d01 ;
global $itm_val_bd_f06 ;
global $itm_val_bd_h01 ;
global $itm_val_bd_h01 ;
global $itm_val_bd_h04 ;

global $itm_qty_nd_a01 ;
global $itm_qty_nd_a02 ;
global $itm_qty_nd_a07 ;
global $itm_qty_nd_d01 ;
global $itm_qty_nd_f06 ;
global $itm_qty_nd_h01 ;
global $itm_qty_nd_h01 ;
global $itm_qty_nd_h04 ;
global $itm_val_nd_a01 ;
global $itm_val_nd_a02 ;
global $itm_val_nd_a07 ;
global $itm_val_nd_d01 ;
global $itm_val_nd_f06 ;
global $itm_val_nd_h01 ;
global $itm_val_nd_h01 ;
global $itm_val_nd_h04 ;
global $date_from ;
global $date_to ;

$date =  date("F j, Y");

$time = date("H:i:s", strtotime('+330 minutes')); 

    $y = 0.5;
    $this->SetFont('Arial','',11);
      
    $y = $y + .5; 
    $image1 = "images/wbtcBLACK.jpg";
$this->setXY(1.0, $y);
$this->Cell( 0,0, $this->Image($image1, 1.0,0.15, 0.8), 0, 0, 'L', false );
$y = 0.5;
    $this->setXY(4.0, $y);
    $this->Cell(0.5,0,"                 CENTRAL STORES AND PURCHASE                                   " . $date . '  ' . $time);
$y = $y + .2; 
$this->setXY(3.7, $y);
    $this->Cell(0.5,0,"                 WEST BENGAL TRANSPORT CORPORATION                                  " );
$y = $y + .2; 
$this->setXY(3.7, $y);
    $this->Cell(0.5,0,"                     (Calcutta State Transport Corporation)                                  " );
$y = $y + .5; 

if($mth == '01'){$mth_desc = 'JANUARY';}
if($mth == '02'){$mth_desc = 'FEBRUARY';}
if($mth == '03'){$mth_desc = 'MARCH';}
if($mth == '04'){$mth_desc = 'APRIL';}
if($mth == '05'){$mth_desc = 'MAY';}
if($mth == '06'){$mth_desc = 'JUNE';}
if($mth == '07'){$mth_desc = 'JULY';}
if($mth == '08'){$mth_desc = 'AUGUST';}
if($mth == '09'){$mth_desc = 'SEPTEMBER';}
if($mth == '10'){$mth_desc = 'OCTOBER';}
if($mth == '11'){$mth_desc = 'NOVEMBER';}
if($mth == '12'){$mth_desc = 'DECEMBER';}

$this->setFont("Arial","BU","10");
$this->setXY(0.8, $y);
$this->Cell(0.5,0,"UNIT WISE MATERIAL ISSUE DETAIL FROM " . $date_from . ' to ' . $date_to); 

$y = $y + .3; 
$this->SetFont('Arial', '', 10);
$this->setXY(1.0, $y);


//$this->setFillColor(200,200,200);
$this->SetFont('Arial', 'B', 9);
	$this->setXY(0.8, $y);
        $this->Cell(0.5,0,"SRL." );
	$this->setXY(1.2, $y);
	$this->Cell(0.5,0,"UNIT" );
        $this->setXY(2.3, $y);
	$this->Cell(0.5,0,"DESCRIPTION" );
        $this->setXY(3.5, $y);
	$this->Cell(0.5,0,"<-----------SPARES------------>" );
        $this->setXY(5.5, $y);
	$this->Cell(0.5,0,"<---------LUBRICANT--------->" );
        $this->setXY(7.4, $y);
	$this->Cell(0.5,0,"ADBLUE" );
        $this->setXY(8.2, $y);
	$this->Cell(0.5,0,"TYRE" );
        
        $this->setXY(8.8, $y);
	$this->Cell(0.5,0,"BATTERY" );
        $this->setXY(9.8, $y);
	$this->Cell(0.5,0,"HSD" );
        $this->setXY(10.4, $y);
	$this->Cell(0.5,0,"MISC" );
        $this->setXY(11.1, $y);
	$this->Cell(0.5,0,"TOTAL" );
        $y = $y + .2; 
        $this->SetFont('Arial', 'B', 9);
	$this->setXY(0.8, $y);
        $this->Cell(0.5,0,"NO." );
	$this->setXY(1.2, $y);
	$this->Cell(0.5,0,"" );
        $this->setXY(2.4, $y);
	$this->Cell(0.5,0,"" );
        $this->setXY(3.5, $y);
	$this->Cell(1.5,0,"TATA   LEYLAND    VOLVO" );
        $this->setXY(5.5, $y);
	$this->Cell(1.5,0,"TATA   LEYLAND    VOLVO" );
        $this->setXY(7.5, $y);
	$this->Cell(0.5,0,"" );
        $this->setXY(8.2, $y);
	$this->Cell(0.5,0,"" );
        
        $this->setXY(8.9, $y);
	$this->Cell(0.5,0,"" );
        $this->setXY(9.8, $y);
	$this->Cell(0.5,0,"" );
        $this->setXY(10.3, $y);
	$this->Cell(0.5,0,"" );
        $this->setXY(11.0, $y);
	$this->Cell(0.5,0,"" );
         
        $y = $y + .2; 
        $this->setXY(0.8, $y);
        $this->Cell(0.5,0, '--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
        $y = $y + .2; 

}






// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
   // $this->SetY(-3);
    // Arial italic 8
   // $this->SetFont('Arial','I',8);
    // Page number
    //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


}
$srl = 0;
$pdf = new PDF('P','in',array(12,15));
//$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//$y = 1.9;
//print column titles for the actual page
$pdf->SetFillColor(232, 232, 232);

$i = 0;
$srl = 1;
$line = 1;
$itm_qty_other_a01 = 0 ;
$itm_val_other_a01 = 0 ;
$itm_qty_other_a02 = 0 ;
$itm_val_other_a02 = 0 ;
$itm_qty_other_a07 = 0 ;
$itm_val_other_a07 = 0 ;
$itm_qty_other_h01 = 0 ;
$itm_val_other_h01 = 0 ;
$itm_qty_other_h02 = 0 ;
$itm_val_other_h02 = 0 ;
$itm_qty_other_h04 = 0 ;
$itm_val_other_h04 = 0 ;
$itm_qty_other_d01 = 0 ;
$itm_val_other_d01 = 0 ;
$itm_qty_other_f06 = 0 ;
$itm_val_other_f06 = 0 ;

while($row3 = mysqli_fetch_array($result3))
{
 //If the current row is the last one, create new page and print column title
    
	$sbgrp_id 		= $row3['SBGRP_ID1'];
        $prty_cd 		= $row3['PRTY_CD1'];
        $itm_qty 		= -$row3['ITM_QTY1'];
        $itm_val                = -$row3['ITM_VAL1'];
        
            if($sbgrp_id == 'A01'){
            if($prty_cd == 'BD'){$itm_qty_bd_a01 = $itm_qty;$itm_val_bd_a01 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_a01 = $itm_qty;$itm_val_nd_a01 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_a01 = $itm_qty;$itm_val_pd_a01 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_a01 = $itm_qty;$itm_val_md_a01 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_a01 = $itm_qty;$itm_val_sld_a01 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_a01 = $itm_qty;$itm_val_kd_a01 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_a01 = $itm_qty;$itm_val_gd_a01 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_a01 = $itm_qty;$itm_val_ld_a01 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_a01 = $itm_qty;$itm_val_td_a01 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_a01 = $itm_qty;$itm_val_tpd_a01 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_a01 = $itm_qty;$itm_val_hd_a01 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_a01 = $itm_qty;$itm_val_ues_a01 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_a01 = $itm_qty;$itm_val_cws_a01 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_a01 = $itm_qty;$itm_val_pp_a01 = $itm_val;}
          
            else{$itm_qty_other_a01 = $itm_qty_other_a01 + $itm_qty;$itm_val_other_a01 = $itm_val_other_a01 + $itm_val;}
            }
            if($sbgrp_id == 'A02'){
            if($prty_cd == 'BD'){$itm_qty_bd_a02 = $itm_qty;$itm_val_bd_a02 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_a02 = $itm_qty;$itm_val_nd_a02 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_a02 = $itm_qty;$itm_val_pd_a02 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_a02 = $itm_qty;$itm_val_md_a02 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_a02 = $itm_qty;$itm_val_sld_a02 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_a02 = $itm_qty;$itm_val_kd_a02 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_a02 = $itm_qty;$itm_val_gd_a02 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_a02 = $itm_qty;$itm_val_ld_a02 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_a02 = $itm_qty;$itm_val_td_a02 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_a02 = $itm_qty;$itm_val_tpd_a02 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_a02 = $itm_qty;$itm_val_hd_a02 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_a02 = $itm_qty;$itm_val_ues_a02 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_a02 = $itm_qty;$itm_val_cws_a02 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_a02 = $itm_qty;$itm_val_pp_a02 = $itm_val;}

            else{$itm_qty_other_a02 = $itm_qty_other_a02 + $itm_qty;$itm_val_other_a02 = $itm_val_other_a02 + $itm_val;}
            }
            if($sbgrp_id == 'A07'){
            if($prty_cd == 'BD'){$itm_qty_bd_a07 = $itm_qty;$itm_val_bd_a07 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_a07 = $itm_qty;$itm_val_nd_a07 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_a07 = $itm_qty;$itm_val_pd_a07 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_a07 = $itm_qty;$itm_val_md_a07 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_a07 = $itm_qty;$itm_val_sld_a07 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_a07 = $itm_qty;$itm_val_kd_a07 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_a07 = $itm_qty;$itm_val_gd_a07 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_a07 = $itm_qty;$itm_val_ld_a07 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_a07 = $itm_qty;$itm_val_td_a07 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_a07 = $itm_qty;$itm_val_tpd_a07 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_a07 = $itm_qty;$itm_val_hd_a07 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_a07 = $itm_qty;$itm_val_ues_a07 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_a07 = $itm_qty;$itm_val_cws_a07 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_a07 = $itm_qty;$itm_val_pp_a07 = $itm_val;}

            else{$itm_qty_other_a07 = $itm_qty_other_a07 + $itm_qty;$itm_val_other_a07 = $itm_val_other_a07 + $itm_val;}
            }
            if($sbgrp_id == 'H01'){
            if($prty_cd == 'BD'){$itm_qty_bd_h01 = $itm_qty;$itm_val_bd_h01 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_h01 = $itm_qty;$itm_val_nd_h01 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_h01 = $itm_qty;$itm_val_pd_h01 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_h01 = $itm_qty;$itm_val_md_h01 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_h01 = $itm_qty;$itm_val_sld_h01 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_h01 = $itm_qty;$itm_val_kd_h01 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_h01 = $itm_qty;$itm_val_gd_h01 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_h01 = $itm_qty;$itm_val_ld_h01 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_h01 = $itm_qty;$itm_val_td_h01 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_h01 = $itm_qty;$itm_val_tpd_h01 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_h01 = $itm_qty;$itm_val_hd_h01 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_h01 = $itm_qty;$itm_val_ues_h01 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_h01 = $itm_qty;$itm_val_cws_h01 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_h01 = $itm_qty;$itm_val_pp_h01 = $itm_val;}

            else{$itm_qty_other_h01 = $itm_qty_other_h01 + $itm_qty;$itm_val_other_h01 = $itm_val_other_h01 + $itm_val;}
            }
        if($sbgrp_id == 'H02'){
            if($prty_cd == 'BD'){$itm_qty_bd_h02 = $itm_qty;$itm_val_bd_h02 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_h02 = $itm_qty;$itm_val_nd_h02 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_h02 = $itm_qty;$itm_val_pd_h02 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_h02 = $itm_qty;$itm_val_md_h02 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_h02 = $itm_qty;$itm_val_sld_h02 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_h02 = $itm_qty;$itm_val_kd_h02 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_h02 = $itm_qty;$itm_val_gd_h02 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_h02 = $itm_qty;$itm_val_ld_h02 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_h02 = $itm_qty;$itm_val_td_h02 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_h02 = $itm_qty;$itm_val_tpd_h02 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_h02 = $itm_qty;$itm_val_hd_h02 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_h02 = $itm_qty;$itm_val_ues_h02 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_h02 = $itm_qty;$itm_val_cws_h02 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_h02 = $itm_qty;$itm_val_pp_h02 = $itm_val;}

            else{$itm_qty_other_h02 = $itm_qty_other_h02 + $itm_qty;$itm_val_other_h02 = $itm_val_other_h02 + $itm_val;}
            }
             if($sbgrp_id == 'H03'){
            if($prty_cd == 'BD'){$itm_qty_bd_h03 = $itm_qty;$itm_val_bd_h03 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_h03 = $itm_qty;$itm_val_nd_h03 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_h03 = $itm_qty;$itm_val_pd_h03 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_h03 = $itm_qty;$itm_val_md_h03 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_h03 = $itm_qty;$itm_val_sld_h03 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_h03 = $itm_qty;$itm_val_kd_h03 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_h03 = $itm_qty;$itm_val_gd_h03 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_h03 = $itm_qty;$itm_val_ld_h03 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_h03 = $itm_qty;$itm_val_td_h03 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_h03 = $itm_qty;$itm_val_tpd_h03 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_h03 = $itm_qty;$itm_val_hd_h03 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_h03 = $itm_qty;$itm_val_ues_h03 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_h03 = $itm_qty;$itm_val_cws_h03 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_h03 = $itm_qty;$itm_val_pp_h03 = $itm_val;}

            else{$itm_qty_other_h03 = $itm_qty_other_h03 + $itm_qty;$itm_val_other_h03 = $itm_val_other_h03 + $itm_val;}
            }
            if($sbgrp_id == 'H04'){
            if($prty_cd == 'BD'){$itm_qty_bd_h04 = $itm_qty;$itm_val_bd_h04 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_h04 = $itm_qty;$itm_val_nd_h04 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_h04 = $itm_qty;$itm_val_pd_h04 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_h04 = $itm_qty;$itm_val_md_h04 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_h04 = $itm_qty;$itm_val_sld_h04 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_h04 = $itm_qty;$itm_val_kd_h04 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_h04 = $itm_qty;$itm_val_gd_h04 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_h04 = $itm_qty;$itm_val_ld_h04 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_h04 = $itm_qty;$itm_val_td_h04 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_h04 = $itm_qty;$itm_val_tpd_h04 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_h04 = $itm_qty;$itm_val_hd_h04 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_h04 = $itm_qty;$itm_val_ues_h04 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_h04 = $itm_qty;$itm_val_cws_h04 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_h04 = $itm_qty;$itm_val_pp_h04 = $itm_val;}

            else{$itm_qty_other_h04 = $itm_qty_other_h04 + $itm_qty;$itm_val_other_h04 = $itm_val_other_h04 + $itm_val;}
            }
            if($sbgrp_id == 'D01'){
            if($prty_cd == 'BD'){$itm_qty_bd_d01 = $itm_qty;$itm_val_bd_d01 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_d01 = $itm_qty;$itm_val_nd_d01 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_d01 = $itm_qty;$itm_val_pd_d01 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_d01 = $itm_qty;$itm_val_md_d01 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_d01 = $itm_qty;$itm_val_sld_d01 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_d01 = $itm_qty;$itm_val_kd_d01 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_d01 = $itm_qty;$itm_val_gd_d01 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_d01 = $itm_qty;$itm_val_ld_d01 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_d01 = $itm_qty;$itm_val_td_d01 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_d01 = $itm_qty;$itm_val_tpd_d01 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_d01 = $itm_qty;$itm_val_hd_d01 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_d01 = $itm_qty;$itm_val_ues_d01 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_d01 = $itm_qty;$itm_val_cws_d01 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_h04 = $itm_qty;$itm_val_pp_h04 = $itm_val;}

            else{$itm_qty_other_d01 = $itm_qty_other_d01 + $itm_qty;$itm_val_other_d01 = $itm_val_other_d01 + $itm_val;}
            }
            if($sbgrp_id == 'F06'){
            if($prty_cd == 'BD'){$itm_qty_bd_f06 = $itm_qty;$itm_val_bd_f06 = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_f06 = $itm_qty;$itm_val_nd_f06 = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_f06 = $itm_qty;$itm_val_pd_f06 = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_f06 = $itm_qty;$itm_val_md_f06 = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_f06 = $itm_qty;$itm_val_sld_f06 = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_f06 = $itm_qty;$itm_val_kd_f06 = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_f06 = $itm_qty;$itm_val_gd_f06 = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_f06 = $itm_qty;$itm_val_ld_f06 = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_f06 = $itm_qty;$itm_val_td_f06 = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_f06 = $itm_qty;$itm_val_tpd_f06 = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_f06 = $itm_qty;$itm_val_hd_f06 = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_f06 = $itm_qty;$itm_val_ues_f06 = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_f06 = $itm_qty;$itm_val_cws_f06 = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_f06 = $itm_qty;$itm_val_pp_f06 = $itm_val;}

            else{$itm_qty_other_f06 = $itm_qty_other_f06 + $itm_qty;$itm_val_other_f06 = $itm_val_other_f06 + $itm_val;}
            }
        
  	
	
        
}

while($row31 = mysqli_fetch_array($result31))
{
 //If the current row is the last one, create new page and print column title
    
	//$sbgrp_id 		= $row31['SBGRP_ID1'];
        $prty_cd 		= $row31['PRTY_CD1'];
        $itm_qty 		= -$row31['ITM_QTY1'];
        $itm_val                = -$row31['ITM_VAL1'];
        
        if($prty_cd == 'BD'){$itm_qty_bd_misc = $itm_qty;$itm_val_bd_misc = $itm_val;}
            elseif($prty_cd == 'ND'){$itm_qty_nd_misc = $itm_qty;$itm_val_nd_misc = $itm_val;}
            elseif($prty_cd == 'PD'){$itm_qty_pd_misc = $itm_qty;$itm_val_pd_misc = $itm_val;}
            elseif($prty_cd == 'MD'){$itm_qty_md_misc = $itm_qty;$itm_val_md_misc = $itm_val;}
            elseif($prty_cd == 'SLD'){$itm_qty_sld_misc = $itm_qty;$itm_val_sld_misc = $itm_val;}
            elseif($prty_cd == 'KD'){$itm_qty_kd_misc = $itm_qty;$itm_val_kd_misc = $itm_val;}
            elseif($prty_cd == 'GD'){$itm_qty_gd_misc = $itm_qty;$itm_val_gd_misc = $itm_val;}
            elseif($prty_cd == 'LD'){$itm_qty_ld_misc = $itm_qty;$itm_val_ld_misc = $itm_val;}
            elseif($prty_cd == 'TD'){$itm_qty_td_misc = $itm_qty;$itm_val_td_misc = $itm_val;}
            elseif($prty_cd == 'TPD'){$itm_qty_tpd_misc = $itm_qty;$itm_val_tpd_misc = $itm_val;}
            elseif($prty_cd == 'HD'){$itm_qty_hd_misc = $itm_qty;$itm_val_hd_misc = $itm_val;}
            elseif($prty_cd == 'UES'){$itm_qty_ues_misc = $itm_qty;$itm_val_ues_misc = $itm_val;}
            elseif($prty_cd == 'CWS'){$itm_qty_cws_misc = $itm_qty;$itm_val_cws_misc = $itm_val;}
            elseif($prty_cd == 'PP'){$itm_qty_pp_misc = $itm_qty;$itm_val_pp_misc = $itm_val;}

            else{$itm_qty_other_misc = $itm_qty_other_misc + $itm_qty;$itm_val_other_misc = $itm_val_other_misc + $itm_val;}
       
        
}


$itm_qty_tot_a01 = $itm_qty_pp_a01 + $itm_qty_ues_a01 + $itm_qty_cws_a01 + $itm_qty_other_a01 + $itm_qty_bd_a01 + $itm_qty_nd_a01 + $itm_qty_pd_a01 + $itm_qty_md_a01 + $itm_qty_sld_a01 + $itm_qty_kd_a01 + $itm_qty_gd_a01 + $itm_qty_ld_a01 + $itm_qty_td_a01 + $itm_qty_tpd_a01 + $itm_qty_hd_a01 ;
$itm_qty_tot_a02 = $itm_qty_pp_a02 + $itm_qty_ues_a02 + $itm_qty_cws_a02 + $itm_qty_other_a02 + $itm_qty_bd_a02 + $itm_qty_nd_a02 + $itm_qty_pd_a02 + $itm_qty_md_a02 + $itm_qty_sld_a02 + $itm_qty_kd_a02 + $itm_qty_gd_a02 + $itm_qty_ld_a02 + $itm_qty_td_a02 + $itm_qty_tpd_a02 + $itm_qty_hd_a02 ;
$itm_qty_tot_a07 = $itm_qty_pp_a02 + $itm_qty_ues_a02 + $itm_qty_cws_a02 + $itm_qty_other_a02 + $itm_qty_bd_a07 + $itm_qty_nd_a07 + $itm_qty_pd_a07 + $itm_qty_md_a07 + $itm_qty_sld_a07 + $itm_qty_kd_a07 + $itm_qty_gd_a07 + $itm_qty_ld_a07 + $itm_qty_td_a07 + $itm_qty_tpd_a07 + $itm_qty_hd_a07 ;
$itm_qty_tot_h01 = $itm_qty_pp_h01 + $itm_qty_ues_h01 + $itm_qty_cws_h01 + $itm_qty_other_h01 + $itm_qty_bd_h01 + $itm_qty_nd_h01 + $itm_qty_pd_h01 + $itm_qty_md_h01 + $itm_qty_sld_h01 + $itm_qty_kd_h01 + $itm_qty_gd_h01 + $itm_qty_ld_h01 + $itm_qty_td_h01 + $itm_qty_tpd_h01 + $itm_qty_hd_h01 ;
$itm_qty_tot_h02 = $itm_qty_pp_h02 + $itm_qty_ues_h02 + $itm_qty_cws_h02 + $itm_qty_other_h02 + $itm_qty_bd_h02 + $itm_qty_nd_h02 + $itm_qty_pd_h02 + $itm_qty_md_h02 + $itm_qty_sld_h02 + $itm_qty_kd_h02 + $itm_qty_gd_h02 + $itm_qty_ld_h02 + $itm_qty_td_h02 + $itm_qty_tpd_h02 + $itm_qty_hd_h02 ;
$itm_qty_tot_h03 = $itm_qty_pp_h03 + $itm_qty_ues_h03 + $itm_qty_cws_h03 + $itm_qty_other_h03 + $itm_qty_bd_h03 + $itm_qty_nd_h03 + $itm_qty_pd_h03 + $itm_qty_md_h03 + $itm_qty_sld_h03 + $itm_qty_kd_h03 + $itm_qty_gd_h03 + $itm_qty_ld_h03 + $itm_qty_td_h03 + $itm_qty_tpd_h03 + $itm_qty_hd_h03 ;

$itm_qty_tot_h04 = $itm_qty_pp_h04 + $itm_qty_ues_h04 + $itm_qty_cws_h04 + $itm_qty_other_h04 + $itm_qty_bd_h04 + $itm_qty_nd_h04 + $itm_qty_pd_h04 + $itm_qty_md_h04 + $itm_qty_sld_h04 + $itm_qty_kd_h04 + $itm_qty_gd_h04 + $itm_qty_ld_h04 + $itm_qty_td_h04 + $itm_qty_tpd_h04 + $itm_qty_hd_h04 ;
$itm_qty_tot_d01 = $itm_qty_pp_d01 + $itm_qty_ues_d01 + $itm_qty_cws_d01 + $itm_qty_other_d01 + $itm_qty_bd_d01 + $itm_qty_nd_d01 + $itm_qty_pd_d01 + $itm_qty_md_d01 + $itm_qty_sld_d01 + $itm_qty_kd_d01 + $itm_qty_gd_d01 + $itm_qty_ld_d01 + $itm_qty_td_d01 + $itm_qty_tpd_d01 + $itm_qty_hd_d01 ;
$itm_qty_tot_f06 = $itm_qty_pp_f06 + $itm_qty_ues_f06 + $itm_qty_cws_f06 + $itm_qty_other_f06 + $itm_qty_bd_f06 + $itm_qty_nd_f06 + $itm_qty_pd_f06 + $itm_qty_md_f06 + $itm_qty_sld_f06 + $itm_qty_kd_f06 + $itm_qty_gd_f06 + $itm_qty_ld_f06 + $itm_qty_td_f06 + $itm_qty_tpd_f06 + $itm_qty_hd_f06 ;


$itm_val_tot_a01 = $itm_val_pp_a01 + $itm_val_ues_a01 + $itm_val_cws_a01 + $itm_val_other_a01 + $itm_val_bd_a01 + $itm_val_nd_a01 + $itm_val_pd_a01 + $itm_val_md_a01 + $itm_val_sld_a01 + $itm_val_kd_a01 + $itm_val_gd_a01 + $itm_val_ld_a01 + $itm_val_td_a01 + $itm_val_tpd_a01 + $itm_val_hd_a01 ;
$itm_val_tot_a02 = $itm_val_pp_a02 + $itm_val_ues_a02 + $itm_val_cws_a02 + $itm_val_other_a02 + $itm_val_bd_a02 + $itm_val_nd_a02 + $itm_val_pd_a02 + $itm_val_md_a02 + $itm_val_sld_a02 + $itm_val_kd_a02 + $itm_val_gd_a02 + $itm_val_ld_a02 + $itm_val_td_a02 + $itm_val_tpd_a02 + $itm_val_hd_a02 ;
$itm_val_tot_a07 = $itm_val_pp_a02 + $itm_val_ues_a02 + $itm_val_cws_a02 + $itm_val_other_a02 + $itm_val_bd_a07 + $itm_val_nd_a07 + $itm_val_pd_a07 + $itm_val_md_a07 + $itm_val_sld_a07 + $itm_val_kd_a07 + $itm_val_gd_a07 + $itm_val_ld_a07 + $itm_val_td_a07 + $itm_val_tpd_a07 + $itm_val_hd_a07 ;
$itm_val_tot_h01 = $itm_val_pp_h01 + $itm_val_ues_h01 + $itm_val_cws_h01 + $itm_val_other_h01 + $itm_val_bd_h01 + $itm_val_nd_h01 + $itm_val_pd_h01 + $itm_val_md_h01 + $itm_val_sld_h01 + $itm_val_kd_h01 + $itm_val_gd_h01 + $itm_val_ld_h01 + $itm_val_td_h01 + $itm_val_tpd_h01 + $itm_val_hd_h01 ;
$itm_val_tot_h02 = $itm_val_pp_h02 + $itm_val_ues_h02 + $itm_val_cws_h02 + $itm_val_other_h02 + $itm_val_bd_h02 + $itm_val_nd_h02 + $itm_val_pd_h02 + $itm_val_md_h02 + $itm_val_sld_h02 + $itm_val_kd_h02 + $itm_val_gd_h02 + $itm_val_ld_h02 + $itm_val_td_h02 + $itm_val_tpd_h02 + $itm_val_hd_h02 ;
$itm_val_tot_h03 = $itm_val_pp_h03 + $itm_val_ues_h03 + $itm_val_cws_h03 + $itm_val_other_h03 + $itm_val_bd_h03 + $itm_val_nd_h03 + $itm_val_pd_h03 + $itm_val_md_h03 + $itm_val_sld_h03 + $itm_val_kd_h03 + $itm_val_gd_h03 + $itm_val_ld_h03 + $itm_val_td_h03 + $itm_val_tpd_h03 + $itm_val_hd_h03 ;

$itm_val_tot_h04 = $itm_val_pp_h04 + $itm_val_ues_h04 + $itm_val_cws_h04 + $itm_val_other_h04 + $itm_val_bd_h04 + $itm_val_nd_h04 + $itm_val_pd_h04 + $itm_val_md_h04 + $itm_val_sld_h04 + $itm_val_kd_h04 + $itm_val_gd_h04 + $itm_val_ld_h04 + $itm_val_td_h04 + $itm_val_tpd_h04 + $itm_val_hd_h04 ;
$itm_val_tot_d01 = $itm_val_pp_d01 + $itm_val_ues_d01 + $itm_val_cws_d01 + $itm_val_other_d01 + $itm_val_bd_d01 + $itm_val_nd_d01 + $itm_val_pd_d01 + $itm_val_md_d01 + $itm_val_sld_d01 + $itm_val_kd_d01 + $itm_val_gd_d01 + $itm_val_ld_d01 + $itm_val_td_d01 + $itm_val_tpd_d01 + $itm_val_hd_d01 ;
$itm_val_tot_f06 = $itm_val_pp_f06 + $itm_val_ues_f06 + $itm_val_cws_f06 + $itm_val_other_f06 + $itm_val_bd_f06 + $itm_val_nd_f06 + $itm_val_pd_f06 + $itm_val_md_f06 + $itm_val_sld_f06 + $itm_val_kd_f06 + $itm_val_gd_f06 + $itm_val_ld_f06 + $itm_val_td_f06 + $itm_val_tpd_f06 + $itm_val_hd_f06 ;

$itm_val_tot_misc = $itm_val_pp_misc + $itm_val_ues_misc + $itm_val_cws_misc + $itm_val_other_misc + $itm_val_bd_misc + $itm_val_nd_misc + $itm_val_pd_misc + $itm_val_md_misc + $itm_val_sld_misc + $itm_val_kd_misc + $itm_val_gd_misc + $itm_val_ld_misc + $itm_val_td_misc + $itm_val_tpd_misc + $itm_val_hd_misc ;



while($row4 = mysqli_fetch_array($result4))
{
 //If the current row is the last one, create new page and print column title
    
	$km 		= $row4['km1'];
        $make 		= $row4['make1'];
        $depot 		= $row4['depot1'];
  
            if($make == 'T'){
            if($depot == 'BD'){$km_bd_tata = $km;}
            if($depot == 'ND'){$km_nd_tata = $km;}
            if($depot == 'PD'){$km_pd_tata = $km;}
            if($depot == 'MD'){$km_md_tata = $km;}
            if($depot == 'SLD'){$km_sld_tata = $km;}
            if($depot == 'KD'){$km_kd_tata = $km;}
            if($depot == 'GD'){$km_gd_tata = $km;}
            if($depot == 'LD'){$km_ld_tata = $km;}
            if($depot == 'TD'){$km_td_tata = $km;}
            if($depot == 'TPD'){$km_tpd_tata = $km;}
            if($depot == 'HD'){$km_hd_tata = $km;}
            if($depot == 'UES'){$km_ues_tata = $km;}
            if($depot == 'CWS'){$km_cws_tata = $km;}
            }
            if($make == 'L'){
           if($depot == 'BD'){$km_bd_leyland = $km;}
            if($depot == 'ND'){$km_nd_leyland = $km;}
            if($depot == 'PD'){$km_pd_leyland = $km;}
            if($depot == 'MD'){$km_md_leyland = $km;}
            if($depot == 'SLD'){$km_sld_leyland = $km;}
            if($depot == 'KD'){$km_kd_leyland = $km;}
            if($depot == 'GD'){$km_gd_leyland = $km;}
            if($depot == 'LD'){$km_ld_leyland = $km;}
            if($depot == 'TD'){$km_td_leyland = $km;}
            if($depot == 'TPD'){$km_tpd_leyland = $km;}
            if($depot == 'HD'){$km_hd_leyland = $km;}
            if($depot == 'UES'){$km_ues_leyland = $km;}
            if($depot == 'CWS'){$km_cws_leyland = $km;}
            }
            if($make == 'V'){
            if($depot == 'BD'){$km_bd_volvo = $km;}
            if($depot == 'ND'){$km_nd_volvo = $km;}
            if($depot == 'PD'){$km_pd_volvo = $km;}
            if($depot == 'MD'){$km_md_volvo = $km;}
            if($depot == 'SLD'){$km_sld_volvo = $km;}
            if($depot == 'KD'){$km_kd_volvo = $km;}
            if($depot == 'GD'){$km_gd_volvo = $km;}
            if($depot == 'LD'){$km_ld_volvo = $km;}
            if($depot == 'TD'){$km_td_volvo = $km;}
            if($depot == 'TPD'){$km_tpd_volvo = $km;}
            if($depot == 'HD'){$km_hd_volvo = $km;}
             if($depot == 'UES'){$km_ues_volvo = $km;}
            if($depot == 'CWS'){$km_cws_volvo = $km;}
            }
            
}
$km_tot_bd = $km_bd_tata + $km_bd_leyland + $km_bd_volvo ;
$km_tot_nd = $km_nd_tata + $km_nd_leyland + $km_nd_volvo ;
$km_tot_pd = $km_pd_tata + $km_pd_leyland + $km_pd_volvo ;
$km_tot_md = $km_md_tata + $km_md_leyland + $km_md_volvo ;
$km_tot_sld = $km_sld_tata + $km_sld_leyland + $km_sld_volvo ;
$km_tot_kd = $km_kd_tata + $km_kd_leyland + $km_kd_volvo ;
$km_tot_gd = $km_gd_tata + $km_gd_leyland + $km_gd_volvo ;
$km_tot_ld = $km_ld_tata + $km_ld_leyland + $km_ld_volvo ;
$km_tot_td = $km_td_tata + $km_td_leyland + $km_td_volvo ;
$km_tot_tpd = $km_tpd_tata + $km_tpd_leyland + $km_tpd_volvo ;
$km_tot_hd = $km_hd_tata + $km_hd_leyland + $km_hd_volvo ;
$km_cstc_tata = $km_bd_tata +$km_nd_tata +$km_pd_tata +$km_md_tata +$km_sld_tata +$km_kd_tata +$km_gd_tata +$km_ld_tata +$km_td_tata +$km_tpd_tata +$km_hd_tata ;
$km_cstc_leyland = $km_bd_leyland +$km_nd_leyland +$km_pd_leyland +$km_md_leyland +$km_sld_leyland +$km_kd_leyland +$km_gd_leyland +$km_ld_leyland +$km_td_leyland +$km_tpd_leyland +$km_hd_leyland ;
$km_cstc_volvo = $km_bd_volvo +$km_nd_volvo +$km_pd_volvo +$km_md_volvo +$km_sld_volvo +$km_kd_volvo +$km_gd_volvo +$km_ld_volvo +$km_td_volvo +$km_tpd_volvo +$km_hd_volvo ;



$km_tot_cstc = $km_tot_bd + $km_tot_nd + $km_tot_pd + $km_tot_md + $km_tot_sld + $km_tot_kd + $km_tot_gd + $km_tot_ld + $km_tot_td + $km_tot_tpd + $km_tot_hd  ;


$km_tot_tata = $km_bd_tata + $km_nd_tata + $km_pd_tata + $km_md_tata + $km_sld_tata + $km_kd_tata + $km_gd_tata + $km_ld_tata + $km_td_tata + $km_tpd_tata + $km_hd_tata ;
$km_tot_leyland = $km_bd_leyland + $km_nd_leyland + $km_pd_leyland + $km_md_leyland + $km_sld_leyland + $km_kd_leyland + $km_gd_leyland + $km_ld_leyland + $km_td_leyland + $km_tpd_leyland + $km_hd_leyland ;
$km_tot_volvo = $km_bd_volvo + $km_nd_volvo + $km_pd_volvo + $km_md_volvo + $km_sld_volvo + $km_kd_volvo + $km_gd_volvo + $km_ld_volvo + $km_td_volvo + $km_tpd_volvo + $km_hd_volvo ;

while($row5 = mysqli_fetch_array($result5))
{
 //If the current row is the last one, create new page and print column title
    
	$hsd 		= $row5['hsd1'];
        $make 		= $row5['make1'];
        $depot 		= $row5['depot1'];
  
            if($make == 'T'){
            if($depot == 'BD'){$hsd_bd_tata = $hsd;}
            if($depot == 'ND'){$hsd_nd_tata = $hsd;}
            if($depot == 'PD'){$hsd_pd_tata = $hsd;}
            if($depot == 'MD'){$hsd_md_tata = $hsd;}
            if($depot == 'SLD'){$hsd_sld_tata = $hsd;}
            if($depot == 'KD'){$hsd_kd_tata = $hsd;}
            if($depot == 'GD'){$hsd_gd_tata = $hsd;}
            if($depot == 'LD'){$hsd_ld_tata = $hsd;}
            if($depot == 'TD'){$hsd_td_tata = $hsd;}
            if($depot == 'TPD'){$hsd_tpd_tata = $hsd;}
            if($depot == 'HD'){$hsd_hd_tata = $hsd;}
            }
            if($make == 'L'){
           if($depot == 'BD'){$hsd_bd_leyland = $hsd;}
            if($depot == 'ND'){$hsd_nd_leyland = $hsd;}
            if($depot == 'PD'){$hsd_pd_leyland = $hsd;}
            if($depot == 'MD'){$hsd_md_leyland = $hsd;}
            if($depot == 'SLD'){$hsd_sld_leyland = $hsd;}
            if($depot == 'KD'){$hsd_kd_leyland = $hsd;}
            if($depot == 'GD'){$hsd_gd_leyland = $hsd;}
            if($depot == 'LD'){$hsd_ld_leyland = $hsd;}
            if($depot == 'TD'){$hsd_td_leyland = $hsd;}
            if($depot == 'TPD'){$hsd_tpd_leyland = $hsd;}
            if($depot == 'HD'){$hsd_hd_leyland = $hsd;}
            }
            if($make == 'V'){
            if($depot == 'BD'){$hsd_bd_volvo = $hsd;}
            if($depot == 'ND'){$hsd_nd_volvo = $hsd;}
            if($depot == 'PD'){$hsd_pd_volvo = $hsd;}
            if($depot == 'MD'){$hsd_md_volvo = $hsd;}
            if($depot == 'SLD'){$hsd_sld_volvo = $hsd;}
            if($depot == 'KD'){$hsd_kd_volvo = $hsd;}
            if($depot == 'GD'){$hsd_gd_volvo = $hsd;}
            if($depot == 'LD'){$hsd_ld_volvo = $hsd;}
            if($depot == 'TD'){$hsd_td_volvo = $hsd;}
            if($depot == 'TPD'){$hsd_tpd_volvo = $hsd;}
            if($depot == 'HD'){$hsd_hd_volvo = $hsd;}
            }
            
}
$hsd_tot_bd = $hsd_bd_tata + $hsd_bd_leyland + $hsd_bd_volvo ;
$hsd_tot_nd = $hsd_nd_tata + $hsd_nd_leyland + $hsd_nd_volvo ;
$hsd_tot_pd = $hsd_pd_tata + $hsd_pd_leyland + $hsd_pd_volvo ;
$hsd_tot_md = $hsd_md_tata + $hsd_md_leyland + $hsd_md_volvo ;
$hsd_tot_sld = $hsd_sld_tata + $hsd_sld_leyland + $hsd_sld_volvo ;
$hsd_tot_kd = $hsd_kd_tata + $hsd_kd_leyland + $hsd_kd_volvo ;
$hsd_tot_gd = $hsd_gd_tata + $hsd_gd_leyland + $hsd_gd_volvo ;
$hsd_tot_ld = $hsd_ld_tata + $hsd_ld_leyland + $hsd_ld_volvo ;
$hsd_tot_td = $hsd_td_tata + $hsd_td_leyland + $hsd_td_volvo ;
$hsd_tot_tpd = $hsd_tpd_tata + $hsd_tpd_leyland + $hsd_tpd_volvo ;
$hsd_tot_hd = $hsd_hd_tata + $hsd_hd_leyland + $hsd_hd_volvo ;
$hsd_tot_cstc = $hsd_tot_bd + $hsd_tot_nd + $hsd_tot_pd + $hsd_tot_md + $hsd_tot_sld + $hsd_tot_kd + $hsd_tot_gd + $hsd_tot_ld + $hsd_tot_td + $hsd_tot_tpd + $hsd_tot_hd  ;


$hsd_tot_tata = $hsd_bd_tata + $hsd_nd_tata + $hsd_pd_tata + $hsd_md_tata + $hsd_sld_tata + $hsd_kd_tata + $hsd_gd_tata + $hsd_ld_tata + $hsd_td_tata + $hsd_tpd_tata + $hsd_hd_tata ;
$hsd_tot_leyland = $hsd_bd_leyland + $hsd_nd_leyland + $hsd_pd_leyland + $hsd_md_leyland + $hsd_sld_leyland + $hsd_kd_leyland + $hsd_gd_leyland + $hsd_ld_leyland + $hsd_td_leyland + $hsd_tpd_leyland + $hsd_hd_leyland ;
$hsd_tot_volvo = $hsd_bd_volvo + $hsd_nd_volvo + $hsd_pd_volvo + $hsd_md_volvo + $hsd_sld_volvo + $hsd_kd_volvo + $hsd_gd_volvo + $hsd_ld_volvo + $hsd_td_volvo + $hsd_tpd_volvo + $hsd_hd_volvo ;



$itm_val_tot_bd = $hsd_tot_bd * $hsd_rate + $itm_val_bd_a01 + $itm_val_bd_a02 + $itm_val_bd_a07 + $itm_val_bd_h01 + $itm_val_bd_h02 + $itm_val_bd_h03 + $itm_val_bd_h04 + $itm_val_bd_d01 + $itm_val_bd_f06 + $itm_val_bd_misc ; 
$itm_val_tot_nd = $hsd_tot_nd * $hsd_rate + $itm_val_nd_a01 + $itm_val_nd_a02 + $itm_val_nd_a07 + $itm_val_nd_h01 + $itm_val_nd_h02 + $itm_val_nd_h03 + $itm_val_nd_h04 + $itm_val_nd_d01 + $itm_val_nd_f06 + $itm_val_nd_misc ; 
$itm_val_tot_pd = $hsd_tot_pd * $hsd_rate + $itm_val_pd_a01 + $itm_val_pd_a02 + $itm_val_pd_a07 + $itm_val_pd_h01 + $itm_val_pd_h02 + $itm_val_pd_h03 + $itm_val_pd_h04 + $itm_val_pd_d01 + $itm_val_pd_f06 + $itm_val_pd_misc ; 
$itm_val_tot_md = $hsd_tot_md * $hsd_rate + $itm_val_md_a01 + $itm_val_md_a02 + $itm_val_md_a07 + $itm_val_md_h01 + $itm_val_md_h02 + $itm_val_md_h03 + $itm_val_md_h04 + $itm_val_md_d01 + $itm_val_md_f06 + $itm_val_md_misc ; 
$itm_val_tot_sld = $hsd_tot_sld * $hsd_rate + $itm_val_sld_a01 + $itm_val_sld_a02 + $itm_val_sld_a07 + $itm_val_sld_h01 + $itm_val_sld_h02 + $itm_val_sld_h03 + $itm_val_sld_h04 + $itm_val_sld_d01 + $itm_val_sld_f06 + $itm_val_sld_misc ; 
$itm_val_tot_kd = $hsd_tot_kd * $hsd_rate + $itm_val_kd_a01 + $itm_val_kd_a02 + $itm_val_kd_a07 + $itm_val_kd_h01 + $itm_val_kd_h02 + $itm_val_kd_h03 + $itm_val_kd_h04 + $itm_val_kd_d01 + $itm_val_kd_f06 + $itm_val_kd_misc ; 
$itm_val_tot_gd = $hsd_tot_gd * $hsd_rate + $itm_val_gd_a01 + $itm_val_gd_a02 + $itm_val_gd_a07 + $itm_val_gd_h01 + $itm_val_gd_h02 + $itm_val_gd_h03 + $itm_val_gd_h04 + $itm_val_gd_d01 + $itm_val_gd_f06 + $itm_val_gd_misc ; 
$itm_val_tot_ld = $hsd_tot_ld * $hsd_rate + $itm_val_ld_a01 + $itm_val_ld_a02 + $itm_val_ld_a07 + $itm_val_ld_h01 + $itm_val_ld_h02 + $itm_val_ld_h03 + $itm_val_ld_h04 + $itm_val_ld_d01 + $itm_val_ld_f06 + $itm_val_ld_misc ; 
$itm_val_tot_td = $hsd_tot_td * $hsd_rate + $itm_val_td_a01 + $itm_val_td_a02 + $itm_val_td_a07 + $itm_val_td_h01 + $itm_val_td_h02 + $itm_val_td_h03 + $itm_val_td_h04 + $itm_val_td_d01 + $itm_val_td_f06 + $itm_val_td_misc ; 
$itm_val_tot_tpd = $hsd_tot_tpd * $hsd_rate + $itm_val_tpd_a01 + $itm_val_tpd_a02 + $itm_val_tpd_a07 + $itm_val_tpd_h01 + $itm_val_tpd_h02 + $itm_val_tpd_h03 + $itm_val_tpd_h04 + $itm_val_tpd_d01 + $itm_val_tpd_f06 + $itm_val_tpd_misc ; 
$itm_val_tot_hd = $hsd_tot_hd * $hsd_rate + $itm_val_hd_a01 + $itm_val_hd_a02 + $itm_val_hd_a07 + $itm_val_hd_h01 + $itm_val_hd_h02 + $itm_val_hd_h03 + $itm_val_hd_h04 + $itm_val_hd_d01 + $itm_val_hd_f06 + $itm_val_hd_misc ; 
$itm_val_tot_cws = $itm_val_cws_a01 + $itm_val_cws_a02 + $itm_val_cws_a07 + $itm_val_cws_h01 + $itm_val_cws_h02 + $itm_val_cws_h03 + $itm_val_cws_h04 + $itm_val_cws_d01 + $itm_val_cws_f06 + $itm_val_cws_misc ; 
$itm_val_tot_ues = $itm_val_ues_a01 + $itm_val_ues_a02 + $itm_val_ues_a07 + $itm_val_ues_h01 + $itm_val_ues_h02 + $itm_val_ues_h03 + $itm_val_ues_h04 + $itm_val_ues_d01 + $itm_val_ues_f06 + $itm_val_ues_misc ; 
$itm_val_tot_pp = $itm_val_pp_a01 + $itm_val_pp_a02 + $itm_val_pp_a07 + $itm_val_pp_h01 + $itm_val_pp_h02 + $itm_val_pp_h03 + $itm_val_pp_h04 + $itm_val_pp_d01 + $itm_val_pp_f06 + $itm_val_pp_misc ; 
$itm_val_tot_cstc = $itm_val_tot_bd + $itm_val_tot_nd + $itm_val_tot_pd + $itm_val_tot_md + $itm_val_tot_sld + $itm_val_tot_kd + $itm_val_tot_gd + $itm_val_tot_ld + $itm_val_tot_td + $itm_val_tot_tpd + $itm_val_tot_hd + $itm_val_tot_cws + $itm_val_tot_ues + $itm_val_tot_pp ; 

//$itm_val_tot_cstc = $itm_val_other_a01 + $itm_val_other_a02 + $itm_val_other_a07 + $itm_val_other_h01 + $itm_val_other_h02 + $itm_val_other_h03 + $itm_val_other_h04 + $itm_val_other_d01 + $itm_val_other_f06 + $itm_val_other_misc ; 

$srl = 1;
$y = 2.4 ;       

        $pdf->SetFont('Arial', '', 10);
	$pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'BELGHORIA');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh).');
	$pdf->setXY(3.3, $y);
        if($itm_val_bd_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_bd_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_bd_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_bd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_bd_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_bd_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_bd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_bd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_bd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_bd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_bd * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_bd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_bd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_bd / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_bd_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_a01 / $km_bd_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_bd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_a02 / $km_bd_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_bd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_a07 / $km_bd_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_bd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_h01 / $km_bd_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_bd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_h02 / $km_bd_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_bd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_h04 / $km_bd_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_bd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_h03 / $km_tot_bd,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_bd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_d01 / $km_tot_bd,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_bd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_f06 / $km_tot_bd,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_bd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_bd * $hsd_rate / ($km_tot_bd ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_bd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_bd_misc / ($km_tot_bd ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_bd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_bd / ($km_tot_bd ),2) ,0,0,'R');}
       
        $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$srl = $srl + 1;
        $y = $y + 0.2;
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'NILGUNJ');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_nd_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_nd_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_nd_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_nd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_nd_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_nd_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_nd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_nd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_nd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_nd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_nd * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_nd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_nd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_nd / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_nd_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_a01 / $km_nd_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_nd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_a02 / $km_nd_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_nd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_a07 / $km_nd_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_nd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_h01 / $km_nd_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_nd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_h02 / $km_nd_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_nd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_h04 / $km_nd_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_nd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_h03 / $km_tot_nd,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_nd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_d01 / $km_tot_nd,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_nd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_f06 / $km_tot_nd,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_nd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_nd * $hsd_rate / ($km_tot_nd ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_nd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_nd_misc / ($km_tot_nd ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_nd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_nd / ($km_tot_nd ),2) ,0,0,'R');}
       
        $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'PAIKPARA');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_pd_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_pd_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_pd_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_pd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_pd_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_pd_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_pd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_pd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_pd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_pd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_pd * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_pd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_pd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_pd / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_pd_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_a01 / $km_pd_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_pd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_a02 / $km_pd_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_pd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_a07 / $km_pd_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_pd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_h01 / $km_pd_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_pd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_h02 / $km_pd_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_pd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_h04 / $km_pd_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_pd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_h03 / $km_tot_pd,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_pd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_d01 / $km_tot_pd,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_pd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_f06 / $km_tot_pd,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_pd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_pd * $hsd_rate / ($km_tot_pd ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_pd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_pd_misc / ($km_tot_pd ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_pd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_pd / ($km_tot_pd ),2) ,0,0,'R');}
       
       $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'MANICKTALA');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_md_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_md_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_md_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_md_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_md_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_md_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_md_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_md_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_md_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_md > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_md * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_md_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_md > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_md / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_md_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_a01 / $km_md_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_md_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_a02 / $km_md_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_md_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_a07 / $km_md_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_md_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_h01 / $km_md_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_md_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_h02 / $km_md_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_md_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_h04 / $km_md_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_md_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_h03 / $km_tot_md,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_md_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_d01 / $km_tot_md,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_md_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_f06 / $km_tot_md,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_md > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_md * $hsd_rate / ($km_tot_md ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_md_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_md_misc / ($km_tot_md ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_md > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_md / ($km_tot_md ),2) ,0,0,'R');}
       
        $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'SALTLAKE');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_sld_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_sld_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_sld_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_sld_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_sld_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_sld_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_sld_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_sld_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_sld_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_sld > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_sld * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_sld_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_sld > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_sld / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_sld_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_a01 / $km_sld_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_sld_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_a02 / $km_sld_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_sld_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_a07 / $km_sld_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_sld_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_h01 / $km_sld_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_sld_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_h02 / $km_sld_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_sld_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_h04 / $km_sld_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_sld_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_h03 / $km_tot_sld,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_sld_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_d01 / $km_tot_sld,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_sld_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_f06 / $km_tot_sld,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_sld > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_sld * $hsd_rate / ($km_tot_sld ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_sld_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_sld_misc / ($km_tot_sld ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_sld > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_sld / ($km_tot_sld ),2) ,0,0,'R');}
       
       $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'KASBA');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_kd_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_kd_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_kd_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_kd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_kd_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_kd_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_kd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_kd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_kd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_kd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_kd * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_kd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_kd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_kd / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_kd_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_a01 / $km_kd_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_kd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_a02 / $km_kd_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_kd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_a07 / $km_kd_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_kd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_h01 / $km_kd_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_kd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_h02 / $km_kd_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_kd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_h04 / $km_kd_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_kd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_h03 / $km_tot_kd,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_kd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_d01 / $km_tot_kd,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_kd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_f06 / $km_tot_kd,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_kd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_kd * $hsd_rate / ($km_tot_kd ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_kd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_kd_misc / ($km_tot_kd ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_kd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_kd / ($km_tot_kd ),2) ,0,0,'R');}
       
       $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'GARIA');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_gd_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_gd_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_gd_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_gd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_gd_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_gd_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_gd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_gd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_gd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_gd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_gd * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_gd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_gd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_gd / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_gd_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_a01 / $km_gd_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_gd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_a02 / $km_gd_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_gd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_a07 / $km_gd_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_gd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_h01 / $km_gd_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_gd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_h02 / $km_gd_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_gd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_h04 / $km_gd_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_gd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_h03 / $km_tot_gd,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_gd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_d01 / $km_tot_gd,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_gd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_f06 / $km_tot_gd,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_gd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_gd * $hsd_rate / ($km_tot_gd ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_gd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_gd_misc / ($km_tot_gd ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_gd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_gd / ($km_tot_gd ),2) ,0,0,'R');}
       
        $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'LAKE');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_ld_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_ld_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_ld_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_ld_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_ld_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_ld_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_ld_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_ld_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_ld_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_ld > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_ld * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_ld_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_ld > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_ld / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_ld_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_a01 / $km_ld_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_ld_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_a02 / $km_ld_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_ld_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_a07 / $km_ld_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_ld_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_h01 / $km_ld_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_ld_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_h02 / $km_ld_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_ld_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_h04 / $km_ld_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_ld_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_h03 / $km_tot_ld,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_ld_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_d01 / $km_tot_ld,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_ld_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_f06 / $km_tot_ld,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_ld > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_ld * $hsd_rate / ($km_tot_ld ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_ld_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_ld_misc / ($km_tot_ld ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_ld > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_ld / ($km_tot_ld ),2) ,0,0,'R');}
       
       $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'TARATALA');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_td_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_td_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_td_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_td_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_td_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_td_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_td_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_td_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_td_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_td > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_td * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_td_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_td > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_td / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_td_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_a01 / $km_td_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_td_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_a02 / $km_td_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_td_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_a07 / $km_td_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_td_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_h01 / $km_td_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_td_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_h02 / $km_td_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_td_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_h04 / $km_td_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_td_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_h03 / $km_tot_td,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_td_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_d01 / $km_tot_td,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_td_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_f06 / $km_tot_td,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_td > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_td * $hsd_rate / ($km_tot_td ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_td_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_td_misc / ($km_tot_td ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_td > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_td / ($km_tot_td ),2) ,0,0,'R');}
       
        $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'THAKURPUKUR');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_tpd_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_tpd_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_tpd_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_tpd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_tpd_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_tpd_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_tpd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_tpd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_tpd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_tpd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_tpd * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_tpd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_tpd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_tpd / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;

        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_tpd_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_a01 / $km_tpd_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_tpd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_a02 / $km_tpd_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_tpd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_a07 / $km_tpd_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_tpd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_h01 / $km_tpd_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_tpd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_h02 / $km_tpd_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_tpd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_h04 / $km_tpd_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_tpd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_h03 / $km_tot_tpd,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_tpd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_d01 / $km_tot_tpd,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_tpd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_f06 / $km_tot_tpd,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_tpd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_tpd * $hsd_rate / ($km_tot_tpd ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_tpd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tpd_misc / ($km_tot_tpd ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_tpd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_tpd / ($km_tot_tpd ),2) ,0,0,'R');}
       $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'HOWRAH');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_hd_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_hd_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_hd_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_hd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_hd_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_hd_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_hd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_hd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_hd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_hd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_hd * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_hd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_hd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_hd / 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_hd_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_a01 / $km_hd_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_hd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_a02 / $km_hd_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_hd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_a07 / $km_hd_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_hd_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_h01 / $km_hd_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_hd_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_h02 / $km_hd_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_hd_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_h04 / $km_hd_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_hd_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_h03 / $km_tot_hd,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_hd_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_d01 / $km_tot_hd,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_hd_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_f06 / $km_tot_hd,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_hd > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_hd * $hsd_rate / ($km_tot_hd ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_hd_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_hd_misc / ($km_tot_hd ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_hd > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_hd / ($km_tot_hd ),2) ,0,0,'R');}
       
       $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'WORKSHOP');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        //if($itm_val_hd_a01 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_a01 + $itm_val_ues_a01 + $itm_val_pp_a01) / 100000,2),0,0,'R'); 
        $pdf->setXY(4.0, $y);
        //if($itm_val_hd_a02 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_a02 + $itm_val_ues_a02 + $itm_val_pp_a02) / 100000,2),0,0,'R');
        $pdf->setXY(4.7, $y);
        //if($itm_val_hd_a07 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_a07 + $itm_val_ues_a07 + $itm_val_pp_a07) / 100000,2),0,0,'R');
        $pdf->setXY(5.4, $y);
        //if($itm_val_hd_h01 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_h01 + $itm_val_ues_h01 + $itm_val_pp_h01) / 100000,2),0,0,'R');
        $pdf->setXY(6.0, $y);
       // if($itm_val_hd_h02 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_h02 + $itm_val_ues_h02 + $itm_val_pp_h02) / 100000,2),0,0,'R');
        $pdf->setXY(6.7, $y);
       // if($itm_val_hd_h04 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_h04 + $itm_val_ues_h04 + $itm_val_pp_h04) / 100000,2),0,0,'R');
        $pdf->setXY(7.4, $y);
       // if($itm_val_hd_h03 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_h03 + $itm_val_ues_h03 + $itm_val_pp_h03) / 100000,2) ,0,0,'R');
        $pdf->setXY(8.1, $y);
      //  if($itm_val_hd_d01 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_d01 + $itm_val_ues_d01 + $itm_val_pp_d01) / 100000,2),0,0,'R');
        $pdf->setXY(8.9, $y);
       // if($itm_val_hd_f06 > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_f06 + $itm_val_ues_f06 + $itm_val_pp_f06) / 100000,2) ,0,0,'R');
        $pdf->setXY(9.7, $y);
       // if($hsd_tot_hd > 0){
        //$pdf->Cell(0.5,0, number_format($hsd_tot_hd * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
       // if($itm_val_hd_misc > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_cws_misc + $itm_val_ues_misc + $itm_val_pp_misc) / 100000,2) ,0,0,'R');
        $pdf->setXY(11.1, $y);
       // if($itm_val_tot_hd > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_tot_cws + $itm_val_tot_ues + $itm_val_tot_pp )/ 100000,2) ,0,0,'R');
       $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
$srl = $srl + 1;
        $pdf->SetFont('Arial', '', 10);
	
        $pdf->setXY(0.8, $y);
	$pdf->Cell(0.5,0, $srl );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, 'TOTAL');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE (lakh)');
        $pdf->setXY(3.3, $y);
        if($itm_val_tot_a01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_a01 / 100000,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($itm_val_tot_a02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_a02 / 100000,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($itm_val_tot_a07 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_a07 / 100000,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_tot_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_h01 / 100000,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($itm_val_tot_h02 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_h02 / 100000,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($itm_val_tot_h04 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_h04 / 100000,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_tot_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_h03 / 100000,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_tot_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_d01 / 100000,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_tot_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_f06 / 100000,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_cstc > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_cstc * $hsd_rate / 100000,2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_tot_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_misc / 100000,2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_cstc > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_tot_a01 + $itm_val_tot_a02 + $itm_val_tot_a07 + $itm_val_tot_h01 + $itm_val_tot_h02 +  $itm_val_tot_h04 +  $itm_val_tot_h03 + $itm_val_tot_d01 + $itm_val_tot_f06 + $itm_val_tot_misc)/ 100000,2) ,0,0,'R');}
        $y = $y + 0.2;
        $pdf->setXY(2.3, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$y = $y + 0.2;
        $pdf->Cell(0.5,0, '' );
	$pdf->setXY(1.2, $y);
	$pdf->Cell(0.5,0, '');
        $pdf->setXY(2.3, $y);
	$pdf->Cell(0.5,0, 'VALUE/KM(Rs.)');
        $pdf->setXY(3.3, $y);
        if($km_tot_tata > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_a01 / $km_tot_tata,2),0,0,'R'); }
        $pdf->setXY(4.0, $y);
        if($km_tot_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_a02 / $km_tot_leyland,2),0,0,'R');}
        $pdf->setXY(4.7, $y);
        if($km_tot_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_a07 / $km_tot_volvo,2),0,0,'R');}
        $pdf->setXY(5.4, $y);
        if($itm_val_tot_h01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_h01 / $km_tot_tata,2),0,0,'R');}
        $pdf->setXY(6.0, $y);
        if($km_tot_leyland > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_h02 / $km_tot_leyland,2),0,0,'R');}
        $pdf->setXY(6.7, $y);
        if($km_tot_volvo > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_h04 / $km_tot_volvo,2),0,0,'R');}
        $pdf->setXY(7.4, $y);
        if($itm_val_tot_h03 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_h03 / $km_tot_cstc,2) ,0,0,'R');}
        $pdf->setXY(8.1, $y);
        if($itm_val_tot_d01 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_d01 / $km_tot_cstc,2),0,0,'R');}
        $pdf->setXY(8.9, $y);
        if($itm_val_tot_f06 > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_f06 / $km_tot_cstc,2) ,0,0,'R');}
        $pdf->setXY(9.7, $y);
        if($hsd_tot_cstc > 0){
        $pdf->Cell(0.5,0, number_format($hsd_tot_cstc * $hsd_rate / ($km_tot_cstc ),2) ,0,0,'R');}
        $pdf->setXY(10.3, $y);
        if($itm_val_tot_misc > 0){
        $pdf->Cell(0.5,0, number_format($itm_val_tot_misc / ($km_tot_cstc ),2) ,0,0,'R');}
        $pdf->setXY(11.1, $y);
        if($itm_val_tot_cstc > 0){
        $pdf->Cell(0.5,0, number_format(($itm_val_tot_a01 + $itm_val_tot_a02 + $itm_val_tot_a07 + $itm_val_tot_h01 + $itm_val_tot_h02 +  $itm_val_tot_h04 +  $itm_val_tot_h03 + $itm_val_tot_d01 + $itm_val_tot_f06 + $itm_val_tot_misc) / ($km_tot_cstc ),2) ,0,0,'R');}
       
        $y = $y + 0.2;
        $pdf->setXY(1.2, $y);
        $pdf->Cell(0.5,0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
 $y = $y + 0.2;

        ob_clean();
$filename="REPORT/Month_Issue/" . $date_from . '_' . $date_to . ".pdf";
//$pdf->Output('Voucher.pdf','D');
$pdf->Output($filename,'F');
$text = "Month Issue Report for  " . $date_from . '_' . $date_to  . " Created Successfully" ;
?>
    <script type="text/JavaScript">
     alert("<?php echo $text ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   


