<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePersonRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Designation;

class PersonController extends Controller
{
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(request()->ajax()){
            $persons = Person::query();
            return DataTables::of($persons)
            ->addColumn('checkbox', function($person){
                $html = '<input type="checkbox" name="selected_item" class="form-checked checkbox" value="'.$person->id.'" />';
                return $html;
            })
            ->addColumn('status',function($person){
                $btn = 'btn-success';
                if($person->status == 0){
                    $btn = 'btn-danger';
                }
                $html = '<select class="btn btn-sm change-status '.$btn.'" data-url="'.route('currency.change_status',$person->id).'">
                            <option value="1" '.($person->status == 1 ? "selected" : "").'>Active</option>
                            <option value="0" '.($person->status == 0 ? "selected" : "").'>Inative</option>
                        </select>';
                return $html;        
            })
            ->addColumn('is_available',function($person){
                $btn = 'btn-success';
                if($person->is_available == 0){
                    $btn = 'btn-danger';
                }
                $html = '<select class="btn btn-sm change-status '.$btn.'" data-url="'.route('person.change_status',$person->id).'">
                            <option value="1" '.($person->is_available == 1 ? "selected" : "").'>Available</option>
                            <option value="0" '.($person->is_available == 0 ? "selected" : "").'>Not Available</option>
                        </select>';
                return $html;        
            })
            ->editColumn('name',function($person){
                return  $person->name.' -- '.$person->name_arabic;
            })
            ->editColumn('designation',function($person){
                return  $person->designation->title ?? null;
            })
            ->editColumn('updated_at',function($person){
                return  get_system_date_time_format($person->updated_at);
            })
            ->addColumn('action',function($person){
                $html = '<div class="btn-group">';
                $html .= '<button data-url="'.route('person.show',$person->id).'" class="btn btn-info btn-sm show-modal">Show</button>';
                $html .= '<button data-url="'.route('person.edit',$person->id).'" class="btn btn-primary btn-sm show-modal">Edit</button>';
                $html .= '<button data-url="'.route('person.delete',$person->id).'" class="btn btn-danger btn-sm show-modal">Delete</button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['checkbox','name','phone','email','address','designation','status','is_available','updated_at','action'])
            ->toJson();
        }
        return view('person.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $designations = Designation::select('id','title','title_arabic')->latest()->get();
        return view('person.create',compact('designations'));
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

    
            if(Person::create($input)){
                return response()->json(['success' => 'Person created successfully done!']);

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
        $person = Person::findOrFail($id);
        return view('person.show',compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $person = Person::findOrFail($id);
        $designations = Designation::select('id','title','title_arabic')->latest()->get();
        return view('person.edit',compact('person','designations'));
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

    
            if(Person::find($id)->update($input)){
                return response()->json(['success' => 'Person updated successfully done!']);

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
        return view('person.delete',compact('id'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        if(Person::find($id)->delete()){
            return response()->json(['success' => 'Person deleted successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }


    // extra method 

    public function change_status(Request $request, $id)
    {
        $input = $request->only(['status']);
        if(Person::find($id)->update($input)){
            return response()->json(['success' => 'Person Status changed successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        foreach($ids as $id){
            if($id != null){
                Person::find($id)->delete();
            }else{
                return response()->json(['error' => 'Someting went to wrong. please try again!']);
            }
        }

        return response()->json(['success' => 'Person deleted successfully done!']);
    }
}
