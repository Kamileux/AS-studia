<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ksiazka;
use App\Models\Kategoria;

class ModeratorController extends Controller
{
    public function index(Request $request)
    {
        $user = session('user');
        
        if (!$user || ($user->rola !== 'moderator' && $user->rola !== 'administrator')) {
            return redirect()->route('home')->with('error', 'Brak dostępu!');
        }
        
        $query = User::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('imie', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('opis', 'LIKE', "%{$search}%");
            });
        }
        
        if ($user->rola === 'moderator') {
            $users = $query->where('rola', 'user')->pagiante(10);
        } elseif ($user->rola === 'administrator') {
            $users = $query->whereIn('rola', ['user', 'moderator'])->paginate(10);
        }
        
        return view('moderator.panel', compact('users', 'user'));
    }
    
    public function updateNick($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->imie = $request->input('imie');
        $user->save();
        
        return redirect()->route('moderator.panel')->with('success', 'Nick został zmieniony!');
    }
    
    public function updateOpis($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->opis = $request->input('opis');
        $user->save();
        
        return redirect()->route('moderator.panel')->with('success', 'Opis został zmieniony!');
    }
    
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('moderator.panel')->with('success', 'Użytkownik został usunięty!');
    }
    
    public function updateEmail($id, Request $request)
    {
        $user = User::findOrFail($id);
        
        if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            return redirect()->route('moderator.panel')->with('error', 'Wprowadź poprawny adres e-mail.');
        }
        
        if (User::where('email', $request->input('email'))->where('id', '!=', $user->id)->exists()) {
            return redirect()->route('moderator.panel')->with('error', 'Ten e-mail jest już zajęty.');
        }
        
        $user->email = $request->input('email');
        $user->save();
        
        return redirect()->route('moderator.panel')->with('success', 'E-mail został zmieniony!');
    }
    
    public function updatePassword($id, Request $request)
    {
        $user = User::findOrFail($id);
        $haslo = $request->input('haslo');
        $haslo_confirmation = $request->input('haslo_confirmation');
        
        if ($haslo !== $haslo_confirmation) {
            return redirect()->route('moderator.panel')->with('error', 'Hasła nie są identyczne!');
        }
        
        $user->haslo = $haslo;
        $user->save();
        
        return redirect()->route('moderator.panel')->with('success', 'Hasło zostało zmienione!');
    }
    
    public function books(Request $request)
    {
        $user = session('user');
        
        if (!$user || ($user->rola !== 'moderator' && $user->rola !== 'administrator')) {
            return redirect()->route('home')->with('error', 'Brak dostępu!');
        }
        
        $query = Ksiazka::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('tytul', 'LIKE', "%{$search}%")
            ->orWhere('autor', 'LIKE', "%{$search}%")
            ->orWhereHas('kategoria', function ($q) use ($search) {
                $q->where('nazwa', 'LIKE', "%{$search}%");
            });
        }
        
        $books = $query->paginate(10);
        $categories = Kategoria::pluck('nazwa');
        
        return view('moderator.books', compact('books', 'user', 'categories'));
    }
    
    public function addBook(Request $request)
    {
        $validated = $request->validate([
            'tytul' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'kategoria' => 'required|string|max:255',
        ]);
        
        $kategoria = Kategoria::firstOrCreate(['nazwa' => $validated['kategoria']]);
        
        $book = new Ksiazka();
        $book->tytul = $validated['tytul'];
        $book->autor = $validated['autor'];
        $book->kategoria_id = $kategoria->id;
        $book->save();
        
        return redirect()->route('moderator.books')->with('success', 'Książka została dodana!');
    }
    
    public function updateBookTitle($id, Request $request)
    {
        $book = Ksiazka::findOrFail($id);
        $book->tytul = $request->input('tytul');
        $book->zaktualizowano = now();
        $book->save();
        
        return redirect()->route('moderator.books')->with('success', 'Tytuł książki został zaktualizowany!');
    }
    
    public function updateBookAuthor($id, Request $request)
    {
        $book = Ksiazka::findOrFail($id);
        $book->autor = $request->input('autor');
        $book->zaktualizowano = now();
        $book->save();
        
        return redirect()->route('moderator.books')->with('success', 'Autor książki został zaktualizowany!');
    }
    
    public function updateBookCategory($id, Request $request)
    {
        $book = Ksiazka::findOrFail($id);
        
        $kategoria = Kategoria::firstOrCreate(['nazwa' => $request->input('kategoria')]);
        $book->kategoria_id = $kategoria->id;
        $book->zaktualizowano = now();
        $book->save();
        
        return redirect()->route('moderator.books')->with('success', 'Kategoria książki została zaktualizowana!');
    }
    
    public function deleteBook($id)
    {
        $user = session('user');
        
        if ($user->rola === 'moderator' || $user->rola === 'administrator') {
            $book = Ksiazka::findOrFail($id);
            $book->delete();
            return redirect()->route('moderator.books')->with('success', 'Książka została usunięta!');
        }
        
        return redirect()->route('moderator.books')->with('error', 'Brak uprawnień do usunięcia książki.');
    }
    
    public function banUser($id)
    {
        $user = User::findOrFail($id);
        $user->banned = 1;
        $user->save();
        
        return redirect()->route('moderator.panel')->with('success', 'Użytkownik został zablokowany!');
    }
    
    public function unbanUser($id)
    {
        $user = User::findOrFail($id);
        $user->banned = 0;
        $user->save();
        
        return redirect()->route('moderator.panel')->with('success', 'Użytkownik został odblokowany!');
    }
}
