<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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
        return view('products.add');
    }

    public function add(ProductRequest $request)
    {
        $product = new Products();

        $product->fill($request->all());

        if ($request->hasFile('image')) {
            $product->image = upload_file('uploads', $request->file('image'));
        }

        $product->save();

        return response()->json(['success' => 'Product created successfully']);
    }

    public function view_edit($id)
    {
        $one_product = Products::find($id);

        return view('products.edit', compact('one_product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Products::query()->findOrFail($id);

        $product->fill($request->all());

        $imgOld = $product->image;

        if ($request->hasFile('image')) {
            $product->image = upload_file('uploads', $request->file('image'));
            delete_file($imgOld);
        }

        $product->save();

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
