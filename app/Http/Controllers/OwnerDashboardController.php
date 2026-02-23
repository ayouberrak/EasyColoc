<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index(Request $request)
    {
        $colocation = Colocation::where('user_id', Auth::id())->first();
        
        if (!$colocation) {
            return redirect()->route('colocations.create');
        }

        $tab = $request->get('tab', 'dashboard');
        
        // Ensure only valid tabs are processed (optional but good practice)
        $validTabs = ['dashboard', 'members', 'expenses', 'payments', 'chat'];
        if (!in_array($tab, $validTabs)) {
            $tab = 'dashboard';
        }

        return view('colocations.owner', compact('colocation', 'tab'));
    }
}
