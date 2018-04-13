<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$queryI =  "SELECT * FROM item_issue";
$resultI = mysqli_query($cstccon,$queryI) or die(mysqli_error());
if(mysqli_num_rows($resultI) > 0){
     ?>
        <script type="text/javascript">   
            alert("Sorry. Presently materials are being issued by another user.")
            window.location = "CSTC_MainMenu.php";
        </script>
<?php 
}

$unit_from_code=htmlspecialchars($_POST['unit_from_code'],ENT_QUOTES); // B
$unit_to_code=htmlspecialchars($_POST['unit_to_code'],ENT_QUOTES);// K


$v_no_add=htmlspecialchars($_POST['v_no_add'],ENT_QUOTES);
if($v_no_add != ''){
    if(substr($v_no_add,3,1) != $unit_to_code){
        ?>
        <script type="text/javascript">   
            alert("Sorry. Selection of Unit does not match with Unit to which Voucher was issued.")
            window.location = "CSTC_MainMenu.php";
        </script>
<?php 
    }
    if(substr($v_no_add,4,1) == 'R'){
        ?>
        <script type="text/javascript">   
            alert("Sorry. This is a return voucher. Your not allowed to add item to this voucher")
            window.location = "CSTC_MainMenu.php";
        </script>
<?php 
    }
    $queryv = "SELECT * from bintxn WHERE BNTXN_ID = '" . $v_no_add . "' and CREDT = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and substring(BNTXN_ID,10,1) != 'D'";
    $resultv = mysqli_query($cstccon,$queryv) or die(mysqli_error());
    if(mysqli_num_rows($resultv) <= 0){
        ?>
        <script type="text/javascript">   
            alert("Sorry. Either Voucher does not exist or it is not created today or permission denied.")
            window.location = "CSTC_MainMenu.php";
        </script>
<?php 
        
    }
    
}

$query = "SELECT * from unit WHERE UNIT_CODE = '" . $unit_to_code . "'";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
$unit_to_desc = $row['UNIT_DESC']; // KASBA DEPOT
$unit_to = $row['UNIT']; // KD



$remark = $_POST['remark'];
$_SESSION['remark'] = $remark;

$query1 = "SELECT * from unit WHERE UNIT_CODE = '" . $unit_from_code . "'";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
$row1 = mysqli_fetch_assoc($result1);
$unit_from_desc = $row1['UNIT_DESC']; // CENTRAL STORES
$unit_from = $row1['UNIT']; // CS
//$_SESSION['unit_from'] = $unit_from;
//echo $unit_to ;

                                $query =  "DELETE FROM item_issue";
                                $result = mysqli_query($cstccon,$query) or die(mysqli_error());
                                
                              
                               
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Goods Issue</title>
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
				
				<li class="active">Goods Issue</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Goods Issue <small>To Depot / Unit</small></h1>
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
                <h6><span style="color: white;" align="left"><?php echo  "MATERIAL ISSUE FROM  <b>". $unit_from_desc . "</b> To <b>" . $unit_to_desc . "</b>"  ; ?> </span></h6>
                        </div>
		<!-- begin #content -->
<form method="post" action="" id="login_form" >
    <table width="100%" align="center" style="background-color: lightgrey">
        <tr>
            <td>
  		<table align='center' color='black'valign = 'top'  border="0" width="100%"  style="background-color: lightgrey">
                    <tr>
                        <td colspan='3' align='center'>
                                    <h5><font color="#000"><?php
                                    if($v_no_add == ''){
                                     }
                                    else {
                                    echo 'Adding Item to Existing Voucher No. ' . $v_no_add . ' , ' . date('jS F Y') ;    
                                    }
                                        ?>
                                        </font></h5>
                        </td>
                    </tr>
                    <tr>
                        <td  font='black'align='right'><h6><font color="#000">FOLIO NO. : </font></h6></td>
                        <td COLOR='black'align='left'>
                                    <div class="col-md-4">
                                    <input class="form-control"id="folio_no1"  autofocus type="text" size="10"maxlength="10" tabindex="1"/>
                                    </div>
                                    <input class="form-control"type="hidden" size="25" maxlength="25" name="unit_to_new"  id="unit_to_new" tabindex="3" value="<?php echo $unit_to; ?> "/>
                                    <input class="form-control"type="hidden" size="25" maxlength="25" name="unit_from_new"  id="unit_from_new" tabindex="3" value="<?php echo $unit_from; ?> "/>
                                    <input class="form-control"type="hidden" size="25" maxlength="25" name="v_no_add1"  id="v_no_add1" tabindex="3" value="<?php echo $v_no_add; ?> "/>

                        </td>
                        <td align='left'>
                                  <input name="stock1" class="btn btn-info" type="button" id="stock1"  value="Show Details"/>
                                    <input name="stock2" class="btn btn-info" type="button" id="stock2"  value="Hide Details"/>
                        </td>
                    </tr>
                    <tr> 
                        <td align='center'colspan='3'>
                                    <div align='center'id="msgboxdisp"></div>   
                        </td>
                    </tr>
                    <tr> 
                        <td align='center'colspan='3'>
                                    <p></p>
                        </td>
                    </tr>
                    <tr> 
                                <td align='center'colspan='3'>
                                   
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td   align='right'><h6><font color="#000">QUANTITY :</font></h6></td>
                                <td>
                                    <div class="col-md-4">
                                    <input class="form-control"id="qty_to_iss"name="qty_to_iss" type="number" size = "8" tabindex="1"/>
                                    </div>
                                            </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3"><p></p></td>
                            </tr>
                             <tr>
                                
                                <td   align='right'><h6><font color="#000"></font></h6></td>
                                <td align="left">
                            
                                    <input name="Issue" class="btn btn-success"type="button" id="issue"  value="Issue" tabindex="2"/>
                               
                                    <input name="Remove" class="btn btn-danger"type="button" id="remove"  value="Remove"/>
                              </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3"><p></p></td>
                            </tr>
                             <tr>
                                 <td colspan="3"></td>
                             </tr>
                        </table>
                                                           
                      
                       
		     
           </td>
           
      </tr>
    
    <p></p>
   
        <tr>
            <td width="100%" >
           <div id="msgboxissue"></div>   
          
            </td>
      </tr>
    <tr>
            <td width="100%" >
           
          
            </td>
      </tr>
    <p></p>
    <tr>
                                <td ><p></p></td>
                            </tr>
       <tr>
           <td >
          <div align="center">
            <input name="Print" class="btn btn-success"type="button" id="Print"  value="Save and Print"/>
            <input name="Exit" class="btn btn-danger"type="button" id="Exit"  value="Exit"/>
           </div>
           </td>
       </tr>
    <tr>
        
 <td >
 
   

    <!-- DISPLAY ITEM FOR EXISTING VOUCHER -->
 <?php 
 if($v_no_add != ''){
 $sql_itm="SELECT A.PART_NO,A.ITM_QTY,A.ITM_VAL,B.ITM_NM,C.ALT_NO_3,B.UOM_ID FROM bintxnitm A, itm B,current_part_no C where A.BNTXN_ID = '" . $v_no_add . "' and A.PART_NO = C.PART_NO and A.PART_NO = B.PART_NO";
        $result_itm=mysqli_query($cstccon,$sql_itm);
    //    $row_itm=mysqli_fetch_array($result_itm);
       
        echo "<H6><font color='black'>" . "LIST OF ITEMS ISSUED THROUGH VOUCHER NO. " . $v_no_add . "</font></H6>";
        echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';

    //    echo '<table  id="tbl_id" cellpadding="0" cellspacing="0" border="0"  class="TFtable">';
        echo "<tbody>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th align='center'>SRL</th>";
                        echo "<th align='center'>FOLIO NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>UOM</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>QTY ISSUED</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>VALUE</th>";

                        echo "</tr>";
                                                    
                                $x = 1;
                    while ($row_itm = mysqli_fetch_assoc($result_itm)){
                                
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        echo "<td>" . $row_itm['PART_NO'] . "</td>";
                        echo "<td>" . $row_itm['ALT_NO_3'] ."</td>";
                        echo "<td>" . $row_itm['ITM_NM'] . "</td>";
                        echo "<td>" . $row_itm['UOM_ID'] . "</td>";
                        
                      
                        echo "<td align='right'>" . -$row_itm['ITM_QTY'] . "</td>";
                        echo "<td align='right'>" . -$row_itm['ITM_VAL'] . "</td>";
                        echo "</tr>";
                          $x = $x + 1;
                          } 
                        echo "</tbody>";
                        echo "</table>";
 }
                        echo "</div>";
                        echo "</div>"; ?>
           
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
	$("#stock1").click(function()
	{
		$("#msgboxdisp").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
	$.post("CSTC_DepotQryStock_ajax.php",{ unit_to_new:$('#unit_to_new').val(),folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
	
        {                       //alert("Item Issued Successfully");//Your success msg
               
                $('#msgboxdisp').html(data); 
                 
	});
 		return false; //not to post the  form physically
	});
        $("#stock2").click(function()
	{
		$("#msgboxdisp").removeClass().addClass('messagebox').text('').fadeIn(1000);
	$.post("CSTC_DepotQryStock2_ajax.php",{ rand:Math.random() } ,function(data)
	
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
        
        $("#issuehistory1").click(function()
	{   
            
		//remove all the class add the messagebox classes and start fading
		$("#msgboxdisp").removeClass().addClass('messagebox').text('please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_DepotQryIssueHistory_ajax.php",{ unit_to_new:$('#unit_to_new').val(),folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {                       //alert("Item Issued Successfully");//Your success msg
                                $('#msgboxdisp').html(data); 
                           
                      
	});
 		return false; //not to post the  form physically
	});       
        
        $("#unitwise").click(function()
	{   
            
		//remove all the class add the messagebox classes and start fading
		$("#msgboxdisp").removeClass().addClass('messagebox').text('please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_DepotQryUnitwise_ajax.php",{ unit_to_new:$('#unit_to_new').val(),folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
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
		$.post("CSTC_DepotQryNew1_ajax.php",{v_no_add1:$('#v_no_add1').val(),unit_from_new:$('#unit_from_new').val(), unit_to_new:$('#unit_to_new').val(),folio_no1:$('#folio_no1').val(),qty_to_iss:$('#qty_to_iss').val(),rand:Math.random() } ,function(data)
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
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_DepotQryNew2_ajax.php",{ unit_to_new:$('#unit_to_new').val(),folio_no1:$('#folio_no1').val(),qty:$('#qty').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {	//alert(data);
                      alert("Item Removed Successfully");//Your success msg
                      $('#msgboxissue').html(data);
                       $("#msgboxdisp").empty();
	});
 		return false; //not to post the  form physically
	});
        
        
         $("#Display").click(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgboxshow").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ST_ItemSearch_ajax.php",{ folio_nm:$('#folio_nm').val(),rand:Math.random() } ,function(data)
                //$.post("ST_DepotQryNew_ajax.php",{ folio_no1:$('#folio_no1').val(),rand:Math.random() } ,function(data)
        
        {	//alert(data);
                     // alert("Item Removed Successfully");//Your success msg
                      $('#msgboxshowmaster').html(data);
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
               document.location='CSTC_ItemIssueVoucher.php?q=<?php echo $v_no_add ; ?>';}
                else{
                exit(); }
        
        
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
