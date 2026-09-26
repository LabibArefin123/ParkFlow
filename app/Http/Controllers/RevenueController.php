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

        $payments->getCollection()->transform(function ($payment) {
            $method = strtolower($payment->payment_method ?? '');
            $status = strtolower($payment->status ?? '');
            $vehicleType = strtolower($payment->parkingSession?->vehicle?->type ?? '');

            $payment->display_transaction_id = $payment->transaction_id ?? 'N/A';
            $payment->display_payment_number = 'Payment #' . $payment->id;

            $payment->display_vehicle_number =
                $payment->parkingSession?->vehicle?->registration_number
                ?? 'Unknown Vehicle';

            $payment->display_vehicle_type =
                $payment->parkingSession?->vehicle?->type
                ?? 'Vehicle';

            $payment->vehicle_icon = match ($vehicleType) {
                'motorcycle' => 'fa-solid fa-motorcycle',
                'cng' => 'fa-solid fa-taxi',
                default => 'fa-solid fa-car-side',
            };

            $payment->display_location =
                $payment->parkingSession?->parkingSpot?->parkingLocation?->name
                ?? 'Main Parking';

            $payment->display_spot =
                'Spot ' . (
                    $payment->parkingSession?->parkingSpot?->spot_number
                    ?? '-'
                );

            $payment->method_class = $method;
            $payment->method_icon = match ($method) {
                'cash' => 'fa-solid fa-money-bill-wave',
                'bkash', 'nagad' => 'fa-solid fa-mobile-screen-button',
                'card' => 'fa-solid fa-credit-card',
                default => 'fa-solid fa-wallet',
            };

            $payment->method_label =
                ucfirst($payment->payment_method ?? 'Unknown');

            $payment->display_amount =
                '৳' . number_format($payment->amount, 2);

            $payment->display_paid_time =
                $payment->paid_at?->format('h:i A') ?? '-';

            $payment->display_paid_date =
                $payment->paid_at?->format('d M Y') ?? '-';

            $payment->status_class = $status;
            $payment->status_icon = match ($status) {
                'paid' => 'fa-solid fa-circle-check',
                'pending' => 'fa-solid fa-clock',
                default => 'fa-solid fa-circle-xmark',
            };

            $payment->status_label =
                ucfirst($payment->status ?? 'Unknown');

            return $payment;
        });

        $totalRevenue = Payment::where('status', 'paid')
            ->sum('amount');

        $todayRevenue = Payment::where('status', 'paid')
            ->whereDate('paid_at', today())
            ->sum('amount');

        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        $paidCount = Payment::where('status', 'paid')
            ->count();

        $pendingCount = Payment::where('status', 'pending')
            ->count();

        $failedCount = Payment::whereIn('status', ['failed', 'cancelled'])
            ->count();

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
