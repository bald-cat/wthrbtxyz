<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class TelegramUser extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'chat_id',
        'language_code',
        'name',
        'last_request_at',
        'request_count'
    ];
}
