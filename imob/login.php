<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
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
    loginUser($username,$password);
  }
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
  function loginUser($username,$password){
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $db = open_database();
        $sql = "SELECT NomeUsuario, SenhaUsuario, IDUsuario FROM Usuarios WHERE NomeUsuario = ?";
        
        
        
        if($stmt = mysqli_prepare($db, $sql)){
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
                    mysqli_stmt_bind_result($stmt,$username,$hashed_password, $UserID);
                    
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['userID'] = $UserID;
                            
                            header("location:".BASEURL."index.php");
                        } else{
                            // Display an error message if password is not valid
                            header("location:".BASEURL."index.php");
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    header("location: /imob/index.php");
                }
            } else{
                echo "Oops! Algo deu errado, tente novamente mais tarde";
            }
        }
        
        // Close statement
       // mysqli_stmt_close($stmt);
    }
    header("location:".BASEURL."index.php");
    
    // Close connection
    //close_database($db);
}
?>
 