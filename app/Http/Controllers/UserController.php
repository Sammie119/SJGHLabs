<?php

namespace App\Http\Controllers;

use App\Models\Dropdowns;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\VWDropdown;

class UserController extends Controller
{
    function index()
    {
        return view('login');
    }

    public function home()
    {
        return view('dashboard');    
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if($user && Hash::check($request->password, $user->password)){
            
            $request->session()->put('user', $user);

            $request->session()->flash('success', 'You Are Welcome '.$user->name);

            return redirect('dashboard');
            
        }
        else {
            $data = 'Wrong Username or Password!';
            
            return view('login', compact('data'));
        }
    }

    public function addNewUser(){

        $department = VWDropdown::where('category_name', 'Department')->get();
            
        return view('add-user', compact('department'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'new_pass' => 'required|string|min:6',
            'username' => 'required|string|max:50|unique:users',
            'mobile' => 'required|numeric|unique:users',
            'department' => 'required',
            'level' => 'required',
        ],
        [
            'name.required' => 'Name field is required',
            'new_pass.required' => 'Password is required',
            'new_pass.min' => 'Password should not be lass than 6 charactors',
            'username.required' => 'Username is required',
            'username.unique' => 'Username has already been taken',
            'username.max' => 'Username should not be more than 50 charactors',
            'mobile.required' => 'Mobile number is required',
            'mobile.numeric' => 'Mobile number should be numbers only',
            'mobile.unique' => 'Mobile number has already been taken',
            'department.required' => 'Department is required',
            'level.required' => 'User Level is required', 
        ]);

        // $validator = Validator::make($request->input(), $rules);

        // if($validator->fails()) {
        //     $errors = $validator->errors();
        //     return back()->with('error', $errors);
        //     //return Redirect::back()->withError($errors);
        // }
        
        $user = new User;
        
        $user->name = $request['name'];
        $user->mobile = $request['mobile'];
        $user->username = $request['username'];
        $user->department = $request['department'];
        $user->user_level = $request['level'];
        $user->password = Hash::make($request['new_pass']);
        $user->save();

        $request->session()->flash('register', 'New User '.$user->name.' created Successfully!!');

        return redirect('user-list');

    }

    public function userList()
    {
        $users = User::where('user_id', '!=', 1)->orderBy('user_id')->get();
        return view('user-list', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $department = VWDropdown::where('category_name', 'Department')->get();
        return view('edit-user', compact('user', 'department'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            //'username' => 'required|string|max:50|unique:users',
            'mobile' => 'required|numeric',
            'department' => 'required',
            'level' => 'required',
        ],
        [
            'name.required' => 'Name field is required',
            'username.required' => 'Username is required',
            'username.unique' => 'Username has already been taken',
            'username.max' => 'Username should not be more than 50 charactors',
            'mobile.required' => 'Mobile number is required',
            'mobile.numeric' => 'Mobile number should be numbers only',
            'mobile.unique' => 'Mobile number has already been taken',
            'department.required' => 'Department is required',
            'level.required' => 'User Level is required', 
        ]);
        
        $user = User::findOrFail($request->id);
        
        $user->name = $request['name'];
        $user->mobile = $request['mobile'];
        $user->username = $request['username'];
        $user->department = $request['department'];
        $user->user_level = $request['level'];
        $user->update();

        $request->session()->flash('register', 'User '.$user->name.' updated Successfully!!');

        return redirect('user-list');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if($user->user_id === Session::get('user')['user_id']){
            Session::flash('errors', 'Please Call on other Administrator to delete your Account!');
            
            return Redirect::back();
        }
        else{
            
            $user->delete();
            Session::flash('success', $user->name.' deleted Successfully!');

            return Redirect::back();
        }
    }

    public function userProfile()
    {
        $user = User::findOrFail(Session::get('user')['user_id']);
        return view('user-profile', compact('user'));
    }

    public function profileEdit(Request $request)
    {
        if($request['new_pass']){
            $request->validate([
                'name' => 'required|string|max:255',
                'new_pass' => 'required|string|min:6',
                'username' => 'required|string|max:50',
                'mobile' => 'required|numeric',
                // 'department' => 'required',
                // 'level' => 'required',
            ],
            [
                'name.required' => 'Name field is required',
                'new_pass.required' => 'Password is required',
                'new_pass.min' => 'Password should not be lass than 6 charactors',
                'username.required' => 'Username is required',
                'username.unique' => 'Username has already been taken',
                'username.max' => 'Username should not be more than 50 charactors',
                'mobile.required' => 'Mobile number is required',
                'mobile.numeric' => 'Mobile number should be numbers only',
                'mobile.unique' => 'Mobile number has already been taken',
                // 'department.required' => 'Department is required',
                // 'level.required' => 'User Level is required', 
            ]);

            $user = User::findOrFail(Session::get('user')['user_id']);

            if($user){
                
                $user->name = $request['name'];
                $user->mobile = $request['mobile'];
                $user->username = $request['username'];
                $user->password = Hash::make($request['new_pass']);
                $user->update();

                Session::flash('register', 'User '.$user->name.' updated Successfully!!');

                return redirect('logout');
            }
        }
        else {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:50',
                'mobile' => 'required|numeric',
            ],
            [
                'name.required' => 'Name field is required',
                'username.required' => 'Username is required',
                'username.unique' => 'Username has already been taken',
                'username.max' => 'Username should not be more than 50 charactors',
                'mobile.required' => 'Mobile number is required',
                'mobile.numeric' => 'Mobile number should be numbers only',
                'mobile.unique' => 'Mobile number has already been taken',
            ]);
    
            $user = User::findOrFail(Session::get('user')['user_id']);
    
            if($user){
                $user->name = $request['name'];
                $user->mobile = $request['mobile'];
                $user->username = $request['username'];
                $user->update();
    
                return redirect('logout');
            }
        }
    }

    public function logout(){
        Session::forget('user');
        return redirect('/');
    }
}
