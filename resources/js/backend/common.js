jQuery(document).ready(function () {
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});
import axios from 'axios'

$('body').on('click', '[data-act=ajax-modal]', function () {
    const _self = $(this);
    const inner_content = $("#ajax_model_inner_content");
    const spinner = $("#ajax_model_spinner");
    
    inner_content.hide();
    spinner.show();

    $("#ajax_general_model").modal({backdrop: 'static'});
    $("#ajax_model_title").html(_self.attr('data-title'));
    var metaData = {};
    $(this).each(function () {
        $.each(this.attributes, function () {
            if (this.specified && this.name.match("^data-post-")) {
                var dataName = this.name.replace("data-post-", "");
                metaData[dataName] = this.value;
            }
        });
    });
    axios({
        method: _self.attr('data-method'),
        url: _self.attr('data-action-url'),
        data: metaData
    })
    .then(response => {
        if (response.status === 200) {
            inner_content.html(response.data).show();
        }
        $("#ajax_general_model").modal("show");
        
    }).catch(error => {
    });
});

$('body').on('submit', '[data-form=ajax-form]', function(e) {
    sendForm(form);
});


function sendForm(form) {
    const _self = $(form);
    const btn = _self.find('[data-button=submit]');
    btn.attr('disabled', 'disabled');
    axios({
        url: _self.attr('action'),
        method: _self.attr('method'),
        data: new FormData(_self[0]),
    })
    .then(response => {
        if (response.status == 200) {
            location.reload();
        }
    })
    .catch(error => {
    })
    .finally(response => {
        btn.removeAttr('disabled');
    });
}


       
       
