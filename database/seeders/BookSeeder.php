<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        $title = 'avanza';
        DB::table('books')->insert([
            'book_code' => '1',
            'title' => $title,
            'slug' => Str::slug($title),
            'tahun_keluar' => '2018',
            'pendapatan' => '',
            'durasi_sewa' => '2000 jam',
            'keterangan' => 'apa bjir',
            'status' => 'in stock'

        ]);
    }
}
