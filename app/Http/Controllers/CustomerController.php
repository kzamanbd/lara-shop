<?php

namespace App\Http\Controllers;

use App\Customer;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Billing;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:customer');

    }
    public function index(){
        $orders = Order::where('customer_id', Auth::guard('customer')->id())->get();
    	return view('customer.dashboard',['orders' => $orders]);
    }

    public function editProfileForm(){
        return view('customer.profile-edit');
    }


    public function customerProfile(){
        dd(Customer::where('id', Auth::guard('customer')->id())->first());
    }


    public function profileSave(Request $request){

        $this->validate($request,[
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'address'     => 'required|string',
            'phone'=> 'required|string|max:14|unique:c_profiles',
            'zip_code'    => 'required|string',
        ]);

        CProfile::insert([
        	'user_id' 	=> Auth::user()->id,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'address' 	=> $request->address,
            'phone'=> $request->phone,
            'zip_code' 	=> $request->zip_code,
            'created_at'=> Carbon::now(),
        ]);
        $request->session()->flash('status', 'Profile Inserted Successfully');
    	return back();
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'address'     => 'required|string',
            'phone'=> 'required|string|max:14',
            'zip_code'    => 'required|string',
        ]);

        CProfile::where('user_id', Auth::user()->id)->update([
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'address'   => $request->address,
            'phone'=> $request->phone,
            'zip_code'  => $request->zip_code,
            'updated_at'=> Carbon::now(),
        ]);
        $request->session()->flash('status', 'Profile Updated Successfully');
        return back();
    }

    public function orderDetails($id){
        $orderDetails = Shipping::with('order')->findOrfail($id);
        return view('customer.order-details',[
            'orderDetails' => $orderDetails,
        ]);

    }
    public function orderCancel($id){
        $shipping_id = Order::findOrfail($id)->shipping_id;
        Shipping::findOrfail($shipping_id)->delete();
        Order::findOrfail($id)->delete();

        $billings =  Billing::where('order_id', $id)->get();
        foreach ($billings as $billing) {
            Billing::where('order_id', $id)->delete();
        }

        session()->flash('status', 'Order Successfully Canceled, Your Order Id has '.$shipping_id);
        return back();
        
    }
}
