<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('expenses.index') }}">
                Expense Tracker
            </a>

            <a href="{{ route('expenses.dashboard') }}"
                class="btn btn-outline-light">
                Dashboard
            </a>
        </div>
    </nav>


    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </div>

</body>

</html>