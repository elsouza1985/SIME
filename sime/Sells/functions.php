<?php

require_once('../config.php');
require_once(DBAPI);

$Products = null;
$Product = null;
$Clientes = null;
$Cliente = null;

/**
 *  Listagem de Clientes
 */

function index() {
	if(!isset($_SESSION)){
		session_start();
	}
	global $Clientes;
	global $Products;
	//$Services = find_all('Servicos');
	$Products = find('Produtos', null, null,$_SESSION['LojaID']);
	$Clientes = find('customers', null, null, $_SESSION['LojaID']);
	
}

/**
 *  Cadastro de Vendas
 */
function add() {
	if (!empty($_POST['Product'])) {
		$Product = $_POST['Product'];
		$Product['Segmento'] =  $_SESSION['Segmento'];
		save('produtos', $Product);
		header('location: index.php');
	}
}
/**
 * Converte data no formato correto para o banco
 * @param string $_date
 * @return string|boolean
 */
function date_converter($_date = null) {
	$format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
	if ($_date != null && preg_match($format, $_date, $partes)) {
		return $partes[3].'-'.$partes[2].'-'.$partes[1];
	}
	return false;
}
/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {
	$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		if (isset($_POST['product'])) {
			$Product = $_POST['product'];
			$Product['modified'] = $now->format("Y-m-d H:i:s");
			update('products', $id, $Product);
			header('location: index.php');
		} else {
			global $Product;
			$Product = find('products', $id);
		}
	} else {
		header('location: index.php');
	}
}

/**
 *  Visualização de um Cliente
 */
function view($id = null) {
	global $Product;
	$Product = find('products', $id);
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {
	global $Product;
	$Product = remove('products', $id);
	header('location: index.php');
}
