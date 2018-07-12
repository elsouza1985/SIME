<?php
require '../api/db_config.php';



$id  = $_POST["id"];
$post = $_POST;


$sql = "UPDATE Agenda SET Data = '".$post['title']."'
    ,Cliente = '".$post['description']."'
    WHERE id = '".$id."'";


$result = $mysqli->query($sql);


$sql = "SELECT * FROM Agenda WHERE id = '".$id."'";


$result = $mysqli->query($sql);


$data = $result->fetch_assoc();


echo json_encode($data);
