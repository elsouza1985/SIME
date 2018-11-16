<?php
$id = $_GET['delID'];

include('connection.php');

$sql = "DELETE FROM tblpersonalinfo WHERE id=$id";
if(mysqli_query($db, $sql))
{
	header('location:data.php');
}
else
{
	die('Could not delete record:' .mysqli_error($db));
}
?>