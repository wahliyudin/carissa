<?php

namespace App\Http\Controllers;

use App\Enums\Purchase\Status;
use App\Enums\Purchase\StatusApprov;
use App\Events\SendCommentEvent;
use App\Http\Requests\Purchase\StoreRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            ->editColumn('action', function (Purchase $purchase) {
                return view('purchase.action', compact('purchase'));
            })
            ->rawColumns(['action', 'status', 'status_approv'])
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
            $purchase->comments()->delete();
            $purchase->delete();
            return response()->json([
                'message' => "Berhasil dihapus"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function comment(Purchase $purchase)
    {
        $purchase->load(['product', 'supplier', 'comments.user']);
        return view('purchase.comment', [
            'purchase' => $purchase
        ]);
    }

    public function send(Purchase $purchase, Request $request)
    {
        try {
            $comment = $purchase->comments()->create([
                'user_id' => auth()->user()->id,
                'content' => $request->message,
            ]);
            return response()->json([
                'user' => auth()->user()->name,
                'time' => Carbon::make($comment->created_at)->format("H:i"),
                'content' => $comment->content,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        // event(new SendCommentEvent([
        //     'message' => $comment->content
        // ]));
    }

    public function approv(Purchase $purchase)
    {
        try {
            $purchase->update([
                'status' => Status::DIPESAN,
                'status_approv' => StatusApprov::SETUJU
            ]);
            return response()->json([
                'message' => 'Berhasil Diverifikasi.'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reject(Purchase $purchase)
    {
        try {
            $purchase->update([
                'status_approv' => StatusApprov::TOLAK
            ]);
            return response()->json([
                'message' => 'Berhasil ditolak.'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function diterima(Purchase $purchase)
    {
        try {
            $purchase->update([
                'status' => Status::DITERIMA
            ]);
            return response()->json([
                'message' => 'Berhasil diterima.'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
