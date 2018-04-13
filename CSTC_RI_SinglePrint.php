<?php 
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');
}

$ri_no = $_GET['var4'];
//echo $pr_no;
$filename = "REPORT/RI_Note/" . $ri_no . ".pdf" ; ?>
<script type="text/JavaScript">
document.location="<?php echo $filename ;?> ";   
</script>
         
  