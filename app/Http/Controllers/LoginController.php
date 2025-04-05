<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        $user = DB::table('uzytkownicy')->where('email', $email)->first();
        
        if ($user) {
          
            if ($user->banned) {
                return redirect()->route('login')->withErrors([
                    'error' => '❌ Zostałeś zablokowany. W celu odblokowania konta skontaktuj się z pomoc@cozyshelf.pl'
                ]);
            }
            
           
            if ($password === $user->haslo) {
                $request->session()->put('user', $user);
                
                return redirect('/')->with('success', 'Zalogowano pomyślnie!');
            }
        }
        
        return redirect()->route('login')->withErrors(['error' => 'Nieprawidłowy e-mail lub hasło.']);
    }
    
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        
        return redirect('/')->with('success', 'Wylogowano pomyślnie!');
    }
}
