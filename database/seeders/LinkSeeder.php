<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Word;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $links = [
            ['title' => 'Wikipedia', 'url' => 'https://it.wikipedia.org/wikiPagina_principale'],
            ['title' => 'W3schools', 'url' => 'https://www.w3schools.com/'],
            ['title' => 'Treccani', 'url' => 'https://www.treccani.it/vocabolario/'],
            ['title' => 'Bootstrap', 'url' => 'https://getbootstrap.com/'],
            ['title' => 'Freecodecamp', 'url' => 'https://www.freecodecamp.org/italian/news'],
            ['title' => 'MDN', 'url' => 'https://developer.mozilla.org/en-US/'],
            ['title' => 'Googlefonts', 'url' => 'https://fonts.google.com/'],
        ];

        $word_ids = Word::pluck('id')->toArray();

        foreach ($links as $link) {
            $new_link = new Link();

            $new_link->title = $link['title'];
            $new_link->url = $link['url'];


            $new_link->word_id = Arr::random($word_ids);

            $new_link->save();
        }
    }
}
