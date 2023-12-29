<?php

namespace Database\Seeders;

use App\Models\Tag;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsBase extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
        'name' => 'importante',
        'color' => 'DC2626'
        ]);
        Tag::create([
        'name' => 'opcional',
        'color' => '4F46E5'
        ]);
    }
}
