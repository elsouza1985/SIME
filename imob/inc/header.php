<?php  include_once('Admin/connection.php');
 if (! isset($_SESSION)) {
  session_start ();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
 
    <title>Jaqueline imovéis</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASEURL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="<?php echo BASEURL; ?>assets/css/carousel.css" rel="stylesheet">
     <link href="<?php echo BASEURL; ?>assets/css/v9.css" rel="stylesheet"> 




       <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="<?php echo BASEURL; ?>assets/js/jquery.js"> </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="<?php echo BASEURL; ?>assets/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo BASEURL; ?>assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo BASEURL; ?>assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo BASEURL; ?>assets/js/vendor/jquery.mask.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/js/principal.js"></script>
    
  </head>
  <body>

    <nav id="menu" class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse" style="background-color:#283e4a!important">
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
       
        if(!isset($_SESSION['username'])){ ?>
        <div class="br bw1 b--black-90 mr2 ph4 pv4 nowrap white">
          <a href="#ex2" rel="modal:open" class="linkLogin" >
          <i class="fa fa-cogs" aria-hidden="true"></i>
          <span class="ml2">Login</span></a></div>
        
      </div>
        <?php }else{ ?>
      <hr style="color:aliceblue">
      <div class="menu-container">
  <ul class="menu clearfix">
    <li>
      <a href="#"><?php echo $_SESSION['username'];?></a>
    
      <ul class="sub-menu clearfix">
         <li><a href="<?php echo BASEURL; ?>Admin/data.php" >Administrar</a></li>
         <li><a href="<?php echo BASEURL; ?>Admin/perfil.php" rel="modal:open">Perfil</a></li>
         <li><?php echo '<a href="doLogout.php?token='.md5(session_id()).'">Sair</a>';?></li>

        
      </ul>
              
    </li>
 		</ul> 
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
            if(i == 0 ){
                $imoveis +='<div class="row">';
             }
        		 imoveis += '<div class="col-xl d-flex justify-content-center" align="center" data-percentage="'+dados[i].ImovelValor+'">'+
            '<div class="BoxDestaqueTopo boxShadow" >'+
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
                            '<div class="SegundaSaidaObservacao">'+returnString(dados[i].ImovelDescricao)+'</div>'+
                          '</div>'+
                      '</div>'+
                      '<div class="bottomValores normalTextBox">'+
                          '<div class="TerceiraSaidaPreco">'+
                              '<span><label class="valorM">'+dados[i].ImovelValor+'</label></span>            </div>'+
                              '<div class="btoDetalheDestaque"></div>'+
                          '</div>  '+
                      '</div>'+
                      '<p>'+
                        '<a href="view_data.php?vID='+dados[i].ImovelID+'"  class="btn btn-primary btn-lg li-modal">'+
                          '<span class="glyphicon glyphicon-print"></span> Detalhes '+
                        '</a>'+
                      '</p> '+
                      '</div>'+
                    '</div>'+
          '</div>';
          if(i+1 == dados.length;){
            $imoveis +='</div>';
          }
        	 }
           $('#imoveisExpositor').empty();
           $('#imoveisExpositor').append(imoveis);
           var fieldsval = $('.valorM');
            for (var i = 0; i < fieldsval.length; i++) {
                  var textVal = $(fieldsval[i]).text();
                  $(fieldsval[i]).text(formatValor(textVal));
                
            }    
          
        }
       

    });
  }
  function returnString(str){

    if(str.length>120){
      return str.substring(0,102);
    }
    return str;
  }
  function logUser(){
    var url = window.location.origin+"<?php echo BASEURL; ?>";
    var campos = {
      "username": $('#txtUser').val(),
      "password":$('#txtPass').val()
    };
    $.ajax({
        dataType: 'json',
        url: url+'login.php',
        type : 'post',
        data: {action:'log_user', Fields:campos },
        success : function(data){
        	console.log(data);
          var dados = data.data
          
        }
      });
      $('#loginClose').click();
      location.reload();

  }
  $(document).ready(function(){
    $('#menu').focusout(function() {
       // alert();
  });
  })

  function hideMenu(){
    $('').addClass('collapsed');
    $('').removeClass()
  }
</script>
<form action="login.php" class="login_form modal" id="ex2" style="display: none;" method="POST">
  <h3>Insira seu usuário e senha para continuar</h3>
  <p><label>Usuário:</label><input type="text" name="username" id="txtUser"></p>
  <p><label>Senha:</label><input type="password" name="password" id="txtPass"></p>
  <p><input type="submit"  value="Login"></p>
<a href="#close-modal" rel="modal:close" class="close-modal " id="loginClose">Close</a>
</form>
<div id="maincontainer">

 
 