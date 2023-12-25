<html>
<head>
<title>Invoice</title>
</head>
<body>
<table class="table table-borderless w-100">
    <tr>
        <th><div class="bg-light py-2 fw-bold ps-2">Bill From</div></th>
        <td>
            <div class="ms-4">
                <div class="fw-bold">{{ get_system_setting()->app_title }}</div>
                <div>{{ get_system_setting()->app_title_arabic }}</div>
                <div>{{ get_system_setting()->address }}</div>
                <div>{{ get_system_setting()->vat_number }}</div>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <div class="bg-light py-2 fw-bold ps-2">Bill To</div>
        </td>
        <td>
            <div class="ms-4">
                <div class="fw-bold">{{ $customer->name }}</div>
                <div>{{ $customer->name_arabic }}</div>
                <div>{{ $customer->address }}</div>
                <div class="fw-bold">Customer Vat No :</div>
                <div>{{ $customer->vat_number }}</div>
            </div>
        </td>
    </tr>
</table>

<table class="">
    <tr>
        <th class="bg-light ps-2 fs-5">Invoice Number</th>
        <td class="ps-2">{{ $invoice->invoice_number }}</td>
    </tr>

    <tr>
        <th class="bg-light ps-2 fs-5">Invoice Date</th>
        <td class="ps-2">{{ $invoice->invoice_date }}</td>
    </tr>

    <tr>
        <th class="bg-light ps-2 fs-5">Due Date</th>
        <td class="ps-2">{{ $invoice->due_date }}</td>
    </tr>
    
    <tr>
        <th class="bg-light ps-2 fs-5">Our Vat Number</th>
        <td class="ps-2">{{ $invoice->vat_number }}</td>
    </tr>

    <tr>
        <th class="bg-light ps-2 fs-5">Credit Days</th>
        <td class="ps-2">{{ $invoice->credit_days }}</td>
    </tr>

    <tr>
        <th class="bg-light ps-2 fs-5">Payment Mode</th>
        <td class="ps-2">{{ $invoice->payment_mode }}</td>
    </tr>

    <tr>
        <th class="bg-light ps-2 fs-5">Reference Number</th>
        <td class="ps-2">{{ $invoice->reference_number }}</td>
    </tr>

    <tr>
        <th class="bg-light ps-2 fs-5">PO Number</th>
        <td class="ps-2">{{ $invoice->po_number }}</td>
    </tr>
    <tr>
        <th class="bg-light ps-2 fs-5">Project Number</th>
        <td class="ps-2">{{ $invoice->project_number }}</td>
    </tr>

    <tr>
        <th class="bg-light ps-2 fs-5">Subject</th>
        <td class="ps-2">{{ $invoice->subject }}</td>
    </tr> 
</table>

 <table class="table table-bordered bg-light">
    <thead>
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
    </thead>
    <tbody>
        @forelse ($man_powers as $man_power)
            <tr>
                <td>
                    {{$man_power->serial_number}}
                </td>
                <td>
                    {{ $man_power->person->name ?? null }}
                </td>
                <td>
                    {{ $man_power->iqama_id }}
                </td>
                <td>
                    {{ $man_power->designation }}
                </td>
                <td>
                    {{ $man_power->total_hours }}
                </td>
                <td>
                    {{ $man_power->rate_hour }}
                </td>
                <td>
                    {{ $man_power->total_price }}
                </td>
                <td>
                    {{ $man_power->vat }}
                    <input type="hidden" name="vat[]" value="{{ $man_power->vat }}"/>
                </td>
                <td>
                    {{ $man_power->vat_amount }}
                </td>
                <td>
                    {{ $man_power->grand_price }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10">
                    <p>Date Not Found</p>
                </td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">
                
            </th>
            <th colspan="2">Total</th>
            <th>
                {{$invoice->total}}
            </th>
            <th colspan="2" class="text-end">
                {{$invoice->vat_total}}
            </th>
            <th>
                {{ $invoice->grand_total }}
            </th>
        </tr>
    </tfoot>
</table>
</body>
</html>