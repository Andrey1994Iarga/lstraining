var tooltip = 0;

$(function(){
    $(".regform").submit(function (event){
        var form = $(this);
        $.post($(this).attr('action'),$(this).serialize(),function (data){
            var result = $.parseJSON(data);
            if(result.status=="success"){
                window.location.href = "/auth/";
            }else{
                if(result.status == "confirm") {

                } else {
                    form.find(".error").html(result.message);
                }
            }
        });
        event.preventDefault();
    });
});
