<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;

class DesignationController extends Controller
{
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(request()->ajax()){
            $designations = Designation::query();
            return DataTables::of($designations)
            ->addColumn('checkbox', function($designation){
                $html = '<input type="checkbox" name="selected_item" class="form-checked checkbox" value="'.$designation->id.'" />';
                return $html;
            })
            ->addColumn('status',function($designation){
                $btn = 'btn-success';
                if($designation->status == 0){
                    $btn = 'btn-danger';
                }
                $html = '<select class="btn btn-sm change-status '.$btn.'" data-url="'.route('designation.change_status',$designation->id).'">
                            <option value="1" '.($designation->status == 1 ? "selected" : "").'>Active</option>
                            <option value="0" '.($designation->status == 0 ? "selected" : "").'>Inative</option>
                        </select>';
                return $html;        
            })
            ->editColumn('updated_at',function($designation){
                return  get_system_date_time_format($designation->updated_at);
            })
            ->addColumn('action',function($designation){
                $html = '<div class="btn-group">';
                $html .= '<button data-url="'.route('designation.edit',$designation->id).'" class="btn btn-primary btn-sm show-modal">Edit</button>';
                $html .= '<button data-url="'.route('designation.delete',$designation->id).'" class="btn btn-danger btn-sm show-modal">Delete</button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['checkbox','title','title_arabic','description','status','updated_at','action'])
            ->toJson();
        }
        return view('designation.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('designation.create');
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
            "title" => "required | min:2 | unique:designations,title",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

    
            if(Designation::create($input)){
                return response()->json(['success' => 'Designation created successfully done!']);

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
        return view('designation.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return view('designation.edit',compact('designation'));
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
            "title" => "required | min:2 | unique:designations,title,$id",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

    
            if(Designation::find($id)->update($input)){
                return response()->json(['success' => 'Designation updated successfully done!']);

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
        return view('designation.delete',compact('id'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        if(Designation::find($id)->delete()){
            return response()->json(['success' => 'Designation deleted successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }


    // extra method 

    public function change_status(Request $request, $id)
    {
        $input = $request->only(['status']);
        if(Designation::find($id)->update($input)){
            return response()->json(['success' => 'Designation Status changed successfully done!']);

        }else{
            return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
        }
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        foreach($ids as $id){
            if($id != null){
                Designation::find($id)->delete();
            }else{
                return response()->json(['error' => 'Someting went to wrong. please try again!']);
            }
        }

        return response()->json(['success' => 'Designation deleted successfully done!']);
    }
}
