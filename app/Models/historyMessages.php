<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class historyMessages extends Model
{
    use HasFactory;

    public function getHistoryMessage()
    {
        return $this->hasMany(User::class);
    }
}
