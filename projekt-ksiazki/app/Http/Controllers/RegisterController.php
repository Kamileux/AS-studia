<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            
            Log::info('Dane wejściowe:', $request->all());
            
            $validatedData = $request->validate([
                'imie' => 'required|string|max:255',
                'email' => 'required|email|unique:uzytkownicy,email|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);

            
            $user = User::create([
                'imie' => $validatedData['imie'],
                'email' => $validatedData['email'],
                'haslo' => $validatedData['password'], 
                'rola' => 'user',
            ]);

            session(['user' => $user]);

            return redirect()->route('home')->with('success', 'Rejestracja zakończona sukcesem!');
        } catch (\Exception $e) {
            return back()->with('error', 'Rejestracja nie powiodła się.');
        }
    }

    public function showRegistrationForm()
    {
        return view('register');
    }
}