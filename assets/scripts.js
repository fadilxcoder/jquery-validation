$(document).ready(function(){
    $("#newsletter-subscription").validate({
        rules:{
            emailAddr: {
                required : true,
                email : true,
                remote : {
                    url : 'functions.php',
                    type : 'POST',
                    data : {
                            email: function(){ return $("#emailAddr").val(); },
                            exec: 'validation'
			}
                }
            }
        },
        messages:{
            emailAddr: {
                required : "Please provide an email address",
                email : "Please enter a valid email address",
                remote: 'Email already used.'
            }
        },
        submitHandler: function(form){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: 'functions.php',
                data: { email: $("#emailAddr").val(), exec: 'insertion' },
                cache: false,
                success: function (data){
                    console.log(data);
                    $("#emailAddr").val('');
                    $("#emailAddr").css('display','none');
                    $("#sign-up-btn").css('display','none');
                    $('#newsletter-subscription').append('<div class="alert-success"><strong>Thank you for subscribing.</strong></div>');
                },
                error: function (e){
                  console.log(e);
                  $("#emailAddr").val('');
                  $("#emailAddr").css('display','none');
                  $("#sign-up-btn").css('display','none');
                  $('#newsletter-subscription').append('<div class="alert-danger"><strong>'+e.statusText+'</strong></div>');
                },
                fail: function (){ 
                  $('#newsletter').append('<div class="alert-danger"><strong>Request Fail</strong></div>');
                }
            }); 
        }
    });
});
