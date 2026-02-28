<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\ColocationMember;
use App\Models\Colocation;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('colocation.{id}', function ($user, $id) {
    $isMember = ColocationMember::where('user_id', $user->id)
        ->where('colocation_id', $id)
        ->whereNull('left_at')
        ->exists();
    
    $isOwner = Colocation::where('id', $id)
        ->where('user_id', $user->id)
        ->exists();

    return $isMember || $isOwner ;
});
