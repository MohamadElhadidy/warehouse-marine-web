@extends('layouts.app')
@section('title', 'تقرير صرف من المخازن')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link href="{{ asset('css/datatable.css') }}" rel="stylesheet">

@endsection


@section('content')
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading"  style="text-align: center;">
                                </div>
                                </div>
                        </div>           
                            
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h3 class="card-title" style="text-align: center;font-size:1.5rem;"> تقرير صرف من المخازن</h3>
                            <table id='table' dir="rtl">
                            <thead>
                                <tr>
                                    <th> رقم الإذن</th>
                                    <th> المخزن</th>
                                    <th> رقم الإفراج الجمركي </th>
                                    <th>اسم المقاول</th>
                                    <th>اسم السائق</th>
                                    <th> رقم وش السيارة </th>
                                    <th> رقم  المقطورة </th>
                                    <th>الأدوات</th>
                                </tr>
                            </thead>
                            <tbody>
                    @foreach ($permits as $permit)
                    @if ($permit->arrival == 1)
                        @php
                            $color = '#7ceb8d' ;
                        @endphp 
                        @else
                        @php
                            $color = '#ffff' ;
                        @endphp 
                    @endif
                        <tr style="background-color: {{ $color }}">
                            <td>{{ $permit->permit_num }}</td>
                            <td>{{ $permit->warehouses->name }}</td>
                            <td>{{ $permit->custom }}</td>
                            <td>{{ $permit->contractor }}</td>
                            <td>{{ $permit->driver }}</td>
                            <td>{{ $permit->car_no }}</td>
                            <td>{{ $permit->car_no2 }}</td>
                            <td> @if ($permit->arrival == 1)<a href="/permit/cost/{{ $permit->permit_num }}"><i class="fas fa-file-invoice-dollar"></i></a> @endif
                            <a href="/permit/print/{{ $permit->permit_num }}"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
                            </div>
                        </div>
                    </div>
                    
                    @endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <script>
    var dt = $('#table').DataTable({
            dom: 'lBfrtip',
            responsive: true,
            "language": {
                "searchPlaceholder": "ابحث",
                "sSearch": "",
                "sProcessing": "جاري التحديث...",
                "sLengthMenu": "أظهر مُدخلات _MENU_",
                "sZeroRecords": "لم يُعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مُدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجلّ",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                }
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "الكل"]
            ],

            order: [],
         
        });
        </script>
@endsection
