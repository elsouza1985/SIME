<?php
require '../api/db_config.php';



$post = $_POST;


$sql = "INSERT INTO Agenda (Loja,Data,Cliente,Hora,User)


	VALUES ('".$post['Loja']."','".$post['Data']."','".$post['Cliente']."','".$post['Hora']."','".$post['User']."')";


$result = $mysqli->query($sql);


$sql = "SELECT * FROM Agenda Order by id desc";


$result = $mysqli->query($sql);


$data = $result->fetch_assoc();


echo json_encode($data);