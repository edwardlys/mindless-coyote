<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
    ];
}
