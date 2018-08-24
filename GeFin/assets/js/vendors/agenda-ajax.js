
$( document ).ready(function() {

var dataagora = formatDateSQL(new Date());
var is_ajax_fire = 0;
$('#dataAgenda').val(dataagora);
manageData(dataagora);
});

/* manage data list */
function manageData(dataatual) {
	$('#txtdataAgenda').val(formatar(dataatual));
	var filtro = "WHERE Data='"+dataatual+"' AND User='"+$('#txtUserID').val()+"'";
	    $.ajax({
	        dataType: 'json',
	        url: url+'api/getData.php',
	        type : 'post',
	        data: {action:'return_Agenda', table:'Agenda', filter:filtro},
	        success : function(data){
	        	if(data.data!= null){
		    	manageAgenda(data.data);
		    	is_ajax_fire = 1;
	        	}
	        	else{
	        		manageAgenda("");
	        	}
	        }
	    });
	      
}

function fillAgendamento(dados){
	$('#modal-AgendaData').val($('#txtdataAgenda').val());
	$('#tblModalAgenda').empty();
	var htmlContent = "";
		if(dados.agendado == "false"){
		var lojaid = $('#txtLojaID').val();
		var filtro = "WHERE Loja='"+ lojaid +"'";
		$.ajax({
			url : url+'api/getData.php',
			type : 'post',
			data: {action:'return_Agenda', table:'customers', filter:filtro},
	        success : function(data){
				var jsonVal = JSON.parse(data);
				var val = jsonVal.data;
				htmlContent =	'<thead>'+
				'<tr>'+
					'<th colspan="2">'+
					'<label id="modal-AgendaData">';
				htmlContent += $('#txtdataAgenda').val();
				htmlContent +='</label> '+
					'<br> Horario: <label id="modal-AgendaHorario">'+dados.horario+'</label>'+':00 hrs'+
					'</th>'+
				'</tr>'+
			'</thead>'+
			'<tbody>'+
				'<tr>'+
					'<td>'+
					'<input type="text" class="form-control" id="txtNewUser" placeholder="Nome" style="display:none">'+
					'<select id="ddrCliente" class="selectize-control form-control custom-select single">';
			var htmlcontent1 = '<option value="0">Selecione...</option>';
			for (var i = 0; i < val.length; i++) {
				
				htmlcontent1 += '<option value="'+val[i].id+'">'+val[i].name+' </option>';
			}
			htmlContent += htmlcontent1;
			htmlContent+='</select>'+ 	
				'</td>'+
					'<td class="w-1"><span class="avatar"><i class="fe fe-user-plus"></i></span></td>'+
				'</tr>';
			var htmlcontent2 = '<tr id="txtNewUserContact" style="display:none">'+
								'<td>'+
								'<input type="text" id="txtUserNumber" placeholder="Contato" class="form-control" maxlength="14">'+
								'</td>'+
								'</tr>';
				for (var c = 0; c < val.length; c++) {
					htmlcontent2+= '<tr id="row'+val[c].id+'" style="display:none">'+
										'<td colspan=2>Contato'+
										'<a class="icon" href="https://api.whatsapp.com/send?phone='+val[c].mobile+'&amp">'+
												'<i class="fa fa-whatsapp" style="font-size: x-large; padding: 10px;"></i>'+
										'</a> <a href="tel:'+val[c].mobile+'"> <i class="fa fa-phone" style="font-size: x-large; padding: 10px;"></i>'+
										'</a> <a href="sms:'+val[c].mobile+'&quot;"> <i class="fa fa-wpforms" style="font-size: x-large; padding: 10px;"></i>'+
										'</a>'+
										'</td>'+
									'</tr>';
				}
				
				
				htmlContent += htmlcontent2;
				htmlContent+='</tbody>';
				$('#tblModalAgenda').append(htmlContent);
				$('#confirm').text('Marcar');
				$( "#confirm" ).unbind();
				$('#confirm').on('click',function(){
					salvarAgenda();
				});
				$('#ddrCliente').on('change',function(){
					var rowid = '#row'+$(this).val();
					var numofvisible = $('#tblModalAgenda tr:visible').length;
					if(numofvisible > 2){
						$('#tblModalAgenda tr:visible:last').hide();
					}
					$(rowid).show();
				});
				$('#txtUserNumber').mask('(00) 00000-0000');
				$('.fe-user-plus').click(function(){
					$('#isNewUser').val("true");
					$('#ddrCliente').hide();
					$('#txtNewUserContact').show();
					$('#txtNewUser').show();
				})
			}
		
			
		
		});
		} else{
			var filtro = "WHERE id='"+ dados.cliente +"'";
			$.ajax({
				url : url+'api/getData.php',
				type : 'post',
				data: {action:'return_Agenda', table:'customers', filter:filtro},
		        success : function(data){
					var jsonVal = JSON.parse(data);
					var val = jsonVal.data;
					htmlContent = '<thead>'+
					'<tr>'+
					'<th colspan="2">'+
					'<label id="modal-AgendaData"></label> '+
					'<br> Horario: '+dados.horario+':00 hrs'+
					'<label id="modal-AgendaHorario"></label>'+
					'</th>'+
				'</tr>'+
			'</thead>'+
			'<tbody>'+
				'<tr>'+
					'<td>'+
					'<label> '+val[0].name+'</label>'+
			
				'</td>'+
					'<td class="w-1"></td>'+
				'</tr>'+
				'<tr>'+
					'<td>Contato</td>'+
					'<td><a class="icon" href="https://api.whatsapp.com/send?phone='+val[0].mobile+'&amp;">'+
							'<i class="fa fa-whatsapp" style="font-size: x-large; padding: 10px;"></i>'+
					'</a> <a href="'+val[0].mobile+'"> <i class="fa fa-phone" style="font-size: x-large; padding: 10px;"></i>'+
					'</a> <a href="sms:'+val[0].mobile+'"> <i class="fa fa-wpforms" style="font-size: x-large; padding: 10px;"></i>'+
					'</a></td>'+
				'</tr>'+
			'</tbody>';	
					$('#tblModalAgenda').append(htmlContent);
					$( "#confirm" ).unbind();
					$('#confirm').text('Desmarcar');
					$('#confirm').on('click',function(){
						deletarAgenda(dados.agendaid);
					});
		        }
				
			});
		}

}
function deletarAgenda(itemID){
	$.ajax({
		url : url+'api/getData.php',
		type : 'post',
		data: {action:'delete_agendamento', table:'Agenda', ItemID:itemID},
        success : function(data){
        	$('#Agendamento-modal').modal('toggle');
        	manageData($('#dataAgenda').val());
        }
	});
}
function salvarAgenda(){
	var Dados = {
					Loja: $('#txtLojaID').val(),
					Cliente : $("#ddrCliente :selected").val(),
					Data : $('#dataAgenda').val(),
					Hora : $('#modal-AgendaHorario').text(),
					User : $('#txtUserID').val()
				}
	var novoUsuario = $('#isNewUser').val();
	if(novoUsuario == "true"){
		$('#Agendamento-modal').modal('toggle');
	}else{
		$.ajax({
			url : url+'api/getData.php',
			type : 'post',
			data: {action:'save_agendamento', table:'Agenda', Data:Dados},
	        success : function(data){
	        	$('#Agendamento-modal').modal('toggle');
	        	manageData($('#dataAgenda').val());
	        }
		});
	}
}

/* Add horarios to agenda view */
function manageAgenda(data){
	$("#divHorarios").empty();
var htmlContent = "";
var dataAgenda = $('#dataAgenda').val();
// Horario de funcionamento 8:00 - 21:00
for (var intx = 8; intx <= 21; intx++) {
	
	var dadosFiltrados = "";
	if(data.filter)
		dadosFiltrados = data.filter(x => x.Hora == intx);
	if(intx < 12){
		if(htmlContent.indexOf('Manhã') == -1){
		htmlContent += '<div class="form-group">'+
							'<hr>'+
							'<label class="form-label">Manhã</label>'+
						'</div>';
		}
	    	if(dadosFiltrados.length > 0){
 			htmlContent += '<div class="selectgroup selectgroup-pills">'+
								'<label class="selectgroup-item"> <input type="button" name="value"'+
									'class="selectgroup-input" data-toggle="modal" data-target="#Agendamento-modal" data-Agenda="'+dataAgenda+'"'+
									'data-Horario="'+intx+'" data-Agendado="true" data-Cliente="'+dadosFiltrados[0].Cliente+'" data-AgendaID="'+dadosFiltrados[0].ID+' " /> <span class="selectgroup-button"'+
									'style="background-color: orangered; color: white; font-weight: bold;">'+intx+':00</span>'+
								'</label>'+
							'</div>';
		}else{	
			htmlContent +='<div class="selectgroup selectgroup-pills">';
			htmlContent +='<label class="selectgroup-item"> <input type="button" name="value"';
			htmlContent +='class="selectgroup-input" data-toggle="modal" data-target="#Agendamento-modal" data-Agenda="'+dataAgenda+'"';
			htmlContent +='data-Horario="'+intx+'" data-Agendado="false" /> <span class="selectgroup-button"';
			htmlContent +='style="background-color: palegreen; color: white; font-weight: bold;">'+intx+':00</span>';
			htmlContent +='</label>';
			htmlContent +='</div>';
		
		}
	}
	if(intx >11 && intx <18){
		if(htmlContent.indexOf('Tarde') == -1){
		htmlContent += '<div class="form-group">'+
							'<hr>'+
							'<label class="form-label">Tarde</label>'+
						'</div>';
		}
	    	if(dadosFiltrados.length > 0){
 			htmlContent +='<div class="selectgroup selectgroup-pills">'+
								'<label class="selectgroup-item"> <input type="button" name="value"'+
								'class="selectgroup-input" data-toggle="modal" data-target="#Agendamento-modal" data-Agenda="'+dataAgenda+'"'+
									'data-Horario="'+intx+'" data-Agendado="true" data-Cliente="'+dadosFiltrados[0].Cliente+'" data-AgendaID="'+dadosFiltrados[0].ID+'" /> <span class="selectgroup-button"'+
									'style="background-color: orangered; color: white; font-weight: bold;">'+intx+':00</span>'+
								'</label>'+
							'</div>';
		}else{	
			htmlContent +='<div class="selectgroup selectgroup-pills">';
			htmlContent +='<label class="selectgroup-item"> <input type="button" name="value"';
			htmlContent +='class="selectgroup-input" data-toggle="modal" data-target="#Agendamento-modal" data-Agenda="'+dataAgenda+'"';
			htmlContent +='data-Horario="'+intx+'" data-Agendado="false" data-Agenda="" /> <span class="selectgroup-button"';
			htmlContent +='style="background-color: palegreen; color: white; font-weight: bold;">'+intx+':00</span>';
			htmlContent +='</label>';
			htmlContent +='</div>';
			
		}
	}
		if(intx > 17){
			if(htmlContent.indexOf('Noite') == -1){
			htmlContent += '<div class="form-group">'+
								'<hr>'+
								'<label class="form-label">Noite</label>'+
							'</div>';
			}
		    	if(dadosFiltrados.length > 0){
	 			htmlContent +='<div class="selectgroup selectgroup-pills">';
	 			htmlContent +='<label class="selectgroup-item"> <input type="button" name="value"';
	 			htmlContent +='class="selectgroup-input" data-toggle="modal" data-target="#Agendamento-modal" data-Agenda="'+dataAgenda+'"';
	 			htmlContent +='data-Horario="'+intx+'" data-Agendado="true" data-Cliente="'+dadosFiltrados[0].Cliente+'"  data-AgendaID="'+dadosFiltrados[0].ID+'"  /> <span class="selectgroup-button"';
	 			htmlContent +='style="background-color: orangered; color: white; font-weight: bold;">'+intx+':00</span>';
	 			htmlContent +='</label>';
	 			htmlContent +='</div>';
			}else{	
			
				htmlContent += '<div class="selectgroup selectgroup-pills">';
				htmlContent +='<label class="selectgroup-item"> <input type="button" name="value"';
				htmlContent +='class="selectgroup-input" data-toggle="modal" data-target="#Agendamento-modal" data-Agenda="'+dataAgenda+'"';
				htmlContent +='data-Horario="'+intx+'" data-Agendado="false"  /> <span class="selectgroup-button"';
				htmlContent +='style="background-color: palegreen; color: white; font-weight: bold;">'+intx+':00</span>';
				htmlContent +='</label>';
				htmlContent +='</div>';
			
			}
		}
	

}		
	$("#divHorarios").append(htmlContent);
}


/* Add new Item table row */
function manageRow(data) {
	var	rows = '';
	$.each( data, function( key, value ) {
	  	rows = rows + '<tr>';
	  	rows = rows + '<td>'+value.Cliente+'</td>';
	  	rows = rows + '<td>'+value.Data+'</td>';
	  	rows = rows + '<td data-id="'+value.ID+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
	  	rows = rows + '</tr>';
	});


	$("tbody").html(rows);
}


/* Create new Item */
$(".crud-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-item").find("form").attr("action");
    var title = $("#create-item").find("input[name='title']").val();

 
    var description = $("#create-item").find("textarea[name='description']").val();


    if(title != '' && description != ''){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + form_action,
            data:{title:title, description:description}
        }).done(function(data){
            $("#create-item").find("input[name='title']").val('');
            $("#create-item").find("textarea[name='description']").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
        });
    }else{
        alert('You are missing title or description.')
    }


});


/* Remove Item */
$("body").on("click",".remove-item",function(){
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");


    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url + 'api/delete.php',
        data:{id:id}
    }).done(function(data){
        c_obj.remove();
        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        getPageData();
    });


});


/* Edit Item */
$("body").on("click",".edit-item",function(){


    var id = $(this).parent("td").data('id');
    var title = $(this).parent("td").prev("td").prev("td").text();
    var description = $(this).parent("td").prev("td").text();


    $("#edit-item").find("input[name='title']").val(title);
    $("#edit-item").find("textarea[name='description']").val(description);
    $("#edit-item").find(".edit-id").val(id);


});


/* Updated new Item */
$(".crud-submit-edit").click(function(e){


    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    var title = $("#edit-item").find("input[name='title']").val();

 


    var description = $("#edit-item").find("textarea[name='description']").val();
    var id = $("#edit-item").find(".edit-id").val();


    if(title != '' && description != ''){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + form_action,
            data:{title:title, description:description,id:id}
        }).done(function(data){
            getPageData();
            $(".modal").modal('hide');
            toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
        });
    }else{
        alert('You are missing title or description.')
    }


});
