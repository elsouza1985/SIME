<?php
require_once ('../config.php');

mysqli_report ( MYSQLI_REPORT_STRICT );
function open_database() {
	try {
		$conn = new mysqli ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
		return $conn;
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		return null;
	}
}
function close_database($conn) {
	try {
		mysqli_close ( $conn );
	} catch ( Exception $e ) {
		echo $e->getMessage ();
	}
}

$num_rec_per_page = 5;
$today = date_create ( 'now', new DateTimeZone ( 'America/Sao_Paulo' ) );

if (isset ( $_POST ['action'] ) && ! empty ( $_POST ['action'] )) {
	$action = $_POST ['action'];
	switch ($action) {
		case 'return_Agenda' :
			
			getAll_WithFilter ( $_POST ['table'], $_POST ['filter'] );
			break;
		
		case 'save_agendamento' :
			save ( $_POST ['table'], $_POST ['Data'] );
			break;
		case 'delete_agendamento' :
			delete ( $_POST ['table'], $_POST ['ItemID'] );
			break;
		case 'custom_select' :
			getAll_FieldsAndFilter ( $_POST ['table'], $_POST ['fields'], $_POST ['filter'] );
			break;
		case 'save_cliente' :
			$dados = $_POST ['Data'];
			$dados ['modified'] = $dados ['created'] = $today->format ( "Y-m-d H:i:s" );
			save ( $_POST ['table'], $dados );
			break;
		// case 'blah' : blah();break;
		// ...etc...
	}
}
function delete($table, $itemID) {
	$link = open_database ();
	$sql = "DELETE FROM " . $table . " WHERE ID= " . trim ( $itemID ) . "";
	
	$result = $link->query ( $sql );
	
	echo json_encode ( [ 
			$itemID 
	] );
}
function save($table = null, $data = null) {
	$database = open_database ();
	$columns = null;
	$values = null;
	// print_r($data);
	foreach ( $data as $key => $value ) {
		$columns .= trim ( $key, "'" ) . ",";
		$values .= "'$value',";
	}
	// remove a ultima virgula
	$columns = rtrim ( $columns, ',' );
	$values = rtrim ( $values, ',' );
	
	$sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
	try {
		$result = $database->query ( $sql );
		$data = $database->insert_id;
		echo json_encode ( $data );
	} catch ( Exception $e ) {
		
		$_SESSION ['message'] = 'Nao foi possivel realizar a operacao.';
		$_SESSION ['type'] = 'danger';
	}
	close_database ( $database );
}
function getAll_with_Page($Table, $page) {
	$link = open_database ();
	$start_from = ($page - 1) * $num_rec_per_page;
	
	$sqlTotal = "SELECT * FROM $Table";
	
	$sql = "SELECT * FROM $Table Order By id desc LIMIT $start_from, $num_rec_per_page";
	
	$result = $link->query ( $sql );
	
	while ( $row = $result->fetch_assoc () ) {
		
		$json [] = $row;
	}
	
	$data ['data'] = $json;
	
	$result = mysqli_query ( $link, $sqlTotal );
	
	$data ['total'] = mysqli_num_rows ( $result );
	close_database ( $link );
	
	echo json_encode ( $data );
}
function getAll_FieldsAndFilter($table, $fields, $filtro) {
	$link = open_database ();
	$sql = "SELECT " . $fields . " FROM " . $table . " " . $filtro;
	
	$result = $link->query ( $sql );
	$json = null;
	if ($result->num_rows > 0) {
		while ( $row = $result->fetch_assoc () ) {
			
			$json [] = $row;
		}
		if ($json != null) {
			array_filter ( $json );
			$data ['data'] = $json;
			close_database ( $link );
			echo json_encode ( $data );
		} else {
			echo json_encode ( "" );
		}
	} else {
		echo json_encode ( "" );
	}
}
function getAll_WithFilter($Table, $Filter) {
	$link = open_database ();
	$sql = "SELECT * FROM " . $Table . " " . $Filter;
	
	$result = $link->query ( $sql );
	$json = null;
	
	while ( $row = $result->fetch_assoc () ) {
		
		$json [] = $row;
	}
	if ($json != null) {
		array_filter ( $json );
		$data ['data'] = $json;
		close_database ( $link );
		echo json_encode ( $data );
	} else {
		echo json_encode ( "" );
	}
}