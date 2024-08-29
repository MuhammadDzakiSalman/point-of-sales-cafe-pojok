<?php

namespace App\Models;

use App\Models\TransactionDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_menu',
        'harga',
        'gambar',
        'waktu_pembuatan',
        'kategori',
        'status',
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetails::class);
    }
}
