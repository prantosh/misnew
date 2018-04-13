<?php 
session_start();

if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   
   <title>TIME TABLE DATA CAPTURE</title>


</head>
<body >

<table width="100%">
    <tr>
        <td colspan="2">
         <?php include "WBTC_header.php" ; ?>    
        </td>
    </tr> 
   <tr>
      <td width="20%" valign="top">
      
      <?php include "WBTC_left.php" ; ?> 
      
      </td>
      <td width="80%" valign="top">
          <?php include "WBTC_MasterTimeTable1.php" ; ?> 
      </td>
   </tr>
    <tr>
        <td colspan="2">
         <?php // include "WBTC_footer.php" ; ?>    
        </td>
    </tr> 
</table>

</body>
</html>
