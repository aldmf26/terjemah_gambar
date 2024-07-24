<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function bookStock() {
        return $this->hasOne(BookStock::class, 'book_id', 'id');
    }

    public function category() {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function rack() {
        return $this->belongsTo(Rak::class, 'rack_id', 'id');
    }

}
