<?php

namespace Database\Seeders;

use App\Models\Upload;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $images = ['user', 'post', 'page','default'];
        foreach ($images as $image) {
            Upload::create([
                'url' => "uploads/default/$image.png",
                'generated_name' => "$image.png",
                'original_name' => "$image.png",
                'real_path' => 'C:\xampp\tmp\php47F4.tmp',
                'extension' => 'png',
                'size' => '0',
                'mime_type' => 'image/png',
                'type' => 'Image',
                'created_at' => '2021-07-12 20:29:40',
                'updated_at' => '2021-07-12 20:29:40'
            ]);
        }
    }
}
