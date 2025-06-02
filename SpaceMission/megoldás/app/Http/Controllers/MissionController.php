<?php

namespace App\Http\Controllers;

use App\Http\Resources\MissionResource;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::with('agency', 'commander')->orderBy('launch_date')->get();

        $index = 1;
        foreach ($missions as $mission) {
            $mission['index'] = $index++;
        }

        return response()->json($missions);
    }

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
            // return response()->json(['message' => 'Validation failed'], 422);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mission = Mission::create($request->all());
        return response()->json($mission);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $mission = Mission::with('agency', 'commander')->find($id);
        $mission = Mission::find($id);
        if (!$mission) {
            return response()->json(['message' => 'Mission not found'], 404);
        }
        return response()->json(new MissionResource($mission));
    }

    /**
     * Remove the specified resource from storage.
     */
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
}
