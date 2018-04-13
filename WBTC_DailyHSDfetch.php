 <?php

include('db.php');
include('function.php');
$yesterday = date('Y-m-d',strtotime("-1 days"));
$query = '';
$output = array();
$query .= "SELECT * FROM daily_record_engg ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE op_date LIKE "%'.$_POST["search"]["value"].'%" ';
 
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 
 $sub_array = array();
 
 $sub_array[] = substr($row["op_date"],8,2) . '-' . substr($row["op_date"],5,2) . '-' . substr($row["op_date"],0,4) ;
 $sub_array[] = '<span class="pull-right">' . $row["hsd_nrv"] . '</span>';
 $sub_array[] = '<span class="pull-right">' . $row["hsd_od"] . '</span>';
 $sub_array[] = '<span class="pull-right">' . $row["hsd_rec"] . '</span>';
 $sub_array[] = '<span class="pull-right">' . $row["hsd_stock"] . '</span>';
 if($row["op_date"] >= $yesterday){
 $sub_array[] = '<span style="text-align:center"><button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button></span>';
 $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
}
else{
   $sub_array[] = '<input type="hidden" name="update" id="'.$row["id"].'" ></input>';
 $sub_array[] = '<input type="hidden" name="delete" id="'.$row["id"].'" ></input>';
 
}
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records(),
 "data"    => $data
);
echo json_encode($output);
?>
   