<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use  Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use DB;
class SpicyDeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::truncate();
        DB::statement("SET foreign_key_checks=0");
        Category::truncate();
        DB::statement("SET foreign_key_checks=1");
        $json = File::get('database/seeders/data/spicy-deli.json');
        $seed = json_decode($json, true);
        $categories = array_column($seed['products'], 'category');
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
        foreach ($seed['products'] as $product) {
            Product::create([
                'name' => $product['name'],
                'category_id' => Category::where('name', $product['category'])->first()->id,
                'sku' => $product['sku'],
                'price' => $product['price']
            ]);
        }
    }
}
