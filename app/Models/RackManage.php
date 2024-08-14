<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RackManage extends Model
{
    use HasFactory, softDeletes;

    protected $table="rack_manages";

    protected $fillable = ['name','serial_no','notes','status'];
}
