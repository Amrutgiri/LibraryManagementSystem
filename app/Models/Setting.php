<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
        'max_day_limit',
        'send_after_mail',
        'send_before_mail',
        'form_email',
        'fine_amount',
    ];

}
