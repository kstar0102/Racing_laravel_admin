<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IllegalWord extends Model
{
    use HasFactory;
    protected $table = "illegal_words";
}
