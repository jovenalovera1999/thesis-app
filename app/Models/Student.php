<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
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
        'password'
    ];
    protected $hidden = ['password'];
}
