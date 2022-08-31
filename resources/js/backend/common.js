jQuery(document).ready(function () {
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});
import axios from 'axios';
import swal from 'sweetalert';

//Delete Section
$(document).on('click', '.delete', function () {
    let url = $(this).data('url');
    let tableId = '#' + $(this).data('table');
    deleteConfirmation(url, tableId);
});

function deleteConfirmation(url, tableId) {
    swal({
        title: 'Are you sure?',
        text: "You want to delete this record",
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: ["Cancel", "Yes, delete it!"]
    }).then((willDelete) => {
        if (willDelete) {
            swal({
                title: "",
                text: "Please wait...",
                buttons: false,
                backdrop: true
            });

            axios.delete(url).then(response => {
                if (response.status === 200) {
                    swal.close();
                    $(tableId).DataTable().ajax.reload();
                    toastMessage(response.data.message, "success");
                }
            }).catch(error => {
                swal.close();
                toastMessage("", "error");
                
            });
        }
    });
}

//Add Update Section
$('body').on('click', '[data-act=ajax-modal]', function () {
    const _self = $(this);
    
    const inner_content = $("#ajax_model_inner_content");
    inner_content.hide();

    $("#ajax_general_model").modal({backdrop: 'static'});
    $("#ajax_model_title").html(_self.attr('data-title'));
    
    axios({
        method: _self.attr('data-method'),
        url: _self.attr('data-action-url')
    })
    .then(response => {
        if (response.status === 200) {
            inner_content.html(response.data).show();
        }
        $("#ajax_general_model").modal("show");
        
    }).catch(error => {
        toastMessage("", "error");
    });
});



$('body').on('submit', '[data-form=ajax-form]', function(e) {
    e.preventDefault();
    const form = this;
    swal({
        title: 'Are you sure?',
        text: "You want to submit this form",
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: ["Cancel", "Yes, Submit it!"]
    }).then((value) => {
        if (value) sendAjaxForm(form);
    });
});

function sendAjaxForm(form) {
    const _self = $(form);
    const btn = _self.find('[data-button=submit]');
    btn.attr('disabled', 'disabled');
    const modal = _self.data('modal');
    const datatable = _self.data('datatable');

    axios({
        url: _self.attr('action'),
        method: _self.attr('method'),
        data: new FormData(_self[0]),
    })
    .then(response => {
        console.log(response);
        if (response.status == 200) {
            if (modal !== '') $(modal).modal('hide');
            if (datatable !== '') $(datatable).DataTable().ajax.reload();
            toastMessage(response.data.message, "success");
        }else{
            toastMessage("", "error");
        }
    })
    .catch(error => {
        if(datatable == "#categories-table"){
            $('#en_name_error').text(error.response.data.errors.en_name);
            $('#ar_name_error').text(error.response.data.errors.ar_name);
            $('#en_detail_error').text(error.response.data.errors.en_detail);
            $('#ar_detail_error').text(error.response.data.errors.ar_detail);
        }else if(datatable == "#products-table"){
            $('#en_name_error').text(error.response.data.errors.en_name);
            $('#ar_name_error').text(error.response.data.errors.ar_name);
            $('#category_error').text(error.response.data.errors.category);
            $('#en_description_error').text(error.response.data.errors.en_description);
            $('#ar_description_error').text(error.response.data.errors.ar_description);
            $('#price_error').text(error.response.data.errors.price);
            $('#status_error').text(error.response.data.errors.status);
        }else{
            $('#title_en_error').text(error.response.data.errors.title_en);
            $('#title_ar_error').text(error.response.data.errors.title_ar);
            $('#description_en_error').text(error.response.data.errors.description_en);
            $('#description_ar_error').text(error.response.data.errors.description_ar);
        }
        toastMessage("", "error");
    })
    .finally(response => {
        btn.removeAttr('disabled');
    });
}

function toastMessage(message, status) {
    toastr.options.positionClass = "toast-top-center";
   if(status == "success"){
    toastr.success(message);
   }else{
    toastr.error("SomeThing Went Wrong");
   }
}

$(document).on('change', '.input', function () {
  var id=$(this).attr('id');
  $("#"+id+"_error").text("");
});
   
$(document).on('click', '.close_model', function () {
    $("#ajax_general_model").modal('hide');
});
   
       
