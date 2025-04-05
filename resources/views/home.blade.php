<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CozyShelf - Strona Główna</title>
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
        }
        footer {
            position: sticky;
            bottom: 0;
            width: 100%;
            background-color: #1A3636; 
            color: white;
        }
        .profile-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 400px; 
            background-color: #F5F5F5;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-section img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .profile-section h3 {
            margin-bottom: 10px;
        }
        .profile-section p {
            margin-bottom: 20px;
        }
        .quote-section {
            background: #40534C; 
            font-style: italic;
            padding: 40px 20px; 
            margin: 20px 0; 
            min-height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            border-radius: 10px;
        }
        blockquote {
            font-size: 1.4rem; 
            margin: 0; 
        }
        blockquote .blockquote-footer {
            font-size: 1rem;
            color: #D6BD98; 
            margin-top: 10px;
        }
        .navbar {
            background-color: #1A3636 !important; 
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }
        .bg-dark {
            background-color: #40534C !important; 
        }
        .text-primary {
            color: #1A3636 !important; 
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

    <header class="bg-dark text-white py-5 text-center">
        <h1>Witaj na CozyShelf!</h1>
        <p class="lead">Twoja lista przeczytanych książek!</p>
    </header>

    <main class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6 book-section text-center p-5 bg-light rounded shadow">
                <div class="py-4">
                    <h2 class="text-primary fw-bold">Przeglądaj książki</h2>
                    <p class="text-muted fs-5">Przejrzyj naszą bazę i dodaj książki, które przeczytałeś, do swojej listy – wraz z oceną!</p>
                    <a href="{{ route('books') }}" class="btn btn-primary btn-lg px-5 py-3 shadow-lg mt-3">Zobacz listę książek</a>
                    @if (isset($user) && ($user->rola === 'moderator'|| $user->rola === 'administrator'))
    <div class="text-center mt-3">
        <a href="{{ route('moderator.panel') }}" class="btn btn-warning btn-lg px-5 py-3 shadow-lg">🛠 Panel moderatora</a>
    </div>
@endif
                    
                </div>
            </div>

            @if (isset($user))
            
            <div class="col-md-6 profile-section shadow">
                <img src="https://media.istockphoto.com/id/2058142954/vector/read-book-man-flat-icon-pictogram-isolated-on-white.jpg?s=612x612&w=0&k=20&c=ipzlDDpw62OCCIQE407HmI62YsHMbEwrVskfMm4ODQ4=" alt="Avatar użytkownika">
                <h3>{{ $user->imie }}</h3>
                <p>Przeczytane książki: {{ $bookCount }}</p>
                <div class="d-grid gap-2">
                    <a href="{{ route('user.books') }}" class="btn btn-secondary">Moja lista książek</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Wyloguj</button>
                    </form>
                </div>
            </div>
            @else
            <div class="col-md-6 text-center p-5 bg-light rounded shadow">
                <h2>Witaj na CozyShelf!</h2>
                <p>Załóż konto, aby zacząć śledzić swoje przeczytane książki.</p>
                <div class="d-grid gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Zaloguj się</a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">Zarejestruj się</a>
                </div>
            </div>
            @endif
        </div>
    </main>

    <section class="quote-section">
        <blockquote class="blockquote">
            <p id="quote-text" class="mb-0">"A room without books is like a body without a soul."</p>
            <footer id="quote-author" class="blockquote-footer">Marcus Tullius Cicero</footer>
        </blockquote>
    </section>

    <footer class="text-center py-3">
        <p>&copy; 2024 CozyShelf</p>
    </footer>

    <script>
    const quotes = [
        { text: "A room without books is like a body without a soul.", author: "Marcus Tullius Cicero" },
        { text: "The only thing you absolutely have to know is the location of the library.", author: "Albert Einstein" },
        { text: "Books are a uniquely portable magic.", author: "Stephen King" },
        { text: "There is no friend as loyal as a book.", author: "Ernest Hemingway" },
        { text: "So many books, so little time.", author: "Frank Zappa" },
        { text: "I have always imagined that Paradise will be a kind of library.", author: "Jorge Luis Borges" },
        { text: "A book is a dream that you hold in your hand.", author: "Neil Gaiman" },
        { text: "We lose ourselves in books, we find ourselves there too.", author: "Anonymous" },
        { text: "The more that you read, the more things you will know.", author: "Dr. Seuss" },
        { text: "There is no Frigate like a Book To take us Lands away.", author: "Emily Dickinson" }
    ];

    let currentQuoteIndex = 0;

    function changeQuote() {
        currentQuoteIndex = (currentQuoteIndex + 1) % quotes.length;
        document.getElementById("quote-text").textContent = `"${quotes[currentQuoteIndex].text}"`;
        document.getElementById("quote-author").textContent = quotes[currentQuoteIndex].author;
    }

    setInterval(changeQuote, 10000);
    </script>
</body>
</html>