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
        if ($user->is_global_admin) {
            return back()->with('error', 'Impossible de bannir un administrateur.');
        }

        $user->update(['is_banned' => true]);
        return back()->with('success', "L'utilisateur {$user->name} a été banni.");
    }

    public function unban(User $user)
    {
        $user->update(['is_banned' => false]);
        return back()->with('success', "L'utilisateur {$user->name} a été débanni.");
    }

    public function colocations()
    {
        $colocations = Colocation::with('owner')->withCount('members')->get();

        return view('admin.colocations', compact('colocations'));
    }

    public function showColocation($id)
    {
        $colocation = Colocation::with(['owner', 'members.user'])->findOrFail($id);
        return view('admin.show-colocation', compact('colocation'));
    }
}
