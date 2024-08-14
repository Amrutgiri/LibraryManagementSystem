<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gener extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'geners';
    protected $fillable = [
        'name',
        'serial_no',
        'status',
        'slug',
    ];
}
