<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreRequest;
use App\Models\Supplier;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.index');
    }

    public function datatable()
    {
        $data = Supplier::query()->get();
        return DataTables::of($data)
            ->editColumn('name', function (Supplier $supplier) {
                return $supplier->name;
            })
            ->editColumn('phone_number', function (Supplier $supplier) {
                return $supplier->phone_number;
            })
            ->editColumn('address', function (Supplier $supplier) {
                return $supplier->address;
            })
            ->editColumn('action', function (Supplier $supplier) {
                return view('supplier.action', compact('supplier'));
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function store(StoreRequest $request)
    {
        try {
            Supplier::query()->updateOrCreate([
                'id' => $request->key
            ], [
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
            return response()->json([
                'message' => 'Berhasil di simpan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Supplier $supplier)
    {
        try {
            return response()->json($supplier->only(['id', 'name', 'phone_number', 'address']));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return response()->json([
                'message' => "Berhasil dihapus"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
