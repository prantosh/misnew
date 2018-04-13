<?php 
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$pr_no = $_GET['var'];
//echo $pr_no;
$filename = "REPORT/purchase_requisition/" . $pr_no . ".pdf" ; ?>
<script type="text/JavaScript">
document.location="<?php echo $filename ;?> ";   
</script>
         
  