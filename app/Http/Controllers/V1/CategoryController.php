<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function category_list()
    {
        return view('v1.category.all_categories');
    }

    public function add_category()
    {
        return view('v1.category.create_category');
    }

    public function create_category(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string',
        ]);

        $destinationPath = public_path('category');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fileName = uniqid().'_'. time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($destinationPath, $fileName);

        $category = new Category();
        $category->name = $request->title;
        $category->image = url("category/" . $fileName);
        $category->user_id = Auth::user()->id;
        $category->company_id = Auth::user()->company_id;
        $category->save();

        return redirect()->route('category.list')->with(['success' => 'Category Created Successfully']);
    }

    public function show_category($id)
    {
        $category = Category::find($id);

        return view('v1.category.edit_category', compact('category'));
    }

    public function update_category(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        if($request->has('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'title' => 'required|string',
            ]);

            $destinationPath = public_path('category');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fileName = uniqid().'_'. time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $fileName);
        }

        $category = Category::find($request->category_id);
        $category->name = $request->title;
        if($request->has('image')){
            $category->image = url("category/" . $fileName);
        }

        $category->save();

        return redirect()->route('category.list')->with(['success' => 'Category Updated Successfully']);
    }
}
