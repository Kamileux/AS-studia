<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UzytkownicyKsiazki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBookController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->session()->get('user');
        
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Musisz być zalogowany, aby zobaczyć swoją listę książek.']);
        }
        
        
        $userBooks = UzytkownicyKsiazki::where('uzytkownik_id', $user->id)
        ->join('ksiazki', 'uzytkownicy_ksiazki.ksiazka_id', '=', 'ksiazki.id')
        ->select('ksiazki.tytul', 'ksiazki.autor', 'uzytkownicy_ksiazki.ocena')
        ->get();
        
        return view('books.userlist', compact('user', 'userBooks'));
    }
    public function userBookList(Request $request)
    {
        $user = $request->session()->get('user');
        
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Musisz być zalogowany, aby zobaczyć swoją listę książek.']);
        }
        
       
        $sortOrder = $request->input('sort', 'desc');
        $searchQuery = $request->input('search');
        
        
        $query = DB::table('uzytkownicy_ksiazki')
        ->join('ksiazki', 'uzytkownicy_ksiazki.ksiazka_id', '=', 'ksiazki.id')
        ->where('uzytkownicy_ksiazki.uzytkownik_id', $user->id)
        ->select('ksiazki.id', 'ksiazki.tytul', 'ksiazki.autor', 'uzytkownicy_ksiazki.ocena');
        
       
        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('ksiazki.tytul', 'LIKE', "%$searchQuery%")
                ->orWhere('ksiazki.autor', 'LIKE', "%$searchQuery%");
            });
        }
        
       
        if ($sortOrder === 'asc') {
            $query->orderBy('uzytkownicy_ksiazki.ocena', 'asc');
        } elseif ($sortOrder === 'desc') {
            $query->orderBy('uzytkownicy_ksiazki.ocena', 'desc');
        } elseif ($sortOrder === 'title_asc') {
            $query->orderBy('ksiazki.tytul', 'asc');
        } elseif ($sortOrder === 'title_desc') {
            $query->orderBy('ksiazki.tytul', 'desc');
        }
        
       
        $userBooks = $query->get();
        
        return view('books.userlist', compact('user', 'userBooks', 'sortOrder', 'searchQuery'));
    }
    
    
       
        public function updateProfile(Request $request)
        {
            
            $user = User::find($request->session()->get('user')->id);
            
            if (!$user) {
                return redirect()->route('login')->withErrors(['error' => 'Musisz być zalogowany, aby edytować profil.']);
            }
            
            
            $user->update([
                'opis' => $request->input('opis')
            ]);
            
           
            $request->session()->put('user', $user);
            
            return redirect()->route('user.books')->with('success', 'Opis został zaktualizowany.');
        }
        
        public function removeFromList($id, Request $request)
        {
            $user = $request->session()->get('user');
            
            if (!$user) {
                return redirect()->route('login')->withErrors(['error' => 'Musisz być zalogowany, aby usuwać książki.']);
            }
            
           
            DB::table('uzytkownicy_ksiazki')
            ->where('uzytkownik_id', $user->id)
            ->where('ksiazka_id', $id)
            ->delete();
            
            return redirect()->route('user.books')->with('success', 'Książka została usunięta z listy.');
        }
        public function editRating($id, Request $request)
        {
            $user = $request->session()->get('user');
            
            if (!$user) {
                return redirect()->route('login')->withErrors(['error' => 'Musisz być zalogowany, aby edytować ocenę.']);
            }
            
           
            $newRating = $request->input('ocena');
            
           
            if ($newRating < 0 || $newRating > 5 || fmod($newRating, 0.5) != 0) {
                return redirect()->route('user.books')->with('error', 'Ocena musi być liczbą od 0 do 5 z połówkami.');
            }
            
          
            DB::table('uzytkownicy_ksiazki')
            ->where('uzytkownik_id', $user->id)
            ->where('ksiazka_id', $id)
            ->update(['ocena' => $newRating, 'zaktualizowano' => now()]);
            
            return redirect()->route('user.books')->with('success', 'Ocena została zaktualizowana.');
        }
     
       
    }
   



