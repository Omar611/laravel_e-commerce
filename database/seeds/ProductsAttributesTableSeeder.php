<?php

use App\ProductsAttributes;
use Illuminate\Database\Seeder;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [
            [
                'id' => 1,
                'product_id' => 1,
                'size' => "Small",
                'price' => "100",
                'stock' => 10,
                'sku' => 'BTS001',
                'status' => 1,
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'size' => "Large",
                'price' => "200",
                'stock' => 15,
                'sku' => 'RFS001',
                'status' => 1,
            ]
        ];
        ProductsAttributes::insert($productAttributesRecords);
    }
}
