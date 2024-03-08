<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public  function index()
    {
        $categories = Category::paginate(5);
        return view('back-office.categories.index', compact('categories'));
    }
    public  function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',

        ]);
        $categories = Category::create(
            ['title' => $validatedData['title']]
        );
        $categories->save();
        // dd('hhmls');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'title' => 'required',
        ]);
        $category = Category::find($request->id);
        if ($category) {
            $category->update($validatedData);
            return redirect()->back()->with('success', 'Category updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }

    function destroy(Request $request)
    {

        $product = Category::find($request->id);
        $product->delete();
        return redirect()->route('category.index');
    }
}
