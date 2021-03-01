<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                "id" => 1,
                "category_id" => 1,
                "section_id" => 1,
                "product_name" => 'Blue T-shirt',
                "product_code" => 'BTS001',
                "product_color" => 'Blue',
                "product_price" => '1500',
                "product_discount" => 10,
                "product_weight" => 30,
                "product_video" => '',
                "main_image" => '',
                "description" => 'Test Product',
                "wash_care" => '',
                "fabric" => '',
                "pattern" => '',
                "sleev" => '',
                "fit" => 'XL',
                "occasion" => '',
                "meta_title" => '',
                "meta_description" => '',
                "meta_keywords" => '',
                "is_featured" => 'No',
                "status" => 1,
            ],
            [
                "id" => 2,
                "category_id" => 3,
                "section_id" => 1,
                "product_name" => 'Formal Red T-Shirt',
                "product_code" => 'RFS001',
                "product_color" => 'Red',
                "product_price" => '1250',
                "product_discount" => 8,
                "product_weight" => 25,
                "product_video" => '',
                "main_image" => '',
                "description" => 'Test Product',
                "wash_care" => '',
                "fabric" => '',
                "pattern" => '',
                "sleev" => '',
                "fit" => 'L',
                "occasion" => '',
                "meta_title" => '',
                "meta_description" => '',
                "meta_keywords" => '',
                "is_featured" => 'Yes',
                "status" => 1,
            ]
        ];
        Product::insert($productRecords);
    }
}
