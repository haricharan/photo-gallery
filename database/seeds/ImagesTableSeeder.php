<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('images')->delete();
        foreach (range(1, 10) as $index) {
            PhotoGallery\Models\Image::create([
                'filename' => 'file' . '_' . str_random(5),
                'path' => '/' . str_random(10). '/',
                'image_hash' => str_random(32)
            ]);
        }
        $this->command->info('Images table seeded!');
    }
}
