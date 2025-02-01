<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel moderatora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #D6BD98; 
            color: #1A3636;*/
        }

        main {
            flex: 1;
        }

        .container {
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        .form-control {
            border: 1px solid #40534C !important;
        }
        
        
        .navbar {
            background-color: #1A3636 !important; 
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

        
        footer {
            position: sticky;
            bottom: 0;
            width: 100%;
            background-color: #1A3636; 
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>

    <!-- Nawigacja -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"> CozyShelf</a>
            	<div class="text-center mb-3">
    
</div>
            	
        </div>
    </nav>

    <main class="container">
    <a href="{{ route('moderator.books') }}" class="btn btn-primary">📚 Zarządzaj książkami</a>
        <h2 class="text-center mb-4">👨‍💼 Panel moderatora</h2>
        
        <!-- Komunikaty -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Wyszukiwarka użytkowników -->
        <form method="GET" action="{{ route('moderator.panel') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Szukaj użytkownika..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">🔍 Szukaj</button>
            </div>
        </form>

        <!-- Tabela użytkowników -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nazwa użytkownika</th>
                    <th>E-mail</th>
                    <th>Hasło</th>
                    <th>Opis</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $userItem)
                <tr>
                    <td>{{ $userItem->id }}</td>
                    <td>
                        <form method="POST" action="{{ route('moderator.updateNick', $userItem->id) }}">
                            @csrf
                            <input type="text" class="form-control" name="imie" value="{{ $userItem->imie }}" required>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Zmień nick</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('moderator.updateEmail', $userItem->id) }}">
                            @csrf
                            <input type="email" class="form-control" name="email" value="{{ $userItem->email }}" required>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Zmień e-mail</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('moderator.updatePassword', $userItem->id) }}">
                            @csrf
                            <input type="text" class="form-control" name="haslo" placeholder="Nowe hasło" required>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Zmień hasło</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('moderator.updateOpis', $userItem->id) }}">
                            @csrf
                            <textarea class="form-control" name="opis" rows="2">{{ $userItem->opis }}</textarea>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Zmień opis</button>
                        </form>
                    </td>
                    <td>
                        @if ($user->rola === 'administrator')
                        <form method="POST" action="{{ route('moderator.deleteUser', $userItem->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                        </form>
                        @if ($userItem->banned)
            <form method="POST" action="{{ route('moderator.unbanUser', $userItem->id) }}">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">✅ Odblokuj</button>
            </form>
        @else
            <form method="POST" action="{{ route('moderator.banUser', $userItem->id) }}">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm">🚫 Zablokuj</button>
            </form>
        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <!-- Stopka -->
    <footer>
        <p>&copy; 2024 CozyShelf</p>
    </footer>

</body>
</html>
