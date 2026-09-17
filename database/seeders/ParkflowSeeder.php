<?php

namespace Database\Seeders;

use App\Models\ParkingLocation;
use App\Models\ParkingSession;
use App\Models\ParkingSpot;
use App\Models\Payment;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ParkFlowSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Md. Rahim Uddin',
            'Nusrat Jahan',
            'Sakib Ahmed',
            'Tanvir Hasan',
            'Farhana Akter',
            'Mahmudul Hasan',
            'Imran Hossain',
            'Mehedi Hasan',
            'Sadia Islam',
            'Arif Hossain',
            'Shakil Ahmed',
            'Jannatul Ferdous',
            'Rakibul Islam',
            'Moumita Akter',
            'Fahim Rahman',
            'Rashed Khan',
            'Sumaiya Rahman',
            'Shuvo Ahmed',
            'Tanjim Hasan',
            'Priya Sultana',
            'Hasan Mahmud',
            'Anika Rahman',
            'Sohel Rana',
            'Afsana Akter',
        ];

        foreach ($names as $index => $name) {
            User::updateOrCreate(
                ['email' => 'user' . ($index + 1) . '@parkflow.test'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                ]
            );
        }

        $locations = [
            [
                'name' => 'Bashundhara City Parking',
                'address' => 'Panthapath, Dhaka',
                'city' => 'Dhaka',
                'phone' => '01711000001',
            ],
            [
                'name' => 'Jamuna Future Park Parking',
                'address' => 'Kuril, Dhaka',
                'city' => 'Dhaka',
                'phone' => '01711000002',
            ],
            [
                'name' => 'Dhanmondi Central Parking',
                'address' => 'Dhanmondi, Dhaka',
                'city' => 'Dhaka',
                'phone' => '01711000003',
            ],
            [
                'name' => 'Uttara Sector 7 Parking',
                'address' => 'Sector 7, Uttara, Dhaka',
                'city' => 'Dhaka',
                'phone' => '01711000004',
            ],
            [
                'name' => 'Gulshan Avenue Parking',
                'address' => 'Gulshan Avenue, Dhaka',
                'city' => 'Dhaka',
                'phone' => '01711000005',
            ],
        ];

        $parkingLocations = [];

        foreach ($locations as $location) {
            $parkingLocations[] = ParkingLocation::updateOrCreate(
                ['name' => $location['name']],
                [
                    'address' => $location['address'],
                    'city' => $location['city'],
                    'phone' => $location['phone'],
                    'total_spots' => 24,
                    'is_active' => true,
                ]
            );
        }

        $spotIndex = 1;

        foreach ($parkingLocations as $locationIndex => $location) {
            for ($i = 1; $i <= 24; $i++) {
                $type = 'car';

                if ($i % 10 === 0) {
                    $type = 'microbus';
                } elseif ($i % 7 === 0) {
                    $type = 'cng';
                } elseif ($i % 5 === 0) {
                    $type = 'motorcycle';
                }

                ParkingSpot::updateOrCreate(
                    [
                        'parking_location_id' => $location->id,
                        'spot_number' => 'A-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    ],
                    [
                        'floor' => 'Ground Floor',
                        'vehicle_type' => $type,
                        'status' => 'available',
                        'is_active' => true,
                    ]
                );

                $spotIndex++;
            }
        }

        $vehicleNames = [
            'Md. Rahim Uddin',
            'Nusrat Jahan',
            'Sakib Ahmed',
            'Tanvir Hasan',
            'Farhana Akter',
            'Mahmudul Hasan',
            'Imran Hossain',
            'Mehedi Hasan',
            'Sadia Islam',
            'Arif Hossain',
        ];

        $vehicleTypes = [
            'car',
            'car',
            'car',
            'motorcycle',
            'car',
            'microbus',
            'cng',
        ];

        $vehiclePrefixes = [
            'DHAKA METRO-GA',
            'DHAKA METRO-GHA',
            'DHAKA METRO-HA',
            'DHAKA METRO-LA',
            'DHAKA METRO-KA',
            'DHAKA METRO-CHA',
            'CTG METRO-TA',
            'SYLHET METRO-GA',
        ];

        $vehicles = [];

        for ($i = 1; $i <= 86; $i++) {
            $prefix = $vehiclePrefixes[($i - 1) % count($vehiclePrefixes)];
            $number = str_pad(1000 + $i, 4, '0', STR_PAD_LEFT);

            $vehicles[] = Vehicle::updateOrCreate(
                ['registration_number' => $prefix . '-' . (10 + ($i % 90)) . '-' . $number],
                [
                    'vehicle_type' => $vehicleTypes[($i - 1) % count($vehicleTypes)],
                    'owner_name' => $vehicleNames[($i - 1) % count($vehicleNames)],
                    'phone' => '01' . str_pad(700000000 + $i, 9, '0', STR_PAD_LEFT),
                    'model' => ($i % 3 === 0 ? 'Toyota Corolla' : ($i % 3 === 1 ? 'Honda Civic' : 'Nissan X-Trail')),
                    'color' => ($i % 2 === 0 ? 'White' : 'Black'),
                    'is_active' => true,
                ]
            );
        }

        $spots = ParkingSpot::orderBy('id')->take(18)->get();

        foreach ($spots as $index => $spot) {
            $vehicle = $vehicles[$index];

            ParkingSession::create([
                'parking_spot_id' => $spot->id,
                'vehicle_id' => $vehicle->id,
                'entry_time' => now()->subMinutes(45 + ($index * 12)),
                'status' => 'active',
                'entry_gate' => 'Gate ' . (($index % 3) + 1),
                'parking_fee' => 0,
                'discount' => 0,
                'total_amount' => 0,
            ]);

            $spot->update([
                'status' => 'occupied',
            ]);
        }

        $sessionIds = ParkingSession::pluck('id')->toArray();

        for ($i = 1; $i <= 428; $i++) {
            $sessionId = $sessionIds[($i - 1) % count($sessionIds)];

            Payment::create([
                'parking_session_id' => $sessionId,
                'transaction_id' => 'PF-PAY-' . date('Ymd') . '-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'amount' => [80, 100, 120, 150, 180, 200, 250][($i - 1) % 7],
                'payment_method' => ['cash', 'bkash', 'nagad', 'rocket', 'card'][($i - 1) % 5],
                'status' => 'paid',
                'paid_at' => now()->subMinutes($i % 720),
            ]);
        }
    }
}
