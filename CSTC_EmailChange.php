<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
//Connect to database from here
require_once('Connections/cstccon.php');

//get the posted values
$email=htmlspecialchars($_POST['email'],ENT_QUOTES);
$email1=htmlspecialchars($_POST['email1'],ENT_QUOTES);
//$pass_new2=htmlspecialchars($_POST['pass_new2'],ENT_QUOTES);
//$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
//$pass=md5($_POST['password']);
//$pass=$_POST['password'];
//now validating the username and password

//if username exists

	//compare the password
	
		if(strcmp($email1,$email)==0)		
		{
		$sql="UPDATE cstcmis.cstc_user SET EMAIL = '". $email . "' WHERE UNAME = '" . $_SESSION['UNAME'] . "'";
		$result=mysqli_query($cstccon,$sql);
                $_SESSION['EMAIL'] = $email ;?>
        <script language="javascript">
            alert('Email Address Changed Successfully');
            document.location='CSTC_MainMenu.php';
        </script>
<?php		}
		else{
			?>
        <script language="javascript">
            alert('Sorry. Email Mismatched. Try Again.');
            document.location='CSTC_MainMenu.php';
        </script>
                <?php } ?>