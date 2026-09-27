<?php

namespace Database\Seeders;

use App\Models\Customer;
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
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

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

        $users = [];

        foreach ($names as $index => $name) {
            $users[] = User::updateOrCreate(
                [
                    'email' => 'user' . ($index + 1) . '@parkflow.test',
                ],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        $addresses = [
            'Dhanmondi, Dhaka',
            'Uttara, Dhaka',
            'Mirpur, Dhaka',
            'Gulshan, Dhaka',
            'Mohammadpur, Dhaka',
        ];

        $customers = [];

        foreach ($users as $index => $user) {
            $customers[] = Customer::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'name' => $user->name,
                    'phone' => '017' . str_pad(
                        1000000 + $index,
                        7,
                        '0',
                        STR_PAD_LEFT
                    ),
                    'email' => $user->email,
                    'address' => $addresses[$index % count($addresses)],
                    'is_active' => true,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Parking Locations
        |--------------------------------------------------------------------------
        */

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
                [
                    'name' => $location['name'],
                ],
                [
                    'address' => $location['address'],
                    'city' => $location['city'],
                    'phone' => $location['phone'],
                    'total_spots' => 24,
                    'is_active' => true,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Parking Spots
        |--------------------------------------------------------------------------
        */

        foreach ($parkingLocations as $location) {
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
                        'spot_number' => 'A-' . str_pad(
                            $i,
                            3,
                            '0',
                            STR_PAD_LEFT
                        ),
                    ],
                    [
                        'floor' => 'Ground Floor',
                        'vehicle_type' => $type,
                        'status' => 'available',
                        'is_active' => true,
                    ]
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Vehicles
        |--------------------------------------------------------------------------
        */

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

        $vehicleModels = [
            'Toyota Corolla',
            'Honda Civic',
            'Nissan X-Trail',
            'Toyota Axio',
            'Honda Vezel',
            'Suzuki Swift',
            'Toyota Premio',
            'Mitsubishi Outlander',
        ];

        $vehicleColors = [
            'White',
            'Black',
            'Silver',
            'Grey',
            'Blue',
            'Red',
        ];

        $vehicles = [];

        for ($i = 1; $i <= 86; $i++) {
            $ownerIndex = ($i - 1) % count($customers);
            $customer = $customers[$ownerIndex];

            $prefix = $vehiclePrefixes[($i - 1) % count($vehiclePrefixes)];

            $number = str_pad(
                1000 + $i,
                4,
                '0',
                STR_PAD_LEFT
            );

            $registrationNumber = $prefix
                . '-'
                . (10 + ($i % 90))
                . '-'
                . $number;

            $vehicles[] = Vehicle::updateOrCreate(
                [
                    'registration_number' => $registrationNumber,
                ],
                [
                    'vehicle_type' => $vehicleTypes[($i - 1) % count($vehicleTypes)],
                    'owner_name' => $customer->name,
                    'phone' => $customer->phone,
                    'model' => $vehicleModels[($i - 1) % count($vehicleModels)],
                    'color' => $vehicleColors[($i - 1) % count($vehicleColors)],
                    'is_active' => true,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Reset Parking Spot Status
        |--------------------------------------------------------------------------
        */

        ParkingSpot::query()->update([
            'status' => 'available',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Active Parking Sessions
        |--------------------------------------------------------------------------
        */

        $activeSpots = ParkingSpot::query()
            ->where('is_active', true)
            ->where('status', 'available')
            ->orderBy('id')
            ->take(18)
            ->get();

        foreach ($activeSpots as $index => $spot) {
            $vehicle = $vehicles[$index];

            ParkingSession::updateOrCreate(
                [
                    'vehicle_id' => $vehicle->id,
                    'status' => 'active',
                ],
                [
                    'parking_spot_id' => $spot->id,
                    'entry_time' => now()->subMinutes(
                        45 + ($index * 12)
                    ),
                    'exit_time' => null,
                    'status' => 'active',
                    'entry_gate' => 'Gate ' . (($index % 3) + 1),
                    'exit_gate' => null,
                    'duration_minutes' => 45 + ($index * 12),
                    'parking_fee' => 0,
                    'discount' => 0,
                    'total_amount' => 0,
                ]
            );

            $spot->update([
                'status' => 'occupied',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Completed Parking Sessions
        |--------------------------------------------------------------------------
        */

        $completedSpots = ParkingSpot::query()
            ->where('is_active', true)
            ->where('status', 'available')
            ->orderBy('id')
            ->take(30)
            ->get();

        for ($i = 0; $i < $completedSpots->count(); $i++) {
            $spot = $completedSpots[$i];
            $vehicle = $vehicles[18 + $i];

            $durationMinutes = 60 + (($i % 8) * 30);
            $entryTime = now()
                ->subDays(1 + ($i % 7))
                ->subMinutes($durationMinutes + 30);

            $exitTime = $entryTime->copy()
                ->addMinutes($durationMinutes);

            $parkingFee = ceil($durationMinutes / 60) * 50;
            $discount = ($i % 5 === 0) ? 50 : 0;
            $totalAmount = max(
                0,
                $parkingFee - $discount
            );

            $session = ParkingSession::updateOrCreate(
                [
                    'vehicle_id' => $vehicle->id,
                    'status' => 'completed',
                ],
                [
                    'parking_spot_id' => $spot->id,
                    'entry_time' => $entryTime,
                    'exit_time' => $exitTime,
                    'status' => 'completed',
                    'entry_gate' => 'Gate ' . (($i % 3) + 1),
                    'exit_gate' => 'Gate ' . ((($i + 1) % 3) + 1),
                    'duration_minutes' => $durationMinutes,
                    'parking_fee' => $parkingFee,
                    'discount' => $discount,
                    'total_amount' => $totalAmount,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Payment
            |--------------------------------------------------------------------------
            */

            Payment::updateOrCreate(
                [
                    'parking_session_id' => $session->id,
                ],
                [
                    'transaction_id' => 'PF-PAY-'
                        . $session->id
                        . '-'
                        . date('Ymd'),

                    'amount' => $totalAmount,

                    'payment_method' => [
                        'cash',
                        'bkash',
                        'nagad',
                        'card',
                    ][$i % 4],

                    'status' => 'paid',

                    'paid_at' => $exitTime,
                ]
            );
        }
    }
}
