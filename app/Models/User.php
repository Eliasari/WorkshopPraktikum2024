<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_user',
        'username',
        'password',
        'email',
        'no_hp',
        'wa',
        'pin',
        'id_jenis_user',
        'status_user',
        'delete_mark',
        'create_by',
        'create_at',
        'update_by',
        'update_at'
    ];

    public function postings()
    {
        return $this->hasMany(Posting::class, 'sender', 'id_user');
    }
    
    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user', 'id_jenis_user');
    }

    // public function menus()
    // {
    //     return $this->belongsToMany(Menu::class, 'setting_menu_user', 'id_jenis_user', 'menu_id');
    // }

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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
