<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_resetpassword extends Model
{
    use HasFactory;
    protected $table='admin_resetpasswords';
    protected $fillable=[
        'username',
        'email',
        'address',
        'city',
        'contact_num'
    ];
}
