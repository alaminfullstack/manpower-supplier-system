<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $customer->name }} Invoice Pdf of {{ $invoice->invoice_month }}</title>
    <style>

      *{
          font-size: 14px;  
       }

       body{
        width: 700px;
       }

        .table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .table td, .table th {
            border: 1px solid #ddd;
            padding: 4px;
        }

        .table tr:nth-child(even){background-color: #f2f2f2;}

        .table th {
            padding-top: 6px;
            padding-bottom: 6px;
            text-align: left;
            background-color: gray;
            color: white;
        }

        .table-bordered{
            border: 1px solid;
        }

        .p-2{
            padding: 10px;
        }

        .w-100{
            width: 100%;
            display: block;
        }

        .bg-light{
            background: gray;
        }

        .text-center{
            text-align: center;
        }

        .text-white{
            color: white;
        }

        .py-2{
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .fs-4{
            font-size: 18px;
        }

        .fw-bold{
            font-weight: bold;
        }

        .ms-4{
            margin-left: 16px;
        }

        .w-50{
            width: 50%;
        }

        .ps-2{
            padding-left: 10px;
        }

        .ps-4{
            padding-left: 16px;
        }

        .row{
            width: 100%;
            display: block;
        }

        .col-6{
            width: 50%;
        }



        .f-l{
            float: left;
        }
    </style>
</head>
<body>
    <div class="print-section" id="print_section">
        <div class="bg-light text-white text-center py-2 fs-4">Tax E-Invoice - الفاتورة الإلكترونية الضريبية </div>
        <table class="">
            <tr>
                <td>
                    <div class="bg-light py-2 fw-bold ps-2 w-100">Bill From / الفواتير من </div>
                    <div class="ms-4">
                        <div class="fw-bold">{{ get_system_setting()->app_title }}</div>
                        <div>{{ get_system_setting()->app_title_arabic }}</div>
                        <div>{{ get_system_setting()->address }}</div>
                        <div>{{ get_system_setting()->vat_number }}</div>
                    </div>
                    <div class="bg-light py-2 fw-bold ps-2 w-100">Bill To / إعداد الفواتير </div>
                    <div class="ms-4">
                        <div class="fw-bold">{{ $customer->name }}</div>
                        <div>{{ $customer->name_arabic }}</div>
                        <div>{{ $customer->address }}</div>
                        <div class="fw-bold">Customer Vat No / رقم ضريبة القيمة المضافة </div>
                        <div>{{ $customer->vat_number }}</div>
                    </div>
                </td>
                <td>
                
                    <table class="">
                        <tr>
                            <th class="bg-light ps-2 fs-5">Invoice Number / رقم الفاتورة</th>
                            <td class="ps-2">{{ $invoice->invoice_number }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light ps-2 fs-5">Invoice Date / تاريخ الفاتورة</th>
                            <td class="ps-2">{{ $invoice->invoice_date }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light ps-2 fs-5">Due Date / تاريخ الاستحقاق </th>
                            <td class="ps-2">{{ $invoice->due_date }}</td>
                        </tr>
                        
                        <tr>
                            <th class="bg-light ps-2 fs-5">Our Vat Number / لدينا ضريبة </th>
                            <td class="ps-2">{{ $invoice->vat_number }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light ps-2 fs-5">Credit Days / أيام الائتمان </th>
                            <td class="ps-2">{{ $invoice->credit_days }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light ps-2 fs-5">Payment Mode / طريقة الدفع </th>
                            <td class="ps-2">{{ $invoice->payment_mode }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light ps-2 fs-5">Reference Number / رقم المرجع </th>
                            <td class="ps-2">{{ $invoice->reference_number }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light ps-2 fs-5">PO Number / رقم الموقع </th>
                            <td class="ps-2">{{ $invoice->po_number }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light ps-2 fs-5">Project Number / رقم المشروع </th>
                            <td class="ps-2">{{ $invoice->project_number }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light ps-2 fs-5">Subject / موضوعات </th>
                            <td class="ps-2">{{ $invoice->subject }}</td>
                        </tr> 
                    </table>
                  
                </td>
            </tr>
        </table>
        <table class="table table-bordered w-100">
            <tbody>
                <tr>
                    <td colspan="10" class="bg-light p-2">
                        We Are Pleased To Submit Our Monthly Invoice For The Supply Of Manpower For The Month Of {{ $invoice->invoice_month }} {{ now()->format('Y') }}
                    </td>
                </tr>
                <tr>
                    <th>Serial No / رقم سري</th>
                    <th>Name / اسم</th>
                    <th>Iqama Id / معرف الإقامة</th>
                    <th>Designation / تعيين</th>
                    <th>Total Hours / مجموع الساعات</th>
                    <th>Rate/Hour / ساعة السعر</th>
                    <th>Total Amount / المبلغ الإجمالي</th>
                    <th>Vat (%) / ضريبة القيمة </th>
                    <th>Vat Amount / قيمة الضريبة</th>
                    <th>Total with Vat / مبلغ كبير</th>
                </tr>
                @forelse ($invoice_details as $detail)
                    <tr>
                        <td>
                            {{$detail->serial_number}}
                        </td>
                        <td>
                            {{ $detail->person->name ?? null }}
                        </td>
                        <td>
                            {{ $detail->iqama_id }}
                        </td>
                        <td>
                            {{ $detail->designation }}
                        </td>
                        <td>
                            {{ $detail->total_hours }}
                        </td>
                        <td>
                            {{ $detail->rate_hour }}
                        </td>
                        <td>
                            {{ $detail->total_price }}
                        </td>
                        <td>
                            {{ $detail->vat }}
                        </td>
                        <td>
                            {{ $detail->vat_amount }}
                        </td>
                        <td>
                            {{ $detail->grand_price }}
                        </td>
                    </tr>
                    
                @empty
                    <tr>
                        <td colspan="10">
                            <p>Date Not Found</p>
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <th colspan="4">
                        {{ $total_amount_in_word }}
                    </th>
                    <th colspan="2">Total</th>
                    <th>
                        {{$invoice->total}}
                    </th>
                    <th colspan="2" class="text-center">
                        {{$invoice->vat_total}}
                    </th>
                    <th>
                        {{ $invoice->grand_total }}
                    </th>
                </tr>
            </tbody>
        </table>
        <div class="fw-bold bg-light p-2 w-100">Note / ملحوظات </div>
        <table class="table w-100">
           <tbody>
            <tr>
                <td>
                    <div class="ps-2">{{ $invoice->note }}</div>
                    <div class="fw-bold bg-light p-2 w-100" style="width: 100% !important;">Transfer Details / تفاصيل التحويل </div>
                    <table class="table w-100">
                        <tr>
                            <td>Bank Name</td>
                            <td>
                                {{ $payment->bank_name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="">IBAN</td>
                            <td class="">
                                {{ $payment->iban }}
                            </td>
                        </tr>
                        <tr>
                            <td class="">Account Number</td>
                            <td class="">
                                {{ $payment->account_number }}
                            </td>
                        </tr> 
                    </table>
                </td>
                <td>
                    @if($invoice->status)
                    <img style="text-align: center; margin-left: 10px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG($qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}" />
                    @endif
                </td>
            </tr>
           </tbody>
            
        </table>
    </div>
</body>
</html>
