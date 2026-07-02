<?php 

include('./items/header.php');
?>
<div class="container mt-5">
    <h1>Wybierz sprzedawcę</h1>
    <form method="post">
        <div class="mb-3">
            <label for="sprzedawca" class="form-label">Wybierz sprzedawcę:</label>
            <select class="form-select" name="sprzedawca" id="sprzedawca">
                <?php
                
                require('scripts/db_config.php');
                $conn = mysqli_connect($my_server, $my_login_db, $my_pass_db, $my_db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $query = "SELECT id_sprzedawcy, nazwisko_sprzedawcy, imie_sprzedawcy FROM sprzedawcy;";
                $result = $conn->query($query);
                
                if ($result->num_rows > 0) {
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['id_sprzedawcy']) . "'>" . htmlspecialchars($row['nazwisko_sprzedawcy']) . " " . htmlspecialchars($row['imie_sprzedawcy']) . "</option>";
                    }
                }
                
                $conn->close();
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Wyświetl transakcje</button>
    </form>

    <div class="mt-5">
        <?php
       
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sprzedawca'])) {
            $sprzedawca_id = $_POST['sprzedawca'];

            
            $conn = mysqli_connect($my_server, $my_login_db, $my_pass_db, $my_db);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $query = "SELECT * FROM tranzakcje WHERE id_sprzedawcy = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $sprzedawca_id);
            $stmt->execute();
            $result = $stmt->get_result();

           
            if ($result->num_rows > 0) {
                echo "<h2>Transakcje:</h2>";
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($row['marka_samochodu']) . " " . htmlspecialchars($row['model_samochodu']) . ", rok produkcji: " . htmlspecialchars($row['rok_produkcji']) . ", cena: " . htmlspecialchars($row['cena_samochodu']) . "</li>";
                }
                echo "</ul>";
            }

            
            $stmt->close();
            $conn->close();
        } else {
            echo "Proszę wybrać sprzedawcę.";
        }
        ?>
    </div>
</div>
<?php include('./items/footer.php'); ?>


