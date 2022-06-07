<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newuser extends Model
{
    use HasFactory;
    protected $table='newusers';
    protected $fillable=[
        'username',
        'email',
        'img',
        'address',
        'city',
        'contact_num'
    ];
}
