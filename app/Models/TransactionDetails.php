<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function order()
{
    return $this->belongsTo(Transaction::class, 'order_id', 'id');
}


    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
