<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title> إذن صرف رقم {{ $permit->permit_num }}</title>
    <style>
@page {
                margin: 0 auto; /* imprtant to logo margin */
                sheet-size: 300px 250mm; /* imprtant to set paper size */
            }
            html {
                direction: rtl;
                  font-size: 12px;
            }
            html,body{margin:0;padding:0}
            #printContainer {
                width: 250px;
                margin: auto;
                /*padding: 10px;*/
                /*border: 2px dotted #000;*/
                text-align: justify;
                  margin-top:20px
            }

           .text-center{text-align: center;}
        
        @media print {
            @page {
                margin: 0 auto; /* imprtant to logo margin */
                sheet-size: 300px 250mm; /* imprtant to set paper size */
            }
            html {
                direction: rtl;
                  font-size: 12px;
            }
            html,body{margin:0;padding:0}
            #printContainer {
                width: 250px;
                margin: auto;
                /*padding: 10px;*/
                /*border: 2px dotted #000;*/
                text-align: justify;
                  margin-top:20px
            }
           .text-center{text-align: center;}
        }
        img{
             display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50px;
        }
    </style>
</head>
{{-- onload="window.print();" --}}
<body >
<div id='printContainer'>
     <img   src="{{ asset('\images\logo.png') }}">
    <h2 id="slogan" style="margin-top:0" class="text-center"> Marine Logistics</h2>
    <div class="mb-3">{!! DNS1D::getBarcodeHTML($permit->permit_num, 'CODABAR') !!}</div>        
    <table>
        <tr>
            <td><b>رقم الإذن<b></td>
            <td><b>{{ $permit->permit_num }}</b></td>
        </tr>
        <tr>
            <td><b>تاريخ الإذن<b></td>
            <td><b>{{ $permit->created_at }}</b></td>
        </tr>

        <tr>
            <td><b> رقم الإفراج الجمركي<b> </td>
            <td><b>{{ $permit->custom }}</b></td>
        </tr>
          <tr>
            <td><b>رقم وش السيارة</b></td>
            <td><b>{{ $permit->car_no }}</b></td>
        </tr> 
        <tr>
            <td><b>رقم  المقطورة </b></td>
            <td><b>{{ $permit->car_no2 }}</b></td>
        </tr>
        <tr>
            <td><b>اسم المقاول</b></td>
            <td><b>{{ $permit->contractor }}</b></td>
        </tr>
        <tr>
            <td><b>اسم السائق</b></td>
            <td><b>{{ $permit->driver }}</b></td>
        </tr>
    </table>
    <hr>

    <table>
        <tr>
            <td><b> المخزن</b></td>
            <td><b>{{ $permit->warehouses->name }}</b></td>
        </tr>
        <tr>
            <td><b> الصنف</b></td>
            <td><b>{{ $permit->types->name }}</b></td>
        </tr>
         <tr>
            <td><b> العميل</b></td>
            <td><b>{{ $permit->clients->name }}</b></td>
        </tr>
         
        
    </table>
    <hr>
     <table>
        <tr>
            <td><b>اسم الموظف</b></td>
            <td><b>{{ $permit->employee }}</b></td>
        </tr>
        
    </table>
      <hr>
      @if ($permit->quantity != 0)
     <table>
        <tr>
            <td><b>الكمية</b></td>
            <td><b>{{ $permit->quantity }} طن </b></td>
        </tr>
        <tr>
            <td><b>@if ($permit->cost_type == 'quantity')سعر الطن@endif
                @if ($permit->cost_type == 'moves')سعر النقلة@endif</b></td>
            <td><b>{{ $permit->cost }}  جنيها </b></td>
        </tr>
        <tr>
            <td><b>إجمالي التكلفة</b></td>
             <td><b>@if ($permit->cost_type == 'quantity') {{ $permit->cost   * $permit->quantity}}  جنيها@endif
                @if ($permit->cost_type == 'moves'){{ $permit->cost}}  جنيها @endif</b></td>
        </tr>
    </table>
        <hr>
        @endif
        <h4 id="slogan" style="margin-top:0" class="text-center">IT Department &copy; <?php echo date("Y"); ?></h4>
</div>
</body>
</html>