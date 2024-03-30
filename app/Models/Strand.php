<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strand extends Model
{
    use HasFactory;

    protected $table = 'strands';
    protected $primaryKey = 'strand_id';
    protected $fillable = [
        'strand'
    ];
}
