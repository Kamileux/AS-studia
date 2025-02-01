<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        
        $search = $request->input('search');
        $category = $request->input('category');
        $sortOrder = $request->input('sort', 'asc'); 
        
       
        $categories = DB::table('kategorie')->get();
        
        
        $query = DB::table('ksiazki');
        
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tytul', 'LIKE', "%{$search}%")
                ->orWhere('autor', 'LIKE', "%{$search}%");
            });
        }
        
        if ($category) {
            $query->where('kategoria_id', $category);
        }
        
        $query->orderBy('tytul', $sortOrder);
        
        $books = $query->get();
        
        return view('books.books', compact('books', 'categories', 'search', 'category', 'sortOrder'));
        
    }

    public function addToList($id, Request $request)
    {
        $user = $request->session()->get('user');
        
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Musisz być zalogowany, aby dodać książkę do listy.']);
        }
        
        
        $ocena = $request->input('ocena');
        
        
        if ($ocena < 0 || $ocena > 5 || fmod($ocena, 0.5) != 0) {
            return redirect()->route('books')->with('error', 'Ocena musi być liczbą od 0 do 5 z połówkami.');
        }
        
      
        $exists = DB::table('uzytkownicy_ksiazki')
        ->where('uzytkownik_id', $user->id)
        ->where('ksiazka_id', $id)
        ->exists();
        
        if ($exists) {
            return redirect()->route('books')->with('error', 'Ta książka już jest na Twojej liście.');
        }
        
       
        DB::table('uzytkownicy_ksiazki')->insert([
            'uzytkownik_id' => $user->id,
            'ksiazka_id' => $id,
            'ocena' => $ocena,
            'utworzono' => now(),
            'zaktualizowano' => now(),
        ]);
        
        return redirect()->route('books')->with('success', 'Pomyślnie dodano książkę na listę.');
    }
    



}

