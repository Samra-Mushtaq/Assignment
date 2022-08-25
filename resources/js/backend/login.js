jQuery(document).ready(function () {
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(document).on("click", "#signin", function(event) { 
    var f = 0;
    var email = $("#email").val();
    var password = $("#password").val();
    jQuery.ajax({
        type: "POST",
        url: APP_URL + "/api/login",
        data: {email : email
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
    alert(name);
});
function submit_form2() {
    alert();
}
function submit_form() {
    alert();
    var f = 0;
    var name = $("#name").val();
    var password = $("#password").val();

    jQuery.ajax({
        type: "POST",
        url: APP_URL + "/api.login",
        data: {email : email
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
