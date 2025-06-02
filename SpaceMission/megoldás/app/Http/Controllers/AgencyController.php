<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgencyController extends Controller
{
    public function agencyMissions()
    {
        $result = DB::table('space_agencies')
            ->join('missions', 'space_agencies._id', '=', 'missions.agency_id')
            ->groupBy('space_agencies.name')
            ->select('space_agencies.name', DB::raw('count(*) as total_missions'))
            ->get();
        return response()->json($result);
    }
}
