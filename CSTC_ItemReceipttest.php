<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}


$query32q = "SELECT * from item_receive_ctrl";
$result32q = mysqli_query($cstccon,$query32q) or die(mysqli_error());

if(mysqli_num_rows($result32q) <= 0){
    
$unit_to =htmlspecialchars($_POST['unit_to'],ENT_QUOTES);    
$po_no1 =htmlspecialchars($_POST['po_no'],ENT_QUOTES);
$advnc_no1 =htmlspecialchars($_POST['advnc_no_set'],ENT_QUOTES);
$advnc_fin_yr1 =htmlspecialchars($_POST['advnc_fin_yr'],ENT_QUOTES);
$remark1 =htmlspecialchars($_POST['remark'],ENT_QUOTES);
$challan_no1 = htmlspecialchars($_POST['challan_no'],ENT_QUOTES);

$challan_date1 = htmlspecialchars($_POST['challan_date'],ENT_QUOTES);
$challan_date1 = substr($challan_date1,6,4) . '-' . substr($challan_date1, 3,2) . '-' . substr($challan_date1, 0,2) ;
$dlv_doc =htmlspecialchars($_POST['challan_no'],ENT_QUOTES);
$dlv_dt =htmlspecialchars($_POST['challan_date'],ENT_QUOTES);

    $query32q1i = "insert into item_receive_ctrl (unit_to,po_no,challan_no,challan_date,advnc_no,advnc_fin_yr,remark) values('" . $unit_to . "','" . $po_no1 . "','" . $challan_no1 . "','" . $challan_date1 . "','" . $advnc_no1 . "','" . $advnc_fin_yr1 . "','" . $remark1 . "')";
    $result32q1i = mysqli_query($cstccon,$query32q1i) or die(mysqli_error());
    
}
$query32qn = "SELECT * from item_receive_ctrl";
$result32qn = mysqli_query($cstccon,$query32qn) or die(mysqli_error());
$row32qn = mysqli_fetch_assoc($result32qn);
$po_no = $row32qn['po_no'];
$challan_no  = $row32qn['challan_no'];
$challan_date = $row32qn['challan_date'];
$advnc_no = $row32qn['advnc_no'];
$remark = $row32qn['remark'];
$unit_to = $row32qn['unit_to'];
$query32xx = "SELECT * from po WHERE PO_NO = '" . $po_no . "'";
$result32xx = mysqli_query($cstccon,$query32xx) or die(mysqli_error());
$row32xx = mysqli_fetch_assoc($result32xx);
$vnd_id = $row32xx['VND_ID'];


$query32 = "SELECT * from po WHERE PO_NO = '" . $po_no . "'";
$result32 = mysqli_query($cstccon,$query32) or die(mysqli_error());
$row32 = mysqli_fetch_assoc($result32);

if($row32['STS'] == 'A'){


if($row32['PAY_TRM'] == '03'){
    $query321 = "SELECT * from po A,bill B WHERE A.PO_NO = '" . $po_no . "' AND B.ADVNC_NO = '" . $advnc_no . "' and A.PO_NO = B.ORD_NO";
    $result321 = mysqli_query($cstccon,$query321) or die(mysqli_error());
    $row321 = mysqli_fetch_assoc($result321);
    if($advnc_no == '' || $row321['ADVNC_NO'] != $advnc_no){
        echo '<script language="javascript">';
        echo 'alert("Please provide Correct Advance Proposal Number.")';
        echo '</script>';
        exit();
    }
}

$_SESSION['dlv_doc'] = $dlv_doc;
$_SESSION['dlv_dt'] = $dlv_dt;


$query3 = "SELECT * from po WHERE PO_NO = '" . $po_no . "'";
$result3 = mysqli_query($cstccon,$query3) or die(mysqli_error());
$row3 = mysqli_fetch_assoc($result3);
$po_dt = $row3['PO_DT'];
$po_dt_disp = substr($po_dt,8,2) . '-' . substr($po_dt,5,2) . '-' . substr($po_dt,0,4);

$_SESSION['po_dt_disp'] = $po_dt_disp;




$query2 = "SELECT * from unit WHERE UNIT_CODE = '" . $unit_to . "'";
$result2 = mysqli_query($cstccon,$query2) or die(mysqli_error());
$row2 = mysqli_fetch_assoc($result2);
$unit_to_desc = $row2['UNIT_DESC'];
$unit_to_code = $row2['UNIT_CODE'];
$_SESSION['unit_to'] = $unit_to_code;

$_SESSION['unit_to_desc'] = $unit_to_desc ;


$unit = $_SESSION['UNIT'];

$query1 = "SELECT * from vnd WHERE VND_ID = '" . $vnd_id . "'";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
$row1 = mysqli_fetch_assoc($result1);
$vendor_from_desc = $row1['VND_NM'];   
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Modify Purchase Order</title>
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
                        <h6><span style="color: white;" align="left">MATERIAL RECEIVE FROM VENDOR FOR PURCHASE ORDER NUMBER :  <?php echo ' ' . '<b>' . $po_no . '</b>' . ' ' . 'Dated :' . $_SESSION['po_dt_disp'];  ?> </span></h6>
                        </div>
                <table width="100%" align="center" style="background-color: lightgray">
        <tr>
            <td>
 <form id="form1" name="form1" action="" method="POST" class="form">
     
     <p></p>       
		    <table width='100%' class="roundedCorners" color="white">
                             <tr style="color:black">
                                <h6><td color="white"align='left'><?php echo "VENDOR CODE : <b>" . $vnd_id . "</b>;  NAME : <b>" . $vendor_from_desc . "</b>"; ?></td></h6>
                                <h6><td color="white"align='left'><?php echo "TO BE RECEIVED AT : <b>" . $_SESSION['unit_to_desc'] . "</b>"; ?></h6></td></h6>
                                <h6><td color="white"><?php echo "DATE OF RECEIVE : <b>" . date('d-m-Y') . "</b>"; ?></h6></td>  </h6>

                             </tr>
                             
                        <tr>
                            <td colspan="3" align='left'><h5>GSTIN OF VENDOR :</h5>
                               <div class="form-group">
                                    <div class="col-md-4"align="center">
						<select class="form-control"name="gstin" id="gstin">
                                               
                               
                          	<?php
                                $sql22="update item_R_temp_update set stat = 'N'";
                                $result22=mysqli_query($cstccon,$sql22);
                                
                                $query = "SELECT * from vendor_gstin WHERE VND_ID = '" . $vnd_id . "'";
                                $result = mysqli_query($cstccon,$query) or die(mysqli_error());
                                
                                
				while ($row_gstin = mysqli_fetch_assoc($result))
                                {?>
                          		<option value="<?php echo $row_gstin['GSTIN']?>"><?php echo $row_gstin['GSTIN']?></option>
                          	<?php
					} 
  						$rows = mysqli_num_rows($result);
  						if($rows > 0) {
      						mysqli_data_seek($result, 0);
	  					$row_gstin = mysqli_fetch_assoc($result);
 					      }
				?>
                        			</select>
                                    </div>
                               </div>
                                </td> 
                             
                        
                             
                             
                             
                             
                             
                             </tr>
                             <tr><td colspan="3"><p></p></td></tr>
                             <tr><td  colspan="3"align="center">
                                     <a href="CSTC_ItemReceipttaxGST.php" class="btn btn-info" role="button">Modify GST Rate</a>
                                     <a href="CSTC_ItemReceipttaxFREIGHT.php" class="btn btn-info" role="button">Modify Freight Rate</a>
                                    <a href="CSTC_ItemReceipttax.php" class="btn btn-info" role="button">Modify Cash Discount Rate</a>
                            
                              </td></tr>
                             <tr><td colspan="3"><p></p></td></tr>
                             <tr><td  colspan="3"align="center">
                                         <a href="CSTC_ItemReceipttestnew.php" class="btn btn-success" role="button">Receive Item</a>
                             <a href="CSTC_MainMenu_ajax.php" class="btn btn-danger" role="button">Close</a>

                              </td></tr>
                             <tr><td colspan="3"><p></p></td></tr>
                      </table>
                       
           
    
 

    <input class="form-control"type="hidden" name="unit_to" id="unit_to" value="<?php echo $_SESSION['unit_to']; ?>"></input>
                                        
 </form>
            </td>
        </tr>
    </table>
                        </div>
<?php } 
else {?>
    <script language="javascript">
alert("Invalid Purchase Order Number")
document.location='CSTC_MainMenu.php';
</script>
<?php

}
    ?>
    
            

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
