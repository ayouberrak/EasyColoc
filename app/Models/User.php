<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'is_global_admin',
        'is_banned',
        'reputation'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function member(){
        return $this->hasMany(ColocationMember::class);
    }

    public function activeMember(){
        return $this->hasOne(ColocationMember::class)->whereNull('left_at');
    }

    public function ownedColocations()
    {
        return $this->hasOne(Colocation::class, 'user_id')->where('status', 'active');
    }

    public function isOwner()
    {
        return $this->ownedColocations()->exists();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
