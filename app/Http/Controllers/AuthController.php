<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function register(){
        if(session('isLogin') === true){
            return redirect('/');
        }
        
        return view('auth.register');
    }
    
    public function store_register(Request $request){
        $request->validate([

            'nama_user' => 'required|String',
            'username' => 'required|alpha_dash',
            'password' => 'required|min:8|alpha_dash',
            'confirm' => 'same:password'
            ]);

            $save = DB::insert(
                'INSERT INTO tb_user(nama_user, username, password) VALUES (:nama_user, :username, :password)',
                [
                    'nama_user' => $request->nama_user,
                    'username' => $request->username,
                    'password' => md5($request->password),
                ]
            );
            
        if($save){
            return redirect('/login')->with('register', 'Anda berhasil mendaftar, silahkan login');
        }
    }
    
    public function login(){
        if(session('isLogin') == true){
            return redirect('/');
        }
        
        return view('auth.login');
    }
    
    public function store_login(Request $request){
        
        //jika username ada 
        $user = DB::table('tb_user')->where('username', $request->username)->first();
        
        if($user){
            
            //jika password benar
            if($user->password === md5($request->password) ){
                session([
                    'isLogin' => true,
                    'id_user' => $user->id_user,
                    'username' => $user->username,
                    ]);
                return redirect('/');
            }
            
            //jika password salah
            return redirect('/login')->with('password', 'Password tidak cocok');
        }
        
        //jika username tidak ada
        return redirect('/login')->with('username', 'Username tidak cocok');
    }
    
    public function logout(){
        session()->flush();
        return redirect('/login');
    }
    
}
