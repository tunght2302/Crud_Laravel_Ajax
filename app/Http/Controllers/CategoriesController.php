<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function list_category()
    {
        $list_category = Categories::all();
        return view('categories.list', compact('list_category'));
    }

    public function create_category(REQUEST $request)
    {
        return view('categories.add');
    }

    public function add_category(REQUEST $request)
    {
        $rule = [
            'name' => 'required | max:100 | min:2',
        ];

        $message = [
            'required' => 'Không được bỏ trống',
            'min' => 'Không được nhỏ hơn 2 kí tự',
            'max' => 'Không được lớn hơn 100 kí tự',
        ];

        $request->validate($rule, $message);

        $add_cate = new Categories();
        $add_cate->name = $request->name;

        $add_cate->save();

        return response()->json(['success' => 'Add Category successfully']);
    }

    public function edit_view($id)
    {
        $edit_cate = Categories::find($id);
        // dd($edit_cate);
        return view('categories.update', compact('edit_cate'));
    }

    public function update(REQUEST $request, $id)
    {
        $rule = [
            'name' => 'required | max:100 | min:2',
        ];

        $message = [
            'required' => 'Không được bỏ trống',
            'min' => 'Không được nhỏ hơn 2 kí tự',
            'max' => 'Không được lớn hơn 100 kí tự',
        ];

        $request->validate($rule, $message);

        $update_cate = Categories::find($id);
        // dd($update_cate);
        $update_cate->name = $request->name;

        $update_cate->save();

        return response()->json(['success' => 'Update Category successfully']);
    }

    public function delete($id)
    {
        $delete = Categories::find($id);

        if ($delete) {
            $delete->delete();
            
            return response()->json(['success' => 'Category deleted successfully']);

        } else {

            return response()->json(['error' => 'Category not found']);
        }
    }
}
