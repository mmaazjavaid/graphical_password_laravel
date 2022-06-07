<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class password_check extends Model
{
    use HasFactory;
    protected $table='password_checks';
    protected $fillable=[
        'img'
    ];
}
