<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'invoice', 'total', 'status', 'stripe_session_id', 'paid_at'];
    protected $casts = ['total' => 'decimal:2', 'paid_at' => 'datetime'];

    public function items() { return $this->hasMany(TransactionItem::class); }
    public function user() { return $this->belongsTo(User::class); }
}
