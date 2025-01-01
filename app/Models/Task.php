<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'long_description'];

    // 也可以反过来，只写以下，但是更危险，因为默认其他是可填
    // protected $guarded = ['password']
}
