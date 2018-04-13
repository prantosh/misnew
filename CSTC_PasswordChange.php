<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

//get the posted values
$pass_old=htmlspecialchars($_POST['pass_old'],ENT_QUOTES);
$pass_new1=htmlspecialchars($_POST['pass_new1'],ENT_QUOTES);
$pass_new2=htmlspecialchars($_POST['pass_new2'],ENT_QUOTES);
//$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
//$pass=md5($_POST['password']);
//$pass=$_POST['password'];
//now validating the username and password
$sql="SELECT * FROM cstcmis.cstc_user WHERE UNAME='". $_SESSION['UNAME'] ."'";
$result=mysqli_query($cstccon,$sql);
$row=mysqli_fetch_array($result);

$txt_password=$_POST['pass_old'];
//$pass_old=$txt_password;
$pass_old=sha1(md5(md5($txt_password)));
$pass_new11 = sha1(md5(md5($pass_new1)));
//if username exists
if(mysqli_num_rows($result)>0)
{
	//compare the password
	if(strcmp($row['PWD'],$pass_old)==0 && $row['CURRENT_STATUS'] == 'A')
	{
		if(strcmp($pass_new1,$pass_new2)==0)		
		{
		$sql="UPDATE cstcmis.cstc_user SET PWD = '". $pass_new11 . "' WHERE UNAME = '" . $_SESSION['UNAME'] . "'";
		$result=mysqli_query($cstccon,$sql);?>
        <script language="javascript">
            alert('Password Changed Successfully');
            document.location='CSTC_MainMenu.php';
        </script>
<?php		}
		else
			?>
        <script language="javascript">
            alert('Sorry. Password Mismatched. Try Again.');
            document.location='CSTC_MainMenu.php';
        </script>
<?php
	}
	else
		?>
        <script language="javascript">
            alert('Sorry. Invalid Old Password. Try Again.');
            document.location='CSTC_MainMenu.php';
        </script>
<?php
}
else
	echo "no"; //Invalid Login


?>
