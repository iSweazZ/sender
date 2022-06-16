<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class createMessages extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'date'
    ];
}
