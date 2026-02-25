<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'colocation_id',
        'payer_id',
        'credit',
        'paid_at'
    ];


    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }


    public function payer(){
        return $this->belongsTo(User::class, 'payer_id');
    }
}
