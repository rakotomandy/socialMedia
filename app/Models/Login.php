<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Eloquent model representing an authenticated `login` user in the chat app.
 *
 * Notes:
 * - The model extends `Authenticatable` so it can be used with Laravel guards.
 * - The underlying table is `login` (configured via `$table`).
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password Hashed password
 */
class Login extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'login';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Return model attribute casts.
     *
     * Note: Laravel typically uses a `$casts` property. This method
     * provides the same information for readers and IDEs — keep or
     * convert to `$casts` if you prefer the property-based approach.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
