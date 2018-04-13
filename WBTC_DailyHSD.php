<?php 

error_reporting(E_ERROR|E_WARNING);
session_start(); 
$yesterday = date('Y-m-d',strtotime("-1 days"));
$unit = $_SESSION['UNIT'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }

?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>HSD Details</title>
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
	<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/ColReorder/css/colReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/KeyTable/css/keyTable.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
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
		<!-- begin #header -->
		<?php  include('WBTC_header.php'); ?>
		<!-- end #header -->
                <!-- begin #sidebar -->
		<?php  include('WBTC_left.php'); ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			
			<!-- end page-header -->
		
			<!-- begin row -->
			
			    <!-- begin col-2 -->
			   
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			  
                  
 
 
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
 
 
 
  
   
    <div align="left">
        <h4>HSD Receipt / Consumption Details</h4>
     <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info ">Add New Record</button>
    </div>
     <p></p>
    <div class="panel panel-success" style="font-size:12px">
        <div class="panel-heading" style="font-size:12px">
            <div class="panel-heading-btn">
            </div>
            <table id="user_data" class="table table-bordered table-striped">
                <thead>
                    <tr style="font-size:12px">
                        <th >Date</th>
                        <th >HSD Received</th>
                        <th >HSD Non-Rev</th>
                        <th >HSD Other Unit</th>
                        <th >HSD Closing Stock</th>
                        <th >Edit</th>
                        <th >Delete</th>
                    </tr>
                </thead>
            </table>
        </div>



<div id="userModal" class="modal fade">
 <div class="modal-dialog">
     
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header" align="left"style="color:white ;background-color: #a8a646;">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">Add new Record</span></h4>
                            </div>
    <div class="modal-body"style="color:white ;background-color: #dbda97;">
     <label>Date of Operation</label>
    
     <input class="form-control"value="<?php echo date('d-m-Y',strtotime("-1 days")) ; ?>"type="text" class="form-control" id="op_date" name="op_date"placeholder="Select Date" readonly="yes" />

     <br />
     <label>HSD Non-Revenue</label>
     <input type="number" name="hsd_nrv" id="hsd_nrv" class="form-control" />
     <br />
     <label>HSD Other Unit</label>
     <input type="number" name="hsd_od" id="hsd_od" class="form-control" />
     <br />
     <label>HSD Receive</label>
     <input type="number" name="hsd_rec" id="hsd_rec" class="form-control" />
     <br />
     <label><span   style="font-size: 10px">HSD Closing Stock</span></label>
     <input type="number" name="hsd_stock" id="hsd_stock" class="form-control" />
     <br />
     
    </div>
     <div class="modal-footer"style="color:white ;background-color:#a8a646;">
     <input type="hidden" name="user_id" id="user_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    
   </div>
  </form>
 </div>
</div>
        <style>
.dataTables_length,
.dataTables_filter,
.dataTables_info {
color: white;
}

   </style>     

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 $('#add_button').click(function(){
  $('#user_form')[0].reset();
  $('.modal-title').text("Add New Record");
  $('#action').val("Add");
  $('#operation').val("Add");
  
 });
                                $('#op_date').datepicker({
                               dateFormat: "dd-mm-yy",
                                maxDate: new Date()
                                });
 var dataTable = $('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"WBTC_DailyHSDfetch.php",
   type:"POST"
  },
  "columnDefs":[
   {
    
    "targets":[2,3],
    "orderable":false,
    "dt-right" : true, 
   },
  ],
  "oLanguage": {
   "sSearch": "Search Table"
 },
 
 });

 $(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var op_date = $('#op_date').val();
  var hsd_nrv = $('#hsd_nrv').val();
   var hsd_od = $('#hsd_od').val();
    var hsd_nrv = $('#hsd_rec').val();
     var hsd_nrv = $('#hsd_stock').val();
     
  
  
  if(op_date != '' )
  {
   $.ajax({
    url:"WBTC_DailyHSDinsert.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     $('#user_form')[0].reset();
     $('#userModal').modal('hide');
     dataTable.ajax.reload();
     //$('#dataTable').DataTable().ajax.reload();.
    // document.location='WBTC_DailyHSD.php';
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"WBTC_DailyHSDfetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
    $('#userModal').modal('show');
    $('#op_date').val(data.op_date);
    $('#hsd_nrv').val(data.hsd_nrv);
    $('#hsd_od').val(data.hsd_od);
    $('#hsd_rec').val(data.hsd_rec);
    $('#hsd_stock').val(data.hsd_stock);
   
    $('.modal-title').text("Edit Existing Record");
    $('#user_id').val(user_id);
   
    $('#action').val("Edit");
    $('#operation').val("Edit");
   
   }
  })
 });
 
 $(document).on('click', '.delete', function(){
  var user_id = $(this).attr("id");
  if(confirm("Are you sure you want to delete this?"))
  {
   $.ajax({
    url:"WBTC_DailyHSDdelete.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
     alert(data);
     dataTable.ajax.reload();
    }
   });
  }
  else
  {
   return false; 
  }
 });
 
 
});

</script>
    </div>
  
			    <!-- end col-10 -->
			
			<!-- end row -->
		
		<!-- end #content -->
		
        <!-- begin theme-panel -->
        <?php  include('WBTC_ThemePanel.php'); ?>
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
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
	<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/RowReorder/js/dataTables.rowReorder.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>
	<script src="assets/js/table-manage-combine.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
<style>
.ui-datepicker { position: relative; z-index: 10000 !important; }
</style>	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageCombine.init();
		});
	</script>
</body>
</html>
