<?php

namespace App\Models;

use App\Models\Gener;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'name',
        'total_pages',
        'price',
        'language',
        'department',
        'rack',
        'classification_no',
        'auther',
        'publication',
        'publish_date',
        'isbn',
        'genre',
        'notes',
        'number_of_copy',
        'image',
        'document',
        'status',

    ];

    public function lang()
    {
        return $this->belongsTo(Language::class, 'language', 'id');
    }
    public function gen()
    {
        return $this->belongsTo(Gener::class, 'genre', 'id');
    }
}
