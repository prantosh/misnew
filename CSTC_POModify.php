<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$po_no          = htmlspecialchars($_POST['po_no'],ENT_QUOTES); 

if($po_no == ''){$po_no = $_SESSION['po_no'];}


$sql_itma="update poitm set AMD_NO = 0 WHERE AMD_NO IS NULL";
$result_itma=mysqli_query($cstccon,$sql_itma); 
 

$sql_itmz1="select * FROM po where po_no = '" . $po_no . "'";
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);
$row_itmz1 = mysqli_fetch_assoc($result_itmz1);
$amd_no = $row_itmz1['AMD_NO'];
$amd_no_new = $amd_no + 1;
if(mysqli_num_rows($result_itmz1)>0 && $row_itmz1['STS'] == 'D' )  {
      

$unit = $_SESSION['unit'];

 
 
$unt_id         =  $row_itmz1['UNT_ID'];
$amd_no         =  $row_itmz1['AMD_NO'];
$po_dt          =  $row_itmz1['PO_DT'];
$wef_dt          =  $row_itmz1['WEF_DT'];
$vnd_id         =  $row_itmz1['VND_ID'];
$ofr_no         =  $row_itmz1['OFR_NO'];
$dlv_dt         =  $row_itmz1['DLV_DT'];
$pay_trm        =  $row_itmz1['PAY_TRM'];
$F01            =  $row_itmz1['F01'];
$F02            =  $row_itmz1['F02'];
$F03            =  $row_itmz1['F03'];
$F04            =  $row_itmz1['F04'];
$F05            =  $row_itmz1['F05'];
$F06            =  $row_itmz1['F06'];
$F07            =  $row_itmz1['F07'];
$F08            =  $row_itmz1['F08'];
$F09            =  $row_itmz1['F09'];
$F10            =  $row_itmz1['F10'];
$F11            =  $row_itmz1['F11'];
$F12            =  $row_itmz1['F12'];
$F13            =  $row_itmz1['F13'];
$F14            =  $row_itmz1['F14'];
$F15            =  $row_itmz1['F15'];
$po_schdl       =  $row_itmz1['PO_SCHDL'];
$note           =  $row_itmz1['NOTE'];
$oth_trm        =  $row_itmz1['OTH_TRM'];
 

$query_Recordsetunit = "SELECT * FROM unit";
$Recordsetunit = mysqli_query($cstccon,$query_Recordsetunit) or die(mysqli_error());
$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);

$sql_itmz="DELETE FROM po_item_issue";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
 
$sql_itmz="insert into po_item_issue select * from poitm where PO_NO = '" . $po_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);

$query2t = "SELECT * from vnd WHERE vnd_id = '" . $vnd_id . "'";
$result2t = mysqli_query($cstccon,$query2t) or die(mysqli_error());

$row2t = mysqli_fetch_assoc($result2t);  
$vnd_nm = $row2t['VND_NM'];
  
$unit = $_SESSION['UNIT']; // unit for operator

$query2p = "SELECT * from pay_term";
$result2p = mysqli_query($cstccon,$query2p) or die(mysqli_error());
$row2p = mysqli_fetch_assoc($result2p);      
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>New Purchase Order</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader">
	    <div class="material-loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
            <div class="message">Loading...</div>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
		<?php  include('CSTC_header.php'); ?>
		
		<?php  include('CSTC_left.php'); ?>
            <div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				
				<li class="active">Modify Purchase Order</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Modify Purchase Order <small>Existing Purchase Order</small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
            <div class="row">
            <div class="col-md-12" >	
                <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="CSTC_FindItem_NonEdit.php" class="btn btn-info" role="button"><img src="images/find.png"style="width:20px;height:20px;">Find Item</a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                <h6><span style="color: white;" align="left"><?php echo  "MODIFICATION OF PURCHASE ORDER :  NO.  <b>". $po_no . "</b> To <b>" . $vnd_nm . "</b>"  ; ?> </span></h6>
                        </div>
		<!-- begin #content -->
<form id="login_form"method="post" action="CSTC_POIssuePrint.php">
    
      <table width="100%" align="center" style="background-color: lightgrey">
        
    
        <tr>
	    <td style="background-color: lightgrey"valign="top" width = "62%">
  		<table align='right' color='black'valign = 'top' style="background-color: lightgrey" border="0" width="95%"   >
                    <tr>
                        <td align='left'><font style="color: black">NO. OF AMENDMENT:</font></td>
                        <td align='left'>
                            <h5><font style="color:black"> <?php echo $amd_no ; ?></font> </h5>
                        </td>
                    </tr>
                    <tr>
                        <td align='left'><font style="color: black">OFFER NO:</font>
                        </td>
                        <td align='left'>
                            <h5><font style="color:black"> <?php echo $ofr_no ; ?></font> </h5>
                        </td>
                    </tr>
                    <tr>
                        <td align='left'><font style="color: black">EFFECT FROM:</font></td>
                        <td align='left'>
                            <h5><font style="color:black"> <?php echo $wef_dt ;?></font> </h5>
                        </td>
                    </tr>
                    <tr>
                        <td  font='black'align='left'><font color="#000"></font></td>
                        <td COLOR='black'align='left'>
                        </td>
                    </tr>
                    <tr>
                        <td align='left'><font style="color: black">COST CENTER:</font></td>
                        <td align='left'>
                            <h5><font style="color:black"> CENTRAL STORES & PURCHASE</font> </h5>
                        </td>
                    </tr>
                    <tr>
                        <td  font='black'align='left'><font color="#000">DELIVERY TERM : </font>
                        </td>
                        <td COLOR='black'align='left'><h5><font style="color:black"> <?php echo $oth_trm ; ?></font> </h5>
                        </td>
                    </tr>
                    <tr>
                        <td  font='black'align='left'><font color="#000">SPECIAL NOTE : </font></td>
                        <td align='left'>
                            <textarea style="resize:none;height:80px; width:400px" placeholder="Type note (if any) here" maxlength="2000" name="note_to_mod" id="note_to_mod">

                            <?php echo trim($note) ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            
                        </td>
                    </tr>
                </table>
                <p></p><p></p>
                    <table align='right' color='black'valign = 'top' style="background-color: lightgrey" border="0" width="95%"   >
                        <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>MODIFY DETAILS FOR SELECTED FOLIO NUMBER:</b>
                            </td>
                        </tr>
                        <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                        <tr>
                        <td  font='black'align='left'><h6><font color="#000">FOLIO NO. : </font></h6>
                        </td>
                        <td COLOR='black'align='left'>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                    <select class="form-control"name="folio_no1" id="folio_no1" tabindex="2">
                          	<?php
                                $query = "SELECT PART_NO FROM poitm WHERE PO_NO = '" . $po_no . "'";
                                $Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
                                //$row = mysqli_fetch_assoc($Recordsetx);
                                ?>
                                <?php	while ($row = mysqli_fetch_assoc($Recordset)){  ?>
                                        <option value="<?php echo $row['PART_NO']?>"><?php echo $row['PART_NO']?></option>
                          	<?php
				}
				?>
                        			</select>
                                        </div>
                                    </div>
                                    <input class="form-control"type="hidden" size="25" maxlength="25" name="unit"  id="unit" tabindex="3" value="<?php echo $unit; ?> "/>
                                    <input class="form-control"type="hidden" size="25" maxlength="25" name="unit_from"  id="unit" tabindex="3" value="<?php echo $unit_from; ?> "/>
                        </td>
                    </tr>
                           <tr>
                        <td colspan='2'>
                            INPUT VALUE IN THE FOLLOWING TO CHANGE THE EXISTING VALUE ONLY : 
                        </td>
                        </tr>
                    <tr> 
                        <td align='center'colspan='2'>
                            <table align='left'width='90%'>
                                <tr>
                                    <td>
                                                <div align='center'id="msgboxdisp"></div>   
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    
                    <tr>
                        <td   align='left'><h6><font color="#000">PART NO. :</font></h6></td>
                        <td>
                            <div class="col-md-6">
                            <input class="form-control"id="alt_no"name="alt_no" type="text" size = "8"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr>
                        <td   align='left'><h6><font color="#000">ORDER QUANTITY :</font></h6></td>
                        <td>
                            <div class="col-md-6">
                            <input class="form-control"id="new_order_qty"name="new_order_qty" type="number" size = "8"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                             <tr>
                                <td>
                                    <font style="color: black">CASH DISCOUNT (%) :</font></td>
                                    <td>    
                                        
                                        <div class="col-md-6">
                                            <input class="form-control"type="number" id="cd"  name="cd"onkeypress="return isNumberKeywithDec(event)"/>
                                        </div>
                                        </td>
                            </tr>
                            <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                            <tr>
                                <td>
                                    <font style="color: black">SGST (%) :</font></td>
                                    <td>    
                                        <div class="col-md-6">
                                        <input class="form-control"type="number" id="sgst"  name="sgst"onkeypress="return isNumberKeywithDec(event)"/>
                                        </div>
                                        </td>
                            </tr>
                            <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                            <tr>
                                <td>
                                    <font style="color: black">CGST (%) :</font></td>
                                    <td>    
                                        <div class="col-md-6">
                                        <input class="form-control"type="number" id="cgst"  name="cgst"onkeypress="return isNumberKeywithDec(event)"/>
                                        </div>
                                        </td>
                            </tr>
                            <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                            <tr>
                                <td>
                                    <font style="color: black">IGST (%) :</font></td>
                                    <td>    
                                        <div class="col-md-6">
                                        <input class="form-control"type="number" id="igst" name="igst"onkeypress="return isNumberKeywithDec(event)"/>
                                        </div>
                                        
                                        </td>
                            </tr>
                            <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr>
                        <td   align='left'><h6><font color="#000">UNIT RATE :</font></h6>
                        </td>
                        <td>
                            <div class="col-md-6">
                            <input class="form-control"id="unt_rt"name="unt_rt" type="number"size = "8"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            <input name="Issue" class="btn btn-success"type="button" id="issue"  value="Update"/>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="background-color: lightgrey"valign="top" width = "38%">
                <p></p>
                <p></p>
                <table width='100%' border='0' class="roundedCorners"style="background-color: lightgrey">
                    
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr>
                        <td>
                                    <font style="color: black">LAST DATE OF DELIVERY :</font>
                        </td>
                        <td>    
                            <div class="col-md-12">
                            <input class="form-control" type="text" placeholder="Select Date" name="mydate" id="mydate" value="<?php echo $dlv_dt ;?>" readonly='readonly'>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr>
                        <td>
                                    <font style="color: black">PAYMENT TERM :</font>
                        </td>
                        <td>     
                            <div class="form-group">
                                <div class="col-md-12">
                            <select class="form-control"name="pay_trm" id="pay_trm" tabindex="2">
                          	<?php
                                
                                $query2p1 = "SELECT * from pay_term where pay_term_code = '" . $pay_trm . "'";
                                $result2p1 = mysqli_query($cstccon,$query2p1) or die(mysqli_error());
                                $row2p1 = mysqli_fetch_assoc($result2p1);
                                $pay_term_desc = $row2p1['pay_term_desc'];
                                ?>
                                  <option value="<?php echo $pay_trm?>"><?php echo $pay_term_desc ;?></option>
                                <?php
				do {  ?>
                                        <option value="<?php echo $row2p['pay_term_code']?>"><?php echo $row2p['pay_term_desc']?></option>
                          	<?php
					} while ($row2p = mysqli_fetch_assoc($result2p));
  						$rows = mysqli_num_rows($result2p);
  						if($rows > 0) {
      						mysqli_data_seek($result2p, 0);
	  					$row2p = mysqli_fetch_assoc($result2p);
 					      }
				?>
                        			</select>   
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr>
                        <td>
                                    <font style="color: black">HANDLING & PACKAGING (Rs.) :</font>
                        </td>
                        <td>    
                            <div class="col-md-6">
                            <input class="form-control"type="number"id="f08" name="f08"onkeypress="return isNumberKeywithDec(event)"value="<?php echo $F08 ; ?>"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr>
                        <td>
                                    <font style="color: black">FREIGHT / DELIVERY (Rs.) :</font>
                        </td>
                        <td>    
                            <div class="col-md-6">
                            <input class="form-control"type="number" name="f09" name="f09"onkeypress="return isNumberKeywithDec(event)"value="<?php echo $F09 ; ?>"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr>
                        <td colspan='2'>
                            
                        </td>
                    </tr>
                     <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>       
                    <tr>
                         
                        <td colspan='2' style="background-color: lightgrey">
                       <h6><font color="#000">DELIVERY SCHEDULE :</font></h6>
  
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr>
                        <td colspan="2">
                                    <?php   $queryx2 = "SELECT * from posch where PO_NO = '" . $po_no . "'";
                                        $Recordsetx2 = mysqli_query($cstccon,$queryx2) or die(mysqli_error());
                                        //$rowx1 = mysqli_fetch_assoc($Recordsetx1);?>
                                       
                            <table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">

                                <tr>
                                    <th>SRL.</th>
                                    <th>DELIVERY DATE</th>
                                    <th>QTY. TO DELIVER (%)</th>
                                </tr>
                                        <?php
                                        $srl = 1;
                                        while ($rowx2 = mysqli_fetch_assoc($Recordsetx2)){
                                         echo "<tr>";
                                         echo "<td>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td>";
                                         echo $rowx2['DLV_DT'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['DLV_QTY'];
                                         echo "</td>";
                                         
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <p></p>  
                        </td>
                        </tr>
                    <tr align='center'>
                                
                                <?php
                                 $query2m = "SELECT STS from po WHERE po_no = '" . $po_no . "'";
                                 $result2m = mysqli_query($cstccon,$query2m) or die(mysqli_error());
                                 $row2m = mysqli_fetch_assoc($result2m);?>
                                
                                 <?php
                                 
                                 if($row2m['STS'] == 'D' OR mysqli_num_rows($result2m) == 0 ){ ?>
                                                      
                        <td align="center"COLOR='black' >
                            CURRENT STATUS : <b>DRAFT</b>
                        </td>
                        <td align="left">
                                 
                                   <input class="form-control"type="hidden" name="po_no1"  id="po_no1" tabindex="3" value="<?php echo $po_no; ?> "/>
                                   <input name="APPROVE" class="btn btn-danger"type="button" id="APPROVE" tabindex="2" value="CLICK TO APPROVE"/> 
                        </td>
                                       
                                <?php } 
                                 if($row2m['STS'] == 'A'){
                                 ?>
                        <td colspan="2" align="center">
                            <H6><font style="color: black">CURRENT STATUS : <b>APPROVED</b></font></H6>
                        </td>
                                        <?php } 
                                    ?>
                    </tr>
                </table>
 <!-- start supply schedule -->               
             <div id="container">
             <p id="add_field"><a href="#"><img src="add-icon.png"/></a></p>
             </div>
<!-- end supply schedule -->            
                     
                                   
               
               
		    
            </td>
            <td bgcolor='white'valign="top" width = "1%">
                
            </td>
        </tr>
        <tr>
            <td colspan='2'>
<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">

                    <tr>
                        <td colspan='2' style='background-color: white'>
                       <h6><font color="#000">LIST OF ITEMS INCLUDED IN THE ORDER :</font></h6>
  
                        </td>
                    </tr>
                    <tr> 
                        <td align='center'colspan='2'>
                                <?php   $queryx1 = "SELECT A.cd cd1,A.sgst sgst1,A.cgst cgst1,A.igst igst1,A.PO_NO PO_NO1,A.PART_NO PART_NO1,A.UOM_ID UOM_ID1,A.PO_QTY PO_QTY1,A.UNT_RT UNT_RT1,B.ITM_NM ITM_NM1,C.ALT_NO_3 ALT_NO1 FROM poitm A, itm B,current_part_no C  WHERE A.PART_NO = C.PART_NO AND A.PART_NO = B.PART_NO AND A.PO_NO = '" . $po_no . "'";
                                        $Recordsetx1 = mysqli_query($cstccon,$queryx1) or die(mysqli_error());
                                        //$rowx1 = mysqli_fetch_assoc($Recordsetx1);?>
                                       
<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">
                                <tr>
                                    <th>SRL.</th>
                                    <th>FOLIO NO.</th>
                                    <th>PART NO.</th>
                                    <th>DESCRIPTION</th>
                                    <th>UNIT</th>
                                    <th>RATE (Rs.)</th>
                                    <th>DISCOUNT(%)</th>
                                    <th>SGST(%)</th>
                                    <th>CGST(%)</th>
                                    <th>IGST(%)</th>
                                    <th>PO QTY.</th>
                                </tr>
                                        <?php
                                        $srl = 1;
                                        while ($rowx1 = mysqli_fetch_assoc($Recordsetx1)){
                                         echo "<tr>";
                                         echo "<td>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td>";
                                         echo $rowx1['PART_NO1'];
                                         echo "</td>";
                                         echo "<td>";
                                         echo $rowx1['ALT_NO1'];
                                         echo "</td>";
                                         echo "<td>";
                                         echo $rowx1['ITM_NM1'];
                                         echo "</td>";
                                         echo "<td>";
                                         echo $rowx1['UOM_ID1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx1['UNT_RT1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx1['cd1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx1['sgst1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx1['cgst1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx1['igst1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx1['PO_QTY1'];
                                         echo "</td>";
                                         
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
                                        
                            </table>
                        </td>
                    </tr>
                </table>
           </td>
           <td></td>
        </tr>
      
    </table>
    <p></p>
   <table width="100%" align="center" bgcolor="#ffffff" class="rounded-corners"style="background-color: lightgrey">
        
       <tr>
           <td width="100%">
                 <div id="msgboxissue"></div>   
           </td>
      </tr>
                                  
   </table> 
    <div align="center">
                                           

     <input name="submit" class="btn btn-success"type="submit" id="submit"  value="Save and Print"/>
                               
                                    <input name="Exit" class="btn btn-danger"type="button" id="Exit"  value="Exit"/>
    
    </div>
   
</form>
                </div>
<?php }

            
else
{

?> 
    <script language="javascript">
            alert('Sorry. Purchase Order Does not Exist or It is already approved');
             document.location='CSTC_MainMenu.php';
       </script>
<?php            
            
} ?>                     
            

            </div>		<!-- end #content -->
		<?php  include('CSTC_ThemePanel.php'); ?>
        
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
        </div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/dashboard.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript">
       

$(document).ready(function()
{       
    
    $("#disphide").hide();
    
  $("#issue").click(function()
	{
         
		//remove all the class add the messagebox classes and start fading
		$("#msgboxissue").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_POModifyRate_ajax.php",{alt_no:$('#alt_no').val(),igst:$('#igst').val(),cgst:$('#cgst').val(),sgst:$('#sgst').val(),cd:$('#cd').val(),new_order_qty:$('#new_order_qty').val(),po_no1:$('#po_no1').val(),unt_rt:$('#unt_rt').val(),folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no:$('#folio_no').val(),rand:Math.random() } ,function(data)
        
        {                       //alert("Item Issued Successfully");//Your success msg
                                $('#msgboxissue').html(data); 
                                folio_no1.value = ''; 
                                qty.value = ''; 
                                unt_rt.value = '';
                                $("#msgboxdisp").empty();
                      
	});
 		return false; //not to post the  form physically
                  
	});
	
       
        
        
         $("#APPROVE").click(function()
	{
		var answer = confirm ("Are You Sure to Approve ?")
                if (answer){
        
        
                $("#msgboxshow").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		$.post("CSTC_POApprove_ajax.php",{ po_no1:$('#po_no1').val(),po_no1:$('#po_no1').val(),rand:Math.random() } ,function(data)
      
        {	//alert(data);
                     // alert("Item Removed Successfully");//Your success msg
                      document.location='CSTC_MainMenu.php';
                    
	});
 		return false; //not to post the  form physically
	}});
       
        
        $("#Exit").click(function()
	{
		document.location='CSTC_MainMenu.php';
                return false; //not to post the  form physically
	});
        
        
        
	   
        $("#Show").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox2").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_DepotQryNew11_ajax.php",{ folio_no1:$('#folio_no1').val(),qty:$('#qty').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no:$('#folio_no').val(),rand:Math.random() } ,function(data)
        
        {        //alert(data);               //alert("Item Issued Successfully");//Your success msg
                                $('#itemdetail').html(data); 
                  $("#msgbox2").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
				
			 // $(this).html('Sorry, Invalid PF a/c number....').addClass('messageboxerror').fadeTo(900,1);
		        });	         
                      
	});
 		return false; //not to post the  form physically
	});
        
        App.init();
			Dashboard.init();
        
			 FormPlugins.init();
});
</script>	
	
</body>
</html>
