<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::take(4)->orderBy('id', 'DESC')->get();
        Session::flash('success', Auth::user()->name . ' You Are Login');
        return view('backend.dashboard', ['orders' => $orders]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderManage()
    {
        $orders = Shipping::with('customer')->get();
        return view('backend.order-manage', ['orders' => $orders]);
    }


    public function orderDetails($id)
    {

        $orderDetails = Shipping::with('order')->findOrfail($id);
        if ($orderDetails->status == 0) {
            Shipping::where('id', $id)->update([
                'status' => 1
            ]);
        }
        return view('backend.order-details', [
            'orderDetails' => $orderDetails,
        ]);
    }


    public function orderInvoices($id)
    {

        $check_order = Shipping::where('id', $id)->exists();
        if ($check_order) {
            $order_details = Shipping::where('id', $id)->first();
            // $sale_details = Sale::where('shipping_id', $id)->first();
        } else {
            return back();
        }
    }
}
