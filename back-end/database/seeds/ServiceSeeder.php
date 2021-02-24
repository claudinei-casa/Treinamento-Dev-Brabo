<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'icon'=>'seederIcon',
            'service'=>'seederService',
            'description'=>'seederDescription'
        ]);
    }
}

