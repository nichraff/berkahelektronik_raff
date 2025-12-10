<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
        'harga',
        'harga_akhir',
    ];

    // RELASI KE PRODUCT
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
