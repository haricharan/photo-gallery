<?php

use Illuminate\Database\Seeder;
use PhotoGallery\Models\Exif;

class ExifTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('exif')->delete();
        
        foreach (range(0, 65535) as $index) {
            $tagname = exif_tagname($index);
            
            if ($tagname) {
                Exif::create([
                    'id' => $index,
                    'tag_name' => $tagname,
                    'tag_name_php' => $tagname,
                    'is_active' => true
                ]);
            }
        }
        $this->command->info('Exif table seeded!');
    }
}
