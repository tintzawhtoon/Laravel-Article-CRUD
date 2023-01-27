<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\Article::factory(20)->create();
        \App\Models\Comment::factory(40)->create();

        $list = ["General", "Tech", "Story", "Novel", "Travel"];

        foreach($list as $name) {
            \App\Models\Category::create([
                'name' => $name
            ]);
        }

        \App\Models\User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
    }
}
