<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Note;
use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Note::factory(10)->create();

        $tags = ['work', 'important'];
        foreach ($tags as $tag) {

            Tag::factory()->create([
                'name' => $tag,
                'user_id' => 1,
            ])->each(function ($tag) {
                Note::factory(10)->create()->each(function ($note) use ($tag) {
                    $note->tags()->attach($tag);
                });

                // $tag->notes()->attach(Note::all()->random());
            });
        }

        // Tag::factory()->create([
        // 'name' => 'Work',
        // 'user_id' => 1,
        // ]);
    }
}
