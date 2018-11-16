<?php  include_once('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Jaqueline imovéis</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link href="../css/carousel.css" rel="stylesheet">
       <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="../js/principal.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse" style="background-color:#6fb5d8!important">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../index.php"><img src="../img/logo_imob.png" class="imgBrand"/></a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div id="BuscaAvancada">
        <form class="form-inline mt-2 mt-md-0">
        <fieldset>
				<ol>
					<li><div>
						<select id="Tipo" name="search[Tipo]" class="CampoBuscaImoveis" style="display:block;">
							<option value="null">Tipo do Imóvel</option>
							<option value="null">Todos</option>
							<option value="1">Casa</option>
							<option value="2">Apartamento</option>
							<option value="3">Terreno</option>
						</select>
						<div class="newListSelected  " tabindex="0">

<li>
	<div>
		<select id="Finalidade" name="search[Finalidade]" class="CampoBuscaImoveis" style="display: block;">
			<option value="null">Imóvel para</option>
			<option value="null">Todas</option>
			<option value="Venda">Venda</option>
			<option value="Locação">Locação</option>
		</select>
	</div>
</li>


<li>
	<div>
		<select id="Bairro" name="search[Bairro]" class="CampoBuscaImoveis" style="display: block;">
			<option value="null">Bairro</option>
      <?php
                                    $sql = "SELECT DISTINCT BairroID, BairroNome FROM `Bairro` 
                                    inner join  Imoveis on Imoveis.ImovelBairro = Bairro.BairroID
                                    ORDER BY BairroNome ASC";
                                    $result=mysqli_query($db, $sql); //rs.open sql,con
                                    while ($row=mysqli_fetch_array($result))  {
                                      ?>
                                   
                                        <option value=" <?php echo $row['BairroID']; ?>"> <?php echo $row['BairroNome']; ?></option>
                                    <?php } ?>
		</select>
	</div>
</li>
<li>
    <div>
        <input class="form-control mr-sm-2" type="text" id="CodImovel" placeholder="Cod. Imovel" name="search[CodImovel]">
    </div>
</li>
<li>
    <div>
    <button class="btn btn-outline-success my-2 my-sm-0 btnBuscar" type="button" onclick="getImoveis();return false">Buscar</button>
    </div>
</li>


</ol>
</fieldset>
</div>
          
        </form>
      </div>
    </nav>
<br />
<br />
<script>
  function getImoveis(){
    var url = window.location.origin+"/imob/";
    var campos = {
      "Tipo": $('#Tipo option:selected').val(),
      "Finalidade":$('#Finalidade option:selected').val(),
      "Bairro":$('#Bairro option:selected').val(),
      "CodImovel":$('#CodImovel').val()
    };
    $.ajax({
        dataType: 'json',
        url: url+'/Admin/dados.php',
        type : 'post',
        data: {action:'custom_select', Fields:campos },
        success : function(data){
        	console.log(data);
        	var dados = data.data
        	var imoveis = "";
        	 for (i = 0; i < dados.length; i++) {
        		 imoveis += '<div class="col-lg-4">'+
            '<div class="BoxDestaqueTopo boxShadow" onclick="self.location.href="Admin/view_data.php?vID='+dados[i].ImovelID+'">'+
                '<div class="DisponibilidadeImovelDestaques">'+
                  '<span>'+dados[i].ImovelNegociacao+'</span>'+
                '</div>'+
                '<div class="ModeloConteudoGeral">'+
                      '<div class="ImgFoto">'+
                           '<div class="ModeloFoto">'+
                              '<img src="Admin/uploads/'+dados[i].Fotos+'" class="FotoImovel" alt="">'+
                          '</div>'+
                      '</div>'+
                      '<div class="ModeloContainerInner">'+
                         '<div class="ModeloConteudoDescricao normalTextBox">'+
                            '<div class="ModeloRef">Cód:'+dados[i].ImovelID+'</div>'+
                            '<div class="ModeloTipoImovel">'+dados[i].TipoImovel+'</div>'+
                            '<div class="ModeloBairroImovel" title="'+dados[i].Bairro+'">'+dados[i].Bairro+' </div>'+
                            '<div class="ModeloComposicaoImovel">'+
                            '<div><span class="QtdeDepedencias">'+dados[i].ImovelQuartos+'</span> dorms. </div> '+
                            '<div class="SegundaSaidaObservacao">'+dados[i].ImovelDescricao+'</div>'+
                          '</div>'+
                      '</div>'+
                      '<div class="bottomValores normalTextBox">'+
                          '<div class="TerceiraSaidaPreco">'+
                              '<span>R$ '+dados[i].ImovelValor+'</span>            </div>'+
                              '<div class="btoDetalheDestaque"></div>'+
                          '</div>  '+
                      '</div>'+
                      '<p>'+
                        '<a href="Admin/view_data.php?vID='+dados[i].ImovelID+'" class="btn btn-primary btn-lg">'+
                          '<span class="glyphicon glyphicon-print"></span> Detalhes '+
                        '</a>'+
                      '</p> '+
                      '</div>'+
                    '</div>'+
          '</div>';
        	 }
           $('#imoveisExpositor').empty();
           $('#imoveisExpositor').append(imoveis);
        	
        }
    });
  }
</script>


 
 