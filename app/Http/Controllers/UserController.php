<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Response;

class UserController extends Controller
{
    public function index()
    {
        return view('user');
    }

    /*
     * Function for retrieve all users
     */
    public function getAllUsers($id = 0)
    {
        if ($id == 0) {
            return User::select('id', 'name', 'email', 'role_id', 'is_active')->where('is_delete',0)->get()->toArray();
        } else {
            return User::select('id', 'name', 'email', 'role_id', 'is_active')->where('is_delete',0)->where('id', $id)->get()->toArray();
        }
    }

    /*
     * Function for update user details
     */
    public function updateUserData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|regex:/[a-zA-Z]+[a-zA-Z0-9_]*/|max:255',
                'email' => 'required|unique:users,email,'.$request['id'],
            ],

            [
                'name.required' => 'Please fill this field',
                'name.regex' => 'Charactors only',
                'email.max' => 'Limit exceeds',
                'email.required' => 'Please fill this field',
                'email.email' => 'Format Error',
                'email.unique' => 'Email should be unique',
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
            $data = User::find($request['id']);

            $data->name = $request['name'];
            $data->email = $request['email'];
            $data->role_id = $request['user_role'];
            $data->is_active = $request['is_active'];
            $data->save();

            return Response::json(['success' => '1']);
        }
    }

    /*
     * Function for delete user details
     */
    public function deleteUser($id)
    {
         return User::where('id',$id)->update(['is_delete' => 1]);
    }

    /*
     * Function for add users
     */
    public function addUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|regex:/[a-zA-Z]+[a-zA-Z0-9_]*/|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ],

            [
                'name.required' => 'Please fill this field',
                'name.regex' => 'Charactors only',
                'name.max' => 'Limit exceeds',
                'email.required' => 'Please fill this field',
                'email.email' => 'Format Error',
                'email.unique' => 'Email should be unique',
                'password.required' => 'Please fill this field',
                'password.min' => 'Altleast 8 letters'
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
            $data = new User();

            $data->name = $request['name'];
            $data->email = $request['email'];
            $data->role_id = $request['user_role'];
            $data->is_active = $request['is_active'];
            $data->password = Hash::make($request['password']);
            $data->save();

            return Response::json(['success' => '1']);
        }
    }
}
