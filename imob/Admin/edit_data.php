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

  $sql ="SELECT Imoveis.ImovelID,ImovelDescricao, ImovelDestaque, ImovelCondominio,TipoImovel,ImovelValor,GROUP_CONCAT(Images.Caminho SEPARATOR ';') as 'Fotos',ImovelEndereco,ImovelVagas,ImovelNegociacao, ImovelArea,ImovelQuartos, ImovelBanheiros, Bairro.BairroNome as 'Bairro' 
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
      $Condominio = $row['ImovelCondominio'];
      $Negociacao = $row['ImovelNegociacao'];
      $Destaque = $row['ImovelDestaque'];
    }
    $Destaque = $Destaque == '1'?"checked":"";
  }



?>


    

    <section class="content">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
              <h3 class="box-title">Editar Imovel</h3>
          </div>
          <hr>
         <div class="box-body pad">
         <form enctype="multipart/form-data" action="data.php" method="post">
         <input type="text" style="display:none;" id="txtIDImovel" name="txtIDImovel" value="<?php echo $Cod ?>" >
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
                                    <input type="text" class="form-control" id="txtPreco1" name="txtPreco" placeholder="R$123.000,000" value="<?php echo $Valor; ?>,00">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Condominio</label>
                                    <input type="text" class="form-control" id="txtCondominio1" name="txtCondominio" placeholder="R$123.000,000" value="<?php echo $Condominio; ?>,00" >
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
                                <div class="form-group" style="text-align: center;">
                                    <label for="exampleFormControlInput1">Fotos</label><br>
                                    <input type='file' onchange="readURL(this,'blah');" id="img1" name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah1');" id="img2"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah2');" id="img3"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah3');" id="img4"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah4');" id="img5"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah5');" id="img6"  name="image[]" style="display:none" />
                                   
                                    <img id="blah" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img1')" />
                                    <img id="blah1" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img2')" />
                                    <img id="blah2" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img3')" />
                                    <img id="blah3" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img4')" />
                                    <img id="blah4" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img5')" />
                                    <img id="blah5" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img6')" />
                                   
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Destaque</label>
                                    <input type="checkbox" name="chkDestaque" id="chkDestaque" <?php echo $Destaque;?>>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="submit" name="post" value="Salvar" class="btn btn-primary">
                                </div>
                            </form>
          </div>
        </div>
      </div>
    </section>

  

<!-- page script -->
<script>
         $(document).ready(function(){
            $('#txtPreco1').mask('#.##0,00', {reverse: true});
            $('#txtCondominio1').mask('#.##0,00', {reverse: true});
        });
</script>
