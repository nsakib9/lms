<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\UserInfo;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //   
    }

    public function userList()
    {
        $admins = User::with(['user_info'])->paginate(10);
        $admins = $admins->toArray();
        $data = [
            'data' => $admins,
            'status' => 'OK',
            'code' => 200
        ];
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'phone' => 'required|unique:user_infos',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ],[
            'first_name.required' => 'Name should not be empty',
            'phone.required' => 'Phone should not be empty',
            'email.required' => 'Email should not be empty',
            'email.email' => 'Enter a valid email',
            'email.unique' => 'This Email Already Exists',
            'phone.unique' => 'This Number Already Exists',
            'password.required' => 'Password should not be empty',
            'password.min' => 'Password must be atleast 6 characters',
        ]);
        if($validator->fails()){
            $data =[
                'data' =>$validator->errors(),
                'error' => true
            ];
            return response()->json($data);
        }

        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->Password);
        if($user->save()){
            $info = new UserInfo();
            $info->user_id = $user->id;
            $info->first_name = $request->first_name;
            $info->last_name = $request->last_name;
            $info->phone = $request->phone;
            $info->address = $request->address;
            $info->save();

            $data=[
                'msg' =>'User Added',
                'status' => 'ok',
                'code' => 201,
                'error' => false
            ];
        }
        else {
            $data=[
                'msg' =>'Error',
                'status' => 'nok',
                'code' => 500
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admins = User::with(['user_info'])->find($id);
        $admins = $admins->toArray();
        $data = [
            'data' => $admins,
            'status' => 'OK',
            'code' => 200
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'phone' => 'required|unique:user_infos,' . $request->id,
            'email' => 'required|email|max:255|unique:users,'.$request->id,
            'password' => 'required|min:6',
        ],[
            'first_name.required' => 'Name should not be empty',
            'phone.required' => 'Phone should not be empty',
            'email.required' => 'Email should not be empty',
            'email.email' => 'Enter a valid email',
            'email.unique' => 'This Email Already Exists',
            'phone.unique' => 'This Number Already Exists',
            'password.required' => 'Password should not be empty',
            'password.min' => 'Password must be atleast 6 characters',
        ]);
        if($validator->fails()){
            $data =[
                'data' =>$validator->errors(),
                'error' => true
            ];
            return response()->json($data);
        }

        $user = User::find($request->id);
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->Password);
        
        if($user->update()){
            $info = UserInfo::find($user->id);
            $info->user_id = $user->id;
            $info->first_name = $request->first_name;
            $info->last_name = $request->last_name;
            $info->phone = $request->phone;
            $info->address = $request->address;
            $info->update();

            $data=[
                'msg' =>'User updated',
                'status' => 'ok',
                'code' => 201,
                'error' => false
            ];
        }
        else {
            $data=[
                'msg' =>'Error',
                'status' => 'nok',
                'code' => 500
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with(['user_info'])->where('id',$id)->first();

        if($user->delete()){
            $info = UserInfo::where('user_id',$id)->first();
            if ($info != null)
            {
                $info->delete();
            }
            $data=[
                'msg' =>'User Deleted!!',
                'status' => 'ok',
                'code' => 200
            ];
        }
        else {
            $data=[
                'msg' =>'Error',
                'status' => 'nok',
                'code' => 500
            ];
        }
        
        return response()->json($data);
    }
}
