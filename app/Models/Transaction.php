<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'book_id', 'quantity', 'total_price']; // Sesuaikan dengan kolom yang ada

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
