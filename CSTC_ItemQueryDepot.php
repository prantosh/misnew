<?php error_reporting(E_ERROR|E_WARNING);

session_start();
require_once('Connections/cstccon.php'); 

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}
$unit = $_SESSION['UNIT'];
$unit_code = $_SESSION['UNIT_CODE'];
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
                           
<a href="#" onClick="goBack()"><b><img src=images/go_back.png class="img-circle" alt="User Image"></b></a>
                        <table  width="100%" align="center"> 
                    <tr style="font-weight: bold">
                        <td align='center'><?php echo "FOLIO NO. : " . $folio_no ; ?></td>
                        <td align='center'><?php echo "DESCRIPTION : " . $itm_nm ; ?></td>
                        <td align='center'><?php echo "UNIT : " . $uom_id ; ?></td>
                        <td align='center'><?php echo "PART NO. : " . $alias_no ; ?></td>
          
                    </tr>
                </table>
                
                </div>
                
                    <p></p><p></p>
  
  
  
  <ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#home">INDENT</a></li>
   
    <li><a data-toggle="tab" href="#menu3">ISSUE DETAIL</a></li>
    <li><a data-toggle="tab" href="#menu5">RECEIPT (CENTRAL STORE)</a></li>
    <li><a data-toggle="tab" href="#menu4">BIN CARD</a></li>
    
    <li><a data-toggle="tab" href="#menu6">RECEIPT (LOCAL PURCHASE)</a></li>
    <li><a data-toggle="tab" href="#menu2">AVAILABILITY</a></li>
  </ul>

  
                        
                        
  
  <div class="tab-content"id='p'>
      
      
      
      
      
      
      
      
      
      
      
      
      
        
          <div id="home" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
 
      
    
        
    <p></p>DETAILS OF INDENT RECEIVED FROM HEAD OF UNITS <p></p>
     
                <?php    $sql_itmG2="SELECT a.INDNT_ID INDNT_ID1,a.FIN_YR FIN_YR1,a.CC_ID CC_ID1,a.REF_DOC REF_DOC1,b.REQ_QTY REQ_QTY1,b.REQ_DT REQ_DT1,b.LST_CONS LST_CONS1 FROM indnt a,indntitm b where a.CC_ID = '" . $unit . "' and b.PART_NO = '" . $folio_no . "' and a.INDNT_ID = b.INDNT_ID order by a.INDNT_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>

    <thead>
                        
                        <tr style="font-weight: bold;background-color: #009933;">
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
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['REQ_QTY1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['REQ_DT1'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
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
   <div id="menu3" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
      <p></p>DETAILS OF MATERIAL ISSUED  <p></p>
 
                <?php    $sql_itmG2="SELECT a.BNTXN_ID BNTXN_ID1,a.DOC_DT DOC_DT1,a.vehno vehno1,a.PRTY_CD PRTY_CD1,b.PART_NO PART_NO1,b.ITM_QTY ITM_QTY1,b.ITM_VAL ITM_VAL1,b.UPDUSR UPDUSR1,b.UPDDT UPDDT1 from bintxn_depot a,bintxnitm_depot b where b.PART_NO = '" . $folio_no . "' and SUBSTR(a.BNTXN_ID,4,2) != 'XR' and a.BNTXN_ID = b.BNTXN_ID AND SUBSTRING(a.BNTXN_ID,1,1) = '" . $unit_code . "' order by a.DOC_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
  <thead>
                        <tr style="font-weight: bold;background-color: #009933;">
                            <th align='center'style="padding: 5px 5px 5px 5px;">SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">ISSUE NO.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">PART NO</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">VEHICLE NO</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">UNIT</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">QTY ISSUED</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">VALUE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">UPDATE BY</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">UPDATE DATE</th>

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
                                         echo $rowx2['BNTXN_ID1'] ;
                                      //   echo '<a href="ST_ItemQueryRCTModal.php?var=' . $xx . '&var1=' . $folio_no . '" class="ajax_link"><strong>' . $xx . '</strong></a>';
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['DOC_DT1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['PART_NO1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['vehno1'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['PRTY_CD1'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo -$rowx2['ITM_QTY1'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo -$rowx2['ITM_VAL1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['UPDUSR1'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['UPDDT1'];
                                         echo "</td>";
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
                        </tbody>       
                         </table>
                                    
            </div>
     
    </div>
<!--- **********************************************888 -->
   
<!--- **********************************************888 -->
 <div id="menu5" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id3" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
  <p></p>DETAILS OF MATERIAL RECEIPT <p></p>
      <?php    $sql_itmG2="SELECT a.BNTXN_ID BNTXN_ID1,a.FIN_YR FIN_YR1,a.PRTY_CD PRTY_CD1,a.DOC_DT DOC_DT1,b.ITM_QTY ITM_QTY1,b.ITM_VAL ITM_VAL1 FROM bintxn a,bintxnitm b where a.BNTXN_ID = b.BNTXN_ID and b.PART_NO = '" . $folio_no . "' and a.PRTY_CD = '" . $unit . "' order by a.DOC_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
  <thead>
                         <tr style="font-weight: bold;background-color: #009933;">
                            <th align='center'style="padding: 5px 5px 5px 5px;">SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">TRANSACTION ID</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">FINANCIAL YEAR </th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIVED FROM</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIVED QUANTITY</th>
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
                                             
                                            $sqlC = "select * from unit where UNIT_CODE = '" . substr($rowx2['BNTXN_ID1'],0,1) . "'";
                                            $resultC=mysqli_query($cstccon,$sqlC);
                                            $rowC = mysqli_fetch_array($resultC);
                                            $unit_desc1 = $rowC['UNIT_DESC'];
                                            $unit_code1 = $rowC['UNIT_CODE'];   
                                        
                                         }
                                         echo "<td align='center'>";
                                         echo $unit_desc1;
                                         echo "</td>";
                                         
                                         echo "<td align='center'>";
                                         echo $rowx2['DOC_DT1'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo -$rowx2['ITM_QTY1'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo -$rowx2['ITM_VAL1'];
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
  
             <?php    $sql_itmG2="SELECT * from bincrd_depot where PART_NO = '" . $folio_no . "' and DEPOT = '" . $unit . "' order by FIN_YR desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
  <thead>
                        <tr style="font-weight: bold;background-color: #009933;">
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
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['OPNG_QTY'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['OPNG_VAL'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['RCT_QTY'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['RCT_VAL'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['ISS_QTY'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['ISS_VAL'];
                                         echo "</td>";
                                         echo "<td align='center'>";
                                         echo $rowx2['LRCT_DT'];
                                         echo "</td>";
                                         echo "<td align='right'>";
                                         echo $rowx2['LISS_DT'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo number_format($rowx2['LISS_RT'],2);
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
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

<div id="menu6" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
  <table id="tbl_id6" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
           <p></p>PROCUREMENT FROM LOCAL VENDOR  <p></p>  
      <?php    $sql_itmG2="SELECT a.BNTXN_ID BNTXN_ID1,a.FIN_YR FIN_YR1,a.PRTY_CD PRTY_CD1,a.DOC_DT DOC_DT1,b.ITM_QTY ITM_QTY1,b.ITM_VAL ITM_VAL1 FROM bintxn_depot a,bintxnitm_depot b where a.BNTXN_ID = b.BNTXN_ID and b.PART_NO = '" . $folio_no . "' and SUBSTR(a.BNTXN_ID,1,1) = '" . $unit_code . "' and SUBSTR(a.BNTXN_ID,4,2) = 'XR' order by a.DOC_DT desc";
                         $Recordsetx22=mysqli_query($cstccon,$sql_itmG2);?>
                        
                        <tr style="font-weight: bold;background-color: #009933;">
                            <th align='center'style="padding: 5px 5px 5px 5px;">SRL.</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">TRANSACTION ID</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">FINANCIAL YEAR </th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIVED FROM</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">DATE</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">RECEIVED QUANTITY</th>
                            <th align='center'style="padding: 5px 5px 5px 5px;">VALUE</th>
                        </tr>
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
                                         if(substr($rowx2['BNTXN_ID1'],3,2) == 'MI')
                                         {
                                             
                                            $sqlC = "select * from unit where UNIT_CODE = '" . substr($rowx2['BNTXN_ID1'],0,1) . "'";
                                            $resultC=mysqli_query($cstccon,$sqlC);
                                            $rowC = mysqli_fetch_array($resultC);
                                            $unit_desc1 = $rowC['UNIT_DESC'];
                                            $unit_code1 = $rowC['UNIT_CODE'];   
                                        
                                         }
                                         echo "<td align='center'>";
                                         echo "LOCAL VENDOR";
                                         echo "</td>";
                                         
                                         echo "<td align='center'>";
                                         echo $rowx2['DOC_DT1'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['ITM_QTY1'];
                                         echo "</td>";
                                         echo "<td style='text-align:right'>";
                                         echo $rowx2['ITM_VAL1'];
                                         echo "</td>";
                                         echo "</tr>";
                                         $srl = $srl + 1;
                                        }?>
</tbody>                      
                                    </table>
            </div>
    </div>                        
                        
                        
                        
                        
                        
                        
                        
                        
 
<div id="menu2" class="tab-pane fade in active" align="center">
            <div class="row-fluid">
                <p></p>AVAILABILITY IN DIFFERENT UNITS  <p></p>  
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
                                $bd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'ND'){
                                $nd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'PD'){
                                $pd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'MD'){
                                $md_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'SLD'){
                                $sld_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'KD'){
                                $kd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'GD'){
                                $gd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'LD'){
                                $ld_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'TD'){
                                $td_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'TPD'){
                                $tpd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'HD'){
                                $hd_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            if($row3['DEPOT'] == 'CWS'){
                                $cws_stock = $row3['OPNG_QTY'] + $row3['RCT_QTY'] - $row3['ISS_QTY'];
                            }
                            
                        }
                         
                        $sql_itmG21 = "SELECT * FROM bincrd WHERE FIN_YR = '" . $cur_fin_yr . "' and PART_NO = '" . $folio_no . "'";
                        $RecordsetG21=mysqli_query($cstccon,$sql_itmG21);
                        $row31 = mysqli_fetch_array($RecordsetG21);
                        $cs_stock = $row31['OPNG_QTY'] + $row31['RCT_QTY'] - $row31['ISS_QTY'];
 
                         
                         ?>                 
                        
                        
                        
  <thead>
                        
                        <tr style="font-weight: bold;background-color: #009933;">
                            <th align='center'>BD</th>
                            <th align='center'>ND</th>
                            <th align='center'>PD </th>
                            <th align='center'>MD</th>
                            <th align='center'>SLD</th>
                            <th align='center'>KD</th>
                            <th align='center'>GD</th>
                             <th align='center'>LD</th>
                            <th align='center'>TD </th>
                            <th align='center'>TPD</th>
                            <th align='center'>HD</th>
                            <th align='center'>WORKSHOP</th>
                            <th align='center'>CENTRAL STORE</th>
                        </tr>
  </thead>
  <tbody>
                            <?php
                                        
                                        
                                         echo "<tr style='color:black;'>";
                                         echo "<td align='center'>";
                                         if($bd_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($nd_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($pd_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($md_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($sld_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($kd_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($gd_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($ld_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($td_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($tpd_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($hd_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($cws_stock > 0){ echo 'YES';} 
                                         echo "</td>";
                                          echo "<td align='center'>";
                                         if($cs_stock > 0){ echo 'YES';} 
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
                            <form method="get" action="CSTC_ItemQueryDepot.php?q= + document.getElementById('folio_no').value"  enctype="multipart/form-data">
                                <div class="modal-body"style="color:white ;background-color: #dbda97;">
                                    <legend style="color:white;"> </legend>
                                    <table align='center' width = '80%'style="color:black ;">
                                        <div></div>
                                        <tr>
                                <td align='right'width='50%'><h6>FOLIO NO.:</h6></td>
                                <td width='50%'>
                                    <input class="form-control"type='text' name='folio_no' id='folio_no'>
				
                                </td>
                            </tr>
                                    </table>  
                                </div>
                                <div class="modal-footer"style="color:white ;background-color:#a8a646;">
                                <button class="btn btn-danger pull-left" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" class="btn btn-success" onclick="location.href='CSTC_ItemQueryDepot.php?q='+ document.getElementById('folio_no').value;"> SHOW</button>                                </div>
         
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
