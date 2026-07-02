<?php
include('./scripts/db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    $sql_check = "SELECT * FROM klienci WHERE login = '$login'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Login jest już zajęty.";
    } else {
        
        $sql_insert = "INSERT INTO klienci (login, haslo , email) VALUES ('$login', '$password', '$email')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Rejestracja udana.";
        } else {
            echo "Błąd rejestracji: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include('./items/header.php'); ?>
    <div class="container">
        <h2>Rejestracja</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">email:</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Zarejestruj się</button>
        </form>
    </div>
    <?php include('./items/footer.php'); ?>
</body>
</html>




