<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = $name = $contato = $perfil= $loja ="";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	// Validate username
	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter a username.";
	} else{
		// Prepare a select statement
		$sql = "SELECT id FROM users WHERE username = ?";

		if($stmt = mysqli_prepare($link, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);

			// Set parameters
			$param_username = trim($_POST["username"]);
			$param_Nome = trim($_POST["name"]);
			$param_Celular = trim($_POST["contato"]);
			$param_Perfil = trim($_POST["Perfil"]);
			$param_Loja = trim($_POST["Loja"]);
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				/* store result */
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt) == 1){
					$username_err = "This username is already taken.";
				} else{
					$username = trim($_POST["username"]);
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
		}
		 
		// Close statement
		mysqli_stmt_close($stmt);
	}

	// Validate password
	if(empty(trim($_POST['password']))){
		$password_err = "Please enter a password.";
	} elseif(strlen(trim($_POST['password'])) < 6){
		$password_err = "Password must have atleast 6 characters.";
	} else{
		$password = trim($_POST['password']);
	}

	// Validate confirm password
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = 'Please confirm password.';
	} else{
		$confirm_password = trim($_POST['confirm_password']);
		if($password != $confirm_password){
			$confirm_password_err = 'Password did not match.';
		}
	}

	// Check input errors before inserting in database
	if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

		// Prepare an insert statement
		$param_password = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO users (username, password, Nome, Celular, Perfil, Loja) VALUES ('$param_username', '$param_password', '$param_Nome', '$param_Celular', '$param_Perfil', '$param_Loja')";
		 
		
			
		try {
		$link->query($sql);
		$_SESSION ['message'] = 'Registro cadastrado com sucesso.';
		$_SESSION ['type'] = 'success';
	} catch ( Exception $e ) {
		
		$_SESSION ['message'] = 'Nao foi possivel realizar a operacao.';
		$_SESSION ['type'] = 'danger';
	}
		
		 
		// Close statement
	//	mysqli_stmt_close($stmt);
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
  
    <title>Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
   
    <!-- Dashboard Core -->
    <link href="<?php echo BASEURL; ?>/assets/css/dashboard.css" rel="stylesheet" />
    <script src="<?php echo BASEURL; ?>/assets/js/dashboard.js"></script>
 </head>

<body class="">
 
    <main class="container">
    <div class="wrapper">
        <h2>Novo Usuario</h2>
        <p>Preencha este formulario para criar um novo usuario.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group ">
                <label>Nome</label>
                <input type="text" name="name"class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Contato</label>
                <input type="text" name="contato" class="form-control" value="<?php echo $contato; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Senha</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Loja</label>
                <select class="form-control" id="ddrLoja" name="Loja">
                	<option value="0">Selecione a loja...</option>
                	<option value="2">Valor Sistemas</option>
                	
                </select>
                
            </div>
            <div class="form-group">
                <label>Perfil</label>
                <select class="form-control" id="ddrPerfil" name="Perfil">
                	<option value="0">Selecione o Perfil...</option>
                	<option value="1">Administrador</option>
                	<option value="2">Proprietario</option>
                	<option value="3">Usuario</option>
                </select>
                
            </div>
           
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            
        </form>
    </div>    

<?php include(FOOTER_TEMPLATE); ?>