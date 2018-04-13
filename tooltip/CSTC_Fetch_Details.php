<?php

error_reporting(E_ERROR|E_WARNING);
session_start();

require_once('../Connections/cstccon.php'); 

$userid = $_POST['userid'];

$select_query = "SELECT * FROM itm WHERE PART_NO = '" . $userid . "'";

$result = mysqli_query($cstccon,$select_query);

$html = '<div>';
while($row = mysqli_fetch_array($result)){
 
 $name = $row['ITM_NM'];
 

$html .= "<span class='head'>Name : </span><span>".$name."</span><br/>";
 
}
$html .= '</div>';

echo $html;
?>