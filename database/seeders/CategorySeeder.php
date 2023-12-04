<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        category::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Manual',  'Matic',
        ];


        foreach ($data as $value) {
            Category::insert([
                'name' => $value,
                'slug' => Str::slug($value)
            ]);
        }
    }
}
