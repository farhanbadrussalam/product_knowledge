<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
