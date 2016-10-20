<?php

use Illuminate\Database\Seeder;

class ImageSizesTableSeeder extends Seeder
{

    public function run()
    {
        // DB::table('image_sizes')->truncate();
        PhotoGallery\Models\ImageSize::create([
            'name' => 'small',
            'max_edge_length' => 200,
            'is_active' => true
        ]);
        
        PhotoGallery\Models\ImageSize::create([
            'name' => 'regular',
            'max_edge_length' => 800,
            'is_active' => true
        ]);

        PhotoGallery\Models\ImageSize::create([
            'name' => 'large',
            'max_edge_length' => 1280,
            'is_active' => true
        ]);
      
        PhotoGallery\Models\ImageSize::create([
            'name' => 'extra_large',
            'max_edge_length' => 2048,
            'is_active' => true
        ]);

        $this->command->info('Image Sizes table seeded!');
    }
}
