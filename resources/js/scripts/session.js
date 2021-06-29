$(document).ready(function(){

    window.setCityName = function setCityName(city) {

        sessionStorage.setItem('city', city);
    }
    $('#city-label').html(sessionStorage.getItem('city'));
});

