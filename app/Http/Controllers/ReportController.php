<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function datatable(Request $request)
    {
        $data = Purchase::query()->when($request->status, function ($query, $status) {
            $query->where('status', $status);
        })->when($request->status_approv, function ($query, $status_approv) {
            $query->where('status_approv', $status_approv);
        })->with(['product', 'supplier'])->get();
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

    public function export(Request $request)
    {
        try {
            return Pdf::loadView('report.pdf', [
                'purchases' => Purchase::query()->when($request->status, function ($query, $status) {
                    $query->where('status', $status);
                })->when($request->status_approv, function ($query, $status_approv) {
                    $query->where('status_approv', $status_approv);
                })->with(['product', 'supplier'])->get()
            ])->download();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
