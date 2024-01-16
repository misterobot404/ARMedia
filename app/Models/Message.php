<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'receiver_user_id',
        'sender_user_id',
        'readed_by_receiver',
    ];

    public function receiver() : BelongsTo {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }

    public function sender() : BelongsTo {
        return $this->belongsTo(User::class, 'sender_user_id');
    }
}
