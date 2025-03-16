<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batchSize = 5000; // প্রতি ব্যাচে 5000 ডাটা তৈরি হবে
        $totalRecords = 100000;

        for ($i = 0; $i < ($totalRecords / $batchSize); $i++) {
            Article::factory($batchSize)->create();
        }
    }
}
