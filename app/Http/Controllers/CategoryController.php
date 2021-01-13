<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Response;

class CategoryController extends Controller
{
    public function index()
    {
        return view('product_category');
    }

    /*
     * Function for retrieve all categories
     */
    public function getAllCategories($id = 0)
    {
        if ($id == 0) {
            return Category::select('id', 'category', 'is_active')->where('is_delete', 0)->get()->toArray();
        } else {
            return Category::select('id', 'category', 'is_active')->where('is_delete', 0)->where('id', $id)->get()->toArray();
        }
    }

    /*
     * Function for add categories
     */
    public function addCategories(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required|unique:category',
            ],

            [
                'category.required' => 'Please fill this field',
                'category.unique' => 'Category should be unique',
            ]
        );
        if ($validator->fails()) {

            return Response::make([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()
            ]);

            return Response::json(['errors' => $validator->errors()]);
        }
        if ($validator->passes()) {
            $data = new Category();
            $data->category = $request['category'];
            $data->is_active = $request['is_active'];
            $data->save();

            return Response::json(['success' => '1']);
        }
    }

    /*
     * Function for update categories
     */
    public function updateCategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required|unique:category,category,' . $request['id'],
            ],
            [
                'category.required' => 'Please fill this field',
                'category.unique' => 'Category name should be unique',
            ]
        );
        if ($validator->fails()) {

            return Response::make([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()
            ]);

            return Response::json(['errors' => $validator->errors()]);
        }
        if ($validator->passes()) {
            $data = Category::find($request['id']);

            $data->category = $request['category'];
            $data->is_active = $request['is_active'];
            $data->save();

            return Response::json(['success' => '1']);
        }
    }

    /*
     * Function for delete categories
     */
    public function deleteCategory($id)
    {
        return Category::where('id', $id)->update(['is_delete' => 1]);
    }
}
