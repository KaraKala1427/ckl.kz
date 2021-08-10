$(document).ready(function(){

    $('#city-label').html(sessionStorage.getItem('city'));
});

$(document).ready(function(){
    //console.log(sessionStorage.getItem('city'));
    if(sessionStorage.getItem('city') !== undefined) {
        $('#city-label').html(sessionStorage.getItem('city'));
    } else {
        $('#city-label').html('Алматы');
    }

});
