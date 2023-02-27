<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            // CountrySeeder::class,
             TranslationSeeder::class,
             DataTypeSeeder::class,
              UserSeeder::class
        //    ArchiveFileSeeder::class
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'pname' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
