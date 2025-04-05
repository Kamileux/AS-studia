<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CozyShelf - Rejestracja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #D6BD98; 
        }
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #1A3636; 
        }
        .separator {
            width: 100%;
            height: 2px;
            background-color: #40534C; 
            margin: 10px 0;
        }
        footer {
            width: 100%;
            background-color: #1A3636; 
            color: white;
        }
        .navbar {
            background-color: #1A3636 !important;
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #677D6A !important; 
            border-color: #677D6A !important;
        }
        .btn-primary:hover {
            background-color: #40534C !important;
        }
        .btn-secondary {
            background-color: #40534C !important;
            border-color: #40534C !important;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #677D6A !important; 
        }
        .btn-danger {
            background-color: #8B3A3A !important;
            border-color: #8B3A3A !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">CozyShelf</a>
        </div>
    </nav>

    <main>
        <div class="form-container shadow">
            <h2 class="text-center">Rejestracja</h2>
            
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="imie" class="form-label">Nazwa użytkownika</label>
                    <input type="text" class="form-control" id="imie" name="imie" placeholder="Wprowadź nazwę użytkownika" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adres e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Wprowadź e-mail" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Wprowadź hasło" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Potwierdź hasło</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Potwierdź hasło" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Zarejestruj się</button>
                </div>
                
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
            
            <p class="text-center mt-3">
                Masz już konto? <a href="{{ route('login') }}" class="text-primary">Zaloguj się</a>
            </p>
        </div>
    </main>

    <footer class="text-center py-3">
        <p>&copy; 2024 CozyShelf</p>
    </footer>

</body>
</html>
