<?php  include_once('Admin/connection.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo BASEURL; ?>favicon.ico">

    <title>Jaqueline imovéis</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASEURL; ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASEURL; ?>assets/css/carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


       <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo BASEURL; ?>assets/js/jquery.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="<?php echo BASEURL; ?>assets/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo BASEURL; ?>assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo BASEURL; ?>assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo BASEURL; ?>assets/js/vendor/jquery.mask.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/js/principal.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  </head>
  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse" style="background-color:#5c666b!important">
      <button id="btnMenu" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img src="<?php echo BASEURL; ?>assets/img/logo_imob.png" class="imgBrand"/>
        <label class="LabelTitle">Jaqueline Oliveira</label>  
      </a>
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
    <button  class="btn btn-outline-success my-2 my-sm-0 btnBuscar" type="button" onclick="getImoveis();return false">Buscar</button>
    </div>
</li>


</ol>
</fieldset>
</div>
          
        </form>
        <hr style="color:aliceblue">
        <?php 
        if(isset($_SESSION['UserName'])){ ?>
        <div class="br bw1 b--black-90 mr2 ph4 pv4 nowrap white">
          <a href="#ex2" rel="modal:open" class="linkLogin" >
          <svg aria-hidden="true" data-prefix="fas" data-icon="cogs" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-cogs fa-w-20 fa-lg"><path fill="currentColor" d="M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z" class=""></path></svg> 
          <span class="ml2">Login</span></a></div>
        
      </div>
        <?php }else{ ?>
      <hr style="color:aliceblue">
        <div class="br bw1 b--black-90 mr2 ph4 pv4 nowrap white">
             <span class="ml2">Jaqueline</span></a></div>
        
      </div>
      <?php } ?>
    </nav>
<br />
<br />
<script>
  function getImoveis(){
    var url = window.location.origin+"<?php echo BASEURL; ?>";
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
                              '<span>R$ <label class="valorM">'+dados[i].ImovelValor+'</label></span>            </div>'+
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
           $('.valorM').mask('000.000.000.000.000,00', {reverse: true});         
          
        }
       

    });
  }
</script>
<form action="" class="login_form modal" id="ex2" style="display: none;">
  <h3>Insira seu usuário e senha para continuar</h3>
  <p><label>Usuário:</label><input type="text"></p>
  <p><label>Senha:</label><input type="password"></p>
  <p><input type="submit" value="Login"></p>
<a href="#close-modal" rel="modal:close" class="close-modal ">Close</a></form>
<div id="maincontainer">

 
 