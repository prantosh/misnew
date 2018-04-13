<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $connection->prepare(
  "SELECT * FROM daily_record_engg 
  WHERE id = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["op_date"] = $row["op_date"];
  $output["hsd_nrv"] = $row["hsd_nrv"];
  $output["hsd_od"] = $row["hsd_od"];
  $output["hsd_rec"] = $row["hsd_rec"];
  $output["hsd_stock"] = $row["hsd_stock"];
 
 
 }
 echo json_encode($output);
}
?>
   