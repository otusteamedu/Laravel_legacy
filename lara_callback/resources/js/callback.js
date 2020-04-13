$('.callme-form').submit(function(){
    var $this = $(this);
    $.ajax({
        type: 'POST',
        url:'/callback/send',
        data:{"_token":  "<?php echo csrf_token() ?>", "name" : $("#callme_name").val(), "phone" : $("#callme_phone").val()  },
        beforeSend: function(){
            $this.find('button').attr('disabled', true);
            $this.parent().next().html('<p class="callme-loader text-center"><img src="../images/ajax-loader.gif"></p>');
        },
        success:function(data){
            setTimeout(function(){
                $('.callme-loader').fadeIn(500, function(){
                    $this.parent().next().html('<p class="callme-loader text-center">' + data.msg + '</p>');
                });
            }, 1000);
            //alert(data.msg);
        }
    });
    return false;
});