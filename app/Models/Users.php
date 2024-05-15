<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //validation data 
    protected $table = 'user';
    protected $fillable = ['adress_user', 'password_user'];
}
