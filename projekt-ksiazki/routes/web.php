<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UzytkownicyKsiazki;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\ModeratorController;
use Illuminate\Http\Request;

//Home 
Route::get('/', function () {
    $user = session('user');
    
    $bookCount = 0;
   
    if ($user) {
        $bookCount = UzytkownicyKsiazki::where('uzytkownik_id', $user->id)->count();
    }
    
  
    return view('home', compact('user', 'bookCount'));
})->name('home');

// Ksiazki
Route::get('/books', [BookController::class, 'index'])->name('books');
Route::post('/books/add/{id}', [BookController::class, 'addToList'])->name('add-to-list');

//Lista usera
Route::get('/books/userlist', [UserBookController::class, 'userBookList'])->name('user.books');
Route::post('/update-profile', [UserBookController::class, 'updateProfile'])->name('updateProfile');
Route::post('/books/userlist/remove/{id}', [UserBookController::class, 'removeFromList'])->name('user.books.remove');
Route::post('/books/userlist/edit/{id}', [UserBookController::class, 'editRating'])->name('user.books.edit');

//Panel moda

Route::get('/moderator', function (Request $request) {
    if (session('user')) {
        $user = session('user');
        
        $query = \App\Models\User::query();
        
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('imie', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('opis', 'LIKE', "%{$search}%");
            });
        }
        
        if ($user->rola === 'moderator') {
           
            $users = $query->where('rola', 'user')->get();
        } elseif ($user->rola === 'administrator') {
        
            $users = $query->whereIn('rola', ['user', 'moderator'])->get();
        } else {
            return redirect()->route('home');
        }
        
        return view('moderator.panel', compact('users', 'user'));
    }
    return redirect()->route('home');
})->name('moderator.panel');

Route::post('/moderator/update-nick/{id}', function ($id, Request $request) {
    $user = User::findOrFail($id);
    $user->imie = $request->input('imie');
    $user->save();
    
    return redirect()->route('moderator.panel')->with('success', 'Nick został zmieniony!');
})->name('moderator.updateNick');

Route::post('/moderator/update-opis/{id}', function ($id, Request $request) {
    $user = User::findOrFail($id);
    $user->opis = $request->input('opis');
    $user->save();
    
    return redirect()->route('moderator.panel')->with('success', 'Opis został zmieniony!');
})->name('moderator.updateOpis');

Route::post('/moderator/delete-user/{id}', function ($id) {
    $user = User::findOrFail($id);
    $user->delete();
    
    return redirect()->route('moderator.panel')->with('success', 'Użytkownik został usunięty!');
})->name('moderator.deleteUser');
Route::post('/moderator/update-email/{id}', function ($id, Request $request) {
    $user = \App\Models\User::findOrFail($id);
    $user->email = $request->input('email');
    $user->save();
    
    return redirect()->route('moderator.panel')->with('success', 'E-mail został zmieniony!');
})->name('moderator.updateEmail');

Route::post('/moderator/update-password/{id}', function ($id, Request $request) {
    $user = \App\Models\User::findOrFail($id);
    $user->haslo = $request->input('haslo'); 
    $user->save();
    
    return redirect()->route('moderator.panel')->with('success', 'Hasło zostało zmienione!');
})->name('moderator.updatePassword');

//Panel moda z książkami
Route::get('/moderator/books', function (Request $request) {
    if (session('user')) {
        $user = session('user'); 
        
        if ($user->rola === 'moderator' || $user->rola === 'administrator') {
            $query = \App\Models\Ksiazka::query();
            
          
            $categories = \App\Models\Kategoria::pluck('nazwa');
            
         
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where('tytul', 'LIKE', "%{$search}%")
                ->orWhere('autor', 'LIKE', "%{$search}%")
                ->orWhereHas('kategoria', function ($q) use ($search) {
                    $q->where('nazwa', 'LIKE', "%{$search}%");
                });
            }
            
          
            $books = $query->get();
            
            return view('moderator.books', compact('books', 'user', 'categories'));
        }
    }
    return redirect()->route('home');
})->name('moderator.books');



Route::post('/moderator/books/add', function (Request $request) {
    // Walidacja formularza
    $validated = $request->validate([
        'tytul' => 'required|string|max:255',
        'autor' => 'required|string|max:255',
        'kategoria' => 'required|string|max:255', 
    ]);
    
    // Sprawdzenie czy kategoria już istnieje
    $kategoria = \App\Models\Kategoria::firstOrCreate(['nazwa' => $validated['kategoria']]);
    
    // Tworzenie książki
    $book = new \App\Models\Ksiazka();
    $book->tytul = $validated['tytul'];
    $book->autor = $validated['autor'];
    $book->kategoria_id = $kategoria->id;
    $book->save();
    
    return redirect()->route('moderator.books')->with('success', 'Książka została dodana!');
})->name('moderator.books.add');



Route::post('/moderator/books/update-title/{id}', function ($id, Request $request) {
    $book = \App\Models\Ksiazka::findOrFail($id);
    $book->tytul = $request->input('tytul');
    $book->zaktualizowano = now();
    $book->save();
    
    return redirect()->route('moderator.books')->with('success', 'Tytuł książki został zaktualizowany!');
})->name('moderator.books.updateTitle');


Route::post('/moderator/books/update-author/{id}', function ($id, Request $request) {
    $book = \App\Models\Ksiazka::findOrFail($id);
    $book->autor = $request->input('autor');
    $book->zaktualizowano = now();
    $book->save();
    
    return redirect()->route('moderator.books')->with('success', 'Autor książki został zaktualizowany!');
})->name('moderator.books.updateAuthor');


Route::post('/moderator/books/update-category/{id}', function ($id, Request $request) {
    $book = \App\Models\Ksiazka::findOrFail($id);
    
    $kategoria = \App\Models\Kategoria::where('nazwa', $request->input('kategoria'))->first();
    if (!$kategoria) {
        $kategoria = new \App\Models\Kategoria();
        $kategoria->nazwa = $request->input('kategoria');
        $kategoria->save();
    }
    
    $book->kategoria_id = $kategoria->id;
    $book->zaktualizowano = now();
    $book->save();
    
    return redirect()->route('moderator.books')->with('success', 'Kategoria książki została zaktualizowana!');
})->name('moderator.books.updateCategory');


Route::post('/moderator/books/delete/{id}', function ($id) {
    $user = session('user');
    
    if ($user->rola === 'moderator' || $user->rola === 'administrator') {
        $book = \App\Models\Ksiazka::findOrFail($id);
        $book->delete();
        return redirect()->route('moderator.books')->with('success', 'Książka została usunięta!');
    }
    
    return redirect()->route('moderator.books')->with('error', 'Brak uprawnień do usunięcia książki.');
})->name('moderator.books.delete');

//banomwanie
Route::post('/moderator/ban-user/{id}', function ($id) {
    $user = \App\Models\User::findOrFail($id);
    $user->banned = 1;
    $user->save();
    
    return redirect()->route('moderator.panel')->with('success', 'Użytkownik został zablokowany!');
})->name('moderator.banUser');

//odbanowywanie
Route::post('/moderator/unban-user/{id}', function ($id) {
    $user = \App\Models\User::findOrFail($id);
    $user->banned = 0;
    $user->save();
    
    return redirect()->route('moderator.panel')->with('success', 'Użytkownik został odblokowany!');
})->name('moderator.unbanUser');

// Login i rejestracja
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
