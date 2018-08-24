<?php
require_once('functions.php');
if (isset($_GET['ID'])){
	delete($_GET['ID']);
} else {
	die("ERRO: ID não definido.");
}
?>