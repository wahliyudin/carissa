<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stock\StoreRequest;
use App\Models\Product;
use App\Models\Stock;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
    public function index()
    {
        return view('stock.index', [
            'products' => Product::query()->get()
        ]);
    }

    public function datatable()
    {
        $data = Stock::query()->with('product')->get();
        return DataTables::of($data)
            ->editColumn('product', function (Stock $stock) {
                return $stock->product?->name;
            })
            ->editColumn('amount', function (Stock $stock) {
                return $stock->amount;
            })
            ->editColumn('action', function (Stock $stock) {
                return view('stock.action', compact('stock'));
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function store(StoreRequest $request)
    {
        try {
            Stock::query()->updateOrCreate([
                'id' => $request->key
            ], [
                'product_id' => $request->product_id,
                'amount' => str($request->amount)->replace('.', ''),
            ]);
            return response()->json([
                'message' => 'Berhasil di simpan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Stock $stock)
    {
        try {
            return response()->json($stock->only(['id', 'amount', 'product_id']));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Stock $stock)
    {
        try {
            $stock->delete();
            return response()->json([
                'message' => "Berhasil dihapus"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
