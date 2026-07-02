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
    <title>Strona Główna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include('./items/header.php'); ?>
<main role="main" class="container">
<?php

if (checkLoggedIn()) {
    
    $sql = "SELECT marka_samochodu, model_samochodu, dostepna_ilosc, cena_samochodu FROM tranzakcje GROUP BY marka_samochodu, model_samochodu;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       
        echo "<h2>Dostępne samochody:</h2>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Marka</th><th>Model</th><th>Dostępna ilość</th><th>Cena (PLN)</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["marka_samochodu"] . "</td>";
            echo "<td>" . $row["model_samochodu"] . "</td>";
            echo "<td>" . $row["dostepna_ilosc"] . "</td>";
            echo "<td>" . $row["cena_samochodu"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Brak dostępnych samochodów.";
    }

    
    echo '
    <h2>Formularz zakupu</h2>
    <form action="index.php" method="post" onsubmit="return buyCar();">
        <label for="marka_samochodu">Wybierz markę samochodu:</label><br>';

    
    $sql_makes = "SELECT DISTINCT marka_samochodu FROM tranzakcje WHERE dostepna_ilosc > 0;";
    $result_makes = $conn->query($sql_makes);
    if ($result_makes->num_rows > 0) {
        while ($row = $result_makes->fetch_assoc()) {
            $make = $row["marka_samochodu"];
            echo "<button type='button' class='btn btn-primary make-button' onclick='showModels(\"$make\")'>$make</button>";
        }
    } else {
        echo "<p>Niedostępne samochody</p>";
    }

    
    echo '
    <div id="models-container">
        <label for="model_samochodu">Wybierz model samochodu:</label><br>
        <select id="model_samochodu" name="model_samochodu" disabled>
            <option value="">Wybierz najpierw markę</option>
        </select>
    </div>
    <label for="quantity">Ilość:</label>
    <input type="number" id="quantity" name="quantity" min="1" max="20" value="0">
    <input type="hidden" name="transaction_id" value="' . uniqid() . '">
    <input type="submit" value="Kup">
</form>';

 
    echo '<script>
    function showModels(make) {
        const modelsContainer = document.getElementById("models-container");
        const modelSelect = document.getElementById("model_samochodu");
        modelSelect.disabled = false;
        
        
        modelSelect.innerHTML = "";
        
        
        fetch(`get_models.php?make=${make}`)
            .then(response => response.json())
            .then(data => {
               
                data.forEach(model => {
                    const option = document.createElement("option");
                    option.text = model;
                    option.value = model;
                    modelSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error(\'Błąd podczas pobierania modeli:\', error);
            });
    }

    
    function buyCar() {
       
        var modelSelect = document.getElementById("model_samochodu");
        var selectedModel = modelSelect.options[modelSelect.selectedIndex].value;
        console.log("Wybrany model samochodu: " + selectedModel);

       
        var quantityInput = document.getElementById("quantity");
        var quantityToBuy = quantityInput.value;
        console.log("Ilość do zakupu: " + quantityToBuy);

        
        if (selectedModel !== "") {
            
            return true;
        } else {
           
            console.error("Nie wybrano modelu samochodu.");
            return false;
        }
    }
</script>';

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['model_samochodu']) && isset($_POST['transaction_id'])) {
           
            $transaction_id = $_POST['transaction_id'];
            if (isset($_SESSION['transactions']) && in_array($transaction_id, $_SESSION['transactions'])) {
                echo "<p>Transakcja została już zrealizowana.</p>";
            } else {
               
                $_SESSION['transactions'][] = $transaction_id;
                $quantity_to_buy = $_POST['quantity'];
                $car_model = $_POST['model_samochodu'];

                
                $sql_availability_check = "SELECT dostepna_ilosc FROM tranzakcje WHERE model_samochodu = '$car_model'";
                $result_availability_check = $conn->query($sql_availability_check);
                $row_availability_check = $result_availability_check->fetch_assoc();
                if ($row_availability_check["dostepna_ilosc"] > 0 && $quantity_to_buy > 0) {
                    
                    $update_sql = "UPDATE tranzakcje SET dostepna_ilosc = dostepna_ilosc - ? WHERE model_samochodu = ?";
                    $stmt = $conn->prepare($update_sql);
                    $stmt->bind_param("is", $quantity_to_buy, $car_model);
                    if ($stmt->execute()) {
                        
                        echo "<p>Samochód został pomyślnie kupiony!</p>";
                        $price_sql = "SELECT cena_samochodu FROM tranzakcje WHERE model_samochodu = ?";
                        $price_stmt = $conn->prepare($price_sql);
                        $price_stmt->bind_param("s", $car_model);
                        $price_stmt->execute();
                        $price_result = $price_stmt->get_result();
                        $price_row = $price_result->fetch_assoc();
                        $car_price = $price_row['cena_samochodu'];
                        $total_price = $quantity_to_buy * $car_price;
                        echo "<p>Twoja faktura:</p>";
                        echo "<p>Model samochodu: " . $car_model . "</p>";
                        echo "<p>Ilość: " . $quantity_to_buy . "</p>";
                        echo "<p>Cena za sztukę: " . $car_price . " PLN</p>";
                        echo "<p>Całkowita cena: " . $total_price . " PLN</p>";
                        $invoice_data = "Model samochodu: $car_model\nIlość: $quantity_to_buy\nCena jednostkowa: $car_price\nCena całkowita: $total_price";
                        $file_name = "FAKTURA_" . $_SESSION['user_id'] . "_" . date("Y-m-d_H-i-s") . ".txt";
                        file_put_contents("./invoices/$file_name", $invoice_data);
                    } else {
                        echo "<p>Wystąpił problem podczas zakupu samochodu.</p>";
                    }
                    $stmt->close();
                    $price_stmt->close();
                } else {
                    echo "<p>Niedostępna ilość samochodów do zakupu.</p>";
                }
            }
        } else {
            echo "<p>Nie wybrano modelu samochodu lub identyfikator transakcji jest nieprawidłowy.</p>";
        }
    }
} else {
    
    header('Location: ./login.php');
}
?>
<?php include('./items/footer.php'); ?>
</main>
</body>
</html>
