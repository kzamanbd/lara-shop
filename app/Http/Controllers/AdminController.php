<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Image;
use Toastr;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Billing;
use App\Models\Category;
use App\Models\Shipping;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        $orders = Order::take(4)->orderBy('id', 'DESC')->get();
        Toastr::success(Auth::user()->name.' You Are Login', 'Welcome', ["positionClass" => "toast-top-right"]);
        return view('backend.dashboard',['orders' => $orders]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderManage(){
        $orders = Shipping::with('customer')->get();
        return view('backend.order-manage',['orders' => $orders]);
    }


    public function orderDetails($id){

        $orderDetails = Shipping::with('order')->findOrfail($id);
        if ($orderDetails->status == 0){
            Shipping::where('id', $id)->update([
                'status' => 1
            ]);
        }
        return view('backend.order-details',[
            'orderDetails' => $orderDetails,
        ]);


    }


    public function orderInvoices($id){
        
        $check_order = Shipping::where('id', $id)->exists();
        if($check_order){
            $order_details = Shipping::where('id', $id)->first();
            $sale_details = Sale::where('shipping_id', $id)->first();
            $pdf = PDF::loadView('invoices.order-invoices', ['order_details' => $order_details, 'sale_details' => $sale_details]);
            return $pdf->stream();
        }
        else{
            return back();
        }
    }
}
