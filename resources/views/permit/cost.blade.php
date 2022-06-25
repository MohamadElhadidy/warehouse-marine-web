@extends('layouts.app')
@section('title', 'إضافة وزن وتكلفة النقلة')
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
                                                            permit_num: $("#permit_num").val(),
                                                            cost_type: $('select.cost_type').children("option:selected").val(),
                                                            quantity: $("#quantity").val(),
                                                            cost: $("#cost").val()
                                                        };
                                              
                                                       
                                                    $.ajaxSetup({
                                                        headers: {
                                                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                    $.ajax({
                                                        type: "POST",
                                                        url: '/permit/cost',
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
                                                                title: 'تم إضافة  الوزن و التكلفة بنجاح  ',
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
                                <h3 class="card-title" style="text-align: center;font-size:2rem;">إضافة وزن وتكلفة النقلة</h3>
                                <form class="needs-validation" novalidate id="myform">
                                     <input type="hidden"  readonly name="permit_num" id="permit_num" value="{{  $permit->permit_num}}" >
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" disabled name="warehouse" value="{{  $permit->warehouses->name }}" placeholder="المخزن ">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" name="client"  disabled value="{{ $permit->clients->name }}" placeholder="العميل">

                                        </div>
                                        
                                          <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" name="custom"  disabled value="{{ $permit->custom }}" placeholder="رقم الإفراج الجمركي ">

                                        </div>
                                         <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" disabled name="contractor" value="{{ $permit->contractor }}" placeholder="اسم المقاول">
                                        </div>
                                      
                                     
                                    </div>
                                    <div class="form-row">
                                       
                                          <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" name="driver"  disabled value="{{ $permit->driver }}" placeholder="اسم السائق">

                                        </div>
                                          <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" name="car_no"  disabled value="{{ $permit->car_no }}" placeholder="رقم وش السيارة">

                                        </div>
                                        
                                          <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" name="car_no2"  disabled value="{{ $permit->car_no2 }}" placeholder="رقم  المقطورة">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" name="arrival_date"  disabled value="{{ $permit->arrival_date }}" placeholder="تاريخ التحميل">

                                        </div>
                                        
                                    </div> 
                                    <div class="form-row">
                                         <div class="col-md-3 mb-3">
                                            {{-- <label for="validationTooltip01">كود المخزن</label> --}}
                                        <select type="select" id="exampleCustomSelect" name="cost_type" id="cost_type" class="cost_type custom-select" required>
                                                    <option value="" disabled @if($permit->cost_type  == null) selected @endif >اختر طريقة الحساب</option>
                                                        <option value="quantity" @if($permit->cost_type  == 'quantity') selected @endif>بالطن</option>
                                                        <option value="moves" @if($permit->cost_type  == 'moves') selected @endif>بالنقلة</option>
                                                                     
                                        </select>                                      
                                                <div class="invalid-tooltip">
                                                ادخل طريقة الحساب      
                                            </div>
                                        </div>  
                                       
                                          <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" id="quantity"  name="quantity" @if($permit->quantity != null )value="{{ $permit->quantity }}"@endif  placeholder="وزن النقلة" required>
                                            <div class="invalid-tooltip">
                                                ادخل  وزن النقلة
                                            </div>
                                            </div>
                                             <div class="col-md-3 mb-3">
                                            <input type="text" class="form-control" id="cost"  name="cost" @if($permit->cost != null )value="{{ $permit->cost }}"@endif placeholder="سعر الطن" required>
                                            <div class="invalid-tooltip">
                                                ادخل  سعر الطن   
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
