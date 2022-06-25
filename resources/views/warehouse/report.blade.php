@extends('layouts.app')
@section('title', 'تقرير المخازن')
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
                                <h3 class="card-title" style="text-align: center;font-size:1.5rem;"> تقرير المخازن</h3>
                            <table id='table' dir="rtl">
                            <thead>
                                <tr>
                                    <th>كود المخزن</th>
                                    <th>اسم المخزن</th>
                                    <th>متوسط السعة</th>
                                    <th>الموقع</th>
                                    <th>المساحة</th>
                                    <th>الأدوات</th>
                                </tr>
                            </thead>
                            <tbody>
                    @foreach ($warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->code }}</td>
                            <td>{{ $warehouse->name }}</td>
                            <td>{{ $warehouse->capacity }}</td>
                            <td>{{ $warehouse->loacation }}</td>
                            <td>{{ $warehouse->size }}</td>
                            <td></td>
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
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
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
            buttons: [
                {
                    extend: 'print',
                    title: '',
                    text: '<i class="fas fa-print"> طباعة',
                    messageTop: '<img src="/images/print_header.png" style="position:relative;width:100%;" />',
                    autoPrint: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    customize: function(win) {
                        $(win.document.body)
                            .css('direction', 'rtl')
                            .css('text-align', 'center');
                
                    }
                },
            ]
        });
        </script>
@endsection
