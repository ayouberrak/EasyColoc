<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\ColocationMember;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Invitation;
use App\Mail\InvitationMail;



class ColocationController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string']
        ]);


        $colo = Colocation::create([
            'name' => $request->name,
            'description' =>$request->description,
            'status'=>'active',
            'token'=> Str::random(20),
            'user_id'=> Auth::user()->id
        ]);

        $membre = ColocationMember::create([
            'colocation_id' => $colo->id,
            'user_id' => Auth::user()->id,
            'role' => 'owner',
            'status' => 'active'
        ]);


        return redirect(route('owner.dashboard'));
    }

    public function invite(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'colocation_id' => ['required', 'exists:colocations,id']
        ]);

        $colo = Colocation::findOrFail($request->colocation_id);
        
        $user = User::where('email', $request->email)->first();
        if ($user && $colo->members()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'error.');
        }

        $invi = Invitation::create([
            'email' => $request->email,
            'colocation_id' => $colo->id,
            'token' => Str::random(40),
            'status' => 'pending'
        ]);

        Mail::to($request->email)->send(new InvitationMail($invi));

        return back()->with('success', 'invitation envoyee');
    }

    public function showInvitation($token)
    {
        $invitation = Invitation::where('token', $token)->where('status', 'pending')->firstOrFail();
        return view('invitations.show', compact('invitation'));
    }

    public function acceptInvitation($token)
    {
        $invi = Invitation::where('token', $token)
                            ->where('status', 'pending')
                            ->firstOrFail();
        $user = Auth::user();

        if ($user->email !== $invi->email) {
            return back()->with('error', 'eror.');
        }

        ColocationMember::create([
            'colocation_id' => $invi->colocation_id,
            'user_id' => $user->id,
            'role' => 'member',
            'status' => 'active'
        ]);

        $invi->update(['status' => 'accepter']);

        return redirect()->route('dashboard');
    }

    public function declineInvitation($token)
    {
        $invi = Invitation::where('token', $token)->where('status', 'pending')->firstOrFail();
        $invi->update(['status' => 'anuller']);

        return redirect()->route('home');
    }
}
