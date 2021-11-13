<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => 'Lorem Ipsum Dolor Ismet',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor iusto doloribus modi consectetur voluptatum? Excepturi qui, blanditiis quas ex hic facere eveniet error magnam atque perferendis soluta repellendus, aperiam quibusdam.'
        ]);
        Post::create([
            'title' => 'Lorem Ipsum Dolor Ismet 1',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor iusto doloribus modi consectetur voluptatum? Excepturi qui, blanditiis quas ex hic facere eveniet error magnam atque perferendis soluta repellendus, aperiam quibusdam.'
        ]);
        Post::create([
            'title' => 'Lorem Ipsum Dolor Ismet 2',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor iusto doloribus modi consectetur voluptatum? Excepturi qui, blanditiis quas ex hic facere eveniet error magnam atque perferendis soluta repellendus, aperiam quibusdam.'
        ]);
    }
}
