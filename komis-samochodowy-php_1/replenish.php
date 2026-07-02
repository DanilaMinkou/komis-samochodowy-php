<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include('./scripts/db_config.php');


function checkLoggedIn() {
    if (isset($_SESSION['user_id'])) {
    
        if (isset($_SESSION['welcome_back']) && $_SESSION['welcome_back'] === true) {
            echo "<script>alert('Witaj ponownie!');</script>";
            $_SESSION['welcome_back'] = false;
        }
        return true;
    } else {
        return false;
    }
}
?>
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
                    <a class="navbar-brand" href="logout.php">Wyloguj się</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    </header>
    <hr>
<?php
require('scripts/db_config.php');
$conn = mysqli_connect($my_server, $my_login_db, $my_pass_db, $my_db);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$marka_query = "SELECT DISTINCT marka_samochodu FROM tranzakcje";
$marka_result = mysqli_query($conn, $marka_query);


$sprzedawcy_query = "SELECT id_sprzedawcy, nazwisko_sprzedawcy, imie_sprzedawcy FROM sprzedawcy";
$sprzedawcy_result = mysqli_query($conn, $sprzedawcy_query);
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="mb-3">
    <label for="marka" class="form-label">Wybierz markę samochodu:</label><br>
    <?php 
    while($row = mysqli_fetch_assoc($marka_result)) {
        echo '<button type="submit" class="btn btn-primary m-2" name="marka" value="'.htmlspecialchars($row['marka_samochodu']).'">'.htmlspecialchars($row['marka_samochodu']).'</button>';
    }
    ?>
  </div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['marka'])) {
    $marka = $_POST['marka'];
    $model_query = "SELECT DISTINCT model_samochodu FROM tranzakcje WHERE marka_samochodu = ?";
    $stmt_model = mysqli_prepare($conn, $model_query);
    mysqli_stmt_bind_param($stmt_model, "s", $marka);
    mysqli_stmt_execute($stmt_model);
    $model_result = mysqli_stmt_get_result($stmt_model);
    echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">';
    echo '<h4 class="mt-4">Wybierz model samochodu:</h4>';
    echo '<div class="btn-group" role="group" aria-label="Basic radio toggle button group">';
    while($row = mysqli_fetch_assoc($model_result)) {
        echo '<button type="submit" class="btn btn-outline-primary m-2" name="model" value="'.htmlspecialchars($row['model_samochodu']).'">'.htmlspecialchars($row['model_samochodu']).'</button>';
    }
    echo '</div>';
    echo '<input type="hidden" name="marka" value="'.htmlspecialchars($marka).'">';
    echo '</form>';
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['model'])) {
    $model = $_POST['model'];
    echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" class="mt-4">';
    echo '<div class="mb-3">';
    echo '<label for="sprzedawca" class="form-label">Wybierz sprzedawcę:</label><br>';
    echo '<select class="form-select" name="sprzedawca" id="sprzedawca">';
    while($row = mysqli_fetch_assoc($sprzedawcy_result)) {
        echo '<option value="'.htmlspecialchars($row['id_sprzedawcy']).'">'.htmlspecialchars($row['imie_sprzedawcy']).' '.htmlspecialchars($row['nazwisko_sprzedawcy']).'</option>';
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="mb-3">';
    echo '<label for="rok" class="form-label">Rok produkcji:</label>';
    echo '<input type="number" class="form-control" name="rok" id="rok" required>';
    echo '</div>';
    echo '<div class="mb-3">';
    echo '<label for="cena" class="form-label">Cena:</label>';
    echo '<input type="number" class="form-control" name="cena" id="cena" required>';
    echo '</div>';
    echo '<div class="mb-3">';
    echo '<label for="ilosc" class="form-label">Dostępna ilość:</label>';
    echo '<input type="number" class="form-control" name="ilosc" id="ilosc" required>';
    echo '</div>';
    echo '<input type="hidden" name="model" value="'.htmlspecialchars($model).'">';
    echo '<input type="hidden" name="marka" value="'.htmlspecialchars($_POST['marka']).'">'; // Przypisanie wartości do $marka
    echo '<button type="submit" class="btn btn-primary">Dodaj Samochód</button>';
    echo '</form>';
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sprzedawca'])) {
    $sprzedawca = $_POST['sprzedawca'];
    $rok = $_POST['rok'] ?? null;
    $cena = $_POST['cena'] ?? null;
    $ilosc = $_POST['ilosc'] ?? null;
    $model = $_POST['model'] ?? null;
    $marka = $_POST['marka'] ?? null;

   
    if ($rok && $cena && $ilosc) {

        $insert_query = "INSERT INTO tranzakcje (id_sprzedawcy, marka_samochodu, model_samochodu, rok_produkcji, cena_samochodu, dostepna_ilosc) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt_insert, "isssdi", $sprzedawca, $marka, $model, $rok, $cena, $ilosc); // Użycie $marka w zapytaniu SQL
        if (mysqli_stmt_execute($stmt_insert)) {
            echo '<div class="alert alert-success mt-4" role="alert">Dodano nową transakcję.</div>';
        } else {
            echo '<div class="alert alert-danger mt-4" role="alert">Błąd: ' . mysqli_error($conn) . '</div>';
        }
        mysqli_stmt_close($stmt_insert);
    } else {
        echo '<div class="alert alert-warning mt-4" role="alert">Wypełnij wszystkie pola formularza przed przesłaniem.</div>';
    }
}
?>
<hr>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mt-4">
    <h4>Dodaj nowy samochód:</h4>
    <div class="mb-3">
        <label for="nowa_marka" class="form-label">Nowa marka samochodu:</label>
        <input type="text" class="form-control" name="nowa_marka" id="nowa_marka" required>
    </div>
    <div class="mb-3">
        <label for="nowy_model" class="form-label">Nowy model samochodu:</label>
        <input type="text" class="form-control" name="nowy_model" id="nowy_model" required>
    </div>
    <div class="mb-3">
        <label for="nowy_sprzedawca" class="form-label">Wybierz sprzedawcę:</label><br>
        <select class="form-select" name="nowy_sprzedawca" id="nowy_sprzedawca" required>
            <?php 
            mysqli_data_seek($sprzedawcy_result, 0); 
            while($row = mysqli_fetch_assoc($sprzedawcy_result)) {
                echo '<option value="'.htmlspecialchars($row['id_sprzedawcy']).'">'.htmlspecialchars($row['imie_sprzedawcy']).' '.htmlspecialchars($row['nazwisko_sprzedawcy']).'</option>';
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="nowa_cena" class="form-label">Nowa cena:</label>
        <input type="number" class="form-control" name="nowa_cena" id="nowa_cena" required>
    </div>
    <div class="mb-3">
        <label for="nowa_ilosc" class="form-label">Nowa dostępna ilość:</label>
        <input type="number" class="form-control" name="nowa_ilosc" id="nowa_ilosc" required>
    </div>
    <button type="submit" class="btn btn-primary">Dodaj nowy samochód</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nowa_marka']) && isset($_POST['nowy_model']) && isset($_POST['nowa_cena']) && isset($_POST['nowa_ilosc']) && isset($_POST['nowy_sprzedawca'])) {
    $nowa_marka = $_POST['nowa_marka'];
    $nowy_model = $_POST['nowy_model'];
    $nowa_cena = $_POST['nowa_cena'];
    $nowa_ilosc = $_POST['nowa_ilosc'];
    $nowy_sprzedawca = $_POST['nowy_sprzedawca'];

    
    $insert_car_query = "INSERT INTO tranzakcje (id_sprzedawcy, marka_samochodu, model_samochodu, cena_samochodu, dostepna_ilosc) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert_car = mysqli_prepare($conn, $insert_car_query);
    mysqli_stmt_bind_param($stmt_insert_car, "isssd", $nowy_sprzedawca, $nowa_marka, $nowy_model, $nowa_cena, $nowa_ilosc);
    if (mysqli_stmt_execute($stmt_insert_car)) {
        echo '<div class="alert alert-success mt-4" role="alert">Dodano nowy samochód do bazy danych.</div>';
    } else {
        echo '<div class="alert alert-danger mt-4" role="alert">Błąd podczas dodawania nowego samochodu: ' . mysqli_error($conn) . '</div>';
    }
    mysqli_stmt_close($stmt_insert_car);
}
?>

<?php include('./items/footer.php'); ?>