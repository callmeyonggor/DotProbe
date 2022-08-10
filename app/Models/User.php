<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'is_admin',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function get_record($search, $perpage)
    {
        $user = User::query();

        if (@$search['freetext']) {
            $freetext = $search['freetext'];
            $user = $user->where('users.name', 'like', '%' . $freetext . '%');
        }

        $user->when(@$search['role'], function ($q) use ($search) {
            switch ($search['role']) {
                case 1:
                    $q->where('users.is_admin', '=', 0);
                    break;
                case 2:
                    $q->where('users.is_admin', '=', 1);
                    break;
            }
        });

        $user->when(@$search['sort'], function ($q) use ($search) {
            switch ($search['sort']) {
                case 1:
                    $q->orderBy('created_at', 'ASC');
                    break;
                case 2:
                    $q->orderBy('created_at', 'DESC');
                    break;
            }
        });
        $user->orderBy('created_at', 'ASC');
        return $user->paginate($perpage);
    }
    // Relatiobships
    public function attempt()
    {
        return $this->hasMany(Attempt::class, 'user_id');
    }

    public function result()
    {
        return $this->hasMany(Result::class, 'user_id');
    }
}
