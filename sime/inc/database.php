<?php
// require_once ('../config.php');
// require_once (DBAPI);
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
/**
 * Pesquisa no banco e retorna com os campos selecionados
 */
function getAll_FieldsAndFilter($table, $fields, $filtro) {
	$link = open_database ();
	$found = null;
	$sql = "SELECT " . $fields . " FROM " . $table . " " . $filtro;
	try {
		$result = $link->query ( $sql );
		if ($result->num_rows > 0) {
			$found = $result->fetch_all ( MYSQLI_ASSOC );
		}
	} catch (Exception $e) {
		$_SESSION ['type'] = 'danger';
	}
	return $found;
}
/**
 * 
 * Pesquisa um Registro pelo ID em uma Tabela
 */
function find($table = null, $id = null, $userID = null, $LojaID = null) {
	$database = open_database ();
	$found = null;
	try {
		if ($LojaID) {
			$sql = "SELECT * FROM " . $table . " WHERE Loja = " . $LojaID;
			$result = $database->query ( $sql );
				
			if ($result->num_rows > 0) {
				$found = $result->fetch_all ( MYSQLI_ASSOC );
			}
		}
		if ($userID) {
			$sql = "SELECT * FROM " . $table . " WHERE User = " . $userID;
			$result = $database->query ( $sql );
			
			if ($result->num_rows > 0) {
				$found = $result->fetch_all ( MYSQLI_ASSOC );
			}
		}
		if ($id) {
			$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
			$result = $database->query ( $sql );
			
			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc ();
			}
		}
		if (! $id && ! $userID) {
			
			$sql = "SELECT * FROM " . $table;
			$result = $database->query ( $sql );
			
			if ($result->num_rows > 0) {
				$found = $result->fetch_all ( MYSQLI_ASSOC );
				
				/*
				 * Metodo alternativo
				 * $found = array();
				 * while ($row = $result->fetch_assoc()) {
				 * array_push($found, $row);
				 * }
				 */
			}
		}
	} catch ( Exception $e ) {
		$_SESSION ['message'] = $e->GetMessage ();
		$_SESSION ['type'] = 'danger';
	}
	
	close_database ( $database );
	return $found;
}

/**
 * Pesquisa Todos os Registros de uma Tabela
 */
function find_all($table) {
	return find ( $table, null, null, null );
}
function find_clientes($table, $LojaID) {
	$database = open_database ();
	$found = null;
	$options = array ();
	$data = null;
	try {
		if ($LojaID) {
			$sql = "SELECT * FROM " . $table . " WHERE Loja = " . $LojaID;
			$result = $database->query ( $sql );
			if ($result) {
				if ($result->num_rows > 0) {
					while ( $row = mysqli_fetch_array ( $result ) ) {
						$data ['id'] = $row['id'];
						$data ['name'] = $row['name'];
						$data ['mobile'] = $row['mobile'];
						$options[] = $data;
					}
						
					echo json_encode ( $options );
				}
			}
		}
	} catch ( Exception $e ) {
		$_SESSION ['message'] = $e->GetMessage ();
		$_SESSION ['type'] = 'danger';
	}

	close_database ( $database );
	return $options;
}
/**
 * Pesquisa todos agendamentos para determinado usuario
 */
function find_agenda($table, $userID, $DataSearch) {
	$database = open_database ();
	$found = null;
	$options = array ();
	$data = null;
	try {
		if ($userID) {
			$sql = "SELECT * FROM " . $table . " WHERE User = " . $userID . " AND Data = '" . $DataSearch . "'";
			$result = $database->query ( $sql );
			if ($result) {
				if ($result->num_rows > 0) {
					while ( $row = mysqli_fetch_array ( $result ) ) {
						$data ['id'] = $row['ID'];
						$data ['Data'] = $row['Data'];
						$data ['Hora'] = $row['Hora'];
						$data ['Cliente'] = $row['Cliente'];
						$data ['User'] = $row['User'];
						$options[] = $data;
					}
					
					echo json_encode ( $options );
				}
			}
		}
	} catch ( Exception $e ) {
		$_SESSION ['message'] = $e->GetMessage ();
		$_SESSION ['type'] = 'danger';
	}
	
	close_database ( $database );
	return $options;
}
/**
 * Insere um registro no BD
 */
function save($table = null, $data = null) {
	$database = open_database ();
	$columns = null;
	$values = null;
	$InsertID = null;
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
		$database->query ( $sql );
		$_SESSION ['message'] = 'Registro cadastrado com sucesso.';
		$_SESSION ['type'] = 'success';
		$InsertID = $database->insert_id;
	} catch ( Exception $e ) {
		
		$_SESSION ['message'] = 'Nao foi possivel realizar a operacao.';
		$_SESSION ['type'] = 'danger';
	}
	close_database ( $database );
	return $InsertID;
}

/**
 * Atualiza um registro em uma tabela, por ID
 */
function update($table = null, $id = 0, $data = null) {
	$database = open_database ();
	$items = null;
	foreach ( $data as $key => $value ) {
		$items .= trim ( $key, "'" ) . "='$value',";
	}
	// remove a ultima virgula
	$items = rtrim ( $items, ',' );
	$sql = "UPDATE " . $table;
	$sql .= " SET $items";
	$sql .= " WHERE id=" . $id . ";";
	try {
		$database->query ( $sql );
		$_SESSION ['message'] = 'Registro atualizado com sucesso.';
		$_SESSION ['type'] = 'success';
	} catch ( Exception $e ) {
		$_SESSION ['message'] = 'Nao foi possivel realizar a operacao.';
		$_SESSION ['type'] = 'danger';
	}
	close_database ( $database );
}
/**
 * Remove uma linha de uma tabela pelo ID do registro
 */
function remove($table = null, $id = null) {
	$database = open_database ();
	
	try {
		if ($id) {
			$sql = "DELETE FROM " . $table . " WHERE id = " . $id;
			$result = $database->query ( $sql );
			if ($result = $database->query ( $sql )) {
				$_SESSION ['message'] = "Registro Removido com Sucesso.";
				$_SESSION ['type'] = 'success';
			}
		}
	} catch ( Exception $e ) {
		$_SESSION ['message'] = $e->GetMessage ();
		$_SESSION ['type'] = 'danger';
	}
	close_database ( $database );
}
