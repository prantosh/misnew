<?php
// This function checks for email injection. Specifically, it checks for carriage returns - typically used by spammers to inject a CC list.
require_once('Connections/cstccon.php');
session_start();

$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
$email1=htmlspecialchars($_POST['email'],ENT_QUOTES);

$sql="SELECT * FROM cstcmis.cstc_user WHERE UNAME='".$user_name."'";
$result=mysqli_query($cstccon,$sql);
$row=mysqli_fetch_array($result);
$email = $row['EMAIL'];

function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password1 = substr( str_shuffle( $chars ), 0, $length );
    return $password1;
}

if($email == $email1){
$password2 = random_password(8);
    mail( $email, "Password for MMS access" ,"Your Password for MMS is " . $password2);  
    
$pass_new11 = sha1(md5(md5($password2)));
$sql="UPDATE cstcmis.cstc_user SET PWD = '". $pass_new11 . "' WHERE UNAME = '" . $user_name . "'";
		$result=mysqli_query($cstccon,$sql);
 
?>
<script>
alert("Thank You. Mail has been sent successfully");
				 document.location='index.php';
                                 </script>
<?php
}
else{
    ?>
<script>
alert("Invalid User Name / Email Address. Please try again");
				 document.location='index.php';
                                 </script>
<?php
}
?>
