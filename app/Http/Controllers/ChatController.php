<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Colocation;
use App\Models\ColocationMember;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function fetchMessages($colocationId)
    {
        $user = Auth::user();
        
        $isMember = ColocationMember::where('colocation_id', $colocationId)
            ->where('user_id', $user->id)
            ->whereNull('left_at')
            ->exists();

        $isOwner = Colocation::where('id', $colocationId)
            ->where('user_id', $user->id)
            ->exists();

        if (!$isMember && !$isOwner) {
            return response()->json(['error' => 'acces refuse'], 403);
        }

        return Message::where('colocation_id', $colocationId)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'colocation_id' => 'required|exists:colocations,id',
            'content' => 'required|string'
        ]);

        $isMember = ColocationMember::where('colocation_id', $request->colocation_id)
            ->where('user_id', $user->id)
            ->whereNull('left_at')
            ->exists();

        $isOwner = Colocation::where('id', $request->colocation_id)
            ->where('user_id', $user->id)
            ->exists();

        if (!$isMember && !$isOwner) {
            return response()->json(['error' => 'acces refuse'], 403);
        }

        $message = Message::create([
            'user_id' => $user->id,
            'colocation_id' => $request->colocation_id,
            'content' => $request->input('content')
        ]);

        $message->load('user');

        broadcast(new MessageSent($message));

        return response()->json([
            'status' => 'envoye', 
            'message' => $message
        ]);
    }
}
