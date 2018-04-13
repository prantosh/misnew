<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$po_no          = htmlspecialchars($_POST['po_no'],ENT_QUOTES); 
if($po_no == ''){$po_no = $_SESSION['po_no'];}

$sql_itmz1="select * FROM po where po_no = '" . $po_no . "' AND PAY_TRM = '03'";
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);
$row_itmz1 = mysqli_fetch_assoc($result_itmz1);
if(mysqli_num_rows($result_itmz1)>0  )  {

$unit = $_SESSION['unit'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
 
 
$unt_id         =  $row_itmz1['UNT_ID'];
$po_dt          =  $row_itmz1['PO_DT'];
$vnd_id         =  $row_itmz1['VND_ID'];

$pay_trm        =  $row_itmz1['PAY_TRM'];

 

$query_Recordsetunit = "SELECT * FROM unit";
$Recordsetunit = mysqli_query($cstccon,$query_Recordsetunit) or die(mysqli_error());
$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);

$query2t = "SELECT * from vnd WHERE vnd_id = '" . $vnd_id . "'";
$result2t = mysqli_query($cstccon,$query2t) or die(mysqli_error());

$row2t = mysqli_fetch_assoc($result2t);  
$vnd_nm = $row2t['VND_NM'];
 
 
$unit = $_SESSION['UNIT']; // unit for operator
                       
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>New Payment Propossal</title>
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
				
				<li class="active">Create Payment Proposal</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Payment Proposal <small>New Payment Proposal</small></h1>
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
                <h6><span style="color: white;" align="left">PAYMENT PROPOSAL CREATION :  PURCHASE ORDER NO.    <?php echo ' ' .$po_no . " To " . $vnd_nm ;  ?> </span></h6>
                        </div>
		<!-- begin #content -->
<table width="100%" align="center">
        <tr>
            <td>
<form id="login_form"method="post" action="CSTC_PaymentProposalPrint.php">
    
			
                        
            
    <table width="100%" align="center"  class="roundedCorners" style="background-color: lightgrey">
        
          <tr>
              <td valign="top" width = "5%"></td>
            <td valign="top" >
  			
			
                           
   
                        <table align='right'valign = 'top' style="background-color: lightgrey" border="0" width="95%"   >
                           
                            
                            <tr>
                                <td align='left'>PROPOSAL DATE:</td>
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
                            
                            <tr>
                                <td  font='black'align='left'></td>
                                <td COLOR='black'align='left'>
                                </td>
                                
                                
                            </tr>
                               <tr>
                                <td colspan="2"><p></p></td>
                            </tr>  
                            <tr>
                                <td align='left'>COST CENTER:</td>
                                <td align='left'>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                <select class="form-control"name="unt_id" id="unt_id" tabindex="2">
                          	<?php
                                $queryx = "SELECT * FROM unit WHERE UNIT_CODE = '" . $unt_id . "'";
$Recordsetx = mysqli_query($cstccon,$queryx) or die(mysqli_error());
$rowx = mysqli_fetch_assoc($Recordsetx);
$unit_desc = $rowx['UNIT_DESC'];?>
                                    <option value="<?php echo $unt_id ; ?>"><?php echo $unit_desc ; ?></option>
			<?php	do {  ?>
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
                                <td align='left'>INVOICE NO:</td>
                                <td align='left'>
                                    <div class="col-md-4">
                                  <input class="form-control"type='text' name='bill_no' id='bill_no'value="">
                                    </div>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="2"><p></p></td>
                            </tr>
                            <tr>
                                <td align='left'>INVOICE DATE:</td>
                                <td align='left'>
                                    <div class="form-group" style="width:230px;">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control"type="text" name="bill_dt"class="form-control pull-right" id="bill_dt"placeholder="Select Date" maxlength="40" size="20" readonly="yes" >
                                                </div>
                                                </div>
                                
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><p></p></td>
                            </tr>
                            <tr>
                                <td  font='black'align='left'>REMARK : </td>
                                <td align='left'>
                                    <textarea name = "rmk" id = "rmk"style="resize:none;height:80px; width:425px">
<?php echo $note ?>
</textarea>
                            
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><p></p></td>
                            </tr>
                            <tr> 
                                <td align='center'colspan='2'>
                                <?php   $queryx1 = "SELECT A.PO_NO PO_NO1,A.PART_NO PART_NO1,A.UOM_ID UOM_ID1,A.PO_QTY PO_QTY1,A.UNT_RT UNT_RT1,B.ITM_NM ITM_NM1,B.ALT_NO ALT_NO1 FROM poitm A, itm B  WHERE A.PART_NO = B.PART_NO AND A.PO_NO = '" . $po_no . "'";
                                        $Recordsetx1 = mysqli_query($cstccon,$queryx1) or die(mysqli_error());
                                        //$rowx1 = mysqli_fetch_assoc($Recordsetx1);?>
                                       
<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">
                                        <tr>
                                            <th>SRL.</th>
                                            <th>FOLIO NO.</th>
                                            <th>PART NO.</th>
                                            <th>DESCRIPTION</th>
                                            <th>UNIT</th>
                                            <th>BILLED QTY.</th>
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
                                         echo "<td  align='right'>";
$sql1="SELECT a.PO_LINE po_line1,sum(a.OFR_QTY) tot_offr_qty FROM billitm a,bill b WHERE a.PO_LINE = '" . $rowx1['PART_NO1'] . "' and b.ORD_NO = '" . $po_no . "' and a.BIL_ID = b.BIL_ID group by a.PO_LINE";
$result1=mysqli_query($cstccon,$sql1);
if(mysqli_num_rows($result1) > 0){
$row1=mysqli_fetch_array($result1);
$ofr_qty_billed = $row1['tot_offr_qty'];
echo $ofr_qty_billed;}
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
                            <tr>
                                <td colspan='2'>
                            </tr>
                           
                            
                            <p></p>
                             <p></p>
                           
                            
                             <tr>
                                <td align='center'colspan='2'></td>
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
                        </table>
                                                           
                      
                       
		     
           </td>
           </tr>
          </table>
    <table width="100%" align="center"  class="roundedCorners">
        <tr>
               
            <td valign="top" >
                
                   <table width="100%" align="center"  class="roundedCorners"style="background-color: lightgrey">

                    <tr>
                                <td  align='right'><h6>FOLIO NO. : </h6></td>
                                <td align='left'>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                    <select class="form-control"name="folio_no1" id="folio_no1" tabindex="2">
                          	<?php
                                $query = "SELECT PART_NO FROM poitm WHERE PO_NO = '" . $po_no . "'";
                                $Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
                                $row = mysqli_fetch_assoc($Recordsetx);
                                ?>
			<?php	while ($row = mysqli_fetch_assoc($Recordset)) {  ?>
                                        <option value="<?php echo $row['PART_NO']?>"><?php echo $row['PART_NO']?></option>
                          	<?php
					} 
  						$rows = mysqli_num_rows($Recordset);
  						if($rows > 0) {
      						mysqli_data_seek($Recordset, 0);
	  					$row = mysqli_fetch_assoc($Recordset);
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
                                <td   align='right'><h6>OFFERED QUANTITY :</h6></td>
                                <td>
                                    <div class="col-md-4">
                                    <input class="form-control"id="ofr_qty1"name="ofr_qty1" type="number" size = "8"/>
                                    </div>
                                    <input class="form-control"id="po_no1"name="po_no1" type="hidden" value="<?php echo $po_no ; ?>"/>
                                    <input class="form-control"id="vnd_id"name="vnd_id" type="hidden" value="<?php echo $vnd_id ; ?>"/>
                                    <input class="form-control"id="vnd_nm"name="vnd_nm" type="hidden" value="<?php echo $vnd_nm ; ?>"/>
                                    <input class="form-control"id="po_dt"name="po_dt" type="hidden" value="<?php echo $po_dt ; ?>"/>
                                </td>
                    </tr>
                    <tr>
                                <td colspan="2"><p></p></td>
                            </tr>
                    <tr>
                                <td   align='right'><h6>GROSS VALUE :</h6></td>
                                <td>
                                    <div class="col-md-4">
                                        <input class="form-control"id="ofr_val1"name="ofr_val1" type="number" size = "8"/>
                                    </div>
                                    </td>
                    </tr>
                    <tr>
                                <td colspan="2"><p></p></td>
                            </tr>
                    <tr>
                                <td></td>
                                <td>
                                    <input name="Issue" class="btn btn-success"type="button" id="issue"  value="ADD FOLIO"/>
                                </td>
                    </tr>
                    <tr>
                                <td colspan="2"><p></p></td>
                            </tr>
                    <tr>
                        <td colspan="2">
                            <div id="msgboxissue"></div>
                            <p></p>
                <div align="center">
                <input name="submit" class="btn btn-success"type="submit" id="submit"  value="Save and Print"/>
                <input name="Exit" class="btn btn-danger"type="button" id="Exit"  value="Exit"/>
                </div>
                        </td>
                    </tr>
                
                </table>   
           </td>
              
      </tr>
        
    </table>
    <p></p>
   
    
   
</form>
</td>
          </tr>
    </table>
                </div>
<?php }

            
else
{

?> 
    <script language="javascript">
            alert('Sorry. Purchase Order Does not Exist OR Payment tenm is other than ADVANCE');
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
    
    $("#issue").click(function()
	{
         
		//remove all the class add the messagebox classes and start fading
		$("#msgboxissue").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_PaymentProposalTemp1_ajax.php",{ folio_no1:$('#folio_no1').val(),po_no1:$('#po_no1').val(),ofr_qty1:$('#ofr_qty1').val(),ofr_val1:$('#ofr_val1').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {                       //alert("Item Issued Successfully");//Your success msg
                                $('#msgboxissue').html(data); 
                                folio_no1.value = ''; 
                                
                                document.getElementById("folio_no1").focus();
                                qty.value = ''; 
                                $("#msgboxdisp").empty();
                      
	});
 		return false; //not to post the  form physically
                  
	});
        $("#advnc_no").blur(function()
	{
         
		//remove all the class add the messagebox classes and start fading
		$("#msgboxissue1").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_CheckPaymentProposalNo_ajax.php",{ advnc_no:$('#advnc_no').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {                      
            
       // alert(data);
		  if(data=='yes') //if correct login detail
		  {
		  	alert("Proposal Number Already Exists.")  ;      
                        advnc_no.value = ''; 
                        document.getElementById("advnc_no").focus();
                         }
        
       
	});
 		return false; //not to post the  form physically
                  
	});
	
	
       
          
        $("#Exit").click(function()
	{
		document.location='CSTC_MainMenu.php';
                return false; //not to post the  form physically
	});
        
        App.init();
			Dashboard.init();
        
			 FormPlugins.init();
});
</script>	
	
</body>
</html>
