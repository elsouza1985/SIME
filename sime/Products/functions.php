<?php

require_once('../config.php');
require_once(DBAPI);

$Products = null;
$Product = null;
if(!isset($_SESSION)){
	session_start();
}
if (isset ( $_POST ['action'] ) && ! empty ( $_POST ['action'] )) {
	$action = $_POST ['action'];
	switch ($action) {
		case 'createNew' :
			add();
			break;
	}
}
/**
 *  Listagem de Produtos
 */

function index() {
	
	global $Products;
	
	$fields = "Produtos.ID, Produtos.Nome, Produtos.Tipo, Valores.Valor";
	$filtro ="INNER JOIN Valores on Produtos.ID = Valores.Produto	Where Produtos.Loja =".$_SESSION['LojaID'];
	$Products = getAll_FieldsAndFilter( "Produtos", $fields,$filtro);
	
	
}

/**
 *  Cadastro de Clientes
 */
function add() {
	
	if (!empty($_POST['Product'])) {
	
		$Product = $_POST['Product'];
		$Product['Segmento'] =  $_SESSION['Segmento'];
		$Product['Loja'] = $_SESSION["LojaID"];
		$idProduto = save('Produtos', $Product);
		$Valor = $_POST['Valor'];
		$Valor['Data'] = date("Y-m-d");
		$Valor['Loja'] = $_SESSION["LojaID"];
		$Valor['Ativo'] = TRUE;
		$Valor['Produto'] = $idProduto;
		save('Valores', $Valor);
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
