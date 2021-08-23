$(document).ready(function(){

    window.setCityName = function setCityName(city) {

        sessionStorage.setItem('city', city);

    }
    $('#city-label').html(sessionStorage.getItem('city'));
});


document.querySelector('#city-label').addEventListener('click', function (){window.setCityName('Алматы')})



$(document).ready(function(){
    //console.log(sessionStorage.getItem('city'));
    if(sessionStorage.getItem('city') != undefined) {
        $('#city-label').html(sessionStorage.getItem('city'));
    } else {
        $('#city-label').html('Алматы');
    }
});
