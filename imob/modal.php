<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
                    </div>

                    <div class="modal-body">
                        <div class="box-body pad">
                        <?php
$viewID = $_GET['vID'];

  include('../imob/Admin/connection.php');

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
$Fotos = explode(';',$Foto);
                                        $xi = 0;
                                        $ImoveisDestaque = "";
                    for ($i=0; $i < count($Fotos); $i++) { 
                       if($xi == 0){
                        $ImoveisDestaque = '<div class="carousel-item active">
                      <img class="first-slide" src="Admin/uploads/'.$Fotos[$i].'" alt="First slide">
                        <div class="container">
                          <div class="carousel-caption d-none d-md-block text-center fundo">
                          </div>
                        </div>
                      </div>';
                     } else{
                       $ImoveisDestaque.= '<div class="carousel-item ">
                       <img class="first-slide" src="Admin/uploads/'.$Fotos[$i].'" alt="First slide">
                         <div class="container">
                           <div class="carousel-caption d-none d-md-block text-center fundo">
                          </div>
                         </div>';
                      
                    }
                    $xi++;
                }
                    
       



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-size: 22px;">
            <?php echo $Imovel.' '.$Negociacao.', '.$Quartos .' quarto(s), R$' ?><label class="valorM">
                <?php echo($Valor)?></label><br>
            <small>
                <?php echo $Endereco ?></small>
        </h1>
        <ol class="breadcrumb" style="display:none">
            <li><a href="data.php"><i class="fa fa-dashboard"></i>
                    <?php echo $Imovel ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-7">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">  
                <li data-target="#myCarousel" data-slide-to="2" ></li>
                </ol>    
                    <div class="carousel-inner" role="listbox">
                        <?php echo($ImoveisDestaque);?>
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Proximo</span>
                    </a>
                </div>
            </div>

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border" style="text-align: -webkit-center;">
                    <h3 class="box-title">Detalhes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="text-align: -webkit-center;">
                    <strong><i class="fa fa-usd" aria-hidden="true"></i> Valor do imóvel</strong>
                    <p class="text-muted"> R$ 
                        <label class="valorM">
                            <?php echo($Valor)?></label>
                    </p>
                    <hr>
                    <strong><i class="fa fa-home" aria-hidden="true"></i> Tipo de imóvel</strong>
                    <p class="text-muted">
                        <?php echo $Imovel; ?>
                    </p>


                    <strong><i class="fa fa-columns" aria-hidden="true"></i> Área</strong>
                    <p class="text-muted">
                        <?php echo $Area .'m²' ; ?>
                    </p>

                    <p class="text-muted">
                        <i class="fa fa-bed"></i>
                        <?php echo $Quartos.' quarto(s)'; ?>
                    </p>

                    <p class="text-muted">
                        <i class="fa fa-bath"></i>
                        <?php echo $Banheiros.' Banheiro(s)'; ?>
                    </p>
                    <hr>
                    <h3 class="profile-username text-center">Descrição</h3>
                    <p class="text-muted">
                        <?php echo $Descricao; ?>
                    </p>
                    <hr>
                    <h3 class="profile-username text-center">Corretor</h3>
                    <p class="text-muted">
                        <?php echo $Descricao; ?>
                    </p>
                    <table class="table">
                    
                </table>
                    <hr>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
</div>


<!-- end Modal -->
<section class="displayContato boxContato">
    <div class="displayLinha"><a href="#" class="botaoContato">Entrar em
            contato</a>
        <form method="post" class="js-form-action-phone" target="_top" >
            <fieldset> 
                <input type="hidden" name="urlFrom" value="">
                <input type="hidden" name="accountId" value="58397"> <input type="hidden" name="city" value="São Paulo">
                <input type="hidden" name="form" value=""> <input type="hidden" name="leadType" value="PHONE">
                <input type="hidden" name="listingId" value="1039776304"> <input type="hidden" name="contactMode" value=".. Gostaria de receber o contato por E-mail.">
                <input type="hidden" name="device" value="{&quot;type&quot;:&quot;mobile&quot;,&quot;model&quot;:&quot;unknown&quot;,&quot;platform&quot;:&quot;unknown&quot;}"></fieldset>
            <a href="tel:01155108388" class="botaoLigue">Ligue já!</a>
        </form>
    </div>
</section>





<!-- page script -->
<script>
    $(document).ready(function () {

        $('.valorM').mask('000.000.000.000.000,00', { reverse: true });
      
    });


</script>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end Modal -->