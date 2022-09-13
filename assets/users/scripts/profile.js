"use strict";

let profile_image_store_url = base_url + 'admin/profile_image_store';
let update_profile_url = base_url + 'admin/update_profile';
let change_password_url = base_url + 'admin/change_password';
let login_history_url = base_url + 'admin/login_history';

var $uploadCrop;


  getloginHistory();



  $(document).on('click', '.change-user-details', function() {
    changeUserdetails($(this));
  });


  function changeUserdetails(this_elem) {
    loading_btn(this_elem);
    var formData = new FormData($("#user-details-form")[0]);

    var userdetails_xhr = $.ajax({
      url: update_profile_url,
      data: formData,
      type: 'POST',
      contentType: false,
      processData: false
    })

    userdetails_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      toastSuccess(out.status, out.msg);
      loading_btn();
      $('input[type=password]').val('');
    });

    userdetails_xhr.fail(function() {
      toastSuccess('error', 'Page has expired, try later !');
      loading_btn();
    });
  }



  $(document).on('click', '.change-password', function() {
    changePassworddetails($(this));
  });

  function changePassworddetails(this_elem) {
    loading_btn(this_elem);
    var formData = new FormData($("#user-password-form")[0]);

    var userpswrd_xhr = $.ajax({
      url: change_password_url,
      data: formData,
      type: 'POST',
      contentType: false,
      processData: false
    })

    userpswrd_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      toastSuccess(out.status, out.msg);
      loading_btn();
      $('input[type=password]').val('');
    });

    userpswrd_xhr.fail(function() {
      toastSuccess('error', 'Page has expired, try later !');
      loading_btn();
    });
  }


  function getloginHistory() {
      console.log('Login History to do');
      return;
    var logxhr = $.post(login_history_url, {
      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    })

    logxhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      appendlogHistory(out.logs, out.length);
    });

    logxhr.fail(function() {
      toastSuccess('error', 'Page has expired, try later !');

    });

  }



  function appendlogHistory(logs, length) {
    for (i = 0; i < length - 1; i++) {
      var elem = document.querySelector('.log_histories');
      var clone = elem.cloneNode(true);
      elem.after(clone);
    }

    var login_browser = document.getElementsByClassName("login_browser");
    var login_os = document.getElementsByClassName("login_os");
    var login_device = document.getElementsByClassName("login_device");
    var login_ip = document.getElementsByClassName("login_ip");
    var login_time = document.getElementsByClassName("login_time");

    for (i = 0; i < length; i++) {
      login_browser[i].innerHTML = logs[i].login_browser;
      login_os[i].innerHTML = logs[i].login_os;
      login_device[i].innerHTML = logs[i].login_device;
      login_ip[i].innerHTML = logs[i].login_ip;
      login_time[i].innerHTML = logs[i].time;

    }

  }



  $('#upload').on('change', function() {
    $('#profile_image').hide();
    $('#upload-demo').croppie('destroy');

    $uploadCrop = $('#upload-demo').croppie({
      enableExif: true,
      boundary: {
        width: 130,
        height: 130
      },
      viewport: {
        width: 128,
        height: 128,
        type: 'circle'
      }
    });

    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function() {
        $('.upload-result').show();
        // console.log('jQuery bind complete');

      });

    }
    reader.readAsDataURL(this.files[0]);

  });



  $('#remove-profile-image').click(function(event) {
    $('#upload-demo').croppie('destroy');
    $('#profile_image').show();
    $('#profile-page')[0].reset();
    $('#upload_status_msg').html('Profile Photo removed');
    $('#upload_status_msg').css('color', '#dc3545');


  });

  $('#upload-profile-image').click(function(event) {
    var this_btn_elem = $($(('#upload-profile-image')));
    loading_btn(this_btn_elem);


    if (typeof $uploadCrop == 'undefined') {
      $('#upload-profile-image').show();
      $('#upload_status_msg').html('Please select an image');
      $('#upload_status_msg').css('color', '#dc3545');
      loading_btn();
      return;
    }
    $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'

    }).then(function(response) {
      var formData = new FormData($("#profile-page")[0]);
      formData.append('photo', response);

      var profilepic_xhr = $.ajax({
        url: profile_image_store_url,
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

      profilepic_xhr.done(function(data) {
        loading_btn();

        var out = jQuery.parseJSON(data);
        toastSuccess(out.status, out.msg);
        $('#profile-page')[0].reset();
        $('#upload-demo').croppie('destroy');
        $('#upload-profile-image').show();
        $('#profile_image').show();
        $('#profile_image').attr('src', response);
      });

      profilepic_xhr.fail(function() {
        toastSuccess('error', 'Page has expired, try later !');
        loading_btn();

      });
    });
  });