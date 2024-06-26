<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'full_name',
        'strand_id',
        'section_id',
        'teacher_id',
        'student_id_no',
        'password',
        'is_deleted'
    ];
    protected $hidden = ['password'];
}
