$(document).ready(function(){
    hideButtons();
})

function hideButtons(){
    var xi = $('.btn')

    for (var index = 0; index < xi.length; index++) {
        var textval = xi[index].textContent;
        var textobject = xi[index];
        textval = textval.replace(/\s/g, '');
        if(textval == ''){
            $(textobject).hide();    
        }
        
    }

}