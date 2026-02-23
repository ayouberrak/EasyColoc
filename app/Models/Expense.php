<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'id',
        'titre',
        'amount',
        'date',
        'category_id',
        'user_id',
        'colocation_id'
    ];

    public function payer(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function colocation(){
        return $this->belongsTo(Colocation::class , 'colocation_id');
    }
}



