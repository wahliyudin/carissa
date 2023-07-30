<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;
use App\Models\Unit;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'units' => Unit::query()->get()
        ]);
    }

    public function datatable()
    {
        $data = Product::query()->with('unit')->get();
        return DataTables::of($data)
            ->editColumn('name', function (Product $product) {
                return $product->name;
            })
            ->editColumn('price', function (Product $product) {
                return number_format($product->price, 0, ',', '.');
            })
            ->editColumn('unit', function (Product $product) {
                return $product->unit?->name;
            })
            ->editColumn('action', function (Product $product) {
                return view('product.action', compact('product'));
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function store(StoreRequest $request)
    {
        try {
            Product::query()->updateOrCreate([
                'id' => $request->key
            ], [
                'name' => $request->name,
                'price' => str($request->price)->replace('.', '')->value(),
                'unit_id' => $request->unit_id,
            ]);
            return response()->json([
                'message' => 'Berhasil di simpan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Product $product)
    {
        try {
            return response()->json($product->only([
                'id',
                'name',
                'price',
                'unit_id',
            ]));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                'message' => "Berhasil dihapus"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
