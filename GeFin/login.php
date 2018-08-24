<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $Perfil = $Loja = $Segmento= $UserId = $LojaID="";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, Lojas.Nome, Lojas.ID, Perfis.Nome, Segmento.ID,  users.Id, password FROM users INNER JOIN Lojas ON users.Loja = Lojas.ID  INNER JOIN Perfis ON users.Perfil = Perfis.ID INNER JOIN Segmento on Lojas.Segmento = Segmento.ID WHERE username = ?";
        
        
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt,$username,$Loja,$LojaID, $Perfil,$Segmento,$UserId,$hashed_password);
                    
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['Loja'] = $Loja;
                            $_SESSION['Perfil'] = $Perfil;
                            $_SESSION['Segmento'] = $Segmento;
                            $_SESSION['UserID'] = $UserId;
                            $_SESSION['LojaID'] = $LojaID;
                            header("location: /SIME/index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'Senha incorreta!';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'Usuario não possui conta';
                }
            } else{
                echo "Oops! Algo deu errado, tente novamente mais tarde";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="<?php echo BASEURL; ?>/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASEURL; ?>/favicon.ico" />
    <title>Lucra+ -- Seu sistema de geração de valor --</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="<?php echo BASEURL; ?>/assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="<?php echo BASEURL; ?>/assets/css/dashboard.css" rel="stylesheet" />
    <script src="<?php echo BASEURL; ?>/assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="<?php echo BASEURL; ?>/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="<?php echo BASEURL; ?>/assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="<?php echo BASEURL; ?>/assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="<?php echo BASEURL; ?>/assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="<?php echo BASEURL; ?>/assets/plugins/input-mask/plugin.js"></script>
  </head>

<body class="">
    <main class="container">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="<?php echo BASEURL; ?>/assets/images/valor-logo.png" class="h-6" alt="">
              </div>
              
              <form class="card" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Login para sua conta</div>
                  <div class="form-group">
                    <label class="form-label">Usuario</label>
                    <input type="text" class="form-control" name="username"  aria-describedby="emailHelp" placeholder="Usuario" value="<?php echo $username; ?>">
                 <span class="help-block"><?php echo $username_err; ?></span>
                  </div>
                  <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label class="form-label">
                      Senha
                      <a href="<?php echo BASEURL; ?>/forgot-password.html" class="float-right small">Eu esqueci a senha</a>
                    </label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                 <span class="help-block"><?php echo $password_err; ?></span>
                  </div>
                  <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Lembrar</span>
                    </label>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                  </div>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
 

<?php include(FOOTER_TEMPLATE); ?>