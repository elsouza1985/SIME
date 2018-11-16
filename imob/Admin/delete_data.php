<?php
if (! isset($_SESSION)) {
	session_start ();
}
// If session variable is not set it will redirect to login page
if (! isset ( $_SESSION ['username'] ) || empty ( $_SESSION ['username'] )) {
	header ( "location: ../login.php" );
	exit ();
}
$id = $_GET['delID'];

include('connection.php');
$sql = "SELECT * FROM Images WHERE ImovelID=$id";
$result=mysqli_query($db, $sql); 

	while ($row=mysqli_fetch_array($result))
	{
		unlink('/uploads/'.$row['Caminho']);	
	}

$sql = "DELETE FROM Imoveis WHERE ImovelID=$id";
if(mysqli_query($db, $sql))
{
	header('location:data.php');
}
else
{
	die('Could not delete record:' .mysqli_error($db));
}
?>