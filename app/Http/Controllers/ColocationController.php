<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ColocationMember;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;

class ColocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $user = Auth::user();
        if (!$user->is_global_admin && $user->activeMember()->exists()) {
            return back()->with('error', 'Vous appartenez déjà à une colocation.');
        }

        $colo = Colocation::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active',
            'token' => Str::random(20),
            'user_id' => Auth::id()
        ]);

        ColocationMember::create([
            'colocation_id' => $colo->id,
            'user_id' => Auth::id(),
            'role' => 'owner',
            'status' => 'active'
        ]);

        return redirect()->route('owner.dashboard');
    }

    public function invite(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'colocation_id' => 'required|exists:colocations,id'
        ]);

        $colo = Colocation::findOrFail($request->colocation_id);

        $user = User::where('email', $request->email)->first();
        if ($user && $colo->members()->where('user_id', $user->id)->whereNull('left_at')->exists()) {
            return back()->with('error', 'deja membre.');
        }

        $invi = Invitation::create([
            'email' => $request->email,
            'colocation_id' => $colo->id,
            'token' => Str::random(40),
            'status' => 'pending'
        ]);

        Mail::to($request->email)->send(new InvitationMail($invi));

        return back()->with('success', 'Invitation envoyée.');
    }

    public function showInvitation($token)
    {
        $invitation = Invitation::where('token', $token)
                                ->where('status', 'pending')
                                ->firstOrFail();

        if (Auth::user()->email !== $invitation->email) {
            return redirect()->route('dashboard')->with('error', 'no valid');
        }

        return view('invitations.show', compact('invitation'));
    }

    public function acceptInvitation($token)
    {
        $invi = Invitation::where('token', $token)
                            ->where('status', 'pending')
                            ->firstOrFail();
        $user = Auth::user();

        if ($user->email !== $invi->email) {
            return back()->with('error', 'email non autorise.');
        }

        if (!$user->is_global_admin && $user->activeMember()->exists()) {
            return redirect()->route('dashboard')->with('error', 'Vous avez déjà une colocation active.');
        }

        ColocationMember::create([
            'colocation_id' => $invi->colocation_id,
            'user_id' => $user->id,
            'role' => 'member',
            'status' => 'active'
        ]);

        $invi->update(['status' => 'accepted']);

        return redirect()->route('dashboard');
    }

    public function declineInvitation($token)
    {
        $invi = Invitation::where('token', $token)->where('status', 'pending')->firstOrFail();
        $invi->update(['status' => 'cancelled']);

        return redirect()->route('home');
    }

    public function transferOwnership(ColocationMember $member)
    {
        $colocation = $member->colocation;

        $colocation->update(['user_id' => $member->user_id]);

        ColocationMember::where('colocation_id', $colocation->id)
            ->where('user_id', Auth::id())
            ->update(['role' => 'member']);

        $member->update(['role' => 'owner']);

        return redirect()->route('dashboard')->with('success', 'Propriété transférée avec succès.');
    }

    public function myColocations()
    {
        $memberships = Auth::user()->member()->with('colocation.owner')->get();
        return view('colocations.my-history', compact('memberships'));
    }
}