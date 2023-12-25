<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(request()->ajax()){
            $currencies = Currency::query();
            return DataTables::of($currencies)
            ->addColumn('checkbox', function($currency){
                $html = '<input type="checkbox" name="selected_item" class="form-checked checkbox" value="'.$currency->id.'" />';
                return $html;
            })
            ->addColumn('status',function($currency){
                $btn = 'btn-success';
                if($currency->status == 0){
                    $btn = 'btn-danger';
                }
                $html = '<select class="btn btn-sm change-status '.$btn.'" data-url="'.route('currency.change_status',$currency->id).'">
                            <option value="1" '.($currency->status == 1 ? "selected" : "").'>Active</option>
                            <option value="0" '.($currency->status == 0 ? "selected" : "").'>Inative</option>
                        </select>';
                return $html;        
            })
            ->editColumn('updated_at',function($currency){
                return  get_system_date_time_format($currency->updated_at);
            })
            ->addColumn('action',function($currency){
                $html = '<div class="btn-group">';
                $html .= '<button data-url="'.route('currency.edit',$currency->id).'" class="btn btn-primary btn-sm show-modal">Edit</button>';
                $html .= '<button data-url="'.route('currency.delete',$currency->id).'" class="btn btn-danger btn-sm show-modal">Delete</button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['checkbox','name','code','symbol','conversion_rate','status','updated_at','action'])
            ->toJson();
        }
        return view('currency.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('currency.create');
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
            "name" => "required | min:2 | unique:currencies,name",
            "code" => "required | unique:currencies,code",
            "symbol" => "required | max:36",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

    
            if(Currency::create($input)){
                return response()->json(['success' => 'Currency created successfully done!']);

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
        return view('currency.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('currency.edit',compact('currency'));
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
            "name" => "required | min:2 | unique:currencies,name,$id",
            "code" => "required | unique:currencies,code,$id",
            "symbol" => "required | max:36",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

    
            if(Currency::find($id)->update($input)){
                return response()->json(['success' => 'currency updated successfully done!']);

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
        return view('currency.delete',compact('id'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        if(Currency::find($id)->delete()){
            return response()->json(['success' => 'Currency deleted successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }


    // extra method 

    public function change_status(Request $request, $id)
    {
        $input = $request->only(['status']);
        if(Currency::find($id)->update($input)){
            return response()->json(['success' => 'Currency Status changed successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        foreach($ids as $id){
            if($id != null){
                Currency::find($id)->delete();
            }else{
                return response()->json(['error' => 'Someting went to wrong. please try again!']);
            }
        }

        return response()->json(['success' => 'Currency deleted successfully done!']);
    }
}
