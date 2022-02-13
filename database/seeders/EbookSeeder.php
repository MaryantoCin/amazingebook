<?php

namespace Database\Seeders;

use App\Models\Ebook;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EbookSeeder extends Seeder
{
    public function run()
    {
        // Ebook::factory(10)->create();
        $data = [
            ['title' => 'The Almost Sisters', 'author' => 'Joshilyn Jackson', 'description' => 'It’s a fast-reading, big-hearted novel that tackles Serious Issues really, really well—while spinning a terrific story.'],
            ['title' => 'I’ll Be Your Blue Sky', 'author' => 'Marisa de los Santos', 'description' => 'This March 2018 release was a Minimalist Summer Reading Guide pick for this year as well as one of my favorite books of 2018. This easy-to-read and emotionally resonant novel brings back the characters from De Los Santos’s bestseller Love Walked In.'],
            ['title' => 'The Widows of Malabar Hill', 'author' => 'Sujata Massey', 'description' => 'This atmospheric historical mystery is based in part on a real historical figure, the first female attorney in Bombay. This was our July selection for the MMD Book Club.'],
            ['title' => 'That Kind of Mother', 'author' => 'Rumaan Alam', 'description' => 'This much-anticipated new release was marked down to $2.99 just days after its May 8 release. (I would love to be a fly on the wall for these kinds of marketing conversations!) I found this to be a a thought-provoking novel about parenthood, race, adoption; your reviews indicate readers either love this one or hate it.'],
            ['title' => 'Tangerine', 'author' => 'Christine Mangan', 'description' => 'This hot spring title was also seriously discounted within weeks of release, which seriously upped sales numbers. Set in the oppressive heat of Morocco, it’s bursting with atmosphere, and played out like a Hitchcock movie in my mind. Recommended reading for fans of domestic noir.'],
            ['title' => 'Auntie Poldi and the Sicilian Lions', 'author' => 'Mario Giordano', 'description' => 'In this light-hearted mystery, a Bavarian widow moves to Sicily and rediscovers her love of living. If you’re participating in the Reading Challenge, heads up: this could be your book in translation, as it was originally written in German.'],
            ['title' => 'The Café by the Sea', 'author' => 'Jenny Colgan', 'description' => 'Authors’ previous works often go on sale when they have a new release, and that was the case here. This is a story of small town life, second chances, and family—the kind you get, and the kind you make—and is set in Scotland, a destination many of you clearly enjoy reading about.'],
        ];

        DB::table('ebooks')->insert($data);
    }
}
