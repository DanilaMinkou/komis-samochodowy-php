# System Obsługi Komisu Samochodowego (PHP & MySQL)

Kompletna aplikacja webowa typu CRUD stworzona jako zaawansowany projekt szkolny (na ocenę celującą), symulująca system zarządzania transakcjami oraz bazą klientów w komisie samochodowym.

## 🚀 Kluczowe funkcjonalności

* **System Autentykacji:** Pełna obsługa rejestracji (`register.php`) oraz logowania (`login.php`) użytkowników wraz z bezpiecznym zarządzaniem sesją (`logout.php`).
* **Relacyjna Baza Danych:** Struktura SQL oparta na powiązanych tabelach: `klienci`, `sprzedawcy`, `tranzakcje` oraz `magazyn`.
* **Bezpieczeństwo (SQL Injection):** Formularze i zapytania dynamiczne do bazy danych zostały zabezpieczone przy użyciu mechanizmu parametrów wiązanych (**Prepared Statements**).
* **Generowanie Faktur:** System automatycznie generuje i zapisuje potwierdzenia sprzedaży w formie plików tekstowych w katalogu `/invoices/`.
* **Architektura Kodu:** Zastosowanie podziału na moduły wielokrotnego użytku (`header.php`, `footer.php`) oraz wydzielenie konfiguracji bazy danych (`db_config.php`).

## 🛠️ Użyte technologie

* **Backend:** PHP 8.2 (Proceduralny z elementami obiektowego MySQLi)
* **Frontend:** HTML5, CSS3, Bootstrap (kontenery i komponenty formularzy)
* **Baza danych:** MySQL / MariaDB (zarządzana przez phpMyAdmin)

## 🗄️ Struktura Bazy Danych
Projekt korzysta z bazy danych `komiks_samochodowy`. Przykładowe tabele:
* `klienci` - przechowuje dane logowania oraz licznik wizyt (`liczba_logowan`).
* `sprzedawcy` - rejestr pracowników komisu (imię, nazwisko, wiek).
* `tranzakcje` - pełna lista samochodów przypisanych do konkretnych sprzedawców, zawierająca markę, model, rok produkcji oraz cenę.

## 💻 Jak uruchomić?
1. Sklonuj repozytorium do folderu `xampp/htdocs/`.
2. Zaimportuj plik `komiks_samochodowy.sql` w swoim lokalnym panelu phpMyAdmin.
3. Dostosuj dane logowania do bazy w pliku `scripts/db_config.php`.
4. Uruchom serwer i przejdź pod adres `http://localhost/komis-samochodowy-php/`.
