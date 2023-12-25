<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(request()->ajax()){
            $customers = Customer::query();
            return DataTables::of($customers)
            ->addColumn('checkbox', function($customer){
                $html = '<input type="checkbox" name="selected_item" class="form-checked checkbox" value="'.$customer->id.'" />';
                return $html;
            })
            ->addColumn('status',function($customer){
                $btn = 'btn-success';
                if($customer->status == 0){
                    $btn = 'btn-danger';
                }
                $html = '<select class="btn btn-sm change-status '.$btn.'" data-url="'.route('customer.change_status',$customer->id).'">
                            <option value="1" '.($customer->status == 1 ? "selected" : "").'>Active</option>
                            <option value="0" '.($customer->status == 0 ? "selected" : "").'>Inative</option>
                        </select>';
                return $html;        
            })
       
            ->editColumn('name',function($customer){
                return  $customer->name.' -- '.$customer->name_arabic;
            })
           
            ->editColumn('updated_at',function($person){
                return  get_system_date_time_format($person->updated_at);
            })
            ->addColumn('action',function($customer){
                $html = '<div class="btn-group">';
                $html .= '<button data-url="'.route('customer.show',$customer->id).'" class="btn btn-info btn-sm show-modal">Show</button>';
                $html .= '<button data-url="'.route('customer.edit',$customer->id).'" class="btn btn-primary btn-sm show-modal">Edit</button>';
                $html .= '<button data-url="'.route('customer.delete',$customer->id).'" class="btn btn-danger btn-sm show-modal">Delete</button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['checkbox','name','phone','email','address','vat_number','status','updated_at','action'])
            ->toJson();
        }
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer.create');
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
            "name" => "required | min:2",
            "phone" => "required",
            "address" => "required",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

    
            if(Customer::create($input)){
                return response()->json(['success' => 'Customer created successfully done!']);

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
        $customer = Customer::findOrFail($id);
        return view('customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit',compact('customer'));
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
            "name" => "required | min:2",
            "phone" => "required",
            "address" => "required",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

    
            if(Customer::find($id)->update($input)){
                return response()->json(['success' => 'Customer updated successfully done!']);

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
        return view('customer.delete',compact('id'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        if(Customer::find($id)->delete()){
            return response()->json(['success' => 'Customer deleted successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }


    // extra method 

    public function change_status(Request $request, $id)
    {
        $input = $request->only(['status']);
        if(Customer::find($id)->update($input)){
            return response()->json(['success' => 'Customer Status changed successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        foreach($ids as $id){
            if($id != null){
                Customer::find($id)->delete();
            }else{
                return response()->json(['error' => 'Someting went to wrong. please try again!']);
            }
        }

        return response()->json(['success' => 'Customer deleted successfully done!']);
    }
}
