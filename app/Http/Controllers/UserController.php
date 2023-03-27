<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // ユーザ登録フォームを表示する
    public function showRegistrationForm()
    {
        return view('register');
    }
    
    // ユーザー登録処理を行う
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
            if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
    }
    
     // ユーザを作成する
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // ユーザをログインさせる
        Auth::login($user);
        
        return redirect('/home');
    }

    // ユーザー削除処理を行う
    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        
        return redirect('/home');
    }
}