"use strict";

let json_url = base_url + 'admin/users/usertypes_json';



$(document).on('change', '#date_login', function(e) {
    $("#na_datatable").dataTable().fnDestroy();
    load_json();
    e.preventDefault();
});


function load_json() {
    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "type": "GET",
            "url": json_url
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
    });
}


//Adding





$(document).on('submit', '#usertypes-form', function (e) {
    e.preventDefault();
    var this_btn_elem = $($(('.add-usertypes-image')));
    loading_btn(this_btn_elem);

        var formData = new FormData($("#usertypes-form")[0]);
        var form_url = $('#usertypes-form').attr('action');
        var usertype_xhr = $.ajax({
            url: form_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            beforeSend: function() {
                $(".progress-bar").width('0%');
                $(".progress").show();
            }
        })

        usertype_xhr.done(function(data) {
            loading_btn();

            var out = jQuery.parseJSON(data);
            toastSuccess(out.status, out.msg);
            $('.add-usertypes-image').show();
            reload_page();
        });

        usertype_xhr.fail(function() {
            toastSuccess('error', 'Page has expired, try later !');
            loading_btn();

        });
    });
