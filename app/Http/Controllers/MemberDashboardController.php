<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ColocationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class MemberDashboardController extends Controller
{

    public function getAllCategories(){
        $categories = Category::all();
        return $categories;
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $member = ColocationMember::where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        if (!$member) {
            return redirect()->route('colocations.create');
        }

        $colocation = $member->colocation;
        $tab = $request->get('tab', 'dashboard');
        
        $lien = ['dashboard', 'members', 'expenses'];
        if (!in_array($tab, $lien)) {
            $tab = 'dashboard';
        }

        $categories = $this->getAllCategories();
        $debts = \App\Models\Credit::with(['debtor', 'creditor'])->where('colocation_id', $colocation->id)->get();

        return view('colocations.member', compact('colocation', 'tab', 'categories', 'debts'));
    }



    public function leaveSeul(){
        
    }
}
