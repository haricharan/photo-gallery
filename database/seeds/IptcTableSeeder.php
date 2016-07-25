<?php

use Illuminate\Database\Seeder;

class IptcTableSeeder extends Seeder {

	public function run()
	{
		DB::table('iptc')->delete();
		
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 5,
    	    'tag_name' => 'Document Title',
    	    'tag_name_php' => 'DocumentTitle',
    	    'is_active' => true
			]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 15,
    	    'tag_name' => 'Category',
    	    'tag_name_php' => 'Category',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 55,
    	    'tag_name' => 'Creation Date',
    	    'tag_name_php' => 'CreationDate',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 60,
    	    'tag_name' => 'Creation Time',
    	    'tag_name_php' => 'CreationTime',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 80,
    	    'tag_name' => 'Author Byline',
    	    'tag_name_php' => 'AuthorByline',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 85,
    	    'tag_name' => 'Author Title',
    	    'tag_name_php' => 'AuthorTitle',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 90,
    	    'tag_name' => 'City',
    	    'tag_name_php' => 'City',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 92,
    	    'tag_name' => 'Sub Location',
    	    'tag_name_php' => 'SubLocation',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 95,
    	    'tag_name' => 'State',
    	    'tag_name_php' => 'State',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 101,
    	    'tag_name' => 'Country',
    	    'tag_name_php' => 'Country',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 103,
    	    'tag_name' => 'Job Identifier',
    	    'tag_name_php' => 'OTR',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 105,
    	    'tag_name' => 'Headline',
    	    'tag_name_php' => 'Headline',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 110,
    	    'tag_name' => 'Credit',
    	    'tag_name_php' => 'Source',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 115,
    	    'tag_name' => 'Source',
    	    'tag_name_php' => 'PhotoSource',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 116,
    	    'tag_name' => 'Copyright',
    	    'tag_name_php' => 'Copyright',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 120,
    	    'tag_name' => 'Caption',
    	    'tag_name_php' => 'Caption',
    	    'is_active' => true
    	]);
    	\PhotoGallery\Models\Iptc::create([
    	    'id' => 122,
    	    'tag_name' => 'Caption Writer',
    	    'tag_name_php' => 'CaptionWriter',
    	    'is_active' => true
    	]);
 		$this->command->info('Iptc table seeded!');
	}
}
