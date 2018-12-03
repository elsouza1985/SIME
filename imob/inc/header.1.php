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
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
p,label,h1, div{
  font-family: 'Roboto', sans-serif;
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
.topnav a:hover {
  background-color: #ddd;;
  color: black;
}
.active {
  background-color: #4CAF50;
  color: white;
}
.topnav a:first-child(2) {
    padding-left: 15%;
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
.topnav a:nth-last-child(2){
     float: right;
    margin-right: 80px;
  }
  .topnav div:nth-last-child(2){
   float:right; 
   margin-right: 80px;
  }

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
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
.adjustCenter{
      padding-left: 15%!important;
    }

@media screen and (max-width: 600px) {
    .siteTitle{
        display: block!important;
        margin-left: 38px;
        position: absolute;
        margin-top: -18px;
    }
    .adjustCenter{
      padding-left: 0;;
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
  .topnav.responsive a {
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
     <p style="position: absolute;
    left: 123px;
    font-size: 13px;
    font-weight: bold;
    top: 32px;">CRECI:177610</p>

    </a>
    <a href="?vIm=1" class="adjustCenter">Venda</a>
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
          <a href="<?php echo BASEURL; ?>Admin/perfil.php" class="li-modal" >Perfil</a>
          <?php echo '<a href="'.BASEURL.'doLogout.php?token='.md5(session_id()).'">Sair</a>';?>
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