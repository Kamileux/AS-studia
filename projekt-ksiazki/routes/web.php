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

//Mod
Route::get('/moderator', [ModeratorController::class, 'index'])->name('moderator.panel');
Route::post('/moderator/update-nick/{id}', [ModeratorController::class, 'updateNick'])->name('moderator.updateNick');
Route::post('/moderator/update-opis/{id}', [ModeratorController::class, 'updateOpis'])->name('moderator.updateOpis');
Route::post('/moderator/delete-user/{id}', [ModeratorController::class, 'deleteUser'])->name('moderator.deleteUser');
Route::post('/moderator/update-email/{id}', [ModeratorController::class, 'updateEmail'])->name('moderator.updateEmail');
Route::post('/moderator/update-password/{id}', [ModeratorController::class, 'updatePassword'])->name('moderator.updatePassword');

Route::get('/moderator/books', [ModeratorController::class, 'books'])->name('moderator.books');
Route::post('/moderator/books/add', [ModeratorController::class, 'addBook'])->name('moderator.books.add');
Route::post('/moderator/books/update-title/{id}', [ModeratorController::class, 'updateBookTitle'])->name('moderator.books.updateTitle');
Route::post('/moderator/books/update-author/{id}', [ModeratorController::class, 'updateBookAuthor'])->name('moderator.books.updateAuthor');
Route::post('/moderator/books/update-category/{id}', [ModeratorController::class, 'updateBookCategory'])->name('moderator.books.updateCategory');
Route::post('/moderator/books/delete/{id}', [ModeratorController::class, 'deleteBook'])->name('moderator.books.delete');

Route::post('/moderator/ban-user/{id}', [ModeratorController::class, 'banUser'])->name('moderator.banUser');
Route::post('/moderator/unban-user/{id}', [ModeratorController::class, 'unbanUser'])->name('moderator.unbanUser');

// Login i rejestracja
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
