<?php 
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$v_no = $_GET['var2'];
//echo $pr_no;
$filename = "REPORT/Issue_Voucher/" . $v_no . ".pdf" ; ?>
<script type="text/JavaScript">
document.location="<?php echo $filename ;?> ";   
</script>
         
  