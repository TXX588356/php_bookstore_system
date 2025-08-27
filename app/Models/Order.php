<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id', 'total_amount', 'purchase_at'];

    public function orderBooks()
    {
        return $this->hasMany(OrderBook::class);
    }
}
