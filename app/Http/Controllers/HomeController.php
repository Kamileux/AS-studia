<?php 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = session('user'); 

        $bookCount = 0; 

        if ($user) {
            
            $bookCount = DB::table('uzytkownicy_ksiazki')
                ->where('uzytkownik_id', $user->id)
                ->count();
        }

        
        return view('home', compact('user', 'bookCount'));
    }
}
