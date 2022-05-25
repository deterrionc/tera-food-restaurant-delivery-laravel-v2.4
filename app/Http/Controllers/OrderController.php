<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Order $model)
    {
        $orders = $model->get();
        return view('orders.index', ['orders' => $orders]);
    }
}
