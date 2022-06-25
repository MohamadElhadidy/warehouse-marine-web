<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/gif" sizes="16x16">
    <title>منظومة الصرف من المخازن</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet"></head>
<body>

    <div id="main" class="main-container">
  <div class="box">
    <h2><img src="{{ asset('images/logo.png') }}" width="150px"></h2>
    <h2>Marine Company</h2>
    <form id="myform">
      <div class="input-box">
        <input id="user-name" type="text" name="" required="">
        <label>Username</label>
      </div>
      <div class="input-box">
        <input id="user-pass" type="password" name="" required="">
        <label>Password</label>
      </div>
      <input id="btn-save" type="submit" name="" value="Login">
    </form>
  </div>
</div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="//cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://kit.fontawesome.com/715e93c83e.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mgalante/jquery.redirect@master/jquery.redirect.js"></script>
<script>
        $("#btn-save").click(function(e) {
            $("#myform").validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                },
                highlight: function(input) {
                    $(input).addClass('error_input');
                },
                unhighlight: function(input) {
                    $(input).removeClass('error_input');
                },
                errorPlacement: function(error, element) {
                    $(element).append(error);
                },
                submitHandler: function() {
                    e.preventDefault();
                    var formData = {
                        username: $("#username").val(),
                        password: $("#password-input").val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: '/login',
                        data: formData,
                        dataType: "json",
                        encode: true,
                        error: function(xhr, status, error) {
                            var msg = (xhr.responseText);
                            if (xhr.status != 422) {
                                msg = 'اعد المحاولة مرة أخرى';
                            }
                            $.alert({
                                title: '',
                                type: 'red',
                                content: msg,
                                icon: 'fa fa-warning',
                                confirm: function() {
                                    alert('Confirmed!');
                                },
                            })
                        },
                        success: function(data) {
                            $.confirm({
                                title: formData.username,
                                icon: 'fa fa-thumbs-up',
                                content: 'تم  تسجيل الدخول  بنجاح',
                                type: 'green',
                                rtl: true,
                                closeIcon: false,
                                draggable: true,
                                dragWindowGap: 0,
                                typeAnimated: true,
                                theme: 'supervan',
                                autoClose: 'okAction|3000',
                                buttons: {
                                    okAction: {
                                        text: 'ok',
                                        action: function() {
                                            $.redirect(
                                                "{!! route('/') !!}",
                                                "",
                                                "GET", "");
                                        }
                                    },
                                }
                            })
                        }
                    })
                }
            })
        });
</script>
</body>
</html>