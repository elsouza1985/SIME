

function salvarCliente(){
	var telefone = "55" + $('#txtNumeroCliente').val().replace(/[^\w\s]/gi, '').replace(/ /g,'');
	var Dados = {
					Loja: $('#txtLojaID').val(),
					name : $("#txtNomeCliente").val(),
					DataNascimento : $('#txtAniversario').val(),
					mobile : telefone
					
				}

		$.ajax({
			url : url+'api/getData.php',
			type : 'post',
			data: {action:'save_cliente', table:'customers', Data:Dados},
	        success : function(data){
	        	$('#add-modal').modal('toggle');
	        	
	        }
		});
	
}


