<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista książek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #D6BD98; 
}


body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
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
    text-align: center;
    padding: 10px 0;
}


.navbar {
    background-color: #1A3636 !important;
}

.navbar-brand {
    color: white !important;
    font-weight: bold;
}


h1.text-center {
    color: #1A3636 !important; 
    font-weight: bold;
}


.book-tile {
    border: 1px solid #40534C;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    margin-bottom: 20px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.book-tile h4 {
    margin-bottom: 10px;
    color: #1A3636;
}

.book-tile p {
    margin-bottom: 20px;
    color: #40534C; 
}


.btn {
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


.btn-warning {
    background-color: #677D6A !important; 
    border-color: #677D6A !important;
    color: white;
}

.btn-warning:hover {
    background-color: #40534C !important; 
}


.btn-danger {
    background-color: #8B3A3A !important;
    border-color: #8B3A3A !important;
}


.form-control {
    border: 1px solid #40534C !important; 
}


.modal-content {
    background: #40534C; 
    color: white;
    border-radius: 10px;
}

.modal-header {
    border-bottom: 1px solid #677D6A; 
    color: white;
}

.modal-title {
    color: white !important; 
    font-weight: bold;
}

.modal-footer {
    border-top: 1px solid #677D6A; 
}


.modal-body .form-control {
    background: white;
    color: black;
    border: 1px solid #677D6A !important; 
}


.modal .btn-success {
    background-color: #677D6A !important; 
    border-color: #677D6A !important;
    color: white;
}

.modal .btn-success:hover {
    background-color: #40534C !important;
}


.modal .btn-close {
    filter: invert(1);
}
#bookTitle {
    color: white !important;
    font-weight: bold;
}
  .pagination {
    position: relative;
    z-index: 0; 
    
}

.pagination .page-item.active .page-link {
    background-color: #1A3636; 
    border-color: #1A3636; 
    color: white;
}

.pagination .page-link {
    color: #1A3636; 
}

.pagination .page-link:hover {
    background-color: #677D6A; 
    border-color: #677D6A; 
    color: white; 
}
}
    </style>
</head>
<body>

    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">CozyShelf</a>
        </div>
    </nav>

    <main class="container py-4">
        <h1 class="text-center mb-4 text-primary">Lista książek</h1>

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

        <!-- Wyszukiwarka i filtr -->
        <form method="GET" action="{{ route('books') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Szukaj książki lub autora..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-control">
                        <option value="">Wszystkie kategorie</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nazwa }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-control">
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Sortuj A-Z</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Sortuj Z-A</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtruj</button>
                </div>
            </div>
        </form>

        <div class="row">
    @forelse ($books as $book)
        <div class="col-md-4">
            <div class="book-tile">
                <h4>{{ $book->tytul }}</h4>
                <p>Autor: {{ $book->autor }}</p>
                <button class="btn btn-primary" onclick="openModal({{ $book->id }}, '{{ $book->tytul }}')">Dodaj na listę</button>
            </div>
        </div>
    @empty
        <p class="text-center">Brak książek do wyświetlenia.</p>
    @endforelse
</div>


<div class="justify-content-center text-center">
    <p>Wyświetlanie od {{ $books->firstItem() }} do {{ $books->lastItem() }} z {{ $books->total() }} wyników</p>
</div>
<div class="d-flex justify-content-center">
    {{ $books->links() }}
</div>
    </main>

    <footer class="text-center py-3">
        <p>&copy; 2024 CozyShelf</p>
    </footer>
    
    <!-- Okienko z ocenami -->
    <div id="ratingModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Oceń książkę</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                </div>
                <div class="modal-body">
                    <p id="bookTitle" class="text-center text-primary"></p>
                    <form id="ratingForm" method="POST">
                        @csrf
                        <input type="hidden" id="bookId" name="book_id">
                        <label for="rating" class="form-label">Wybierz ocenę</label>
                        <input type="number" class="form-control" id="rating" name="ocena" step="0.5" min="0" max="5" required>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-success">Dodaj na listę</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function openModal(bookId, bookTitle) {
        document.getElementById("bookTitle").textContent = "Ocena dla: " + bookTitle;
        document.getElementById("bookId").value = bookId;

        let myModal = new bootstrap.Modal(document.getElementById('ratingModal'), {
            keyboard: false
        });

        myModal.show();
    }

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("ratingForm");

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const bookId = document.getElementById("bookId").value;
            const ocena = document.getElementById("rating").value;
            const csrfToken = document.querySelector('input[name="_token"]').value;

            fetch("{{ route('books.ajaxAdd') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    book_id: bookId,
                    ocena: ocena
                })
            })
            .then(res => res.json())
            .then(data => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('ratingModal'));
                modal.hide();

                const alertBox = document.createElement("div");
                alertBox.classList.add("alert", "mt-3");

                if (data.success) {
                    alertBox.classList.add("alert-success");
                } else {
                    alertBox.classList.add("alert-danger");
                }

                alertBox.textContent = data.message;

                const main = document.querySelector("main");
                main.insertBefore(alertBox, main.firstChild);

                setTimeout(() => {
                    alertBox.remove();
                }, 4000);
            })
            .catch(err => {
                console.error(err);
                alert("Wystąpił błąd sieci.");
            });
        });
    });
</script>

</body>
</html>
