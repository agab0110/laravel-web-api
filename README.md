# Link tutorial
https://www.youtube.com/watch?v=9FJeoq5z1_Y

# Laravel query builder package
Questo package viene usato per filtrare la lista di tutte le task con la paginazione nella funzione index di TaskController

composer require spatie/laravel-query-builder

# Package laravel per autenticazione
Dovrebbe essere già preistallato, controllare in composer.json se c'è la voce laravel/sanctum, nel caso non ci sia scrivere:

composer require laravel/sanctum

Nel caso sia presente andare in Kernel.php, e nella voce api (riga 42) decommentare il package

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

# Cose utili
Per fare l'hash di una password: 'password' => static::$password ??= Hash::make('password'), 

# Postman
Quando si vogliono provare le api in postman si deve inserire nell'header della chiamata il token dell'utente con cui viene fatto l'accesso, questo può essere preso facendo un login con un utente nel database, come output si avrà il token e il tipo di token.
Copiare il tipo di token e poi il token all'interno dell'header "Authorization" (probabilmente si deve creare) e dovrebbe funzionare 
