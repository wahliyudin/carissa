<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

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
        return view('home', [
            'supplier' => Supplier::query()->get()->count(),
            'product' => Product::query()->get()->count(),
            'stock' => Stock::query()->get()->count(),
            'purchase' => Purchase::query()->get()->count(),
        ]);
    }
}
