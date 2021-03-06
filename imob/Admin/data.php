<?php
 
    // Initialize the session
if (! isset($_SESSION)) {
	session_start ();
}
// If session variable is not set it will redirect to login page
if (! isset ( $_SESSION ['username'] ) || empty ( $_SESSION ['username'] )) {
	header ( "location: ../index.php" );
	exit ();
}
    include('../config.php');
    
    function reArrayFiles(&$file_post) {

      $file_ary = array();
      $file_count = count($file_post['name']);
      $file_keys = array_keys($file_post);
  
      for ($i=0; $i<$file_count; $i++) {
          if($file_post['name'][$i]!= ""){
          foreach ($file_keys as $key) {
              $file_ary[$i][$key] = $file_post[$key][$i];
          }
        }
      }
  
      return $file_ary;
  }
    if(isset($_POST['post'])){
        $idImovel = strip_tags(isset($_POST['txtIDImovel'])?$_POST['txtIDImovel']:""); 
        $DeleteFotos = strip_tags(isset($_POST['txtFotoRemovidaID'])?$_POST['txtFotoRemovidaID']:""); 
        $DeleteFotosNome = strip_tags(isset($_POST['txtFotoRemovidaNome'])?$_POST['txtFotoRemovidaNome']:""); 
    	$Imovel = strip_tags($_POST['ddrImovel']);
    	$Endereco = strip_tags($_POST['txtEndereco']);
    	$Preco = strip_tags(str_replace(".","",$_POST['txtPreco']));
    	$Condominio = strip_tags(str_replace(".","",$_POST['txtCondominio']));
    	$Quartos = strip_tags($_POST['ddrQuartos']);
    	$Banheiros = strip_tags($_POST['ddrBanheiros']);
    	$Vagas = strip_tags($_POST['ddrVagas']);
    	$Descricao = strip_tags($_POST['txtDescricao']);
    	$Bairro = strip_tags($_POST['ddrBairro']);
    	$Destaque = strip_tags(isset($_POST['chkDestaque'])?1:0);
    	$Area = strip_tags($_POST['txtArea']);
    	$Negociacao = strip_tags($_POST['ddrNegociacao']);
    
        $Imovel = mysqli_real_escape_string($db, $Imovel);
    	$Endereco = mysqli_real_escape_string($db, $Endereco);
    	$Preco = mysqli_real_escape_string($db, $Preco);
    	$Condominio = mysqli_real_escape_string($db, $Condominio);
    	$Quartos = mysqli_real_escape_string($db, $Quartos);
    	$Banheiros = mysqli_real_escape_string($db, $Banheiros);
    	$Vagas = mysqli_real_escape_string($db, $Vagas);
    	$Descricao = mysqli_real_escape_string($db, $Descricao);
    	$Bairro = mysqli_real_escape_string($db, $Bairro);
    	$Area = mysqli_real_escape_string($db, $Area);
        $Negociacao = mysqli_real_escape_string($db, $Negociacao);
        $Corretor = $_SESSION['userID'];
        if(isset($_FILES['image'])){
        $file_ary = reArrayFiles($_FILES['image']);
        }
    
        $sql = "SELECT CorretorID FROM Corretores Where CorretorUsuario = '$Corretor'";
        $result=mysqli_query($db, $sql);
        if ($result){
            while ($row=mysqli_fetch_array($result))  {
            $Corretor = $row['CorretorID'];
            }
        }    
        if($idImovel==""){
            $sql = "INSERT INTO Imoveis VALUES(NULL,'$Imovel' ,'$Preco', '$Condominio','$Bairro', '$Descricao' ,'$Destaque','$Quartos','$Banheiros','$Vagas','$Area','$Endereco','$Negociacao','$Corretor')";
            if (mysqli_query($db, $sql)){
                $last_id = mysqli_insert_id($db);
                insertFiles($last_id, $file_ary, $db);
            }
        }else{
            $sql = "UPDATE Imoveis SET 
             ImovelTipo = $Imovel ,ImovelValor = '$Preco', ImovelBairro='$Bairro', 
             ImovelDescricao = '$Descricao' , ImovelDestaque = '$Destaque',ImovelQuartos='$Quartos',
             ImovelBanheiros = '$Banheiros', ImovelVagas = '$Vagas',ImovelArea = '$Area',ImovelEndereco = '$Endereco',
             ImovelNegociacao = '$Negociacao',ImovelCorretor = '$Corretor', ImovelCondominio ='$Condominio'
             WHERE ImovelID = $idImovel";
                if (mysqli_query($db, $sql)){
                    if(isset($file_ary)){
                    insertFiles($idImovel, $file_ary, $db);
                    }
                    if(!isset($DeleteFotos)){
                        $DeletarArquivos['name'] = $DeleteFotosNome;
                        $DeletarArquivos['id'] = $DeleteFotos;
                        deleteFiles($DeletarArquivos,$db);
                    }
                }
        }
 }
 
 function insertFiles($last_id, $file_array, $db){
        
        foreach ($file_array as $file) {
            $name = $file['name'];
            $name = explode('.',$name);
            $name =rand(1000,33000).'.' .$name[1];
            $type = $file["type"];
            $size = $file["size"];
            $temp = $file["tmp_name"];
            $error = $file["error"];
            $sql = "INSERT INTO Images VALUES(NULL,'$last_id' ,'$name')";
                if ($error > 0) {
                    die("Upload an image please!");
                }else{
                    if($size > 10000000000){
                        die("Format is not allowed or file size is too big!");
                    }else{
                        if (mysqli_query($db, $sql)){
                            move_uploaded_file($temp,"uploads/".$name);
                        }else{
                            die('Unable to insert data:' .mysqli_error());
                        }
                    }
                }
        }
    }
    function deleteFiles($file_array,$db){
        
        
            $name = $file_array['name'];
            $FileID = $file_array['id'];
            if(strpos($FileID,',')){
            $sql = "DELETE FROM `Images` WHERE `IDImagem`  IN (".$FileID.")";
            }else{
                $sql = "DELETE FROM `Images` WHERE IDImagem=".$FileID." ";
            }
            
                if (mysqli_query($db, $sql)){
                    $deleteFiles = explode(";",$name);
                    $numFilesDelete = count($deleteFiles);
                    for ($i=0; $i < $numFilesDelete; $i++) { 
                        unlink("uploads/".$name);
                    }
                }else{
                     die('Unable to insert data:' .mysqli_error());
               }
                    
    }
        
    
 
    include(HEADER_TEMPLATE_TEST);
?>
<!--css e datatables -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <div class="container">
      
            <div class="col-xl d-flex justify-content-center">
                <a href="#" class="btn btn-primary li-modal1">Novo Imóvel</a>
            </div>
            
            <!-- Tabela de imoveis -->
            <table id="tblImoveis" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th class="all text-center" style="background-color:  #405163;color: white;" colspan="6">Lista de Imóveis Anunciados</th>
                   </tr>
                    <tr>
                    <th class="all">Cod</th>
                    <th class="all">Negócio</th>
                    <th class="all">Imóvel</th>
                    <th class="none">Bairro</th>
                    <th class="none">Preço</th>
                    <th class="all">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        include("connection.php");

                        $sql = "SELECT ImovelID, TipoImovel,ImovelValor,ImovelNegociacao, ImovelArea,ImovelQuartos, ImovelBanheiros, Bairro.BairroNome as 'Bairro' 
                        FROM `Imoveis` 
                        inner join Bairro on Imoveis.ImovelBairro = Bairro.BairroID 
                        inner join TipoImovel on Imoveis.ImovelTipo = TipoImovel.TipoImovelID";
                        $result=mysqli_query($db, $sql); //rs.open sql,con

                        while ($row=mysqli_fetch_array($result))
                        { ?>
                    <!--open of while -->
                        <tr>
                            <td>
                            <?php echo $row['ImovelID']; ?>
                            </td>
                            <td>
                            <?php echo $row['ImovelNegociacao']; ?>
                            </td>
                            <td>
                            <?php echo $row['TipoImovel']; ?>
                            </td>
                            <td>
                            <?php echo $row['Bairro']; ?>
                            </td>
                            <td>
                            <?php echo 'R$' . number_format( $row['ImovelValor'], 2, ',', '.'); ?>
                            </td>
                            <td>
                            <a href="<?php echo BASEURL; ?>view_data.php?vID=<?php echo $row['ImovelID']; ?>" class="btn btn-default btn-sm li-modal"
                                data-toggle="tooltip" title="Detalhes"><i class="fa fa-search"></i></a>
                            <a href="edit_data.php?uID=<?php echo $row['ImovelID']; ?>" class="btn btn-default btn-sm li-modal" data-toggle="tooltip"
                                title="Editar"><i class="fa fa-pen"></i></a>
                            <a href="#" onclick="confirmDelete('<?php echo $row['ImovelID'];?>', 'true')" class="btn btn-default btn-sm"
                                data-toggle="tooltip" title="Apagar"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                    <th class="all">Cod</th>
                    <th class="all">Negócio</th>
                    <th class="all">Imóvel</th>
                    <th class="none">Bairro</th>
                    <th class="none">Preço</th>
                    <th class="all">Ações</th>
                    </tr>
                </tfoot>
            </table>
            <!-- Modal -->
</div>
        <div id="ex1" class="modal fade text-center">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form enctype="multipart/form-data" action="data.php" method="post">
                            <div class="form-group">
                                <h2>Cadastro Imóvel</h2>
                                <hr>
                                    <label for="exampleFormControlSelect1">Tipo de Negóciação</label>
                                    <select class="form-control" id="ddrNegociacao" name="ddrNegociacao">
                                        <option value="Venda">Venda</option>
                                        <option value="Locação">Locação</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tipo de Imóvel</label>
                                    <select class="form-control" id="ddrImovel" name="ddrImovel">
                                        <option value="1">Casa</option>
                                        <option value="2">Apartamento</option>
                                        <option value="3">Terreno</option>
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
                                      ?>
                                   
                                        <option value=" <?php echo $row['BairroID']; ?>"> <?php echo $row['BairroNome']; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Endereço</label>
                                    <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" placeholder="Rua e número">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Preço</label>
                                    <input type="text" class="form-control" id="txtPreco" name="txtPreco" placeholder="R$123.000,000">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Condominio</label>
                                    <input type="text" class="form-control" id="txtCondominio" name="txtCondominio" placeholder="R$123.000,000">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Área M²</label>
                                    <input type="number" class="form-control" id="txtArea" name="txtArea" placeholder="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Quartos</label>
                                    <select class="form-control" id="ddrQuartos" name="ddrQuartos">
                                        <option value="0">0</option>    
                                        <option value="1">1</option>                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Banheiros</label>
                                    <select class="form-control" id="ddrBanheiros" name="ddrBanheiros">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Vagas</label>
                                    <select class="form-control" id="ddrVagas" name="ddrVagas">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Descrição</label>
                                    <textarea class="form-control" id="txtDescricao" name="txtDescricao" rows="3"></textarea>
                                </div>
                                <hr>
                                <div class="form-group" >
                                    <label for="exampleFormControlInput1">Fotos</label><br>
                                    <input type='file' onchange="readURL(this,'blah');" id="img0" name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah1');" id="img1"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah2');" id="img2"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah3');" id="img3"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah4');" id="img4"  name="image[]" style="display:none" />
                                    <input type='file' onchange="readURL(this,'blah5');" id="img5"  name="image[]" style="display:none" />
                                    <img id="blah" class="imgUp" src="<?php echo BASEURL; ?>assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img0')" />
                                    <img id="blah1" class="imgUp" src="<?php echo BASEURL; ?>assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img1')" />
                                    <img id="blah2" class="imgUp" src="<?php echo BASEURL; ?>assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img2')" />
                                    <img id="blah3" class="imgUp" src="<?php echo BASEURL; ?>assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img3')" />
                                    <img id="blah4" class="imgUp" src="<?php echo BASEURL; ?>assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img4')" />
                                    <img id="blah5" class="imgUp" src="<?php echo BASEURL; ?>assets/img/newpic.png" alt="Adicione uma foto" onclick="setFile('img5')" />
                                    
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="checkbox" name="chkDestaque" id="chkDestaque">
                                    <label for="exampleFormControlTextarea1">Colocar o Imóvel em destaque</label>
                                </div>
                                <hr>
                                <div class=" d-flex justify-content-center" >
                                    <input type="submit" name="post" value="Salvar" class="btn btn-primary">
                                </div>
                            </form>
                    </div>
                </div>
            </div> 
               
        <!-- end Modal -->
      </div>
    </div>           
                            
        
  <div id="theModal" class="modal fade ">
                <div class="modal-dialog">
                    <div class="modal-content">
                    </div>
                </div>
            </div> 
                            
       

</div>
   
    <!-- page script -->
    <script>
     
        $(document).ready(function(){
            $('#txtPreco').mask('#.##0,00', {reverse: true});
            $('#txtCondominio').mask('#.##0,00', {reverse: true});
            reloadClick();
            $('.li-modal1').on('click', function(e){
                    e.preventDefault();
                    $('#ex1').modal('show');
                    // setTimeout(testf, 1000);
                });
        });
        function reloadClick(){
            $('.li-modal').on('click', function(e){
                    e.preventDefault();
                    $('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
                    // setTimeout(testf, 1000);
                });
        }
        $(function () {

          
            $('#tblImoveis').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "sEmptyTable": "Nenhum imóvel encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ imóveis",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 imóvel",
                    "sInfoFiltered": "(Filtrados de _MAX_ imóveis)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum imóvel encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                },
                order: [[0, "desc"]],
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: -1
                }]
               
                
                
            });

            
        });
        function confirmDelete(delItem, reload_on_return){
            var url = window.location.origin+"<?php echo BASEURL; ?>";
            var result = confirm("Deseja Realmente Excluir este Imóvel?\nEsta ação não poderá ser desfeita!");
            if(result){
                $.ajax({
                    dataType: 'json',
                    url: url+'/Admin/delete_data.php',
                    type : 'GET',
                    async: false,
                    data: {delID:delItem },
                    success : function(data){
                        alert('Imovel apagado com sucesso!');
                        if (reload_on_return) {
                            setTimeout(
                            function() 
                            {
                                location.reload();
                            }, 0001);    
                        }
                          
                    }
                });
            }
        }
        function setFile(imgClick) {
            $('#'+imgClick).click();
        }
        function readURL(input, imgObj) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var imgID = $('#'+imgObj).attr('data-imgID');
                var imgNome = $('#'+imgObj).attr('src').split('/');
                imgNome = imgNome[imgNome.length-1];
                if(imgID != ""){
                    var valImg = $('#txtFotoRemovidaID').val();
                    var valImgNome = $('#txtFotoRemovidaNome').val();
                    if(valImg.length > 0){
                    imgID+=",";
                    imgNome+=";";
                    }
                    
                    valImg+=imgID;
                    valImgNome += imgNome;
                    $('#txtFotoRemovidaID').val(valImg);
                    $('#txtFotoRemovidaNome').val(valImgNome);

                }
                
                reader.onload = function (e) {
                    $('#'+imgObj)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php 
 include(FOOTER_TEMPLATE);
 ?>
