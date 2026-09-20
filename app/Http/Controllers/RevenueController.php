<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Payment::with([
            'parkingSession.vehicle',
            'parkingSession.parkingSpot.parkingLocation',
        ])->latest('paid_at');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                    ->orWhereHas('parkingSession.vehicle', function ($vehicle) use ($search) {
                        $vehicle->where('registration_number', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('paid_at', $request->date);
        }

        $payments = $query->paginate(15)->withQueryString();

        $totalRevenue = Payment::where('status', 'paid')->sum('amount');

        $todayRevenue = Payment::where('status', 'paid')
            ->whereDate('paid_at', today())
            ->sum('amount');

        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        $paidCount = Payment::where('status', 'paid')->count();

        $pendingCount = Payment::where('status', 'pending')->count();

        $failedCount = Payment::whereIn('status', ['failed', 'cancelled'])->count();

        $paymentMethods = Payment::whereNotNull('payment_method')
            ->select('payment_method')
            ->distinct()
            ->orderBy('payment_method')
            ->pluck('payment_method');

        return view('parkflow.revenue.index', compact(
            'user',
            'payments',
            'totalRevenue',
            'todayRevenue',
            'monthlyRevenue',
            'paidCount',
            'pendingCount',
            'failedCount',
            'paymentMethods'
        ));
    }
}
