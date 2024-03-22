<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;

    protected $table = 'login_histories';
    protected $primaryKey = 'login_history_id';
    protected $fillable = [
        'student_id'
    ];
}
