<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBook extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ['order_id', 'book_id'];
    protected $fillable = ['order_id', 'book_id', 'quantity', 'unit_price'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
