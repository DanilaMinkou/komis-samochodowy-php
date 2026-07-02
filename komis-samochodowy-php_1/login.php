<?php

session_start();


include('./scripts/db_config.php');


include('functions.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    
    if ($login === 'admin' && $password === 'admin') {
       
        header("Location: replenish.php");
        exit();
    } else {
        
        $sql = "SELECT id_klienta, liczba_logowan FROM klienci WHERE login='$login' AND haslo='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['id_klienta'];

           
            update_login_count($_SESSION['user_id'], $conn);

           
            if ($row['liczba_logowan'] > 0) {
                $_SESSION['welcome_back'] = true; 
            }

           
            header("Location: index.php");
            exit();
        } else {
            
            echo "Nieprawidłowy login lub hasło.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" type="text/css" href="./items/css/style.css">
</head>
<body>
    <?php include('./items/header.php'); ?>

    <div class="container">
        <h2>Logowanie</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Zaloguj się</button>
        </form>
    </div>

    <?php include('./items/footer.php'); ?>
</body>
</html>