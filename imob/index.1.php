<?php 
require_once 'config.php'; 
    include(HEADER_TEMPLATE_TEST);
   

    ?>
   
        <?php 
           $sql ="SELECT Distinct Imoveis.ImovelID,ImovelDescricao,ImovelDestaque, TipoImovel,ImovelValor,Images.Caminho as 'Fotos',
           ImovelEndereco,ImovelVagas,ImovelNegociacao, ImovelArea,ImovelQuartos, ImovelBanheiros, Bairro.BairroNome as 'Bairro' 
           FROM `Imoveis` 
           inner join Bairro on Imoveis.ImovelBairro = Bairro.BairroID 
           inner join TipoImovel on Imoveis.ImovelTipo = TipoImovel.TipoImovelID 
           join Images on Imoveis.ImovelID = Images.ImovelID 
           GROUP BY Imoveis.ImovelID";
           $result=mysqli_query($db, $sql);
           $numRow = 0;
           $numDestaque = 0;
           $ImoveisDestaque ="";
           $ImoveisPagina = "";
           while ($row=mysqli_fetch_array($result))
           { 
            if($row['ImovelDestaque']==1){
             
             
               $ImoveisDestaque.= '
               <div>
                    <div class="imgBanner" >
                    <p>'.$row['TipoImovel'].', '.$row['ImovelQuartos'].' Dorms. ' .$row['ImovelNegociacao'].' - '.$row['Bairro'].'</p>
                        <h1 ><label class="valorM">'.$row['ImovelValor'].'</label></h1>
                            <p><a class="btn btn-lg btn-primary" rel="modal:open"  href="'.BASEURL.'view_data.php?vID='.$row['ImovelID'].'" role="button">Saiba mais</a></p>
                    </div>
                    <img class="imgLoad" data-u="image" src="'.BASEURL.'Admin/uploads/'.$row['Fotos'].'" />
           </div>';
             
             }
             if($numRow == 0 || $numRow == 3){
                $ImoveisPagina .='<div class="row">';
             }
             if($numRow < 6){
            $ImoveisPagina .='<div class="col-xl d-flex justify-content-center" align="center" data-percentage="'.$row['ImovelValor'].'">
            <div class="BoxDestaqueTopo boxShadow" >
                <div class="DisponibilidadeImovelDestaques">
                  <h4>'.$row['ImovelNegociacao'].'</h4>    
                </div>
                <div class="ModeloConteudoGeral">
                      <div class="ImgFoto">
                           <div class="ModeloFoto">
                              <img src="'.BASEURL.'Admin/uploads/'.$row['Fotos'].'" class="FotoImovel" alt="">
                          </div>
                      </div>
                      <div class="ModeloContainerInner">
                         <div class="ModeloConteudoDescricao normalTextBox">
                            <div class="ModeloRef">Cód:'.$row['ImovelID'].'</div>
                            <div class="ModeloTipoImovel">'.$row['TipoImovel'].'</div>
                            <div class="ModeloBairroImovel" title="'.$row['Bairro'].'">'.$row['Bairro'].' </div>
                            <div class="ModeloComposicaoImovel">
                            <div><span class="QtdeDepedencias">'.$row['ImovelQuartos'].'</span> dorms. </div> 
                            <div class="SegundaSaidaObservacao">
                              '.substr($row['ImovelDescricao'],0,102).'
                            </div>
                          </div>
                      </div>
                     
                      <div class="bottomValores normalTextBox">
                          <div class="TerceiraSaidaPreco">
                              <h5><label class="valorM">'.$row['ImovelValor'].'</label></h5>            </div>
                              <div class="btoDetalheDestaque"></div>
                          </div>  
                      </div>
                      <p>
                      <a href="'.BASEURL.'view_data.1.php?vID='.$row['ImovelID'].'" class="btn btn-primary btn-lg li-modal">
                         <span class="glyphicon glyphicon-print"></span> Detalhes 
                        </a>
                      </p> 
                      
                  </div>
              </div>
          </div>';
             }
             if($numRow == 2 || $numRow == 5){
                $ImoveisPagina .='</div>';
             }
             
             
              $numRow++;
            }
         ?>
       
  
        <script src="<?php echo BASEURL; ?>js/jssor.slider.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: 1,
              $Idle: 2000,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <style>
     
        /*css novo*/
        @media only screen and (max-width: 360px) {
            .col-xl {
                padding-right: 0px!important;
                padding-left: 0px!important;
                }
            }
       .boxShadow{
        border: 4px lightgrey solid;
        margin-top: 9px;
        min-width: 350px;
        max-width: 350px;
       }
        .FotoImovel{
            max-width: 250px;
            max-height: 220px;
        }
        /* jssor slider loading skin [i] css */
        .jssorl-009-[i] img {
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


        .jssorb052 .i {position:absolute;cursor:pointer;}
        .jssorb052 .i .b {fill:#000;fill-opacity:0.3;}
        .jssorb052 .i:hover .b {fill-opacity:.7;}
        .jssorb052 .iav .b {fill-opacity: 1;}
        .jssorb052 .i.idn {opacity:.3;}

        .jssora053 {display:block;position:absolute;cursor:pointer;}
        .jssora053 .a {fill:none;stroke:#fff;stroke-width:640;stroke-miterlimit:10;}
        .jssora053:hover {opacity:.8;}
        .jssora053.jssora053dn {opacity:.5;}
        .jssora053.jssora053ds {opacity:.3;pointer-events:none;}
    </style>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo BASEURL; ?>svg/loading/static-svg/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
            <?php echo $ImoveisDestaque; ?>
            
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb052" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora053" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora053" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>
    <!-- #endregion Jssor Slider End -->
    </div>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container">
      <h3 style="text-align: center;padding: 5px; font-size: x-large;">Imóveis em destaque</h1>
      <div class="menu-container" style="float:right">
        <ul class="menu clearfix">
            <li>
                <a href="#" style="color:#c9302c"><i class="fas fa-filter"></i>filtrar</a>
                
                <ul class="sub-menu clearfix">
                    <li><a href="#" >Maior Preço</a></li>
                    <li><a href="#" >Menor Preço</a></li>
                </ul>
                    <button type="button" id="loadb" value="teste">
teste
</button>
            </li>
 		</ul> 
      
      <hr>
    <div id="imoveisExpositor">
        <?php echo($ImoveisPagina);?>
      </div>
      <div id="theModal" class="modal fade text-center">
    <div class="modal-dialog">
      <div class="modal-content">
      </div>
    </div>
  </div>
  <script>
    $('.li-modal').on('click', function(e){
      e.preventDefault();
      $('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
     // setTimeout(testf, 1000);
    });
    function testf(){
        var tela = $('#theModal').width();
       // alert(tela);
        if(tela < 400){
            $('#jssor_2').css('width','350px');
        }
    }
  </script>
<script>
   $(document).ready(function(){
      var fieldsval = $('.valorM');
      for (var i = 0; i < fieldsval.length; i++) {
            var textVal = $(fieldsval[i]).text();
            $(fieldsval[i]).text(formatValor(textVal));
          
      }
        $('#loadb').click(function(){
            loadR();
        });
  });
function loadR(){

var $wrapper = $('#imoveisExpositor');

$wrapper.find('.comboVal').sort(function (a, b) {
    return +a.dataset.percentage - +b.dataset.percentage;
})
.appendTo( $wrapper );
}


 
</script>

<?php 
 include(FOOTER_TEMPLATE);
 ?>