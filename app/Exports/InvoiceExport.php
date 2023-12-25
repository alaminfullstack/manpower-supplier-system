<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\ManPowerSupply;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;


class InvoiceExport implements FromView
{


    private $month;
    private $customer_id;
    private $invoice_id;

    private $invoice;
    private $customer;
    private $man_powers;

    public function __construct(int $customer_id, int $month, int $invoice_id)
    {
        $this->month = $month;
        $this->customer_id  = $customer_id;
        $this->invoice_id  = $invoice_id;
        $this->get_data($invoice_id);
    }

    public function view(): View
    {
        return view('exports.invoices', [
            'man_powers' => $this->man_powers,
            'invoice' => $this->invoice,
            'customer' => $this->customer
        ]);

        // return view('exports.invoices', [
        //     'man_powers' => ManPowerSupply::where('customer_id', $this->customer_id)->whereMonth('supply_date', $this->month)->get(),
        //     'invoice' => Invoice::find($this->invoice_id),
        //     'customer' => Customer::find($this->customer_id)
        // ]);
    }

    public function get_data($invoice_id)
    {
        $invoice =  Invoice::find($invoice_id);
        $this->invoice = $invoice;
        $this->customer = $invoice->customer;
        $this->man_powers = $invoice->details;
    }
}
