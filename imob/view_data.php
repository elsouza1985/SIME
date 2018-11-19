<?php
$viewID = $_GET['vID'];
   include_once('config.php'); 
   $db=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or
  die('Could not connect to the database!');

// $db=mysql_connect("localhost","root","", "PHL");
mysqli_select_db($db, DB_NAME) or
  die('No database selected!');

  $sql ="SELECT Imoveis.ImovelID,ImovelDescricao, TipoImovel,ImovelValor,
  GROUP_CONCAT(Images.Caminho SEPARATOR ';') as 'Fotos',ImovelEndereco,
  ImovelVagas,ImovelNegociacao, ImovelArea,ImovelQuartos, ImovelBanheiros, 
  Bairro.BairroNome as 'Bairro', Corretores.CorretorNome as Corretor,  
  Corretores.CorretorEmail as Email, Corretores.CorretorTelefone as Telefone,
  Corretores.CorretorCRECI as CRECI
  FROM `Imoveis` 
  inner join Bairro on Imoveis.ImovelBairro = Bairro.BairroID 
  inner join TipoImovel on Imoveis.ImovelTipo = TipoImovel.TipoImovelID 
  inner join Images on Imoveis.ImovelID = Images.ImovelID
  inner join Corretores on Imoveis.ImovelCorretor = Corretores.CorretorID
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
      $Corretor = $row['Corretor'];
      $Telefone = $row['Telefone'];
      $Email = $row['Email'];
      $Creci = $row['CRECI'];
    }
  }
$Fotos = explode(';',$Foto);

 $ImoveisDestaque = "";
    for ($i=0; $i < count($Fotos); $i++) { 
         $ImoveisDestaque .= '<div>
                                  <img data-u="image" src="'.BASEURL.'Admin/uploads/'.$Fotos[$i].'" />
                                  <img data-u="thumb" src="'.BASEURL.'Admin/uploads/'.$Fotos[$i].'" />
                               </div>';
                 
    }
   
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top:100px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
        <h1 style="font-size: 22px;">
            <?php echo $Imovel.' '.$Negociacao.', '.$Quartos .' quarto(s), ' ?><label class="valorM" id="lblVal1">
                <?php echo($Valor)?></label><br>
            <small>
                <?php echo $Endereco ?></small>
        </h1>
       
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div >
             <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Maker -->
    <!-- Source: https://www.jssor.com -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
     -->
    <script type="text/javascript" src="<?php echo BASEURL; ?>js/jssor.slider.min.js"></script> 
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_2_SlideshowTransitions = [
              {$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_2_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_2_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $SpacingX: 5,
                $SpacingY: 5
              }
            };

            var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 450;

            function ScaleSlider() {
                var containerElement = jssor_2_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_2_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        });
    </script>
    <style>
        /* jssor slider loading skin spin css */
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        .jssora106 {display:block;position:absolute;cursor:pointer;}
        .jssora106 .c {fill:#fff;opacity:.3;}
        .jssora106 .a {fill:none;stroke:#000;stroke-width:350;stroke-miterlimit:10;}
        .jssora106:hover .c {opacity:.5;}
        .jssora106:hover .a {opacity:.8;}
        .jssora106.jssora106dn .c {opacity:.2;}
        .jssora106.jssora106dn .a {opacity:1;}
        .jssora106.jssora106ds {opacity:.3;pointer-events:none;}

        .jssort101 .p {position: absolute;top:0;left:0;box-sizing:border-box;background:#000;}
        .jssort101 .p .cv {position:relative;top:0;left:0;width:100%;height:100%;border:2px solid #000;box-sizing:border-box;z-index:1;}
        .jssort101 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;visibility:hidden;}
        .jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {border:none;border-color:transparent;}
        .jssort101 .p:hover{padding:2px;}
        .jssort101 .p:hover .cv {background-color:rgba(0,0,0,6);opacity:.35;}
        .jssort101 .p:hover.pdn{padding:0;}
        .jssort101 .p:hover.pdn .cv {border:2px solid #fff;background:none;opacity:.35;}
        .jssort101 .pav .cv {border-color:#fff;opacity:.35;}
        .jssort101 .pav .a, .jssort101 .p:hover .a {visibility:visible;}
        .jssort101 .t {position:absolute;top:0;left:0;width:100%;height:100%;border:none;opacity:.6;}
        .jssort101 .pav .t, .jssort101 .p:hover .t{opacity:1;}
    </style>
    <div id="jssor_2" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:480px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo BASEURL; ?>svg/loading/static-svg/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
            <?php echo $ImoveisDestaque; ?>
            
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;bottom:0px;width:980px;height:100px;background-color:#000;" data-autocenter="1" data-scale-bottom="0.75">
            <div data-u="slides">
                <div data-u="prototype" class="p" style="width:190px;height:84px;">
                    <div data-u="thumbnailtemplate" class="t"></div>
                    <svg viewBox="0 0 16000 16000" class="cv">
                        <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                        <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                        <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                    </svg>
                </div>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora106" style="width:55px;height:55px;top:162px;left:30px;" data-scale="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
                <polyline class="a" points="7930.4,5495.7 5426.1,8000 7930.4,10504.3 "></polyline>
                <line class="a" x1="10573.9" y1="8000" x2="5426.1" y2="8000"></line>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora106" style="width:55px;height:55px;top:162px;right:30px;" data-scale="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
                <polyline class="a" points="8069.6,5495.7 10573.9,8000 8069.6,10504.3 "></polyline>
                <line class="a" x1="5426.1" y1="8000" x2="10573.9" y2="8000"></line>
            </svg>
        </div>
    </div>
    <!-- #endregion Jssor Slider End -->
            </div>
    </div>
    <div class="row">

            <!-- About Me Box -->
            <div >
                <div class="box-header with-border" style="text-align: -webkit-center;">
                    <h3 class="box-title">Detalhes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="text-align: -webkit-center;">
                    <strong><i class="fa fa-usd" aria-hidden="true"></i> Valor do imóvel</strong>
                    <p > 
                        <label class="valorM" id="lblVal2">
                            <?php echo($Valor)?></label>
                    </p>
                    <hr>
                    <strong><i class="fa fa-home" aria-hidden="true"></i> Tipo de imóvel</strong>
                    <p >
                        <?php echo $Imovel; ?>
                    </p>


                    <strong><i class="fa fa-columns" aria-hidden="true"></i> Área</strong>
                    <p >
                        <?php echo $Area .'m²' ; ?>
                    </p>

                    <p >
                        <i class="fa fa-bed"></i>
                        <?php echo $Quartos.' quarto(s)'; ?>
                    </p>

                    <p >
                        <i class="fa fa-bath"></i>
                        <?php echo $Banheiros.' Banheiro(s)'; ?>
                    </p>
                    <hr>
                    <h3 class="profile-username text-center">Descrição</h3>
                    <p >
                        <?php echo $Descricao; ?>
                    </p>
                    <hr>
                    <h3 class="profile-username text-center">Corretor</h3>
                    <p >
                        <?php echo $Corretor; ?>
                    </p>
                    <p >
                        CRECI: <?php echo $Creci; ?>
                    </p>
                    <p >
                        Telefone: <?php echo $Telefone; ?>
                    </p>
                    <p >
                        E-mail: <?php echo $Email; ?>
                    </p>
                    <hr>
                    <div style="float:left">
                        <div class="btn btn-warning botaoTelefone">
                            <a href="tel:<?php echo $Telefone; ?>" ><i class="fa fa-phone"></i> </a>
                        </div>
                        <div class="btn btn-success botaoTelefone">
                            <a class="icon" href="https://api.whatsapp.com/send?phone=55<?php echo $Telefone; ?>" ><i class="fa fa-whatsapp"></i> </a>
                        </div>
                        
                        <div class="btn btn-info botaoTelefone">
                            <a href="mailto:<?php echo $Email; ?>" ><i class="fa fa-envelope-o"></i> </a>
                        </div>
                    </div>
                   
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
<!-- <section class="displayContato boxContato">
    <div class="displayLinha"><a href="#" class="botaoContato">Entrar em
            contato</a>
        <form method="post" class="js-form-action-phone" target="_top" >
            <fieldset> 
                <input type="hidden" name="urlFrom" value="">
                <input type="hidden" name="accountId" value="58397"> <input type="hidden" name="city" value="São Paulo">
                <input type="hidden" name="form" value=""> <input type="hidden" name="leadType" value="PHONE">
                <input type="hidden" name="listingId" value="1039776304"> <input type="hidden" name="contactMode" value=".. Gostaria de receber o contato por E-mail.">
                <input type="hidden" name="device" value="{&quot;type&quot;:&quot;mobile&quot;,&quot;model&quot;:&quot;unknown&quot;,&quot;platform&quot;:&quot;unknown&quot;}">
            </fieldset>
            
        </form>
    </div>
</section> -->

</div>





<script>
    $(document).ready(function () {

        var formatText = $('#lblVal1').text();
        $('#lblVal1').text(formatValor(formatText));
        formatText = $('#lblVal2').text();
        $('#lblVal2').text(formatValor(formatText));
        $('.modal-backdrop').remove();
    });


</script>
</body>

</html>