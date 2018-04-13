<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

 $sql="DELETE  from indntitm_temp";
        $result=mysqli_query($cstccon,$sql);       

$unit = $_SESSION['unit'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }

$query_Recordsetunit = "SELECT * FROM unit";
$Recordsetunit = mysqli_query($cstccon,$query_Recordsetunit) or die(mysqli_error());
$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);

$unit_to_code          = htmlspecialchars($_POST['unit_to'],ENT_QUOTES); 
$ref_no          = htmlspecialchars($_POST['ref_no'],ENT_QUOTES); 
$indent_ref_date          = htmlspecialchars($_POST['indent_ref_date'],ENT_QUOTES); 


//$indent_ref_date = substr($indent_ref_date,8,2) . '-' . substr($indent_ref_date,5,2) . '-' . substr($indent_ref_date,0,4);


$unit = $_SESSION['UNIT']; // unit for operator

$query2 = "SELECT * from unit WHERE UNIT_CODE = '" . $unit_to_code . "'";
$result2 = mysqli_query($cstccon,$query2) or die(mysqli_error());
$row2 = mysqli_fetch_assoc($result2);
$unit_to_desc = $row2['UNIT_DESC'];
$unit_to = $row2['UNIT'];
//$_SESSION['unit_to'] = $unit_to_code;
                        
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>New Indent</title>
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
				
				<li class="active">New Indent</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Create Indent <small>New Indent</small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
            <div class="row">
            <div class="col-md-12">	
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
                <h6><span style="color: white;" align="left">INDENT POSTING FOR :  <?php echo ' ' .$unit_to_desc ?> </span></h6>
                        </div>
                
                
		<form id="login_form"method="post" action="CSTC_Indent1New_ajax.php">
    <table width="100%" align="center" style="background-color: lightgrey">
        
        <tr>
            <td valign="top" width = "100%" align="center">
                <table class="roundedCorners" align='right' color='black'valign = 'top' bgcolor="#ffffff" border="0" width="95%"  >
                    <tr>
                        <td colspan='3' align='center'>
                            <h5><font style="color: black"><?php echo "REFERENCE NO. : " . $ref_no . "  ; DATE : " . $indent_ref_date; ?></font></h5>
                        </td>
                    </tr>
                    <tr>
                        <td align='right'><font style="color: black">FOLIO NO. :</font></td>
                        <td width="2%"></td>
                        <td align='left'>
                            <div class="col-md-4">
                            <input class="form-control"name="folio_no1" id="folio_no1" type="text" size="10"maxlength="10"autofocus="autofocus"/>
                                  </div>
                            <input name="ShowIndent" class="btn btn-info"type="button" id="ShowIndent" tabindex="2" value="Show Active Indents"/>
                                
                            <input type="hidden" size="25" maxlength="25" name="unit_to_code"  id="unit_to_code" tabindex="3" value="<?php echo $unit_to_code; ?> "/>
                                    <input type="hidden" size="25" maxlength="25" name="unit_to1"  id="unit_to1" tabindex="3" value="<?php echo $unit_to; ?> "/>

                                    <input type="hidden" size="25" maxlength="25" name="unit"  id="unit" tabindex="3" value="<?php echo $unit; ?> "/>
                                    <input type="hidden" size="25" maxlength="25" name="unit_from"  id="unit_from" tabindex="3" value="<?php echo $unit_from; ?> "/>
                                    <input type="hidden" size="25" maxlength="25" name="ref_no"  id="ref_no" tabindex="3" value="<?php echo $ref_no; ?> "/>
                                    <input type="hidden" size="25" maxlength="25" name="req_dt"  id="req_dt" tabindex="3" value="<?php echo $indent_ref_date; ?> "/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' align="center">
                            <table width="100%" ALIGN="CENTER">
                                <tr>
                                    <td><p></p></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div id="indentshow" style="width:80%;"></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div >
<table class='roundedCorners' align='cente' color='black'valign = 'top' bgcolor='#ffffff' border='0' width='95%'  >
<tr>
<td colspan='3'><p></p></td></tr><tr>
<td align='right'><font style='color: black'>CHANGE PART NUMBER :</font></td>
<td width='2%'></td><td COLOR='black'align='left'>
    <div class="col-md-4">
    <input class="form-control"name='alt_no_3' id='alt_no_3' type='text' size='15'maxlength='15'placeholder="Type to change only"/>
    </div>
    </td>
                     </tr>
                     <tr>
                        <td colspan='3'><p></p></td>
                     </tr>
                     <tr>
                         <td colspan='3'></td>
                     </tr>
                     <tr>
                         <td align='right'><font style='color: black'>LAST YEAR CONSUMPTION :</font></td>
                         <td width='2%'></td>
                         <td COLOR='black'align='left'>
                             <div class="col-md-4">
                             <input class="form-control"name='lst_cons' id='lst_cons' type='number' size='10'maxlength='10'/>
                             </div>
                             </td>
                     </tr>
                     <tr>
                         <td colspan='3'><p></p></td>
                     </tr>
                     <tr>
                         <td align='right'><font style='color: black'>INDENT QUANTITY :</font></td>
                         <td width='2%'></td>
                         <td COLOR='black'align='left'>
                             <div class="col-md-4">
                             <input class="form-control"name='req_qty' id='req_qty' type='number' size='10'maxlength='10'/>
                             </div>
                             </td>
                     </tr>
                     <tr>
<td colspan='3'><p></p></td>
                     </tr>
                     <tr>
                         <td align='right'><font style='color: black'>STOCK AT COST CENTER :</font></td>
                         <td width='2%'></td>
                         <td COLOR='black'align='left'>
                             <div class="col-md-4">
                             <input class="form-control"name='cur_stk' id='cur_stk' type='number' size='10'maxlength='10'/>
                             </div>
                             </td>
                     </tr>
                     <tr>
                         <td colspan='3'><p></p></td>
                     </tr>
                     <tr>
                         <td align='right'><font style='color: black'>STOCK AS ON :</font></td>
                         <td width='2%'></td>    
                          <td >
                                                <div class="form-group" style="width:230px;">
                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                               
<div class="col-md-12">
                                                    <input class="form-control"type="text" name="stock_date"class="form-control pull-right" id="stock_date"placeholder="Select Date" maxlength="40" size="20" readonly="yes" >
</div>
                                                </div>
                                                </div>
                                            </td>
                     </tr>
                     <tr>
<td colspan='3'><p></p></td>
                     </tr>
                     <tr>
                         <td></td>
                         <td width='2%'></td>
                         <td>    
                             <input name='issue' class='btn btn-success'type='button' id='issue'  value='ADD ITEM'/>
                             <input name='Remove' class='btn btn-danger'type='button' id='remove'  value='REMOVE'/>
                         </td>
                     </tr>
                     <tr>
                         <td   align='right'><h6><font color='#000'></font></h6>
                         </td>
                         <td width='2%'></td>
                         <td>
                         </td>
                     </tr>   
                 </table>
                </div>                       
            </td>
        </tr>
        <tr>
            <td>
                <table class="roundedCorners" align='center' color='black'valign = 'top' bgcolor="#ffffff" border="0" width="90%"  >
                    <tr>
                        <td width="100%">
                            <div id="msgboxissue"style="width:100%;">
                                NO ITEM POSTED FOR INDENT
                            </div>   
                        </td>
                    </tr>
                    <tr>
                        <td><p></p></td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                    <input type="hidden" name="ref_no"  id="ref_no" tabindex="3" value="<?php echo $ref_no; ?> "/>
                    <input type="hidden" name="indent_ref_date"  id="indent_ref_date" tabindex="3" value="<?php echo $indent_ref_date; ?> "/>
                    <input name="submit" class="btn btn-success"type="submit" id="submit"  value="Save Indent"/>
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
    
    $("#disphide").hide();
    
  
    
    
    	$("#requisition").click(function()
	{
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		$.post("CSTC_POPurReq_ajax.php",{ folio_no1:$('#folio_no1').val(),unt_id:$('#unt_id').val(),rand:Math.random() } ,function(data)
        {                    
                $('#msgboxdisp1').html(data); 
                 
	});
 		return false; //not to post the  form physically
	});
   
            
        $("#issue").click(function()
	{
         
		//remove all the class add the messagebox classes and start fading
		$("#msgboxissue").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_Indent1_ajax.php",{alt_no_3:$('#alt_no_3').val(),folio_no1:$('#folio_no1').val(),req_qty:$('#req_qty').val(),req_dt:$('#req_dt').val(),stock_date:$('#stock_date').val(), lst_cons:$('#lst_cons').val(),cur_stk:$('#cur_stk').val(),rand:Math.random() } ,function(data)
        
        {                      
                                $('#msgboxissue').html(data); 
                                folio_no1.value = ''; 
                                req_qty.value = ''; 
                                lst_cons.value = '';
                                cur_stk.value = '';
                                 alt_no_3.value = '';
                                $("#msgboxdisp").empty();
                                $("#indentshow").empty();
                      
	});
 		return false; //not to post the  form physically
                  
	});
	
         $("#remove").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		$.post("ST_Indent1Remove_ajax.php",{ unit:$('#unit').val(),folio_no1:$('#folio_no1').val(),qty:$('#qty').val(),rand:Math.random() } ,function(data)
        
        {	//alert(data);
                      alert("Item Removed Successfully");//Your success msg
                      $('#msgboxissue').html(data);
                       $("#msgboxdisp").empty();
	});
 		return false; //not to post the  form physically
	});
        
        
        
       
        
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
        
        $("#Display").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgboxshow").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		$.post("ST_ItemSearch_ajax.php",{ folio_nm:$('#folio_nm').val(),rand:Math.random() } ,function(data)
        
        {	//alert(data);
                      $('#msgboxshow').html(data);
                      folio_nm.value = '';
	});
 		return false; //not to post the  form physically
	});
        $("#ShowIndent").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#indentshow").removeClass().addClass('indentshow').text('Validating....').fadeIn(1000);
		$.post("CSTC_ItemSearchIndent_ajax.php",{unit_to1:$('#unit_to1').val(),folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {	//alert(data);
                      
                      
                     
                     
                      $('#indentshow').html(data);   
                      
                      
	});
 		return false; //not to post the  form physically
	});
	   
        $("#Show").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox2").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		$.post("CSTC_DepotQryNew11_ajax.php",{ folio_no1:$('#folio_no1').val(),qty:$('#qty').val(),rand:Math.random() } ,function(data)
        
        {        //alert(data);               //alert("Item Issued Successfully");//Your success msg
                                $('#itemdetail').html(data); 
                  $("#msgbox2").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
				
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
