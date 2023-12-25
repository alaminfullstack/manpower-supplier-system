<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Person;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ManPowerSupply;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ManPowerSupplyController extends Controller
{
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(request()->ajax()){
            
            if(request()->get('customr') && request()->get('status')){
                $man_power_supplies = ManPowerSupply::query()->with(['customer:id,name,name_arabic','person:id,name,name_arabic'])->where('customer_id',request()->get('customer'))->where('status', request()->get('status'));
            }elseif(request()->get('customer')){
                $man_power_supplies = ManPowerSupply::query()->with(['customer:id,name,name_arabic','person:id,name,name_arabic'])->where('customer_id',request()->get('customer'));
            }elseif(request()->get('status')){
                $man_power_supplies = ManPowerSupply::query()->with(['customer:id,name,name_arabic','person:id,name,name_arabic'])->where('status', request()->get('status'));
            }else{
                $man_power_supplies = ManPowerSupply::query()->with(['customer:id,name,name_arabic','person:id,name,name_arabic']);
            }

            return DataTables::of($man_power_supplies)
            ->addColumn('checkbox', function($man_power_supply){
                $html = '<input type="checkbox" name="selected_item" class="form-checked checkbox" value="'.$man_power_supply->id.'" />';
                return $html;
            })
            ->addColumn('status',function($man_power_supply){
                $btn = 'btn-success';
                if($man_power_supply->status == 0){
                    $btn = 'btn-danger';
                }
                $html = '<select class="btn btn-sm change-status '.$btn.'" data-url="'.route('man-power-supply.change_status',$man_power_supply->id).'">
                            <option value="1" '.($man_power_supply->status == 1 ? "selected" : "").'>Active</option>
                            <option value="0" '.($man_power_supply->status == 0 ? "selected" : "").'>Inative</option>
                        </select>';
                return $html;        
            })
            ->addColumn('customer',function($man_power_supply){
                return $man_power_supply->customer->name ?? null.' '.$man_power_supply->customer->name_arabic ?? null;
            })
            ->editColumn('person',function($man_power_supply){
                return   $man_power_supply->person->name ?? null.' '.$man_power_supply->person->name_arabic ?? null;
            })
            ->editColumn('supply_date',function($man_power_supply){
                return  get_system_date_time_format($man_power_supply->supply_date);
            })
            ->editColumn('total_amount',function($man_power_supply){
                return  get_system_currency_format($man_power_supply->total_amount);
            })
            ->editColumn('vat_amount',function($man_power_supply){
                return  get_system_currency_format($man_power_supply->vat_amount);
            })
            ->editColumn('grand_amount',function($man_power_supply){
                return  get_system_currency_format($man_power_supply->grand_amount);
            })
            ->editColumn('updated_at',function($man_power_supply){
                return  get_system_date_time_format($man_power_supply->updated_at);
            })
            ->addColumn('action',function($man_power_supply){
                $html = '<div class="btn-group">';
                $html .= '<button data-url="'.route('man-power-supply.edit',$man_power_supply->id).'" class="btn btn-primary btn-sm show-modal">Edit</button>';
                $html .= '<button data-url="'.route('man-power-supply.delete',$man_power_supply->id).'" class="btn btn-danger btn-sm show-modal">Delete</button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['checkbox','supply_date','customer','person','iqama_id','designation','total_hours','rate_hour','total_amount','vat','vat_amount','grand_amount','status','updated_at','action'])
            ->toJson();
        }

        $customers = Customer::select('id','name','name_arabic')->latest()->get();
        return view('man-power-supply.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $customers = Customer::select('id','name','name_arabic')->latest()->get();
        $persons = Person::with('designation:id,title')->select('id','name','name_arabic','designation_id')->latest()->get();
        return view('man-power-supply.create',compact('customers','persons'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            "customer_id" => "required",
            "people_id" => "required",
            "supply_date" => "required",
            "total_hours" => "required",
            "rate_hour" => "required",
            "vat" => "required",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

    
            if(ManPowerSupply::create($input)){
                return response()->json(['success' => 'Man Power Supply created successfully done!']);

            }else{
                return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('man-power-supply.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $man_power_supply = ManPowerSupply::findOrFail($id);
        $customers = Customer::select('id','name','name_arabic')->latest()->get();
        $persons = Person::with('designation:id,title')->select('id','name','name_arabic','designation_id')->latest()->get();
        return view('man-power-supply.edit',compact('man_power_supply','customers','persons'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            "customer_id" => "required",
            "people_id" => "required",
            "supply_date" => "required",
            "total_hours" => "required",
            "rate_hour" => "required",
            "vat" => "required",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

    
            if(ManPowerSupply::find($id)->update($input)){
                return response()->json(['success' => 'Man Power Supply updated successfully done!']);

            }else{
                return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
        return view('man-power-supply.delete',compact('id'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        if(ManPowerSupply::find($id)->delete()){
            return response()->json(['success' => 'Man power supply deleted successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }


    // extra method 

    public function change_status(Request $request, $id)
    {
        $input = $request->only(['status']);
        if(ManPowerSupply::find($id)->update($input)){
            return response()->json(['success' => 'Man Power Supply Status changed successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        foreach($ids as $id){
            if($id != null){
                ManPowerSupply::find($id)->delete();
            }else{
                return response()->json(['error' => 'Someting went to wrong. please try again!']);
            }
        }

        return response()->json(['success' => 'Man Power Supply deleted successfully done!']);
    }

    public function import(Request $request)
    {
        return view('man-power-supply.import');
    }


    public function import_store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "man_power_files" => "required|max:50000|mimes:xlsx,csv,xls",
        ]);
        
        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{
            if($request->hasFile('man_power_files')){
                $file = $request->file('man_power_files');

                $parsed_array = Excel::toArray([], $file);
                
                
                $imported_data = array_splice($parsed_array[0], 1);
                
                // dd($imported_data[0][0]);
                // dd(Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($imported_data[0][0]))->format('Y-m-d H:i:s'));

                $formated_data = [];
                $total_rows = count($imported_data);
                 
                $is_valid = true;
                $error_msg = '';
                
                DB::beginTransaction();
                
                foreach ($imported_data as $key => $value) {
                    $row_no = $key + 1;
                    $man_power_array = [];
                    
              
                    $supply_date = trim($value[0]);
                    if (!empty($supply_date)) {
                        $man_power_array['supply_date'] = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($supply_date))->format('Y-m-d H:i:s');
                    } else {
                        $is_valid =  false;
                        $error_msg = "Supply Date is required in row no. $row_no";
                        break;
                    }


                    $customer_name = trim($value[1]);
                    if (!empty($customer_name)) {
                        $customer = Customer::firstOrCreate(
                            ['name' => $customer_name]
                        );
                        $man_power_array['customer_id'] = $customer->id;
                    }else{
                        $is_valid =  false;
                        $error_msg = "Customer Name is required in row no. $row_no";
                        break;
                    }


                    $person_name = trim($value[2]);
                    if (!empty($person_name)) {
                        $person = Person::firstOrCreate(
                            ['name' => $person_name]
                        );
                        $man_power_array['people_id'] = $person->id;
                    }else{
                        $is_valid =  false;
                        $error_msg = "Person Name is required in row no. $row_no";
                        break;
                    }
                    
                    
                    
                    $person_iqama_id = trim($value[3]);
                    if (!empty($person_iqama_id)) {
                        $man_power_array['iqama_id'] = $person_iqama_id;
                    } else {
                        $is_valid =  false;
                        $error_msg = "Person Iqama id is required in row no. $row_no";
                        break;
                    }
               
                    
                    $designation = trim($value[4]);
                    if (!empty($designation)) {
                        $man_power_array['designation'] = $designation;
                    } else {
                        $man_power_array['designation'] = '';
                    }
                    
                    $total_hours = trim($value[5]);
                    if (!empty($total_hours)) {
                        $man_power_array['total_hours'] = $total_hours;
                    } else {
                        $is_valid =  false;
                        $error_msg = "Person Total Hours is required in row no. $row_no";
                        break;
                    }
                    

                    
                    $rate_hour = trim($value[6]);
                    if (!empty($rate_hour)) {
                        $man_power_array['rate_hour'] = $rate_hour;
                    } else {
                        $is_valid =  false;
                        $error_msg = "Rate Hours is required in row no. $row_no";
                        break;
                    }
                    
                    
                    
                    $total_amount = trim($value[7]);
                    if (!empty($total_amount)) {
                        $man_power_array['total_amount'] = $total_amount;
                    } else {
                        $man_power_array['total_amount'] = $total_hours*$rate_hour;
                    }
                    

                    $vat = trim($value[8]);
                    if (!empty($vat)) {
                        $man_power_array['vat'] = $vat;
                    } else {
                        $man_power_array['vat'] = get_system_setting()->default_vat;
                    }
                    
                    
                    $vat_amount = trim($value[9]);
                    if (!empty($vat_amount)) {
                        $man_power_array['vat_amount'] = $vat_amount;
                    } else {
                        $man_power_array['vat_amount'] = $total_amount*$vat/100;
                    }
                    
                    
                    $grand_amount = trim($value[10]);
                    if (!empty($grand_amount)) {
                        $man_power_array['grand_amount'] = $grand_amount;
                    } else {
                        $man_power_array['grand_amount'] = $total_amount+$vat_amount;
                    }
                    
                    
                    if(array_key_exists(11, $value)){
                        $status = trim($value[11]);
                        if (!empty($status)) {
                            $man_power_array['status'] = $status;
                        } else {
                            $man_power_array['status'] = 1;
                        }
                    }else{
                        $man_power_array['status'] = 1;
                    }
                    
                    
                     $formated_data[] = $man_power_array;
                    
                }
                
                if (!$is_valid) {
                    return response()->json(['errors' => $error_msg]);
                    // throw new \Exception($error_msg);
                }

                // dd($formated_data);
                
                
                if (!empty($formated_data)) {
                    foreach ($formated_data as $index => $product_data) {
                        ManPowerSupply::create($product_data);
                    } 
                }
                
                DB::commit();
                
                return response()->json(['success' => 'Man Power Supply imported successfully done!']);
            }else{
                return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
            }
        }

        
    }
}
