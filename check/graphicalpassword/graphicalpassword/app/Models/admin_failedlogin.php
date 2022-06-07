<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_failedlogin extends Model
{
    use HasFactory;
    protected $table='admin_failedlogins';
    protected $fillable=[
        'username',
        'email',
        'address',
        'city',
        'contact_num',
        'failed_attempts'
    ];
}
