<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    /**
     * Get the fitCards for the user.
     */
    public function fitCards()
    {
        return $this->hasMany(FitCard::class);
    }

    /**
     * Get user activities
     *
     */
    public function activities()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
