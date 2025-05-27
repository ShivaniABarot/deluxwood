$(document).ready(function () {
    var form = $('#CustomerForm'); 
    $('.kt-form__help').html('');    
    form.submit(function(e) { 
     
        $('.help-block').html('');        
        $('.kt-form__help').html('');           
        $.ajax({
            url     : form.attr('action'),
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            async:false,
            success : function ( json )
            {        
                return true; 
            },
            error: function( json )
            {          
                if(json.status === 422) {
                    e.preventDefault();
                    var errors_ = json.responseJSON;
                    $.each(errors_.errors, function (key, value) {
                        
                        $('.'+key).html(value);                       
                    });
                } 
            }
        });
    });
    
   
});