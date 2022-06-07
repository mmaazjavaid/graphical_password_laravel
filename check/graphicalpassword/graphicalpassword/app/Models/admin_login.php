<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_login extends Model
{
    use HasFactory;
    protected $table='admin_logins';
    protected $fillable=[
        'username',
        'email',
        'address',
        'city',
        'contact_num'
    ];
}
