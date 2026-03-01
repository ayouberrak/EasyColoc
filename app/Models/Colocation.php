<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'colocation_id',
        'name',
        'description',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];


    public function members()
    {
        return $this->hasMany(ColocationMember::class)->where('left_at', null);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}



