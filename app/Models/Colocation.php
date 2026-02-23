<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = [
        'colocation_id',
        'name',
        'description',
        'status',
        'token',
        'created_at',
        'updated_at'
    ];


    public function members()
    {
        return $this->hasMany(ColocationMember::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
