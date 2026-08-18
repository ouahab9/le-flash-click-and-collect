<?php

namespace Database\Seeders;

use App\Models\PickupSlot;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PickupSlotSeeder extends Seeder
{
    public function run(): void
    {
        $startDate = Carbon::today();

        for ($day = 0; $day < 7; $day++) {
            $date = $startDate->copy()->addDays($day);

            // Dimanche : pas de créneaux de test
            if ($date->isSunday()) {
                continue;
            }

            $slots = [
                ['14:30', '15:00'],
                ['15:00', '15:30'],
                ['15:30', '16:00'],
                ['16:00', '16:30'],
                ['16:30', '17:00'],
                ['17:00', '17:30'],
                ['17:30', '18:00'],
                ['18:00', '18:30'],
                ['18:30', '19:00'],
                ['19:00', '19:30'],
                ['19:30', '20:00'],
                ['20:00', '20:30'],
            ];

            foreach ($slots as [$start, $end]) {
                PickupSlot::updateOrCreate(
                    [
                        'date' => $date->toDateString(),
                        'start_time' => $start,
                        'end_time' => $end,
                    ],
                    [
                        'max_orders' => 5,
                        'active' => true,
                    ]
                );
            }
        }
    }
}
