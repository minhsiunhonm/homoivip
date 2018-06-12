demhtprf = 0;
function hienthimenu() {
    if(demhtprf==0){
        document.getElementById('menuright').style.display = 'block';
        demhtprf = 1;
    }
}
function anmenu() {
    if(demhtprf==1){
        document.getElementById('menuright').style.display = 'none';
        demhtprf = 0;
    }
}
$(document).ready(function(){
	var demalert = 0;
	var demaajaxlert = 0;
    $('#alertbox').click(function(event){
        event.stopPropagation();
    });
    $('#demboxalert').click(function(event){
        $('#countalert').css('display','none');
        event.stopPropagation();
        if (demalert == 0) {
            document.getElementById('alertbox').style.display='block';
            demalert = 1;
        }else{
            document.getElementById('alertbox').style.display='none';
            demalert =0;
        }
    });
    $(window).click(function() {
        if (demalert == 1) {
            document.getElementById('alertbox').style.display='none';
            demalert = 0;
        }
    });
});