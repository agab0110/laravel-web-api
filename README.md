# Link tutorial
https://www.youtube.com/watch?v=9FJeoq5z1_Y

# Laravel query builder package
composer require spatie/laravel-query-builder

Questo package serve per filtrare la lista di tutte le task con la paginazione

# Connessione al database
Nel file .env si trovano le variabili globali per il collegamento al database, basta cambirne i valori in base al proprio database

Nel caso il nome del database non sia presente laravel provvederà a crearlo.

# Comandi laravel
- Per creare un nuovo progetto laravel: composer create-project laravel/laravel app-name
- Per visualizzare i comandi da linea di comando basta digitare: php artisan -h
- Per visualizzare cosa si può creare da linea di comando basta digitare: php artisan make -h
- Nella creazione è possibile usare dei flag, questi si possono visualizzare scrivendo: php artisan make:qualcosa -h
- Per migrare sul database si può digitare: php artisan migrate
- Usando "php artisan migrate:fresh si cancellano tutte le tabelle del database ricreandole secondo le migrazioni, per esempio si può usare quando si aggiorna una migrazione. Si perdono tutti i dati
