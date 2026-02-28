<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'colocation_id' => 'required|exists:colocations,id'
        ]);

        $colocation = Colocation::findOrFail($request->colocation_id);

        if ($colocation->user_id !== Auth::id()) {
            return back()->with('error', 'tu n est pas owner');
        }

        Category::create([
            'name' => $request->name,
            'colocation_id' => $colocation->id
        ]);

        return back();
    }

    public function destroy(Category $category)
    {
        if ($category->colocation->user_id !== Auth::id()) {
            return back()->with('error', 'tu n est pas owner');
        }

        $category->delete();

        return back();
    }
}
