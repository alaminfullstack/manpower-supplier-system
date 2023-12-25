<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\NumberToWord;
use App\Exports\InvoiceExport;
use App\Models\InvoiceDetails;
use App\Models\ManPowerSupply;
use App\Models\PaymentDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(request()->ajax()){
            
            if(request('invoice_month') && request('customer_id')){
                $invoices = Invoice::query()->with('customer:id,name,name_arabic')->where('status',1)->where('invoice_month',request('invoice_month'))->where('customer_id', request('customer_id'));

            }elseif(request('invoice_month')){
                $invoices = Invoice::query()->with('customer:id,name,name_arabic')->where('status',1)->where('invoice_month',request('invoice_month'));

            }elseif(request('customer_id')){
                $invoices = Invoice::query()->with('customer:id,name,name_arabic')->where('status',1)->where('customer_id', request('customer_id'));

            }else{
                $invoices = Invoice::query()->with('customer:id,name,name_arabic')->where('status',1);
            }
            
            return DataTables::of($invoices)
            ->addColumn('checkbox', function($invoice){
                $html = '<input type="checkbox" name="selected_item" class="form-checked checkbox" value="'.$invoice->id.'" />';
                return $html;
            })
            ->addColumn('status',function($invoice){
                $btn = 'btn-success';
                if($invoice->status == 0){
                    $btn = 'btn-danger';
                }
                $html = '<select class="btn btn-sm change-status '.$btn.'" data-url="'.route('invoice.change_status',$invoice->id).'">
                            <option value="1" '.($invoice->status == 1 ? "selected" : "").'>Final</option>
                            <option value="0" '.($invoice->status == 0 ? "selected" : "").'>Draft</option>
                        </select>';
                return $html;        
            })

            ->editColumn('customer',function($invoice){
                return  $invoice->customer->name.' -- '.$invoice->customer->name_arabic;
            })
            ->editColumn('invoice_date',function($invoice){
                return  get_system_date_time_format($invoice->invoice_date);
            })
            ->editColumn('updated_at',function($invoice){
                return  get_system_date_time_format($invoice->updated_at);
            })
            ->addColumn('action',function($invoice){
                $html = '<div class="btn-group">';
                $html .= '<a href="'.route('invoice.show',$invoice->id).'" class="btn btn-info btn-sm ">View</a>';
                $html .= '<a href="'.route('invoice.edit',$invoice->id).'" class="btn btn-primary btn-sm ">Edit</a>';
                $html .= '<button data-url="'.route('invoice.delete',$invoice->id).'" class="btn btn-danger btn-sm show-modal">Delete</button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['checkbox','invoice_date','invoie_number','customer','invoice_month','total','vat_total','grand_total','status','updated_at','action'])
            ->toJson();
        }

        $customers = Customer::select('id','name','name_arabic')->latest()->get();
        $months = get_all_months();
        return view('invoice.index', compact('customers','months'));
    }


    public function draft()
    {
        //
        if(request()->ajax()){
            
            if(request('invoice_month') && request('customer_id')){
                $invoices = Invoice::query()->with('customer:id,name,name_arabic')->where('status',0)->where('invoice_month',request('invoice_month'))->where('customer_id', request('customer_id'));

            }elseif(request('invoice_month')){
                $invoices = Invoice::query()->with('customer:id,name,name_arabic')->where('status',0)->where('invoice_month',request('invoice_month'));

            }elseif(request('customer_id')){
                $invoices = Invoice::query()->with('customer:id,name,name_arabic')->where('status',0)->where('customer_id', request('customer_id'));

            }else{
                $invoices = Invoice::query()->with('customer:id,name,name_arabic')->where('status',0);
            }

            return DataTables::of($invoices)
            ->addColumn('checkbox', function($invoice){
                $html = '<input type="checkbox" name="selected_item" class="form-checked checkbox" value="'.$invoice->id.'" />';
                return $html;
            })
            ->addColumn('status',function($invoice){
                $btn = 'btn-success';
                if($invoice->status == 0){
                    $btn = 'btn-danger';
                }
                $html = '<select class="btn btn-sm change-status '.$btn.'" data-url="'.route('invoice.change_status',$invoice->id).'">
                            <option value="1" '.($invoice->status == 1 ? "selected" : "").'>Final</option>
                            <option value="0" '.($invoice->status == 0 ? "selected" : "").'>Draft</option>
                        </select>';
                return $html;        
            })

            ->editColumn('customer',function($invoice){
                return  $invoice->customer->name.' -- '.$invoice->customer->name_arabic;
            })
            ->editColumn('invoice_date',function($invoice){
                return  get_system_date_time_format($invoice->invoice_date);
            })
            ->editColumn('updated_at',function($invoice){
                return  get_system_date_time_format($invoice->updated_at);
            })
            ->addColumn('action',function($invoice){
                $html = '<div class="btn-group">';
                $html .= '<a href="'.route('invoice.show',$invoice->id).'" class="btn btn-info btn-sm">View</a>';
                $html .= '<a href="'.route('invoice.edit',$invoice->id).'" class="btn btn-primary btn-sm">Edit</a>';
                $html .= '<button data-url="'.route('invoice.delete',$invoice->id).'" class="btn btn-danger btn-sm show-modal">Delete</button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['checkbox','invoice_date','invoie_number','customer','invoice_month','total','vat_total','grand_total','status','updated_at','action'])
            ->toJson();
        }

        $customers = Customer::select('id','name','name_arabic')->latest()->get();
        $months = get_all_months();
        return view('invoice.draft', compact('customers','months'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = Customer::select('id','name','name_arabic')->latest()->get();
        $months = get_all_months();
        return view('invoice.create',compact('customers','months'));
    }

    public function generate(Request $request)
    {
        if($request->supply_month == null || $request->customer_id == null){
            return back();
        }

        $month = $request->supply_month;
        $year = $request->year;
        $customer_id = $request->customer_id;

        $customer = Customer::findOrFail($customer_id);
        $man_power_supplies = ManPowerSupply::with(['person:id,name'])->where('customer_id',$customer_id)->whereMonth('supply_date', $month)->whereYear('supply_date', $year)->get();

        $month_name = "";
        if(array_key_exists($month, get_all_months())){
            $month_name = get_all_months()[$month];
        }

        return view('invoice.generate',compact('customer','man_power_supplies','month_name'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(count($request->people_id) <= 0){
            return back();
        }

        $invoice = new Invoice();
        $invoice->invoice_number = $request->invoice_number ?? get_random_invoice_no();
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_month = $request->invoice_month;
        $invoice->due_date = $request->due_date;
        $invoice->vat_number = $request->vat_number;
        $invoice->credit_days = $request->credit_days;
        $invoice->payment_mode = $request->payment_mode;
        $invoice->reference_number = $request->reference_number;
        $invoice->po_number = $request->po_number;
        $invoice->project_number = $request->project_number;
        $invoice->subject = $request->subject;
        $invoice->customer_id  = $request->customer_id;
        $invoice->total = $request->final_total_amount;
        $invoice->vat_total = $request->final_vat_amount;
        $invoice->grand_total = $request->final_grand_amount;
        $invoice->status = $request->final ?? $request->draft;
        $invoice->note = $request->note;

        if($invoice->save()){
            for ($i=0; $i < count($request->people_id); $i++) { 
                $invoice_details = new InvoiceDetails();
                $invoice_details->invoice_id = $invoice->id;
                $invoice_details->people_id = $request->people_id[$i];
                $invoice_details->serial_number = $request->serial_number[$i];
                $invoice_details->iqama_id = $request->iqama_id[$i];
                $invoice_details->designation = $request->designation[$i];
                $invoice_details->total_hours = $request->total_hours[$i];
                $invoice_details->rate_hour = $request->rate_hour[$i];
                $invoice_details->total_price = $request->total_amount[$i];
                $invoice_details->vat = $request->vat[$i];
                $invoice_details->vat_amount = $request->vat_amount[$i];
                $invoice_details->grand_price = $request->grand_amount[$i];
                $invoice_details->save();
            }
            

            if($request->bank_name){
                $invoice_payment = new PaymentDetails();
                $invoice_payment->invoice_id = $invoice->id;
                $invoice_payment->customer_id = $request->customer_id;
                $invoice_payment->account_number = $request->account_number;
                $invoice_payment->iban = $request->iban;
                $invoice_payment->bank_name  = $request->bank_name;
                $invoice_payment->paid_amount  = $request->final_grand_amount;
                $invoice_payment->save();
            }

            return redirect()->route('invoice.show',$invoice->id);
        }else{
            return back();
        }
    }

    public function show($id)
    {
        $invoice = Invoice::with('customer')->findOrFail($id);

        $invoice_details = $invoice->details;
        $customer = $invoice->customer;
        $payment = $invoice->payments()->first();
        $month = array_search ($invoice->invoice_month, get_all_months());

        $n = new NumberToWord();
        $total_amount_in_word = $n->convert($invoice->grand_total, get_system_setting()->currency_code);

        $qr_code_text = $this->zatca_qr_text(get_system_title(),get_system_setting()->vat_number,$invoice->invoice_date,$invoice->grand_total,$invoice->vat_total);

        return view('invoice.show',compact('invoice','invoice_details','qr_code_text','total_amount_in_word','customer','payment','month'));
    }

    public function invoicePrint($id){
        // $rental = Rental::with(['customer','rentalEquipments'])->findOrFail($id);
        // $business = BusinessSetting::first();

        // $rental = Rental::with(['customer','rentalEquipments'])->findOrFail($id);
        // $business = BusinessSetting::first();
        
        // $qr_code_text = $this->zatca_qr_text($business->company_name,$business->tax_code,$rental->rental_date,$rental->total_amount,$rental->tax);
        
        // return view('rentals.invoice-print',compact('rental','business','qr_code_text'));
    }


    protected function zatca_qr_text($seller, $tax_number, $invoice_date, $invoice_total_amount, $invoice_tax_amount){
        $string = '';

        //$seller = 'Salla';
        //$tax_number = '1234567891';
        //$invoice_date = '2021-07-12T14:25:09Z';
        //$invoice_total_amount = '100.00';
        //$invoice_tax_amount = '15.00';

        $invoice_total_amount = round($invoice_total_amount, 2);
        // $invoice_date = Carbon::parse($invoice_date)->toIso8601ZuluString();

        // $string .= ($seller);
        $string .= $this->toHex(1).$this->toHex(strlen($seller)).($seller);
        $string .= $this->toHex(2).$this->toHex(strlen($tax_number)).($tax_number);
        $string .= $this->toHex(3).$this->toHex(strlen($invoice_date)).($invoice_date);
        $string .= $this->toHex(4).$this->toHex(strlen($invoice_total_amount)).($invoice_total_amount);
        $string .= $this->toHex(5).$this->toHex(strlen($invoice_tax_amount)).($invoice_tax_amount);
        // dump($string);
        return base64_encode($string);
    }

    /**
     * To convert the string value to hex.
     *
     * @param $value
     *
     * @return false|string
     */
    protected function toHex($value)
    {
        return pack("H*", sprintf("%02X", $value));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
 
        $customer = $invoice->customer;
        $payment = $invoice->payments()->first();
        $month = array_search ($invoice->invoice_month, get_all_months());


        $man_power_supplies = ManPowerSupply::with(['person:id,name'])->where('customer_id',$customer->id)->whereMonth('supply_date', $month)->get();

        $month_name = "";
        if(array_key_exists($month, get_all_months())){
            $month_name = get_all_months()[$month];
        }



        return view('invoice.edit',compact('invoice','customer','payment','month_name','man_power_supplies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
        if(count($request->people_id) <= 0){
            return back();
        }

        $invoice->invoice_number = $request->invoice_number ?? get_random_invoice_no();
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_month = $request->invoice_month;
        $invoice->due_date = $request->due_date;
        $invoice->vat_number = $request->vat_number;
        $invoice->credit_days = $request->credit_days;
        $invoice->payment_mode = $request->payment_mode;
        $invoice->reference_number = $request->reference_number;
        $invoice->po_number = $request->po_number;
        $invoice->project_number = $request->project_number;
        $invoice->subject = $request->subject;
        $invoice->customer_id  = $request->customer_id;
        $invoice->total = $request->final_total_amount;
        $invoice->vat_total = $request->final_vat_amount;
        $invoice->grand_total = $request->final_grand_amount;
        $invoice->note = $request->note;

        if($invoice->save()){
            $invoice->details()->delete();
            for ($i=0; $i < count($request->people_id); $i++) { 
                $invoice_details = new InvoiceDetails();
                $invoice_details->invoice_id = $invoice->id;
                $invoice_details->people_id = $request->people_id[$i];
                $invoice_details->serial_number = $request->serial_number[$i];
                $invoice_details->iqama_id = $request->iqama_id[$i];
                $invoice_details->designation = $request->designation[$i];
                $invoice_details->total_hours = $request->total_hours[$i];
                $invoice_details->rate_hour = $request->rate_hour[$i];
                $invoice_details->total_price = $request->total_amount[$i];
                $invoice_details->vat = $request->vat[$i];
                $invoice_details->vat_amount = $request->vat_amount[$i];
                $invoice_details->grand_price = $request->grand_amount[$i];
                $invoice_details->save();
            }
            

            if($request->bank_name){
                $invoice->payments()->delete();
                $invoice_payment = new PaymentDetails();
                $invoice_payment->invoice_id = $invoice->id;
                $invoice_payment->customer_id = $request->customer_id;
                $invoice_payment->account_number = $request->account_number;
                $invoice_payment->iban = $request->iban;
                $invoice_payment->bank_name  = $request->bank_name;
                $invoice_payment->paid_amount  = $request->final_grand_amount;
                $invoice_payment->save();
            }

            return redirect()->route('invoice.show',$invoice->id);
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
        return view('invoice.delete',compact('id'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        if(Invoice::find($id)->delete()){
            return response()->json(['success' => 'Invoice deleted successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }


    // extra method 

    public function change_status(Request $request, $id)
    {
        $input = $request->only(['status']);
        if(Invoice::find($id)->update($input)){
            return response()->json(['success' => 'Invoice Status changed successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        foreach($ids as $id){
            if($id != null){
                Invoice::find($id)->delete();
            }else{
                return response()->json(['error' => 'Someting went to wrong. please try again!']);
            }
        }

        return response()->json(['success' => 'Invoice deleted successfully done!']);
    }

    public function export($customer_id,$month,$invoice_id) 
    {
        return Excel::download(new InvoiceExport($customer_id, $month, $invoice_id), 'invoices.xlsx');
    }


    public function pdf($invoice_id) 
    {
        $invoice = Invoice::find($invoice_id);
        $data['invoice_details'] = $invoice->details;
        $data['customer'] = $invoice->customer;
        $data['payment'] = $invoice->payments()->first();
        $data['invoice'] = $invoice;

        $n = new NumberToWord();
        $total_amount_in_word = $n->convert($invoice->grand_total, get_system_setting()->currency_code);
        $data['total_amount_in_word'] = $total_amount_in_word;

        $qr_code_text = $this->zatca_qr_text(get_system_title(),get_system_setting()->vat_number,$invoice->invoice_date,$invoice->grand_total,$invoice->vat_total);
        $data['qr_code_text'] = $qr_code_text;

        $body = view('pdf.invoice')
        ->with($data)
        ->render();

        $mpdf = new \Mpdf\Mpdf([
                // 'tempDir' => public_path('uploads/temp'), 
                'mode' => 'utf-8', 
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
                'autoVietnamese' => true,
                'autoArabic' => true,
                'margin_top' => 8,
                'margin_bottom' => 8,
                'format' => 'A4'
            ]);
            
            // $stylesheet = file_get_contents(asset('css/app.css'));
        
            $mpdf->useSubstitutions=true;
            // $mpdf->SetWatermarkText($receipt_details->business_name, 0.1);
            // $mpdf->showWatermarkText = true;
            $mpdf->SetTitle('INVOICE-'.$invoice->customer->name.' Pdf of '.$invoice->invoice_month.'.pdf');
            
            // $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($body);
            return $mpdf->Output('pdf/INVOICE-'.$invoice->customer->name.'Invoice Pdf of '.$invoice->invoice_month.'.pdf', 'D');

        // $pdf = Pdf::loadView('pdf.invoice', $data);
        // $pdf->add_info('Title', $invoice->customer->name.'Invoice Pdf of'.$invoice->invoice_month);
        // return $pdf->download($invoice->customer->name.'Invoice Pdf of '.$invoice->invoice_month.'-invoice.pdf');
    }
}
