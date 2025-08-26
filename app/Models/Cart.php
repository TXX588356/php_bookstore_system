<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ['user_id', 'book_id'];
    protected $fillable = ['user_id', 'book_id', 'quantity'];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    // Set the keys for save query (since the table is using composite keys)
    protected function setKeysForSaveQuery($query) {
        return $query->where([
            'user_id' => $this->getAttribute('user_id'),
            'book_id' => $this->getAttribute('book_id')
        ]);
    }
}
