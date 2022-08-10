<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Kategori;
use App\Models\product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        Kategori::create([
            'name' => 'Facial Shoap'
        ]);
        Kategori::create([
            'name' => 'Toner'
        ]);
        Kategori::create([
            'name' => 'Serum'
        ]);
        Kategori::create([
            'name' => 'Sunscreen'
        ]);
        Kategori::create([
            'name' => 'Other'
        ]);

        product::factory(30)->create();
    }
}
