<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deal extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'deals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object_owner_id',
        'customer_id',
        'object_id',
        'hour_price',
        'total_price',
        'starts_from',
        'ends_on',
        'confirmed',
    ];

    public function object() : BelongsTo {
        return $this->belongsTo(Place::class, 'object_id');
    }

    public function owner() : BelongsTo {
        return $this->belongsTo(User::class, 'object_owner_id');
    }

    public function customer() : BelongsTo {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
