<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Poli Umum',
                'prefix' => 'A'
            ],
            [
                'name' => 'Poli Gigi',
                'prefix' => 'B'
            ],
            [
                'name' => 'Poli Anak',
                'prefix' => 'C'
            ],
            [
                'name' => 'Poli Mata',
                'prefix' => 'D'
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
