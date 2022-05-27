<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menu = [
            [
                "title" => "الرئيسية",
                "type" => "route",
                "url" => "home",
            ], [
                "title" => "المدونة",
                "type" => "route",
                "url" => "posts",
            ], [
                "title" => "سياسة الخصوصية",
                "type" => "route",
                "url" => "policy",
            ], [
                "title" => "من نحن",
                "type" => "route",
                "url" => "about",
            ], [
                "title" => "تواصل معنا",
                "type" => "route",
                "url" => "contact",
            ]
        ];
        foreach ($menu as $el) {
            Menu::create([
                "title" => $el['title'],
                "type" => $el['type'],
                "url" => $el['url'],
            ]);
        }
    }
}
