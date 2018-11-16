<?php
 
    // Initialize the session
if (! isset($_SESSION)) {
	session_start ();
}
// If session variable is not set it will redirect to login page
if (! isset ( $_SESSION ['username'] ) || empty ( $_SESSION ['username'] )) {
	header ( "location: ../login.php" );
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
    	$Imovel = strip_tags($_POST['ddrImovel']);
    	$Endereco = strip_tags($_POST['txtEndereco']);
    	$Preco = strip_tags($_POST['txtPreco']);
    	$Condominio = strip_tags($_POST['txtCondominio']);
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
    if(isset($_FILES['image'])){
      $file_ary = reArrayFiles($_FILES['image']);
      
    
		
    }
   
    	$sql = "INSERT INTO Imoveis VALUES(NULL,'$Imovel' ,'$Preco', '$Bairro', '$Descricao' ,'$Destaque','$Quartos','$Banheiros','$Vagas','$Area','$Endereco','$Negociacao')";
      if (mysqli_query($db, $sql)){
      $last_id = mysqli_insert_id($db);
      
      foreach ($file_ary as $file) {
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
          } else {
          if($size > 100000000000){
            die("Format is not allowed or file size is too big!");
          }
          else{
              if (mysqli_query($db, $sql)){
              move_uploaded_file($temp,"uploads/".$name);
              //header('location:data.php');
            }
            else{
              die('Unable to insert data:' .mysqli_error());
            }
          }
        }
    	}
    }
  }
 
 
    include(HEADERADM_TEMPLATE);
?>

                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"> &nbsp; </h3>
                            </div>

                            <div class="box-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Novo Imovél
                                </button>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped ">

                                    <thead>
                                        <tr>
                                            <th class="all">Cod</th>
                                            <th class="all">Negócio</th>
                                            <th class="all">Imovel</th>
                                            <th class="none">Bairro</th>
                                            <th class="none">Preço</th>
                                            <th class="none">Área</th>
                                            <th class="none">Quartos</th>
                                            <th class="none">Banheiros</th>
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
                                                <?php echo $row['ImovelValor']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ImovelArea']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ImovelQuartos']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ImovelBanheiros']; ?>
                                            </td>
                                            <td>
                                                <a href="../view_data.php?vID=<?php echo $row['ImovelID']; ?>" rel="modal:open"  class="btn btn-default btn-sm"
                                                    data-toggle="tooltip" title="Detalhes"><i class="fa fa-search"></i></a>
                                                <a href="edit_data.php?uID=<?php echo $row['ImovelID']; ?>" rel="modal:open"  class="btn btn-default btn-sm"
                                                    data-toggle="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
                                                <a href="delete_data.php?delID=<?php echo $row['ImovelID'];?>" class="btn btn-default btn-sm"
                                                    data-toggle="tooltip" title="Apagar"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>

                                        <?php
	                 } //close of while
	             ?>

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th class="all">Cod</th>
                                            <th class="all">Negócio</th>
                                            <th class="all">Imovel</th>
                                            <th class="none">Bairro</th>
                                            <th class="none">Preço</th>
                                            <th class="none">Área</th>
                                            <th class="none">Quartos</th>
                                            <th class="none">Banheiros</th>
                                            <th class="all">Ações</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
                    </div>

                    <div class="modal-body">
                        <div class="box-body pad">
                            <form enctype="multipart/form-data" action="data.php" method="post">
                            <div class="form-group">
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
                                    <input type="number" class="form-control" id="txtPreco" name="txtPreco" placeholder="R$123.000,000">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Condominio</label>
                                    <input type="number" class="form-control" id="txtCondominio" name="txtCondominio" placeholder="R$123.000,000">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Área M²</label>
                                    <input type="number" class="form-control" id="txtArea" name="txtArea" placeholder="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Quartos</label>
                                    <select class="form-control" id="ddrQuartos" name="ddrQuartos">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Banheiros</label>
                                    <select class="form-control" id="ddrBanheiros" name="ddrBanheiros">
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
            </div>
        </div>
        <!-- end Modal -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2018 - Valor9 Sistemas. &nbsp; </strong> All rights
            reserved.
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
        </aside>
        <div class="control-sidebar-bg"></div>
    </div>

    <script src="<?php echo BASEURL; ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/plugins/fastclick/fastclick.js"></script>
    
    <script src="<?php echo BASEURL; ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
 

    <!-- page script -->
    <script>
        $(function () {

            $("#example1").DataTable({
                order: [[0, "asc"]],
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
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

            //Date picker
            $('#datepicker1').datepicker({
                autoclose: true
            });
        });
        function setFile(imgClick) {
            $('#'+imgClick).click();
        }
        function readURL(input, imgObj) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+imgObj)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>