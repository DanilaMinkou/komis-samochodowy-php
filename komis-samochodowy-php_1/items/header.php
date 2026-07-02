<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komiks samochodowy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1>Komiks samochodowy</h1>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="strona_gowna.php">Strona główna</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            if (isset($_SESSION['user_id'])) {
                                echo '<li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj się</a></li>';
                            } else {
                                echo '<li class="nav-item"><a class="nav-link" href="login.php">Zaloguj się</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="register.php">Zarejestruj się</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
