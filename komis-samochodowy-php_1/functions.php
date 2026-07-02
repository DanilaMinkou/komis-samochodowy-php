<?php

function update_login_count($user_id, $conn) {
    
    $sql = "UPDATE klienci SET liczba_logowan = liczba_logowan + 1 WHERE id_klienta='$user_id';";
    
    $conn->query($sql);
}
?>


