<?php

namespace App\Http\Controllers;

use App\Models\ParkingSession;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $from = $request->filled('from')
            ? Carbon::parse($request->from)->startOfDay()
            : now()->startOfMonth();

        $to = $request->filled('to')
            ? Carbon::parse($request->to)->endOfDay()
            : now()->endOfDay();

        if ($from->gt($to)) {
            [$from, $to] = [$to, $from];
        }

        $paymentQuery = Payment::where('status', 'paid')
            ->whereBetween('paid_at', [$from, $to]);

        $sessionQuery = ParkingSession::whereBetween('entry_time', [$from, $to]);

        $totalRevenue = (clone $paymentQuery)->sum('amount');

        $paidTransactions = (clone $paymentQuery)->count();

        $totalSessions = (clone $sessionQuery)->count();

        $completedSessions = (clone $sessionQuery)
            ->where('status', 'completed')
            ->count();

        $activeSessions = (clone $sessionQuery)
            ->where('status', 'active')
            ->count();

        $cancelledSessions = (clone $sessionQuery)
            ->where('status', 'cancelled')
            ->count();

        $averageRevenue = $paidTransactions > 0
            ? $totalRevenue / $paidTransactions
            : 0;

        $vehicleTypes = ParkingSession::with('vehicle')
            ->whereBetween('entry_time', [$from, $to])
            ->get()
            ->groupBy(function ($session) {
                return ucfirst($session->vehicle?->type ?? 'Unknown');
            })
            ->map(function ($sessions) {
                return $sessions->count();
            })
            ->sortDesc();

        $paymentMethods = (clone $paymentQuery)
            ->select(
                'payment_method',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(amount) as amount')
            )
            ->groupBy('payment_method')
            ->orderByDesc('amount')
            ->get();

        $locationPerformance = ParkingSession::with('parkingSpot.parkingLocation')
            ->whereBetween('entry_time', [$from, $to])
            ->get()
            ->groupBy(function ($session) {
                return $session->parkingSpot?->parkingLocation?->name ?? 'Unknown Location';
            })
            ->map(function ($sessions) {
                return [
                    'sessions' => $sessions->count(),
                    'completed' => $sessions->where('status', 'completed')->count(),
                    'active' => $sessions->where('status', 'active')->count(),
                ];
            })
            ->sortByDesc('sessions');

        $dailyRevenue = Payment::where('status', 'paid')
            ->whereBetween('paid_at', [$from, $to])
            ->select(
                DB::raw('DATE(paid_at) as report_date'),
                DB::raw('COUNT(*) as transactions'),
                DB::raw('SUM(amount) as revenue')
            )
            ->groupBy(DB::raw('DATE(paid_at)'))
            ->orderBy('report_date')
            ->get();

        $recentSessions = ParkingSession::with([
            'vehicle',
            'parkingSpot.parkingLocation',
            'customer',
            'payment',
        ])
            ->where('status', 'completed')
            ->whereBetween('exit_time', [$from, $to])
            ->latest('exit_time')
            ->take(10)
            ->get();

        return view('parkflow.reports.index', compact(
            'user',
            'from',
            'to',
            'totalRevenue',
            'paidTransactions',
            'totalSessions',
            'completedSessions',
            'activeSessions',
            'cancelledSessions',
            'averageRevenue',
            'vehicleTypes',
            'paymentMethods',
            'locationPerformance',
            'dailyRevenue',
            'recentSessions'
        ));
    }
}
