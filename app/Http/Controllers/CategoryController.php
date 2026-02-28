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

        // Ensure user is the owner of the colocation
        if ($colocation->user_id !== Auth::id()) {
            return back()->with('error', 'Non autorisé.');
        }

        Category::create([
            'name' => $request->name,
            'colocation_id' => $colocation->id
        ]);

        return back()->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function destroy(Category $category)
    {
        // Ensure user is the owner of the colocation
        if ($category->colocation->user_id !== Auth::id()) {
            return back()->with('error', 'Non autorisé.');
        }

        // Optional: Check if category is used in expenses
        if ($category->expence()->exists()) {
             return back()->with('error', 'Cette catégorie est utilisée et ne peut pas être supprimée.');
        }

        $category->delete();

        return back()->with('success', 'Catégorie supprimée avec succès.');
    }
}
