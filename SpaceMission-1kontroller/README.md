DBForge: sql importálása
.env -> adatbázis neve
php artisan migrate 
modellek létrehozása: php artisan make:model
    - jellemzők beállítása ($primaryKey, $table, public $timestamps, $guarded)
    - kapcsolat metódusok (belongsTo, hasMany, hasOne)
controller létrehozása: php artisan make:controller DataController --api
api.php -> utvonalak letrehozasa (get-books -> getBooks)
    Route::get('/get-all-universities', [DataController::class, 'getAllUniversities']);
-DataController: 
    metódusok létrehozása




