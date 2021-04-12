<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {

    public function index() {
        $users = User::all();
        
        
        return view('users.index',compact('users'));
        
        
        return view('users.index',['users' => $users]);
        
        
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed'
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('users.index');
    }
    
    public function show($id) {
        $user = User::find($id);
        return view('users.view',compact('user'));
    }

    public function edit($id) {
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:users,name,'.$id,
            'email' => 'required|email|max:255|unique:users,email,'.$id,
        ]);
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('users.index');
    }


    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response()->json('ok');
    }
}
