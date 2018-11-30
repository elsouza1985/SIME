<?php  
include_once(ABSPATH.'config.php');
include_once(ABSPATH.'Admin/connection.php');
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
   <script src="<?php echo BASEURL; ?>assets/js/vendor/jquery.mask.min.js"></script>
  <script src="<?php echo BASEURL; ?>assets/js/principal.js"></script>

  <title>Jaqueline imovéis</title>
  <style>
    .logo{
    max-width: 100px;
  }
.topnav {
  overflow: hidden;
  background-color: #283e4a;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 17px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.dropdown-content {
    display: none;
    position: fixed;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}
.dropdown:hover{
  display:block;
}
.topnav div:hover, .dropdown:hover .dropbtn {
  
  color: white;
}

.dropdown-content a:hover {
    background-color: #ddd;
    color: black;
}

.dropdown:hover .dropdown-content {
    display: block;
}
.hclass{
      display: none;
  }
.rowBusca{
  padding-top: 20px;
  padding-left: 90px;
  }
.siteTitle{
    position: absolute;
    margin-left: 29px;
    margin-top: -10px;
}

@media screen and (max-width: 600px) {
  .topnav div:not(:first-child), .dropdown .dropbtn {
    display: none; 
  }
  .hclass{
      display: block;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
    .siteTitle{
        display: block!important;
        margin-left: 38px;
        position: absolute;
        margin-top: -18px;
    }
    .rowBusca{
      padding-top: 20px;
    padding-left: 0px;
    }
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive div {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}

</style>
</head>

<body>
  <!--novo menu -->
  <div class="topnav" id="myTopnav">
    <a class="" href="<?php echo BASEURL; ?>index.php">
      <img src="<?php echo BASEURL; ?>assets/img/logo_imob.png" class="logo" />
     Jaqueline Oliveira

    </a>
    <a href="#home" class="active" >Home</a>
    <a href="?vIm=1">Venda</a>
    <a href="?vIm=2">Locação</a>
    <a href="sobre.php">Sobre</a>
    <a href="contato.php">Contato</a>
      <?php 
        if(!isset($_SESSION['username'])){ ?>
           <a href="login.php" class="linkLogin" data-toggle="modal" data-target="#modalLogin">
          <i class="fa fa-cogs" aria-hidden="true"></i>
          <span class="ml2">Login</span></a>
         <?php }else{ ?>
          <div class="dropdown">
        <button class="dropbtn"> 
          <?php echo $_SESSION['username'];?>
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="<?php echo BASEURL; ?>Admin/data.php">Administrar</a>
          <a href="<?php echo BASEURL; ?>Admin/perfil.php" >Perfil</a>
          <?php echo '<a href="doLogout.php?token='.md5(session_id()).'">Sair</a>';?>
        </div>
      </div>
       
    

      <?php } ?>


      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
    </div>
    </div>
    <script>
      function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
          x.className += " responsive";
        } else {
          x.className = "topnav";
        }
      }
    </script>


    <script>
      function getImoveis() {
        var url = window.location.origin + "<?php echo BASEURL; ?>";
        var campos = {
          "Tipo": $('#Tipo option:selected').val(),
          "Finalidade": $('#Finalidade option:selected').val(),
          "Bairro": $('#Bairro option:selected').val(),
          "CodImovel": $('#CodImovel').val()
        };
        $.ajax({
          dataType: 'json',
          url: url + '/Admin/dados.php',
          type: 'post',
          data: { action: 'custom_select', Fields: campos },
          success: function (data) {
            console.log(data);
            var dados = data.data
            var imoveis = "";
            for (i = 0; i < dados.length; i++) {
              imoveis += '<div class="col-lg-4">' +
                '<div class="BoxDestaqueTopo boxShadow" >' +
                '<div class="DisponibilidadeImovelDestaques">' +
                '<span>' + dados[i].ImovelNegociacao + '</span>' +
                '</div>' +
                '<div class="ModeloConteudoGeral">' +
                '<div class="ImgFoto">' +
                '<div class="ModeloFoto">' +
                '<img src="Admin/uploads/' + dados[i].Fotos + '" class="FotoImovel" alt="">' +
                '</div>' +
                '</div>' +
                '<div class="ModeloContainerInner">' +
                '<div class="ModeloConteudoDescricao normalTextBox">' +
                '<div class="ModeloRef">Cód:' + dados[i].ImovelID + '</div>' +
                '<div class="ModeloTipoImovel">' + dados[i].TipoImovel + '</div>' +
                '<div class="ModeloBairroImovel" title="' + dados[i].Bairro + '">' + dados[i].Bairro + ' </div>' +
                '<div class="ModeloComposicaoImovel">' +
                '<div><span class="QtdeDepedencias">' + dados[i].ImovelQuartos + '</span> dorms. </div> ' +
                '<div class="SegundaSaidaObservacao">' + returnString(dados[i].ImovelDescricao) + '</div>' +
                '</div>' +
                '</div>' +
                '<div class="bottomValores normalTextBox">' +
                '<div class="TerceiraSaidaPreco">' +
                '<span><label class="valorM">' + dados[i].ImovelValor + '</label></span>            </div>' +
                '<div class="btoDetalheDestaque"></div>' +
                '</div>  ' +
                '</div>' +
                '<p>' +
                '<a href="view_data.php?vID=' + dados[i].ImovelID + '" rel="modal:open" class="btn btn-primary btn-lg">' +
                '<span class="glyphicon glyphicon-print"></span> Detalhes ' +
                '</a>' +
                '</p> ' +
                '</div>' +
                '</div>' +
                '</div>';
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
      function returnString(str) {

        if (str.length > 120) {
          return str.substring(0, 102);
        }
        return str;
      }
      function logUser() {
        var url = window.location.origin + "<?php echo BASEURL; ?>";
        var campos = {
          "username": $('#txtUser').val(),
          "password": $('#txtPass').val()
        };
        $.ajax({
          dataType: 'json',
          url: url + 'login.php',
          type: 'post',
          data: { action: 'log_user', Fields: campos },
          success: function (data) {
            console.log(data);
            var dados = data.data

          }
        });
        $('#loginClose').click();
        location.reload();

      }
      $(document).ready(function () {
        
        // $('#myTopnav').focusout(function () {
        //   if ($(this).has(document.activeElement).length == 0) {
        //     $('#myTopnav').removeClass('responsive');
        //   }
          
        // });
      })
      var element = document.getElementById('myTopnav');
        element.addEventListener('focusout', function(event) {
            if (element.contains(event.relatedTarget)) {
                // don't react to this
                return;
            }
            $('#myTopnav').removeClass('responsive');
        });
    </script>
    <!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="container">
            <div class="row vertical-offset-100">
              <div class="col-md col-md-offset">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">ImobV9 - Login </h3>
                </div>
                  <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" action="login.php" method="POST">
                            <fieldset>
                        <div class="form-group">
                          <input class="form-control" placeholder="Usuario" name="username" type="text">
                      </div>
                      <div class="form-group">
                        <input class="form-control" placeholder="Senha" name="password" type="password" value="">
                      </div>
                      <div class="checkbox">
                          <label>
                            <input name="remember" type="checkbox" value="Remember Me">Lembrar
                          </label>
                        </div>
                      <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                    </fieldset>
                      </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End-->
    <br />
    <div id="maincontainer">