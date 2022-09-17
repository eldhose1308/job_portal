"use strict";





let captcha_url = 'change_captcha';
var alert_message = '';
$(document).on('submit', '#login-forms', function (e) {
  e.preventDefault();

  // device_type = getDeviceType();
  // $('#device_type').val(device_type);


  alertMessage('', '');

  $(".login-btn").toggle();
  $(".progress-md").toggle();

  var formData = new FormData($("#login-forms")[0]);
  var post_url = $($(this)).attr('action');
  var usertype_xhr = $.ajax({
    url: post_url,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = parseInt((evt.loaded / evt.total) * 100);
          $(".progress-bar").width(percentComplete + '%');
          $(".progress-bar").html(percentComplete + '%');
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $(".progress").show();
      $(".progress-bar").width('0%');
    }
  })

  usertype_xhr.done(function (data) {
    $(".progress-bar").width('0%');
    $(".progress").hide();

    $(".login-btn").toggle();
    $(".progress-md").toggle();

    var parameterList = new URLSearchParams(window.location.search);
    if (parameterList.has('redirect'))
      window.location.href = parameterList.get('redirect');


    var out = jQuery.parseJSON(data);
    alertMessage(out.status, out.msg);
    $('.login-btn').show();

    if (out.status == 'success')
      reload_page();

    refresh_captcha();

  });

  usertype_xhr.fail(function () {
    $(".progress-bar").width('0%');
    $(".progress").hide();

    alertMessage('error', 'Page has expired, try later !');
    loading_btn();
    refresh_captcha();

  });
});



$(document).on('submit', '#register-forms', function (e) {
  e.preventDefault();


  if (validate_form(true, false, true))
    return false;
  // device_type = getDeviceType();
  // $('#device_type').val(device_type);


  alertMessage('', '');

  $(".login-btn").toggle();
  $(".progress-md").toggle();

  var formData = new FormData($("#register-forms")[0]);
  var post_url = $($(this)).attr('action');
  var usertype_xhr = $.ajax({
    url: post_url,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = parseInt((evt.loaded / evt.total) * 100);
          $(".progress-bar").width(percentComplete + '%');
          $(".progress-bar").html(percentComplete + '%');
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $(".progress").show();
      $(".progress-bar").width('0%');
    }
  })

  usertype_xhr.done(function (data) {
    $(".login-btn").toggle();
    $(".progress-md").toggle();

    refresh_captcha();
    var out = jQuery.parseJSON(data);
    alertMessage(out.status, out.msg);
    $('.login-btn').show();


  });

  usertype_xhr.fail(function () {
    alertMessage('error', 'Page has expired, try later !');
    loading_btn();
    refresh_captcha();

    $(".login-btn").toggle();
    $(".progress-md").toggle();

    $('.login-btn').show();

  });
});

$(document).on("keyup", "#full_name", function (e) {
  e.preventDefault();
  let full_name = $(this).val();
  full_name = full_name.replace(/ /g, "_").toLowerCase();
  $("#user_name").val(full_name)
});


$(document).on("keyup", "#user_password", function (e) {
  e.preventDefault();
  check_passwords();
});

$(document).on("keyup", "#retyped_password", function (e) {
  e.preventDefault();
  check_passwords();
});




function check_passwords() {
  let user_password = $("#user_password").val();
  let retyped_password = $("#retyped_password").val();

  if (user_password != retyped_password) {
    $("#user_password").css("border", "1px solid #c9302c");
    $("#retyped_password").css("border", "1px solid #c9302c");
    return;
  }

  $("#user_password").css("border", "1px solid #449d44");
  $("#retyped_password").css("border", "1px solid #449d44");

}



$(document).on("click", ".change-captcha", function (e) {

  e.preventDefault();
  refresh_captcha();
});


function refresh_captcha() {
  grecaptcha.reset();
}




function reload_page(to_page = '') {
  setTimeout(function () {
    if (to_page == '')
      location.reload(true);
    else
      location.reload(true);

    //      window.location.replace(to_page);
  }, 1000);
}


function loading_btn(this_elem = '') {
  var xhr_loader = document.querySelectorAll('.loader-xhr');
  if (xhr_loader.length > 0) {
    xhr_loader[0].remove();
  } else {
    //this_elem.css('opacity', '0.7');
    this_elem.append('<i class="fas fa-spinner fa-spin loader-xhr"></i>');
  }
  return;
}

function alertMessage(status, message) {

  let alert_status = (status == 'error') ? 'alert-danger' : 'alert-' + status;
  let bg_status = (status == 'error') ? 'bg-danger' : 'bg-' + status;

  alert_message = `
<div class="alert ${alert_status} alert-dismissible fade show" role="alert">
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;

  $('#alert-message-div').html(alert_message);
  $('#alert-message-div').show(1200);



  reload_progressbar();
  $('body,html').animate({
    scrollTop: 0
  }, 500);

}


function reload_progressbar() {


  setTimeout(function () {
    $(".progress-bar").width('0%');
    $(".progress-bar").html('0%');
    //location.reload(true);
  }, 1000);
}