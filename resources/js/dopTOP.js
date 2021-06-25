
$(function(){
    $("#seloffices").change(function(){

        idc=$(this).val();

        $("#"+idc).click();
        console.log("#"+idc);

    });

    $(".citiest__main").click(function(){
        $(".cityger").show();
    });
    $(".cityger>ul>li>a, .cityger_contact>ul>li>a").click(function(event){
        // event.preventDefault();

        let city = $(this).text();
        $(".citiest").text(city);
        $(".usure").text($(this).attr('tel'));
        $(".phone__namemain").text($(this).attr('value'));
        $(".citiest").text($(this).attr('value'));
        $(".cityger").hide();
        $(".headofficesm").hide();
        gr=$(this).attr('georegion');
        $(".sel"+gr).show();




        $.ajax({
            url: '/contacts/change',
            type: 'POST',
            data: {
                city: $(this).attr('georegion'),
                cityl:$(this).html()
            },
            success: function(data) {
                $('.contacts__nav').find('ul.nav__list > li').first().find('a').addClass('active').click();
                $.each($('.menuwraper'), function(k, v) {
                    if($(this).is(':visible'))
                        $(this).find('ul>li').first().find('a').click();
                });
            },
        });
    });



    $(".cityger_contact>ul>li>a").click(function(event){
        event.preventDefault();
        $(".menuwraper").hide();
        let city = $(this).text();
        $(".citiest").text(city);
        id = $(this).attr("id");
        $(".dis"+id).show();
        // debugger
        var a = $(".dis"+id).find('a').attr('id');
        document.getElementById(a).click();
    });
});

$("a.headoffices").click(function(){
    $('.headoffices').removeClass('active');
    $('.suboffices').removeClass('active');
    $('.headoffices.'+this.id).addClass('active');
    $(this).addClass('active');
});

$("a.suboffices").click(function(event){
    //   event.preventDefault();
    console.log("ccc");
    $('.suboffices').removeClass('active');
    $('.headoffices').removeClass('active');
    $('.suboffices.'+this.id).addClass('active');
    $(this).toggleClass("active");
});

$(".headoffm").click(function(){

    cl=$(this).attr('clickdata');
    $("#"+cl).click();


});
$(function(){
    // var url = window.location.pathname,
    //     urlRegExp = new RegExp(url.replace(/\$/,'') + "$");
    // console.log(urlRegExp);
    // $('#nav__list>li>a').each(function(){
    //     if(urlRegExp.test(this.href.replace(/\/$/,'')) && url !== '/'){
    //         $(this).addClass('active');
    //     } else {
    //         $(this).removeClass('active');
    //     }
    // });
    var url = window.location.pathname;
   // console.log(url.split('/')[2]);
    $('#nav__list>li>a').each(function(){
        let k;
        if(url.split('/')[1] == 'kz')  {
            k =  url.split('/')[2];
        }
        else {
            k = url.split('/')[1];
        }
        if(k == 'product' || k == 'annuitet' || k == 'live' || k =='retirementinsurance' ){
            $('#product').addClass('active');
        } else if( k == 'about') {
            $('#aboutt').addClass('active');
        }else if( k == 'press') {
            $('#presst').addClass('active');
        }else if( k == 'contacts') {
            $('#contactst').addClass('active');
        }
    });

    $.each($('.cityger_contact').find('ul > li >a'), function(k, v) {
        if($(this).data('current') == 1)
            $(this).click();
    });
    $.each($('.menuwraper'), function(k, v) {
        if($(this).is(':visible'))
            $(this).find('ul>li').first().find('a').click();
    });

});

$(function(){
    var url = window.location.pathname;
    $('#nav__list>li>a').each(function(){
        let k;
        if(url.split('/')[1] == 'kz')  {
            k =  url.split('/')[3];
        }
        else {
            k = url.split('/')[2];
        }
        if(k == 'history' ){
            $('#history').addClass('active');
        } else if( k == 'team') {
            $('#team').addClass('active');
        }else if( k == 'license') {
            $('#license').addClass('active');
        }else if( k == 'financial_statements') {
            $('#financial_statements').addClass('active');
        }else if( k == 'corporate_events') {
            $('#corporate_events').addClass('active');
        }else if( k == 'akcioneram') {
            $('#akcioneram').addClass('active');
        }else if( k == 'compliance_controller') {
            $('#compliance_controller').addClass('active');
        }else if( k == 'informaciya_dlya_insayderov') {
            $('#informaciya_dlya_insayderov').addClass('active');
        }else if( k == 'tarify') {
            $('#tarify').addClass('active');
        }else if( k == 'tarify') {
            $('#tarify').addClass('active');
        }else if( k == 'agents') {
            $('#agents').addClass('active');
        }else if( k == 'requisites') {
            $('#requisites').addClass('active');
        }else if( k == 'security') {
            $('#security').addClass('active');
        }

    });
});




$(document).ready(function (){
        if(location.pathname == '/about/team' || location.pathname == '/kz/about/team'){
            $('.link.nav__item.active').click();
        }
})

$('.cityger_contact>ul>li>a').on('click',function(){
    // debugger
    var id = $(this).find('a').attr('id');
    // alert($(this).text());
    // alert($('.dis'+id).attr('class'));
});

// $(document).ready(function selectLng(evt, cityName) {
//     // Declare all variables
//     var i, tabcontent, tablinks;
//
//     // Get all elements with class="tabcontent" and hide them
//     tabcontent = document.getElementsByClassName("tabcontent");
//     for (i = 0; i < tabcontent.length; i++) {
//         tabcontent[i].style.display = "none";
//     }
//
//     // Get all elements with class="tablinks" and remove the class "active"
//     tablinks = document.getElementsByClassName("tablinks");
//     for (i = 0; i < tablinks.length; i++) {
//         tablinks[i].className = tablinks[i].className.replace(" active", "");
//     }
//
//     // Show the current tab, and add an "active" class to the button that opened the tab
//     document.getElementById(cityName).style.display = "block";
//     evt.currentTarget.className += " active";
// });

$('#myTabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
});

$(function(){
    var url_admin = window.location.pathname;
    let k,l='4';
    k =  url_admin.split('/')[1];
    if(k == 'admin'){
        l = url_admin.split('/')[2];
    }
    $('.concrete'+l).addClass('menu_active');
});

$(document).ready(function(){
    //console.log(sessionStorage.getItem('city'));
    if(sessionStorage.getItem('city') != undefined) {
        $('#city-label').html(sessionStorage.getItem('city'));
    } else {
        $('#city-label').html('Алматы');
    }
});


