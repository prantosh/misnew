<?php

include "config.php";

$userid = $_POST['userid'];

$select_query = "SELECT * FROM users WHERE id=".$userid;

$result = mysqli_query($con,$select_query);

$html = '<div>';
while($row = mysqli_fetch_array($result)){
    $username = $row['username'];
    $name = $row['name'];
    $gender = $row['gender'];
    $email = $row['email'];

    $html .= "<span class='head'>Name : </span><span>".$name."</span><br/>";
    $html .= "<span class='head'>Username : </span><span>".$username."</span><br/>";
    $html .= "<span class='head'>Gender : </span><span>".$gender."</span><br/>";
    $html .= "<span class='head'>Email : </span><span>".$email."</span><br/>";
}
$html .= '</div>';

echo $html;