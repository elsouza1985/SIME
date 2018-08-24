<?php
require_once ('../config.php');
include (NEWHEADER_TEMPLATE);
?>
<script type="text/javascript" src="../assets/js/vendas-ajax.js" ></script>
<style>
   .css-class-to-highlight{
    border: 1px solid #dc3545!important;
    background: #dc3545!important;
   
}
.event a{
background: #dc3545!important;
 color: #f5f7fb!important;
   }
   .col-centered{
    float: none;
    margin: 0 auto;
}
</style>
<script>


$( function() {
	
    $( "#txtdataVendas" ).datepicker({
    	 onSelect: function(dateText) {
        	 $('#dataAgenda').val(this.value);
    		 manageData(this.value);
    	      $(this).change();
    	    },
    	    dateFormat: 'yy-mm-dd',
    	    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    	    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    	    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    	    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    	    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    	    nextText: 'Próximo',
    	    prevText: 'Anterior'
    	    
    	  });
	  
       
  } );
$( document ).ready(function() {
$("#Vendas-modal").on('show.bs.modal', function (event) {
	var dados = event.relatedTarget.dataset;
	//fillAgendamento(dados);
});
$('.fe-chevron-right').on('click',function(){
	var novaData = new Date($('#dataVendas').val()+' 00:00:00');
	novaData.setDate(novaData.getDate() + 1);
	//manageData(novaData);
});
$('.fe-chevron-left').on('click',function(){
	var novaData = new Date($('#dataVendas').val()+' 00:00:00');
	novaData.setDate(novaData.getDate() - 1);
	//manageData(novaData);
});
});

</script>

	<div class="form-group"
		style="background-color: aliceblue; text-align: center">
		<h2>Vendas</h2>
	</div>


	<div class="form-group" style="text-align: center">
		<div>
			<a href="#"><i class="fe fe-chevron-left" style="margin-right: 10px"></i></a>
			<input type="hidden" id="dataVenda" />
			<input type="text" id="txtdataVenda" readonly="true"
				style="border: 0px; width: 195px;"></input> <a href="#"><i
				class="fe fe-chevron-right" style="margin-left: 10px"></i></a>

		</div>
		<div class="col-sm-4 col-centered">
		
                    <div class="card">
                      <div class="card-body text-center">
                        <div class="h5">Valor do dia</div>
                        <div class="display-4 font-weight-bold mb-4">R$652</div>
			<h3>Meta</h3>
                        <h4>Junho: R$1.000,00</h4>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-green" style="width: 84%"></div>
                        </div>
                      </div>
                    </div>
             </div>
             <div class="row ">
             <div class="col-sm-4">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="card-category">MANHÃ</div>
                    <div class="display-3 my-4"><h4>R$100,00</h4></div>
                    <ul class="list-unstyled leading-loose">
                      <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> 3 Serviços</li>
                      <li><i class="fe fe-x text-success mr-2" aria-hidden="true"></i> 2 Produtos</li>
                      </ul>
                    </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-status bg-green"></div>
                  <div class="card-body text-center">
                    <div class="card-category">TARDE</div>
                    <div class="my-4"><h4>R$149,00<h4></h4></div>
                    <ul class="list-unstyled leading-loose">
                      <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> 13 Serviços </li>
                      <li><i class="fe fe-x text-success mr-2" aria-hidden="true"></i> 12 Produtos</li>
                   </ul>
                 </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="card-category">NOITE</div>
                    <div class="my-4"><h4>R$99,00</h4></div>
                    <ul class="list-unstyled leading-loose">
                       <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> 13 Serviços</li>
                      <li><i class="fe fe-x text-danger mr-2" aria-hidden="true"></i> 0 Produtos</li>
                   </ul>
                  </div>
                </div>
              
              </div>
            </div>     
            <div class="card">
	<div id="divVendas" class="table-responsive">
	<table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                      <thead>
                        <tr>
                          <th class="hidden-xs hidden-sm">CLIENTE</th>
                          <th>VALOR</th>
                          <th class="text-center">PAGAMENTO</th>
                          <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="hidden-xs hidden-sm">
                            <div>Elizabeth Martin</div>
                            <div class="small text-muted">
                              Efetuado: 9:00Hrs
                            </div>
                          </td>
                          <td>
                            <div>R$35,00</div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-visa"></i>
                          </td>
                           
                          <td class="text-center">
                           <a href="#" class="icon" >
                            <i class="fe fe-info"></i></a>
                            <a href="#" class="icon" data-toggle="modal" data-target="#delete-modal" data-customerid="1" data-customer="Fulano de Tal">
                            <i class="fe fe-trash"></i></a></td>
                          </td>
                        </tr>
                        <tr>
                          <td class="hidden-xs hidden-sm">
                            <div>Maria Martin</div>
                            <div class="small text-muted">
                              Efetuado: 10:00Hrs
                            </div>
                          </td>
                          <td>
                            <div>R$135,00</div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-money"></i>
                          </td>
                           
                          <td class="text-center">
                           <a href="#" class="icon" >
                            <i class="fe fe-info"></i></a>
                            <a href="#" class="icon" data-toggle="modal" data-target="#delete-modal" data-customerid="1" data-customer="Fulano de Tal">
                            <i class="fe fe-trash"></i></a></td>
                          </td>
                        </tr>
                      </tbody>
                    </table>
	</div>
	</div>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>

