@extends('layouts.app')

@section('title')
    Print Invoice
@endsection

@push('css')
    @include('includes.styles.basic')
    <style type="text/css">
        .alert,
        .alert-danger {
            z-index: 1052 !important;
        }
        /* .table>:not(caption)>*>*{
            padding: 0 !important;
        } */


    </style>
    <style media="print">
        .no-print{display:none!important}
        /* body * {
            visibility: hidden;
        } */

        #print_section *{
            visibility: visible;
        }

        body{
            print-color-adjust: exact; 
            -webkit-print-color-adjust: exact; 
            margin:0 -20px !important;
            padding: 0 !important;
        }

    </style>
@endpush

@section('breadcrumb')
    <h1 class="flex-grow-1 fs-3 fw-bold my-2 my-sm-3 no-print">Print Invoice</h1>
    <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3 no-print" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Invoice</li>
            <li class="breadcrumb-item active" aria-current="page">Print Invoice</li>
        </ol>
    </nav>
@endsection


@section('content')
    <!-- Dynamic Table with Export Buttons -->
    <div class="block block-rounded">
        <div class="block-header border-bottom border-2 no-print">
            <h3 class="mb-0 py-1 fs-4 fw-bold">Print Invoice</h3>
            <div class="btn-group">
            <a href="{{ route('invoice.pdf', $invoice->id) }}"  class="btn btn-sm btn-danger">Download Pdf</a>
            <a href="{{ route('invoice.export', [$invoice->customer_id,$month,$invoice->id]) }}"  class="btn btn-sm btn-success">Download Excel</a>
            <button  class="btn btn-sm btn-primary" onclick="return print();">Click To Print</button>
            </div>
        </div>
        <div class="block-content block-content-full">

            <div class="print-section" id="print_section">
                <div class="bg-secondary text-white text-center py-2 fs-4">Tax E-Invoice - الفاتورة الإلكترونية الضريبية </div>
                <table class="table table-borderless w-100">
                    <tr>
                        <td class="w-50">
                            <div class="bg-light py-2 fw-bold ps-2">Bill From / الفواتير من </div>
                            <div class="ms-4">
                                <div class="fw-bold">{{ get_system_setting()->app_title }}</div>
                                <div>{{ get_system_setting()->app_title_arabic }}</div>
                                <div>{{ get_system_setting()->address }}</div>
                                <div>{{ get_system_setting()->vat_number }}</div>
                            </div>
                            <div class="bg-light py-2 fw-bold ps-2">Bill To / إعداد الفواتير </div>
                            <div class="ms-4">
                                <div class="fw-bold">{{ $customer->name }}</div>
                                <div>{{ $customer->name_arabic }}</div>
                                <div>{{ $customer->address }}</div>
                                <div class="fw-bold">Customer Vat No / رقم ضريبة القيمة المضافة </div>
                                <div>{{ $customer->vat_number }}</div>
                            </div>
                        </td>
                        <td class="w-50">
                            <div class="ms-2">
                                <div class="row">
                                    <div class="bg-light ps-2 col-6 fs-5">Invoice Number / رقم الفاتورة </div>
                                    <div class="col-6">{{ $invoice->invoice_number }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">Invoice Date / تاريخ الفاتورة </div>
                                    <div class="col-6">{{ $invoice->invoice_date }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">Due Date / تاريخ الاستحقاق </div>
                                    <div class="col-6">{{ $invoice->due_date }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">Our Vat Number / لدينا ضريبة </div>
                                    <div class="col-6">{{ $invoice->vat_number }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">Credit Days / أيام الائتمان </div>
                                    <div class="col-6">{{ $invoice->credit_days }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">Payment Mode / طريقة الدفع </div>
                                    <div class="col-6">{{ $invoice->payment_mode }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">Reference Number / رقم المرجع </div>
                                    <div class="col-6">{{ $invoice->reference_number }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">PO Number / رقم الموقع </div>
                                    <div class="col-6">{{ $invoice->po_number }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">Project Number / رقم المشروع </div>
                                    <div class="col-6">{{ $invoice->project_number }}</div>

                                    <div class="bg-light ps-2 col-6 fs-5">Subject / موضوعات </div>
                                    <div class="col-6">{{ $invoice->subject }}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered w-100">
                       
                
                    <tbody>
                        <tr class="bg-light">
                            <td colspan="10">
                                <div class="fw-bold w-100">We Are Pleased To Submit Our Monthly Invoice For The Supply Of Manpower For The Month Of {{ $invoice->invoice_month }} {{ now()->format('Y') }}</div>
                            </td>
                        </tr>
                        <tr class="bg-light">
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
                <div class="fw-bold bg-light p-2">Notes / ملحوظات</div>
                <div class="row">
                    <div class="col-8">
                        <div class="ps-2">{{ $invoice->note }}</div>
                        <div class="fw-bold bg-light p-2 ps-2">Transfer Details / تفاصيل التحويل</div>
                        <div class="row ps-4">
                            <div class="col-md-6">Bank Name</div>
                            <div class="col-md-6">
                                {{ $payment->bank_name }}
                            </div>
                            <div class="col-md-6">IBAN</div>
                            <div class="col-md-6">
                                {{ $payment->iban }}
                            </div>
                            <div class="col-md-6">Account Number</div>
                            <div class="col-md-6">
                                {{ $payment->account_number }}
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        @if($invoice->status)
                        <img class="text-center mt-2" src="data:image/png;base64,{{DNS2D::getBarcodePNG($qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->
@endsection


@push('js')
    @include('includes.scripts.basic')
@endpush

@push('scripts')
<script>
    function printDiv() {
        var divContents = document.getElementById("print_section").innerHTML;
        var a = window.open('', '', 'height=700, width=800');
        a.document.write('<html>');
        a.document.write('<body>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>
@endpush
