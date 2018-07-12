<?php
require_once ('../config.php');
include (NEWHEADER_TEMPLATE);
?>
<script type="text/javascript" src="../assets/js/agenda-ajax.js" ></script>
<style>
   .css-class-to-highlight{
    border: 1px solid #dc3545!important;
    background: #dc3545!important;
   
}
.event a{
background: #dc3545!important;
 color: #f5f7fb!important;
   }
</style>
<script>

//var disabledDays = ["2018-7-21","2018-7-24","2018-7-27","2018-7-28"];

$( function() {
	
    $( "#txtdataAgenda" ).datepicker({
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
$("#Agendamento-modal").on('show.bs.modal', function (event) {
	var dados = event.relatedTarget.dataset;
	fillAgendamento(dados);
});
$('.fe-chevron-right').on('click',function(){
	var novaData = new Date($('#dataAgenda').val()+' 00:00:00');
	novaData.setDate(novaData.getDate() + 1);
	manageData(novaData);
});
$('.fe-chevron-left').on('click',function(){
	var novaData = new Date($('#dataAgenda').val()+' 00:00:00');
	novaData.setDate(novaData.getDate() - 1);
	manageData(novaData);
});
});

</script>



	<div class="form-group"
		style="background-color: aliceblue; text-align: center">
		<h2>Agenda</h2>
	</div>


	<div class="form-group" style="text-align: center">
		<div>
			<a href="#"><i class="fe fe-chevron-left" style="margin-right: 10px"></i></a>
			<input type="hidden" id="dataAgenda" />
			<input type="text" id="txtdataAgenda" readonly="true"
				style="border: 0px; width: 195px;"></input> <a href="#"><i
				class="fe fe-chevron-right" style="margin-left: 10px"></i></a>

		</div>
	<div id="divHorarios"></div>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>

