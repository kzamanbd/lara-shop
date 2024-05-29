<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $orders = Order::take(4)->orderBy('id', 'DESC')->get();
            Session::flash('success', auth()->user()->name . ' You Are Login');
            return view('backend.dashboard', ['orders' => $orders]);
        }

        $orders = Order::where('customer_id', auth()->id())->get();
        return view('customer.dashboard', ['orders' => $orders]);
    }
}
