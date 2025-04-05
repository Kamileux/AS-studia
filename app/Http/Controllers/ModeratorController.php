<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ModeratorController extends Controller
{
    public function index()
    {
        if (Auth::user()->rola !== 'moderator' ||Auth::user()->rola !== 'administrator') {
            return redirect()->route('home')->with('error', 'Brak dostępu!'); //dorobic zeby to wyswietlalo jak zdaze 
        }
        
        return view('moderator.panel'); 
    }

  
}