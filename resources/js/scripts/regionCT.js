   $(document).ready(function(){
$('.myid li a').click( function() {
        var cityc = $(this).attr('value');
        var telc = $(this).attr('tel');
     var georeg= $(this).attr('georegion');
        $.ajax({
          type: 'POST',
          url: "/engine/ajax/response.php",
          data:  {сityc:cityc,telc:telc},
          dataType: "JSON",
          success: function(my_data)
            {
            $(my_data).each(function(index,val){
                         $('.ctcg').html(val['сityc']);
                        $('.ctcg2').html(val['telc']);
                 if(georeg=="Almaty"){$('.ctadnum').hide();}else{$('.ctadnum').show();}
                   $('a[ofct='+$('.ctcg').html()+']').show();
                    $('a[ofct]').not("[ofct*="+$('.ctcg').html()+"]").hide();
                         $('option[ofct='+$('.ctcg').html()+']').show();
                    $('option[ofct]').not("[ofct*="+$('.ctcg').html()+"]").hide();
                $('#contct').val('Контакты '+val['сityc']);
               
                
                if(!$('.suboffices[ofct='+$('.ctcg').html()+']').hasClass('active')){
                $('.headoffices[ofct='+$('.ctcg').html()+']').addClass("active");
                $('.headoffices').not("[ofct*="+$('.ctcg').html()+"]").removeClass("active");
                
                
                 $("#seloffices").val( $( 'option[ofct='+$('.ctcg').html()+']' ).attr('value'));
           
              //$("#seloffices").triger('change');
              $(".field-select").html("<span>"+    $("#seloffices option:selected").text()+"</span>");
                   $('.headoffices').not("[ofct*="+$('.ctcg').html()+"]").removeClass("active");
                
                    $('.suboffices').removeClass("active");
                  $('.headoffices[ofct='+$('.ctcg').html()+']').click();
                 history.replaceState({}, document.title, location.href.substr(0, location.href.length-location.hash.length));
      
                }
                            }); } });

});
       $('.myid li a').each(function(){
           
           if($(this).attr('georegion')==$('.ctcg').html()){$(this).click();}
              if($(this).attr('georegionkk')==$('.ctcg').html()){$(this).click();}
              if($(this).attr('georegionru')==$('.ctcg').html()){$(this).click();}
           
       });
       
   
   });