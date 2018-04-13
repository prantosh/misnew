<?php
session_start();
$unit = $_SESSION['UNIT'];
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $op_date = $_POST['op_date'];
  $op_date_new = substr($op_date, 6,4) . '-' .  substr($op_date, 3,2) . '-' .  substr($op_date, 0,2);        
     
   $statement1 = $connection->prepare("
   DELETE FROM daily_record_engg WHERE OP_DATE = :op_date and unit = :unit");
   $result = $statement1->execute(
    array(
    ':op_date' => $op_date_new,
    ':unit' => $unit
    )
   );
     
  
  $statement = $connection->prepare("
   INSERT INTO daily_record_engg (op_date,hsd_nrv,hsd_od,hsd_rec,hsd_stock,unit) 
   VALUES (:op_date, :hsd_nrv, :hsd_od, :hsd_rec, :hsd_stock, :unit)
  ");
  $result = $statement->execute(
   array(
    ':op_date' => $op_date_new,
    ':hsd_nrv' => $_POST["hsd_nrv"],
       ':hsd_od' => $_POST["hsd_od"],
       ':hsd_rec' => $_POST["hsd_rec"],
       ':hsd_stock' => $_POST["hsd_stock"],
        ':unit' => $unit
    )
  );
  if(!empty($result))
  {
   echo 'New Record Added Successfully';
   
  }
 }
 if($_POST["operation"] == "Edit")
 {
  
  $statement = $connection->prepare(
   "UPDATE daily_record_engg 
   SET hsd_nrv = :hsd_nrv,hsd_od = :hsd_od,hsd_rec = :hsd_rec,hsd_stock = :hsd_stock  
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
   
    ':hsd_nrv' => $_POST["hsd_nrv"],
       ':hsd_od' => $_POST["hsd_od"],
       ':hsd_rec' => $_POST["hsd_rec"],
       ':hsd_stock' => $_POST["hsd_stock"],
   
    ':id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }
}

?>
   
