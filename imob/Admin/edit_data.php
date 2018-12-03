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


  $sql ="SELECT Imoveis.ImovelID,ImovelDescricao, ImovelDestaque, 
  ImovelCondominio,TipoImovel,ImovelValor,
  GROUP_CONCAT(Images.Caminho SEPARATOR ';') as 'Fotos',
  GROUP_CONCAT(Images.IDImagem SEPARATOR ';') as 'FotosID',
  ImovelEndereco,ImovelVagas,ImovelNegociacao, ImovelArea,
  ImovelQuartos, ImovelBanheiros, Bairro.BairroNome as 'Bairro' 
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
      $FotoID = $row['FotosID'];
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


    <style>
        .imgUp{
            max-width: 197px;
            min-width: 197px;
            height: 115px;
            padding: 5px;
        }
        .formFJus{
            padding-top: 10px;
            padding-left: 5px;
            padding-right: 5px;
        }
        label{
            font-weight:bold;
            padding-left:9px;
            color:#191A28;
        }
        </style>

    <section class="content">
      <div class="col-md-12">
        <div class="box">
          <div class="modal-header">
          <p class="h3 modal-title">Editar Anúncio</p>
            <button type="button" class="close" data-dismiss="modal">X</button>
        </div>
     
         <div class="box-body pad">
         <form enctype="multipart/form-data" action="data.php" method="post" style="background-color:#758A9D;">
         <input type="text" style="display:none;" id="txtIDImovel" name="txtIDImovel" value="<?php echo $Cod ?>" >
         <input type="text" style="display:none;" id="txtFotoRemovidaID" name="txtFotoRemovidaID" value="" >
         <input type="text" style="display:none;" id="txtFotoRemovidaNome" name="txtFotoRemovidaNome" value="" >
                            <div class="form-group formFJus">
                                    <label for="exampleFormControlSelect1">Tipo de Negociação</label>
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
                                <div class="form-group formFJus">
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
                                <div class="form-group formFJus">
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
                                <div class="form-group formFJus">
                                    <label for="exampleFormControlInput1">Endereço</label>
                                    <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" placeholder="Rua e número" value="<?php echo $Endereco;?>">
                                </div>
                                <div class="form-group formFJus">
                                    <label for="exampleFormControlInput1">Preço</label>
                                    <input type="text" class="form-control" id="txtPreco1" name="txtPreco" placeholder="R$123.000,000" value="<?php echo $Valor; ?>,00">
                                </div>
                                <div class="form-group formFJus">
                                    <label for="exampleFormControlInput1">Condominio</label>
                                    <input type="text" class="form-control" id="txtCondominio1" name="txtCondominio" placeholder="R$123.000,000" value="<?php echo $Condominio; ?>,00" >
                                </div>
                                <div class="form-group formFJus">
                                    <label for="exampleFormControlInput1">Área M²</label>
                                    <input type="number" class="form-control" id="txtArea" name="txtArea" placeholder="100" value="<?php echo $Area; ?>">
                                </div>
                                <div class="form-group formFJus">
                                    <label for="exampleFormControlSelect1">Quartos</label>
                                    <select class="form-control" id="ddrQuartos" name="ddrQuartos">
                                    <?php if($Quartos == "0"){ ?>    
                                        <option value="0" selected="selected">0</option>  
                                        <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Quartos == "1"){ ?>    
                                        <option value="0">0</option>  
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Quartos == "2"){ ?>  
                                        <option value="0">0</option>
                                      <option value="1" >1</option>
                                        <option value="2" selected="selected">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Quartos == "3"){ ?>  
                                            <option value="0">0</option>
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Quartos == "4"){ ?>  
                                            <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4" selected="selected">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Quartos == "5"){ ?>  
                                            <option value="0">0</option>
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected="selected">5</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group formFJus">
                                    <label for="exampleFormControlSelect2">Banheiros</label>
                                    <select class="form-control" id="ddrBanheiros" name="ddrBanheiros">
                                    <?php if($Banheiros == "0"){ ?>   
                                        <option value="0" selected="selected">0</option>   
                                        <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Banheiros == "1"){ ?>   
                                        <option value="0">0</option>   
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Banheiros == "2"){ ?>  
                                        <option value="0">0</option>
                                      <option value="1" >1</option>
                                        <option value="2" selected="selected">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Banheiros == "3"){ ?>  
                                            <option value="0">0</option>
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Banheiros == "4"){ ?>  
                                            <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4" selected="selected">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Banheiros == "5"){ ?>  
                                            <option value="0">0</option>
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected="selected">5</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group formFJus">
                                    <label for="exampleFormControlSelect2">Vagas</label>
                                    <select class="form-control" id="ddrVagas" name="ddrVagas">
                                    <?php if($Vagas == "0"){ ?>      
                                      <option value="0" selected="selected">0</option>
                                      <option value="1">0</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Vagas == "1"){ ?>    
                                        <option value="0">0</option>
                                      <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    <?php }if($Vagas == "2"){ ?>  
                                        <option value="0">0</option>
                                      <option value="1" >1</option>
                                        <option value="2" selected="selected">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Vagas == "3"){ ?>  
                                            <option value="0">0</option>
                                      <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Vagas == "4"){ ?>  
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4" selected="selected">4</option>
                                        <option value="5">5</option>
                                        <?php }if($Vagas == "5"){ ?>  
                                            <option value="0">0</option>
                                            <option value="1" >1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected="selected">5</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group formFJus">
                                    <label for="exampleFormControlTextarea1">Descrição</label>
                                    <textarea class="form-control" id="txtDescricao" name="txtDescricao" rows="3"><?php echo $Descricao;?></textarea>
                                </div>
                                <div class="form-group formFJus" style="text-align: center;">
                                    <label for="exampleFormControlInput1">Fotos</label><br>
                                    <input type='file' onchange="readURL(this,'blahe0');" id="imge1" name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blahe1');" id="imge2"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blahe2');" id="imge3"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blahe3');" id="imge4"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blahe4');" id="imge5"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blahe5');" id="imge6"  name="image[]" style="display:none" />
                                   
                                    <img id="blahe0" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('imge1')" />
                                    <img id="blahe1" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('imge2')" />
                                    <img id="blahe2" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('imge3')" />
                                    <img id="blahe3" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('imge4')" />
                                    <img id="blahe4" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('imge5')" />
                                    <img id="blahe5" class="imgUp" src="../assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('imge6')" />
                                   
                                </div>
                                <hr>
                                <div class="form-group formFJus">
                                    
                                    <input type="checkbox" name="chkDestaque" id="chkDestaque" <?php echo $Destaque;?>>
                                    <label for="exampleFormControlTextarea1">Colocar o Imóvel em destaque</label>
                                </div>
                                                               
                                <div class="form-group d-flex justify-content-center" style="background-color:white">
                                    <input type="button" value="Cancelar" class="btn btn-danger" data-dismiss="modal">&nbsp;
                                    <input type="submit" name="post" value="Salvar" class="btn btn-primary">
                                    
                                </div>
                            </form>
                            
          </div>
        </div>
      </div>
    </section>

  

<!-- page script -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script>

         $(document).ready(function(){
           $('#txtPreco1').mask('#.##0,00', {reverse: true});
           $('#txtCondominio1').mask('#.##0,00', {reverse: true});
            url = window.location.href;
            var fotos = '<?php echo $Foto ?>';
            var fotosID = '<?php echo $FotoID ?>';
            fotos = fotos.split(';');
            fotosID = fotosID.split(';');
            for(i = 0; i < fotos.length; i++){
                $('#blahe'+i).attr('src','../Admin/uploads/'+fotos[i]);
                $('#blahe'+i).attr('data-imgID',fotosID[i]);
            }
        });
</script>
