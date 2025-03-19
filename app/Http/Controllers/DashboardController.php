<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // check current route is customer
        $user = auth()->user();
        if (request()->routeIs('customer') || $user->role == 'user') {
            $orders = Order::where('customer_id', auth()->id())->get();
            return view('customer.dashboard', ['orders' => $orders]);
        }

        if ($user->role == 'admin') {
            $orders = Order::take(4)->orderBy('id', 'DESC')->get();
            return view('backend.dashboard', ['orders' => $orders]);
        }
        return abort(403, 'Unauthorized');
    }
}