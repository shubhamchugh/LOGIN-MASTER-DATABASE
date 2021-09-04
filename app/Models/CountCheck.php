<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountCheck extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_scraped',
    ];
}
