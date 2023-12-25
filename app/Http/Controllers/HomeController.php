<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Person; 
use App\Models\Invoice; 
use App\Models\Customer; 
use App\Models\Designation; 
use Illuminate\Http\Request;
use App\Models\ManPowerSupply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_person = Person::count();
        $total_designation = Designation::count();
        $total_invoice_amount = Invoice::sum('grand_total');
        $total_customer = Customer::count();

        $top_customers = Customer::withCount('man_power_supplies')->orderBy('man_power_supplies_count', 'desc')->limit(10)->get();
        $latest_man_supplies = ManPowerSupply::latest()->limit(10)->get();

        return view('home',compact('total_person','total_designation','total_invoice_amount','total_customer', 'top_customers','latest_man_supplies'));
    }


    public function english_to_arabic(Request $request)
    {
        $text = $request->get('text');
        return response()->json(get_english_to_arabic($text));
    }


    public function settings(){
        $user = auth()->user();
        return view('settings',compact('user'));
    }


    public function profile_update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required | min:2",
            "email" => "required | email | unique:users,email",
        ]);

        $input = $request->except('_token');

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

            
            if(User::find(auth()->id())->update($input)){
                return response()->json(['success' => 'Profile Update successfully done!']);

            }else{
                return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
            }
        }
    }


    public function password_update(Request $request)
    {

        
        $validator = Validator::make($request->all(),[
            "password" => "required | min:6 | confirmed",
        ]);

   
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{

            
            if(User::find(auth()->id())->update([
                'password' => Hash::make($request->password)
            ])){
                return response()->json(['success' => 'Password Update successfully done! Now You Can logout and login with new password']);

            }else{
                return response()->json(['error' => 'Data Does not insert.someting went to wrong. please try again!']);
            }
        }
    }
}
