<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class password extends Model
{
    use HasFactory;
    protected $table='passwords';
    protected $fillable=[
        'username',
        'email',
        'img',
        'address',
        'city',
        'contact_num'
    ];
}
