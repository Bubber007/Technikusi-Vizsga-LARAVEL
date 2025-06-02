<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommanderResource;
use App\Models\Commander;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommanderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commanders = Commander::orderBy('commander_name')->get();
        return response()->json(CommanderResource::collection($commanders));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mission_id' => 'required|integer',
            'commander_name' => 'required|string',
            'experience_years' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mission = Mission::find($request->mission_id);
        if ($mission->commander) {
            return response()->json(['message' => 'A commander already exists for this mission'], 403);
        }

        $commander = Commander::create($request->all());
        return response()->json($commander, 201);
    }

    public function count() 
    {
        $count = Commander::count();
        return response()->json(['count' => $count]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commander $commander)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commander $commander)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commander $commander)
    {
        //
    }
}
