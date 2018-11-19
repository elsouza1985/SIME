<?php
if (! isset($_SESSION)) {
	session_start ();
}
// If session variable is not set it will redirect to login page
if (! isset ( $_SESSION ['username'] ) || empty ( $_SESSION ['username'] )) {
	header ( "location: ../login.php" );
	exit ();
}
$usuario = $_SESSION ['username'] ;
$Nome = $_POST['txtNome'];
$Telefone = preg_replace( '/[^0-9]/', '', $_POST['txtTelefone']);
$email = $_POST['txtEmail'];
$Creci = $_POST['txtCreci'];
$NewUser = $_POST['txtNewUser'];
$UserID = $_SESSION ['userID'];

include('connection.php');
if($NewUser == 0){
$sql = "UPDATE Corretores SET CorretorNome='$Nome', CorretorEmail='$email', CorretorTelefone ='$Telefone', CorretorCRECI = '$Creci' WHERE CorretorUsuario='$UserID'";
}else{
    $sql = "INSERT INTO Corretores (CorretorID, CorretorNome, CorretorEmail, CorretorTelefone, CorretorCRECI, CorretorUsuario) VALUES(null,'$Nome','$email', '$Telefone', '$Creci','$UserID')";
}
if(mysqli_query($db, $sql))
{
	header('location:../index.php');
}
else
{
	die('Unable to update record: ' .mysqli_error());
}
?>