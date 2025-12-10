<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'total',
        'status',
        'stripe_session_id',
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
    
}
