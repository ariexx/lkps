<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use function Laravel\Prompts\error;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const superadmin = 'superadmin', adminprodi = 'admin_prodi', dosen = 'dosen', prodi = 'prodi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function checkLogin($username, $password): array|User|null
    {
        $user = User::where('username', $username)->first();
        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }

        return null;
    }

    public function redirectDashboard()
    {
        $role = session('user')->role;
        return match ($role) {
            self::superadmin => redirect()->route('superadmin.dashboard'),
            self::adminprodi => redirect()->route('admin-prodi.dashboard'),
            self::dosen => redirect()->route('dosen.dashboard'),
            self::prodi => redirect()->route('kepala-prodi.dashboard'),
            default => redirect('/login'),
        };
    }

    public function isAdmin()
    {
        return session('user')->role === self::superadmin || session('user')->role === self::adminprodi;
    }

    public function isDosen()
    {
        return session('user')->role === self::dosen;
    }

    public function isProdi()
    {
        return session('user')->role === self::prodi;
    }

    public function isSuperadmin()
    {
        return session('user')->role === self::superadmin;
    }

    public function isAdminProdi()
    {
        return session('user')->role === self::adminprodi;
    }
}
