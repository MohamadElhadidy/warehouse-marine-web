@extends('layouts.app')
@section('title', 'إضافة شهادة جديدة')
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
                                                            custom: $('#custom').val(),
                                                            type:$('select.type').children("option:selected").val(),
                                                            client: $('select.client').children("option:selected").val(),
                                                            balance: $("#balance").val(),
                                                            vessel: $("#vessel").val(),
                                                            date: $("#date").val()
                                                        };
                                              
                                                       
                                                    $.ajaxSetup({
                                                        headers: {
                                                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                    $.ajax({
                                                        type: "POST",
                                                        url: '/goods',
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
                                                                title: 'تم إضافة الشهادة بنجاح  ',
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
                                                                            $.redirect("/goods", "",
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
                                <h3 class="card-title" style="text-align: center;font-size:2rem;"> إضافة شهادة جديدة</h3>
                                <form class="needs-validation" novalidate id="myform">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            {{-- <label for="validationTooltip01">كود المخزن</label> --}}
                                    <input type="number" class="form-control" id="custom"  name="custom" placeholder="رقم الإفراج الجمركي" required>
                                            <div class="invalid-tooltip">
                                                ادخل  رقم الإفراج الجمركي 
                                            </div>                             
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            {{-- <label for="validationTooltip02"> اسم المخزن</label> --}}
                                            <select type="select" id="exampleCustomSelect" name="type" id="type" class="type custom-select" required>
                                                    <option value="" disabled selected>اختر الصنف</option>
                                                    @foreach ($types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                        </select>                               
                                            <div class="invalid-tooltip">
                                                    ادخل  الصنف
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                        <select type="select" id="exampleCustomSelect" name="client" id="client" class="client custom-select" required>
                                                    <option value="" disabled selected>اختر العميل</option>
                                                    @foreach ($clients as $client)
                                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                    @endforeach
                                        </select>                         
                                            <div class="invalid-tooltip">
                                                    ادخل العميل 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <input type="number" class="form-control" id="balance"  name="balance" placeholder="الكمية" required>
                                            <div class="invalid-tooltip">
                                                ادخل الكمية  
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" id="vessel"  name="vessel" placeholder="اسم الباخرة" required>
                                            <div class="invalid-tooltip">
                                                ادخل اسم الباخرة 
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="date" class="form-control" id="date"  name="date" placeholder=" تاريخ بداية التخزين" required>
                                            <div class="invalid-tooltip">
                                                ادخل تاريخ بداية التخزين  
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
