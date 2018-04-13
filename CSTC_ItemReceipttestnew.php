<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

if(isset($_POST['gstin'])){
$gstin = htmlspecialchars($_POST['gstin'],ENT_QUOTES); 
$queryg = "update item_receive_ctrl set GSTIN = '" . $gstin . "'"; 
$resultg = mysqli_query($cstccon,$queryg) or die(mysqli_error());}
//$vendor_from =htmlspecialchars($_POST['vendor_from'],ENT_QUOTES);
$query32qn = "SELECT * from item_receive_ctrl";
$result32qn = mysqli_query($cstccon,$query32qn) or die(mysqli_error());
$row32qn = mysqli_fetch_assoc($result32qn);
$po_no = $row32qn['po_no'];
$challan_no  = $row32qn['challan_no'];
$challan_date = $row32qn['challan_date'];
$advnc_no = $row32qn['advnc_no'];
$remark = $row32qn['remark'];
$query32xx = "SELECT * from po WHERE PO_NO = '" . $po_no . "'";
$result32xx = mysqli_query($cstccon,$query32xx) or die(mysqli_error());
$row32xx = mysqli_fetch_assoc($result32xx);
$vnd_id = $row32xx['VND_ID'];


//$remark =$_SESSION['remark'];
$unit_to =$_SESSION['unit_to'];

$query3 = "SELECT * from po WHERE PO_NO = '" . $po_no . "'";
$result3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
$row3 = mysqli_fetch_assoc($result3);
$po_dt = $row3['PO_DT'];

$po_dt_disp = substr($po_dt,8,2) . '-' . substr($po_dt,5,2) . '-' . substr($po_dt,0,4);



$VND_ID = $row3['VND_ID'];



//$unit_to =htmlspecialchars($_POST['unit_to'],ENT_QUOTES);

$query2 = "SELECT * from unit WHERE UNIT_CODE = '" . $_SESSION['unit_to'] . "'";
$result2 = mysqli_query($cstccon,$query2) or die(mysqli_error());
$row2 = mysqli_fetch_assoc($result2);
$unit_to_desc = $row2['UNIT_DESC'];

$unit_to_code = $row2['UNIT'];





if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }

$unit = $_SESSION['UNIT'];

$query = "SELECT * from unit WHERE UNIT = '" . $unit . "'";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
$unit_desc = $row['UNIT_DESC'];

//if(isset($_POST['vendor_from'])) {$vendor_from = $_POST['vendor_from'];}
if(isset($_POST['unit_to'])) {$unit_to = $_POST['unit_to'];}

//$remark = $_POST['remark'];
//$remark = $_SESSION['remark'] ;

$query1 = "SELECT * from vnd WHERE VND_ID = '" . $vnd_id . "'";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
$row1 = mysqli_fetch_assoc($result1);
$vendor_from_desc = $row1['VND_NM'];
$_SESSION['vendor_from_desc'] =  $row1['VND_NM'];
$_SESSION['vendor_from'] = $vendor_from;





$query345 = "select * from item_receive_temp";
$result345 = mysqli_query($cstccon,$query345) or die(mysqli_error());

if(mysqli_num_rows($result345)<=0){
$query34 = "select * from poitm where PO_NO = '" . $po_no . "'";
$result34 = mysqli_query($cstccon,$query34) or die(mysqli_error());
while ($row34= mysqli_fetch_array ($result34) ){
       $PO_NO =     $row34['PO_NO'];
       $PART_NO =     $row34['PART_NO'];
       $UOM_ID  =     $row34['UOM_ID'];
       $PO_QTY  =     $row34['PO_QTY'];
       $UNT_RT  =     $row34['UNT_RT'];
       $RCT_QTY =     $row34['RCT_QTY'];
       $AMD_NO  =     $row34['AMD_NO'];
       $cd  =     $row34['cd'];
       $cgst  =     $row34['cgst'];
       $sgst  =     $row34['sgst'];
       $igst  =     $row34['igst'];

    
    $query341 = "insert into item_receive_temp(challan_no,challan_date,remark,PO_NO,PART_NO,UOM_ID,PO_QTY,ITM_VAL,RCT_QTY,AMD_NO,cd,cgst,sgst,igst) values('$challan_no','$challan_date','$remark','$po_no','$PART_NO','$UOM_ID','$PO_QTY','$UNT_RT','$RCT_QTY','$AMD_NO','$cd','$cgst','$sgst','$igst')";
    $result341 = mysqli_query($cstccon,$query341) or die(mysqli_error());
    
    
    
  

}





}
$sql25="select * from po where PO_NO = '" . $po_no . "'";
$result25=mysqli_query($cstccon,$sql25);
$row25 = mysqli_fetch_assoc($result25);
$trade_disc = $row25['F01'];

$handle_pack = $row25['F08'];
$freight = $row25['F09'];

                    
                   
                               
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Goods Receipt</title>
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
				
				<li class="active">Goods Receipt</li>
                               
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Goods Receive <small>Receipt from Vendor</small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
            <div class="row">
            <div class="col-md-12" >	
		<!-- begin #content -->
                <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="CSTC_FindItem_NonEdit.php" class="btn btn-info" role="button"><img src="images/find.png"style="width:20px;height:20px;">Find Item</a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                        <h6><span style="color: white;" align="left"><?php echo  "GOODS RECEIPT FOR PURCHASE ORDER :  NO.  <b>". $po_no . "</b>"  ; ?></span></h6>
                        </div>
                <table width="100%" align="center" style="background-color:lightgray">
              
        <tr>
            <td>
                
                    
                  
                            <table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">
                             <tr>
                                 <td align='left'><font color="black"><?php echo "VENDOR CODE : <b>" . $VND_ID ; ?></b></font></td>
                                  <td align='left'><font color="black"><?php echo "VENDOR NAME : <b>" . $vendor_from_desc . "</b>"?></font></td>

                                  <td align='left'><font color="black"><?php echo "TO BE RECEIVED AT : <b>" . $_SESSION['unit_to_desc'] . "</b>"; ?></font></td>
                                  <td><font color="black"><?php echo "DATE : <b>" . date('d-m-Y') . "</b>"; ?></font></td>  
                            </tr>
                             
                           
                      </table> 
                            <table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">
                             <tr>
                                
                                 <td colspan='2'align='left'><font style="color:black;">TAX / OTHER DETAILS:</font></td>
                                
                                <td align='left'><font style="color:black;"><?php echo "Handling & Packaging (%): <b>" . $handle_pack . "</b>"; ?></font></td>
                                <td align='left'><font style="color:black;"><?php echo "Freight (%): <b>" . $freight . "</b>";  ?></font></td>

                                
                            </tr>
                      </table> 
                    
                   
    
    
    
    
                            <table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">
                        <thead>
                        <tr rowspan="2">
                           <th style="text-align:center;"><b>SRL</b> </th>
                                    <th style="text-align:center;"><b>FOLIO</b> </th>
                                    <th style="text-align:center;"><b>PART NO</b> </th>
                                    <th style="text-align:center;"><b>DESCRIPTION</b> </th>
                                    <th style="text-align:center;"><b>UNIT</b> </th>
                                    <th style="text-align:center;"><b>ORDER QTY</b> </th>
                                    <th style="text-align:center;"><b>RECIPT QTY</b> </th>
                                    <th style="text-align:center;"><b>INVOICE QTY</b> </th>
                                    <th style="text-align:center;"><b>SHORT QTY</b> </th>
                                    <th style="text-align:center;"><b>ACCEPTED QTY</b> </th>
                                    <th style="text-align:center;"><b>RATE</b> </th>
                               <!--     <th style="text-align:center;"><b>ED (%)</b> </th>
                                    <th style="text-align:center;"><b>CD (%)</b> </th>
                                    <th style="text-align:center;"><b>VAT (%)</b> </th> -->
                                    <th style="text-align:center;"><b>GROSS</b> </th>
                                    <th colspan='1'style="text-align:center;"><b>ACTION</b> </th>
                        </tr>
                        </thead>
                        <tbody>
 <?php


            $query = "SELECT * FROM itm a, item_receive_temp b where a.PART_NO = b.PART_NO order by a.PART_NO";
           
            $result_itm=mysqli_query($cstccon,$query);
           $i = 1;
           $total_val = 0;
                while($row = mysqli_fetch_assoc($result_itm)){
                    $PO_NO = $row['PO_NO'];
                    $id = $row['PART_NO'];
                    $INV_QTY = $row['INV_QTY'];
                    if($INV_QTY== 0.00){$INV_QTY = '';}
                    $SHORT_QTY = $row['SHORT_QTY'];
                    if($SHORT_QTY== 0.00){$SHORT_QTY = '';}
                    $REJ_QTY = $row['REJ_QTY'];
                    $GROSS_VAL = $row['GROSS_VAL'];
                    
                   
                    
                    
                    
                   // if($GROSS_VAL== 0.00){$GROSS_VAL = '';}
                    $PO_QTY  =     $row['PO_QTY'];
      
                    $RCT_QTY =     $row['RCT_QTY'];
                    if($RCT_QTY== 0.00){$RCT_QTY = '';}
                    $cd =     $row['cd'];
                    //if($cash_disc== 0.00){$cash_disc = '';}
                    $sgst =     $row['sgst'];
                   // if($sgst== 0.00){$sgst = '';}
                    $igst =     $row['igst'];
                  //  if($igst== 0.00){$igst = '';}
                     $cgst =     $row['cgst'];
                  //  if($cgst== 0.00){$cgst = '';}
                     $cd_val = $GROSS_VAL * $cd / 100;
                     $val_after_cd = $GROSS_VAL - $cd_val ;
                     $sgst_val = $val_after_cd * $sgst / 100 ;
                     $cgst_val = $val_after_cd * $cgst / 100 ;
                     $igst_val = $val_after_cd * $igst / 100 ;
                     
                     $GROSS_VAL = $GROSS_VAL - $cd_val + $sgst_val + $cgst_val + $igst_val ;
                      $total_val = $total_val + $GROSS_VAL;
                     
                     
                    $queryd = "SELECT ITM_NM,UOM_ID,ALT_NO,ALT_NO_2 FROM itm where PART_NO = '" . $row['PART_NO'] . "'";
                    $result_itmd=mysqli_query($cstccon,$queryd);
                    $rowd = mysqli_fetch_assoc($result_itmd);
                    $DESC = $rowd['ITM_NM'];
                    $UOM_ID = $rowd['UOM_ID'];
                    if($rowd['ALT_NO_2'] == ''){
                    $PART_NO = $rowd['ALT_NO'];}
                    else{$PART_NO = $rowd['ALT_NO'] . ' / ' . $rowd['ALT_NO_2'];}
                    
                    
                    echo "<tr>";?>
                <td style="text-align:center; word-break:break-all; "> <?php echo $i; ?></td>
                <td style="text-align:center; word-break:break-all; "> <?php echo $id; ?></td>
                <td style="text-align:center; word-break:break-all; "> <?php echo $PART_NO; ?></td>
		<td style="text-align:center; word-break:break-all; "> <?php echo $DESC; ?></td>
		<td style="text-align:center; word-break:break-all; "> <?php echo $UOM_ID; ?></td>
		<td style="text-align:right; word-break:break-all; "> <?php echo $row['PO_QTY']; ?></td>
                <td style="text-align:right; word-break:break-all; "> <?php echo $RCT_QTY; ?></td>
                <td style="text-align:right; word-break:break-all; "> <?php echo $INV_QTY; ?></td>
                <td style="text-align:right; word-break:break-all; "> <?php echo $SHORT_QTY; ?></td>
		<td style="text-align:right; word-break:break-all; "> <?php echo $row['INV_QTY'] - $row['SHORT_QTY'] - $row['REJ_QTY']; ?></td>
		<td style="text-align:right; word-break:break-all; "> <?php echo $row['ITM_VAL']; ?></td>
               <!-- <td style="text-align:right; word-break:break-all; "> <?php echo $ed; ?></td>
                <td style="text-align:right; word-break:break-all; "> <?php echo $cash_disc; ?></td>
                <td style="text-align:right; word-break:break-all; "> <?php echo $state_st; ?></td> -->
		<td style="text-align:right; word-break:break-all; "> <?php echo $GROSS_VAL; ?></td>
		
                <input class="form-control"name='PO_NO'type="hidden" value="<?php echo $PO_NO ; ?>" />
                <input class="form-control"name='RCT_QTY'type="hidden" value="<?php echo $RCT_QTY ; ?>" />
		
                
                
                
                
                  <?php 
                  if($RCT_QTY < $PO_QTY){
                      echo "<td><button class='btn btn-link btn-custom dis' data-toggle='modal' data-target='#myModal" .  $id . "'>RECEIVE</button> </td>";

                      }
                  else{
                    echo "<td></td>";
                  }  
                    echo '</tr>';
                    ?>
                <?php  $query3452 = "select * from item_receive_temp where PART_NO = '$id'";
$result3452 = mysqli_query($cstccon,$query3452) or die(mysqli_error());
$row3452= mysqli_fetch_array ($result3452);  
$cd = $row3452['cd'];
$igst = $row3452['igst'];
$cgst = $row3452['cgst'];
$sgst = $row3452['sgst'];
//$vat = $row3452['state_st'];
?>                         
                <div class="modal modal-warning fade" id="myModal<?php echo $id; ?>" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h6 class="modal-title"><font color='white'>MODIFY TAX RATE FOR FOLIO NO. <b>: <?php echo $id . '</b>'; ?></font></h6>
                            </div>
                                                            <div class="modal-body"style="color:white ;background-color: #dbda97;">

                            
                                <form action="CSTC_ItemReceipt_ajax.php" method="POST" class="form">
                                <p></p>
                                 <div><font style="color:black;">CASH DISCOUNT (%) =  <?php echo $cd; ?></font>
                                                   </div><div><font style="color:black;">IGST (%) =  <?php echo $igst; ?></font>
                                       </div><div><font style="color:black;">SGST (%) =  <?php echo $sgst; ?></font>
                                       </div><div><font style="color:black;">CGST (%) =  <?php echo $cgst; ?></font></div>
                                                   
                                    <div  align='center'>
                                    <span align='left' class="input-group-btn" style="width:0px;color:black;">CASH DISCOUNT (%)  :</span>
  <input class="form-control"name='INV_QTY'type="text" class="form-control input-sm" value="<?php echo $INV_QTY ; ?>" placeholder="Invoice Quantity"/>
     </div>
                                       <div  align='center'>
                                    <span align='left' class="input-group-btn" style="width:0px;color:black;">CASH DISCOUNT (%)  :</span>
  <input class="form-control"name='SHORT_QTY'type="text" class="form-control input-sm" value="<?php echo $SHORT_QTY ; ?>" placeholder="Short Quantity"style="margin-left:-1px" />
     </div>
                                    <p></p>
                                <
                                    <p></p>
                                <div   align='center'>
                                 <input class="form-control"type="hidden" name="PO_NO" value="<?php echo $PO_NO; ?>"></input>

                                                   <input class="form-control"type="hidden" name="id" value="<?php echo $id; ?>"></input>
                                                   <input type="submit" class="btn btn-primary btn-custom" value="Save changes"></input>
                                                     <p></p>
                                </div>
                                                            </div>
                                                   
                                          <div class="modal-footer"style="color:white ;background-color:#a8a646;">
                                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                                </form>
                                       
                                   </div>
                               </div>
                </div>                               
                                                       
                                                       
                                                       
                                                       
                                                       <div class="modal fade" id="myModal<?php echo $id; ?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                               <h4 class="modal-title" id="myModalLabel">Submit Information for FOLIO NO. <?php echo $id; ?></span></h4>
                                           </div>
                                           
                                           <div class="modal-body">
                                               

                                               

                                           </div>
                                           <div class="modal-footer">
                                               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                               <div id="results"></div>
                                           </div>

                                       </div>
                                   </div>
                               </div>
                                                       
                                                       
                                                       
                                                       
                                                    
                     <?php $i = $i + 1;  }?>
                                                       <tr align='center'>
                                                           <td colspan='13'align='center'>
                                                               <h5>    <?php echo 'TOTAL VALUE OF ITEM RECEIVED : ' . $total_val; ?></h5>
                                                           </td>
                                                       </tr>
                            </tbody>
                    </table>
                    <p></p>
            </td>
        </tr>
    </table>
    <div align="center">
                                                       <form id="finalsubmit" action="CSTC_ItemReceiptNew_ajax.php" method="POST" class="form">

                                                      
                                                       <input class="form-control"type="hidden" name="unit_to" value="<?php echo $unit_to ; ?>">
                                                       <input type=button class="btn btn-danger" onClick="location.href='CSTC_MainMenu_ajax.php'" value='Close'>
                                                       
                                                       <input type="submit" class="btn btn-success" value="Submit">

                                                       </form>
    </div>    
                </div>

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
    
   
        
        App.init();
			Dashboard.init();
        
			 FormPlugins.init();
});
</script>	
	
</body>
</html>
