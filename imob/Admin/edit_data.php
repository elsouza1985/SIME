<?php
if (! isset($_SESSION)) {
	session_start ();
}
// If session variable is not set it will redirect to login page
if (! isset ( $_SESSION ['username'] ) || empty ( $_SESSION ['username'] )) {
	header ( "location: ../login.php" );
	exit ();
}
$viewID = $_GET['uID'];

  include('connection.php');

  $sql ="SELECT Imoveis.ImovelID,ImovelDescricao, TipoImovel,ImovelValor,GROUP_CONCAT(Images.Caminho SEPARATOR ';') as 'Fotos',ImovelEndereco,ImovelVagas,ImovelNegociacao, ImovelArea,ImovelQuartos, ImovelBanheiros, Bairro.BairroNome as 'Bairro' 
  FROM `Imoveis` 
  inner join Bairro on Imoveis.ImovelBairro = Bairro.BairroID 
  inner join TipoImovel on Imoveis.ImovelTipo = TipoImovel.TipoImovelID 
  inner join Images on Imoveis.ImovelID = Images.ImovelID
  where Imoveis.ImovelID = '$viewID'";
  $result = mysqli_query($db, $sql);

  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_array($result))
    {
      
      $Cod = $row['ImovelID'];
      $Imovel = $row['TipoImovel'];
      $Area = $row['ImovelArea'];
      $Bairro  = $row['Bairro'];
      $Banheiros = $row['ImovelBanheiros'];
      $Descricao = $row['ImovelDescricao'];
      $Endereco = $row['ImovelEndereco'];
      $Foto = $row['Fotos'];
      $Quartos = $row['ImovelQuartos'];
      $Vagas = $row['ImovelVagas'];
      $Valor = $row['ImovelValor'];
      $Negociacao = $row['ImovelNegociacao'];
    }
  }



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
  <aside class="main-sidebar">
    <section class="sidebar">
     
    </section>
  </aside>

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
         <form enctype="multipart/form-data" action="data.php" method="post">
                            <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tipo de Negóciação</label>
                                    <select class="form-control" id="ddrNegociacao" name="ddrNegociacao">
                                        <?php if($Negociacao == "Venda"){ ?>
                                        <option value="Venda" selected="selected">Venda</option>
                                        <option value="Locação">Locação</option>
                                        <?php }else{?>
                                          <option value="Venda"> Venda</option>
                                        <option value="Locação" selected="selected">Locação</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tipo de Imóvel</label>
                                    <select class="form-control" id="ddrImovel" name="ddrImovel">
                                    <?php if($Imovel == "Casa"){ ?>   
                                        <option value="1" selected="selected">Casa</option>
                                        <option value="2">Apartamento</option>
                                        <option value="3">Terreno</option>
                                    <?php }if($Imovel == "Apartamento"){ ?>  
                                      <option value="1">Casa</option>
                                        <option value="2"  selected="selected">Apartamento</option>
                                        <option value="3">Terreno</option>
                                        <?php }if($Imovel == "Terreno"){ ?>
                                          <option value="1">Casa</option>
                                        <option value="2"  >Apartamento</option>
                                        <option value="3" selected="selected">Terreno</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Bairro</label>
                                    <select class="form-control" id="ddrBairro" name="ddrBairro">
                                    <option value="0">Selecione</option>
                                    <?php
                                    $sql = "SELECT * FROM `Bairro`";
                                    $result=mysqli_query($db, $sql); //rs.open sql,con
                                    while ($row=mysqli_fetch_array($result))  {
                                      
                                        if($Bairro == $row['BairroNome']){
                                        ?>
                                        <option value=" <?php echo $row['BairroID']; ?>" selected="selected"> <?php echo $row['BairroNome']; ?></option>
                                        <?php }else{ ?>
                                        <option value=" <?php echo $row['BairroID']; ?>"> <?php echo $row['BairroNome']; ?></option>
                                    <?php }} ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Endereço</label>
                                    <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" placeholder="Rua e número" value="<?php echo $Endereco;?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Preço</label>
                                    <input type="number" class="form-control" id="txtPreco" name="txtPreco" placeholder="R$123.000,000" value="<?php echo $Valor; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Condominio</label>
                                    <input type="number" class="form-control" id="txtCondominio" name="txtCondominio" placeholder="R$123.000,000" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Área M²</label>
                                    <input type="number" class="form-control" id="txtArea" name="txtArea" placeholder="100" value="<?php echo $Area; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Quartos</label>
                                    <select class="form-control" id="ddrQuartos" name="ddrQuartos">
                                    <?php if($Quartos == "1"){ ?>      
                                      <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Quartos == "2"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2" selected="selected">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Quartos == "3"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Quartos == "4"){ ?>  
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4" selected="selected">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Quartos == "5"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected="selected">5</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Banheiros</label>
                                    <select class="form-control" id="ddrBanheiros" name="ddrBanheiros">
                                    <?php if($Banheiros == "1"){ ?>      
                                      <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Banheiros == "2"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2" selected="selected">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Banheiros == "3"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Banheiros == "4"){ ?>  
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4" selected="selected">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Banheiros == "5"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected="selected">5</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Vagas</label>
                                    <select class="form-control" id="ddrVagas" name="ddrVagas">
                                    <?php if($Vagas == "0"){ ?>      
                                      <option value="0" selected="selected">0</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Vagas == "1"){ ?>    
                                      <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Vagas == "2"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2" selected="selected">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Vagas == "3"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Vagas == "4"){ ?>  
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4" selected="selected">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Vagas == "5"){ ?>  
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected="selected">5</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Descrição</label>
                                    <textarea class="form-control" id="txtDescricao" name="txtDescricao" rows="3"><?php echo $Descricao;?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Fotos</label><br>
                                    <input type='file' onchange="readURL(this,'blah');" id="img1" name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah1');" id="img2"  name="image[]" style="display:none" />
                                    <img id="blah" class="imgUp" src="../img/newpic.png" alt="Adicione uma foto" onclick="setFile('img1')" />
                                    <img id="blah1" class="imgUp" src="../img/newpic.png" alt="Adicione uma foto" onclick="setFile('img2')" />
                                    <!--<img id="blah2" class="imgUp" src="../img/newpic.png" alt="Adicione uma foto" onclick="setFile()" />
                                    <img id="blah3" class="imgUp" src="../img/newpic.png" alt="Adicione uma foto" onclick="setFile()" />
                                    <img id="blah4" class="imgUp" src="../img/newpic.png" alt="Adicione uma foto" onclick="setFile()" />
                                    <img id="blah5" class="imgUp" src="../img/newpic.png" alt="Adicione uma foto" onclick="setFile()" />
                                    <img id="blah6" class="imgUp" src="../img/newpic.png" alt="Adicione uma foto" onclick="setFile()" />-->
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Destaque</label>
                                    <input type="checkbox" name="chkDestaque" id="chkDestaque">
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


<!-- page script -->
<script>
  
</script>
</body>
</html>
