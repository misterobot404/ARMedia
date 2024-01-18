<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class Album extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'albums';

    protected $guarded = [];
}
