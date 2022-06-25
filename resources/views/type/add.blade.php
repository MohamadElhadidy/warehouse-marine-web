@extends('layouts.app')
@section('title', 'إضافة صنف جديد')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

@endsection


@section('content')
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading"  style="text-align: center;">
                                  
                                        
                                </div>
                                 </div>
                        </div>           
                                <script>
                                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                                    (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.getElementsByClassName('needs-validation');
                                            // Loop over them and prevent submission
                                            var validation = Array.prototype.filter.call(forms, function(form) {
                                                form.addEventListener('submit', function(event) {
                                                    if (form.checkValidity() === false) {
                                                        event.preventDefault();
                                                        event.stopPropagation();
                                                    }
                                                    form.classList.add('was-validated');
                                                    if (form.checkValidity() === true) {
                                                        event.preventDefault();
                                                    var formData = {
                                                            code: $("#code").val(),
                                                            name: $("#name").val(),
                                                        };
                                                    $.ajaxSetup({
                                                        headers: {
                                                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                    $.ajax({
                                                        type: "POST",
                                                        url: '/type',
                                                        data: formData,
                                                        dataType: "json",
                                                        encode: true,
                                                        error: function(xhr, status, error) {
                                                            if(xhr.status == 422){
                                                                $.alert({
                                                                title: '',
                                                                type: 'red',
                                                                content:  xhr.responseJSON.message,
                                                                icon: 'fa fa-warning'
                                                            })
                                                            }else{
                                                            $.alert({
                                                                title: '',
                                                                type: 'red',
                                                                content:  'اعد المحاولة مرة أخرى',
                                                                icon: 'fa fa-warning'
                                                            })
                                                            }
                                                        
                                                        },
                                                        success: function(data) {
                                                                $.confirm({
                                                                title: 'تم إضافة الصنف بنجاح  ',
                                                                icon: 'fa fa-thumbs-up',
                                                                content: formData.name,
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
                                                                        text: 'تم',
                                                                        action: function() {
                                                                            $.redirect("/type", "",
                                                                                "GET", "");
                                                                        }
                                                                    },
                                                                }
                                                            })
                                                        }
                                                    })
                                                    }
                                                }, false);
                                            });
                                        }, false);
                                    })();
                                </script>
                           
                        <div class="main-card mb-3 card" style="direction: rtl;text-align: center">
                            <div class="card-body">
                                <h3 class="card-title" style="text-align: center;font-size:2rem;">  إضافة صنف جديد</h3>
                                <form class="needs-validation" novalidate id="myform">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3 mr-5">
                                            <input type="text" class="form-control" id="code" name="code"  placeholder="كود الصنف" value="" required>
                                           <div class="invalid-tooltip">
                                                    ادخل كود الصنف
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3 mr-5">
                                            <input type="text" class="form-control" id="name"  name="name" placeholder="اسم الصنف" value="" required>
        
                                            <div class="invalid-tooltip">
                                                    ادخل اسم الصنف
                                            </div>
                                        </div>
                                
                                    </div>
                                
                                    <button class="btn btn-primary" type="submit">حفظ البيانات</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    @endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/mgalante/jquery.redirect@master/jquery.redirect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

@endsection
