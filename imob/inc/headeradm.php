
<?php  include_once('../config.php');
if (! isset($_SESSION)) {
	session_start ();
}
// If session variable is not set it will redirect to login page
if (! isset ( $_SESSION ['username'] ) || empty ( $_SESSION ['username'] )) {
	header ( "location: ../index.php" );
	exit ();
}
try {
include('connection.php');
$UsuarioID = $_SESSION ['userID'];
$Usuario = $_SESSION ['username'];
  $sql =" SELECT * 
  FROM `Corretores` 
  where CorretorUsuario = '$UsuarioID'";
  $result = mysqli_query($db, $sql);
    
  //if(mysqli_num_rows($result) > 0)
  if($result)
  {
    while($row = mysqli_fetch_array($result))
    {
      
      $ID = $row['CorretorID'];
      
      $Nome = $row['CorretorNome'];
      $Email  = $row['CorretorEmail'];
      $Telefone = $row['CorretorTelefone'];
      $Creci = $row['CorretorCRECI']; 
      $NewUser = 0;
    }
}else{
    $NewUser = 1;
}
} catch(Exception $e){}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>JaquelineImoveis - Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>assets/css/v9.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link href="<?php echo BASEURL; ?>assets/css/carousel.css" rel="stylesheet">
    <script src="<?php echo BASEURL; ?>assets/js/jquery.js"> </script>
    <script src="<?php echo BASEURL; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  
   <script src="<?php echo BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
   <script src="<?php echo BASEURL; ?>assets/js/vendor/jquery.mask.min.js"></script>
   <script src="<?php echo BASEURL; ?>assets/js/principal.js"></script>
</head>
  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse" style="background-color:#5c666b!important;margin-top: -29px;">
      
      <a class="navbar-brand" href="../index.php">
        <img src="<?php echo BASEURL; ?>assets/img/logo_imob.png" class="imgBrand" style="float:left"/>
        <label  style="float:left;color:white;margin-left:-123px;">Jaqueline Oliveira</label>  
      </a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        
        
      <?php 
       
       if(!isset($_SESSION['username'])){ ?>
       <div class="br bw1 b--black-90 mr2 ph4 pv4 nowrap white">
         <a href="#ex2" rel="modal:open" class="linkLogin" >
         <svg aria-hidden="true" data-prefix="fas" data-icon="cogs" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-cogs fa-w-20 fa-lg"><path fill="currentColor" d="M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z" class=""></path></svg> 
         <span class="ml2">Login</span></a></div>
       
     </div>
       <?php }else{ ?>
        <div class="menu-container">
          <ul class="menu clearfix" style="float:right;margin-right: 36px;">
            <li>
              <a href="#"><?php echo $_SESSION['username'];?></a>
            
              <ul class="sub-menu clearfix">
                  <li><a href="<?php echo BASEURL; ?>Admin/data.php" >Administrar</a></li>
                  <li><a href="#"  data-toggle="modal" data-target="#myModal1">Perfil</a></li>
                  <li><?php echo '<a href="'.BASEURL.'doLogout.php?token='.md5(session_id()).'">Sair</a>';?></li>
              </ul> 
              <br>
              teste  
            </li>
        </ul> 
    </div>
     <?php } ?>
   </nav>
<br />
<br />
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel1">&nbsp;</h4>
                    </div>

                    <div class="modal-body">
                        <div class="box-body pad">
                        <form enctype="multipart/form-data" action="edit_p.php" method="post">
                            <div class="form-group" style="display:none">
                                    <label for="exampleFormControlInput1">Usuario</label>
                                    <input type="text" class="form-control" id="txtArea" name="txtArea" disable="true" value="<?php echo $Usuario; ?>">
                                    <input type="hidden" name="txtNewUser" value="<?php echo($NewUser);?>" >
                                </div>
                                <div class="box-header">
                                     <h3 class="box-title">Dados do Corretor:</h3>
                                     <hr>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Nome</label>
                                    <input type="text" class="form-control" id="txtNome" name="txtNome"  value="<?php echo(isset($Nome)? $Nome: "" ); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">CRECI</label>
                                    <input type="text" class="form-control" id="txtCreci" name="txtCreci"  value="<?php echo (isset($Creci)?$Creci: "" ); ?>">
                                </div>      <div class="form-group">
                                    <label for="exampleFormControlInput1">E-mail</label>
                                    <input type="text" class="form-control" id="txtEmail" name="txtEmail"  value="<?php  echo (isset($Email)?$Email:""); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Telefone</label>
                                    <input type="text" class="form-control" id="txtTelefone" name="txtTelefone"  value="<?php echo  (isset($Telefone)?$Telefone:""); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="post" value="Salvar" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<div id="maincontainer">

 