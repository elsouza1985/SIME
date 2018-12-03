<?php
require_once('../config.php');
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
if (isset ( $_POST ['action'] ) && ! empty ( $_POST ['action'] )) {
$TipoImovel = $_POST['Fields']['Tipo']!= "null"? $_POST['Fields']['Tipo']:"" ;
$Negociacao = $_POST['Fields']['Finalidade']!= "null"? $_POST['Fields']['Finalidade']:"";
$Bairro = $_POST['Fields']['Bairro']!= "null"? $_POST['Fields']['Bairro']:"";
$CodImovel = $_POST['Fields']['CodImovel']!= "null"? $_POST['Fields']['CodImovel']:"";
getImoveis($TipoImovel, $Negociacao, $Bairro, $CodImovel);
}

function getImoveis($TipoImovel, $Negociacao, $Bairro, $CodImovel){
    $database = open_database ();
    $whereSql = " WHERE ";
    if($TipoImovel!= ""){
        if(strlen($whereSql) > 10){
            $whereSql .= " AND ";
        }
        $whereSql.= "TipoImovel.TipoImovelID =".$TipoImovel;
    }
    if($Negociacao!=""){
        if(strlen($whereSql) > 10){
            $whereSql .= " AND ";
        }
        $whereSql.= "Imoveis.ImovelNegociacao ='".$Negociacao."'"; 
    }
    if($Bairro!=""){
        if(strlen($whereSql) > 10){
            $whereSql .= " AND ";
        }
        $whereSql.= "Bairro.BairroID =".$Bairro; 
    }
    if($CodImovel!=""){
        $whereSql = " WHERE Imoveis.ImovelID=".$CodImovel;
    }

    $sql ="SELECT Distinct Imoveis.ImovelID,ImovelDescricao,ImovelDestaque, TipoImovel,ImovelValor,Images.Caminho as 'Fotos',
           ImovelEndereco,ImovelVagas,ImovelNegociacao, ImovelArea,ImovelQuartos, ImovelBanheiros, Bairro.BairroNome as 'Bairro' 
           FROM `Imoveis` 
           inner join Bairro on Imoveis.ImovelBairro = Bairro.BairroID 
           inner join TipoImovel on Imoveis.ImovelTipo = TipoImovel.TipoImovelID 
           join Images on Imoveis.ImovelID = Images.ImovelID";
    if(strlen($whereSql) > 10){
    $sql.=$whereSql;
    }
    $sql.=' GROUP BY Imoveis.ImovelID';
           $result=mysqli_query($database, $sql);
         
           while ($row=mysqli_fetch_array($result))
           {
            $json [] = $row;
           }
    
	
	$data ['data'] = isset($json)?$json:"";
   
    echo json_encode ( $data );
    //close_database ( $database );
}

?>