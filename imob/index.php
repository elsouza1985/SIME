<?php 
require_once 'config.php'; 
    include(HEADER_TEMPLATE);
   

    ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
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
              echo(' <li data-target="#myCarousel" data-slide-to="'.$numRow.'" ></li>');
             if($numDestaque == 0){
              $ImoveisDestaque.= '<div class="carousel-item active">
              <img class="first-slide" src="Admin/uploads/'.$row['Fotos'].'" alt="First slide">
                <div class="container">
                  <div class="carousel-caption d-none d-md-block text-center fundo">
                    
                    <p>'.$row['TipoImovel'].', '.$row['ImovelQuartos'].' Dorms. ' .$row['ImovelNegociacao'].' - '.$row['Bairro'].'</p>
                    <h1 >R$ <label class="valorM">'.$row['ImovelValor'].'</label></h1>
                    <p><a class="btn btn-lg btn-primary" href="../imob/view_data.php?vID='.$row['ImovelID'].'" role="button">Saiba mais</a></p>
                  </div>
                </div>
              </div>';
             } else{
               $ImoveisDestaque.= '<div class="carousel-item ">
               <img class="first-slide" src="Admin/uploads/'.$row['Fotos'].'" alt="First slide">
                 <div class="container">
                   <div class="carousel-caption d-none d-md-block text-center fundo">
                   <p>'.$row['TipoImovel'].', '.$row['ImovelQuartos'].' Dorms. ' .$row['ImovelNegociacao'].' - '.$row['Bairro'].'</p>
                   <h1 >R$ <label class="valorM">'.$row['ImovelValor'].'</label></h1>
                     <p><a class="btn btn-lg btn-primary" href="'.BASEURL.'view_data.php?vID='.$row['ImovelID'].'" role="button">Saiba mais</a></p>
                   </div>
                 </div>
               </div>';
             }
             $numDestaque++;
             }
             if($numRow < 6){
            $ImoveisPagina .='<div class="col-lg-4">
            <div class="BoxDestaqueTopo boxShadow" onclick="self.location.href="../imob/view_data.php?vID='.$row['ImovelID'].'">
                <div class="DisponibilidadeImovelDestaques">
                  <span>'.$row['ImovelNegociacao'].'</span>    
                </div>
                <div class="ModeloConteudoGeral">
                      <div class="ImgFoto">
                           <div class="ModeloFoto">
                              <img src="Admin/uploads/'.$row['Fotos'].'" class="FotoImovel" alt="">
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
                              '.$row['ImovelDescricao'].'
                            </div>
                          </div>
                      </div>
                      <div class="bottomValores normalTextBox">
                          <div class="TerceiraSaidaPreco">
                              <span>R$ <label class="valorM">'.$row['ImovelValor'].'</label></span>            </div>
                              <div class="btoDetalheDestaque"></div>
                          </div>  
                      </div>
                      <p>
                      <a href="../imob/view_data.php?vID='.$row['ImovelID'].'" onclick="removeBackground();" rel="modal:open" class="btn btn-primary btn-lg">
                         <span class="glyphicon glyphicon-print"></span> Detalhes 
                        </a>
                      </p> 
                      
                  </div>
              </div>
          </div>';
             }
             
              $numRow++;
            }
         ?>
       
  
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


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
      <h1 style="text-align: center;padding: 5px; font-size: x-large;">Imóveis em destaque</h3>
      <hr>
    <div class="row" id="imoveisExpositor">
        <?php echo($ImoveisPagina);?>
      </div>

<script>
   $(document).ready(function(){
      $('.valorM').mask('000.000.000.000.000,00', {reverse: true});  
      /*$(window).scroll(function(){
        var lastID = $('.load-more').attr('lastID');
        if(($(window).scrollTop() == $(document).height() - $(window).height()) && (lastID != 0)){
            $.ajax({
                type:'POST',
                url:'Admin/getData.php',
                data:'id='+lastID,
                beforeSend:function(){
                    $('.load-more').show();
                },
                success:function(html){
                    $('.load-more').remove();
                    $('#postList').append(html);
                }
            });
        }
    });*/
  });
  function removeBackground(){
    $('.modal-backdrop').remove();
  }
                
  
</script>

<?php 
 include(FOOTER_TEMPLATE);
 ?>
