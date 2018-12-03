<?php 
require_once 'config.php'; 
    include(HEADER_TEMPLATE_TEST);
    $viewID = isset($_GET['vIm'])?$_GET['vIm']:"";
    $sql ="";
   
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
           $ImoveisPagina = '<div class="row">';
           $numReg = mysqli_num_rows ($result );
           while ($row=mysqli_fetch_array($result))
           { 
            if($row['ImovelDestaque']==1){
               $ImoveisDestaque.= '
               <div>
                    <div class="imgBanner" >
                    <p class="h5">'.$row['TipoImovel'].' - ' .$row['ImovelNegociacao'].' - '.$row['Bairro'].'</p>
                        <h1 ><label class="valorM">'.$row['ImovelValor'].'</label></h1>
                            <p><a class="btn btn-lg btn-primary li-modal"  href="'.BASEURL.'view_data.php?vID='.$row['ImovelID'].'" role="button">Saiba mais</a></p>
                    </div>
                    <img class="imgLoad" data-u="image" src="'.BASEURL.'Admin/uploads/'.$row['Fotos'].'" />
           </div>';
             
             }
            
             if($numRow < 9){
                if($viewID == "1" && $row['ImovelNegociacao']!="Venda"){
                    continue; 
                }
                if($viewID =="2" && $row['ImovelNegociacao']!="Locação"){
                    continue;
                }
            $ImoveisPagina .='<div class="col-xl d-flex justify-content-center" align="center" data-percentage="'.$row['ImovelValor'].'">
            <div class="BoxDestaqueTopo boxShadow" >
                <div class="ModeloConteudoGeral">
                      <div class="ImgFoto">
                           <div class="ModeloFoto">
                              <img src="'.BASEURL.'Admin/uploads/'.$row['Fotos'].'" class="FotoImovel" alt="">
                          </div>
                      </div>
                      <div class="ModeloContainerInner">
                         <div class="ModeloConteudoDescricao normalTextBox">
                         <div class="DisponibilidadeImovelDestaques">
                            <p class="h4">'.$row['ImovelNegociacao'].'</p>    
                            </div>
                            <hr>
                            <div class="ModeloRef"><i class="fa fa-television" aria-hidden="true"></i>Cód:'.$row['ImovelID'].'</div>
                            <div class="ModeloTipoImovel"> <i class="fa fa-home" aria-hidden="true"></i> '.$row['TipoImovel'].'</div>
                            <div class="ModeloBairroImovel" title="'.$row['Bairro'].'"><i class="fa fa-map-marker" aria-hidden="true"></i> '.$row['Bairro'].' </div>
                            <div class="ModeloComposicaoImovel">
                            <div><span class="QtdeDepedencias"><i class="fa fa-bed" aria-hidden="true"></i> '.$row['ImovelQuartos'].'</span> dorms. </div> 
                            <div class="SegundaSaidaObservacao"><i class="fa fa-align-justify" aria-hidden="true"></i>
                              '.substr($row['ImovelDescricao'],0,102).'
                            </div>
                          </div>
                      </div>
                      <div class="bottomValores normalTextBox">
                          <div class="TerceiraSaidaPreco">
                              <p class="h5"><label class="valorM">'.$row['ImovelValor'].'</label></p>            </div>
                              <div class="btoDetalheDestaque"></div>
                          </div>  
                      </div>
                      <hr>
                      <p>
                      <a href="'.BASEURL.'view_data.php?vID='.$row['ImovelID'].'" class="btn btn-primary btn-lg li-modal">
                         <span class="glyphicon glyphicon-print"></span> Detalhes 
                        </a>
                      </p> 
                      
                  </div>
              </div>
          </div>';
             }
             if($numRow == 5){
                
             }
             
             
              $numRow++;
            }
            $ImoveisPagina .='</div>';
            if($viewID!=""){
                
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
     .btn-whats {
    position: fixed;
    top: 170px;
    right: -138px;
    z-index: 200;
    transition: 200ms;
    display: block;
     }
        /*css novo*/
        .filtro{
            position: absolute;
            margin-left: -23px;
            margin-top:3px;
        }
        @media only screen and (max-width: 360px) {
            .col-xl {
                padding-right: 0px!important;
                padding-left: 0px!important;
                }
            }
            .imgBanner{
                position:absolute;
                top:150px;
                left:25%;
                width:450px;
                height:62px;
                z-index:0;
                font-size:16px;
                color:white;
                line-height:24px;
                text-align:left;
                padding:5px;
                box-sizing:border-box;
            }
       .boxShadow{
        border: 4px #eef5dc solid;
        background-color: #eef5db;
        margin-top: 9px;
        min-width: 350px;
        max-width: 350px;
       }
        .FotoImovel{
            max-width: 343px;
            max-height: 220px;
            min-width: 343px;
            min-height: 220px;
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
     <!-- <p class="h1 text-center" style="    color: lightcoral;">Destaques</p> -->
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
<hr>
    <div class="container" style="padding-top: 54px;">
    <a href="https://api.whatsapp.com/send?phone=" target="_blank" class="btn-whats" id="btn-whats"><img src="img/whats.png"></a>
    <p class="h3 text-center">Conheça nossos Imóveis</p>
     <div class="buscaAva"> Busque seu Imóvel <i class="fa fa-caret-down"></i></div>
    <div class="row rowBusca" style="display:none; padding-top: 9px; padding-bottom: 9px;
            background-color: aliceblue;
            border-radius: 5px;" id="buscaRow">
      <div class="col-sm">
        <select id="Tipo" name="search[Tipo]" class="form-control " style="display:block;">
          <option value="null">Tipo do Imóvel</option>
          <option value="null">Todos</option>
          <option value="1">Casa</option>
          <option value="2">Apartamento</option>
          <option value="3">Terreno</option>
        </select>
      </div>
      <div class="col-sm">
        <select id="Finalidade" name="search[Finalidade]" class="form-control " style="display: block;">
          <option value="null">Negociação</option>
          <option value="null">Todas</option>
          <option value="Venda">Venda</option>
          <option value="Locação">Locação</option>
        </select>
      </div>
      <div class="col-sm">
        <select id="Bairro" name="search[Bairro]" class="form-control " style="display: block;">
          <option value="null">Bairro</option>
          <?php
                                          $sql = "SELECT DISTINCT BairroID, BairroNome FROM `Bairro` 
                                          inner join  Imoveis on Imoveis.ImovelBairro = Bairro.BairroID
                                          ORDER BY BairroNome ASC";
                                          $result=mysqli_query($db, $sql); //rs.open sql,con
                                          while ($row=mysqli_fetch_array($result))  {
                                            ?>

          <option value=" <?php echo $row['BairroID']; ?>">
            <?php echo $row['BairroNome']; ?>
          </option>
          <?php } ?>
        </select>
      </div>
      <div class="col-sm">
        <input class="form-control " type="text" id="CodImovel" placeholder="Cód. Imóvel" name="search[CodImovel]">
      </div>
      
      <div class="col-sm">
        <button class="btn my-2 my-sm-0 btnBuscar" style="color:black; background-color:whitesmoke;" type="button">
        <i class="fa fa-search" aria-hidden="true"></i>
          Buscar
        </button>
      </div>  
    </div>
    <hr>
    <div class="row">
            <div class="col-sm d-flex justify-content-center" >
                <label id="lblQtdImoveis" ></label> 
            </div>
    </div>
    
      <div class="row">
            <div class="col-sm d-flex justify-content-end" >  
                <div style="max-width:140px">      
                        <select class="form-control" id="ddrOrdenar">
                            <option value="0" >Ordernar</option>
                            <option value="1" >Maior Preço</option>
                            <option value="2" >Menor Preço</option>
                        </select>
                    </div>
            </div>
    </div>
    <hr>
    </div>
    <div>
    <div class="container" >
        <div id="imoveisExpositor">
            <?php echo($ImoveisPagina);?>
        </div>
    </div>
    </div>
      <div id="theModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
          
            </div>
        </div>
    </div>
  <script>
   
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
      $('.buscaAva').on('click',function(){
          $('#buscaRow').show('slow');
      });
        $('#ddrOrdenar').change(function(){
            sortByVal($('#imoveisExpositor'), "div",$("#ddrOrdenar option:selected").val());
        });
       reloadClick();
       $(".btn-whats").hover(function(){
        $("#btn-whats").animate({
                    marginRight: '140px'
                }, 500);
       });
       $(".btn-whats").mouseout(function(){
        $("#btn-whats").animate({
                    marginRight: '-=140px'
                }, 500);
       });
       $('.rowBusca').mouseout(function(event){
           var target = $(event.target);
        if ($('#buscaRow').has($(target)).prevObject.length > 0) {
                // don't react to this
                return;
            }
        $('#buscaRow').hide('slow');
       })
       $('.btnBuscar').click(function(){
             getImoveis();
       });
       
  });
  function getImoveis() {
        var url = window.location.origin + "<?php echo BASEURL; ?>";
        var campos = {
          "Tipo": $('#Tipo option:selected').val(),
          "Finalidade": $('#Finalidade option:selected').val(),
          "Bairro": $('#Bairro option:selected').val(),
          "CodImovel": $('#CodImovel').val()
        };
        $.ajax({
          dataType: 'json',
          url: url + '/Admin/dados.php',
          type: 'post',
          data: { action: 'custom_select', Fields: campos },
          success: function (data) {
            console.log(data);
            var dados = data.data
            var imoveis = "";
            if(dados.length == 0){
                $('#lblQtdImoveis').text("Ainda não temos Imóveis neste perfil, mas não deixe de nos contatar...");
                return;
            }
            for (i = 0; i < dados.length; i++) {
              imoveis += '<div class="col-xl d-flex justify-content-center" align="center" data-percentage="'+dados[i].ImovelValor+'">' +
                '<div class="BoxDestaqueTopo boxShadow" >' +
                    '<div class="DisponibilidadeImovelDestaques">' +
                        '<h4>' + dados[i].ImovelNegociacao + '</h4>' +
                    '</div>' +
                    '<div class="ModeloConteudoGeral">' +
                        '<div class="ImgFoto">' +
                            '<div class="ModeloFoto">' +
                            '<img src="'+url+'Admin/uploads/' + dados[i].Fotos + '" class="FotoImovel" alt="">' +
                        '</div>' +
                    '</div>' +
                    '<div class="ModeloContainerInner">' +
                        '<div class="ModeloConteudoDescricao normalTextBox">' +
                            '<div class="ModeloRef">Cód:' + dados[i].ImovelID + '</div>' +
                            '<div class="ModeloTipoImovel">' + dados[i].TipoImovel + '</div>' +
                            '<div class="ModeloBairroImovel" title="' + dados[i].Bairro + '">' + dados[i].Bairro + ' </div>' +
                            '<div class="ModeloComposicaoImovel">' +
                            '<div><span class="QtdeDepedencias">' + dados[i].ImovelQuartos + '</span> dorms. </div> ' +
                            '<div class="SegundaSaidaObservacao">' + returnString(dados[i].ImovelDescricao) + '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="bottomValores normalTextBox">' +
                        '<div class="TerceiraSaidaPreco">' +
                            '<h5><label class="valorM">' + dados[i].ImovelValor + '</label></h5></div>' +
                            '<div class="btoDetalheDestaque"></div>' +
                        '</div>  ' +
                    '</div>' +
                    '<p>' +
                        '<a href="'+url+'/view_data.php?vID=' + dados[i].ImovelID + '" class="btn btn-primary btn-lg li-modal">' +
                            '<span class="glyphicon glyphicon-print"></span> Detalhes ' +
                        '</a>' +
                    '</p> ' +
                '</div>' +
                '</div>' +
                '</div>';
            }
            $('#imoveisExpositor').children().empty();
            $('#imoveisExpositor').children().append(imoveis);
            $('#lblQtdImoveis').text("Temos "+dados.length+" Imóveis correspondentes a sua pesquisa.");
            var fieldsval = $('.valorM');
            for (var i = 0; i < fieldsval.length; i++) {
              var textVal = $(fieldsval[i]).text();
              $(fieldsval[i]).text(formatValor(textVal));

            }
            reloadClick();
          }
         

        });
      }
 function changeActiveLink(){
    $().removeClass('active');
     $().addClass('active');
 }
  function reloadClick(){
    $('.li-modal').on('click', function(e){
            e.preventDefault();
            $('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
            // setTimeout(testf, 1000);
        });
  }
  function sortByVal(parent, childSelector, typeOrder) {
    var items = "";
      if(typeOrder == 0){
          return;
      }
      if(typeOrder == 2){
        items = parent.children(childSelector).children(childSelector).sort(function(a, b) {
            var vA = parseInt($(a).attr('data-percentage'));
            var vB = parseInt($(b).attr('data-percentage'));
            return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
        });
        parent.children(childSelector).empty();
    parent.children(childSelector).append(items);
    }
    if(typeOrder == 1){
        items = parent.children(childSelector).children(childSelector).sort(function(a, b) {
            var vA = parseInt($(a).attr('data-percentage'));
            var vB = parseInt($(b).attr('data-percentage'));
            return (vA > vB) ? -1 : (vA < vB) ? 1 : 0;
        });
        parent.children(childSelector).empty();
    parent.children(childSelector).append(items);
    }
    reloadClick();
   

}





 
</script>

<?php 
 include(FOOTER_TEMPLATE);
 ?>
