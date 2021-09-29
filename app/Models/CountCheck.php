<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CountCheck extends Model
{
    use HasFactory;
    public $timestamps  = false;
    protected $fillable = [
        'is_scraped',
    ];
}
