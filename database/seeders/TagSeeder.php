<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Word;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $word_ids = Word::pluck('id')->toArray();
        $tags = [
            ['title' => 'HTML', 'color' => '#DC3545'],
            ['title' => 'CSS', 'color' => '#0D6EFD'],
            ['title' => 'Boostrap', 'color' => '#6C757D'],
            ['title' => 'JS', 'color' => '#FFC107'],
            ['title' => 'Vue', 'color' => '#198754'],
            ['title' => 'PHP', 'color' => '#0DCAF0'],
            ['title' => 'Laravel', 'color' => '#F03E30'],
            ['title' => 'Git', 'color' => '#E34C26'],
            ['title' => 'OOP', 'color' => '#563D7C'],
            ['title' => 'SQL', 'color' => '#212529'],
        ];

        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->title = $tag['title'];
            $new_tag->color = $tag['color'];

            $new_tag->word_id = Arr::random($word_ids);

            $new_tag->save();

            $tag_words = array_filter($word_ids, fn () => rand(0, 1));

            $new_tag->words()->attach($tag_words);
        }
    }
}
