@extends('layouts.app')
@section('title', 'إضافة عميل جديد')
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
                                                            address: $("#address").val(),
                                                            tele: $("#tele").val(),
                                                            email: $("#email").val()
                                                        };
                                                    $.ajaxSetup({
                                                        headers: {
                                                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                    $.ajax({
                                                        type: "POST",
                                                        url: '/client',
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
                                                                title: 'تم إضافة العميل بنجاح  ',
                                                                icon: 'fa fa-thumbs-up',
                                                                content: formData.name,
                                                                type: 'green',
                                                                rtl: true,
                                                                closeIcon: false,
                                                                draggable: true,
                                                                dragWindowGap: 0,
                                                                dragWindowGap: 0,
                                                                typeAnimated: true,
                                                                theme: 'supervan',
                                                                autoClose: 'okAction|3000',
                                                                buttons: {
                                                                    okAction: {
                                                                        text: 'تم',
                                                                        action: function() {
                                                                            $.redirect("/client", "",
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
                           
                        <div class="main-card mb-3 card" style="direction: rtl">
                            <div class="card-body">
                                <h3 class="card-title" style="text-align: center;font-size:2rem;">  إضافة عميل جديد</h3>
                                <form class="needs-validation" novalidate id="myform">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            {{-- <label for="validationTooltip01">كود العميل</label> --}}
                                            <input type="text" class="form-control" id="code" name="code"   placeholder="كود العميل" value="" required>
                                           <div class="invalid-tooltip">
                                                    ادخل كود العميل
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            {{-- <label for="validationTooltip02"> اسم العميل</label> --}}
                                            <input type="text" class="form-control" id="name"  name="name"  placeholder="اسم العميل" value="" required>
        
                                            <div class="invalid-tooltip">
                                                    ادخل اسم العميل
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" id="address"  name="address"  placeholder="العنوان" value="" >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <input type="number" class="form-control"id="tele" minlength="10"    name="tele" placeholder="رقم التليفون"  value="">
                                            <div class="invalid-tooltip">
                                                ادخل رقم التليفون بشكل صحيح 
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="email" class="form-control" id="email"  name="email"  placeholder="البريد الإلكتروني" >
                                            <div class="invalid-tooltip">
                                                ادخل البريد الإلكتروني بشكل صحيح 
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
