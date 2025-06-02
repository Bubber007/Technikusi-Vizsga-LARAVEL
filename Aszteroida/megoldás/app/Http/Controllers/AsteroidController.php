<?php

namespace App\Http\Controllers;

use App\Http\Resources\AsteroidResource;
use App\Models\Asteroid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AsteroidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asteroids = Asteroid::orderBy('discovered_date', 'asc')->get();
        // $asteroids = Asteroid::with('corporation')->orderBy('discovered_date', 'asc')->get();
        $index = 1;
        foreach ($asteroids as $asteroid) {
            $asteroid['index'] = $index . '.';
            $index++;
        }
        return response()->json(AsteroidResource::collection($asteroids));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'corporation_id' => 'required|exists:mining_corporations,_id',
            'discovered_date' => 'date',
            'mineral_content' => 'string'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid data'], 400);
        }
        $asteroid = Asteroid::create($request->all());
        return response()->json($asteroid, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asteroid = Asteroid::find($id);
        if (!$asteroid) {
            return response()->json(['message' => 'Asteroid not found'], 404);
        }

        if ($asteroid->leader) {
            return response()->json(['message' => 'Asteroid has a leader ('.$asteroid->leader->leader_name.'), cannot delete'], 403);
        }

        $asteroid->delete();
        return response()->json(['message' => 'Asteroid deleted successfully']);
    }

    public function discoveredAfter($year)
    {
        $asteroids = Asteroid::whereYear('discovered_date', '>=', $year)->get();
        return response()->json($asteroids);
    }

    public function stat()
    {
    //     SELECT
    //     mining_corporations.name, COUNT(*) AS total_asteroids
    //   FROM asteroids
    //     INNER JOIN mining_corporations
    //       ON asteroids.corporation_id = mining_corporations._id
    //     GROUP BY mining_corporations.name
        $stat = DB::table('asteroids')
            ->join('mining_corporations', 'asteroids.corporation_id', '=', 'mining_corporations._id')
            ->groupBy('mining_corporations.name')
            ->select('mining_corporations.name', DB::raw('COUNT(*) AS total_asteroids'))
            ->get();
        return response()->json($stat);
    }
}
