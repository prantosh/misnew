<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

 $po_no          = $_GET['po_no']; 
$_SESSION['po_no'] = $po_no;


 

if($po_no == ''){$po_no = $_SESSION['po_no'];}

$sql_itmn="SELECT * FROM posch where PO_NO = '" . $po_no . "'";
$resultn=mysqli_query($cstccon,$sql_itmn);
if(mysqli_num_rows($resultn) < 1){
    $sql_itmn1="insert into posch(PO_NO) VALUES('" . $po_no . "')";
   // $resultn1=mysqli_query($cstccon,$sql_itmn1);
}
								
//$po_no = $_SESSION['po_no'];   
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Purchase Order Schedule</title>
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
				
				<li class="active">Modify PO Schedule</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Modify PO Schedule <small>Purchase Order</small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
            <div class="row">
            <div class="col-md-12" >	
		<!-- begin #content -->
                <table width='90%' align='center'style="background-color: lightgrey"> 
    
     <tr style="background-color: #009933">
            <td >
                <table width="100%" align="center" >
                    <tr style="background-color: purple">
                        <td colspan='1'>
                            <h6><span style="color: white;" align="left">DELIVERY SCHEDULE CREATION / MODIFICATION FOR PURCHASE ORDER NO. :  <b><?php echo ' ' . $po_no  ?> </b></span></h6>
                        </td>
                        <td align='right'>
                            <a href="CSTC_FindItem_NonEdit.php" class="btn btn-info" role="button"><img src="images/find.png"style="width:20px;height:20px;">Find Item</a>
                
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    <tr>
        <td style='background-color: lightgrey'>
            <div>
                <?php include('CSTC_POScheduleadd1.php'); ?></div>
            <div>
                <?php include('CSTC_POScheduledelete1.php'); ?></div>
            <p></p>
<div class="row-fluid">
         <?php  $sql_itm="SELECT * FROM posch where PO_NO = '" . $po_no . "'";
                $result=mysqli_query($cstccon,$sql_itm);
              ?>
								
         
<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">
                            
                            <thead>
                                <tr>
                                    <th style="text-align:center;"><b>SRL</b> </th>
                                    <th style="text-align:'left';"><b>SCHEDULE DATE</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th style="text-align:center;">DELIVERY QUANTITY (%)<i class="fa fa-fw fa-sort"></i></th>
                                    
                                    <th style="text-align:center;">ACTION</th>
                                   
									
                                </tr>
                            </thead>
                            <tbody>
								<?php
                                                                $i=1;
								//session_start();
                                                               while ($row= mysqli_fetch_array ($result) ){
								//$id=$row['student_id'];
                                                                $id = $row['DLV_DT'];
                                                                $idcmb = $id.$po_no;
                                                                
								?>
								<tr>
                                                                
								<td style="text-align:center; word-break:break-all; "> <?php echo $row ['LINE']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['DLV_DT']; ?></td>
                                                                <td style="text-align:center; word-break:break-all; "> <?php echo $row ['DLV_QTY']; ?></td>
                                                                
								                                             
                                                                
								<td style="text-align:center; ">
                                                                    
								
                                                                
                                                                
                                                                <a href="#modal-warning_sch1"  data-toggle="modal"  ><b>DELETE</b> </a>
                <div class="modal modal-warning fade" id="modal-warning_sch1" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;"><?php echo "Are you Sure you want Delete? DELIVERY SCHEDULE DATE = " . $id ; ?></span></h4>
                            </div>
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
								                                                 
                                                                <!-- Modal -->
								
								<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
								<a href="CSTC_POScheduleDelete.php<?php echo '?id='.$idcmb; ?>" class="btn btn-danger">Yes</a>
								</div>
								</div>
								</div>
                </div>
                        </td>
								</tr>

								

								<?php $i=$i+1;} ?>
                            </tbody>
                        </table>
              

    <div align ="center">      
        <a href="CSTC_MainMenu.php" class="btn btn-danger">EXIT</a>     </div>
       
        </div>
    
        </td>
    </tr>
</table>
 

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
