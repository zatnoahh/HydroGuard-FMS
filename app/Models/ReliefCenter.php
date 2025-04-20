<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReliefCenter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'capacity', 'service', 'contact_info'];
}
