<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'qty', 'harga', 'harga_akhir'];

    protected $casts = ['qty' => 'integer', 'harga' => 'decimal:2', 'harga_akhir' => 'decimal:2'];

    public function user() { return $this->belongsTo(User::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
