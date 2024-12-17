<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;

    protected $table = 'book_issues';

    protected $fillable = [
        'book_id',
        'user_id',
        'issue_date',
        'return_date',
        'is_returned',
        'is_extended',
        'is_lost',
        'is_damage',
        'is_fine',
        'fine_amount',
        'remarks',
        'book_issue_count'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
