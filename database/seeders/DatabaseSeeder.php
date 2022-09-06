<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        $this->call([
            // UserSeeder::class,
            // AdminTablesSeeder::class,
            // PostMenuTablesSeeder::class,
            // CategoriesSeeder::class,
            // FormReportSeeder::class,
        ]);

        // Seeding Blog
        Schema::disableForeignKeyConstraints();
        // \App\Models\Blog::truncate();
        // \App\Models\BlogImages::truncate();
        \App\Models\BlogView::truncate();
        \App\Models\BlogLikes::truncate();
        // \App\Models\BlogComments::truncate();

        Schema::enableForeignKeyConstraints();
        // \App\Models\Blog::factory(30)->create();
        // \App\Models\BlogImages::factory(45)->create();
        \App\Models\BlogView::factory(500)->create();
        \App\Models\BlogLikes::factory(500)->create();
        // \App\Models\BlogComments::factory(50)->create();

        // // Seeding News
        Schema::disableForeignKeyConstraints();
        // \App\Models\News::truncate();
        \App\Models\NewsView::truncate();
        // \App\Models\NewsComments::truncate();

        // Schema::enableForeignKeyConstraints();
        // \App\Models\News::factory(30)->create();
        \App\Models\NewsView::factory(500)->create();
        // \App\Models\NewsComments::factory(50)->create();
        
        // // Seeding Inform
        // Schema::disableForeignKeyConstraints();
        // \App\Models\Inform::truncate();
        // \App\Models\UserProgress::truncate();

        // Schema::enableForeignKeyConstraints();
        // \App\Models\Inform::factory(15)->create();
        // \App\Models\UserProgress::factory(15)->create();
    }
}
