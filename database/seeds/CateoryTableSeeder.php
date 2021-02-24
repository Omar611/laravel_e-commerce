<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CateoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [
                'id' => 1,
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'T-Shirt',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'T-Shirts For Men in all sizes',
                'url' => 't-shirts',
                'meta_title' => "Men's T-Shirts",
                'meta_description' => 'T-Shirts For Men in all sizes',
                'meta_keywords' => 'T-shirts, Shirts, Men, XL, L, XXL',
                'status' => 1,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'section_id' => 1,
                'category_name' => 'Casual T-Shirt',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'Casual T-Shirts For Men in all sizes',
                'url' => 'casual-t-shirts',
                'meta_title' => "Men's Casual T-Shirts",
                'meta_description' => 'Casual T-Shirts For Men in all sizes',
                'meta_keywords' => 'T-shirts, Shirts, Men, XL, L, XXL',
                'status' => 1,
            ]
            ];
        Category::insert($categoryRecords);
    }
}
