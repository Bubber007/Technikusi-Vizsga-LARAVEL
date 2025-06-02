<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommanderResource;
use App\Models\Commander;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::with('agency', 'commander')->orderBy('launch_date')->get();

        $index = 1;
        foreach ($missions as $mission){
            $mission['index'] = $index++;
        }

        return response()->json($missions);
    }

    // {
    //     "name": "Sputnik 1",
    //     "launch_date": "1957-10-04",
    //     "index": 1,
    //     "agency": {
    //       "name": "Roscosmos",
    //       "country": "Russia",
    //       "founded": "1992"
    //     },
    //     "commander": {
    //       "commander_name": "Yuri Gagarin",
    //       "experience_years": 19
    //     }
    //   }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'agency_id' => 'required|integer',
            'launch_date' => 'date'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed'], 422);
        }

        $mission = Mission::create($request->all());
        return response()->json($mission);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mission = Mission::find($id);
        if (!$mission) {
            return response()->json(['message' => 'Mission not found']);
        }
        return response()->json($mission);
    }


//    {
    //     "id": 1,
    //     "name": "Apollo 11",
    //     "launch_date": "1969-07-16",
    //     "agency_name": "NASA",
    //     "commander": "Neil Armstrong"
//      }



    public function destroy($id)
    {
            $mission = Mission::find($id);
            if (!$mission) {
                return response()->json(['message' => 'Mission not found'], 404);
            }

            if ($mission->commander) {
                return response()->json(['message' => 'Mission cannot be deleted, it has commander: '. $mission->commander->commander_name], 403);
            }

            $mission->delete();
            return response()->json(['message' => 'Mission deleted successfully']);
    }


    public function showCommanders()
    {
        $commanders = Commander::orderby('commander_name')->get();
        return response()->json(CommanderResource::collection($commanders));
    }


    //     {
    //        "commander_name": "Ajay Sharma",
    //        "experience_years": 9,
    //        "mission": "Mangalyaan"
    //   },



    public function storeCommander(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mission_id' => 'required|integer',
            'commander_name' => 'required|string',
            'experience_years' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $mission = Mission::find($request->mission_id);
        if (!$mission) {
            return response()->json(['message' => 'Mission not found'], 404);
        }

        $mission = Mission::find($request->mission_id);
        if ($mission->commander) {
            return response()->json(['message' => 'A commander already exists for this mission'], 403);
        }

        $commander = Commander::create($request->all());
        return response()->json($commander, 201);
    }

    public function countCommanders()
    {
        $count = Commander::count();
        return response()->json(['count' => $count]);
    }


    // {
    //     "count": 21
    // }



    //GROUP BY
    public function AgencyGroup()
    {
         // Lekérdezzük az adatokat az 'space_agencies' (űrügynökségek) táblából
        $stat = DB::table('space_agencies')

            // Összekapcsoljuk a 'missions' (küldetések) táblával
            // A kapcsolat az 'space_agencies._id' és a 'missions.agency_id' mezők alapján történik
            ->join('missions', 'space_agencies._id', '=', 'missions.agency_id')

            // Csoportosítjuk az adatokat az ügynökség neve szerint
            // Ez azt jelenti, hogy minden ügynökséghez összeszámoljuk, hány küldetést hajtott végre
            ->groupBy('space_agencies.name')

            // Kiválasztjuk:
            // - az ügynökség nevét
            // - és megszámoljuk, hány küldetés tartozik hozzá (COUNT(*))
            ->select(
                'space_agencies.name', // A cég neve
                DB::raw('COUNT(*) AS total_missions') // Aszteroidák száma az adott cégnél
            )

            // Lefuttatjuk a lekérdezést és lekérjük az eredményeket
            ->get();

        // JSON formátumban visszaküldjük az eredményt (pl. API válaszként)
        return response()->json($stat);

    }


        //     {
        //          "name": "CNSA",
        //          "total_missions": 4
        //      },
        //      {
        //          "name": "ESA",
        //          "total_missions": 3
        //       }
}
