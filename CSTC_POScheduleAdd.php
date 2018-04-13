

       <?php
session_start();
	include('Connections/cstccon.php');
        
if(isset($_POST['po_no'])){        

$po_no = htmlspecialchars($_POST['po_no'],ENT_QUOTES);
$line=htmlspecialchars($_POST['line'],ENT_QUOTES);
$mydate=htmlspecialchars($_POST['mydate'],ENT_QUOTES);
$dlv_qty=htmlspecialchars($_POST['qty'],ENT_QUOTES);
$dlv_dt =substr($_POST['mydate'],6,4) . '-' . substr($_POST['mydate'],3,2) . '-' . substr($_POST['mydate'],0,2) ;


$sql_itm="SELECT * FROM posch where PO_NO = '" . $po_no . "' and DLV_DT = '" . $dlv_dt . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

if(mysqli_num_rows($result_itm)>0)
{?>
 <script language="javascript">
            alert('Delivery Date exists. Try different date');
            document.location='CSTC_POSchedule.php?q=<?php echo $po_no ; ?>';
       </script>
<?php }
else
{
    $sql_itm1="insert INTO posch(PO_NO,LINE,DLV_DT,DLV_QTY) VALUES('" . $po_no . "','" . $line . "','" . $dlv_dt . "'," . $dlv_qty . ")"; 
$result_itm1=mysqli_query($cstccon,$sql_itm1);

}}

?>
        <script language="javascript">
            alert('Record Added Successfuly');
             document.location='CSTC_POSchedule.php?po_no=<?php echo $po_no ; ?>';
       </script>
					
								