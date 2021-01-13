<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Response;

class ProductController extends Controller
{
    public function index()
    {
        $allCategories = Category::select('id', 'category')->where('is_active', 1)->where('is_delete', 0)->get()->toArray();

        return view('products', ['categories' => $allCategories]);
    }

    /*
     * Function for retrieve all products
     */
    public function getAllProducts($id = 0)
    {
        if ($id == 0) {
            return Products::select('id', 'category', 'product', 'is_active')->where('is_delete', 0)->get()->toArray();
        } else {
            return Products::select('id', 'category', 'product', 'is_active')->where('is_delete', 0)->where('id', $id)->get()->toArray();
        }
    }

    /*
     * Function for add product
     */
    public function addProducts(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required',
                'product' => 'required|unique:products',
            ],

            [
                'category.required' => 'Please fill this field',
                'product.required' => 'Please fill this field',
                'product.unique' => 'Product name should be unique',
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
            $data = new Products();
            $data->category = $request['category'];
            $data->product = $request['product'];
            $data->is_active = $request['is_active'];
            $data->save();

            return Response::json(['success' => '1']);
        }
    }

    /*
     * Function for udating product
     */
    public function updateProduct(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required',
                'product' => 'required|unique:products,product,' . $request['product_id'],
            ],
            [
                'category.required' => 'Please fill this field',
                'product.required' => 'Please fill this field',
                'product.unique' => 'Product name should be unique',
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
            $data = Products::find($request['product_id']);

            $data->category = $request['category'];
            $data->product = $request['product'];
            $data->is_active = $request['is_active'];
            $data->save();

            return Response::json(['success' => '1']);
        }
    }

    /*
     * Function for deleting product
     */
    public function deleteProduct($id)
    {
        return Products::where('id', $id)->update(['is_delete' => 1]);
    }
}
