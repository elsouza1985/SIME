
function formatValor(valor){
    var ret = valor.replace(/\s/g, '');
    ret = ret.split('');
    var ret1 ="R$";
    var m = 0;
    switch(ret.length){
        case 8:
        for (var i = 0; i < ret.length; i++) {
            if(i <2){
            ret1 += ret[i];
            }
            if(i == 2){
                ret1 += '.';
            }
            if(i >= 2 && i<5 ){
                ret1 += ret[i];
            }
            if( i == 5){
                ret1 += '.';
            }
            if(i >= 5 ){
                ret1 += ret[i];
            }
        }
        ret1+=",00";
        break;
        
        case 7:
        for (var i = 0; i < ret.length; i++) {
            if(i <1){
            ret1 += ret[i];
            }
            if(i == 1){
                ret1 += '.';
            }
            if(i >= 1 && i<4 ){
                ret1 += ret[i];
            }
            if( i == 4){
                ret1 += '.';
            }
            if(i >= 4 ){
                ret1 += ret[i];
            }
        }
        ret1+=",00"
        break;

        case 6:
        for (var i = 0; i < ret.length; i++) {
            if(i <3){
            ret1 += ret[i];
            }
            if(i == 3){
                ret1 += '.';
            }
            if(i >= 3){
                ret1 += ret[i];
            }
            
        }
        ret1+=",00"
        break;

        case 5:
        for (var i = 0; i < ret.length; i++) {
            if(i <1){
            ret1 += ret[i];
            }
            if(i == 1){
                ret1 += '.';
            }
            if(i >= 1 && i<4 ){
                ret1 += ret[i];
            }
        }
        ret1+=",00";
        break;
        case 4:
        for (var i = 0; i < ret.length; i++) {
            if(i <1){
            ret1 += ret[i];
            }
            if(i == 1){
                ret1 += '.';
            }
            if(i >= 1 && i<4 ){
                ret1 += ret[i];
            }
        }
        ret1+=",00";
        break;
        default:
        for (var i = 0; i < ret.length; i++) {
               ret1 += ret[i];
            }
            ret1+=",00";
        

    }
    
    return ret1;
}