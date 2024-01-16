<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;

class Place extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'objects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'owner_user_id',
        'title',
        'description',
        'rating',
        'coordinates',
        'address',
        'address_comment',
        'inventory',
        'benefits',
        'hour_price',
        'minimal_autodeal_rating',
        'schedule',
        'show_price_for_authorised_only',
        'gallery',
        'moderated',
        'panorama_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Возможность автоматического заключения сделки
     */
    public function getAutodealAttribute()
    {
        return $this->minimal_autodeal_rating !== null;
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($place) {
            // При удалении карты удалять все загруженные медиа ресурсы
            foreach (json_decode($place->gallery) as $image_url) {
                if (File::exists(public_path($image_url))) {
                    File::delete(public_path($image_url));
                }
            }
            if (File::exists(public_path($place->panorama_url))) {
                File::delete(public_path($place->panorama_url));
            }
        });
    }
}
