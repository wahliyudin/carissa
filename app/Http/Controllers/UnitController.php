<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\StoreRequest;
use App\Models\Unit;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function index()
    {
        return view('unit.index');
    }

    public function datatable()
    {
        $data = Unit::query()->get();
        return DataTables::of($data)
            ->editColumn('name', function (Unit $unit) {
                return $unit->name;
            })
            ->editColumn('action', function (Unit $unit) {
                return view('unit.action', compact('unit'));
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function store(StoreRequest $request)
    {
        try {
            Unit::query()->updateOrCreate([
                'id' => $request->key
            ], [
                'name' => $request->name,
            ]);
            return response()->json([
                'message' => 'Berhasil di simpan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Unit $unit)
    {
        try {
            return response()->json($unit->only(['id', 'name']));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Unit $unit)
    {
        try {
            $unit->delete();
            return response()->json([
                'message' => "Berhasil dihapus"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
