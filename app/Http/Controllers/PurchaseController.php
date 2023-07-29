<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StoreRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('purchase.index', [
            'products' => Product::query()->get(),
            'suppliers' => Supplier::query()->get(),
        ]);
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
                return $purchase->product?->price;
            })
            ->editColumn('quantity', function (Purchase $purchase) {
                return $purchase->quantity;
            })
            ->editColumn('action', function (Purchase $purchase) {
                return view('purchase.action', compact('purchase'));
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function store(StoreRequest $request)
    {
        try {
            Purchase::query()->updateOrCreate([
                'id' => $request->key
            ], [
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'quantity' => str($request->quantity)->replace('.', ''),
            ]);
            return response()->json([
                'message' => 'Berhasil di simpan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Purchase $purchase)
    {
        try {
            return response()->json($purchase->only(['id', 'supplier_id', 'product_id', 'quantity']));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Purchase $purchase)
    {
        try {
            $purchase->delete();
            return response()->json([
                'message' => "Berhasil dihapus"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
