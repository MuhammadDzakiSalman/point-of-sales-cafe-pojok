<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'metode_pembayaran',
        'total',
        'estimasi',
        'status',
        'menunggu',
        'diproses',
        'selesai',
        'qr_code'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'estimasi' => 'datetime',
        'menunggu' => 'datetime',
        'diproses' => 'datetime',
        'selesai' => 'datetime',
        'konfirmasi' => 'datetime',
    ];
    
    public function transactionDetails()
{
    return $this->hasMany(TransactionDetails::class, 'order_id', 'id');
}


    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetails::class, 'order_id');
    }
}
