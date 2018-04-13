<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$pr_no          = htmlspecialchars($_POST['pr_no1'],ENT_QUOTES); 
if($pr_no == ''){$pr_no = $_SESSION['pr_no'];}

$sql_itmz1="select * FROM purreqitm where PUR_REQ_ID = '" . $pr_no . "'";
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);
$row_itmz1 = mysqli_fetch_assoc($result_itmz1);
if(mysqli_num_rows($result_itmz1)>0) {
      

$unit = $_SESSION['unit'];

}
 
$query_Recordsetunit = "SELECT * FROM unit";
$Recordsetunit = mysqli_query($cstccon,$query_Recordsetunit) or die(mysqli_error());
$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);
                                   
                               
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Update Purchase Requisition</title>
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
        <link href="IMS_Web.css" rel="stylesheet" />
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
				
				<li class="active">Update Purchase Requisition</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Update Purchase Requisition <small>Update Existing</small></h1>
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
                <h6><span style="color: white;" align="left">MODIFICATION OF PURCHASE REQUISITION.  <?php echo ' ' .date('jS F Y')  ?>  </span></h6>
                        </div>
		<form id="login_form"method="post" action="CSTC_POIssuePrint.php">
    
                     
    <table width="100%" align="center" style="background-color: lightgray">
        
                   
        
          <tr>
              <td colspan='2'align="center" valign="top" >
  			
			
                  <p></p>      <p></p>   <p></p>    
   
                        <table align='center' color='black'valign = 'top' style="background-color: lightgray"border="0" width="70%"   >
                           
                          
                          
                            
                            <tr> 
                                <td align='center'colspan='2'>
                                <?php   $queryx1 = "SELECT * from purreqitm a,itm b where a.PART_NO = b.PART_NO AND a.PUR_REQ_ID = '" . $pr_no . "'";
                                        $Recordsetx1 = mysqli_query($cstccon,$queryx1) or die(mysqli_error());
                                        //$rowx1 = mysqli_fetch_assoc($Recordsetx1);?>
                                       
                                    <table align='left'width='90%'class="TFtable">
                                        <tr>
                                            <th>SRL.</th>
                                            <th>FOLIO NO.</th>
                                            <th>DESCRIPTION</th>
                                            <th>UNIT</th>
                                            <th>PLANNED QTY</th>
                                            <th>TC QTY</th>
                                            <th>PB QTY</th>
                                          
                                          
                                        </tr>
                                        <?php
                                        $srl = 1;
                                        while ($rowx1 = mysqli_fetch_assoc($Recordsetx1)){
                                         echo "<tr>";
                                         echo "<td>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td>";
                                         echo $rowx1['PART_NO'];
                                         echo "</td>";
                                          echo "<td>";
                                         echo $rowx1['ITM_NM'];
                                         echo "</td>";
                                          echo "<td>";
                                         echo $rowx1['UOM_ID'];
                                         echo "</td>";
                                        
                                         echo "<td align='right'>";
                                         echo $rowx1['PUR_PLN_QTY'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx1['TC_QTY'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx1['PB_QTY'];
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
                           
                            <tr>
                                <td  font='black'align='left'><h6><font color="#000">FOLIO NO. : </font></h6></td>
                                <td COLOR='black'align='left'>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                    <select class="form-control"name="folio_no1" id="folio_no1" tabindex="2">
                          	<?php
                                $query = "SELECT PART_NO FROM purreqitm WHERE PUR_REQ_ID = '" . $pr_no . "'";
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
                                 <td align='center'colspan='2'><p></p></td>
                            </tr>
                            
                            
                           
                             <tr>
                                
                                <td   align='left'><h6><font color="#000">QTY APPROVED BY TC :</font></h6></td>
                                <td>
                                    <div class="col-md-6">
                                    <input class="form-control"id="tc_qty"name="tc_qty" type="text" size = "8"onkeypress="return isNumberKeywithDec(event)"/>
                                    </div>
                               
                              </td>
                             </tr>
                             <tr><td colspan="2"><p></p></td></tr>
                                <tr>
                                
                                <td   align='left'><h6><font color="#000">QTY APPROVED BY PB :</font></h6></td>
                                <td>
                                    <div class="col-md-6">
                                    <input class="form-control"id="pb_qty"name="pb_qty" type="text" size = "8"onkeypress="return isNumberKeywithDec(event)"/>
                                    </div>
                                    <input class="form-control"id="pr_no"name="pr_no" type="hidden" size = "8" value="<?php echo $pr_no ; ?>"/>

                                    <input name="Issue" class="btn btn-success"type="button" id="issue"  value="Update"/>
                               
                              </td>
                                
                            </tr>
                            <tr><td colspan="2"><p></p></td></tr>
                        </table>
                                                           
                      
                       
		     
           </td>
                
      </tr>
    </table>
    <p></p>
   <table width="100%" align="center" bgcolor="#ffffff" class="rounded-corners">
        
       <tr>
            
           <td width="100%">
           
		
		

                
             <div id="msgboxissue"></div>   
           
            </td>
      </tr>
                                  
   </table> 
    <div align="center">
                               
                                    <input name="Exit" class="btn btn-primary"type="button" id="Exit"  value="Exit"/>
    
    </div>
   
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
    
  $("#issue").click(function()
	{
         
		//remove all the class add the messagebox classes and start fading
		$("#msgboxissue").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("CSTC_PRModify_ajax.php",{pr_no:$('#pr_no').val(),folio_no1:$('#folio_no1').val(),tc_qty:$('#tc_qty').val(),pb_qty:$('#pb_qty').val(),rand:Math.random() } ,function(data)
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
