<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLimit extends Model
{
    use HasFactory;

    protected $table = 'book_limits';
    protected $fillable = [
        'user_id',
        'max_day_limit',
        'max_book_limit',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
