<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

    protected $fillable = [
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
        return $this->belongsTo(Category::class);
    }

    public function colocation(){
        return $this->belongsTo(Colocation::class , 'colocation_id');
    }
}



