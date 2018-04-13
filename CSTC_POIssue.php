<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$po_no          = htmlspecialchars($_POST['po_no'],ENT_QUOTES); 

$sql_itmz1="select * FROM po where po_no = '" . $po_no . "'";
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);
if(mysqli_num_rows($result_itmz1)>0) {?>
    <script type="text/JavaScript">
    alert("Sorry. Purchase Order Already Exists. ");
    document.location="CSTC_MainMenu.php";
</script>       
<?php }
else {
$unit = $_SESSION['unit'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }

$query_Recordsetunit = "SELECT * FROM unit order by UNIT_CODE";
$Recordsetunit = mysqli_query($cstccon,$query_Recordsetunit) or die(mysqli_error());
$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);

$sql_itmz="DELETE FROM po_item_issue";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
 
$vnd_id         = htmlspecialchars($_POST['vnd_id1'],ENT_QUOTES); 

$query2t = "SELECT * from vnd WHERE vnd_id = '" . $vnd_id . "'";
$result2t = mysqli_query($cstccon,$query2t) or die(mysqli_error());
if(mysqli_num_rows($result2t) > 0){
    $row2t = mysqli_fetch_assoc($result2t);  
$vnd_nm = $row2t['VND_NM'];
}
else {?>
<script type="text/javascript">
    alert("Vendor ID does not exist. Please try again")
</script>
<?php
exit();
}
 
$unit = $_SESSION['UNIT']; // unit for operator

$query2p = "SELECT * from pay_term";
$result2p = mysqli_query($cstccon,$query2p) or die(mysqli_error());
$row2p = mysqli_fetch_assoc($result2p);

                                $query =  "DELETE FROM po_issue";
                                $result = mysqli_query($cstccon,$query) or die(mysqli_error());
                                        
                               
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
				
				<li class="active">Purchase Order</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Create Purchase Order <small>New Purchase Order</small></h1>
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
               <h6> <span style="color: white;" align="left"><?php echo  "ISSUE OF PURCHASE ORDER :  NO.  <b>". $po_no . "</b> To <b>" . $vnd_nm . "</b>"  ; ?> </span></h6>
                        </div>
<form id="login_form"method="post" action="CSTC_POIssuePrint.php">
    <table width="100%" align="center" style="background-color: lightgrey">
        
   
        <tr style="background-color: lightgrey">
            <td  valign="top" width = "10%"> </td>
            <td valign="top" width = "80%">
                <p></p>
                <table align='right' color='black'valign = 'top' style="background-color: lightgrey" border="0" width="100%"   >
                    <tr>
                        <td align='left'><font style="color: black">OFFER NO:</font></td>
                        <td align='left'>
                            <div class="form-group">
                                <div class="col-md-4">
                                <input class="form-control"class="form-control " type='text' name='ofr_no' id='ofr_no'autofocus="autofocus">
                             </div>
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td align='left'><font style="color: black">EFFECT FROM:</font></td>
                        <td align='left'>
                                                <div class="form-group" style="width:230px;">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                    <div class="col-md-12">
                                                <input class="form-control"type="text" name="ofr_date"class="form-control pull-right" id="ofr_date"placeholder="Select Date" maxlength="40" size="20" readonly="yes" >
                                                    </div>
                                                    </div>
                                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                            <?php
                                 $query2m = "SELECT STS from po WHERE po_no = '" . $po_no . "'";
                                 $result2m = mysqli_query($cstccon,$query2m) or die(mysqli_error());
                                 $row2m = mysqli_fetch_assoc($result2m);
                                 if($row2m['STS'] == 'A'  ){
                                 ?>
                    <tr>
                        <td  font='black'align='left'><font color="#000">AMMENDMENT NO. : </font></td>
                        <td COLOR='black'align='left'>
                            <div class="col-md-6">
                            <input class="form-control"id="amend_no" name="amend_no" type="text" size="10"maxlength="10"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                                 <?php } ?>
                    <tr>
                        <td align='left'><font style="color: black">COST CENTER:</font></td>
                        <td align='left'>
                            <div class="form-group">
                                <div class="col-md-6">
                                <select class="form-control" name="unt_id" id="unt_id" tabindex="2">
                          	<?php
				do {  ?>
                                        <option value="<?php echo $row_Recordsetunit['UNIT_CODE']?>"><?php echo $row_Recordsetunit['UNIT_DESC']?></option>
                          	<?php
					} while ($row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit));
  						$rows = mysqli_num_rows($Recordsetunit);
  						if($rows > 0) {
      						mysqli_data_seek($Recordsetunit, 0);
	  					$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);
 					      }
				?>
                        			</select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td  font='black'align='left'><font color="#000">DELIVERY TERM : </font></td>
                        <td COLOR='black'align='left'>
                            <div class="col-md-6">
                            <input class="form-control"id="del_term" name="del_term" type="text" size="10"maxlength="10"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td  font='black'align='left'><font color="#000">SPECIAL NOTE : </font></td>
                        <td align='left'>
                            <textarea style="resize:none;height:80px; width:425px" placeholder="Type note (if any) here" maxlength="2000" name="note_to_print" id="note_to_print"></textarea>
                        </td>
                    </tr>
                    <!--        <tr align='center'>
                                
                                <?php
                                 $query2m = "SELECT STS from po WHERE po_no = '" . $po_no . "'";
                                 $result2m = mysqli_query($cstccon,$query2m) or die(mysqli_error());
                                 $row2m = mysqli_fetch_assoc($result2m);?>
                                
                                 <?php
                                 
                                 if($row2m['STS'] == 'D' OR mysqli_num_rows($result2m) == 0 ){ ?>
                                                      
                                 <td align="center"COLOR='black' >
                                 <H6><font style="color: black">CURRENT STATUS : DRAFT</font></H6>
                                 </td>
                                 <td align="left">
                                 
                                   <input class="form-control"type="hidden" name="po_no1"  id="po_no1" tabindex="3" value="<?php echo $po_no; ?> "/>
                                   <input class="form-control"name="APPROVE" class="btn btn-primary"type="button" id="APPROVE" tabindex="2" value="APPROVE"/> 
                                 </td>
                                       
                                <?php } 
                                 if($row2m['STS'] == 'A'){
                                 ?>
                                <td colspan="2" align="center">
                                    <H6><font style="color: black">CURRENT STATUS : APPROVED</font></H6>
                                 </td>
                                        <?php } 
                                    ?>

                                
                            </tr> -->
                    <tr><td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td>
                                    <font style="color: black">LAST DATE OF DELIVERY :</font>
                        </td>
                        <td> 
                            <div class="form-group" style="width:230px;">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                               

                                                    <input class="form-control"type="text" name="mydate"class="form-control pull-right" id="mydate"placeholder="Select Date" maxlength="40" size="20" readonly="yes" >

                                                </div>
                                                </div>
                        </td>
                    </tr>
                    <tr><td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td>
                                    <font style="color: black">PAYMENT TERM :</font></td>
                        <td>  
                            <div class="form-group">
                                <div class="col-md-6">
                            <select class="form-control"name="pay_term" id="pay_term" tabindex="2">
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
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td>
                                    <font style="color: black">HANDLING & PACKAGING (Rs.) :</font></td>
                        <td>   
                            <div class="col-md-6">
                            <input class="form-control"type="number"id="f08" name="f08"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td>
                                    <font style="color: black">FREIGHT / DELIVERY (Rs.) :</font></td>
                        <td>    
                            <div class="col-md-6">
                            <input class="form-control"type="number" name="f09" name="f09"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td colspan='2'></td>
                    </tr>
                </table>
            </td>
            <td  valign="top" width = "10%"> </td>    
        </tr>
        <tr>
           <td  valign="top" width = "10%"> </td>
            <td valign="top" width = "80%"style="background-color: lightgrey">
                <table width="90%" align="right" style="background-color: lightgrey" >
                    <tr>
                        <td  font='black'align='right'><h6><font color="#000">FOLIO NO. : </font></h6></td>
                        <td COLOR='black'align='left'>
                            <div class="col-md-6">
                            <input class="form-control"name="folio_no1" id="folio_no1" type="text" size="10"maxlength="10"/>
                            </div>
                            <input name="requisition" class="btn btn-primary" type="button" id="requisition"  value="Show Requisition"/>    
                                    <input class="form-control"type="hidden" size="25" maxlength="25" name="unit"  id="unit" tabindex="3" value="<?php echo $unit; ?> "/>
                                    <input class="form-control"type="hidden" size="25" maxlength="25" name="unit_from"  id="unit" tabindex="3" value="<?php echo $unit_from; ?> "/>
                        </td>
                   </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr> 
                        <td align='center'colspan='2'>
                            <table align='left'width='100%'>
                                <tr>
                                    <td>
                                                <div align='center'id="msgboxdisp"></div>   
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td>
                                    <font style="color: black">CASH DISCOUNT (%) :</font></td>
                        <td>    
                            <div class="col-md-6">
                            <input class="form-control"type="number" id="cd" name="cd"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                       <td>
                                    <font style="color: black">SGST (%) :</font>
                       </td>
                        <td>    
                            <div class="col-md-6">
                            <input class="form-control"type="number" id="sgst" name="sgst"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            </td>
                   </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td>
                                    <font style="color: black">CGST (%) :</font>
                        </td>
                        <td>    
                            <div class="col-md-6">
                            <input class="form-control"type="number" id="cgst"  name="cgst"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            </td>
                    </tr>
                    <tr><td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td>
                                    <font style="color: black">IGST (%) :</font>
                        </td>
                        <td>    
                            
                            <div class="col-md-6"><input class="form-control"type="number" id="igst" name="igst"onkeypress="return isNumberKeywithDec(event)"/>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                            <p></p>
                             <p></p>
                           
                            
                    <tr>
                        <td align='center'colspan='2'></td>
                    </tr>
                    <tr><td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                                
                        <td   align='right'><h6><font color="#000">QUANTITY :</font></h6>
                        </td>
                        <td>
                              <div class="col-md-6">      
                                    <input class="form-control"id="qty_po"name="qty_po" type="number" size = "8"onkeypress="return isNumberKeywithDec(event)"/>
                              </div>
                        </td>
                                
                    </tr>
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                                
                        <td   align='right'><h6><font color="#000">UNIT RATE :</font></h6>
                        </td>
                        <td>
                                    <input class="form-control"id="po_no1"name="po_no1" type="hidden" size = "8" value="<?php echo $po_no ; ?>"/>
                                    <input class="form-control"id="vnd_id"name="vnd_id" type="hidden" size = "8" value="<?php echo $vnd_id ; ?>"/>
<div class="col-md-6">
                                    <input class="form-control"id="unt_rt"name="unt_rt" type="number" size = "8"onkeypress="return isNumberKeywithDec(event)"/>
</div>
                                    <input name="Issue" class="btn btn-success"type="button" id="issue"  value="ADD FOLIO"/>
                               
                                    <input name="Remove" class="btn btn-danger"type="button" id="remove"  value="Remove"/>
                        </td>
                                
                    </tr> 
                    <tr>
                        <td colspan="2"><p></p></td>
                    </tr>
                    <tr>
                        <td align='center'colspan='2'></td>
                    </tr>
                </table>
            </td>
           <td  valign="top" width = "10%"> 
           </td>
        </tr>
        <tr>
            <td colspan='3'>
    <p></p>
                <table width="100%" align="center"  class="rounded-corners"style="background-color: lightgrey">
      
                    <tr>
            
                        <td colspan="3"width="100%">
           
		
		

                
             <div id="msgboxissue"></div>   
             <p></p>
                        </td>
                    </tr>
                                  
                </table> 
            </td>
        </tr>
    </table>
    <div align="center">
     <input name="submit" class="btn btn-success"type="submit" id="submit"  value="Save and Print"/>
                               
                                    <input name="Exit" class="btn btn-danger"type="button" id="Exit"  value="Exit"/>
    
    </div>
   
</form>
                </div>   
<?php } ?>           
            

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
    
  $("div#container").hide();
        $('#del_sch_type').change(function(){
        if($('#del_sch_type').val() === '1') {
            $('div#container').hide(); 
        } else {
            $('div#container').show(); 
        } 
    });   
        
   	
	$("#requisition").click(function()
	{
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		$.post("CSTC_POPurReq_ajax.php",{folio_no1:$('#folio_no1').val(),unt_id:$('#unt_id').val(),rand:Math.random() } ,function(data)
        {                       //alert("Item Issued Successfully");//Your success msg
                $('#msgboxdisp').html(data); 
                 
	});
 		return false; //not to post the  form physically
	});
   
        
        
        $("#issue").click(function()
	{
         
		//remove all the class add the messagebox classes and start fading
		$("#msgboxissue").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_POIssueAddFolio_ajax.php",{cgst:$('#cgst').val(),igst:$('#igst').val(),sgst:$('#sgst').val(),cd:$('#cd').val(),po_no1:$('#po_no1').val(),unt_rt:$('#unt_rt').val(),qty_po:$('#qty_po').val(),pur_req_id:$('#pur_req_id').val(), unt_id:$('#unit_id').val(),folio_no1:$('#folio_no1').val(),folio_no2:$('#folio_no2').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no:$('#folio_no').val(),rand:Math.random() } ,function(data)
        
        {                       //alert("Item Issued Successfully");//Your success msg
                                $('#msgboxissue').html(data); 
                                folio_no1.value = ''; 
                                qty_po.value = ''; 
                                unt_rt.value = '';
                                $("#msgboxdisp").empty();
                      
	});
 		return false; //not to post the  form physically
                  
	});
	
         $("#remove").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_DepotQryNew2_ajax.php",{ unit:$('#unit').val(),folio_no1:$('#folio_no1').val(),qty:$('#qty').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no').val(),rand:Math.random() } ,function(data)
        
        {	//alert(data);
                      alert("Item Removed Successfully");//Your success msg
                      $('#msgboxissue').html(data);
                       $("#msgboxdisp").empty();
	});
 		return false; //not to post the  form physically
	});
        
        
         $("#APPROVE").click(function()
	{
		var answer = confirm ("Are You Sure to Approve ?")
                if (answer){
        
        
                $("#msgboxshow").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		$.post("ST_POApprove_ajax.php",{ po_no1:$('#po_no1').val(),po_no1:$('#po_no1').val(),rand:Math.random() } ,function(data)
      
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
        $("#pur_req_id").change(function()
	{
		if(document.getElementById("pur_req_id") == '')
                {$( "#issue" ).prop( "disabled", false );}
                else
                {$( "#issue" ).prop( "disabled", true );}
        
       
	});
        
        
	   
        $("#Show").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox2").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_DepotQryNew11_ajax.php",{ folio_no1:$('#folio_no1').val(),qty:$('#qty').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
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
