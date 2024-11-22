

# ToDoApp

Aplikacja służąca do śledzenia zadań

## Uruchomienie oraz konfiguracja

1) Sklonuj repozytorium
2) Utwórz plik .env kopiując plik .env.example
3) Uruchom kontener za pomocą komendy:
    ```
    docker compose up
    ```
    Lub jeżeli chcesz skorzystać z laravel sail:
    
    ```
    composer install
    alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
    sail up
    ```
4) Generowanie klucza: 
    Docker:
    ```
    docer exec todoapp-laravel.test-1 artisan key:generate
    ```
    Sail:
    ```
    Sail artisan key:generate
    ```
5) Migracja bazy danych:
    Docker:
    ```
    docer exec todoapp-laravel.test-1 artisan migrate
    ```
    Sail:
    ```
    Sail artisan migrate
    ```
6) Uruchomienie npm:
    Docker:
    ```
    docer exec todoapp-laravel.test-1 npm install
    docer exec todoapp-laravel.test-1 npm run dev
    ```
    Sail:
    ```
    Sail npm install
    Sail npm run dev
    ```

Dla uzytkowników Windowsa:
Kontener najlepiej uruchamiać z warstwy wsl. 

Kolejkowanie oraz zadania są uruchamiane automatycznie.

Aby działała wysyłka maili należy uzupełnić dane logowania do maila w pliku .env: