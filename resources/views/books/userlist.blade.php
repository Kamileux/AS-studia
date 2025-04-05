<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja lista książek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
   html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #D6BD98; 
}

body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 100vh;
}

main {
    display: flex;
    gap: 20px;
    justify-content: center;
    align-items: center;
    padding: 20px;
    flex-grow: 1;
}

.profile-section, .book-list {
    width: 350px;
    background: #40534C;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    height: 80vh;
    color: white;
}

.profile-section {
    align-items: center;
    text-align: center;
    display: flex;
    flex-direction: column;
}

.profile-section img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin-bottom: 15px;
    background-color: white;
    padding: 5px;
}

.profile-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.description {
    background: #677D6A; 
    padding: 10px;
    border-radius: 8px;
    max-width: 90%;
    text-align: center;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    hyphens: auto;
    display: block;
    color: white;
}

.profile-buttons {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: auto;
}

.profile-buttons .btn {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
}


.btn-primary {
    background-color: #677D6A !important;
    border-color: #677D6A !important;
    color: white;
}

.btn-primary:hover {
    background-color: #40534C !important; 
}


.btn-secondary {
    background-color: #D6BD98 !important; 
    border-color: #D6BD98 !important;
    color: black;
}

.btn-secondary:hover {
    background-color: #C2A57D !important;
}


.btn-danger {
    background-color: #8B3A3A !important;
    border-color: #8B3A3A !important;
}


.book-list {
    flex-grow: 1;
    max-height: 80vh;
    overflow-y: auto;
    background: white;
    color: black;
}

.book-item {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.book-item:last-child {
    border-bottom: none;
}


footer {
    text-align: center;
    padding: 10px 0;
    width: 100%;
    background: #1A3636; 
    color: white;
}


.modal-content {
    background: #40534C; 
    color: white;
}

.modal-header {
    border-bottom: 1px solid #677D6A;
}

.modal-footer {
    border-top: 1px solid #677D6A;
}

.modal .btn-success {
    background-color: #677D6A !important;
    border-color: #677D6A !important;
}

.modal .btn-success:hover {
    background-color: #40534C !important;
}

.btn-warning {
    background-color: #677D6A !important;
    border-color: #677D6A !important;
    color: white !important;
}

.btn-warning:hover {
    background-color: #40534C !important; 
    border-color: #40534C !important;
}
</style>
</head>
<body>

    <nav class="navbar navbar-dark" style="background-color: #1A3636;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('home') }}">CozyShelf</a>
        </div>
    </nav>

    <main class="container py-4">
        <div class="profile-section">
            <img src="https://media.istockphoto.com/id/2058142954/vector/read-book-man-flat-icon-pictogram-isolated-on-white.jpg?s=612x612&w=0&k=20&c=ipzlDDpw62OCCIQE407HmI62YsHMbEwrVskfMm4ODQ4=" alt="Avatar użytkownika">
            <h3>{{ $user->imie }}</h3>
            <p>Przeczytane książki: {{ $userBooks->count() }}</p>

            <div class="profile-content">
                <p class="description">
                    {{ $user->opis ?? 'Brak opisu. Możesz dodać coś o sobie!' }}
                </p>
            </div>

            <div class="profile-buttons">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDescriptionModal">
                    ✏️ Edytuj opis
                </button>

                <a href="{{ route('books') }}" class="btn btn-secondary">
                    📚 Przeglądaj wszystkie książki
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        🔄 Wyloguj
                    </button>
                </form>
            </div>
        </div>

        <div class="book-list">
 <form method="GET" action="{{ route('user.books') }}" class="mb-4">
    <div class="row">
        <!-- Wyszukiwarka -->
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Szukaj książki..." value="{{ request('search') }}">
        </div>
        
        <!-- Sortowanie -->
        <div class="col-md-4">
            <select name="sort" class="form-control">
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Najwyższa ocena</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Najniższa ocena</option>
                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Tytuł A-Z</option>
                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Tytuł Z-A</option>
            </select>
        </div>

        <!-- Przycisk Filtruj -->
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Filtruj</button>
        </div>
    </div>
</form>
  <h2>Moja lista książek</h2>
            @foreach ($userBooks as $book)
                <div class="book-item d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $book->tytul }}</h4>
                        <p>Autor: {{ $book->autor }}</p>
                        <p>Ocena: {{ $book->ocena ?? 'Brak oceny' }}</p>
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editRatingModal-{{ $book->id }}">
                            Edytuj ocenę
                        </button>
	
                        <form method="POST" action="{{ route('user.books.remove', $book->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                        </form>
                    </div>
                </div>

                <div id="editRatingModal-{{ $book->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edytuj ocenę dla: {{ $book->tytul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('user.books.edit', $book->id) }}">
                                    @csrf
                                    <label for="rating" class="form-label">Wybierz ocenę</label>
                                    <input type="number" class="form-control" name="ocena" step="0.5" min="0" max="5" value="{{ $book->ocena }}" required>
                                    <button type="submit" class="btn btn-success mt-3 w-100">💾 Zapisz ocenę</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <footer class="text-center py-3">
        <p>&copy; 2024 CozyShelf</p>
    </footer>
    
    <div id="editDescriptionModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edytuj opis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('updateProfile') }}">
                        @csrf
                        <label for="opis" class="form-label"><strong>📝 Twój opis (max 500 znaków)</strong></label>
                        <textarea name="opis" class="form-control" maxlength="500">{{ $user->opis }}</textarea>
                        <button type="submit" class="btn btn-success mt-3 w-100">💾 Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
