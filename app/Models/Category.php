<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable =[
        'name',
        'colocation_id'
    ];

    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }


    public function expence(){
        return $this->hasMany(Expense::class);
    }
}
