@extends('layouts.app')
@section('title', 'إذن صرف من المخزن')
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
                                                            warehouse: $('select.warehouse').children("option:selected").val(),
                                                            custom: $('select.custom').children("option:selected").val(),
                                                            employee: $("#employee").val(),
                                                            contractor: $("#contractor").val(),
                                                            driver: $("#driver").val(),
                                                            car_no: $("#car_no").val(),
                                                            car_no2: $("#car_no2").val()
                                                        };
                                              
                                                       
                                                    $.ajaxSetup({
                                                        headers: {
                                                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                    $.ajax({
                                                        type: "POST",
                                                        url: '/permit',
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
                                                                title: 'تم إضافة إذن الصرف بنجاح  ',
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
                                                                            $.redirect("/permit", "",
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
                                <h3 class="card-title" style="text-align: center;font-size:2rem;">إذن صرف من المخزن</h3>
                                <form class="needs-validation" novalidate id="myform">
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" id="employee"  name="employee" placeholder="اسم الموظف" required>
                                            <div class="invalid-tooltip">
                                                ادخل اسم الموظف 
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            {{-- <label for="validationTooltip01">كود المخزن</label> --}}
                                        <select type="select" id="exampleCustomSelect" name="warehouse" id="warehouse" class="warehouse custom-select" required>
                                                    <option value="" disabled selected>اختر المخزن</option>
                                                    @foreach ($warehouses as $warehouse)
                                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                    @endforeach
                                        </select>                                      
                                                <div class="invalid-tooltip">
                                                    ادخل  المخزن
                                            </div>
                                        </div>  
                                        <div class="col-md-3 mb-3">
                                        <select type="select" id="exampleCustomSelect" name="custom" id="custom" class="custom custom-select" required>
                                                    <option value="" disabled selected>اختر رقم الإفراج الجمركي </option>
                                                    @foreach ($goods as $good)
                                                            <option value="{{ $good->custom }}">{{ $good->custom }}</option>
                                                    @endforeach
                                        </select>                         
                                            <div class="invalid-tooltip">
                                                    ادخل  رقم الإفراج الجمركي 
                                            </div>
                                        </div>
                                            <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" id="contractor"  name="contractor" placeholder="اسم المقاول" required>
                                            <div class="invalid-tooltip">
                                                ادخل اسم المقاول  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        
                                        <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" id="driver"  name="driver" placeholder="اسم السائق" required>
                                            <div class="invalid-tooltip">
                                                ادخل اسم السائق 
                                            </div>
                                        </div>
                                        
                                          <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" id="car_no"  name="car_no" placeholder="رقم وش السيارة" required>
                                            <div class="invalid-tooltip">
                                                ادخل  رقم وش السيارة 
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" id="car_no2"  name="car_no2" placeholder="رقم  المقطورة" required>
                                            <div class="invalid-tooltip">
                                                ادخل  رقم  المقطورة 
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
