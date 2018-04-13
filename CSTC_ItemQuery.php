<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

if(isset($_GET['folio_no']))
     $folio_no = $_GET['folio_no'];
$cur_fin_yr = $_SESSION['CUR_FIN_YR'];

                $sql_itmG2="SELECT * FROM current_part_no where ALT_NO_3 = '" . $folio_no . "'";
                $RecordsetG2=mysqli_query($cstccon,$sql_itmG2);
            
            $sql_itmG1="SELECT * FROM itm where PART_NO = '" . $folio_no . "' OR ALT_NO = '" . $folio_no . "' OR ALT_NO_2 = '" . $folio_no . "'";
            $RecordsetG1=mysqli_query($cstccon,$sql_itmG1);
            if(mysqli_num_rows($RecordsetG1) > 0){
                $rowG1 = mysqli_fetch_assoc($RecordsetG1);
                $folio_no = $rowG1['PART_NO'];
            }
          
                
                else if(mysqli_num_rows($RecordsetG2) > 0){
                $rowG2 = mysqli_fetch_assoc($RecordsetG2);
                $folio_no = $rowG2['PART_NO'];
            }
            else{
                $sql_itmG2v="SELECT * FROM itmalias where PART_NO = '" . $folio_no . "' OR ALIAS_NO = '" . $folio_no . "'";
                $RecordsetG2v=mysqli_query($cstccon,$sql_itmG2v);
                if(mysqli_num_rows($RecordsetG1) > 0){
                 $folio_no = $rowG2v['PART_NO'];   
                }
            }
            

            $sql_itmG3="SELECT * FROM itm where PART_NO = '" . $folio_no . "'";
            $RecordsetG3=mysqli_query($cstccon,$sql_itmG3);
            if(mysqli_num_rows($RecordsetG3) <= 0){?>
                <script type="text/JavaScript">
                    alert("<?php echo 'Invalid Folio No. / Part No.' ; ?>");
                    </script>
                    
         
            
              
            <?php           }
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Item Status</title>
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
        <script>
function goBack() {
    window.history.back();
}
</script>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


<link href="IMS_Web.css" rel="stylesheet" type="text/css" >
<script src="js/datatables.min.js"></script> 
 <link rel="stylesheet" type="text/css" href="datatables.min.css">
<link href="font-awesome.min.css" rel="stylesheet"> 

<script src="js/jquery-ui-1.11.4/jquery-ui.js"></script>
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
				
				<li class="active">Item Status</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Item Status <small>Detail Information</small></h1>
			<!-- end page-header -->
			<div class="box-header" style='text-align: right;'>
              
            </div>
            <div class="row">
            <div class="col-md-12" >	
		<!-- begin #content -->
<table  width="90%" align="center"> 
    <tr>
        <td style="background-color: white">

  

   <?php    $sql_itmG="SELECT * FROM itm where PART_NO = '" . $folio_no . "'";
            $Recordsetx2=mysqli_query($cstccon,$sql_itmG);
            if(mysqli_num_rows($Recordsetx2) > 0){
            $rowx2 = mysqli_fetch_assoc($Recordsetx2);
            $itm_nm = $rowx2['SPEC'];
            $uom_id = $rowx2['UOM_ID'];
            $alt_no = $rowx2['ALT_NO'];
            $alt_no_2 = $rowx2['ALT_NO_2'];
            $sql_itmG1="SELECT * FROM current_part_no where PART_NO = '" . $folio_no . "'";
            $Recordsetx21=mysqli_query($cstccon,$sql_itmG1);
            $rowx21 = mysqli_fetch_assoc($Recordsetx21);
            $alias_no = $rowx21['ALT_NO_3']; ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                            
                            <div class="panel-heading-btn">
                                
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                           <h4 class="panel-title">
<a href="#" onClick="goBack()"><b><img src=images/go_back.png class="img-circle" alt="User Image"></b></a>
                        <table  width="100%" align="center"> 
                    <tr style="font-weight: bold">
                        <td align='center'><?php echo "FOLIO NO. : " . $folio_no ; ?></td>
                        <td align='center'><?php echo "DESCRIPTION : " . $itm_nm ; ?></td>
                        <td align='center'><?php echo "UNIT : " . $uom_id ; ?></td>
                        <td align='center'><?php echo "PART NO. : " . $alias_no ; ?></td>
          
                    </tr>
                </table>
                           </span></h4>
                </div>
                
                    <p></p><p></p>
  
  
  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">INDENT</a></li>
    <li><a data-toggle="tab" href="#menu1">PURCHASE REQUISITION</a></li>
    <li><a data-toggle="tab" href="#menu2">PURCHASE ORDER</a></li>
    <li><a data-toggle="tab" href="#menu3">RECEIPT DETAIL</a></li>
    <li><a data-toggle="tab" href="#menu4">BIN CARD</a></li>
    <li><a data-toggle="tab" href="#menu5">ISSUE DETAIL</a></li>
    <li><a data-toggle="tab" href="#menu6">AVAILABILITY</a></li>
  </ul>

  
                        
                        
  
  <div class="tab-content"id='p'>
      
      
      
      
      
      
      
      
      
      
      
      
      
        
          <div id="home" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
 
      
    
        
    <p></p>DETAILS OF INDENT RECEIVED FROM HEAD OF UNITS <p></p>
     
                <?php    $sql_itmG2="SELECT a.INDNT_ID INDNT_ID1,a.FIN_YR FIN_YR1,a.CC_ID CC_ID1,a.REF_DOC REF_DOC1,b.REQ_QTY REQ_QTY1,b.REQ_DT REQ_DT1,b.LST_CONS LST_CONS1 FROM indnt a,indntitm b where b.PART_NO = '" . $folio_no . "' and a.INDNT_ID = b.INDNT_ID order by a.INDNT_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
                  

    <thead>
                        <tr style="color:black;background-color: orange;">
                            <th align='center'>SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">INDENT ID</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">FINANCIAL YEAR</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">COST CENTER</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">REF. NO.</th>
                            <th align='right'style="padding: 5px 5px 5px 5px;">REQUIRED QTY.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">REQUIRED DATE</th>
                            <th align='right'style="padding: 5px 5px 5px 5px;">LAST YR. CONS.</th>
                        </tr>
    </thead>
    <tbody>
                            <?php
                                        $srl = 1;
                                         while ($rowx2 = mysqli_fetch_assoc($Recordsetx22)){
                                         echo "<tr style='color:black;'>";
                                         echo "<td align='center'>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['INDNT_ID1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['FIN_YR1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['CC_ID1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['REF_DOC1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['REQ_QTY1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['REQ_DT1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['LST_CONS1'];
                                         echo "</td>";
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
    </tbody>             
                                    </table>
                    </div>  
                                
    </div>
      
<!--- **********************************************888 -->
   <div id="menu1" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
      <p></p>DETAILS OF PURCHASE REQUISITION CREATED <p></p>
 
                <?php    $sql_itmG2="SELECT DISTINCT a.PUR_REQ_ID PUR_REQ_ID1,a.REQ_DT REQ_DT1,a.TC_DT TC_DT1,b.PUR_PLN_QTY PUR_PLN_QTY1,b.TC_QTY TC_QTY1,b.PO_QTY PO_QTY1 FROM purreq a,purreqitm b where b.PART_NO = '" . $folio_no . "' and a.PUR_REQ_ID = b.PUR_REQ_ID order by a.REQ_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
  <thead>
                        <tr style="color:black;font-weight: bold;background-color: orange;">
                            <th align='center'style="padding: 5px 5px 5px 5px;">SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">REQUISITION ID</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">TC METTING DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">PURCHASE PLAN QTY.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">TC RECOMMENDED QTY.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ORDER QTY.</th>
                           
                        </tr>
  </thead>
                        <tbody>
                            <?php
                                        $srl = 1;
                                         while ($rowx21 = mysqli_fetch_assoc($Recordsetx22)){
                                         echo "<tr style='color:black;'>";
                                         echo "<td align='center'>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td align='center'>"; 
                                         $xx = $rowx21['PUR_REQ_ID1'];
                                         echo '<a href="ST_ItemQueryModal.php?var=' . $xx . '&var1=' . $folio_no . '" class="ajax_link"><strong>' . $xx . '</strong></a>';
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx21['REQ_DT1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx21['TC_DT1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx21['PUR_PLN_QTY1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx21['TC_QTY1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx21['PO_QTY1'];
                                         echo "</td>";
                                         
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
                        </tbody>       
                         </table>
                                    
            </div>
     
    </div>
<!--- **********************************************888 -->
    <div id="menu2" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id2" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
  <p></p>DETAILS OF PURCHASE ORDER CREATED <p></p>
 
                <?php    $sql_itmG2="SELECT a.PO_NO PO_NO1,a.PO_DT PO_DT1,a.DLV_DT DLV_DT1,b.REQ_ID REQ_ID1,b.UNT_RT UNT_RT1,b.PO_QTY PO_QTY1,b.RCT_QTY RCT_QTY1,c.VND_NM VND_NM1 FROM po a,poitm b, vnd c where a.VND_ID = c.VND_ID and b.PART_NO = '" . $folio_no . "' and a.PO_NO = b.PO_NO order by a.PO_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
                    
                        <thead
                          <tr style="color:black;font-weight: bold;background-color: orange;">
                            <th align='center'style="padding: 5px 5px 5px 5px;">SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ORDER NO.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">VENDOR NAME</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">DELIVERY DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">REQ. ID</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">UNIT RATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ORDER QTY.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIVED QTY.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">PENDING QTY.</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                        $srl = 1;
                                         while ($rowx2 = mysqli_fetch_assoc($Recordsetx22)){
                                        echo "<tr style='color:black;'>";
                                         echo "<td align='center'>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         $xx = $rowx2['PO_NO1'];
                                         echo '<a href="ST_ItemQueryPOModal.php?var=' . $xx . '&var1=' . $folio_no . '" class="ajax_link"><strong>' . $xx . '</strong></a>';
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['VND_NM1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['PO_DT1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['DLV_DT1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['REQ_ID1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo number_format($rowx2['UNT_RT1'],2);
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['PO_QTY1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['RCT_QTY1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['PO_QTY1'] - $rowx2['RCT_QTY1'];
                                         echo "</td>";
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
                        </tbody>      
                                    </table>
  
    </div>
    </div>
<!--- **********************************************888 -->
 <div id="menu3" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id3" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
  <p></p>DETAILS OF MATERIAL RECEIPT <p></p>
      <?php    $sql_itmG2="SELECT a.MAT_RCT_NO MAT_RCT_NO1,PO_NO PO_NO1,a.RCT_DT RCT_DT1,b.BNTXN_ID BNTXN_ID1,a.DLV_DOC DLV_DOC1,b.DLV_QTY DLV_QTY1,c.VND_NM VND_NM1,b.GRS_VAL GRS_VAL1 FROM matrct a,matrctitm b, vnd c where a.VND_ID = c.VND_ID and b.PART_NO = '" . $folio_no . "' and a.MAT_RCT_NO = b.MAT_RCT_NO order by a.RCT_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
  <thead>
                        <tr style="color:black;font-weight: bold;background-color: orange;">
                            <th align='center'style="padding: 5px 5px 5px 5px;">SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIPT NO.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">VENDOR NAME</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ORDER NO.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">BIN TRAN. ID</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">CHALLAN NO</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIPT QTY.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">GROSS VALUE</th>
                        </tr>
  </thead>
  <tbody>
                            <?php
                                        $srl = 1;
                                         while ($rowx2 = mysqli_fetch_assoc($Recordsetx22)){
                                          echo "<tr style='color:black;'>";
                                         echo "<td align='center'>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         $xx = $rowx2['MAT_RCT_NO1'] ;
                                         echo '<a href="ST_ItemQueryRCTModal.php?var=' . $xx . '&var1=' . $folio_no . '" class="ajax_link"><strong>' . $xx . '</strong></a>';
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['VND_NM1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['RCT_DT1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['PO_NO1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['BNTXN_ID1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['DLV_DOC1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['DLV_QTY1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo number_format($rowx2['GRS_VAL1'],2);
                                         echo "</td>";
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
  </tbody>                                  
                                    </table>
                                    
            </div>
    </div>
<!--- **********************************************888 -->
<div id="menu4" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id4" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
  <p></p>BIN CARD DETAILS  <p></p>  
  
             <?php    $sql_itmG2="SELECT * from bincrd where PART_NO = '" . $folio_no . "' order by FIN_YR desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
  <thead>
                        <tr style="color:black;font-weight: bold;background-color: orange;">
                            <th align='center'style="padding: 5px 5px 5px 5px;">SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">FINANCIAL YR.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">OPENING QTY. </th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">OPENING VALUE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIVED QTY.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIVED VALUE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ISSUE QTY.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ISSUE VALUE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">LAST RCEIPT DT.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">LAST ISSUE DT.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">LAST ISSUE RATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">STOCK</th>
                        </tr>
  </thead>
  <tbody
                            <?php
                                        $srl = 1;
                                         while ($rowx2 = mysqli_fetch_assoc($Recordsetx22)){
                                           echo "<tr style='color:black;'>";
                                         echo "<td align='center'>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['FIN_YR'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['OPNG_QTY'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['OPNG_VAL'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['RCT_QTY'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['RCT_VAL'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['ISS_QTY'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['ISS_VAL'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['LRCT_DT'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['LISS_DT'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo number_format($rowx2['LISS_RT'],2);
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo number_format($rowx2['OPNG_QTY'] + $rowx2['RCT_QTY'] - $rowx2['ISS_QTY'],2);
                                         echo "</td>";
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
  </tbody>                      
                                    </table>
            </div>
    </div>
<!--- **********************************************888 -->
<div id="menu5" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id5" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
  <p></p>ISSUE DETAILS <p></p>  
           <?php    $sql_itmG2="SELECT a.BNTXN_ID BNTXN_ID1,a.FIN_YR FIN_YR1,a.PRTY_CD PRTY_CD1,a.DOC_DT DOC_DT1,b.ITM_QTY ITM_QTY1,b.ITM_VAL ITM_VAL1 FROM bintxn a,bintxnitm b where a.BNTXN_ID = b.BNTXN_ID and b.PART_NO = '" . $folio_no . "' order by a.DOC_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
  <thead>
                         <tr style="color:black;font-weight: bold;background-color: orange;">
                            <th align='center'style="padding: 5px 5px 5px 5px;">SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">TRANSACTION ID</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">FINANCIAL YEAR </th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIVED FROM</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ISSUE TO</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ISSUED / RECEIVED QUANTITY</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">VALUE</th>
                        </tr>
  </thead>
  <tbody>
                            <?php
                                        $srl = 1;
                                         while ($rowx2 = mysqli_fetch_assoc($Recordsetx22)){
                                         echo "<tr style='color:black;'>";
                                         echo "<td align='center'>";
                                         echo $srl;
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         $xx = $rowx2['BNTXN_ID1'] ;
                                         echo '<a href="ST_ItemQueryISSModal.php?var=' . $xx . '&var1=' . $folio_no . '" class="ajax_link"><strong>' . $xx . '</strong></a>';
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['FIN_YR1'];
                                         echo "</td>";
                                         $vnd_nm = '';
                                         $unit_desc = '';
                                         if(substr($rowx2['BNTXN_ID1'],3,2) == 'GR')
                                         {
                                          $sql="SELECT VND_NM FROM vnd where VND_ID = '" . $rowx2['PRTY_CD1'] . "'";
                                          $Recordset=mysqli_query($cstccon,$sql); 
                                          $row = mysqli_fetch_assoc($Recordset);
                                          $vnd_nm = $row['VND_NM'];
                                         }
                                         if(substr($rowx2['BNTXN_ID1'],4,1) == 'I')
                                         {
                                          $sql="SELECT UNIT_DESC FROM unit where UNIT = '" . $rowx2['PRTY_CD1'] . "'";
                                          $Recordset=mysqli_query($cstccon,$sql); 
                                          $row = mysqli_fetch_assoc($Recordset);
                                          $unit_desc = $row['UNIT_DESC'];
                                         }
                                         echo "<td align='center'>";
                                         echo $vnd_nm;
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $unit_desc;
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['DOC_DT1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['ITM_QTY1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['ITM_VAL1'];
                                         echo "</td>";
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
  </tbody>                              
                                    </table>
            </div>
    </div>
<div id="menu6" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id6" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
           <?php        $sql_itmG2 = "SELECT * FROM bincrd_depot WHERE FIN_YR = '" . $cur_fin_yr . "' and PART_NO = '" . $folio_no . "'";
                        $RecordsetG2=mysqli_query($cstccon,$sql_itmG2);
                        $bd_stock = 0;
                        $nd_stock = 0;
                        $pd_stock = 0;
                        $md_stock = 0;
                        $sld_stock = 0;
                        $kd_stock = 0;
                        $gd_stock = 0;
                        $ld_stock = 0;
                        $td_stock = 0;
                        $tpd_stock = 0;
                        $hd_stock = 0;
                        $cws_stock = 0;
                        $cs_stock = 0;
                        
                        while($row3 = mysqli_fetch_array($RecordsetG2)){
                            if($row3['DEPOT'] == 'BD'){
                                $bd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'ND'){
                                $nd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'PD'){
                                $pd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'MD'){
                                $md_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'SLD'){
                                $sld_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'KD'){
                                $kd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'GD'){
                                $gd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'LD'){
                                $ld_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'TD'){
                                $td_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'TPD'){
                                $tpd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                             if($row3['DEPOT'] == 'HD'){
                                $hd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'CWS'){
                                $cws_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] + $row3['ISS_QTY'];
                            }
                            
                        }
                         
                        $sql_itmG21 = "SELECT * FROM bincrd WHERE FIN_YR = '" . $cur_fin_yr . "' and PART_NO = '" . $folio_no . "'";
                        $RecordsetG21=mysqli_query($cstccon,$sql_itmG21);
                        $row31 = mysqli_fetch_array($RecordsetG21);
                        $cs_stock = $row31['OPNG_QTY'] + $row31['RCT_QTY'] - $row31['ISS_QTY'];
 
                         
                         ?>
  <thead>
                         <tr style="color:black;background-color: blacksmoke;">
                            <td colspan='13'style="text-align: center;">
                               <p></p>AVAILABILITY AT DEPOTS / UNITS <p></p>
                            </td>
                        </tr>
                        <tr style="color:black;font-weight: bold;background-color: orange;">
                            <td align='center'style="padding: 2px 2px 2px 2px;">BD</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">ND</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">PD </td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">MD</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">SLD</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">KD</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">GD</td>
                             <td align='center'style="padding: 2px 2px 2px 2px;">LD</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">TD </td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">TPD</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">HD</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">WORKSHOP</td>
                            <td align='center'style="padding: 2px 2px 2px 2px;">CENTRAL STORE</td>
                        </tr>
  </thead>
  <tbody>
                            <?php
                                        
                                        
                                         echo "<tr style='color:black;'>";
                                         echo "<td align='right'>";
                                         if($bd_stock > 0){ echo $bd_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($nd_stock > 0){ echo $nd_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($pd_stock > 0){ echo $pd_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($md_stock > 0){ echo $md_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($sld_stock > 0){ echo $sld_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($kd_stock > 0){ echo $kd_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($gd_stock > 0){ echo $gd_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($ld_stock > 0){ echo $ld_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($td_stock > 0){ echo $td_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($tpd_stock > 0){ echo $tpd_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($hd_stock > 0){ echo $hd_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($cws_stock > 0){ echo $cws_stock;} 
                                         echo "</td>";
                                          echo "<td align='right'>";
                                         if($cs_stock > 0){ echo $cs_stock;} 
                                         echo "</td>";
                                         
                                         echo "</tr>";
                                        
                                        ?>
  </tbody>                              
                                    </table>
            </div>
    </div>
  </div>
      </div>
        </td>
    </tr>
</table>
<p></p>

<div align ="center"><a href="CSTC_MainMenu.php" class="btn btn-success">EXIT</a>
            
<p></p>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-warning15Z">
                Continue Query
              </button>                <div class="modal modal-warning fade" id="modal-warning15Z" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Item Status Query</span></h4>
                            </div>
                            <form method="get" action="CSTC_ItemQuery.php?q= + document.getElementById('folio_no').value"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '80%'style="color:black ;">
                                        <div></div>
                                        <tr>
                                <td align='right'width='50%'><h6>FOLIO NO.:</h6></td>
                                <td width='50%'>
                                    <input class="form-control"type='text' name='folio_no' id='folio_no'autofocus="autofocus">
				
                                </td>
                            </tr>
                                    </table>  
                                </div>
                                <div class="modal-footer"style="color:white ;background-color:#a8a646;">
                                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
<button id="submit"type="submit" class="btn btn-success" onclick="location.href='CSTC_ItemQuery.php?q='+ document.getElementById('folio_no').value;"> SHOW</button>                                </div>
         
                            </form>
                            </div>
                    </div>
                </div>

</div>
            
<p></p>
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
    
    $("#folio_no").keyup(function(event){
                    if(event.keyCode == 13){
                    $("#submit").click();
                    }
                    });
    
    $('#tbl_id').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id1').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id2').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id3').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id4').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id5').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        $('#tbl_id6').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
               
        
        "iDisplayLength": 10,
    		 "processing": true,
        	 "dom": 'lBfrtip',
           	 "buttons": [
            {
                extend: 'collection',
                text: "EXPORT IN DIFFERENT FORMAT",
                className: 'black',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
        
        App.init();
			Dashboard.init();
        
			 FormPlugins.init();
});
</script>	
	
</body>
</html>
