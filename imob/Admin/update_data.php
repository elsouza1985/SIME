<?php

$autoid = $_POST['hid'];
$fullname = $_POST['txtfullname'];
$email = $_POST['txtemail'];
$gender = $_POST['cboGender'];
$bdate = $_POST['txtbdate'];
$address = $_POST['txtaddress'];


include('connection.php');

$sql = "UPDATE tblpersonalinfo SET Fullname='$fullname', Email='$email', Gender='$gender', Birthday='$bdate', PresentAddress='$address' WHERE id='$autoid'";

if(mysqli_query($db, $sql))
{
	header('location:data.php');
}
else
{
	die('Unable to update record: ' .mysql_error());
}
?>