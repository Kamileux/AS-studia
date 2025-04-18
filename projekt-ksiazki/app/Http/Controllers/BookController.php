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
        
        //stronnicowanie
        $books = $query->paginate(15);
        
        return view('books.books', compact('books', 'categories', 'search', 'category', 'sortOrder'));
    }
    

    public function ajaxAddToList(Request $request)
    {
        $user = $request->session()->get('user');
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Musisz być zalogowany.'], 401);
        }
        
        $bookId = $request->input('book_id');
        $ocena = $request->input('ocena');
        
        if ($ocena < 0 || $ocena > 5 || fmod($ocena, 0.5) != 0) {
            return response()->json(['success' => false, 'message' => 'Ocena musi być od 0 do 5']);
        }
        
        $exists = DB::table('uzytkownicy_ksiazki')
        ->where('uzytkownik_id', $user->id)
        ->where('ksiazka_id', $bookId)
        ->exists();
        
        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Ta książka już jest na Twojej liście.']);
        }
        
        DB::table('uzytkownicy_ksiazki')->insert([
            'uzytkownik_id' => $user->id,
            'ksiazka_id' => $bookId,
            'ocena' => $ocena,
            'utworzono' => now(),
            'zaktualizowano' => now(),
        ]);
        
        return response()->json(['success' => true, 'message' => 'Dodano książkę do listy!']);
    }
    



}

