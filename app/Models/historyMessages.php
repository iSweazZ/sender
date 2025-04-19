<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class historyMessages extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'createAt',
        'sendAt',
        'discordError',
        'slackError',
        'user_id'
    ];
    public function getHistoryMessage()
    {
        return $this->hasMany(User::class);
    }
}
