<?php

use Illuminate\Database\Seeder;

class ImageSizesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('image_sizes')->truncate();
        PhotoGallery\Models\ImageSize::create([
            'name' => 'small',
            'max_width' => 640,
            'max_height' => 480,
            'is_active' => true
        ]);
        
        PhotoGallery\Models\ImageSize::create([
            'name' => 'regular',
            'max_width' => 800,
            'max_height' => 600,
            'is_active' => true
        ]);

        PhotoGallery\Models\ImageSize::create([
            'name' => 'large',
            'max_width' => 1280,
            'max_height' => 800,
            'is_active' => true
        ]);
        $this->command->info('Image Sizes table seeded!');
    }
}
