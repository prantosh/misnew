<?php 
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$pp_no = $_GET['var3'];
//echo $pr_no;
$filename = "REPORT/Purchase_Proposal/" . $pp_no . ".pdf" ; ?>
<script type="text/JavaScript">
document.location="<?php echo $filename ;?> ";   
</script>
         
  