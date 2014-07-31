
$(document).ready(function(){   
    $('.nav-tabs a').click(function(){
        $.ajax({
                type: 'POST',
                data: {type: $(this).attr('href')},
                url: '/questions/list',
                success: function(data){
                    $('#replace-content').html(data);
                }
       });
    });
});