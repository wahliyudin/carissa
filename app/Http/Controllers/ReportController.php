<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function datatable()
    {
        $data = Purchase::query()->with(['product', 'supplier'])->get();
        return DataTables::of($data)
            ->editColumn('product', function (Purchase $purchase) {
                return $purchase->product?->name;
            })
            ->editColumn('supplier', function (Purchase $purchase) {
                return $purchase->supplier?->name;
            })
            ->editColumn('price', function (Purchase $purchase) {
                return number_format($purchase->product?->price, 0, ',', '.');
            })
            ->editColumn('quantity', function (Purchase $purchase) {
                return $purchase->quantity;
            })
            ->editColumn('status', function (Purchase $purchase) {
                return $purchase->status->badge();
            })
            ->editColumn('status_approv', function (Purchase $purchase) {
                return $purchase->status_approv->badge();
            })
            ->rawColumns(['action', 'status', 'status_approv'])
            ->make();
    }
}
