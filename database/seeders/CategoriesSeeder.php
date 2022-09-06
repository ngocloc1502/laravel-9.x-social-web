<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \App\Models\Categories::truncate();
        
        Schema::enableForeignKeyConstraints();
        \App\Models\Categories::insert([
            [
                'name' => 'Nông trại',
                'slug' => 'Farm',
                'uri' => '/categories/farm'
            ],
            [
                'name' => 'Sơ chế',
                'slug' => 'Processing',
                'uri' => '/categories/processing'
            ],
            [
                'name' => 'Công thức',
                'slug' => 'Drink',
                'uri' => '/categories/drink'
            ],
        ]);
    }
}
