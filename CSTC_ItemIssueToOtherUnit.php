<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$unit_to_iss=htmlspecialchars($_POST['unit_to_iss'],ENT_QUOTES);
$issue_date=htmlspecialchars($_POST['issue_date5'],ENT_QUOTES);
//echo $unit_to_iss ;
$query = "SELECT * from unit WHERE UNIT = '" . $unit_to_iss . "'";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
$unit_to_iss_desc = $row['UNIT_DESC'];

$query1 = "SELECT * from unit WHERE UNIT = '" . $unit . "'";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
$row1 = mysqli_fetch_assoc($result1);
$unit_desc1 = $row['UNIT_DESC1'];


$remark = $_POST['remark'];
$_SESSION['remark'] = $remark;


                                $query =  "DELETE FROM item_issue_to_other_unit where UNIT_FROM = '" . $unit . "'";
                                $result = mysqli_query($cstccon,$query) or die(mysqli_error());
                                
                             
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Material Issue to Other Unit</title>
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
				
				<li class="active">Material Issue </li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Material Issue <small>For Other Unit</small></h1>
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
                            <h6><span style="color: white;" align="left">MATERIAL ISSUE TO <b><?php echo ' ' .$unit_to_iss_desc . ' </b>ON<b> ' . $issue_date . '</b>';?> </span></h6>
                        </div>
		<!-- begin #content -->
<form method="post" action="" id="login_form" >
       <p></p>	<p></p>
       <table width="100%" align="center" style="background-color: lightgrey">
                    
             
                            
              
          <tr>
              
            <td valign="top"width = "100%">
  			
			
                           
   
                        <table align='center' color='black'valign = 'top'  border="0" width="100%" >
                            <tr>
                                <td colspan='2' align='center'>
                                    <h6><font color="#000"><?php echo $unit_to_desc ; ?></font></h6>
                                </td>
                            </tr>
                            <tr>
                                <td  font='black'align='right'><h6><font color="#000">FOLIO NO. : </font></h6></td>
                                <td COLOR='black'align='left'>
                                    <div class="col-md-4">
                                    <input class="form-control"id="folio_no1" name="folio_no1" autofocus type="text" size="10"maxlength="10" tabindex="1"/>
                                    </div> 
                                   </td>
                                
                                
                            </tr>
                            <tr><td colspan="2"><p></p></td></tr>
                            <tr>
                                <td></td>
                                <td align='left'>
                                  <input id = "stock2" class="btn btn-info" type="button"  value="Show Stock"/>
                                      </td>
                            </tr>
                            <tr><td colspan="2"><p></p></td></tr>
                           
                            <tr> 
                                <td align='center'colspan='2'>
                                    <div align='center'id="msgboxdisp"></div>   
                                </td>
                            </tr>
                             <tr><td colspan="2"><p></p></td></tr>
                            
                            <tr>
                                
                                <td   align='right'><h6><font color="#000">QUANTITY :</font></h6></td>
                                <td>
                                    <div class="col-md-4">
                                    <input class="form-control"id="qty_to_other_unit"name="qty_to_other_unit" type="number" size = "8" tabindex="1"/>
                                    </div>
                                            </td>
                                
                            </tr>
                            <tr><td colspan="2"><p></p></td></tr>
                             <tr>
                                
                                <td   align='right'><h6><font color="#000"></font></h6></td>
                                <td align="left">
                                    <input class="form-control"name="issue_date2" type="hidden" id="issue_date2" value= "<?php echo $issue_date ; ?>"/>

                                    <input class="form-control"name="unit_to_iss1" type="hidden" id="unit_to_iss1" value= "<?php echo $unit_to_iss ; ?>"/>

                                    <input name="Issue" class="btn btn-success"type="button" id="issue"  value="Issue" tabindex="2"/>
                               
                                    <input name="Remove" class="btn btn-danger"type="button" id="remove"  value="Remove"/>
                              </td>
                                
                            </tr>
                             <tr><td colspan="2"><p></p></td></tr>
                        </table>
                                                           
                      
                       
		     
           </td>
             
           
          </tr>        
      
    <p></p>
   <tr >
            <td colspan='2'>
   <table width="90%" align="center" bgcolor="#ffffff" class="TFtable">
        <tr>
            <td width="90%">
           <div id="msgboxissue"></div>   
          
            </td>
      </tr>
       <tr>
           <td>
          <div align="center">
            <input name="Print" class="btn btn-success"type="button" id="Print"  value="Save"/>
            <input name="Exit" class="btn btn-danger"type="button" id="Exit"  value="Exit"/>
           </div>
         </td>
       </tr>
       
   </table> 
            </td>
   </tr>
    </table>
   
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
    
   $("#login_form").submit(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox2").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {	
            alert(data);
		  if(data=='yes') 
		  {
                    $('#msgbox2').html(data);//Your success msg
            	  }
		  else 
		  {
		  	$("#msgbox2").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  $(this).html('Sorry, Invalid PF a/c number....').addClass('messageboxerror').fadeTo(900,1);
		        });		
                  }   
	});
 		return false; //not to post the  form physically
	});
	$("#stock2").click(function()
	{
		$("#msgboxdisp").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		$.post("CSTC_DepotQryStockDepot_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        {                       //alert("Item Issued Successfully");//Your success msg
                $('#msgboxdisp').html(data); 
                 
	});
 		return false; //not to post the  form physically
	});
   
        $("#search_folio").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_DepotQryStock1_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {                       //alert("Item Issued Successfully");//Your success msg
                            var w = 400;
                            var h = 350;
                            var left = Number((screen.width/2)-(w/2));
                            var tops = Number((screen.height/2)-(h/2));      
                         newwindow=window.open('ST_SearchFolio.php','name',"directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width="+w+",height="+h+",left="+left+",top="+tops);
                         if (window.focus) {newwindow.focus()}
                         return false;
                         
                       // $('#msgboxdisp').html(data); 
                           
                      
	});
 		return false; //not to post the  form physically
	});       
            
        
        $("#issue").click(function()
	{
         
		//remove all the class add the messagebox classes and start fading
		$("#msgboxissue").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_DepotQryNewDepotOD1_ajax.php",{ issue_date2:$('#issue_date2').val(),unit_to_iss1:$('#unit_to_iss1').val(),folio_no1:$('#folio_no1').val(),qty_to_other_unit:$('#qty_to_other_unit').val(),rand:Math.random() } ,function(data)
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
	
         $("#remove").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgboxdisp").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_DepotQryNew2_ajax.php",{ vehno:$('#vehno').val(),folio_no1:$('#folio_no1').val(),qty:$('#qty').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {	//alert(data);
                      alert("Item Removed Successfully");//Your success msg
                      $('#msgboxissue').html(data);
                       $("#msgboxdisp").empty();
	});
 		return false; //not to post the  form physically
	});
        
        
         $("#Display_depot").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgboxshow").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_ItemSearchDepot_ajax.php",{ folio_nm:$('#folio_nm').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {	//alert(data);
                     // alert("Item Removed Successfully");//Your success msg
                      $('#msgboxshow').html(data);
                      folio_nm.value = '';
	});
 		return false; //not to post the  form physically
	});
       
        
        $("#Exit").click(function()
	{
		document.location='CSTC_MainMenu.php';
                return false; //not to post the  form physically
	});
        
         $("#Print").click(function()
	{
                var answer = confirm ("Are You Sure to Save ?")
                if (answer){
               document.location='CSTC_ItemIssueVoucherOtherDepot.php';}
                else{
                return false; }
                
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
