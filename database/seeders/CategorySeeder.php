<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            ['id' => '1','key' => 'faq','value' => '{"question":"Who can invest with realston?","answer":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}','lang' => 'en','created_at' => '2022-07-31 13:14:11','updated_at' => '2022-07-31 13:14:11'],
            ['id' => '2','key' => 'faq','value' => '{"question":"How does liquidity work at realston?","answer":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}','lang' => 'en','created_at' => '2022-07-31 13:14:11','updated_at' => '2022-07-31 13:14:11'],
            ['id' => '3','key' => 'faq','value' => '{"question":"How does pricing work?","answer":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}','lang' => 'en','created_at' => '2022-07-31 13:14:11','updated_at' => '2022-07-31 13:14:11'],
            ['id' => '4','key' => 'faq','value' => '{"question":"How do returns work at realston?","answer":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}','lang' => 'en','created_at' => '2022-07-31 13:14:11','updated_at' => '2022-07-31 13:14:11'],
            ['id' => '5','key' => 'faq','value' => '{"question":"Is realston a long-term investment?","answer":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}','lang' => 'en','created_at' => '2022-07-31 13:14:11','updated_at' => '2022-07-31 13:14:11'],
            ['id' => '6','key' => 'faq','value' => '{"question":"What are the differences between T-Wind and Tailwind UI?","answer":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}','lang' => 'en','created_at' => '2022-07-31 13:14:11','updated_at' => '2022-07-31 13:14:11'],
        ];

        Category::insert($options);
    }
}
