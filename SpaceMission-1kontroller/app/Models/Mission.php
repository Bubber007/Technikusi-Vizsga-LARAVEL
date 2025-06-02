<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mission extends Model
{
    // Az adatbázis tábla neve
    protected $table = 'missions';

    // Az adatbázis tábla elsődleges kulcsa
    protected $primaryKey = '_id';

    // A guarded tömb azt jelenti, hogy nincs tiltott mező a tömeges kitöltés
    protected $guarded = [];

    // Nem használunk automatikus created_at / updated_at időbélyegeket
    public $timestamps = false;

    // Ezeket a mezőket automatikusan elrejti a JSON válaszokból
    protected $hidden = [
        '_id',
        'agency_id'
    ];


     /**
     * Egy küldetéshez (Mission) tartozik egy űrügynökség (SpaceAgency)
     * Ez a kapcsolatot az 'agency_id' (idegen kulcs) és a 'space_agencies._id' (elsődleges kulcs) között hozza létre.
     * Ez a kapcsolat BelongsTo, mert a mission "tartozik valakihez" (a küldetés egy ügynökséghez tartozik)
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(SpaceAgency::class, 'agency_id', '_id');
    }


    /**
     * Egy küldetéshez egy parancsnok (Commander) tartozhat.
     * Ez a kapcsolat HasOne, mivel egy mission legfeljebb egy commandert kaphat.
     * A kapcsolat a 'commanders.mission_id' mezőn keresztül jön létre, ami a mission '_id' mezőjére mutat.
     */
    public function commander(): HasOne
    {
        return $this->hasOne(Commander::class, 'mission_id', '_id');
    }

}
