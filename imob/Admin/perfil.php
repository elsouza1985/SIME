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

        
            <section class="content" style="margin-top:50px;">
                <div class="col-md-12">
                    <div class="box">
                        
                        <div class="box-body pad">
                            <form enctype="multipart/form-data" action="Admin/edit_p.php" method="post">
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
            </section>

            
        </div>

       
        <script src="<?php echo BASEURL; ?>assets/js/vendor/jquery.mask.min.js"></script>


        <!-- page script -->
        <script>
            $(document).ready(function(){
                $('#txtTelefone').mask('(00) 00000-0000');            
                });
        </script>
