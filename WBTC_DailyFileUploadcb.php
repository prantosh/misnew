<?php require_once('Connections/cstccon.php'); ?>
<?php
session_start();
$unit = $_SESSION['UNIT'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}




?><?php 



 if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
 ?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>DAILY CB FILE UPLOAD</title>
<link href="css/IMS_Web.css" rel="stylesheet" type="text/css" >
<link href="css/menu.css" rel="stylesheet" type="text/css" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="jquery.js" type="text/javascript" language="javascript"></script>

<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script type="text/javascript" src="js/bubble-tooltip.js"></script>
<script type="text/javascript" src="js/validation.js"></script>
<link rel="stylesheet" type="text/css" href="ddtabmenufiles/ddcolortabs.css" />
<script type="text/javascript" src="ddtabmenufiles/ddtabmenu.js"></script>
<script type="text/javascript">
//	ddtabmenu.definemenu("ddtabs4", 0) //initialize Tab Menu #4 with 3rd tab selected
</script>
<link rel="stylesheet" href="css/bubble-tooltip.css" media="screen">

<script language="javascript">
/**--------------------------
//* Validate Date Field script- By JavaScriptKit.com
//* For this script and 100s more, visit http://www.javascriptkit.com
//* This notice must stay intact for usage
---------------------------**/
function checkdate(input){
var dayfield=input.value.split("-")[0];
var monthfield=input.value.split("-")[1];
var yearfield=input.value.split("-")[2];
var dayobj = new Date(yearfield, monthfield-1, dayfield);
if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield)){
	alert("You have entered:" + '\n' + "Day = " + dayfield + " Month = " + monthfield + " Year = " + yearfield  + '\n' +
	"Invalid Day, Month, and/or Year range detected. Please correct and submit again.");

	input.value = '';
	setTimeout("document.getElementById('"+input.id+"').focus()", 50);
	return false;
}
}

function integeronly(THIS){
	var pattern = /^[0-9]+$/;
	if(!pattern.test(THIS.value)){
		THIS.value = "";
		setTimeout("document.getElementById('"+THIS.id+"').focus()", 50);
		return false;
	}
}

function integeronlyPIN(THIS){
	var pattern = /^[0-9]+$/;
	if(!pattern.test(THIS.value)){
		THIS.value = "";
		setTimeout("document.getElementById('"+THIS.id+"').focus()", 50);
		return false;
	}
}

function upperCaseName()
{
//var x=document.getElementById("emp_name").value;
//document.getElementById("emp_name").value=x.toUpperCase();
}
function UpperCaseVeh()
{
var x=document.getElementById("veh_no").value;
document.getElementById("veh_no").value=x.toUpperCase();
}
function validateEmpty(fld) {
    var error = "";

    if (fld.value.length == 0) {
        fld.focus();
        alert("The required field has not been filled");
    }
}
function verify(THIS){
    if	  ( THIS.value == "")	   
	{
        alert("Please fill in all the * marked fields");
        setTimeout("document.getElementById('"+THIS.id+"').focus()", 50);
        }		
  }
function resetform() {
if (confirm("Are you sure you want to clear form?")) {
document.login_form.reset();
}
}
function showHide (id) 
{ 
var style = document.getElementById(id).style 

style.visibility = "visible"; 

//onclick="showHide('PH')
} 
function focus_on_pf_acno()
{
setTimeout("document.getElementById('pf_acno').focus()", 50);
}

//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use



//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

$(document).ready(function()
{
	$("#login_form").submit(function()
	{
	 if (confirm("Are you sure ?") == true) {	//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Please wait....').fadeIn(1000);
		//check the username exists or not from ajax
		//$.post("MIS_DailyEntryTraffic_ajax.php",{ unit:$('#unit').val(),rand:Math.random() } ,function(data)
        $.post("uploadercb.php",{ FileToUpload:$('#FileToUpload').val(),datepicker_from:$('#datepicker_from').val(),unit1:$('#unit1').val(),rand:Math.random() } ,function(data)

        {	
           alert(data);
		  if(data=="yes") //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Please wait.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	alert("<?php echo $_SESSION['msg']; ?>")
                                    
				 document.location='WBTC_MainMenu.php';
			  });
			  
			});
		  }
                  else if(data=='route missing') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Please wait.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	alert("<?php echo 'Route Missing in MIS for Route number ' .  $_SESSION['route_not_found'] ; ?>")
                                    
				 document.location='WBTC_MainMenu.php';
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
				
			  $(this).html('Sorry, Invalid operation....').addClass('messageboxerror').fadeTo(900,1);
		        });		
                  }   
	});
 		return false; 
            }//not to post the  form physically
	});
	//now call the ajax also focus move from 
	$("#abcd").blur(function()
	{
		$("#login_form").trigger('submit');
	});
});
</script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
    <script type="text/javascript">
       $(function() {
               $("#datepicker_from").datepicker({ dateFormat: "dd-mm-yy" }).val()
               $("#datepicker_to").datepicker({ dateFormat: "dd-mm-yy" }).val()
       });

   </script>  
<script type="text/javascript">
       

   </script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-weight: bold}
-->
</style>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>MAIN MENU</title>


</head>
<body style = background-image:url('images/bg44.jpeg');>


<table  width="90%" align="center" border="0"  bgcolor="#99c4f4" class="rounded-corners">
    <tr>
        <td>
<div>
            <table width="100%" >
                <tr>
                    <td align="center">
                    <?php include "MIS_headerMenuDaily.php" ; ?> 
                    </td>
                </tr>
                
            </table>
	
</div>
        </td>
    </tr>
<!-- next line new addition -->








</table>
    
   <form action="uploadercb.php" method="post" enctype="multipart/form-data">
<table  width="90%" align="center" border="0"  bgcolor="#ffffff" class="rounded-corners">
    <tr>
      <td bgcolor="#999999">
                                                <fieldset class="field">
					
					<center>
                                        <div>
                                            <table height ="197" bgcolor="#99c4f4" width = '100%'>
											<tr>
											<td bgcolor="#330066"><div align="center" class="style1"><strong>SELECT cb.csv FILE TO UPLOAD </strong></div></td>
											</tr>
                                                
                                                <tr>
 <?php        
 
 $query_Recordset1p="delete from cb where wb_date = '0000-00-00'";
$Recordset1p = mysqli_query($cstccon,$query_Recordset1p) or die(mysqli_error());
 
$query_Recordsetee="delete from days";
$Recordsetee = mysqli_query($cstccon,$query_Recordsetee) or die(mysqli_error());
 

$querydays = "insert into days SELECT date_field
FROM
(
    SELECT
        MAKEDATE(YEAR(NOW()),1) +
        INTERVAL (MONTH(NOW())-1) MONTH +
        INTERVAL daynum DAY date_field
    FROM
    (
        SELECT t*10+u daynum
        FROM
            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
            UNION SELECT 8 UNION SELECT 9) B
        ORDER BY daynum
    ) AA
) AAA
WHERE MONTH(date_field) = MONTH(NOW())";
$Recordsetdays = mysqli_query($cstccon,$querydays) or die(mysqli_error());




 $query_Recordset1="SELECT  c.date_field wb_date1 FROM days c where c.date_field < date(now()) and c.date_field not in(select date(a.upd_date) from cb_update_log a, ctrl_mis_cb b where a.unit = '" . $_SESSION['UNIT'] . "' and DATE_FORMAT(a.upd_date,'%m%y') = b.cur_mth) order by c.date_field desc";
$Recordset1 = mysqli_query($cstccon,$query_Recordset1) or die(mysqli_error());
//$row_Recordset1 = mysqli_fetch_assoc($Recordset1);?>
                        
                      <td width="100%" height="108"  class="style2" style="color:#000000;font-weight:bold">
                          <div align="center">   Select Date for record to be Uploaded
                            
                             
                             
                             <select name='datepicker_from' id='datepicker_from'>
                                          <?php $i = $_SESSION['no_of_days'];
                                                $j = $i;
                                           //while ($j <= $i){
                                                ?>
					   <option value=" <?php echo date('Y-m-d',strtotime('-1 days')); ?>"> <?php echo date('d-m-Y',strtotime('-1 days')); ?></option>
                                         <?php $j = $j +1;
                                         // }
                                       while($row_Recordset1 = mysqli_fetch_assoc($Recordset1))  {    ?>
                                           <option value ="<?php echo $row_Recordset1['wb_date1'] ?>"><?php echo substr($row_Recordset1['wb_date1'],8,2) . '-' . substr($row_Recordset1['wb_date1'],5,2) . '-' . substr($row_Recordset1['wb_date1'],0,4) ?></option>
                                          
                                          
                                    <?php   }  
                                          
                                          
                                          ?>
                                                    </select>
                             
                             
                             
                             
                             
                             
                       
                       
                              </div>
                        <p></p>
                         <input type="file" name="fileToUpload" id="fileToUpload"><P></P>
                             <input type='hidden' id='unit1' name='unit1'  value="<?php echo $unit ;?>">
    <input type="submit" value="Upload File" name="submit" >                      
                        </td>
                  </tr>
                                          </table>
                                            
                                        </div> 
                                        <div id="msgbox"></div>
                                </fieldset>
	
<!--<hr>-->				  </td>
				
							
					<td  width="70%" valign="top" >
			
				<fieldset class="field">
					
						<table  id="course" width="100%" border="0">
							<tr>
								<td width="100%">
							<p style="text-align:justify;"><font size="2"><p align="justify">This is an internet based Management Information System. Data related to Operation, Maintenance, Administration etc. will be available from the depots / units through out the organisation.

                                                                    This is a highly secured portal. Each and every data will be recorded along with the details of the data entry operator. So, operators are instructed not to disclose his or her password in any form. There is no scope to retrieve any password from the system by any body including the system administrator. Operators are requested to change their password immediately after login with the initially given password.</p><p align="justify">

                                                                        Data entry operator will be held responsible for any wrong entry into the system. Wrong entry can only be rectified at the central level after sending proper justification by the concerned officer and duly granted by the competent authority. There is no scope to entertain any verbal request. </p><p align="justify">Any type of unauthorised access into this system by any operator is not allowed. Details of the computer is also being recorded in this system.</p>								</td>
							</tr>
						</table>
				</fieldset>
					</td>
	</tr>
	  </table>
</form>
<?php include "cstc_footer.html" ; ?> 
        <script language="javascript"> document.getElementById("folio_no").focus(); </script>

</body>
</html>

