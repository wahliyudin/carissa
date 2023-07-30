<?php

namespace App\Models;

use App\Enums\Purchase\Status;
use App\Enums\Purchase\StatusApprov;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'status',
        'status_approv',
    ];

    protected $casts = [
        'status' => Status::class,
        'status_approv' => StatusApprov::class,
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
