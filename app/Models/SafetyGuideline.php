<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyGuideline extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category', // Add this line
    ];
}
