<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product_list(){
        $user = Auth::user();

        $product = Product::with('category')
            ->where('company_id', $user->company_id)
            ->where('is_active', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $product_count = Product::where('company_id', $user->company_id)->count();

        return view('v1.product.category_product', compact('product','product_count'));
    }

    public function category_product_list($category_id){
        $user = Auth::user();

        $product = Product::with('category')
            ->where('company_id', $user->company_id)
            ->where('company_id', $category_id)
            ->where('is_active', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $product_count = Product::where('company_id', $user->company_id)->count();

        return view('v1.product.category_product', compact('product','product_count'));
    }

    public function add_product(){
        $category = Category::select('id','name')
            ->where('company_id', Auth::user()->company_id)
            ->get();
            
        return view('v1.product.create_product', compact('category'));
    }

    public function create_product(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'required|string',
            'categories' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);

        $path = $request->file('image')->store('public/images');
        $url = asset(str_replace('public', 'storage', $path));

        $product = new Product();
        $product->name = $request->name;
        $product->image = $url;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->categories;
        $product->company_id = Auth::user()->company_id;
        $product->save();

        return redirect()->route('product.list')->with(['success' => 'Product Created Successfully']);
    }

    public function hide_product(Request $request){
        $product = Product::find($request->product_id);
        if($product){
            $product->is_active = 0;
            $product->save();
        }

        return redirect()->route('product.list')->with(['success' => 'Product Deleted Successfully']);
    }

    public function edit_product($id){
        $product = Product::find($id);
        $category = Category::select('id','name')
            ->where('company_id', Auth::user()->company_id)
            ->get();
            
        return view('v1.product.edit_product', compact('category','product'));
    }

    public function update_product(Request $request){
        $request->validate([
            'name' => 'required|string',
            'categories' => 'required',
            'price' => 'required',
        ]);

        if($request->has('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'name' => 'required|string',
                'categories' => 'required',
                'price' => 'required',
            ]);

            $path = $request->file('image')->store('public/images');
            $url = asset(str_replace('public', 'storage', $path));
        }

        

        

        $product = Product::find($request->product_id);

        if($request->incoming_stock){
            $product->stock += $request->incoming_stock;
        }

        

        if($request->outgoing_stock){
            if(($product->stock - $request->outgoing_stock) < 0){
                return redirect()
                    ->route('product.edit',[$request->product_id])
                    ->with(['error' => 'Please confirm your stock before deduction']);
            }

            $product->stock -= $request->outgoing_stock;
        }
        
        $product->name = $request->name;
        if($request->has('image')){
            $product->image = $url;
        }
        $product->price = $request->price;
        $product->category_id = $request->categories;
        $product->save();

        return redirect()->route('product.list')->with(['success' => 'Product Updated Successfully']);
    }
}
