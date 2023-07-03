<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function list_product()
    {
        $list_products = Products::all();
        return view('products.list', compact('list_products'));
    }
    
    public function view_add()
    {
        $category = Categories::all();
        return view('products.add', compact('category'));
    }

    public function add(REQUEST $request)
    {
        $rules = [
            'name' => 'required | regex:/^[\pL\pM\s]+$/u | min:2 | max:255',
            'quantity' => 'required | numeric ',
            'price' => 'required | numeric',
            'image' => 'image',
            'category' => 'required',
        ];
        $message = [
            'required' => 'Không được bỏ trống',
            'regex' => 'Không được nhập số',
            'min' => 'Không được nhỏ hơn 10 ký tự',
            'max' => 'Không được lớn hơn 255 ký tự',
            'numeric' => 'Không được nhập chữ',
            'image' => 'Ảnh không hợp lệ',
        ];
        $request->validate($rules, $message);
        $product = new Products();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->quantity = $request->quantity;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('upload', $imagename);

            $product->image = $imagename;
        }
        $product->save();

        return response()->json(['success' => 'Product created successfully']);
    }

    public function view_edit($id)
    {
        $one_product = Products::find($id);

        $category_name = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.id', $id)
            ->first();

        $all_cate = Categories::all();
        return view('products.edit', compact('one_product', 'category_name', 'all_cate'));
    }

    public function update(Request $request, $id)
    {
        $oneproduct = Products::find($id);

        $oneproduct->name = $request->name;
        $oneproduct->price = $request->price;
        $oneproduct->quantity = $request->quantity;
        $oneproduct->category_id = $request->category;

        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('upload', $imagename);

            $oneproduct->image = $imagename;
        }

        $oneproduct->save();

        return response()->json(['success' => 'Product updated successfully']);
    }


    public function delete($id)
    {
        $product = Products::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['success' => 'Product deleted successfully']);
        } else {
            return response()->json(['error' => 'Product not found']);
        }
    }
}
