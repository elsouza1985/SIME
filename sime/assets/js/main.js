
$(function() {

	 $('#txtdataAgenda').val(formatar(Date.now()));
});
var video = document.getElementById('video');

//Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
 // Not adding `{ audio: true }` since we only want video now
 navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
     video.src = window.URL.createObjectURL(stream);
     video.play();
 });
}


function addDays(date, days) {
	  var result = new Date(date);
	  result.setDate(result.getDate() + days);
	  return result;
	}
function formatDateSQL(date) {

	if(typeof(date)== 'string'){  
		date += " 00:00:00"; 
	}
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
function formatar(data) {
	
	if(typeof(data)== 'string'){  
	data += " 00:00:00"; 
}
	  var shortDate;
	  
	  data = new Date(data);
	  	
	  var day = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"][data.getDay()];
	  var date = data.getDate();
	  var month = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"][data.getMonth()];
	  var year = data.getFullYear();
	  shortDate = data.getFullYear()+"-"+(data.getMonth()+1)+"-"+data.getDay();
	 // console.log(data);
	  // $('#txtdataAgenda').attr('data-select',shortDate);
	 return day+", "+date+" de "+month+" de "+year;
	}
