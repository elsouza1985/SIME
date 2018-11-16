<?php
if (! isset($_SESSION)) {
	session_start ();
}
// If session variable is not set it will redirect to login page
if (! isset ( $_SESSION ['username'] ) || empty ( $_SESSION ['username'] )) {
	header ( "location: ../login.php" );
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
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>C.R.U.D</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"><b>C</b></span>
                <span class="logo-lg"><b>C</b>RUD</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>

                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="data.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>


            <section class="content">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Update</h3>
                        </div>
                        <div class="box-body pad">
                            <form enctype="multipart/form-data" action="edit_p.php" method="post">
                            <div class="form-group">
                                    <label for="exampleFormControlInput1">Usuario</label>
                                    <input type="text" class="form-control" id="txtArea" name="txtArea" disable="true" value="<?php echo $Usuario; ?>">
                                    <input type="hidden" name="txtNewUser" value="<?php echo($NewUser);?>" >
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
            </section>

            <aside class="control-sidebar control-sidebar-dark">
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
            </aside>
            <div class="control-sidebar-bg"></div>
        </div>

        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="plugins/fastclick/fastclick.js"></script>
        <script src="dist/js/app.min.js"></script>
        <script src="dist/js/demo.js"></script>
        <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="/imob/assets/js/vendor/jquery.mask.min.js"></script>


        <!-- page script -->
        <script>
            $(document).ready(function(){
                $('#txtTelefone').mask('(00) 00000-0000');            
                });
        </script>
</body>

</html>