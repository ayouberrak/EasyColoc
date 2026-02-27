<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Colocation;
use App\Models\Expense;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'colocations_count' => Colocation::count(),
            'expenses_total' => Expense::sum('amount'),
            'banned_users_count' => User::where('is_banned', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function ban(User $user)
    {
        $ownedColocations = Colocation::where('user_id', $user->id)->where('status', 'active')->get();
        foreach ($ownedColocations as $colocation) {
            $otherMember = $colocation->members()
                ->where('user_id', '!=', $user->id)
                ->first();

            if ($otherMember) {
                $colocation->update(['user_id' => $otherMember->user_id]);
                $otherMember->update(['role' => 'owner']);
            } else {
                $colocation->update(['status' => 'cancelled']);
            }
        }

        $user->member()->whereNull('left_at')->update(['left_at' => now()]);
        $user->update(['is_banned' => true]);

        return back();
    }
    public function unban(User $user)
    {
        $user->update(['is_banned' => false]);
        return back();
    }

    public function colocations()
    {
        $colocations = Colocation::with('owner')
                                  ->withCount('members')
                                  ->get();

        return view('admin.colocations', compact('colocations'));
    }

    public function showColocation($id)
    {
        $colocation =Colocation::with(['owner', 'members.user'])
                                 ->findOrFail($id);
        return view('admin.show-colocation', compact('colocation'));
    }
}
