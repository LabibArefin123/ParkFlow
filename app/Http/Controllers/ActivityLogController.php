<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller  
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $sessions = DB::table('sessions')
            ->where('user_id', $user->id)
            ->orderByDesc('last_activity')
            ->paginate(10);
        $activities = Activity::where('causer_type', get_class($user))
            ->where('causer_id', $user->id)
            ->latest()
            ->paginate(10, ['*'], 'activity_page');
        $currentSessionId = $request->session()->getId();
        return view('parkflow.activity_logs.index', compact('user','sessions', 'activities', 'currentSessionId'));
    }
}
