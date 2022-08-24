
jQuery(document).ready(function () {
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(document).on("click", "#signup", function(event) { 

    var err_res = 0;
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var phone_no = $("#mobile_no").val();

    // if (name == '' || name == null) {
    //     $('#name').css("border-color", "red");
    //     err_res = 1;
    // }
    // else{
    //     $('#name').css("border-color", "#dfdfdf");
    // }
    // if (email == '' || email == null) {
    //     $('#email').css("border-color", "red");
    //     err_res = 1;
    // }else{
    //     var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    //     if(!pattern.test(email)){
    //         $('#email').css("border-color", "red");
    //         err_res = 1;
    //     }else{
    //         $('#email').css("border-color", "#dfdfdf"); 
    //     }
    // }

    // if (password == '' || password == null) {
    //     $('#password').css("border-color", "red");
    //     err_res = 1;
    // }else{
    //     $('#password').css("border-color", "#dfdfdf");
    // }

    // if (phone_no == '' || phone_no == null) {
    //     $('#mobile_no').css("border-color", "red");
    //     err_res = 1;
    // }else{
    //     $('#mobile_no').css("border-color", "#dfdfdf");
    // }

    

    if(err_res == 0){
        jQuery.ajax({
            type: "POST",
            url: APP_URL + "/api/register",
            data: {
                email : email, name : name, password : password, phone_no: phone_no
            },
            success: function (response) {
                if(response == 0)
                {
                
                }
                else{
                
                }
            },
            error: function (response) {
                }
        });
    }
});
