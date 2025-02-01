<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel zarządzania książkami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #D6BD98; 
            color: #1A3636; 
            display: flex;
            flex-direction: column;
        }

        
        .navbar {
            background-color: #1A3636 !important; 
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

       
        .container {
            flex: 1;
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        
        .btn-primary {
            background-color: #677D6A !important; 
            border-color: #677D6A !important;
        }
        .btn-primary:hover {
            background-color: #40534C !important; 
        }
        .btn-danger {
            background-color: #8B3A3A !important;
            border-color: #8B3A3A !important;
        }
        .btn-secondary {
            background-color: #40534C !important; 
            border-color: #40534C !important;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #677D6A !important; 
        }
        .form-control {
            border: 1px solid #40534C !important;
        }

       
        footer {
            background-color: #1A3636; 
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            margin-top: auto;
            position: sticky;
            bottom: 0;
        }
    </style>
</head>
<body>

    
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">CozyShelf</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2 class="text-center">📚 Panel zarządzania książkami</h2>
            <a href="{{ route('moderator.panel') }}" class="btn btn-secondary">⬅️ Powrót do panelu</a>
        </div>

        <!-- Komunikaty -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
    <div class="alert alert-danger">
        <strong>❌ Nie udało się dodać książki!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Wyszukiwanie książek -->
        <form method="GET" action="{{ route('moderator.books') }}" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Szukaj książki..." value="{{ request('search') }}">
                </div>
                
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Szukaj</button>
                </div>
            </div>
        </form>

        <!-- Formularz dodawania książki -->
       <div class="mb-4">
    <h4>➕ Dodaj nową książkę</h4>
    <form method="POST" action="{{ route('moderator.books.add') }}">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="tytul" placeholder="Tytuł książki" required>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="autor" placeholder="Autor książki" required>
            </div>
            <div class="col-md-3">
                <input type="text" list="categoryList" class="form-control" name="kategoria" placeholder="Wybierz lub wpisz kategorię">
                <datalist id="categoryList">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Dodaj</button>
            </div>
        </div>
    </form>
</div>

        <!-- Tabela książek -->
      <table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Autor</th>
            <th>Kategoria</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($books as $book)
    <tr>
        <td>{{ $book->id }}</td>

        <!-- Edycja tytułu -->
        <td>
            <form method="POST" action="{{ route('moderator.books.updateTitle', $book->id) }}">
                @csrf
                <input type="text" class="form-control" name="tytul" value="{{ $book->tytul }}" required>
                <button type="submit" class="btn btn-primary btn-sm mt-2">✏️ Zmień tytuł</button>
            </form>
        </td>

        <!-- Edycja autora -->
        <td>
            <form method="POST" action="{{ route('moderator.books.updateAuthor', $book->id) }}">
                @csrf
                <input type="text" class="form-control" name="autor" value="{{ $book->autor }}" required>
                <button type="submit" class="btn btn-primary btn-sm mt-2">✏️ Zmień autora</button>
            </form>
        </td>

        <!-- Edycja kategorii -->
        <td>
            <form method="POST" action="{{ route('moderator.books.updateCategory', $book->id) }}">
                @csrf
                <input type="text" list="categoryList" class="form-control" name="kategoria" value="{{ $book->kategoria->nazwa ?? '' }}" required>
                <datalist id="categoryList">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}"></option>
                    @endforeach
                </datalist>
                <button type="submit" class="btn btn-primary btn-sm mt-2">✏️ Zmień kategorię</button>
            </form>
        </td>

        <!-- Usuwanie -->
        <td>
            @if ($user->rola === 'administrator' || $user->rola === 'moderator')
            <form method="POST" action="{{ route('moderator.books.delete', $book->id) }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">🗑️ Usuń</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
</table>


    </div>

    <footer>
        <p>&copy; 2024 CozyShelf</p>
    </footer>

</body>
</html>
