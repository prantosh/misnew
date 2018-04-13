<?php 
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$po_no = $_GET['var1'];
//echo $pr_no;
$filename = "REPORT/PO_Order/" . $po_no . ".pdf" ; ?>
<script type="text/JavaScript">
document.location="<?php echo $filename ;?> ";   
</script>
         
  