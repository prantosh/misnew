<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//$po_no = $_SESSION['po_no'];
$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$pr_no=htmlspecialchars($_POST['pr_no'],ENT_QUOTES);
$tc_qty=htmlspecialchars($_POST['tc_qty'],ENT_QUOTES);
$pb_qty=htmlspecialchars($_POST['pb_qty'],ENT_QUOTES);

$_SESSION['pr_no'] = $pr_no;
$sql_itmz="update purreqitm set TC_QTY = " . $tc_qty . ",PB_QTY = " . $pb_qty . " where PUR_REQ_ID = '" . $pr_no . "' and PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
?>

<script type="text/javascript">
     document.location="CSTC_PRModify.php?q=<?php echo $pr_no ; ?>";
</script>


